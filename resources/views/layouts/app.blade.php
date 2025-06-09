<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'Mi Aplicación')</title>
  <!-- Aquí puedes incluir tus estilos globales -->
</head>
<body>
  {{-- Navbar o header común --}}
  <header>
    <h1>Casa de Adoración NJ</h1>
  </header>

  {{-- Contenido inyectable --}}
  <main>
    @yield('content')
  </main>

  {{-- Footer común --}}
  <footer>
    <p>&copy; {{ date('Y') }} Casa de Adoración NJ</p>
  </footer>
</body>
</html>
