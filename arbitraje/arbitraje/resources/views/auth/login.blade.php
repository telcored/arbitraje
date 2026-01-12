<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="author" content="telcored" />
    <title>Login - Arbitraje VAR</title>

    <link href="{{ asset('css/styles.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/all.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/login-custom.css') }}" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>

<body>
    <div class="login-container">
        <div class="row justify-content-center m-0">
            <div class="col-12 col-sm-10 col-md-8 col-lg-5 col-xl-4">
                <div class="login-card">
                    <!-- Encabezado -->
                    <div class="login-header">
                        <div class="logo-icon">
                            <i class="fas fa-futbol"></i>
                        </div>
                        <h1>Arbitraje VAR</h1>
                        <p>Acceso seguro al sistema</p>
                    </div>

                    <!-- Cuerpo -->
                    <div class="login-body">
                        @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endif

                        <form action="/login" method="post" autocomplete="off">
                            @csrf

                            <!-- Email -->
                            <div class="form-floating mb-3">
                                <input
                                    class="form-control"
                                    id="email"
                                    name="email"
                                    type="email"
                                    placeholder="correo@ejemplo.com"
                                    required
                                    autofocus />
                                <label for="email">
                                    <i class="fas fa-envelope"></i> Correo electrónico
                                </label>
                            </div>

                            <!-- Password -->
                            <div class="form-floating mb-3 position-relative">
                                <input
                                    class="form-control"
                                    id="password"
                                    name="password"
                                    type="password"
                                    placeholder="Contraseña"
                                    required />
                                <label for="password">
                                    <i class="fas fa-key"></i> Contraseña
                                </label>
                                <span class="password-toggle" onclick="togglePassword()">
                                    <i class="fas fa-eye" id="toggleIcon"></i>
                                </span>
                            </div>

                            <!-- Boton inicio sesion -->
                            <button class="btn btn-login" type="submit">
                                <i class="fas fa-sign-in-alt"></i> Iniciar sesión
                            </button>
                        </form>
                    </div>

                    <!-- Pie -->
                    <div class="login-footer">
                        <div>
                            &copy; 2025 <strong>Arbitraje VAR</strong> - Todos los derechos reservados
                        </div>
                        <div style="margin-top: 10px;">
                            Desarrollado por
                            <a href="https://telcored.cl" target="_blank">
                                <i class="fab fa-github"></i> telcored
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/scripts.js') }}"></script>

    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const toggleIcon = document.getElementById('toggleIcon');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.classList.remove('fa-eye');
                toggleIcon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                toggleIcon.classList.remove('fa-eye-slash');
                toggleIcon.classList.add('fa-eye');
            }
        }
    </script>
</body>

</html>