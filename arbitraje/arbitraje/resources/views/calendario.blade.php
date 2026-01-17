<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="Calendario de Disponibilidad - Arbitraje VAR" />
    <meta name="author" content="telcored" />
    <title>Calendario - Arbitraje VAR | Tecnología en la Cancha</title>
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

    <style>
        #calendar {
            max-width: 1000px;
            margin: 0 auto;
            padding: 20px;
            background: var(--glass-white);
            border-radius: 20px;
            border: 1px solid var(--glass-border);
            color: white;
        }

        .fc {
            --fc-border-color: rgba(255, 255, 255, 0.1);
            --fc-button-bg-color: var(--pitch-green);
            --fc-button-border-color: var(--pitch-green);
            --fc-button-hover-bg-color: #158f43;
            --fc-button-active-bg-color: #158f43;
            --fc-today-bg-color: rgba(29, 185, 84, 0.1);
        }

        .fc .fc-toolbar-title {
            color: white;
            font-weight: 700;
            text-transform: capitalize;
        }

        .fc .fc-col-header-cell-cushion,
        .fc .fc-daygrid-day-number {
            color: white;
            text-decoration: none;
        }

        .fc-event {
            border-radius: 5px !important;
            padding: 2px 5px !important;
            font-size: 0.85rem !important;
        }
    </style>
</head>

<body id="page-top" class="bg-pitch-gradient">
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
                    <li class="nav-item"><a class="nav-link" href="{{ route('index') }}">Inicio</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('index') }}#services">Servicios</a></li>
                    <li class="nav-item"><a class="nav-link active" href="#">Calendario</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('index') }}#contact">Contacto</a></li>
                    <li class="nav-item ms-lg-3">
                        <a class="btn btn-referee btn-sm px-4" href="{{ route('login') }}">
                            <i class="fas fa-user-lock me-2"></i>Acceso
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Header -->
    <header class="py-5 mt-5">
        <div class="container pt-5 text-center">
            <h1 class="display-4 fw-bold text-gradient mb-3">Calendario de Disponibilidad</h1>
            <p class="lead text-white-80 mb-4">Consulta nuestras fechas ocupadas y reserva tu evento con anticipación.</p>
            <a class="btn btn-football px-5" href="{{ route('index') }}#contact">Reservar Ahora</a>
        </div>
    </header>

    <!-- Calendar Section -->
    <section class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div id="calendar"></div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer-football text-center text-lg-start mt-5">
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
                    <p class="mb-0">Desarrollado por <a href="https://telcored.cl" class="text-gradient fw-bold text-decoration-none">{ /telcored }</a></p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/index.global.min.js') }}"></script>
    <script src="{{ asset('js/es.global.min.js') }}"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let calendarEl = document.getElementById('calendar');
            let calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                locale: 'es',
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek'
                },
                events: {
                    url: "{{ route('public.events') }}",
                    method: 'GET',
                    failure: function() {
                        alert("No se pudieron cargar las fechas.");
                    }
                },
                eventColor: '#e74c3c',
                eventDisplay: 'block',
                displayEventTime: false
            });
            calendar.render();
        });
    </script>
</body>

</html>