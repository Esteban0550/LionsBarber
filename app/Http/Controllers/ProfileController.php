<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        // Detectar si viene de admin basado en el referer o parámetro
        $referer = $request->header('referer', '');
        $fromAdmin = $request->query('from') === 'admin' || str_contains($referer, '/admin');
        
        // Si viene de admin, guardar en sesión
        if ($fromAdmin) {
            $request->session()->put('admin_context', true);
        } else {
            // Si viene de usuario, limpiar contexto admin
            $request->session()->forget('admin_context');
        }
        
        $isAdminContext = $fromAdmin || $request->session()->get('admin_context', false);
        
        return view('profile.edit', [
            'user' => $request->user(),
            'isAdminContext' => $isAdminContext,
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request)
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        // Mantener el contexto admin si estaba en admin
        if ($request->session()->get('admin_context', false)) {
            $request->session()->put('admin_context', true);
        }
        
        // Si es una petición AJAX, devolver JSON sin recargar
        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Profile updated successfully'
            ]);
        }
        
        // Si no es AJAX, redirigir normalmente
        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
