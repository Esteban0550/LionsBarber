<?php

namespace App\Http\Controllers;

use App\Models\Cita;
use App\Models\User;
use Illuminate\Http\Request;

class CitaController extends Controller
{
    /**
     * Display the citas page.
     */
    public function index()
    {
        // Mostrar todas las citas agendadas (solo visualización)
        $misCitas = Cita::with('barbero')
            ->latest('fecha')
            ->latest('hora')
            ->take(10) // Mostrar las últimas 10 citas
            ->get();
        
        return view('citas', compact('misCitas'));
    }

    /**
     * Get occupied hours for a specific date
     */
    public function getOccupiedHours(Request $request)
    {
        $request->validate([
            'fecha' => ['required', 'date'],
            'barbero_id' => ['nullable', 'exists:users,id'],
        ]);

        $fecha = $request->fecha;
        $barberoId = $request->barbero_id;

        // Obtener citas ocupadas para esa fecha
        $query = Cita::where('fecha', $fecha)
            ->whereIn('estado', ['pendiente', 'confirmada']); // Solo considerar citas activas

        // Si se especifica un barbero, filtrar por barbero
        if ($barberoId) {
            $query->where('barbero_id', $barberoId);
        }

        $citasOcupadas = $query->get();

        // Extraer las horas ocupadas
        $horasOcupadas = $citasOcupadas->map(function($cita) {
            return date('H:i', strtotime($cita->hora));
        })->toArray();

        return response()->json([
            'horas_ocupadas' => $horasOcupadas,
            'total' => count($horasOcupadas)
        ]);
    }

    /**
     * Store a newly created cita.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => ['required', 'string', 'max:255'],
            'barbero' => ['nullable', 'in:1,2,3'],
            'fecha' => ['required', 'date'],
            'hora' => ['required'],
            'servicio' => ['required', 'in:corte,barba,combo'],
        ]);

        // Si el usuario está autenticado, asociar la cita al usuario
        if (auth()->check()) {
            $validated['user_id'] = auth()->id();
        }

        // Si se seleccionó un barbero, asignar el barbero correspondiente según el índice
        if (isset($validated['barbero']) && $validated['barbero'] && $validated['barbero'] !== '') {
            // Obtener todos los barberos staff ordenados por ID para mantener consistencia
            $barberosStaff = User::whereHas('role', fn($q) => $q->where('name', 'staff'))
                ->orderBy('id')
                ->get();
            
            // El índice seleccionado (1, 2, 3) corresponde al índice del array (0, 1, 2)
            $indiceBarbero = (int)$validated['barbero'] - 1;
            
            // Verificar que tenemos barberos disponibles
            if ($barberosStaff->isEmpty()) {
                // No hay barberos, dejar null
                $validated['barbero_id'] = null;
            } elseif ($barberosStaff->count() > $indiceBarbero && $indiceBarbero >= 0) {
                // Si existe el barbero en ese índice, asignarlo
                $barberoSeleccionado = $barberosStaff[$indiceBarbero];
                $validated['barbero_id'] = $barberoSeleccionado->id;
            } else {
                // Si no hay suficientes barberos para ese índice, asignar el último disponible
                $validated['barbero_id'] = $barberosStaff->last()->id;
            }
        }
        unset($validated['barbero']);

        // Validar que no haya una cita duplicada en la misma fecha y hora
        $citaExistente = Cita::where('fecha', $validated['fecha'])
            ->where('hora', $validated['hora'])
            ->whereIn('estado', ['pendiente', 'confirmada'])
            ->first();

        if ($citaExistente) {
            return redirect()->back()
                ->withErrors(['hora' => 'Esta hora ya está ocupada. Por favor, selecciona otra hora.'])
                ->withInput();
        }

        // Estado por defecto: pendiente
        $validated['estado'] = 'pendiente';

        Cita::create($validated);

        return redirect()->route('citas')
            ->with('success', '¡Cita agendada exitosamente!');
    }
}
