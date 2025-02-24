<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Corporación Nuevo Talento Humano - Desarrollo y formación profesional">
    <title>Corporación Nuevo Talento Humano</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <style>
        :root {
            --primary-color: #28a745;
            --secondary-color: #155724;
            --background-color: #f0f8f0;
            --white: #ffffff;
            --shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        body { 
            background: var(--background-color); 
            color: var(--secondary-color);
            font-family: 'Arial', sans-serif;
        }

        .navbar { 
            background-color: var(--primary-color);
            padding: 1rem 0;
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .navbar-brand, .nav-link { 
            color: var(--white) !important;
            transition: opacity 0.3s ease;
        }

        .navbar-brand:hover, .nav-link:hover {
            opacity: 0.8;
        }

        .navbar-toggler {
            border-color: var(--white);
        }

        .hero { 
            text-align: center;
            padding: 40px 0;
            background: var(--white);
            margin-bottom: 30px;
            box-shadow: var(--shadow);
            overflow: hidden;
        }

        .hero h1 {
            margin-bottom: 2rem;
            font-size: 2.5rem;
            animation: fadeInDown 1s ease-out;
        }

        .hero-image-container {
            width: 100%;
            max-width: 1200px;
            margin: 20px auto;
            padding: 0 15px;
            position: relative;
        }

        .hero img {
            width: 45%;
            height: 500px;
            object-fit: cover;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            transition: transform 0.3s ease;
            animation: fadeIn 1.5s ease-out;
        }

        .hero img:hover {
            transform: scale(1.01);
        }

        .section { 
            padding: 60px 20px;
            background: var(--white);
            margin-bottom: 30px;
            border-radius: 10px;
            box-shadow: var(--shadow);
        }

        .services .card {
            border: none;
            box-shadow: var(--shadow);
            margin-bottom: 20px;
            border-radius: 10px;
            transition: transform 0.3s ease;
            height: 100%;
        }

        .services .card:hover {
            transform: translateY(-5px);
        }

        .services .icon { 
            font-size: 50px; 
            color: var(--primary-color);
            margin-bottom: 15px;
        }

        .footer { 
            background: var(--primary-color); 
            color: var(--white); 
            text-align: center; 
            padding: 30px 0; 
            margin-top: 30px;
        }

        /* Animaciones */
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Media queries */
        @media (max-width: 768px) {
            .hero {
                padding: 30px 0;
            }

            .hero h1 {
                font-size: 2rem;
            }

            .hero img {
                height: 300px;
            }

            .section {
                padding: 40px 15px;
            }
        }

        @media (max-width: 576px) {
            .hero img {
                height: 250px;
                border-radius: 10px;
            }
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#">Nuevo Talento Humano</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" 
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="#about">Sobre Nosotros</a></li>
                    <li class="nav-item"><a class="nav-link" href="#services">Funcionalidades</a></li>
                    {{-- <li class="nav-item"><a class="nav-link" href="{{ route('tasks.index') }}">Administrador</a></li> --}}
                    <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Iniciar Sesión</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">Registrarse</a></li>
                    <!-- Rutas para el administrador (ocultas por defecto) -->
                    <li class="nav-item admin-link" style="display: none;"><a class="nav-link" href="{{ route('admin.login') }}">Admin Login</a></li>
                    <li class="nav-item admin-link" style="display: none;"><a class="nav-link" href="{{ route('admin.register') }}">Admin Registro</a></li>
                </ul>
                <!-- Botón con icono para activar modo admin -->
                <div class="ms-2">
                    <button id="adminAccessBtn" class="btn btn-sm" style="background: none; border: none; color: #ccc; opacity: 0.5; padding: 0 8px;" title="Acceso Admin">
                        <i class="fas fa-cog"></i>
                    </button>
                </div>
            </div>
        </div>
    </nav>


    <header class="hero">
        <div class="container">
            <h1 class="fw-bold">Corporación Nuevo Talento Humano</h1>
            <div class="hero-image-container">
                <img src="/img/corporacion.jpg" 
                     alt="Imagen de portada de Nuevo Talento Humano" 
                     loading="lazy"
                     class="shadow">
            </div>
        </div>
    </header>

    <main>
        <section id="about" class="section">
            <div class="container">
                <h2 class="text-center mb-4 fw-bold">Sobre Nosotros</h2>
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <p class="text-center lead">
                            Somos una corporación dedicada al desarrollo y formación del talento humano, 
                            comprometidos con el crecimiento profesional y personal de nuestra comunidad.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <section id="services" class="section services">
            <div class="container">
                <h2 class="text-center mb-5 fw-bold">Nuestros Servicios</h2>
                <div class="row">
                    <div class="col-md-4">
                        <div class="card text-center p-4">
                            <div class="icon">🎓</div>
                            <h4 class="fw-bold mb-3">Formación Profesional</h4>
                            <p class="mb-0">Programas de capacitación y desarrollo de habilidades para potenciar tu carrera.</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card text-center p-4">
                            <div class="icon">💼</div>
                            <h4 class="fw-bold mb-3">Desarrollo Laboral</h4>
                            <p class="mb-0">Orientación y vinculación laboral para impulsar tu crecimiento profesional.</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card text-center p-4">
                            <div class="icon">🤝</div>
                            <h4 class="fw-bold mb-3">Asesoría</h4>
                            <p class="mb-0">Acompañamiento personalizado para alcanzar tus metas profesionales.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <footer class="footer">
        <div class="container">
            <p class="m-0">&copy; 2025 Corporación Nuevo Talento Humano. Todos los derechos reservados.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Código secreto para mostrar los enlaces de administrador
        const secretCode = '1234';
        
        // Agregar evento al botón de acceso admin
        document.getElementById('adminAccessBtn').addEventListener('click', function(e) {
            e.preventDefault();
            
            // Solicitar código
            const userInput = prompt('Ingrese el código de acceso:');
            
            // Verificar si coincide con el código secreto
            if (userInput === secretCode) {
                // Mostrar enlaces de administrador
                document.querySelectorAll('.admin-link').forEach(function(link) {
                    link.style.display = 'block';
                });
                
                // Cambiar estilo del botón para indicar que está activado
                this.style.color = '#007bff';
                this.style.opacity = '1';
            }
        });
    });
</script>