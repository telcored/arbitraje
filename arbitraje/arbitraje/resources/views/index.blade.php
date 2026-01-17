<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="Arbitraje VAR - Servicios de arbitraje y VAR para partidos de fútbol." />
    <meta name="author" content="telcored" />
    <title>Arbitraje VAR | Tecnología en la Cancha</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/soccer.png') }}" />

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <!-- CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/all.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/common-football.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/landing-football.css') }}" rel="stylesheet" />

    <!-- Animation Library -->
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />

    <style>
        /* Inline Pitch Pattern */
        .pitch-lines {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            opacity: 0.1;
            z-index: 1;
        }
    </style>
</head>

<body id="page-top">
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top nav-football" id="mainNav">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                <img src="{{ asset('assets/img/logo2.png') }}" alt="Arbitraje VAR" />
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive">
                <i class="fas fa-bars"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ms-auto py-4 py-lg-0 align-items-center">
                    <li class="nav-item"><a class="nav-link" href="#page-top">Inicio</a></li>
                    <li class="nav-item"><a class="nav-link" href="#services">Servicios</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('public.calendar') }}">Calendario</a></li>
                    <li class="nav-item"><a class="nav-link" href="#contact">Contacto</a></li>
                    <li class="nav-item ms-lg-3">
                        <a class="btn btn-referee btn-sm px-4" href="{{ route('login') }}">
                            <i class="fas fa-user-lock me-2"></i>Acceso
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <header class="hero-section">
        <div class="pitch-lines">
            <svg width="100%" height="100%" viewBox="0 0 800 600" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg">
                <rect width="800" height="600" fill="none" stroke="white" stroke-width="2" />
                <line x1="400" y1="0" x2="400" y2="600" stroke="white" stroke-width="2" />
                <circle cx="400" cy="300" r="60" fill="none" stroke="white" stroke-width="2" />
                <rect x="0" y="150" width="100" height="300" fill="none" stroke="white" stroke-width="2" />
                <rect x="700" y="150" width="100" height="300" fill="none" stroke="white" stroke-width="2" />
            </svg>
        </div>
        <div class="container position-relative" style="z-index: 2;">
            <div class="row align-items-center">
                <div class="col-lg-7" data-aos="fade-right">
                    <span class="badge bg-pitch-gradient mb-3 p-2 px-3 border border-success">
                        <i class="fas fa-futbol me-2"></i>PROFESIONALISMO EN CADA JUGADA
                    </span>
                    <h1 class="display-2 fw-bold mb-4">Tecnología Aplicada al <span class="text-gradient">Fútbol</span></h1>
                    <p class="lead text-white-80 mb-5 fs-4">Simplifica el arbitraje, captura la emoción y asegura la justicia en tu liga con nuestra tecnología VAR de última generación.</p>
                    <div class="d-flex gap-3 flex-column flex-sm-row">
                        <a class="btn btn-football btn-lg pulse" href="#contact">Contratar Ahora</a>
                        <a class="btn btn-outline-light btn-lg rounded-pill px-5" href="#services">Ver Servicios</a>
                    </div>
                </div>
                <div class="col-lg-5 d-none d-lg-block" data-aos="fade-left">
                    <div class="glass-card p-5 text-center">
                        <i class="fas fa-video fa-5x text-gradient mb-4"></i>
                        <h3>VAR System 2.0</h3>
                        <p class="text-white-80">Análisis en tiempo real para ligas competitivas.</p>
                        <hr class="border-secondary">
                        <div class="d-flex justify-content-around">
                            <div>
                                <h4 class="mb-0">4K</h4><small>Resolución</small>
                            </div>
                            <div>
                                <h4 class="mb-0">0.2s</h4><small>Latencia</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Services Section -->
    <section class="py-5" id="services">
        <div class="container py-5">
            <div class="text-center mb-5" data-aos="fade-up">
                <h6 class="text-uppercase text-gradient fw-bold">Nuestra Oferta</h6>
                <h2 class="section-title">Servicios de Élite</h2>
                <div class="mx-auto bg-pitch-green" style="width: 80px; height: 4px; border-radius: 2px;"></div>
            </div>

            <div class="row g-4 mt-4">
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="glass-card p-4 h-100">
                        <div class="service-icon"><i class="fas fa-shield-halved"></i></div>
                        <h4 class="fw-bold">Arbitraje VAR</h4>
                        <p class="text-white-80">Servicio integral con árbitros certificados, sistema VAR avanzado y gestión completa del encuentro.</p>
                        <ul class="list-unstyled text-white-80 small mt-3">
                            <li><i class="fas fa-check text-success me-2"></i>Árbitros Profesionales</li>
                            <li><i class="fas fa-check text-success me-2"></i>Cabina VAR Móvil</li>
                            <li><i class="fas fa-check text-success me-2"></i>Informes Técnicos</li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="glass-card p-4 h-100">
                        <div class="service-icon" style="background: var(--referee-yellow);"><i class="fas fa-desktop"></i></div>
                        <h4 class="fw-bold">Tecnología Solo VAR</h4>
                        <p class="text-white-80">Integramos nuestra tecnología en tu liga actual. Ideal para potenciar torneos ya existentes.</p>
                        <ul class="list-unstyled text-white-80 small mt-3">
                            <li><i class="fas fa-check text-warning me-2"></i>10-Camaras HD</li>
                            <li><i class="fas fa-check text-warning me-2"></i>Operador VAR</li>
                            <li><i class="fas fa-check text-warning me-2"></i>Pantalla a pie de campo</li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="300">
                    <div class="glass-card p-4 h-100">
                        <div class="service-icon" style="background: var(--referee-red);"><i class="fas fa-video"></i></div>
                        <h4 class="fw-bold">Multimedia & Análisis</h4>
                        <p class="text-white-80">Registramos cada momento clave para análisis posterior, redes sociales y archivo histórico.</p>
                        <ul class="list-unstyled text-white-80 small mt-3">
                            <li><i class="fas fa-check text-danger me-2"></i>Clips de Goles</li>
                            <li><i class="fas fa-check text-danger me-2"></i>Análisis de Jugadas</li>
                            <li><i class="fas fa-check text-danger me-2"></i>Entrega Inmediata</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section class="py-5 bg-pitch-gradient" id="contact">
        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="glass-card overflow-hidden">
                        <div class="row g-0">
                            <div class="col-lg-5 p-5 bg-pitch-green d-flex flex-column justify-content-between text-black">
                                <div>
                                    <h2 class="fw-bold mb-4">¿Listo para el silbatazo inicial?</h2>
                                    <p class="mb-5">Contáctanos hoy mismo para llevar tu liga al siguiente nivel tecnológico.</p>

                                    <div class="mb-4 d-flex align-items-center">
                                        <div class="social-icon bg-dark text-white me-3"><i class="fas fa-envelope"></i></div>
                                        <span>contacto@arbitrajevar.cl</span>
                                    </div>
                                    <div class="mb-4 d-flex align-items-center">
                                        <div class="social-icon bg-dark text-white me-3"><i class="fas fa-phone"></i></div>
                                        <span>+56 9 97845567</span>
                                    </div>
                                    <div class="mb-4 d-flex align-items-center">
                                        <div class="social-icon bg-dark text-white me-3"><i class="fab fa-instagram"></i></div>
                                        <span>@arbitraje.var</span>
                                    </div>
                                </div>
                                <div class="mt-4">
                                    <img src="{{ asset('assets/img/logo2.png') }}" alt="Logo" style="height: 40px; filter: brightness(0);">
                                </div>
                            </div>
                            <div class="col-lg-7 p-5">
                                <form id="contactForm" action="{{ route('clients.formulario') }}" method="post">
                                    @csrf
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <label class="form-label small text-muted">Nombre</label>
                                            <input type="text" name="name" class="form-control football-input" placeholder="Ej: Juan Pérez" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label small text-muted">Correo</label>
                                            <input type="email" name="email" class="form-control football-input" placeholder="juan@ejemplo.com" required>
                                        </div>
                                        <div class="col-12">
                                            <label class="form-label small text-muted">Teléfono</label>
                                            <input type="tel" name="phone" class="form-control football-input" placeholder="+56 9 1234 5678" required>
                                        </div>
                                        <div class="col-12">
                                            <label class="form-label small text-muted">Mensaje / Detalles de la Liga</label>
                                            <textarea name="notes" rows="4" class="form-control football-input" placeholder="Cuéntanos sobre tu liga o evento..." required></textarea>
                                        </div>
                                        <div class="col-12 mt-4">
                                            <button type="submit" class="btn btn-football w-100 py-3">Enviar Solicitud</button>
                                        </div>
                                    </div>

                                    @if(session('success_contact'))
                                    <div class="alert alert-success mt-3 border-0 bg-success text-white">
                                        <i class="fas fa-check-circle me-2"></i> {{ session('success_contact') }}
                                    </div>
                                    @endif
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer-football text-center text-lg-start">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-4 text-white-80 mb-4 mb-lg-0">
                    <p class="mb-0">&copy; 2025-2026 Arbitraje VAR. Profesionales del fútbol.</p>
                </div>
                <div class="col-lg-4 text-center mb-4 mb-lg-0">
                    <a href="#" class="social-icon"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="social-icon"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="social-icon"><i class="fab fa-whatsapp"></i></a>
                </div>
                <div class="col-lg-4 text-lg-end text-white-80">
                    <p class="mb-0">Desarrollado con pasión por <a href="https://telcored.cl" class="text-gradient fw-bold text-decoration-none">{ /telcored }</a></p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 1000,
            once: true
        });

        // Navbar scroll effect
        window.addEventListener('scroll', function() {
            if (window.scrollY > 50) {
                document.getElementById('mainNav').classList.add('py-2');
            } else {
                document.getElementById('mainNav').classList.remove('py-2');
            }
        });
    </script>
</body>

</html>