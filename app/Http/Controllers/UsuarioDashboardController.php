<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UsuarioDashboardController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke()
    {
        // Aquí puedes pasar datos a la vista si lo necesitas
        return view('usuario.dashboard');
    }
}
