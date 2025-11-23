<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use App\Models\Cita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    /**
     * Display the admin dashboard.
     */
    public function index()
    {
        $stats = [
            'total_users' => User::withTrashed()->count(),
            'admin_users' => User::withTrashed()->whereHas('role', fn($q) => $q->where('name', 'admin'))->count(),
            'staff_users' => User::withTrashed()->whereHas('role', fn($q) => $q->where('name', 'staff'))->count(),
            'client_users' => User::withTrashed()->whereHas('role', fn($q) => $q->where('name', 'client'))->count(),
        ];

        return view('admin.dashboard', compact('stats'));
    }

    /**
     * Display a listing of users.
     */
    public function users()
    {
        $users = User::withTrashed()->with('role')->latest()->paginate(15);
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new user.
     */
    public function createUser()
    {
        $roles = Role::all();
        return view('admin.users.create', compact('roles'));
    }

    /**
     * Store a newly created user.
     */
    public function storeUser(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'role_id' => ['required', 'exists:roles,id'],
        ]);

        $validated['password'] = Hash::make($validated['password']);

        User::create($validated);

        return redirect()->route('admin.users')
            ->with('success', 'Usuario creado correctamente.');
    }

    /**
     * Show the form for editing the specified user.
     */
    public function editUser(User $user)
    {
        $roles = Role::all();
        return view('admin.users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified user.
     */
    public function updateUser(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'role_id' => ['required', 'exists:roles,id'],
        ]);

        $user->update($validated);

        return redirect()->route('admin.users')
            ->with('success', 'Usuario actualizado correctamente.');
    }

    /**
     * Toggle user active status (soft delete / restore).
     */
    public function toggleUserStatus($userId)
    {
        // Buscar el usuario incluyendo los eliminados (soft deleted)
        $user = User::withTrashed()->findOrFail($userId);

        if ($user->id === auth()->id()) {
            return redirect()->route('admin.users')->with('error', 'No puedes desactivar tu propia cuenta.');
        }

        if ($user->trashed()) {
            $user->restore();
            $message = 'Usuario activado correctamente.';
        } else {
            $user->delete();
            $message = 'Usuario desactivado correctamente.';
        }

        return redirect()->route('admin.users')->with('success', $message);
    }

    /**
     * Display a listing of citas.
     */
    public function citas()
    {
        $citas = Cita::with(['user', 'barbero'])->latest('fecha')->latest('hora')->paginate(15);
        return view('admin.citas.index', compact('citas'));
    }

    /**
     * Show the form for creating a new cita.
     */
    public function createCita()
    {
        $barberos = User::whereHas('role', fn($q) => $q->where('name', 'staff'))->get();
        $users = User::whereHas('role', fn($q) => $q->where('name', 'client'))->get();
        return view('admin.citas.create', compact('barberos', 'users'));
    }

    /**
     * Store a newly created cita.
     */
    public function storeCita(Request $request)
    {
        $validated = $request->validate([
            'nombre' => ['required', 'string', 'max:255'],
            'user_id' => ['nullable', 'exists:users,id'],
            'barbero_id' => ['nullable', 'exists:users,id'],
            'fecha' => ['required', 'date'],
            'hora' => ['required'],
            'servicio' => ['required', 'in:corte,barba,combo'],
            'estado' => ['required', 'in:pendiente,confirmada,cancelada,completada'],
            'notas' => ['nullable', 'string', 'max:1000'],
        ]);

        Cita::create($validated);

        return redirect()->route('admin.citas')
            ->with('success', 'Cita creada correctamente.');
    }

    /**
     * Show the form for editing the specified cita.
     */
    public function editCita(Cita $cita)
    {
        $barberos = User::whereHas('role', fn($q) => $q->where('name', 'staff'))->get();
        $users = User::whereHas('role', fn($q) => $q->where('name', 'client'))->get();
        return view('admin.citas.edit', compact('cita', 'barberos', 'users'));
    }

    /**
     * Update the specified cita.
     */
    public function updateCita(Request $request, Cita $cita)
    {
        $validated = $request->validate([
            'nombre' => ['required', 'string', 'max:255'],
            'user_id' => ['nullable', 'exists:users,id'],
            'barbero_id' => ['nullable', 'exists:users,id'],
            'fecha' => ['required', 'date'],
            'hora' => ['required'],
            'servicio' => ['required', 'in:corte,barba,combo'],
            'estado' => ['required', 'in:pendiente,confirmada,cancelada,completada'],
            'notas' => ['nullable', 'string', 'max:1000'],
        ]);

        $cita->update($validated);

        return redirect()->route('admin.citas')
            ->with('success', 'Cita actualizada correctamente.');
    }

    /**
     * Remove the specified cita.
     */
    public function destroyCita(Cita $cita)
    {
        $cita->delete();

        return redirect()->route('admin.citas')
            ->with('success', 'Cita eliminada correctamente.');
    }

    /**
     * Display statistics page.
     */
    public function estadisticas()
    {
        // Obtener todas las citas agrupadas por fecha
        $citas = Cita::select('fecha', 'estado')
            ->orderBy('fecha')
            ->get()
            ->groupBy(function($cita) {
                return $cita->fecha->format('Y-m-d');
            });

        // Preparar datos para la gráfica
        $citasData = [];
        foreach ($citas as $fecha => $citasDelDia) {
            $citasData[$fecha] = $citasDelDia->map(function($cita) {
                return [
                    'estado' => $cita->estado,
                    'fecha' => $cita->fecha->format('Y-m-d')
                ];
            })->toArray();
        }

        return view('admin.estadisticas', compact('citasData'));
    }
}
