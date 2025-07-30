<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\JefeDashboardController;
use App\Http\Controllers\UsuarioDashboardController;
use App\Http\Controllers\TareaController;
use App\Http\Controllers\ReporteController;
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
            return redirect()->route('jefe.dashboard');
        default:
            return redirect()->route('usuario.dashboard');
    }
})->middleware(['auth', 'verified'])->name('dashboard');

// Rutas protegidas para todos los roles
Route::middleware('auth')->group(function () {

    // Perfil (Breeze)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Admin
    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
    Route::post('/admin/proyectos', [AdminDashboardController::class, 'storeProyecto'])->name('admin.proyectos.store');
    Route::put('/admin/proyectos/{proyecto}', [AdminDashboardController::class, 'updateProyecto'])->name('admin.proyectos.update');
    Route::delete('/admin/proyectos/{proyecto}', [AdminDashboardController::class, 'destroyProyecto'])->name('admin.proyectos.destroy');
//jefe
    Route::get('/jefe/dashboard', [JefeDashboardController::class, 'index'])->name('jefe.dashboard');
    Route::get('/jefe/reportes/carga-trabajo', [ReporteController::class, 'cargaTrabajo'])->name('reportes.carga');
    Route::get('/jefe/reportes/semaforo', [ReporteController::class, 'semaforo'])->name('reportes.semaforo');
    Route::get('/jefe/reportes/carga-trabajo/pdf', [ReporteController::class, 'exportarCargaTrabajoPDF'])->name('reportes.carga.pdf');
Route::get('/jefe/reportes/semaforo/pdf', [ReporteController::class, 'exportarSemaforoPDF'])->name('reportes.semaforo.pdf');
    // Usuario
    Route::get('/usuario/dashboard', UsuarioDashboardController::class)->name('usuario.dashboard');
    Route::get('/jefe/reportes', [ReporteController::class, 'index'])->name('reportes.index');
    // CRUD de tareas (usado por el jefe en su dashboard)
    Route::resource('tareas', TareaController::class)->except(['show'])->names([
        'index' => 'tareas.index',
        'create' => 'tareas.create',
        'store' => 'tareas.store',
        'edit' => 'tareas.edit',
        'update' => 'tareas.update',
        'destroy' => 'tareas.destroy',
    ]);
});

// Rutas Breeze (login, register, etc.)
require __DIR__.'/auth.php';

