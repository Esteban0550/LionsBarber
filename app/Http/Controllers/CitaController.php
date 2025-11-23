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

        // Si se seleccionó un barbero, intentar encontrar un usuario staff o dejar null
        if (isset($validated['barbero']) && $validated['barbero']) {
            // Intentar encontrar un barbero staff, si no existe, dejar null
            $barberoStaff = User::whereHas('role', fn($q) => $q->where('name', 'staff'))->first();
            if ($barberoStaff) {
                $validated['barbero_id'] = $barberoStaff->id;
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
