<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="author" content="telcored" />
    <title>Acceso - Arbitraje VAR</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/all.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/common-football.css') }}" rel="stylesheet" />

    <style>
        body {
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: radial-gradient(circle at center, #1a2a1a 0%, #0a0a0a 100%);
            overflow: hidden;
        }

        .login-card {
            background: var(--glass-white);
            backdrop-filter: blur(20px);
            border: 1px solid var(--glass-border);
            border-radius: 30px;
            padding: 40px;
            width: 100%;
            max-width: 450px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
        }

        .login-logo {
            width: 80px;
            height: 80px;
            background: var(--pitch-green);
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2.5rem;
            color: black;
            margin: 0 auto 20px;
            box-shadow: 0 10px 20px rgba(29, 185, 84, 0.3);
            animation: bounce 3s infinite ease-in-out;
        }

        @keyframes bounce {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-10px);
            }
        }

        .form-floating>.form-control {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid var(--glass-border);
            color: white;
            border-radius: 15px;
        }

        .form-floating>.form-control:focus {
            background: rgba(255, 255, 255, 0.08);
            border-color: var(--pitch-green);
            box-shadow: 0 0 15px rgba(29, 185, 84, 0.1);
            color: white;
        }

        .form-floating>label {
            color: rgba(255, 255, 255, 0.5);
        }

        .btn-login {
            background: linear-gradient(90deg, var(--pitch-green), #158f43);
            border: none;
            color: black;
            font-weight: 700;
            border-radius: 15px;
            padding: 15px;
            width: 100%;
            margin-top: 20px;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(29, 185, 84, 0.3);
        }
    </style>
</head>

<body>
    <div class="container d-flex justify-content-center">
        <div class="login-card">
            <div class="text-center mb-4">
                <div class="login-logo">
                    <i class="fas fa-futbol"></i>
                </div>
                <h2 class="fw-bold text-white mb-1">Arbitraje VAR</h2>
                <p class="text-muted small">Panel Tecnológico Administrativo</p>
            </div>

            @if(session('error'))
            <div class="alert alert-danger border-0 bg-danger text-white small rounded-4 mb-4">
                <i class="fas fa-exclamation-circle me-2"></i> {{ session('error') }}
            </div>
            @endif

            <form action="/login" method="post" autocomplete="off">
                @csrf
                <div class="form-floating mb-3">
                    <input type="email" class="form-control" id="email" name="email" placeholder="nombre@ejemplo.com" required autofocus>
                    <label for="email"><i class="fas fa-envelope me-2"></i>Correo electrónico</label>
                </div>

                <div class="form-floating mb-4">
                    <input type="password" class="form-control" id="password" name="password" placeholder="Contraseña" required>
                    <label for="password"><i class="fas fa-key me-2"></i>Contraseña</label>
                </div>

                <button type="submit" class="btn btn-login">
                    Iniciar Sesión <i class="fas fa-arrow-right ms-2"></i>
                </button>
            </form>

            <div class="text-center mt-5">
                <p class="text-muted small mb-0">Desarrollado por</p>
                <a href="https://telcored.cl" class="text-gradient fw-bold text-decoration-none">{ /telcored }</a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>