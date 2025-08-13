<!-- Eliminado bloque duplicado de eventos y tabla de registros aquí. Todo va dentro de admin-content abajo. -->
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
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>
<body>
    <script>
document.addEventListener('DOMContentLoaded', function() {
    // Refuerzo: limpiar localStorage['usuario'] al cerrar sesión
    // Busca enlaces o botones de logout y limpia el usuario
    const logoutLinks = Array.from(document.querySelectorAll('a,button')).filter(el => {
        return (el.href && el.href.match(/logout/i)) || (el.onclick && el.onclick.toString().match(/logout/i)) || (el.innerText && el.innerText.match(/cerrar sesión|logout/i));
    });
    logoutLinks.forEach(el => {
        el.addEventListener('click', function() {
            localStorage.removeItem('usuario');
        });
    });

    // Siempre reconstruir el usuario desde Blade (Laravel) si hay sesión, y sobrescribir localStorage
    const bladeUser = {
        @auth
        email: @json(auth()->user()->email),
        perfil: @json(auth()->user()->perfil ?? (auth()->user()->role ?? '')),
        name: @json(auth()->user()->name),
        id: @json(auth()->user()->id)
        @else
        email: null,
        perfil: null,
        name: null,
        id: null
        @endauth
    };
    if (bladeUser.email && bladeUser.perfil) {
        localStorage.setItem('usuario', JSON.stringify(bladeUser));
        user = bladeUser;
    } else {
        // Si no hay sesión, limpiar localStorage
        localStorage.removeItem('usuario');
        user = null;
    }

    // DEBUG oculto: Solo en consola, no en pantalla
    // console.log('Usuario localStorage:', user);
    let debugDiv = document.getElementById('debug-user-info');
    if (debugDiv) {
        debugDiv.style.display = 'none';
    }
    const allowedProfiles = ['Admin', 'Salmos', 'Gestor', 'Galeria', 'Eventos'];
    if (!user || !user.email || !user.perfil || !allowedProfiles.includes(user.perfil)) {
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
            <div class="admin-header-right" style="display:flex; align-items:center; gap:1.2rem;">
                <button onclick="window.location.href='/church/public/'" id="btn-volver-inicio" style="margin-top:0.2rem; margin-bottom:0.2rem; background:#181818; color:#fff; border:2px solid #181818; font-weight:600; border-radius:25px; padding:0.7rem 1.5rem; transition:background 0.2s, color 0.2s; cursor:pointer;">
                    <i class="fas fa-arrow-left"></i> Volver al Inicio
                </button>
                <div id="user-info" style="color:#fff; font-size:1rem;"></div>
            </div>
            <style>
            #btn-volver-inicio:hover {
                background: #FF3B3F !important;
                color: #181818 !important;
                border: 2px solid #181818 !important;
            }
            </style>
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
        @php
            $perfil = null;
            if (auth()->check()) {
                $perfil = auth()->user()->perfil ?? (auth()->user()->role ?? null);
            } else if (isset($_COOKIE['usuario'])) {
                $userCookie = json_decode($_COOKIE['usuario'], true);
                $perfil = $userCookie['perfil'] ?? null;
            }
        @endphp
        @if($perfil === 'Admin')
            <div class="nav-item active" data-section="dashboard"><i class="fas fa-home"></i>Dashboard</div>
            <div class="nav-item" data-section="gallery"><i class="fas fa-images"></i>Galería</div>
            <div class="nav-item" data-section="psalms"><i class="fas fa-book-open"></i>Salmos</div>
            <div class="nav-item" data-section="settings"><i class="fas fa-cog"></i>Configuración</div>
            <div class="nav-item" data-section="events"><i class="fas fa-calendar-alt"></i>Noticias</div>
            <div class="nav-item" data-section="contacto"><i class="fas fa-envelope"></i>Contacto</div>
        @elseif($perfil === 'Salmos')
            <div class="nav-item active" data-section="psalms"><i class="fas fa-book-open"></i>Salmos</div>
        @elseif($perfil === 'Gestor')
            <div class="nav-item active" data-section="dashboard"><i class="fas fa-home"></i>Dashboard</div>
            <div class="nav-item" data-section="settings"><i class="fas fa-cog"></i>Configuración</div>
        @elseif($perfil === 'Galeria')
            <div class="nav-item active" data-section="gallery"><i class="fas fa-images"></i>Galería</div>
        @elseif($perfil === 'Eventos')
            <div class="nav-item active" data-section="events"><i class="fas fa-calendar-alt"></i>Noticias</div>
        @endif
    </div>

    <script>
    // Navegación de pestañas: solo permite navegar entre las permitidas y redirige a la pestaña correcta al cargar
    document.addEventListener('DOMContentLoaded', function() {
        let user = null;
        try {
            user = JSON.parse(localStorage.getItem('usuario'));
        } catch (e) {}
        const navItems = document.querySelectorAll('.admin-nav .nav-item');
        const sections = document.querySelectorAll('.section');
        // Oculta y desactiva todas las secciones
        navItems.forEach(i => i.classList.remove('active'));
        sections.forEach(sec => sec.classList.remove('active'));

        // Determina la sección permitida según el perfil
        let allowedSection = null;
        if (user && user.perfil) {
            if (user.perfil === 'Admin') allowedSection = 'dashboard';
            else if (user.perfil === 'Salmos') allowedSection = 'psalms';
            else if (user.perfil === 'Gestor') allowedSection = 'dashboard';
            else if (user.perfil === 'Galeria') allowedSection = 'gallery';
            else if (user.perfil === 'Eventos') allowedSection = 'events';
        }
        // Activa solo la sección y pestaña permitida
        if (allowedSection) {
            const nav = document.querySelector('.admin-nav .nav-item[data-section="'+allowedSection+'"]');
            const sec = document.getElementById(allowedSection);
            if (nav) nav.classList.add('active');
            if (sec) sec.classList.add('active');
        }

        // Solo permite click en la pestaña permitida (o todas si es Admin)
        navItems.forEach(item => {
            item.addEventListener('click', function(e) {
                if (user && user.perfil === 'Admin') {
                    // Admin puede navegar entre todas
                    navItems.forEach(i => i.classList.remove('active'));
                    sections.forEach(sec => sec.classList.remove('active'));
                    item.classList.add('active');
                    const sec = document.getElementById(item.getAttribute('data-section'));
                    if (sec) sec.classList.add('active');
                } else {
                    // Otros perfiles: solo puede activar su pestaña
                    if (item.classList.contains('active')) {
                        // Ya está activa, no hace nada
                        return;
                    } else {
                        // Redirige a la permitida
                        if (allowedSection) {
                            const nav = document.querySelector('.admin-nav .nav-item[data-section="'+allowedSection+'"]');
                            const sec = document.getElementById(allowedSection);
                            navItems.forEach(i => i.classList.remove('active'));
                            sections.forEach(sec => sec.classList.remove('active'));
                            if (nav) nav.classList.add('active');
                            if (sec) sec.classList.add('active');
                        }
                    }
                }
            });
        });
    });
    </script>
            <!-- Contacto Section -->
            <div id="contacto" class="section">
                <div class="section-header">
                    <div class="section-title">
                        <i class="fas fa-envelope"></i>
                        Mensajes de Contacto
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <span><i class="fas fa-inbox"></i> Mensajes recibidos</span>
                    </div>
                    <div class="card-body">
                        @if(isset($messages) && $messages->count())
                            <div style="overflow-x:auto;">
                            <table style="width:100%; border-collapse:collapse;">
                                <thead>
                                    <tr style="background:#232323;">
                                        <!-- <th style="padding:8px; text-align:left; border-bottom:1px solid #e5e7eb;">ID</th> -->
                                        <th style="padding:8px; text-align:left; border-bottom:1px solid #e5e7eb;">Nombre</th>
                                        <th style="padding:8px; text-align:left; border-bottom:1px solid #e5e7eb;">Email</th>
                                        <th style="padding:8px; text-align:left; border-bottom:1px solid #e5e7eb;">Mensaje</th>
                                        <th style="padding:8px; text-align:left; border-bottom:1px solid #e5e7eb;">Fecha</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($messages as $msg)
                                        <tr>
                                            <!-- <td style="padding:8px; border-bottom:1px solid #e5e7eb;">{{ $msg->id }}</td> -->
                                            <td style="padding:8px; border-bottom:1px solid #e5e7eb;">{{ $msg->name }}</td>
                                            <td style="padding:8px; border-bottom:1px solid #e5e7eb;">{{ $msg->email }}</td>
                                            <td style="padding:8px; border-bottom:1px solid #e5e7eb; white-space:pre-line; max-width:320px;">{{ $msg->message }}</td>
                                            <td style="padding:8px; border-bottom:1px solid #e5e7eb;">{{ $msg->created_at->format('d/m/Y H:i') }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            </div>
                        @else
                            <div style="color:var(--text-secondary);">No hay mensajes de contacto.</div>
                        @endif
                    </div>
                </div>
            </div>


        <!-- Content -->
    <div class="admin-content">
        <!-- Contacto Section (moved here for visibility) -->
        <div id="contacto" class="section">
            <div class="section-header">
                <div class="section-title">
                    <i class="fas fa-envelope"></i>
                    Mensajes de Contacto
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <span><i class="fas fa-inbox"></i> Mensajes recibidos</span>
                </div>
                <div class="card-body">
                    @if(isset($messages) && $messages->count())
                        <div style="overflow-x:auto;">
                        <table style="width:100%; border-collapse:collapse;">
                            <thead>
                                <tr style="background:#232323;">
                                    <!-- <th style="padding:8px; text-align:left; border-bottom:1px solid #e5e7eb;">ID</th> -->
                                    <th style="padding:8px; text-align:left; border-bottom:1px solid #e5e7eb;">Nombre</th>
                                    <th style="padding:8px; text-align:left; border-bottom:1px solid #e5e7eb;">Email</th>
                                    <th style="padding:8px; text-align:left; border-bottom:1px solid #e5e7eb;">Mensaje</th>
                                    <th style="padding:8px; text-align:left; border-bottom:1px solid #e5e7eb;">Fecha</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($messages as $msg)
                                    <tr>
                                        <!-- <td style="padding:8px; border-bottom:1px solid #e5e7eb;">{{ $msg->id }}</td> -->
                                        <td style="padding:8px; border-bottom:1px solid #e5e7eb;">{{ $msg->name }}</td>
                                        <td style="padding:8px; border-bottom:1px solid #e5e7eb;">{{ $msg->email }}</td>
                                        <td style="padding:8px; border-bottom:1px solid #e5e7eb; white-space:pre-line; max-width:320px;">{{ $msg->message }}</td>
                                        <td style="padding:8px; border-bottom:1px solid #e5e7eb;">{{ $msg->created_at->format('d/m/Y H:i') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        </div>
                    @else
                        <div style="color:var(--text-secondary);">No hay mensajes de contacto.</div>
                    @endif
                </div>
            </div>
        </div>
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
                                    <tr style="background:#232323;">
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
                <form class="upload-form" action="{{ route('gallery.upload') }}" method="POST" enctype="multipart/form-data" style="margin-bottom:2rem; display:flex; gap:1rem; align-items:center;">
                    @csrf
                    <div class="upload-area" onclick="document.getElementById('fileInput').click()" style="flex:1; margin-bottom:0; border:2px dashed var(--primary-color); background:#181818; color:var(--primary-color); border-radius:12px; padding:1.5rem; display:flex; flex-direction:column; align-items:center; justify-content:center; cursor:pointer; transition:border-color 0.2s, background 0.2s;">
                        <i class="fas fa-cloud-upload-alt upload-icon" style="color:var(--primary-color); font-size:2.5rem; margin-bottom:0.5rem;"></i>
                        <span style="font-weight:600; font-size:1.1rem;">Arrastra o haz clic para seleccionar imágenes</span>
                        <span style="font-size:0.95rem; color:#b91c1c; margin-top:0.3rem;">Formatos permitidos: JPG, PNG, GIF</span>
                        <input id="fileInput" type="file" name="images[]" multiple accept="image/*" required style="display:none;">
                        <div id="previewContainer" style="margin-top:1rem; display:none; flex-direction:column; align-items:center; width:100%;"></div>
                    </div>
                    <select name="categoria" id="categoria" class="form-input" style="max-width:180px; display:none;">
                        <option value="especiales">Especiales</option>
                        <option value="niños">Niños</option>
                        <option value="mujeres">Mujeres</option>
                        <option value="hombres">Hombres</option>
                    </select>
                    <button type="submit" class="btn btn-success"><i class="fas fa-upload"></i> Subir Imágenes</button>
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
                            <div style="font-size:0.95rem; color:#4ade80; margin-top:0.3rem; text-align:center;">
                                {{ $image->categoria ?? 'Sin categoría' }}
                            </div>
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
            <!-- Imagen editable del salmo -->
            <form id="psalm-image-form" style="margin-bottom:1.5rem; display:flex; flex-direction:column; gap:0.5rem; max-width:250px;">
                <label for="psalm-image-input" style="color:var(--primary-color);font-weight:600;">Imagen del Salmo:</label>
                <input type="file" id="psalm-image-input" accept="image/*" class="form-input">
                <div id="psalm-image-preview" style="margin-top:0.5rem; min-height:40px;"></div>
                <button type="button" id="psalm-image-save" class="btn btn-success" style="margin-top:0.5rem; align-self:flex-start;"><i class="fas fa-save"></i> Guardar imagen</button>
            </form>
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
                    <span style="padding: 0.75rem 1rem; background: #232323; border: 2px solid var(--border-color); border-radius: 8px 0 0 8px; font-weight: bold;">psa.</span>
                <input type="text" class="form-input" id="psalmRef" placeholder="Ej: 1" style="border-radius: 0 8px 8px 0; border-left: none;">
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
        <!-- Reflexión editable para el salmo -->
<form id="reflection-form-admin" style="margin-top:2rem;">
    <label for="reflection-input-admin" style="color:var(--primary-color);font-weight:600; display:block; margin-bottom:0.7rem;">Modificar reflexión del salmo:</label>
    <textarea id="reflection-input-admin" class="form-input" rows="7" style="min-height:150px; width:100%; max-width:100%; display:block; margin-bottom:0.7rem;">Este salmo nos recuerda que Dios es nuestro proveedor y protector. Cuando confiamos en Él como nuestro pastor, encontramos paz y renovación para nuestras almas. Esta semana, reflexionemos sobre cómo Dios nos guía y nos da descanso en medio de nuestras ocupadas vidas.</textarea>
    <button type="submit" class="btn btn-outline" style="margin-top:0.5rem;">Guardar reflexión</button>
</form>
<p class="psalm-reflection-admin" style="color: var(--primary-color); margin-top:1rem; font-style:italic;"></p>
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
                    let placeholder = '';
                    if (psalmType.value === 'capitulo') {
                        placeholder = 'Ej: 1';
                        psalmRefInput.value = '1';
                    } else if (psalmType.value === 'versiculo') {
                        placeholder = 'Ej: 1.3';
                        psalmRefInput.value = '1.3';
                    } else if (psalmType.value === 'rango') {
                        placeholder = 'Ej: 1.3-psa.1.5';
                        psalmRefInput.value = '1.3-psa.1.5';
                    }
                    psalmRefInput.placeholder = placeholder;
                });

                document.addEventListener('DOMContentLoaded', function() {
                    // Restaurar último salmo consultado (referencia, tipo y contenido) desde localStorage
                    let lastPsalm = null;
                    try {
                        lastPsalm = JSON.parse(localStorage.getItem('salmoSemana'));
                    } catch(e) { lastPsalm = null; }
                    if (lastPsalm && lastPsalm.reference && lastPsalm.verses) {
                        // Detectar tipo de búsqueda según el formato de referencia
                        let type = 'capitulo';
                        let ref = lastPsalm.reference.replace(/^psa\./i, '');
                        if (/\d+\.\d+-psa\.\d+\.\d+/.test(ref)) type = 'rango';
                        else if (/\d+\.\d+/.test(ref)) type = 'versiculo';
                        else type = 'capitulo';
                        psalmType.value = type;
                        psalmRefInput.value = ref;
                        psalmRefInput.placeholder = type === 'capitulo' ? 'Ej: 1' : (type === 'versiculo' ? 'Ej: 1.3' : 'Ej: 1.3-psa.1.5');
                        psalmContent.textContent = lastPsalm.verses;
                        currentPsalmText = lastPsalm.verses;
                    } else {
                        psalmType.value = 'capitulo';
                        psalmRefInput.value = '1';
                        psalmRefInput.placeholder = 'Ej: 1';
                        fetchPsalm('1', 'capitulo');
                    }
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
            Gestión de Noticias
        </div>
        <button class="btn btn-success" onclick="showEventForm()">Crear Noticia</button>
    </div>
    <div style="margin-bottom:2rem; text-align:center; color:var(--text-secondary);">
        <i class="fas fa-info-circle" style="font-size:2rem; margin-bottom:0.5rem;"></i>
        <div>Aquí puedes ver, crear y administrar las noticias y próximos eventos de tu comunidad.<br>
        Haz clic en <b>Crear Noticia</b> para añadir una nueva.</div>
    </div>
    <div id="events-list"></div>

    @php
        use App\Models\Event;
        $eventos = Event::with('registrations')->orderBy('created_at', 'desc')->get(); // Orden descendente: más reciente arriba
    @endphp

    @if(isset($perfil) && $perfil === 'Admin')
    <div class="card" style="margin-top:2.5rem;">
        <div class="card-header" style="color:#FF3B3F; font-weight:700; font-size:1.2rem;">
            <i class="fas fa-users"></i> Personas registradas en eventos
        </div>
        <div class="card-body" style="overflow-x:auto;">
            @forelse($eventos as $ev)
                @if($ev->registrations && count($ev->registrations))
                    <div style="margin-bottom:2.2rem;">
                        <div style="font-weight:600; color:#FF3B3F; font-size:1.08rem; margin-bottom:0.5rem;">
                            <i class="fas fa-calendar-alt"></i> {{ $ev->name }} ({{ \Carbon\Carbon::parse($ev->date)->format('d/m/Y') }})
                        </div>
                        <table style="width:100%; border-collapse:collapse;">
                            <thead>
                                <tr style="background:#232323; color:#FF3B3F;">
                                    <th style="padding:8px; text-align:left; border-bottom:1px solid #e5e7eb;">Nombre</th>
                                    <th style="padding:8px; text-align:left; border-bottom:1px solid #e5e7eb;">Correo</th>
                                    <th style="padding:8px; text-align:left; border-bottom:1px solid #e5e7eb;">Teléfono</th>
                                    <th style="padding:8px; text-align:left; border-bottom:1px solid #e5e7eb;">Fecha de registro</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($ev->registrations as $reg)
                                    <tr>
                                        <td style="padding:8px; border-bottom:1px solid #e5e7eb;">{{ $reg->name }}</td>
                                        <td style="padding:8px; border-bottom:1px solid #e5e7eb;">{{ $reg->email }}</td>
                                        <td style="padding:8px; border-bottom:1px solid #e5e7eb;">{{ $reg->phone }}</td>
                                        <td style="padding:8px; border-bottom:1px solid #e5e7eb;">{{ $reg->created_at ? \Carbon\Carbon::parse($reg->created_at)->format('d/m/Y H:i') : '' }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            @empty
                <div style="color:#b91c1c;">No hay registros de eventos.</div>
            @endforelse
        </div>
    </div>
    @endif

    <!-- Modal para crear/editar evento -->
    <div id="event-modal" style="display:none; position:fixed; top:0; left:0; width:100vw; height:100vh; background:rgba(0,0,0,0.4); align-items:center; justify-content:center; z-index:9999;">
        <form id="event-form" style="background:#232323; padding:2rem; border-radius:12px; min-width:320px; max-width:90vw;">
            <input type="hidden" id="event-id">
            <div class="form-group">
                <label for="event-date" class="form-label">Fecha</label>
                <input type="date" id="event-date" class="form-input" required>
            </div>
            <div class="form-group">
                <label for="event-name" class="form-label">Nombre del Evento</label>
                <input type="text" id="event-name" class="form-input" required>
            </div>
            <div class="form-group">
                <label for="event-time" class="form-label">Hora</label>
                <input type="time" id="event-time" class="form-input" required>
            </div>
            <div class="form-group">
                <label for="event-place" class="form-label">Lugar</label>
                <input type="text" id="event-place" class="form-input" required>
            </div>
            <div class="form-group">
                <label for="event-description" class="form-label">Descripción</label>
                <textarea id="event-description" class="form-input" rows="3" required></textarea>
            </div>
            <div class="form-group" style="margin-bottom:1rem;">
                <label for="event-show-register" class="form-label" style="display:inline; font-weight:600; color:var(--primary-color); margin-bottom:0.5rem;">Mostrar botón "Registrarse"</label>
                <label class="switch">
                  <input type="checkbox" id="event-show-register">
                  <span class="slider round"></span>
                </label>
<style>
/* Slider switch styles */
.switch {
  position: relative;
  display: inline-block;
  width: 46px;
  height: 24px;
  vertical-align: middle;
  margin-left: 0.7rem;
}
.switch input {display:none;}
.slider {
  position: absolute;
  cursor: pointer;
  top: 0; left: 0; right: 0; bottom: 0;
  background-color: #ccc;
  transition: .4s;
  border-radius: 24px;
}
.slider:before {
  position: absolute;
  content: "";
  height: 18px;
  width: 18px;
  left: 3px;
  bottom: 3px;
  background-color: white;
  transition: .4s;
  border-radius: 50%;
}
input:checked + .slider {
  background-color: var(--primary-color);
}
input:checked + .slider:before {
  transform: translateX(22px);
}
.slider.round {
  border-radius: 24px;
}
.slider.round:before {
  border-radius: 50%;
}
</style>
            </div>
            <div style="margin-top:1rem; display:flex; gap:1rem; justify-content:flex-end;">
                <button type="button" class="btn btn-outline" onclick="hideEventForm()">Cancelar</button>
                <button type="submit" class="btn">Guardar</button>
            </div>
        </form>
    </div>
    <script>
        // Nueva función para refrescar la lista de eventos con mejor UI
        // Definir variables globales para el módulo de eventos
        let eventModal, eventForm, csrf;
        document.addEventListener('DOMContentLoaded', function() {
            eventModal = document.getElementById('event-modal');
            eventForm = document.getElementById('event-form');
            csrf = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        function fetchEvents() {
            fetch('/church/public/admin/events')
                .then(res => res.json())
                .then(events => {
                    // Ordenar eventos por fecha descendente (más nuevo arriba)
                    events.sort((a, b) => new Date(b.date) - new Date(a.date));
                    const list = document.getElementById('events-list');
                    if (!list) return;
                    if (!events.length) {
                        list.innerHTML = '<p style="color:#FF3B3F;">No hay eventos programados.</p>';
                        return;
                    }
                    list.innerHTML = events.map(event => {
                        const showRegister = (event.show_register_button === 1 || event.show_register_button === true) ? 'Sí' : 'No';
                        return `
                        <div class="event-card" style="background:#232323; border-radius:14px; box-shadow:0 2px 12px #FF3B3F22; margin-bottom:1.5rem; padding:1.5rem; color:#fff; display:flex; align-items:center; gap:1.5rem;">
                            <div class="event-date" style="background:#FF3B3F; color:#fff; border-radius:10px; padding:1rem 1.2rem; text-align:center; min-width:70px;">
                                <div class="event-day" style="font-size:2rem; font-weight:700;">${formatDate(event.date, 'day')}</div>
                                <div class="event-month" style="font-size:1.1rem;">${formatDate(event.date, 'month')}</div>
                            </div>
                            <div class="event-details" style="flex:1;">
                                <h3 class="event-title" style="color:#FF3B3F; margin-bottom:0.3rem;">${event.name}</h3>
                                <div class="event-info" style="margin-bottom:0.5rem;">
                                    <span class="event-time" style="margin-right:1.2rem;"><span class="event-icon">🕒</span> ${event.time}</span>
                                    <span class="event-location"><span class="event-icon">📍</span> ${event.place}</span>
                                </div>
                                <p class="event-description" style="margin-bottom:0.7rem;">${event.description}</p>
                                <div style="margin-bottom:0.7rem;">
                                </div>
                                <button class="btn btn-outline" onclick="editEvent(${event.id})">Editar</button>
                                <button class="btn btn-danger btn-sm" onclick="deleteEvent(${event.id})">Eliminar</button>
                            </div>
                        </div>
                        `;
                    }).join('');
                });
        }
                            </div>
                        </div>
                        `;
                    }).join('');
                });
        }

function formatDate(dateStr, part = null) {
    // Crear la fecha como local (no UTC) para evitar desfase de un día
    if (!dateStr) return '';
    const [year, month, day] = dateStr.split('-').map(Number);
    const d = new Date(year, month - 1, day); // Mes base 0, local time
    if (part === 'day') return d.getDate().toString().padStart(2, '0');
    if (part === 'month') return d.toLocaleString('es-ES', { month: 'short' }).charAt(0).toUpperCase() + d.toLocaleString('es-ES', { month: 'short' }).slice(1);
    return d.toLocaleDateString('es-ES');
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
            // Slider: por defecto en NO (desmarcado)
            if (event && (event.show_register_button === 1 || event.show_register_button === true)) {
                document.getElementById('event-show-register').checked = true;
            } else {
                document.getElementById('event-show-register').checked = false;
            }
        }

        function hideEventForm() {
            eventModal.style.display = 'none';
        }

        window.editEvent = function(id) {
            fetch(`/church/public/admin/events/${id}`)
                .then(res => res.json())
                .then(event => {
                    showEventForm(event);
                });
        };

        window.deleteEvent = function(id) {
            if (!confirm('¿Seguro que deseas borrar este evento?')) return;
            fetch(`/church/public/admin/events/${id}`, {
                method: 'DELETE',
                headers: { 'X-CSRF-TOKEN': csrf }
            })
            .then(res => res.json())
            .then(() => fetchEvents());
        };

        // Manejar el submit del formulario de eventos
        document.addEventListener('DOMContentLoaded', function() {
            if (!eventForm) return;
            eventForm.onsubmit = function(e) {
                e.preventDefault();
                const id = document.getElementById('event-id').value;
                const data = {
                    date: document.getElementById('event-date').value,
                    name: document.getElementById('event-name').value,
                    time: document.getElementById('event-time').value,
                    place: document.getElementById('event-place').value,
                    description: document.getElementById('event-description').value,
                    show_register_button: document.getElementById('event-show-register').checked ? 1 : 0
                };
                const url = id ? `/church/public/admin/events/${id}` : '/church/public/admin/events';
                const method = id ? 'PUT' : 'POST';
                fetch(url, {
                    method: method,
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
        });
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
            const previewContainer = document.getElementById('previewContainer');
            previewContainer.innerHTML = '';
            if (files.length > 0) {
                // Mostrar previsualización de la primera imagen
                const file = files[0];
                if (file && file.type.startsWith('image/')) {
                    const reader = new FileReader();
                    reader.onload = function(ev) {
                        previewContainer.innerHTML = `<img src="${ev.target.result}" alt="Previsualización" style="max-width:160px; max-height:120px; border-radius:8px; box-shadow:0 2px 8px #0002; margin-bottom:0.5rem;">`;
                    };
                    reader.readAsDataURL(file);
                    previewContainer.style.display = 'flex';
                }
                // Mostrar select de categoría
                document.getElementById('categoria').style.display = '';
            } else {
                previewContainer.style.display = 'none';
                document.getElementById('categoria').style.display = 'none';
            }
            // Ocultar mensaje de éxito si estaba visible
            document.getElementById('uploadSuccess').style.display = 'none';
        });

        // Drag and drop functionality mejorada con selección de categoría
        const uploadArea = document.querySelector('.upload-area');
                showCategoriaModal(() => {

// Eliminado código duplicado y rutas incorrectas. Usar sólo la versión funcional de arriba.
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
    fetch('/church/public/admin/events')
        .then(res => res.json())
        .then(events => {
            // Ordenar eventos por created_at descendente (más reciente arriba)
            events.sort((a, b) => new Date(b.created_at) - new Date(a.created_at));
            eventsList.innerHTML = events.map(event => `
                <div class="event-card" style="background:#232323; border-radius:14px; box-shadow:0 2px 12px #FF3B3F22; margin-bottom:1.5rem; padding:1.5rem; color:#fff; display:flex; align-items:center; gap:1.5rem;">
                    <div class="event-date" style="background:#FF3B3F; color:#fff; border-radius:10px; padding:1rem 1.2rem; text-align:center; min-width:70px;">
                        <div class="event-day" style="font-size:2rem; font-weight:700;">${formatDate(event.date, 'day')}</div>
                        <div class="event-month" style="font-size:1.1rem;">${formatDate(event.date, 'month')}</div>
                    </div>
                    <div class="event-details" style="flex:1;">
                        <h3 class="event-title" style="color:#FF3B3F; margin-bottom:0.3rem;">${event.name}</h3>
                        <div class="event-info" style="margin-bottom:0.5rem;">
                            <span class="event-time" style="margin-right:1.2rem;"><span class="event-icon">🕒</span> ${event.time}</span>
                            <span class="event-location"><span class="event-icon">📍</span> ${event.place}</span>
                        </div>
                        <p class="event-description" style="margin-bottom:0.7rem;">${event.description}</p>
                        <div style="margin-bottom:0.7rem;"></div>
                        <button class="btn btn-outline" onclick="editEvent(${event.id})">Editar</button>
                        <button class="btn btn-danger btn-sm" onclick="deleteEvent(${event.id})">Eliminar</button>
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
    document.getElementById('event-show-register').checked = event && (event.show_register_button === 1 || event.show_register_button === true);
        // Asegura que el valor enviado al backend sea 0 si está desmarcado
        document.getElementById('event-show-register').value = document.getElementById('event-show-register').checked ? 1 : 0;
}

function hideEventForm() {
    eventModal.style.display = 'none';
}

eventForm.onsubmit = function(e) {
    e.preventDefault();
                const id = document.getElementById('event-id').value;
                const showRegister = document.getElementById('event-show-register').checked ? 1 : 0;
                const data = {
                    date: document.getElementById('event-date').value,
                    name: document.getElementById('event-name').value,
                    time: document.getElementById('event-time').value,
                    place: document.getElementById('event-place').value,
                    description: document.getElementById('event-description').value,
                    show_register_button: showRegister
                };
    const url = id ? `/church/public/admin/events/${id}` : '/church/public/admin/events';
    const method = id ? 'PUT' : 'POST';
    fetch(url, {
        method: method,
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
    fetch(`/church/public/admin/events/${id}`)
        .then(res => res.json())
        .then(event => {
            showEventForm(event);
        });
};

window.deleteEvent = function(id) {
    if (!confirm('¿Seguro que deseas borrar este evento?')) return;
    fetch(`/church/public/admin/events/${id}`, {
        method: 'DELETE',
        headers: { 'X-CSRF-TOKEN': csrf }
    })
    .then(res => res.json())
    .then(() => fetchEvents());
};

document.addEventListener('DOMContentLoaded', fetchEvents);
</script>
<script>
</script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Refrescar usuario desde localStorage (debe ser el usuario actual, no el admin anterior)
    let user = null;
    try {
        user = JSON.parse(localStorage.getItem('usuario'));
    } catch (e) {
        user = null;
    }
    const navItems = document.querySelectorAll('.admin-nav .nav-item');
    const sections = document.querySelectorAll('.section');
    // Ocultar y desactivar todas las pestañas y secciones por defecto
    navItems.forEach(i => {
        i.style.display = 'none';
        i.classList.remove('active');
    });
    sections.forEach(sec => sec.classList.remove('active'));
    if (user && user.perfil) {
        let allowed = [];
        switch(user.perfil) {
            case 'Admin':
                allowed = ['dashboard','gallery','psalms','settings','events','contacto'];
                break;
            case 'Salmos':
                allowed = ['psalms'];
                break;
            case 'Gestor':
                allowed = ['dashboard','settings'];
                break;
            case 'Galeria':
                allowed = ['gallery'];
                break;
            case 'Eventos':
                allowed = ['events'];
                break;
            default:
                allowed = [];
        }
        if (user.perfil === 'Admin') {
            navItems.forEach(i => i.style.display = '');
            navItems.forEach(i => i.classList.remove('active'));
            sections.forEach(sec => sec.classList.remove('active'));
            const nav = document.querySelector('.admin-nav .nav-item[data-section="dashboard"]');
            const sec = document.getElementById('dashboard');
            if (nav) nav.classList.add('active');
            if (sec) sec.classList.add('active');
            navItems.forEach(item => {
                item.onclick = function() {
                    navItems.forEach(i => i.classList.remove('active'));
                    sections.forEach(sec => sec.classList.remove('active'));
                    this.classList.add('active');
                    const sectionId = this.getAttribute('data-section');
                    const section = document.getElementById(sectionId);
                    if (section) section.classList.add('active');
                };
            });
        } else {
            // Mostrar solo las pestañas permitidas para otros perfiles
            allowed.forEach(sectionId => {
                const nav = document.querySelector('.admin-nav .nav-item[data-section="' + sectionId + '"]');
                if (nav) {
                    nav.style.display = '';
                    nav.classList.remove('active');
                }
            });
            // Si no hay pestañas permitidas, mostrar mensaje
            if (allowed.length === 0) {
                document.querySelector('.admin-content').innerHTML = '<div style="padding:4rem;text-align:center;font-size:1.5rem;color:#b91c1c;">No hay nada aquí</div>';
            } else {
                // Activar la primera pestaña permitida
                navItems.forEach(i => i.classList.remove('active'));
                sections.forEach(sec => sec.classList.remove('active'));
                const nav = document.querySelector('.admin-nav .nav-item[data-section="' + allowed[0] + '"]');
                const sec = document.getElementById(allowed[0]);
                if (nav) nav.classList.add('active');
                if (sec) sec.classList.add('active');
            }
            // Control de clicks solo en pestañas permitidas
            navItems.forEach(item => {
                item.onclick = function() {
                    const sectionId = this.getAttribute('data-section');
                    if (allowed.includes(sectionId)) {
                        navItems.forEach(i => i.classList.remove('active'));
                        sections.forEach(sec => sec.classList.remove('active'));
                        this.classList.add('active');
                        const section = document.getElementById(sectionId);
                        if (section) section.classList.add('active');
                    }
                };
            });
        }
        // Mostrar el correo correcto del usuario arriba
        const userInfoDiv = document.getElementById('user-info');
        if (userInfoDiv) {
            userInfoDiv.textContent = (user && user.email) ? user.email : '';
        }
    }
});
        switch (user.perfil) {
            case 'Admin':
                allowed = ['dashboard', 'gallery', 'psalms', 'settings', 'events', 'contacto'];
                break;
            case 'Salmos':
                allowed = ['psalms'];
                break;
            case 'Eventos':
                allowed = ['events'];
                break;
            case 'Galeria':
                allowed = ['gallery'];
                break;
            case 'Gestor':
                allowed = ['dashboard', 'settings'];
                break;
            default:
                allowed = [];
        }
    }
    // Si el usuario es Admin, mostrar todas las pestañas y nunca mostrar el mensaje de restricción
    if (user && user.perfil === 'Admin') {
        navItems.forEach(i => i.style.display = '');
        navItems.forEach(i => i.classList.remove('active'));
        sections.forEach(sec => sec.classList.remove('active'));
        const nav = document.querySelector('.admin-nav .nav-item[data-section="dashboard"]');
        const sec = document.getElementById('dashboard');
        if (nav) nav.classList.add('active');
        if (sec) sec.classList.add('active');
        // Control de clicks: Admin puede navegar por todas
        navItems.forEach(item => {
            item.onclick = function() {
                navItems.forEach(i => i.classList.remove('active'));
                sections.forEach(sec => sec.classList.remove('active'));
                this.classList.add('active');
                const sectionId = this.getAttribute('data-section');
                const section = document.getElementById(sectionId);
                if (section) section.classList.add('active');
            };
        });
    } else {
        // Mostrar solo las pestañas permitidas para otros perfiles
        allowed.forEach(sectionId => {
            const nav = document.querySelector('.admin-nav .nav-item[data-section="' + sectionId + '"]');
            if (nav) nav.style.display = '';
        });
        // Si no hay pestañas permitidas, mostrar mensaje
        if (allowed.length === 0) {
            document.querySelector('.admin-content').innerHTML = '<div style="padding:4rem;text-align:center;font-size:1.5rem;color:#b91c1c;">No hay nada aquí</div>';
        } else {
            // Activar la primera pestaña permitida
            navItems.forEach(i => i.classList.remove('active'));
            sections.forEach(sec => sec.classList.remove('active'));
            const nav = document.querySelector('.admin-nav .nav-item[data-section="' + allowed[0] + '"]');
            const sec = document.getElementById(allowed[0]);
            if (nav) nav.classList.add('active');
            if (sec) sec.classList.add('active');
        }
        // Control de clicks solo en pestañas permitidas
        navItems.forEach(item => {
            item.onclick = function() {
                const sectionId = this.getAttribute('data-section');
                if (allowed.includes(sectionId)) {
                    navItems.forEach(i => i.classList.remove('active'));
                    sections.forEach(sec => sec.classList.remove('active'));
                    this.classList.add('active');
                    const section = document.getElementById(sectionId);
                    if (section) section.classList.add('active');
                }
            };
        });
    }
});
</script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const reflectionP = document.querySelector('.psalm-reflection-admin');
    const reflectionInput = document.getElementById('reflection-input-admin');
    const reflectionForm = document.getElementById('reflection-form-admin');
    if (reflectionInput && reflectionP) {
        // Cargar reflexión guardada
        const saved = localStorage.getItem('salmoReflexion');
        if (saved) {
            reflectionP.textContent = saved;
            reflectionInput.value = saved;
        } else {
            reflectionP.textContent = reflectionInput.value;
        }
        reflectionForm.addEventListener('submit', function(e) {
            e.preventDefault();
            reflectionP.textContent = reflectionInput.value;
            localStorage.setItem('salmoReflexion', reflectionInput.value);
        });
    }
});
</script>

<!-- Modal de selección de categoría SIEMPRE visible en el DOM -->
<div id="categoriaModal" style="display:none; position:fixed; top:0; left:0; width:100vw; height:100vh; background:rgba(0,0,0,0.4); align-items:center; justify-content:center; z-index:9999;">
    <div style="background:#232323; padding:2rem; border-radius:12px; min-width:320px; max-width:90vw; text-align:center;">
        <h3 style="color:var(--primary-color);margin-bottom:1rem;">Selecciona la categoría</h3>
        <select id="modalCategoria" class="form-input" style="max-width:220px;display:inline-block;">
            <option value="especiales">Especiales</option>
            <option value="niños">Niños</option>
            <option value="mujeres">Mujeres</option>
            <option value="hombres">Hombres</option>
        </select>
        <div style="margin-top:1.5rem;">
            <button id="confirmCategoriaBtn" class="btn btn-primary">Subir Imágenes</button>
            <button id="cancelCategoriaBtn" class="btn btn-danger" style="margin-left:1rem;">Cancelar</button>
        </div>
    </div>
</div>

<script>
// Imagen personalizada del salmo
const imageInput = document.getElementById('psalm-image-input');
const imagePreview = document.getElementById('psalm-image-preview');
const imageSaveBtn = document.getElementById('psalm-image-save');

// Mostrar previsualización si ya hay imagen guardada
const savedImg = localStorage.getItem('imgSalmoSemana');
if (savedImg) {
    imagePreview.innerHTML = `<img src="${savedImg}" alt="Imagen del Salmo" style="max-width:100%;border-radius:12px;">`;
}

imageInput.addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (file && file.type.startsWith('image/')) {
        const reader = new FileReader();
        reader.onload = function(ev) {
            imagePreview.innerHTML = `<img src="${ev.target.result}" alt="Imagen del Salmo" style="max-width:100%;border-radius:12px;">`;
        };
        reader.readAsDataURL(file);
    } else {
        imagePreview.innerHTML = '';
    }
});

imageSaveBtn.addEventListener('click', function() {
    const img = imagePreview.querySelector('img');
    if (img && img.src) {
        localStorage.setItem('imgSalmoSemana', img.src);
        imageSaveBtn.innerHTML = '<i class="fas fa-check"></i> Guardado';
        setTimeout(() => {
            imageSaveBtn.innerHTML = '<i class="fas fa-save"></i> Guardar imagen';
        }, 1500);
    }
});
</script>

</body>
</html>