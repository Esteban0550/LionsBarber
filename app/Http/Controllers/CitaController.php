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

        // Estado por defecto: pendiente
        $validated['estado'] = 'pendiente';

        Cita::create($validated);

        return redirect()->route('citas')
            ->with('success', '¡Cita agendada exitosamente!');
    }
}
