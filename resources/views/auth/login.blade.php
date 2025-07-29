<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Iniciar sesión</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .login-container {
            max-width: 400px;
            margin: 60px auto;
            padding: 20px;
        }

        .login-box {
            background: #fff;
            border-radius: 8px;
            padding: 30px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }

        .login-title {
            text-align: center;
            font-size: 24px;
            margin-bottom: 20px;
            color: #333;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            font-weight: bold;
            margin-bottom: 6px;
            color: #444;
        }

        .form-group input[type="email"],
        .form-group input[type="password"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #bbb;
            border-radius: 4px;
            box-sizing: border-box;
        }

        .form-remember {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 14px;
            margin-bottom: 20px;
        }

        .forgot-link {
            color: #007bff;
            text-decoration: none;
        }

        .forgot-link:hover {
            text-decoration: underline;
        }

        .btn-submit {
            width: 100%;
            background-color: #007bff;
            color: #fff;
            padding: 10px;
            font-size: 16px;
            font-weight: bold;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .btn-submit:hover {
            background-color: #0056b3;
        }

        .alert-success {
            background-color: #d4edda;
            border: 1px solid #c3e6cb;
            padding: 10px;
            color: #155724;
            margin-bottom: 15px;
            border-radius: 4px;
        }

        .error-message {
            color: #e3342f;
            font-size: 13px;
            margin-top: 5px;
        }

        .register-text {
            margin-top: 20px;
            text-align: center;
            font-size: 14px;
            color: #555;
        }

        .register-text a {
            color: #007bff;
            text-decoration: none;
            font-weight: bold;
        }

        .register-text a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<div class="login-container">
    <div class="login-box">
        <h1 class="login-title">Iniciar sesión</h1>

        @if(session('status'))
            <div class="alert-success">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            {{-- Email --}}
            <div class="form-group">
                <label for="email">Correo electrónico</label>
                <input id="email" name="email" type="email" value="{{ old('email') }}" required autofocus>
                @error('email')
                    <p class="error-message">{{ $message }}</p>
                @enderror
            </div>

            {{-- Contraseña --}}
            <div class="form-group">
                <label for="password">Contraseña</label>
                <input id="password" name="password" type="password" required>
                @error('password')
                    <p class="error-message">{{ $message }}</p>
                @enderror
            </div>

            {{-- Recuérdame + Olvidé contraseña --}}
            <div class="form-remember">
                <label>
                    <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                    Recuérdame
                </label>

                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="forgot-link">¿Olvidaste tu contraseña?</a>
                @endif
            </div>

            {{-- Botón --}}
            <div class="form-group">
                <button type="submit" class="btn-submit">Iniciar sesión</button>
            </div>
        </form>

        <p class="register-text">
            ¿No tienes cuenta?
            <a href="{{ route('register') }}">Regístrate aquí</a>.
        </p>
    </div>
</div>

</body>
</html>


