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
        <a href="#inicio" class="logo" style="text-decoration:none;">
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
            const user = JSON.parse(localStorage.getItem('usuario'));
            if (user && user.email === 'admin@dominio.com') {
                document.getElementById('admin-btn').style.display = 'block';
            }
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
                    <img src="../resources/Images/Image1.png" alt="Nuestra Iglesia">
                </div>
                <div class="about-text">
                    <h3 class="about-title">Nuestra Misión</h3>
                    <p class="about-description">Casa de Adoración NJ es una comunidad cristiana dedicada a compartir el amor de Dios a través de la adoración, la enseñanza bíblica y el servicio a nuestra comunidad. Creemos en crear un ambiente donde todos puedan encontrar esperanza, sanidad y un sentido de pertenencia.</p>
                    <p class="about-description">Desde nuestra fundación, nos hemos comprometido a ser una luz en New Jersey, ofreciendo programas y ministerios que impactan positivamente a familias, jóvenes y a toda la comunidad.</p>
                    <a href="#" class="btn">Conoce más sobre nosotros</a>
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
                    <img src="../resources/Images/Image1.png" alt="Salmo de la Semana">
                </div>
                <div class="psalm-text">
                    <h3 class="psalm-reference"></h3>
                    <div class="psalm-quote"  style="color: #720E29"></div>
                    <p class="psalm-reflection" style="color: #720E29">Este salmo nos recuerda que Dios es nuestro proveedor y protector. Cuando confiamos en Él como nuestro pastor, encontramos paz y renovación para nuestras almas. Esta semana, reflexionemos sobre cómo Dios nos guía y nos da descanso en medio de nuestras ocupadas vidas.</p>
                    <a href="#" class="btn">Leer la reflexión completa</a>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Servicios -->
    <section class="services" id="servicios">
        <div class="container">
            <h2 class="section-title">Nuestros Servicios</h2>
            <div class="services-grid">
                <div class="service-card">
                    <div class="service-image">
                        <img src="../resources/Images/Image1.png" alt="Servicio Dominical">
                    </div>
                    <div class="service-content">
                        <h3 class="service-title">Servicio Dominical</h3>
                        <p class="service-description">Nuestro servicio principal de adoración cada domingo a las 10:00 AM. Un tiempo para alabar, aprender y conectar con nuestra comunidad.</p>
                        <a href="#" class="btn">Más información</a>
                    </div>
                </div>
                
                <div class="service-card">
                    <div class="service-image">
                        <img src="../resources/Images/Image1.png" alt="Estudio Bíblico">
                    </div>
                    <div class="service-content">
                        <h3 class="service-title">Estudios Bíblicos</h3>
                        <p class="service-description">Grupos de estudio semanales donde profundizamos en las escrituras y aplicamos sus enseñanzas a nuestra vida diaria.</p>
                        <a href="#" class="btn">Más información</a>
                    </div>
                </div>
                
                <div class="service-card">
                    <div class="service-image">
                        <img src="../resources/Images/Image1.png" alt="Ministerio de Jóvenes">
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
            <h2 class="section-title">Próximos Eventos</h2>
            <div class="events-container">
                
                
            </div>
        </div>
    </section>
    
    <!-- Galería -->
    <section class="gallery" id="galeria">
        <div class="container">
            <h2 class="section-title">Nuestra Galería</h2>
            <div class="gallery-grid">
                @forelse($images as $image)
                    <div class="gallery-item">
                        <img src="{{ asset('uploads/' . $image->filename) }}" alt="Imagen de galería">
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
                <!-- Reemplaza 'tu_pagina' por el nombre de tu página de Facebook -->
                <iframe 
                    src="https://www.facebook.com/plugins/video.php?href=https%3A%2F%2Fwww.facebook.com%2FCasaDeAdoracionNJ%2Flive"
                    width="500" height="280" style="border:none;overflow:hidden" scrolling="no" frameborder="0"
                    allowfullscreen="true" allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share">
                </iframe>
            </div>
            <p style="text-align:center; margin-top:1rem;">
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
                            <div>123 Calle Principal, Ciudad, NJ 12345</div>
                        </div>
                        <div class="contact-item">
                            <div class="contact-icon">📞</div>
                            <div>(123) 456-7890</div>
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
                    <form action="#" method="POST">
                        <div class="form-group">
                            <label for="name" class="form-label">Nombre</label>
                            <input type="text" id="name" name="name" class="form-control" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="email" class="form-label">Correo Electrónico</label>
                            <input type="email" id="email" name="email" class="form-control" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="phone" class="form-label">Teléfono</label>
                            <input type="tel" id="phone" name="phone" class="form-control">
                        </div>
                        
                        <div class="form-group">
                            <label for="message" class="form-label">Mensaje</label>
                            <textarea id="message" name="message" class="form-control" required></textarea>
                        </div>
                        
                        <button type="submit" class="btn">Enviar Mensaje</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="footer-content">
                <div>
                    <div class="footer-logo">
                        <img src="../resources/Images/logo.webp" alt="Casa de Adoración Logo">
                        <div class="footer-logo-text">Casa de Adoración NJ</div>
                    </div>
                    <p class="footer-description">Un lugar donde encontrarás fe, comunidad y esperanza para tu vida. Somos una iglesia comprometida con compartir el amor de Dios con todos.</p>
                </div>
                
                <div>
                    <h3 class="footer-title">Enlaces Rápidos</h3>
                    <ul class="footer-links">
                        <li class="footer-link"><a href="#inicio">Inicio</a></li>
                        <li class="footer-link"><a href="#nosotros">Nosotros</a></li>
                        <li class="footer-link"><a href="#salmo">Salmo de la Semana</a></li>
                        <li class="footer-link"><a href="#servicios">Servicios</a></li>
                        <li class="footer-link"><a href="#eventos">Eventos</a></li>
                        <li class="footer-link"><a href="#galeria">Galería</a></li>
                        <li class="footer-link"><a href="#transmision">Transmisión en Vivo</a></li>
                        <li class="footer-link"><a href="#contacto">Contacto</a></li>
                    </ul>
                </div>
                
                <div>
                    <h3 class="footer-title">Contáctanos</h3>
                    <ul class="footer-links">
                        <li class="footer-link"><a href="mailto:info@casadeadoracionnj.com">info@casadeadoracionnj.com</a></li>
                        <li class="footer-link"><a href="tel:+1234567890">(123) 456-7890</a></li>
                        <li class="footer-link"><a href="#ubicacion">Ubicación</a></li>
                    </ul>
                </div>
            </div>
            
            <div class="footer-bottom">
                <p>&copy; 2025 Casa de Adoración NJ. Todos los derechos reservados.</p>
            </div>
        </div>
    </footer>
    
    <script>
        // JavaScript para manejar la navegación móvil y efectos de scroll
        document.addEventListener('DOMContentLoaded', function() {
            const header = document.querySelector('header');
            const hamburger = document.querySelector('.hamburger');
            const navMenu = document.querySelector('.nav-menu');
            const navLinks = document.querySelectorAll('.nav-link');
            
            // Cambiar estilo de header al hacer scroll
            window.addEventListener('scroll', function() {
                if (window.scrollY > 100) {
                    header.classList.add('scrolled');
                } else {
                    header.classList.remove('scrolled');
                }
            });
            
            // Toggle menú móvil
            hamburger.addEventListener('click', function() {
                hamburger.classList.toggle('active');
                navMenu.classList.toggle('active');
            });
            
            // Cerrar menú al hacer click en un enlace
            navLinks.forEach(function(navLink) {
                navLink.addEventListener('click', function() {
                    hamburger.classList.remove('active');
                    navMenu.classList.remove('active');
                });
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Obtén los datos del Salmo guardado en localStorage
            const datos = localStorage.getItem('salmoSemana');
            if (!datos) {
                console.warn('No hay un Salmo guardado en localStorage.');
                return;
            }
    
            // Parsear los datos del Salmo
            const { reference, book, verses } = JSON.parse(datos);
    
            // Seleccionar los elementos donde se mostrará el contenido
            const refEl = document.querySelector('.psalm-reference');
            const quoteEl = document.querySelector('.psalm-quote');
    
            // Insertar los datos en los elementos correspondientes
            if (refEl) refEl.textContent = `${reference} - ${book}`;
            if (quoteEl) {
                quoteEl.innerHTML = ''; // Limpiar contenido previo
                verses.split('\n\n').forEach(v => {
                    const p = document.createElement('p');
                    p.textContent = v;
                    quoteEl.appendChild(p);
                });
            }
        });
    </script>
    <script>
document.addEventListener('DOMContentLoaded', function() {
    fetch('/Test/public/admin/events')
        .then(res => res.json())
        .then(events => {
            const eventsContainer = document.querySelector('.events-container');
            if (!eventsContainer) return;
            if (!events.length) {
                eventsContainer.innerHTML = '<p>No hay eventos programados.</p>';
                return;
            }
            eventsContainer.innerHTML = events.map(event => {
                // Formatea la fecha
                const dateObj = new Date(event.date);
                const day = dateObj.getDate().toString().padStart(2, '0');
                const month = dateObj.toLocaleString('es-ES', { month: 'short' });
                return `
                <div class="event-card">
                    <div class="event-date">
                        <div class="event-day">${day}</div>
                        <div class="event-month">${month.charAt(0).toUpperCase() + month.slice(1)}</div>
                    </div>
                    <div class="event-details">
                        <h3 class="event-title">${event.name}</h3>
                        <div class="event-info">
                            <div class="event-time"><span class="event-icon">🕒</span> ${event.time}</div>
                            <div class="event-location"><span class="event-icon">📍</span> ${event.place}</div>
                        </div>
                        <p class="event-description">${event.description}</p>
                        <a href="#" class="btn">Registrarse</a>
                    </div>
                </div>
                `;
            }).join('');
        })
        .catch(() => {
            const eventsContainer = document.querySelector('.events-container');
            if (eventsContainer) {
                eventsContainer.innerHTML = '<p style="color:red;">No se pudieron cargar los eventos.</p>';
            }
        });
});
</script>
@auth
<script>
    // Guarda nombre y correo del usuario logueado en localStorage
    localStorage.setItem('usuario', JSON.stringify({
        name: @json(Auth::user()->name),
        email: @json(Auth::user()->email)
    }));
</script>
@endauth
@guest
<script>
    // Si no hay usuario, elimina los datos guardados
    localStorage.removeItem('usuario');
    //DISEÑO MAS ACORDE AL LOGO
    //quitar margen a nav-bar o barra superior
</script>
@endguest
</body>
</html>





