<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class JefeDashboardController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke()
    {
        // Ejemplo: $proyectos = auth()->user()->proyectos;
        return view('jefe.dashboard');
    }
}
