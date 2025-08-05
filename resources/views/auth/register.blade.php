<!-- filepath: c:\xampp\htdocs\Test\resources\views\auth\register.blade.php -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro</title>
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
</head>
<body>
    <div class="auth-container">
        <div class="auth-title">Registro</div>
        @if($errors->any())
            <div class="auth-errors">
                @foreach($errors->all() as $e)
                    <div>{{ $e }}</div>
                @endforeach
            </div>
        @endif
        <form class="auth-form" method="POST" action="{{ route('register') }}">
            @csrf
            <input type="text" name="name" placeholder="Nombre" required>
            <input type="email" name="email" placeholder="Correo" required>
            <input type="password" name="password" placeholder="Contraseña" required>
            <input type="password" name="password_confirmation" placeholder="Confirmar contraseña" required>
            <button type="submit">Registrarse</button>
        </form>
        <a href="{{ route('login.form') }}" class="auth-link">¿Ya tienes cuenta? Inicia sesión</a>
    </div>
</body>
</html>