<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Corporación Nuevo Talento Humano - Desarrollo y formación profesional">
    <title>Corporación Nuevo Talento Humano</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
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

        .section.alternate {
            background: linear-gradient(to right, rgba(40, 167, 69, 0.05), rgba(40, 167, 69, 0.1));
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
            <a class="navbar-brand fw-bold" href="#">Corporación Nuevo Talento Humano</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" 
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="#corporacion">Quiénes Somos</a></li>
                    <li class="nav-item"><a class="nav-link" href="#about">Sobre el Proyecto</a></li>
                    <li class="nav-item"><a class="nav-link" href="#services">Funcionalidades</a></li>
                    <li class="nav-item"><a class="nav-link" href="#software">El Software</a></li>
                    {{-- <li class="nav-item"><a class="nav-link" href="{{ route('tasks.index') }}">Gestión de Tareas</a></li> --}}
                    <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Iniciar Sesión</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">Registrarse</a></li>
                    <li class="nav-item admin-link" style="display: none;"><a class="nav-link" href="{{ route('admin.login') }}">Admin Login</a></li>
                    <li class="nav-item admin-link" style="display: none;"><a class="nav-link" href="{{ route('admin.register') }}">Admin Registro</a></li>
                </ul>
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
            <h1 class="fw-bold">Sistema de Gestión de Tareas</h1>
            <p class="lead mb-4">Optimizando procesos para la Corporación Nuevo Talento Humano</p>
            <div class="hero-image-container">
                <img src="/img/corporacion.jpg" 
                     alt="Imagen de gestión de tareas" 
                     loading="lazy"
                     class="shadow">
            </div>
        </div>
    </header>

    <main>
        <section id="corporacion" class="section alternate">
            <div class="container">
                <h2 class="text-center mb-4 fw-bold">Corporación Nuevo Talento Humano</h2>
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <p class="text-center lead">
                            La <strong>Corporación Nuevo Talento Humano</strong> es una institución dedicada al desarrollo profesional 
                            y la formación integral de personas comprometidas con el progreso social y económico.
                        </p>
                        <p class="text-center">
                            Con más de 10 años de experiencia en el sector educativo y formativo, nuestra corporación se ha consolidado 
                            como un referente en la implementación de programas innovadores que responden a las necesidades del mercado laboral actual.
                        </p>
                        <div class="row mt-4">
                            <div class="col-md-6 mb-3">
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-graduation-cap text-success me-3 fs-4"></i>
                                    <div>
                                        <h5 class="fw-bold mb-0">Formación Profesional</h5>
                                        <p class="mb-0">Programas actualizados y pertinentes</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-users text-success me-3 fs-4"></i>
                                    <div>
                                        <h5 class="fw-bold mb-0">Desarrollo Integral</h5>
                                        <p class="mb-0">Habilidades técnicas y humanas</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="about" class="section">
            <div class="container">
                <h2 class="text-center mb-4 fw-bold">Sobre el Proyecto</h2>
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <p class="text-center lead">
                            Este sistema ha sido diseñado específicamente para la <strong>Corporación Nuevo Talento Humano</strong> con el fin 
                            de mejorar la organización y eficiencia en la gestión de tareas institucionales.
                        </p>
                        <p class="text-center">
                            A través de esta plataforma, los colaboradores podrán asignar, monitorear y completar tareas de manera estructurada, 
                            asegurando que todos los procesos se lleven a cabo de manera ordenada y efectiva.
                        </p>
                        <p class="text-center">
                            Con una interfaz intuitiva y accesible, el sistema permite a los usuarios visualizar sus responsabilidades, establecer fechas 
                            límite y colaborar con otros miembros del equipo.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <section id="services" class="section services">
            <div class="container">
                <h2 class="text-center mb-5 fw-bold">Funcionalidades Principales</h2>
                <div class="row">
                    <div class="col-md-4 mb-4">
                        <div class="card text-center p-4">
                            <div class="icon">📝</div>
                            <h4 class="fw-bold mb-3">Gestión de Tareas</h4>
                            <p class="mb-0">Creación, asignación y seguimiento de tareas dentro de la corporación con notificaciones automáticas.</p>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4">
                        <div class="card text-center p-4">
                            <div class="icon">📅</div>
                            <h4 class="fw-bold mb-3">Calendario de Actividades</h4>
                            <p class="mb-0">Organización y planificación de actividades con fechas clave y recordatorios.</p>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4">
                        <div class="card text-center p-4">
                            <div class="icon">📊</div>
                            <h4 class="fw-bold mb-3">Reportes y Análisis</h4>
                            <p class="mb-0">Generación de informes detallados sobre el estado y progreso de las tareas.</p>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4">
                        <div class="card text-center p-4">
                            <div class="icon">👥</div>
                            <h4 class="fw-bold mb-3">Gestión de Equipos</h4>
                            <p class="mb-0">Creación y administración de equipos de trabajo con asignación de roles.</p>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4">
                        <div class="card text-center p-4">
                            <div class="icon">📂</div>
                            <h4 class="fw-bold mb-3">Gestión Documental</h4>
                            <p class="mb-0">Almacenamiento y organización de documentos relacionados con cada tarea.</p>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4">
                        <div class="card text-center p-4">
                            <div class="icon">🔔</div>
                            <h4 class="fw-bold mb-3">Sistema de Notificaciones</h4>
                            <p class="mb-0">Alertas personalizables para fechas límite y asignaciones de nuevas tareas.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="software" class="section alternate">
            <div class="container">
                <h2 class="text-center mb-5 fw-bold">El Software en Detalle</h2>
                <div class="row">
                    <div class="col-lg-6 mb-4">
                        <h3 class="fw-bold mb-3">Características Técnicas</h3>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item bg-transparent">
                                <i class="fas fa-server text-success me-2"></i> 
                                <strong>Arquitectura Robusta:</strong> Desarrollado con Laravel, garantizando estabilidad y seguridad.
                            </li>
                            <li class="list-group-item bg-transparent">
                                <i class="fas fa-database text-success me-2"></i> 
                                <strong>Base de Datos Optimizada:</strong> Sistema MySQL para consultas rápidas y eficientes.
                            </li>
                            <li class="list-group-item bg-transparent">
                                <i class="fas fa-shield-alt text-success me-2"></i> 
                                <strong>Seguridad Avanzada:</strong> Protocolos de seguridad para proteger datos sensibles.
                            </li>
                            <li class="list-group-item bg-transparent">
                                <i class="fas fa-mobile-alt text-success me-2"></i> 
                                <strong>Diseño Responsivo:</strong> Interfaz adaptable a diferentes dispositivos.
                            </li>
                        </ul>
                    </div>
                    <div class="col-lg-6">
                        <h3 class="fw-bold mb-3">Módulos del Sistema</h3>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item bg-transparent">
                                <i class="fas fa-users-cog text-success me-2"></i> 
                                <strong>Administración de Usuarios:</strong> Gestión de perfiles con diferentes niveles de acceso.
                            </li>
                            <li class="list-group-item bg-transparent">
                                <i class="fas fa-tasks text-success me-2"></i> 
                                <strong>Gestión de Tareas:</strong> Creación, asignación y seguimiento de actividades.
                            </li>
                            <li class="list-group-item bg-transparent">
                                <i class="fas fa-chart-line text-success me-2"></i> 
                                <strong>Reportes y Estadísticas:</strong> Informes personalizados sobre rendimiento.
                            </li>
                            <li class="list-group-item bg-transparent">
                                <i class="fas fa-comments text-success me-2"></i> 
                                <strong>Comunicación Interna:</strong> Sistema de mensajería relacionada con tareas.
                            </li>
                            <li class="list-group-item bg-transparent">
                                <i class="fas fa-cogs text-success me-2"></i> 
                                <strong>Configuración:</strong> Personalización de parámetros según necesidades específicas.
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        <section id="benefits" class="section">
            <div class="container">
                <h2 class="text-center mb-4 fw-bold">Beneficios para la Corporación</h2>
                <div class="row justify-content-center">
                    <div class="col-md-10">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="d-flex align-items-start">
                                    <i class="fas fa-check-circle text-success me-3 fs-4 mt-1"></i>
                                    <div>
                                        <h5 class="fw-bold mb-1">Optimización de Procesos</h5>
                                        <p class="mb-0">Reducción de tiempos en la gestión y seguimiento de actividades.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="d-flex align-items-start">
                                    <i class="fas fa-check-circle text-success me-3 fs-4 mt-1"></i>
                                    <div>
                                        <h5 class="fw-bold mb-1">Mejora en la Comunicación</h5>
                                        <p class="mb-0">Mayor fluidez en el intercambio de información entre equipos.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="d-flex align-items-start">
                                    <i class="fas fa-check-circle text-success me-3 fs-4 mt-1"></i>
                                    <div>
                                        <h5 class="fw-bold mb-1">Control y Seguimiento</h5>
                                        <p class="mb-0">Monitoreo en tiempo real del avance de tareas y proyectos.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="d-flex align-items-start">
                                    <i class="fas fa-check-circle text-success me-3 fs-4 mt-1"></i>
                                    <div>
                                        <h5 class="fw-bold mb-1">Toma de Decisiones</h5>
                                        <p class="mb-0">Informes detallados para una gestión estratégica más efectiva.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-6 text-md-start">
                    <p>&copy; 2025 Corporación Nuevo Talento Humano. Todos los derechos reservados.</p>
                </div>
                <div class="col-md-6 text-md-end">
                    <div class="d-inline-block">
                        <a href="#" class="text-white me-3"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="text-white me-3"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="text-white me-3"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="text-white"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
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
</body>
</html>