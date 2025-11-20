<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
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
    public function toggleUserStatus(User $user)
    {
        if ($user->id === auth()->id()) {
            return back()->with('error', 'No puedes desactivar tu propia cuenta.');
        }

        if ($user->trashed()) {
            $user->restore();
            $message = 'Usuario activado correctamente.';
        } else {
            $user->delete();
            $message = 'Usuario desactivado correctamente.';
        }

        return back()->with('success', $message);
    }
}
