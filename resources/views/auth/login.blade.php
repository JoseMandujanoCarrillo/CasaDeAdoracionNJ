<!-- filepath: c:\xampp\htdocs\Test\resources\views\auth\login.blade.php -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Iniciar Sesión</title>
    <link rel="stylesheet" href="{{ asset('css/churchpage.css') }}">
    <style>
        body {
            background: #181818 !important;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .auth-container {
            background: #232323;
            padding: 2.5rem 2rem;
            border-radius: 10px;
            box-shadow: 0 4px 24px rgba(0,0,0,0.18);
            width: 100%;
            max-width: 350px;
            color: #fff;
        }
        .auth-title {
            text-align: center;
            color: var(--main-red);
            margin-bottom: 1.5rem;
            font-size: 2rem;
            font-weight: 700;
        }
        .auth-form input {
            width: 100%;
            padding: 0.8rem;
            margin-bottom: 1.2rem;
            border: 1.5px solid #444;
            border-radius: 5px;
            font-size: 1rem;
            background: #232323;
            color: #fff;
        }
        .auth-form input:focus {
            border-color: var(--main-red);
            outline: none;
        }
        .auth-form button {
            width: 100%;
            padding: 0.8rem;
            background: var(--main-red);
            color: #fff;
            border: none;
            border-radius: 5px;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.2s, color 0.2s;
        }
        .auth-form button:hover {
            background: #181818;
            color: var(--main-red);
            border: 2px solid var(--main-red-dark);
        }
        .auth-link {
            display: block;
            text-align: center;
            margin-top: 1rem;
            color: var(--main-red);
            text-decoration: none;
            font-weight: 500;
        }
        .auth-link:hover {
            color: #fff;
            text-decoration: underline;
        }
        .auth-errors {
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
            border-radius: 5px;
            padding: 0.8rem;
            margin-bottom: 1rem;
            font-size: 0.95rem;
        }
    </style>
</head>
<body>
    <div class="auth-container">
        <div class="auth-title">Iniciar Sesión</div>
        @if($errors->any())
            <div class="auth-errors">
                @foreach($errors->all() as $e)
                    <div>{{ $e }}</div>
                @endforeach
            </div>
        @endif
        <form class="auth-form" method="POST" action="{{ route('login') }}">
            @csrf
            <input type="email" name="email" placeholder="Correo" required>
            <input type="password" name="password" placeholder="Contraseña" required>
            <button type="submit">Entrar</button>
        </form>
        <a href="{{ route('register.form') }}" class="auth-link">¿No tienes cuenta? Regístrate</a>
    </div>
</body>
</html>