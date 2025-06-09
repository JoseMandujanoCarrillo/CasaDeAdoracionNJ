<!DOCTYPE html>
<html lang="es">
<head>
    <!-- Agrega esto en el <head> -->
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&family=Lora:wght@400;700&display=swap" rel="stylesheet">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administración</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
<!-- Cambia el bloque <style> en dashboard.blade.php por esto -->
<style>
    :root {
        --primary-color: #395B64;
        --primary-dark: #2C3333;
        --secondary-color: #F5F7FA;
        --accent-color: #A5C9CA;
        --danger-color: #ef4444;
        --warning-color: #f59e0b;
        --text-primary: #222;
        --text-secondary: #395B64;
        --border-color: #A5C9CA;
        --shadow-sm: 0 2px 8px rgba(57,91,100,0.07);
        --shadow-md: 0 2px 12px rgba(57,91,100,0.08);
        --shadow-lg: 0 4px 16px rgba(57,91,100,0.15);
        --shadow-xl: 0 2px 12px rgba(57,91,100,0.10);
        --gradient: linear-gradient(135deg, #A5C9CA 0%, #F5F7FA 100%);
        --glass-bg: #fff;
        --glass-border: #A5C9CA;
    }
    .section { display: none; }
    .section.active { display: block; }

    body {
        font-family: 'Montserrat', Arial, sans-serif;
        background: var(--secondary-color);
        color: var(--text-primary);
        line-height: 1.6;
        padding: 1rem;
    }

    .admin-container {
        max-width: 1200px;
        margin: 0 auto;
        background: var(--glass-bg);
        border: 1.5px solid var(--glass-border);
        border-radius: 18px;
        box-shadow: var(--shadow-lg);
        overflow: hidden;
        animation: slideUp 0.6s ease-out;
    }

    .admin-header {
        background: var(--primary-color);
        padding: 2rem;
        color: #fff;
        position: relative;
        overflow: hidden;
    }

    .admin-title {
        font-size: 2.2rem;
        font-weight: 700;
        font-family: 'Lora', serif;
        margin-bottom: 0.5rem;
        display: flex;
        align-items: center;
        gap: 1rem;
        position: relative;
        z-index: 1;
    }

    .admin-subtitle {
        font-size: 1.1rem;
        opacity: 0.9;
        position: relative;
        z-index: 1;
    }

    .admin-nav {
        background: #fff;
        padding: 0;
        border-bottom: 1.5px solid var(--border-color);
        display: flex;
        overflow-x: auto;
    }

    .nav-item {
        padding: 1rem 2rem;
        cursor: pointer;
        border-bottom: 3px solid transparent;
        transition: all 0.3s ease;
        font-weight: 500;
        white-space: nowrap;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        color: var(--primary-color);
        font-family: 'Montserrat', Arial, sans-serif;
    }

    .nav-item:hover {
        background: var(--accent-color);
        color: #fff;
    }

    .nav-item.active {
        border-bottom-color: var(--primary-color);
        color: #fff;
        background: var(--primary-color);
    }

    .admin-content {
        padding: 2rem;
    }

    .section-title {
        font-family: 'Lora', serif;
        font-size: 2rem;
        color: var(--primary-color);
        margin-bottom: 2rem;
        font-weight: 700;
    }

    .btn {
        background: var(--primary-color);
        color: #fff;
        padding: 0.7rem 1.5rem;
        border-radius: 25px;
        font-weight: 600;
        border: none;
        cursor: pointer;
        transition: background 0.2s;
        font-size: 1rem;
        box-shadow: var(--shadow-sm);
    }

    .btn-outline {
        background: transparent;
        border: 2px solid var(--primary-color);
        color: var(--primary-color);
    }

    .btn:hover,
    .btn-outline:hover {
        background: var(--accent-color);
        color: #222;
    }

    .card {
        background: #fff;
        border-radius: 16px;
        box-shadow: var(--shadow-md);
        margin-bottom: 2rem;
        overflow: hidden;
        border: 1.5px solid var(--border-color);
        transition: all 0.3s ease;
    }

    .card-header {
        padding: 1.5rem;
        background: var(--secondary-color);
        border-bottom: 1px solid var(--border-color);
        font-weight: 600;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .card-body {
        padding: 1.5rem;
    }
    .stats-grid {
    display: flex;
    gap: 2rem;
    margin-bottom: 2rem;
}
.stat-card {
    flex: 1;
    background: var(--accent-color);
    color: var(--primary-dark);
    border-radius: 16px;
    padding: 2rem 1.5rem;
    text-align: center;
    box-shadow: var(--shadow-sm);
    font-family: 'Montserrat', Arial, sans-serif;
}
.stat-value {
    font-size: 2.5rem;
    font-weight: 700;
    margin-bottom: 0.5rem;
}
.stat-label {
    font-size: 1.1rem;
    opacity: 0.8;
}

/* Gallery Grid */
.gallery-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
    gap: 1.5rem;
}
.gallery-item {
    position: relative;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: var(--shadow-sm);
    background: #fff;
    transition: transform 0.2s;
}
.gallery-item img {
    width: 100%;
    display: block;
    border-radius: 12px;
}
.gallery-item:hover {
    transform: translateY(-4px) scale(1.03);
    box-shadow: var(--shadow-md);
}
.gallery-overlay {
    position: absolute;
    top: 0; left: 0; right: 0; bottom: 0;
    background: rgba(57,91,100,0.7);
    color: #fff;
    opacity: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: opacity 0.2s;
}
.gallery-item:hover .gallery-overlay {
    opacity: 1;
}
.btn-danger.btn-sm {
    padding: 0.3rem 0.8rem;
    font-size: 0.95rem;
    border-radius: 16px;
    background: var(--danger-color);
    color: #fff;
    border: none;
    cursor: pointer;
}
.btn-danger.btn-sm:hover {
    background: #b91c1c;
}

/* Alerts */
.alert {
    padding: 1rem 1.5rem;
    border-radius: 8px;
    margin-bottom: 1rem;
    display: flex;
    align-items: center;
    gap: 0.7rem;
    font-size: 1rem;
}
.alert-success {
    background: #e0f7ef;
    color: #065f46;
    border: 1px solid #34d399;
}
.alert-error {
    background: #fef2f2;
    color: #b91c1c;
    border: 1px solid #ef4444;
}

/* Upload Area */
.upload-area {
    border: 2px dashed var(--accent-color);
    border-radius: 12px;
    padding: 2rem;
    text-align: center;
    background: #f5f7fa;
    cursor: pointer;
    transition: border-color 0.2s, background 0.2s;
    margin-bottom: 1rem;
    color: var(--primary-color);
}
.upload-area.dragover {
    border-color: var(--primary-color);
    background: #e0f7ef;
}
.upload-icon {
    font-size: 2.5rem;
    margin-bottom: 0.5rem;
    color: var(--primary-color);
}

/* Psalm Viewer */
.psalm-viewer {
    background: #fff;
    border-radius: 16px;
    box-shadow: var(--shadow-sm);
    padding: 2rem;
    margin-bottom: 2rem;
}
.psalm-header h2 {
    font-family: 'Lora', serif;
    color: var(--primary-color);
    margin-bottom: 0.5rem;
}
.psalm-controls {
    display: flex;
    gap: 1.5rem;
    align-items: flex-end;
    margin-bottom: 1.5rem;
    flex-wrap: wrap;
}
.form-group {
    display: flex;
    flex-direction: column;
    gap: 0.3rem;
    margin-bottom: 0.5rem;
}
.form-label {
    font-weight: 600;
    color: var(--primary-color);
}
.form-input, .form-select, textarea.form-input {
    padding: 0.7rem 1rem;
    border: 1.5px solid var(--border-color);
    border-radius: 8px;
    font-size: 1rem;
    font-family: 'Montserrat', Arial, sans-serif;
    background: #f5f7fa;
    color: var(--text-primary);
    outline: none;
    transition: border-color 0.2s;
}
.form-input:focus, .form-select:focus, textarea.form-input:focus {
    border-color: var(--primary-color);
}
.psalm-content {
    background: #f5f7fa;
    border-radius: 8px;
    padding: 1.5rem;
    min-height: 80px;
    font-size: 1.1rem;
    color: var(--text-secondary);
    white-space: pre-line;
}
.psalm-content.loading {
    display: flex;
    align-items: center;
    justify-content: center;
    min-height: 80px;
}
.spinner {
    border: 4px solid #e5e7eb;
    border-top: 4px solid var(--primary-color);
    border-radius: 50%;
    width: 32px;
    height: 32px;
    animation: spin 1s linear infinite;
}
@keyframes spin {
    to { transform: rotate(360deg); }
}

/* Responsive */
@media (max-width: 900px) {
    .stats-grid {
        flex-direction: column;
        gap: 1rem;
    }
    .psalm-controls {
        flex-direction: column;
        gap: 1rem;
    }
    .gallery-grid {
        grid-template-columns: repeat(auto-fit, minmax(140px, 1fr));
    }
}

    /* ...mantén el resto de estilos y adapta colores si es necesario... */
</style>
</head>
<body>
    <script>
document.addEventListener('DOMContentLoaded', function() {
    const user = JSON.parse(localStorage.getItem('usuario'));
    if (!user || user.email !== 'admin@dominio.com') {
        window.location.href = '/church/public/';
    }
});
</script>
    <div class="admin-container">
        <!-- Header -->
        <div class="admin-header">
            <div class="admin-title">
                <i class="fas fa-tachometer-alt"></i>
                Panel de Administración
            </div>
            <div class="admin-subtitle">Gestiona el contenido de tu sitio web</div>
            <div id="user-info" style="position:absolute; top:2rem; right:2rem; color:#fff; font-size:1rem;">
    <!-- Aquí se mostrará el correo -->
</div>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const user = JSON.parse(localStorage.getItem('usuario'));
    if (user && user.email) {
        document.getElementById('user-info').textContent = user.email;
    } else {
        document.getElementById('user-info').textContent = '';
    }
});
</script>
        </div>

        <!-- Navigation -->
<div class="admin-nav">
    <div class="nav-item active" data-section="dashboard">
        <i class="fas fa-home"></i>
        Dashboard
    </div>
    <div class="nav-item" data-section="gallery">
        <i class="fas fa-images"></i>
        Galería
    </div>
    <div class="nav-item" data-section="psalms">
        <i class="fas fa-book-open"></i>
        Salmos
    </div>
    <div class="nav-item" data-section="settings">
        <i class="fas fa-cog"></i>
        Configuración
    </div>
    <div class="nav-item" data-section="events">
        <i class="fas fa-calendar-alt"></i>
        Eventos
    </div>
</div>


        <!-- Content -->
        <div class="admin-content">
            <!-- Dashboard Section -->
            <div id="dashboard" class="section active">
                <div class="section-header">
                    <div class="section-title">
                        <i class="fas fa-chart-bar"></i>
                        Resumen General
                    </div>
                </div>
                
                <div class="stats-grid">
                    <div class="stat-card">
                        <div class="stat-value">{{ $images->count() }}</div>
                        <div class="stat-label">Imágenes en galería</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-value">{{ $users->count() }}</div>
                        <div class="stat-label">Usuarios</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-value">98%</div>
                        <div class="stat-label">Tiempo de actividad</div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <span><i class="fas fa-users"></i> Lista de Usuarios</span>
                    </div>
                    <div class="card-body">
                        @if($users->count())
                            <table style="width:100%; border-collapse:collapse;">
                                <thead>
                                    <tr style="background:#f3f4f6;">
                                        <th style="padding:8px; text-align:left; border-bottom:1px solid #e5e7eb;">ID</th>
                                        <th style="padding:8px; text-align:left; border-bottom:1px solid #e5e7eb;">Nombre</th>
                                        <th style="padding:8px; text-align:left; border-bottom:1px solid #e5e7eb;">Email</th>
                                        <th style="padding:8px; text-align:left; border-bottom:1px solid #e5e7eb;">Fecha de registro</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($users as $user)
                                        <tr>
                                            <td style="padding:8px; border-bottom:1px solid #e5e7eb;">{{ $user->id }}</td>
                                            <td style="padding:8px; border-bottom:1px solid #e5e7eb;">{{ $user->name }}</td>
                                            <td style="padding:8px; border-bottom:1px solid #e5e7eb;">{{ $user->email }}</td>
                                            <td style="padding:8px; border-bottom:1px solid #e5e7eb;">{{ $user->created_at->format('d/m/Y') }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <div style="color:var(--text-secondary);">No hay usuarios registrados.</div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Gallery Section -->
            <div id="gallery" class="section">
                <div class="section-header">
                    <div class="section-title">
                        <i class="fas fa-images"></i>
                        Editar Galería de Imágenes
                    </div>
                    <button class="btn btn-success" onclick="document.getElementById('fileInput').click()" type="button">
                        <i class="fas fa-upload"></i>
                        Subir Imágenes
                    </button>
                </div>

                <!-- Mensajes de éxito o error -->
                @if(session('success'))
                    <div class="alert alert-success">
                        <i class="fas fa-check-circle"></i>
                        {{ session('success') }}
                    </div>
                @endif
                @if($errors->any())
                    <div class="alert alert-error">
                        <i class="fas fa-exclamation-triangle"></i>
                        @foreach($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                    </div>
                @endif

                <!-- Área de subida moderna -->
                <form class="upload-form" action="{{ route('gallery.upload') }}" method="POST" enctype="multipart/form-data" style="margin-bottom:2rem;">
                    @csrf
                    <label for="fileInput" class="upload-area" id="uploadArea">
                        <div class="upload-icon"><i class="fas fa-cloud-upload-alt"></i></div>
                        <div>
                            <strong>Arrastra imágenes aquí</strong> o haz clic para seleccionar archivos
                        </div>
                        <input id="fileInput" type="file" name="images[]" multiple accept="image/*" style="display:none;" required>
                    </label>
                    <div style="text-align:right; margin-top:1rem;">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-upload"></i>
                            Subir Imágenes
                        </button>
                    </div>
                </form>
                <div id="uploadSuccess" class="alert alert-success" style="display:none;">
                    <i class="fas fa-check-circle"></i>
                    Imágenes subidas correctamente.
                </div>

                <!-- Mostrar imágenes actuales -->
                <div class="gallery-grid">
                    @forelse($images as $image)
                        <div class="gallery-item">
                            <img src="{{ asset('uploads/' . $image->filename) }}" alt="Imagen de galería">
                            <div class="gallery-overlay">
                                <form action="{{ route('gallery.delete', $image->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm" title="Eliminar" onclick="return confirm('¿Eliminar esta imagen?')">
                                        <i class="fas fa-trash-alt"></i> Eliminar
                                    </button>
                                </form>
                            </div>
                        </div>
                    @empty
                        <div style="grid-column: 1/-1; text-align:center; color:var(--text-secondary); padding:2rem;">
                            <i class="fas fa-image" style="font-size:2rem; margin-bottom:0.5rem;"></i>
                            <div>No hay imágenes en la galería.</div>
                        </div>
                    @endforelse
                </div>
            </div>
            <!-- Psalms Section -->
            <div id="psalms" class="section">
                <div class="section-header">
                    <div class="section-title">
                        <i class="fas fa-book-open"></i>
                        Visor de Salmos
                    </div>
                </div>

                <div class="psalm-viewer">
                    <div class="psalm-header">
                        <h2>Salmo de la Semana</h2>
                        <p>Selecciona y comparte la palabra de Dios</p>
                    </div>
                    
                    <div class="psalm-controls">
                        <div class="form-group">
                            <label class="form-label" for="psalmType">Tipo de búsqueda</label>
                            <select class="form-select" id="psalmType">
                                <option value="capitulo">Capítulo completo</option>
                                <option value="versiculo">Un solo versículo</option>
                                <option value="rango">Rango de versículos</option>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label" for="psalmRef">Referencia</label>
                            <div style="display: flex; align-items: center;">
                                <span style="padding: 0.75rem 1rem; background: #f3f4f6; border: 2px solid var(--border-color); border-radius: 8px 0 0 8px; font-weight: bold;">psa.</span>
                                <input type="text" class="form-input" id="psalmRef" value="1" placeholder="Ej: 1, 1.3, 1.3-1.5" style="border-radius: 0 8px 8px 0; border-left: none;">
                            </div>
                        </div>
                        
                        <button class="btn btn-primary" id="loadPsalm">
                            <i class="fas fa-search"></i>
                            Cargar Salmo
                        </button>
                        <button class="btn btn-success" id="copyPsalm" title="Copiar al portapapeles" style="margin-left: 1rem;">
                            <i class="fas fa-copy"></i>
                        </button>
                    </div>
                    
                    <div class="psalm-content" id="psalmContent">
                        Selecciona un salmo para ver su contenido aquí
                    </div>
                </div>
            </div>
            <script>
                const API_KEY = 'eb7a9aa09923bf71df88e1f36e6df98f';
                const BIBLE_ID = '48acedcf8595c754-02';
                const psalmContent = document.getElementById('psalmContent');
                const psalmRefInput = document.getElementById('psalmRef');
                const psalmType = document.getElementById('psalmType');
                const btnLoad = document.getElementById('loadPsalm');
                const btnCopy = document.getElementById('copyPsalm');
                let currentPsalmText = '';

                function showPsalmLoader() {
                    psalmContent.innerHTML = '';
                    psalmContent.classList.add('loading');
                    const loader = document.createElement('div');
                    loader.className = 'spinner';
                    psalmContent.appendChild(loader);
                }

                function showPsalmError(msg) {
                    psalmContent.classList.remove('loading');
                    psalmContent.innerHTML = `<div class="alert alert-error"><i class="fas fa-exclamation-circle"></i> ${msg}</div>`;
                }

                function fetchPsalm(ref, type) {
                    if (!ref.trim()) {
                        showPsalmError('Por favor, introduce una referencia válida.');
                        return;
                    }
                    showPsalmLoader();

                    let reference = 'psa.' + ref.trim();
                    let url = '';
                    if (type === 'capitulo') {
                        url = `https://api.scripture.api.bible/v1/bibles/${BIBLE_ID}/chapters/${reference}?content-type=html&include-notes=false&include-titles=true&include-chapter-numbers=false&include-verse-numbers=true&include-verse-spans=false`;
                    } else if (type === 'versiculo' || type === 'rango') {
                        url = `https://api.scripture.api.bible/v1/bibles/${BIBLE_ID}/passages/${reference}?content-type=html&include-notes=false&include-titles=true&include-chapter-numbers=false&include-verse-numbers=true&include-verse-spans=false`;
                    } else {
                        showPsalmError('Tipo de búsqueda no soportado.');
                        return;
                    }

                    fetch(url, {
                        headers: {
                            'api-key': API_KEY,
                            'Accept': 'application/json'
                        }
                    })
                    .then(resp => {
                        if (!resp.ok) throw new Error(`Error ${resp.status}: ${resp.statusText}`);
                        return resp.json();
                    })
                .then(data => {
                    psalmContent.classList.remove('loading');
                    let html = data.data.content;
                    const tmp = document.createElement('div');
                    tmp.innerHTML = html;
                    const versos = Array.from(tmp.querySelectorAll('p'))
                        .filter(p => p.innerText.trim().length > 0)
                        .map(p => p.innerText.trim())
                        .join('\n\n');
                    currentPsalmText = versos;
                    psalmContent.textContent = versos;

                    // Guardar el Salmo en localStorage para Church.blade.php
                    const psalmData = {
                        reference: data.data.reference,
                        book: data.data.bookname,
                        verses: versos
                    };
                    localStorage.setItem('salmoSemana', JSON.stringify(psalmData));
                })
                    .catch(err => {
                        psalmContent.classList.remove('loading');
                        showPsalmError(`Error al cargar: ${err.message}`);
                    });
                }

                btnLoad.addEventListener('click', function() {
                    fetchPsalm(psalmRefInput.value, psalmType.value);
                });

                btnCopy.addEventListener('click', function() {
                    if (!currentPsalmText) return;
                    navigator.clipboard.writeText(currentPsalmText)
                        .then(() => {
                            const original = btnCopy.innerHTML;
                            btnCopy.innerHTML = '<i class="fas fa-check"></i>';
                            setTimeout(() => {
                                btnCopy.innerHTML = original;
                            }, 1500);
                        });
                });

                psalmRefInput.addEventListener('keypress', function(e) {
                    if (e.key === 'Enter') {
                        fetchPsalm(psalmRefInput.value, psalmType.value);
                    }
                });

                // Cambia el prefijo psa. según el tipo seleccionado
                psalmType.addEventListener('change', function() {
                    if (psalmType.value === 'versiculo') {
                        // Si no tiene el prefijo, lo agrega
                        if (!psalmRefInput.value.toUpperCase().startsWith('PSA.')) {
                            psalmRefInput.value = 'PSA.' + psalmRefInput.value.replace(/^psa\./i, '');
                        }
                    } else {
                        // Si cambia a otro tipo, quita el prefijo si estaba
                        psalmRefInput.value = psalmRefInput.value.replace(/^psa\./i, '');
                    }
                });

                document.addEventListener('DOMContentLoaded', function() {
                    fetchPsalm(psalmRefInput.value, psalmType.value);
                });
            </script>
            
            <!-- Settings Section -->
            <div id="settings" class="section">
                <div class="section-header">
                    <div class="section-title">
                        <i class="fas fa-cog"></i>
                        Configuración del Sitio
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <span><i class="fas fa-palette"></i> Apariencia</span>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label class="form-label">Tema del sitio</label>
                            <select class="form-select">
                                <option>Claro</option>
                                <option>Oscuro</option>
                                <option>Automático</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <span><i class="fas fa-database"></i> Base de Datos</span>
                    </div>
                    <div class="card-body">
                        <button class="btn btn-success">
                            <i class="fas fa-download"></i>
                            Exportar Datos
                        </button>
                        <button class="btn btn-warning" style="margin-left: 1rem;">
                            <i class="fas fa-sync-alt"></i>
                            Limpiar Caché
                        </button>
                    </div>
                </div>
            </div>
            <!-- filepath: c:\xampp\htdocs\Test\resources\views\admin\dashboard.blade.php -->
<div id="events" class="section" style="min-height: 70vh;">
    <div class="section-header">
        <div class="section-title">
            <i class="fas fa-calendar-alt"></i>
            Gestión de Eventos
        </div>
        <button class="btn btn-success" onclick="showEventForm()">Crear Evento</button>
    </div>
    <div style="margin-bottom:2rem; text-align:center; color:var(--text-secondary);">
        <i class="fas fa-info-circle" style="font-size:2rem; margin-bottom:0.5rem;"></i>
        <div>Aquí puedes ver, crear y administrar los próximos eventos de tu comunidad.<br>
        Haz clic en <b>Crear Evento</b> para añadir uno nuevo.</div>
    </div>
    <div id="events-list"></div>

    <!-- Modal para crear/editar evento -->
    <div id="event-modal" style="display:none; position:fixed; top:0; left:0; width:100vw; height:100vh; background:rgba(0,0,0,0.4); align-items:center; justify-content:center; z-index:9999;">
        <form id="event-form" style="background:#fff; padding:2rem; border-radius:12px; min-width:320px; max-width:90vw;">
            <input type="hidden" id="event-id">
            <div class="form-group">
                <label>Fecha</label>
                <input type="date" id="event-date" class="form-input" required>
            </div>
            <div class="form-group">
                <label>Nombre</label>
                <input type="text" id="event-name" class="form-input" required>
            </div>
            <div class="form-group">
                <label>Hora</label>
                <input type="text" id="event-time" class="form-input" placeholder="Ej: Todo el día o 10:00-18:00" required>
            </div>
            <div class="form-group">
                <label>Lugar</label>
                <input type="text" id="event-place" class="form-input" required>
            </div>
            <div class="form-group">
                <label>Descripción</label>
                <textarea id="event-description" class="form-input" required></textarea>
            </div>
            <div style="margin-top:1rem;">
                <button type="submit" class="btn btn-primary">Guardar</button>
                <button type="button" class="btn btn-danger" onclick="hideEventForm()">Cancelar</button>
            </div>
        </form>
    </div>
    <script>
        // Sobrescribe fetchEvents para mostrar mensaje si no hay eventos
        function fetchEvents() {
            fetch('/admin/events')
                .then(res => res.json())
                .then(events => {
                    if (!events.length) {
                        eventsList.innerHTML = `<div style="color:var(--text-secondary);text-align:center;padding:2rem;">
                            <i class="fas fa-calendar-times" style="font-size:2rem; margin-bottom:0.5rem;"></i>
                            <div>Aún no hay eventos programados.<br>¡Crea el primero para tu comunidad!</div>
                        </div>`;
                        return;
                    }
                    eventsList.innerHTML = events.map(event => `
                        <div class="card" style="margin-bottom:1rem;">
                            <div class="card-header">
                                <strong>${formatDate(event.date)}</strong> - ${event.name}
                                <div>
                                    <button class="btn btn-sm btn-primary" onclick="editEvent(${event.id})">Editar</button>
                                    <button class="btn btn-sm btn-danger" onclick="deleteEvent(${event.id})">Borrar</button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div>🕒 ${event.time}</div>
                                <div>📍 ${event.place}</div>
                                <div>${event.description}</div>
                            </div>
                        </div>
                    `).join('');
                });
        }
    </script>
</div>

        </div>

            
    </div>
    
    

    <script>
        // Navigation functionality
        function showSection(sectionId) {
            // Hide all sections
            document.querySelectorAll('.section').forEach(section => {
                section.classList.remove('active');
            });
            
            // Remove active class from nav items
            document.querySelectorAll('.nav-item').forEach(item => {
                item.classList.remove('active');
            });
            
            // Show selected section
            document.getElementById(sectionId).classList.add('active');
            
            // Add active class to clicked nav item
            event.target.classList.add('active');
        }

        // File upload functionality
        document.getElementById('fileInput').addEventListener('change', function(e) {
            const files = e.target.files;
            if (files.length > 0) {
                // Show success message
                document.getElementById('uploadSuccess').style.display = 'flex';
                setTimeout(() => {
                    document.getElementById('uploadSuccess').style.display = 'none';
                }, 3000);
            }
        });

        // Drag and drop functionality
        const uploadArea = document.querySelector('.upload-area');
        
        uploadArea.addEventListener('dragover', (e) => {
            e.preventDefault();
            uploadArea.classList.add('dragover');
        });
        
        uploadArea.addEventListener('dragleave', () => {
            uploadArea.classList.remove('dragover');
        });
        
        uploadArea.addEventListener('drop', (e) => {
            e.preventDefault();
            uploadArea.classList.remove('dragover');
            const files = e.dataTransfer.files;
            if (files.length > 0) {
                document.getElementById('uploadSuccess').style.display = 'flex';
                setTimeout(() => {
                    document.getElementById('uploadSuccess').style.display = 'none';
                }, 3000);
            }
        });

        // Psalm loading functionality
        document.getElementById('loadPsalm').addEventListener('click', function() {
            const psalmContent = document.getElementById('psalmContent');
            const psalmRef = document.getElementById('psalmRef').value;
            
            // Show loading state
            psalmContent.innerHTML = '<div class="loading"><div class="spinner"></div></div>';
            
            // Simulate API call

        });

        // Initialize with sample data
        document.addEventListener('DOMContentLoaded', function() {
            // You can add initialization code here
            console.log('Admin panel loaded successfully');
        });
    </script>
    <script>
const eventsList = document.getElementById('events-list');
const eventModal = document.getElementById('event-modal');
const eventForm = document.getElementById('event-form');
const csrf = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

function fetchEvents() {
    fetch('/Test/public/admin/events')
        .then(res => res.json())
        .then(events => {
            eventsList.innerHTML = events.map(event => `
                <div class="card" style="margin-bottom:1rem;">
                    <div class="card-header">
                        <strong>${formatDate(event.date)}</strong> - ${event.name}
                        <div>
                            <button class="btn btn-sm btn-primary" onclick="editEvent(${event.id})">Editar</button>
                            <button class="btn btn-sm btn-danger" onclick="deleteEvent(${event.id})">Borrar</button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div>🕒 ${event.time}</div>
                        <div>📍 ${event.place}</div>
                        <div>${event.description}</div>
                    </div>
                </div>
            `).join('');
        });
}

function formatDate(dateStr) {
    const d = new Date(dateStr);
    return d.toLocaleDateString('es-ES', { day: '2-digit', month: 'short' });
}

function showEventForm(event = null) {
    eventModal.style.display = 'flex';
    eventForm.reset();
    document.getElementById('event-id').value = event ? event.id : '';
    document.getElementById('event-date').value = event ? event.date : '';
    document.getElementById('event-name').value = event ? event.name : '';
    document.getElementById('event-time').value = event ? event.time : '';
    document.getElementById('event-place').value = event ? event.place : '';
    document.getElementById('event-description').value = event ? event.description : '';
}

function hideEventForm() {
    eventModal.style.display = 'none';
}

eventForm.onsubmit = function(e) {
    e.preventDefault();
    const id = document.getElementById('event-id').value;
    const data = {
        date: document.getElementById('event-date').value,
        name: document.getElementById('event-name').value,
        time: document.getElementById('event-time').value,
        place: document.getElementById('event-place').value,
        description: document.getElementById('event-description').value,
    };
    fetch(id ? `/Test/public/admin/events/${id}` : '/Test/public/admin/events', {
        method: id ? 'PUT' : 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrf
        },
        body: JSON.stringify(data)
    })
    .then(res => res.json())
    .then(() => {
        hideEventForm();
        fetchEvents();
    });
};

window.editEvent = function(id) {
    fetch(`/Test/public/admin/events`)
        .then(res => res.json())
        .then(events => {
            const event = events.find(ev => ev.id === id);
            showEventForm(event);
        });
};

window.deleteEvent = function(id) {
    if (!confirm('¿Seguro que deseas borrar este evento?')) return;
    fetch(`/Test/public/admin/events/${id}`, {
        method: 'DELETE',
        headers: { 'X-CSRF-TOKEN': csrf }
    })
    .then(res => res.json())
    .then(() => fetchEvents());
};

document.addEventListener('DOMContentLoaded', fetchEvents);
</script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const navItems = document.querySelectorAll('.admin-nav .nav-item');
    const sections = document.querySelectorAll('.section');

    navItems.forEach(item => {
        item.addEventListener('click', function() {
            // Quitar activo de todos
            navItems.forEach(i => i.classList.remove('active'));
            // Poner activo al actual
            this.classList.add('active');
            // Ocultar todas las secciones
            sections.forEach(sec => sec.classList.remove('active'));
            // Mostrar la sección correspondiente
            const sectionId = this.getAttribute('data-section');
            const section = document.getElementById(sectionId);
            if (section) section.classList.add('active');
        });
    });
});
</script>
</body>
</html>