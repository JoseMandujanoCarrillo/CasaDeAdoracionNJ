<!-- filepath: c:\xampp\htdocs\Test\resources\views\auth\login.blade.php -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Iniciar Sesión</title>
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
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