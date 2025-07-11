<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Galerías por Categoría</title>
    <link rel="stylesheet" href="{{ asset('css/churchpage.css') }}">
    <style>
        body { background: #181818; font-family: 'Montserrat', Arial, sans-serif; }
        .container { max-width: 1100px; margin: 2rem auto; background: #232323; border-radius: 18px; box-shadow: 0 4px 24px #FF3B3F22; padding: 2.5rem 2rem; }
        .main-title { font-size:2.3rem; color:#FF3B3F; margin-bottom:2rem; font-weight:700; letter-spacing:1px; text-align:center; }
        .category-title { font-size:1.4rem; color:#fff; background:#FF3B3F; padding:0.7rem 1.5rem; border-radius:8px; margin:2.5rem 0 1.2rem 0; display:inline-block; box-shadow:0 2px 8px #FF3B3F22; font-weight:600; }
        .gallery-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 2rem; }
        .gallery-item { background:#181818; border-radius:14px; box-shadow:0 2px 12px #FF3B3F12; overflow:hidden; transition:transform 0.18s, box-shadow 0.18s; position:relative; display:flex; flex-direction:column; align-items:center; border:1.5px solid #FF3B3F; }
        .gallery-item:hover { transform:translateY(-6px) scale(1.03); box-shadow:0 6px 24px #FF3B3F44; border-color:#C62828; }
        .gallery-item img { width:100%; height:170px; object-fit:cover; border-radius:14px 14px 0 0; }
        .cat-label { font-size:1.05rem; color:#FF3B3F; margin:0.7rem 0 0.5rem 0; text-align:center; font-weight:500; }
        .view-btn { background:#FF3B3F; color:#fff; border:none; border-radius:6px; padding:0.4rem 1.1rem; margin-bottom:1rem; margin-top:auto; font-size:0.98rem; font-weight:600; cursor:pointer; transition:background 0.18s; box-shadow:0 2px 8px #FF3B3F22; }
        .view-btn:hover { background:#C62828; }
        .btn { background:#FF3B3F; color:#fff; padding:0.5rem 1.2rem; border-radius:6px; margin-bottom:2rem; display:inline-block; font-weight:600; text-decoration:none; transition:background 0.18s; }
        .btn:hover { background:#C62828; }
        p, h1, h2, h3, h4, h5, h6, label, .main-title { color: #fff; }
        @media (max-width: 700px) { .container { padding:1rem; } .gallery-grid { gap:1rem; } }
    </style>
</head>
<body>
    <div class="container">
        <div class="main-title">Galerías por Categoría</div>
        <a href="{{ url('/') }}" class="btn">Volver a inicio</a>
        @forelse($imagenesPorCategoria as $categoria => $imagenes)
            <div class="category-title">{{ ucfirst($categoria) }}</div>
            <div class="gallery-grid">
                @foreach($imagenes as $image)
                    <div class="gallery-item">
                        <img src="{{ asset('uploads/' . $image->filename) }}" alt="Imagen de galería">
                        <div class="cat-label">{{ ucfirst($image->categoria ?? 'Sin categoría') }}</div>
                        <a href="{{ route('galerias.categoria', ['categoria' => $categoria]) }}" class="view-btn">Ver categoría</a>
                    </div>
                @endforeach
            </div>
        @empty
            <p style="color:#FF3B3F; font-size:1.1rem; margin-top:2rem;">No hay imágenes en la galería.</p>
        @endforelse
    </div>
</body>
</html>
