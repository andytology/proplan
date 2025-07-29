<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Models\Usuario;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

// Aquí sustituimos la ruta /dashboard por defecto
Route::get('/dashboard', function () {
    $user = auth()->user();

    // Si por algún motivo no hay usuario (muy raro porque ya pasa auth|verified)
    if (! $user) {
        return redirect()->route('login');
    }

    // Según el rol, devolvemos la vista adecuada
    switch ($user->rol) {
        case Usuario::ROLE_ADMIN:
            // Puedes pasarle datos si los necesitas: compact('totalUsers','users',…)
            return view('admin/dashboard');
        case Usuario::ROLE_JEFE:
            return view('jefe/dashboard');
        default:
            return view('usuario/dashboard');
    }
})
->middleware(['auth', 'verified'])
->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile',   [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile',[ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Rutas de login, register, etc. que ya vienen de Breeze
require __DIR__.'/auth.php';

