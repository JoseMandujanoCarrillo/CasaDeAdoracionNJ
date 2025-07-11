<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Galería - {{ ucfirst($categoria) }}</title>
    <link rel="stylesheet" href="{{ asset('css/churchpage.css') }}">
    <style>
        .category-title { font-size:1.5rem; color:#395B64; margin:2rem 0 1rem 0; }
        .gallery-grid { display: flex; flex-wrap: wrap; gap: 1.5rem; }
        .gallery-item { width: 180px; position: relative; }
        .gallery-item img { width: 100%; border-radius: 8px; box-shadow: 0 2px 8px #0002; }
        .gallery-item .cat-label { font-size:0.95rem; color:#395B64; margin-top:0.3rem; text-align:center; }
    </style>
</head>
<body>
    <div class="container">
        <h1 style="color:#395B64;">Galería: {{ ucfirst($categoria) }}</h1>
        <a href="{{ route('galerias.categorias') }}" class="btn" style="background:#395B64; color:#fff; padding:0.5rem 1.2rem; border-radius:6px; margin-bottom:2rem; display:inline-block;">Ver todas las categorías</a>
        <div class="gallery-grid">
            @forelse($imagenes as $image)
                <div class="gallery-item">
                    <img src="{{ asset('uploads/' . $image->filename) }}" alt="Imagen de galería">
                </div>
            @empty
                <p>No hay imágenes en esta categoría.</p>
            @endforelse
        </div>
    </div>
</body>
</html>
