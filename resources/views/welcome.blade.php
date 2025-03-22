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
            --primary-dark: #218838;
            --secondary-color: #155724;
            --background-color: #f7f9f7;
            --light-green: #e9f7ef;
            --white: #ffffff;
            --shadow: 0 4px 12px rgba(0,0,0,0.08);
            --box-shadow-hover: 0 10px 25px rgba(40, 167, 69, 0.15);
            --transition: all 0.3s ease;
        }

        body { 
            background: var(--background-color); 
            color: #333;
            font-family: 'Poppins', sans-serif;
            line-height: 1.6;
            overflow-x: hidden;
        }

        /* Scrollbar personalizado */
        ::-webkit-scrollbar {
            width: 10px;
        }
        
        ::-webkit-scrollbar-track {
            background: #f1f1f1; 
        }
        
        ::-webkit-scrollbar-thumb {
            background: var(--primary-color); 
            border-radius: 10px;
        }
        
        ::-webkit-scrollbar-thumb:hover {
            background: var(--primary-dark); 
        }

        .btn-success {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            transition: var(--transition);
        }

        .btn-success:hover {
            background-color: var(--primary-dark);
            border-color: var(--primary-dark);
            transform: translateY(-2px);
        }

        .btn-outline-success {
            color: var(--primary-color);
            border-color: var(--primary-color);
        }

        .btn-outline-success:hover {
            background-color: var(--primary-color);
            color: var(--white);
        }

        /* Navbar mejorado */
        .navbar { 
            background-color: var(--white);
            padding: 0.8rem 0;
            position: sticky;
            top: 0;
            z-index: 1000;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            transition: var(--transition);
        }

        .navbar.scrolled {
            padding: 0.5rem 0;
        }

        .navbar-brand { 
            color: var(--primary-color) !important;
            font-weight: 600;
            font-size: 1.5rem;
        }

        .nav-link { 
            color: #333 !important;
            font-weight: 500;
            padding: 0.5rem 1rem !important;
            position: relative;
            transition: var(--transition);
        }

        .nav-link:hover,
        .nav-link.active { 
            color: var(--primary-color) !important;
        }

        .nav-link::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            width: 0;
            height: 2px;
            background: var(--primary-color);
            transition: var(--transition);
            transform: translateX(-50%);
        }

        .nav-link:hover::after,
        .nav-link.active::after {
            width: 60%;
        }

        .navbar-toggler {
            border: none;
            padding: 0;
        }

        .navbar-toggler:focus {
            box-shadow: none;
        }

        .action-buttons .btn {
            margin-left: 0.5rem;
            border-radius: 50px;
            padding: 0.4rem 1.2rem;
        }

        /* Hero section mejorado */
        .hero { 
            text-align: center;
            padding: 100px 0 70px;
            background: var(--white);
            margin-bottom: 60px;
            position: relative;
            overflow: hidden;
        }

        .hero::before {
            content: '';
            position: absolute;
            top: -100px;
            right: -100px;
            width: 400px;
            height: 400px;
            background: rgba(40, 167, 69, 0.05);
            border-radius: 50%;
            z-index: 0;
        }

        .hero::after {
            content: '';
            position: absolute;
            bottom: -100px;
            left: -100px;
            width: 300px;
            height: 300px;
            background: rgba(40, 167, 69, 0.03);
            border-radius: 50%;
            z-index: 0;
        }

        .hero-content {
            position: relative;
            z-index: 1;
        }

        .hero h1 {
            margin-bottom: 1.5rem;
            font-size: 3rem;
            font-weight: 700;
            animation: fadeInDown 1s ease-out;
            color: var(--secondary-color);
        }

        .hero p.lead {
            font-size: 1.25rem;
            margin-bottom: 2rem;
            animation: fadeIn 1.5s ease-out;
            max-width: 800px;
            margin-left: auto;
            margin-right: auto;
        }

        .hero-image-container {
            width: 100%;
            max-width: 1200px;
            margin: 30px auto 0;
            padding: 0 15px;
            position: relative;
        }

        .hero-image-wrapper {
            position: relative;
            display: inline-block;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: var(--shadow);
        }

        .hero img {
            width: 100%;
            max-width: 700px;
            object-fit: cover;
            display: block;
            transform: scale(1.01);
            transition: transform 0.5s ease;
            animation: fadeIn 1.5s ease-out;
        }

        .hero-image-wrapper:hover img {
            transform: scale(1.05);
        }

        .cta-buttons {
            margin-top: 2rem;
            animation: fadeInUp 1.5s ease-out;
        }

        .cta-buttons .btn {
            border-radius: 50px;
            padding: 0.8rem 2rem;
            font-weight: 500;
            margin: 0 0.5rem 1rem;
            transition: var(--transition);
        }

        .cta-buttons .btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }

        /* Secciones mejoradas */
        .section { 
            padding: 80px 0;
            background: var(--white);
            margin-bottom: 60px;
            border-radius: 15px;
            box-shadow: var(--shadow);
            position: relative;
            overflow: hidden;
        }

        .section.alternate {
            background: linear-gradient(135deg, var(--light-green), rgba(255,255,255,0.9));
        }

        .section h2 {
            margin-bottom: 50px;
            position: relative;
            display: inline-block;
            font-weight: 700;
            color: var(--secondary-color);
        }

        .section h2::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 70%;
            height: 3px;
            background: var(--primary-color);
            border-radius: 10px;
        }

        .section .lead {
            font-size: 1.15rem;
            margin-bottom: 30px;
            color: #555;
        }

        /* Servicios y cards */
        .services .card {
            border: none;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
            margin-bottom: 30px;
            border-radius: 15px;
            transition: var(--transition);
            height: 100%;
            position: relative;
            z-index: 1;
            overflow: hidden;
            background: var(--white);
        }

        .services .card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 0;
            background: linear-gradient(to bottom, rgba(40, 167, 69, 0.05), rgba(255,255,255,0));
            transition: var(--transition);
            z-index: -1;
        }

        .services .card:hover {
            transform: translateY(-10px);
            box-shadow: var(--box-shadow-hover);
        }

        .services .card:hover::before {
            height: 100%;
        }

        .services .icon { 
            font-size: 60px; 
            color: var(--primary-color);
            margin-bottom: 20px;
            transition: var(--transition);
        }

        .services .card:hover .icon {
            transform: scale(1.1);
        }

        .services .card h4 {
            font-weight: 600;
            margin-bottom: 15px;
            transition: var(--transition);
            color: var(--secondary-color);
        }

        .services .card p {
            color: #666;
            transition: var(--transition);
        }

        /* Características y listas */
        .feature-list .list-group-item {
            border: none;
            padding: 0.8rem 0;
            margin-bottom: 0.5rem;
            background: transparent;
            transition: var(--transition);
        }

        .feature-list i {
            font-size: 1.2rem;
            width: 30px;
            height: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            background: rgba(40, 167, 69, 0.1);
            color: var(--primary-color);
            margin-right: 15px;
            transition: var(--transition);
        }

        .feature-list .list-group-item:hover i {
            background: var(--primary-color);
            color: var(--white);
        }

        .feature-list .list-group-item:hover {
            transform: translateX(5px);
        }

        .feature-list h5 {
            font-weight: 600;
            color: var(--secondary-color);
        }

        /* Beneficios */
        .benefits .benefit-item {
            background: var(--white);
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
            transition: var(--transition);
            height: 100%;
            margin-bottom: 20px;
        }

        .benefits .benefit-item:hover {
            transform: translateY(-5px);
            box-shadow: var(--box-shadow-hover);
        }

        .benefits i {
            width: 50px;
            height: 50px;
            background: rgba(40, 167, 69, 0.1);
            color: var(--primary-color);
            font-size: 1.4rem;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 12px;
            margin-bottom: 20px;
            transition: var(--transition);
        }

        .benefits .benefit-item:hover i {
            background: var(--primary-color);
            color: var(--white);
            transform: rotateY(180deg);
        }

        .benefits h4 {
            font-weight: 600;
            margin-bottom: 15px;
            color: var(--secondary-color);
        }

        /* Footer mejorado */
        .footer { 
            background: var(--primary-dark); 
            color: var(--white); 
            padding: 70px 0 30px; 
            margin-top: 60px;
            position: relative;
        }

        .footer::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 3px;
            background: linear-gradient(to right, var(--primary-color), var(--primary-dark), var(--primary-color));
        }

        .footer h5 {
            font-weight: 600;
            margin-bottom: 25px;
            position: relative;
            display: inline-block;
        }

        .footer h5::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 0;
            width: 40px;
            height: 2px;
            background: var(--white);
        }

        .footer-links {
            list-style: none;
            padding: 0;
        }

        .footer-links li {
            margin-bottom: 12px;
        }

        .footer-links a {
            color: rgba(255,255,255,0.8);
            text-decoration: none;
            transition: var(--transition);
            display: inline-block;
        }

        .footer-links a:hover {
            color: var(--white);
            transform: translateX(5px);
        }

        .social-links a {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            background: rgba(255,255,255,0.1);
            border-radius: 50%;
            margin-right: 10px;
            color: var(--white);
            text-decoration: none;
            transition: var(--transition);
        }

        .social-links a:hover {
            background: var(--white);
            color: var(--primary-color);
            transform: translateY(-3px);
        }

        .footer-bottom {
            border-top: 1px solid rgba(255,255,255,0.1);
            padding-top: 30px;
            margin-top: 50px;
            text-align: center;
        }

        /* Animaciones */
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Estilos para admin-access */
        .admin-access {
            position: relative;
        }

        .admin-access-btn {
            background: none;
            border: none;
            color: #aaa;
            opacity: 0.7;
            padding: 8px;
            border-radius: 50%;
            transition: var(--transition);
        }

        .admin-access-btn:hover {
            background: rgba(0,0,0,0.05);
            color: #888;
        }

        .admin-access-btn.active {
            color: var(--primary-color);
            opacity: 1;
        }

        /* Media queries */
        @media (max-width: 991px) {
            .navbar-collapse {
                background: var(--white);
                padding: 15px;
                box-shadow: 0 10px 15px rgba(0,0,0,0.05);
                border-radius: 10px;
                margin-top: 10px;
            }

            .action-buttons {
                margin-top: 15px;
            }

            .action-buttons .btn {
                margin: 5px;
                display: block;
                width: 100%;
            }
        }

        @media (max-width: 768px) {
            .hero {
                padding: 60px 0 40px;
            }

            .hero h1 {
                font-size: 2.2rem;
            }

            .section {
                padding: 50px 0;
            }

            .footer {
                padding: 50px 0 20px;
            }

            .footer-widget {
                margin-bottom: 30px;
            }
        }

        @media (max-width: 576px) {
            .hero h1 {
                font-size: 1.8rem;
            }

            .hero p.lead {
                font-size: 1rem;
            }

            .section h2 {
                font-size: 1.5rem;
                margin-bottom: 30px;
            }

            .cta-buttons .btn {
                display: block;
                width: 100%;
                margin: 0 0 15px;
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
                    {{-- <li class="nav-item"><a class="nav-link" href="#software">El Software</a></li> --}}
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
            <div class="hero-content">
                <h1 class="animate__animated animate__fadeInDown">Sistema de Gestión de Tareas</h1>
                <p class="lead animate__animated animate__fadeIn">Optimizando procesos y potenciando el desarrollo profesional en la Corporación Nuevo Talento Humano</p>
                
                <div class="cta-buttons">
                    <a href="{{ route('register') }}" class="btn btn-success btn-lg">Comenzar ahora</a>
                    <a href="#about" class="btn btn-outline-success btn-lg">Conocer más</a>
                </div>
                
                <div class="hero-image-container">
                    <div class="hero-image-wrapper">
                        <img src="/img/corporacion.jpg" 
                            alt="Corporación Nuevo Talento Humano" 
                            loading="lazy"
                            class="img-fluid">
                    </div>
                </div>
            </div>
        </div>
    </header>

    <main>
        <section id="corporacion" class="section alternate">
            <div class="container">
                <h2 class="text-center animate__animated animate__fadeInUp">Corporación Nuevo Talento Humano</h2>
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <p class="text-center lead animate__animated animate__fadeIn">
                            La <strong>Corporación Nuevo Talento Humano</strong> es una institución líder dedicada al desarrollo profesional 
                            y la formación integral de personas comprometidas con el progreso social y económico.
                        </p>
                        <p class="text-center animate__animated animate__fadeIn">
                            Con más de 10 años de experiencia en el sector educativo y formativo, nuestra corporación se ha consolidado 
                            como un referente en la implementación de programas innovadores que responden a las necesidades del mercado laboral actual.
                        </p>
                        
                        <div class="row mt-5">
                            <div class="col-md-6 mb-4">
                                <div class="d-flex align-items-center feature-item">
                                    <div class="feature-icon me-3">
                                        <i class="fas fa-graduation-cap text-success fa-2x"></i>
                                    </div>
                                    <div>
                                        <h4 class="fw-bold mb-2">Formación Profesional</h4>
                                        <p class="mb-0">Programas actualizados y pertinentes diseñados para satisfacer las demandas actuales del mercado laboral.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <div class="d-flex align-items-center feature-item">
                                    <div class="feature-icon me-3">
                                        <i class="fas fa-users text-success fa-2x"></i>
                                    </div>
                                    <div>
                                        <h4 class="fw-bold mb-2">Desarrollo Integral</h4>
                                        <p class="mb-0">Desarrollo de habilidades técnicas, sociales y humanas que potencian el crecimiento personal y profesional.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <div class="d-flex align-items-center feature-item">
                                    <div class="feature-icon me-3">
                                        <i class="fas fa-lightbulb text-success fa-2x"></i>
                                    </div>
                                    <div>
                                        <h4 class="fw-bold mb-2">Innovación Constante</h4>
                                        <p class="mb-0">Implementación de metodologías innovadoras y tecnologías de vanguardia en todos nuestros procesos.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <div class="d-flex align-items-center feature-item">
                                    <div class="feature-icon me-3">
                                        <i class="fas fa-handshake text-success fa-2x"></i>
                                    </div>
                                    <div>
                                        <h4 class="fw-bold mb-2">Compromiso Social</h4>
                                        <p class="mb-0">Dedicación a la transformación positiva de la sociedad a través de la educación y el desarrollo de talento.</p>
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
                <h2 class="text-center">Sobre el Proyecto</h2>
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <p class="text-center lead">
                            Este sistema ha sido diseñado específicamente para la <strong>Corporación Nuevo Talento Humano</strong> con el fin 
                            de optimizar la organización y eficiencia en la gestión de tareas institucionales.
                        </p>
                        <div class="row align-items-center mt-5">
                            <div class="col-md-6 mb-4 mb-md-0">
                                <div class="about-image text-center">
                                    <img src="/api/placeholder/400/320" alt="Gestión de tareas" class="img-fluid rounded-3 shadow-sm">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="about-content">
                                    <h3 class="fw-bold mb-3">Plataforma Integral</h3>
                                    <p>
                                        A través de esta plataforma intuitiva, los colaboradores pueden asignar, monitorear y completar tareas 
                                        de manera estructurada, asegurando procesos ordenados y efectivos.
                                    </p>
                                    <p>
                                        El sistema permite visualizar responsabilidades, establecer fechas límite y facilitar la colaboración 
                                        entre los miembros del equipo de forma transparente y eficiente.
                                    </p>
                                    <a href="#services" class="btn btn-success mt-3">
                                        Ver funcionalidades <i class="fas fa-arrow-right ms-2"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="services" class="section services alternate">
            <div class="container">
                <h2 class="text-center">Funcionalidades Principales</h2>
                <div class="row">
                    <div class="col-md-4 mb-4">
                        <div class="card text-center p-4">
                            <div class="icon">
                                <i class="fas fa-tasks"></i>
                            </div>
                            <h4 class="fw-bold mb-3">Gestión de Tareas</h4>
                            <p class="mb-0">Creación, asignación y seguimiento de tareas con notificaciones automáticas y estado en tiempo real.</p>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4">
                        <div class="card text-center p-4">
                            <div class="icon">
                                <i class="far fa-calendar-alt"></i>
                            </div>
                            <h4 class="fw-bold mb-3">Calendario Inteligente</h4>
                            <p class="mb-0">Organización y planificación de actividades con fechas clave, recordatorios y sincronización multiusuario.</p>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4">
                        <div class="card text-center p-4">
                            <div class="icon">
                                <i class="fas fa-chart-bar"></i>
                            </div>
                            <h4 class="fw-bold mb-3">Reportes Avanzados</h4>
                            <p class="mb-0">Generación de informes detallados y análisis estadísticos sobre el progreso y rendimiento de las tareas.</p>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4">
                        <div class="card text-center p-4">
                            <div class="icon">
                                <i class="fas fa-users-cog"></i>
                            </div>
                            <h4 class="fw-bold mb-3">Gestión de Equipos</h4>
                            <p class="mb-0">Creación y administración de equipos de trabajo con asignación de roles y seguimiento de rendimiento.</p>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4">
                        <div class="card text-center p-4">
                            <div class="icon">
                                <i class="fas fa-file-alt"></i>
                            </div>
                            <h4 class="fw-bold mb-3">Gestión Documental</h4>
                            <p class="mb-0">Almacenamiento, categorización y búsqueda rápida de documentos relacionados con cada tarea y proyecto.</p>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4">
                        <div class="card text-center p-4">
                            <div class="icon">
                                <i class="fas fa-bell"></i>
                            </div>
                            <h4 class="fw-bold mb-3">Sistema de Alertas</h4>
                            <p class="mb-0">Notificaciones personalizables para fechas límite, asignaciones y cambios de estado en las tareas.</p>
                        </div>
                    </div>
                </div>

                <div class="text-center mt-4">
                    <a href="{{ route('register') }}" class="btn btn-success btn-lg">
                        Comenzar a utilizar el sistema <i class="fas fa-arrow-right ms-2"></i>        
                    </a>
                </div>
            </div>
        </section>
        
        <section id="contact" class="section">
            <div class="container">
                <h2 class="text-center">Contacto</h2>
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <form id="contactForm">
                            <div class="mb-3">
                                <label for="name" class="form-label">Nombre:</label>
                                <input type="text" name="name" id="name" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Correo electrónico:</label>
                                <input type="email" name="email" id="email" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="message" class="form-label">Mensaje:</label>
                                <textarea name="message" id="message" class="form-control" rows="5" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Enviar</button>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <footer class="footer">
        <div class="container">
            <p>&copy; 2023 Gestión de Tareas. Todos los derechos reservados.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/waypoints/4.0.1/jquery.waypoints.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Counter-Up/1.0.0/jquery.counterup.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.counter').counterUp({
                delay: 10,
                time: 2000
            });
        });

        document.addEventListener("DOMContentLoaded", function () {
        const adminAccessBtn = document.getElementById("adminAccessBtn");
        const adminPasswordInput = document.getElementById("adminPasswordInput");
        const adminLinks = document.querySelectorAll(".admin-link");

        const adminPassword = "Admin2024"; // Cambia esto por la contraseña que quieras

        adminAccessBtn.addEventListener("click", function () {
            adminPasswordInput.classList.toggle("d-none");
            adminPasswordInput.focus();
        });

        adminPasswordInput.addEventListener("keypress", function (event) {
            if (event.key === "Enter") {
                if (adminPasswordInput.value === adminPassword) {
                    adminLinks.forEach(link => link.style.display = "block");
                    adminPasswordInput.classList.add("d-none");
                    adminPasswordInput.value = "";
                } else {
                    alert("Contraseña incorrecta.");
                    adminPasswordInput.value = "";
                }
            }
        });
    });
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