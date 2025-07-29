<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminDashboardController;
use App\Models\Usuario;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

// Redirección dinámica por rol al iniciar sesión
Route::get('/dashboard', function () {
    $user = auth()->user();

    if (! $user) {
        return redirect()->route('login');
    }

    switch ($user->rol) {
        case Usuario::ROLE_ADMIN:
            return redirect()->route('admin.dashboard');
        case Usuario::ROLE_JEFE:
            return view('jefe/dashboard');
        default:
            return view('usuario/dashboard');
    }
})
->middleware(['auth', 'verified'])
->name('dashboard');

// Rutas de perfil (Breeze)
Route::middleware('auth')->group(function () {
    Route::get('/profile',   [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile',[ProfileController::class, 'destroy'])->name('profile.destroy');
});

// RUTAS DE ADMIN (ahora solo requieren auth, control de rol se hace en controlador)
Route::middleware('auth')->group(function () {
    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
    Route::post('/admin/proyectos', [AdminDashboardController::class, 'storeProyecto'])->name('admin.proyectos.store');
    Route::put('/admin/proyectos/{proyecto}', [AdminDashboardController::class, 'updateProyecto'])->name('admin.proyectos.update');
    Route::delete('/admin/proyectos/{proyecto}', [AdminDashboardController::class, 'destroyProyecto'])->name('admin.proyectos.destroy');
});

// Rutas de autenticación Breeze
require __DIR__.'/auth.php';


