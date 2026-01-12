<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="Calendario de Disponibilidad - Arbitraje VAR" />
    <meta name="author" content="telcored" />
    <title>Calendario - Arbitraje VAR</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/soccer.png" />

    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="{{ asset('css/styles2.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/all.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/index-custom.css') }}" rel="stylesheet" />

    <style>
        #calendar {
            max-width: 900px;
            margin: 40px auto;
            min-height: 600px;
        }

        .fc-toolbar-title {
            text-transform: capitalize;
        }

        .fc-event {
            cursor: pointer;
        }
    </style>
</head>

<body id="page-top">
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav" style="background-color: #212529;">
        <div class="container">
            <a class="navbar-brand" href="https://arbitrajevar.cl"><img src="assets/img/logo2.png" alt="..." class="logo" /></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive"
                aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                Menu
                <i class="fas fa-bars ms-1"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav text-uppercase ms-auto py-4 py-lg-0">
                    <li class="nav-item"><a class="nav-link" href="{{ route('index') }}">Inicio</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('index') }}#services">Servicios</a></li>
                    <li class="nav-item"><a class="nav-link active" href="#">Calendario</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('index') }}#contact">Contacto</a></li>
                    <li class="nav-item"><a class="nav-link" href="https://arbitrajevar.cl/login">Login</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Header (Smaller version or just a spacing) -->
    <header class="masthead" style="padding-top: 150px; padding-bottom: 50px; min-height: auto; background-image: none; background-color: #212529;">
        <div class="container">
            <div class="masthead-heading text-uppercase" style="font-size: 2.5rem; color: #ffc107;">Calendario de Disponibilidad</div>
            <div class="masthead-subheading" style="color: white; font-size: 1.5rem;">Consulta nuestras fechas ocupadas</div>
            <a class="btn btn-primary btn-xl text-uppercase" href="https://arbitrajevar.cl/#contact">Contratar</a>
        </div>
    </header>

    <!-- Calendar Section -->
    <section class="page-section" id="calendar-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div id="calendar"></div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer-->
    <footer class="footer py-4">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-4 text-lg-start">Copyright &copy; Arbitraje VAR 2025-2026</div>
                <div class="col-lg-4 my-3 my-lg-0">
                    <a class="btn btn-dark btn-social mx-2" href="https://www.instagram.com/arbitraje.var/" aria-label="Instagram"><i class="fa-brands fa-instagram"></i></a>
                </div>
                <div class="col-lg-4 text-lg-end">
                    Desarrollado por => <a href="https://www.telcored.cl" style="text-decoration:none">{ /telcored }</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="{{ asset('js/scripts2.js') }}"></script>
    <!-- FullCalendar JS -->
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
                    url: "{{ route('public.events') }}", // Create this route
                    method: 'GET',
                    failure: function() {
                        alert("No se pudieron cargar las fechas.");
                    }
                },
                // Optional: Customize event rendering to look "Elegant"
                eventColor: '#dc3545', // Red for busy/occupied
                eventDisplay: 'block',
            });
            calendar.render();
        });
    </script>
</body>

</html>