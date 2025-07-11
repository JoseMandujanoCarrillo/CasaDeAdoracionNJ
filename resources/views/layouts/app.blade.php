<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'Mi Aplicación')</title>
  <!-- Aquí puedes incluir tus estilos globales -->
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&family=Lora:wght@400;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('css/churchpage.css') }}">
</head>
<body>
  {{-- Navbar o header común --}}
  <!-- Header personalizado -->
  <header style="background:#232323; box-shadow:0 2px 8px rgba(0,0,0,0.25); padding:1.2rem 0;">
    <div class="container header-container" style="display:flex; align-items:center; justify-content:space-between;">
      <div class="logo" style="display:flex; align-items:center; text-decoration:none;">
        <img src="{{ asset('Images/logo.webp') }}" alt="Casa de Adoración Logo" style="height:48px; margin-right:1rem;">
        <span class="logo-text" style="font-family:'Montserrat',sans-serif; font-size:2rem; color:#fff; font-weight:700;">Casa de Adoración NJ</span>
      </div>
    </div>
  </header>

  {{-- Contenido inyectable --}}
  <main style="min-height:80vh;">
    @yield('content')
  </main>

  {{-- Footer común --}}
  <footer style="background:#232323; color:#fff; padding:1.2rem 0; margin-top:2rem;">
    <div class="container" style="text-align:center;">
      <p style="margin:0;">&copy; {{ date('Y') }} Casa de Adoración NJ</p>
    </div>
  </footer>
</body>
</html>
