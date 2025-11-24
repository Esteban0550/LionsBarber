<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CitaController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/barberos', function () {
    return view('barberos');
})->name('barberos');

Route::get('/citas', [CitaController::class, 'index'])->name('citas');
Route::post('/citas', [CitaController::class, 'store'])->name('citas.store');
Route::get('/citas/horas-ocupadas', [CitaController::class, 'getOccupiedHours'])->name('citas.horas-ocupadas');

Route::get('/cortes-cabello', function () {
    return view('cortes-cabello');
})->name('cortes-cabello');

Route::get('/menu', function () {
    return view('menu');
})->name('menu');

Route::get('/nosotros', function () {
    return view('nosotros');
})->name('nosotros');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Admin Routes
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
    Route::get('/users', [AdminController::class, 'users'])->name('users');
    Route::get('/users/create', [AdminController::class, 'createUser'])->name('users.create');
    Route::post('/users', [AdminController::class, 'storeUser'])->name('users.store');
    Route::get('/users/{user}/edit', [AdminController::class, 'editUser'])->name('users.edit');
    Route::put('/users/{user}', [AdminController::class, 'updateUser'])->name('users.update');
    Route::patch('/users/{userId}/toggle-status', [AdminController::class, 'toggleUserStatus'])->name('users.toggle-status')->where('userId', '[0-9]+');
    
    // Citas Routes
    Route::get('/citas', [AdminController::class, 'citas'])->name('citas');
    Route::get('/citas/create', [AdminController::class, 'createCita'])->name('citas.create');
    Route::post('/citas', [AdminController::class, 'storeCita'])->name('citas.store');
    Route::get('/citas/{cita}/edit', [AdminController::class, 'editCita'])->name('citas.edit');
    Route::put('/citas/{cita}', [AdminController::class, 'updateCita'])->name('citas.update');
    Route::delete('/citas/{cita}', [AdminController::class, 'destroyCita'])->name('citas.destroy');
    
    // Estadísticas
    Route::get('/estadisticas', [AdminController::class, 'estadisticas'])->name('estadisticas');
});

require __DIR__.'/auth.php';
