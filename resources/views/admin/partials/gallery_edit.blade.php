
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Galería</title>
    <link rel="stylesheet" href="{{ asset('css/churchpage.css') }}">
    <style>
        .gallery-edit-grid {
            display: flex;
            flex-wrap: wrap;
            gap: 1rem;
        }
        .gallery-edit-item {
            position: relative;
            width: 180px;
        }
        .gallery-edit-item img {
            width: 100%;
            border-radius: 8px;
            box-shadow: 0 2px 8px #0002;
        }
        .delete-btn {
            position: absolute;
            top: 8px;
            right: 8px;
            background: #d9534f;
            color: #fff;
            border: none;
            border-radius: 50%;
            width: 28px;
            height: 28px;
            cursor: pointer;
            font-weight: bold;
            font-size: 1.2rem;
            box-shadow: 0 2px 4px #0002;
            transition: background 0.2s;
        }
        .delete-btn:hover {
            background: #b52a25;
        }
        .upload-form {
            margin-bottom: 2rem;
            display: flex;
            gap: 1rem;
            align-items: center;
        }
        .upload-form input[type="file"] {
            flex: 1;
        }
        .upload-form button {
            background: #395B64;
            color: #fff;
            border: none;
            padding: 0.5rem 1.2rem;
            border-radius: 5px;
            font-size: 1rem;
            cursor: pointer;
            transition: background 0.2s;
        }
        .upload-form button:hover {
            background: #2c434a;
        }
        .alert {
            padding: 1rem;
            border-radius: 5px;
            margin-bottom: 1.5rem;
            font-weight: bold;
        }
        .alert-success {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        .alert-error {
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
    </style>
</head>
<body>
    <script>
    // Redirigir automáticamente a dashboard.blade.php (ruta del dashboard)
    window.location.href = '/church/public/admin/dashboard';
    </script>
    <div class="container" style="display:none;">
        <h1>Editar Galería de Imágenes</h1>

        <!-- Mensajes de éxito o error -->
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        @if($errors->any())
            <div class="alert alert-error">
                @foreach($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        <!-- Formulario para subir nuevas imágenes -->
        <form class="upload-form" action="{{ route('gallery.upload') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="file" name="images[]" multiple accept="image/*" required>
            <button type="submit">Subir Imágenes</button>
        </form>

        <!-- Mostrar imágenes actuales -->
        <div class="gallery-edit-grid">
            @foreach($images as $image)
                <div class="gallery-edit-item">
                    <img src="{{ asset('uploads/' . $image->filename) }}" alt="Imagen de galería">
                    <form action="{{ route('gallery.delete', $image->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button class="delete-btn" title="Eliminar" onclick="return confirm('¿Eliminar esta imagen?')">&times;</button>
                    </form>
                    
                </div>
            @endforeach
        </div>
    </div>
</body>
</html>