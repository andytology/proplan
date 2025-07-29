<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke()
    {
        // Ejemplo: $usuarios = \App\Models\Usuario::all();
        return view('admin.dashboard');
    }
}

