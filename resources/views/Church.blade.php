<!-- filepath: c:\xampp\htdocs\Test\resources\views\Church.blade.php -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Casa de Adoración NJ - Fe, Comunidad y Esperanza</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&family=Lora:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/churchpage.css') }}">
</head>

<body>
    <!-- Encabezado -->
<header>
    <div class="container header-container">
        <a href="/church/public#inicio" class="logo" style="text-decoration:none;">
            <div class="logo-img-wrapper">
                <img src="../resources/Images/logo.webp" alt="Casa de Adoración Logo">
            </div>
            <span class="logo-text">Casa de Adoración NJ</span>
        </a>
        <nav>
<!-- filepath: c:\xampp\htdocs\Test\resources\views\Church.blade.php -->
<ul class="nav-menu">
    <li class="nav-item"><a href="#inicio" class="nav-link">Inicio</a></li>
    <li class="nav-item"><a href="#nosotros" class="nav-link">Nosotros</a></li>
    <li class="nav-item"><a href="#salmo" class="nav-link">Salmo</a></li>
    <li class="nav-item"><a href="#servicios" class="nav-link">Servicios</a></li>
    <li class="nav-item"><a href="#eventos" class="nav-link">Eventos</a></li>
    <li class="nav-item"><a href="#galeria" class="nav-link">Galería</a></li>
    <li class="nav-item"><a href="#transmision" class="nav-link">Transmisión</a></li>
    <li class="nav-item"><a href="#contacto" class="nav-link">Contacto</a></li>
    @guest
        <li class="nav-item">
            <a href="{{ route('login.form') }}" class="nav-link btn" style="background:#720E29; color:#fff; margin-right: 0.5rem;">Iniciar sesion</a>
        </li>
        <li class="nav-item">
            <a href="{{ route('register.form') }}" class="nav-link btn btn-outline" style="border:1px solid #720E29; color:#720E29;">Registrarse</a>
        </li>
@else
    <li class="nav-item">
        <form method="POST" action="{{ route('logout') }}" style="display:inline;">
            @csrf
            <button type="submit" class="nav-link btn btn-outline" style="border:1px solid #720E29; color:#720E29; background:transparent;">Cerrar sesión</button>
        </form>
    </li>
    <li class="nav-item" id="admin-btn" style="display:none;">
        <a href="/church/public/admin" class="nav-link btn" style="background:#720E29; color:#FFFF;">Panel Admin</a>
    </li>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Mostrar el botón Panel Admin si el usuario está autenticado y tiene perfil permitido
            @if(Auth::check())
                var perfil = @json(Auth::user()->perfil);
                var perfilesPermitidos = ['Admin', 'Eventos', 'Salmos', 'Gestor', 'Galeria'];
                if (perfilesPermitidos.includes(perfil)) {
                    document.getElementById('admin-btn').style.display = 'block';
                }
            @else
                // Fallback para usuarios no autenticados (por si acaso)
                const user = JSON.parse(localStorage.getItem('usuario'));
                const perfilesPermitidos = ['Admin', 'Eventos', 'Salmos', 'Gestor', 'Galeria'];
                if (user && perfilesPermitidos.includes(user.perfil)) {
                    document.getElementById('admin-btn').style.display = 'block';
                }
            @endif
        });
    </script>
@endguest
</ul>                
                <div class="hamburger">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </nav>
        </div>
    </header>
    
    <!-- Hero -->
    <section class="hero" id="inicio" style="background-image: url('../resources/Images/FB.webp');">
        <div class="hero-content">
            <h1 class="hero-title">Bienvenidos a Casa de Adoración NJ</h1>
            <p class="hero-subtitle">Un lugar donde encontrarás fe, comunidad y esperanza para tu vida</p>
            <div class="hero-buttons">
                <a href="#servicios" class="btn">Nuestros Servicios</a>
                <a href="#contacto" class="btn btn-outline">Contáctanos</a>
            </div>
        </div>
        <div class="scroll-down">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                <path d="M7.41,8.58L12,13.17L16.59,8.58L18,10L12,16L6,10L7.41,8.58Z"/>
            </svg>
        </div>
    </section>
    
    <!-- Nosotros -->
    <section class="about" id="nosotros">
        <div class="container">
            <h2 class="section-title">Quiénes Somos</h2>
            <div class="about-content">
                <div class="about-image">
                    <img src="../resources/Images/Image1.png" alt="Nuestra Iglesia" style="border-radius:16px;">
                </div>
                <div class="about-text">
                    <h3 class="about-title">Nuestra Misión</h3>
                    <p class="about-description">Casa de Adoración NJ es una comunidad cristiana dedicada a compartir el amor de Dios a través de la adoración, la enseñanza bíblica y el servicio a nuestra comunidad. Creemos en crear un ambiente donde todos puedan encontrar esperanza, sanidad y un sentido de pertenencia.</p>
                    <p class="about-description">Desde nuestra fundación, nos hemos comprometido a ser una luz en New Jersey, ofreciendo programas y ministerios que impactan positivamente a familias, jóvenes y a toda la comunidad.</p>
                    <a href="{{ url('/about') }}" class="btn">Conoce más sobre nosotros</a>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Salmo de la Semana -->
    <section class="psalm-of-week" id="salmo">
        <div class="container">
            <h1 class="section-title">Salmo de la Semana</h1>
            <div class="psalm-content">
                <div class="psalm-image">
                    <img id="psalm-week-img" src="../resources/Images/Image1.png" alt="Salmo de la Semana" style="border-radius:16px;">
                </div>
                <div class="psalm-text">
                    <h3 class="psalm-reference" style="color:#fff;"></h3>
                    <div class="psalm-quote" style="color:#fff;"></div>
                    <p class="psalm-reflection" style="color:#FF3B3F; font-style:italic;">Este salmo nos recuerda que Dios es nuestro proveedor y protector. Cuando confiamos en Él como nuestro pastor, encontramos paz y renovación para nuestras almas. Esta semana, reflexionemos sobre cómo Dios nos guía y nos da descanso en medio de nuestras ocupadas vidas.</p>
                </div>
            </div>
        </div>
        <script>
        // Script para cargar el Salmo de la Semana desde localStorage
        document.addEventListener('DOMContentLoaded', function() {
            try {
                const salmo = JSON.parse(localStorage.getItem('salmoSemana'));
                if (salmo && salmo.verses) {
                    // Referencia
                    document.querySelector('.psalm-reference').textContent = salmo.reference || '';
                    // Texto del salmo
                    document.querySelector('.psalm-quote').textContent = salmo.verses;
                }
                // Reflexión personalizada (si existe en localStorage)
                const reflexion = localStorage.getItem('reflexionSalmoSemana');
                if (reflexion) {
                    document.querySelector('.psalm-reflection').textContent = reflexion;
                }
                // Imagen personalizada del salmo (si existe en localStorage)
                const imgUrl = localStorage.getItem('imgSalmoSemana');
                if (imgUrl) {
                    document.getElementById('psalm-week-img').src = imgUrl;
                }
            } catch (e) {
                // No hacer nada si hay error
            }
        });
        </script>
    </section>
    
    <!-- Servicios -->
    <section class="services" id="servicios">
        <div class="container">
            <h2 class="section-title">Nuestros Servicios</h2>
            <div class="services-grid">
                <div class="service-card">
                    <div class="service-image">
                        <img src="../resources/Images/Image1.png" alt="Servicio Dominical" style="border-radius:16px;">
                    </div>
                    <div class="service-content">
                        <h3 class="service-title">Servicio Dominical</h3>
                        <p class="service-description">Nuestro servicio principal de adoración cada domingo a las 10:00 AM. Un tiempo para alabar, aprender y conectar con nuestra comunidad.</p>
                        <a href="#" class="btn">Más información</a>
                    </div>
                </div>
                
                <div class="service-card">
                    <div class="service-image">
                        <img src="../resources/Images/Image1.png" alt="Estudio Bíblico" style="border-radius:16px;">
                    </div>
                    <div class="service-content">
                        <h3 class="service-title">Estudios Bíblicos</h3>
                        <p class="service-description">Grupos de estudio semanales donde profundizamos en las escrituras y aplicamos sus enseñanzas a nuestra vida diaria.</p>
                        <a href="#" class="btn">Más información</a>
                    </div>
                </div>
                
                <div class="service-card">
                    <div class="service-image">
                        <img src="../resources/Images/Image1.png" alt="Ministerio de Jóvenes" style="border-radius:16px;">
                    </div>
                    <div class="service-content">
                        <h3 class="service-title">Ministerio de Jóvenes</h3>
                        <p class="service-description">Un espacio dinámico donde los jóvenes pueden crecer espiritualmente, desarrollar liderazgo y formar amistades significativas.</p>
                        <a href="#" class="btn">Más información</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Eventos -->
    <section class="events" id="eventos">
        <div class="container">
            <h2 class="section-title">Noticias</h2>
            <div class="events-container">
                @php
                    $eventos = \App\Models\Event::orderBy('date', 'asc')->whereDate('date', '>=', now())->get();
                @endphp
                @forelse($eventos as $event)
                    <div class="event-card" style="background:#232323; border-radius:14px; box-shadow:0 2px 12px #FF3B3F22; margin-bottom:1.5rem; padding:1.5rem; color:#fff; display:flex; align-items:center; gap:1.5rem;">
                        <div class="event-date" style="background:#FF3B3F; color:#fff; border-radius:10px; padding:1rem 1.2rem; text-align:center; min-width:70px;">
                            <div class="event-day" style="font-size:2rem; font-weight:700;">{{ \Carbon\Carbon::parse($event->date)->format('d') }}</div>
                            <div class="event-month" style="font-size:1.1rem;">{{ \Carbon\Carbon::parse($event->date)->translatedFormat('M') }}</div>
                        </div>
                        <div class="event-details" style="flex:1;">
                            <h3 class="event-title" style="color:#FF3B3F; margin-bottom:0.3rem;">{{ $event->name }}</h3>
                            <div class="event-info" style="margin-bottom:0.5rem;">
                                <span class="event-time" style="margin-right:1.2rem;"><span class="event-icon">🕒</span> {{ $event->time }}</span>
                                <span class="event-location"><span class="event-icon">📍</span> {{ $event->place }}</span>
                            </div>
                            <p class="event-description" style="margin-bottom:0.7rem;">{{ \Illuminate\Support\Str::limit($event->description, 80) }}</p>
                            <a href="{{ route('event.detail', $event->id) }}" class="btn" style="background:#FF3B3F; color:#fff; margin-right:0.7rem;">Ver detalles</a>
                            {{-- DEBUG: Mostrar valor del campo --}}
                            {{-- <span style="color:yellow;">Valor: {{ var_export($event->show_register_button, true) }}</span> --}}
                            {{-- Aviso de inscripción presencial eliminado por solicitud --}}
                        </div>
                    </div>
                @empty
                    <p>No hay eventos programados.</p>
                @endforelse
            </div>
        </div>
    </section>
    
    <!-- Galería -->
    <section class="gallery" id="galeria">
        <div class="container">
            <h2 class="section-title">Nuestra Galería</h2>
            <div style="text-align:right; margin-bottom:1rem;">
                <a href="{{ route('galerias.categorias') }}" class="btn" style="background:#395B64; color:#fff; padding:0.5rem 1.2rem; border-radius:6px;">Ver por categorías</a>
            </div>
            <div class="gallery-grid">
                @forelse($images as $image)
                    <div class="gallery-item">
                        <a href="{{ route('galerias.categoria', ['categoria' => $image->categoria]) }}">
                            <img src="{{ asset('uploads/' . $image->filename) }}" alt="Imagen de galería" style="border-radius:16px;">
                        </a>
                        <div style="font-size:0.95rem; color:#395B64; margin-top:0.3rem; text-align:center;">
                            {{ ucfirst($image->categoria ?? 'Sin categoría') }}
                        </div>
                        <div class="gallery-overlay">
                            <div class="gallery-icon">+</div>
                        </div>
                    </div>
                @empty
                    <p>No hay imágenes en la galería.</p>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Transmisión en Vivo -->
    <section class="live-stream" id="transmision">
        <div class="container">
            <h2 class="section-title">Transmisión en Vivo</h2>
            <div class="fb-video-container" style="display: flex; justify-content: center;">
                <!-- Muestra la transmisión en vivo si hay, o el último video publicado si no hay en vivo -->
                <iframe 
                    src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2FCasaDeAdoracionNJ&tabs=live,videos&width=500&height=280&small_header=false&adapt_container_width=true&hide_cover=false&show_facepile=false&appId"
                    width="500" height="280" style="border:none;overflow:hidden" scrolling="no" frameborder="0"
                    allowfullscreen="true" allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share">
                </iframe>
            </div>
            <p style="text-align:center; margin-top:1rem; color:#395B64;">
                Si no hay transmisión en vivo, verás el último video publicado.<br>
                <a href="https://www.facebook.com/CasaDeAdoracionNJ/live" target="_blank" class="btn">Ver en Facebook</a>
            </p>
        </div>
    </section>
    
    <!-- Contacto -->
    <section class="contact" id="contacto">
        <div class="container">
            <h2 class="section-title">Contáctanos</h2>
            <div class="contact-content">
                <div class="contact-info">
                    <h3 class="contact-title">Información de Contacto</h3>
                    <div class="contact-details">
                        <div class="contact-item">
                            <div class="contact-icon">📍</div>
                            <div>Avenida 69 #251 entre 44 y 46 Colonia Cordemex. Frente a Gran Plaza, Mérida, México</div>
                            <div id="map-contact" style="height:180px; width:100%; border-radius:12px; box-shadow:0 2px 8px #395B6444; margin-top:0.7rem;"></div>
                        </div>
                        <div class="contact-item">
                            <div class="contact-icon">📞</div>
                            <div>(+52) 9991734714</div>
                        </div>
                        <div class="contact-item">
                            <div class="contact-icon">✉️</div>
                            <div>info@casadeadoracionnj.com</div>
                        </div>
                        <div class="contact-item">
                            <div class="contact-icon">🕒</div>
                            <div>
                                <strong>Horario de Oficina:</strong><br>
                                Lunes - Viernes: 9:00 AM - 5:00 PM<br>
                                Sábado: 10:00 AM - 2:00 PM
                            </div>
                        </div>
                    </div>
                    
                    <h4>Síguenos en:</h4>
                    <div class="social-media">
                        <a href="https://www.facebook.com/CasaDeAdoracionNJ" class="social-link">f</a>
                        <a href="#" class="social-link">in</a>
                        <a href="#" class="social-link">ig</a>
                        <a href="#" class="social-link">yt</a>
                    </div>
                </div>
                
                <div class="contact-form">
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    @if($errors->any())
                        <div class="alert alert-error">
                            @foreach($errors->all() as $error)
                                <div>{{ $error }}</div>
                            @endforeach
                        </div>
                    @endif
                    <form action="{{ route('contacto.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="name" class="form-label">Nombre</label>
                            <input type="text" id="name" name="name" class="form-control" required value="{{ old('name') }}">
                        </div>
                        <div class="form-group">
                            <label for="email" class="form-label">Correo Electrónico</label>
                            <input type="email" id="email" name="email" class="form-control" required value="{{ old('email') }}">
                        </div>
                        <div class="form-group">
                            <label for="phone" class="form-label">Teléfono</label>
                            <input type="tel" id="phone" name="phone" class="form-control" value="{{ old('phone') }}">
                        </div>
                        <div class="form-group">
                            <label for="message" class="form-label">Mensaje</label>
                            <textarea id="message" name="message" class="form-control" required>{{ old('message') }}</textarea>
                        </div>
                        <button type="submit" class="btn">Enviar Mensaje</button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Leaflet CSS y JS solo una vez -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script>
      document.addEventListener('DOMContentLoaded', function() {
        if (document.getElementById('map-contact')) {
          var mapContact = L.map('map-contact', {scrollWheelZoom:false, dragging:true, zoomControl:false, doubleClickZoom:false, boxZoom:false, keyboard:false, tap:false}).setView([21.032965, -89.624553], 17);
          L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors'
          }).addTo(mapContact);
          var marker = L.marker([21.032965, -89.624553]).addTo(mapContact)
            .bindPopup('Iglesia Nueva Jerusalén<br>(Misión) Asambleas de Dios');
          var googleMapsUrl = 'https://www.google.com/maps/place/Iglesia+Nueva+Jerusal%C3%A9n+(Misi%C3%B3n)+Asambleas+de+Dios/@21.032965,-89.624553,18z/data=!4m6!3m5!1s0x8f56769d4ff8bdbf:0xb81b05c4ce563d15!8m2!3d21.032965!4d-89.6245534!16s%2Fg%2F11g6983ms_?hl=es-419&entry=ttu&g_ep=EgoyMDI1MDcwOC4wIKXMDSoASAFQAw%3D%3D';
          marker.on('click', function() {
            window.open(googleMapsUrl, '_blank');
          });
          mapContact.on('click', function() {
            window.open(googleMapsUrl, '_blank');
          });
        }
      });
    </script>



</body>
</html>

</script>
</body>

<!-- Mapa interactivo Leaflet al final de la página principal -->

</section>
<!-- Leaflet CSS -->
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
<!-- Leaflet JS -->
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<script>
    // Coordenadas exactas: 21.032965, -89.624553
    document.addEventListener('DOMContentLoaded', function() {
        var map = L.map('map').setView([21.032965, -89.624553], 18);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors'
        }).addTo(map);
        var marker = L.marker([21.032965, -89.624553])
            .addTo(map)
            .bindPopup('Iglesia Nueva Jerusalén<br>(Misión) Asambleas de Dios')
            .openPopup();
        // Redirigir a Google Maps al hacer clic en el mapa o el marcador
        var googleMapsUrl = 'https://www.google.com/maps/place/Iglesia+Nueva+Jerusal%C3%A9n+(Misi%C3%B3n)+Asambleas+de+Dios/@21.032965,-89.624553,18z/data=!4m6!3m5!1s0x8f56769d4ff8bdbf:0xb81b05c4ce563d15!8m2!3d21.032965!4d-89.6245534!16s%2Fg%2F11g6983ms_?hl=es-419&entry=ttu&g_ep=EgoyMDI1MDcwOC4wIKXMDSoASAFQAw%3D%3D';
        map.on('click', function() {
            window.open(googleMapsUrl, '_blank');
        });
        marker.on('click', function() {
            window.open(googleMapsUrl, '_blank');
        });
    });
</script>
</body>
</html>





