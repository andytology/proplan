<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Usuario;

class LoginController extends Controller
{
    // Mostrar formulario de login
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Intentar autenticar (comparación en texto plano)
    public function login(Request $request)
    {
        $data = $request->validate([
            'email'    => ['required','email'],
            'password' => ['required'],
        ]);

        // 1) Busca el usuario por email
        $user = Usuario::where('email', $data['email'])->first();

        // 2) Compara directamente el texto plano
        if ($user && $data['password'] === $user->contraseña) {
            // 3) Loguea manualmente (incluye 'remember')
            Auth::login($user, $request->boolean('remember'));

            // 4) Regenera la sesión
            $request->session()->regenerate();

            // 5) Redirige según rol
            return match($user->rol) {
                Usuario::ROLE_ADMIN => redirect()->intended('/admin/dashboard'),
                Usuario::ROLE_JEFE  => redirect()->intended('/jefe/dashboard'),
                default             => redirect()->intended('/usuario/dashboard'),
            };
        }

        // 6) Si falla, devuelve con error
        return back()
            ->withErrors(['email' => 'Credenciales incorrectas.'])
            ->onlyInput('email');
    }

    // Cerrar sesión
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}
