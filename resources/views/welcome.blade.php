<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Corporación Nuevo Talento Humano</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body { background: #f0f8f0; color: #155724; }
        .navbar { background-color: #28a745; }
        .navbar-brand, .nav-link { color: white !important; }
        .hero { text-align: center; padding: 80px 20px; background: white; }
        .hero img { width: 100%; max-height: 400px; object-fit: cover; border-radius: 10px; }
        .section { padding: 50px 20px; }
        .services .icon { font-size: 40px; color: #28a745; }
        .gallery img { width: 100%; height: auto; border-radius: 10px; }
        .testimonial { background: white; padding: 20px; border-radius: 10px; box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1); }
        .footer { background: #28a745; color: white; text-align: center; padding: 20px 0; margin-top: 30px; }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="#">Nuevo Talento Humano</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="#about">Sobre Nosotros</a></li>
                    <li class="nav-item"><a class="nav-link" href="#services">Servicios</a></li>
                    <li class="nav-item"><a class="nav-link" href="#gallery">Galería</a></li>
                    <li class="nav-item"><a class="nav-link" href="#contact">Contacto</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('tasks.index') }}">Administrador de Tareas</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <header class="hero">
        <div class="container">
            <h1>Bienvenido a Nuevo Talento Humano</h1>
            <p>Impulsamos el crecimiento de talento con pasión y compromiso.</p>
            <img src="https://via.placeholder.com/1200x400" alt="Imagen de portada">
        </div>
    </header>

    <!-- Sobre Nosotros -->
    <section id="about" class="section bg-white">
        <div class="container text-center">
            <h2>Sobre Nosotros</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam vehicula sem id purus consectetur, nec luctus velit tincidunt.</p>
        </div>
    </section>

    <!-- Servicios -->
    <section id="services" class="section text-center">
        <div class="container">
            <h2>Nuestros Servicios</h2>
            <div class="row">
                <div class="col-md-4">
                    <div class="icon">🛠️</div>
                    <h4>Desarrollo Profesional</h4>
                    <p>Capacitaciones y talleres para mejorar habilidades.</p>
                </div>
                <div class="col-md-4">
                    <div class="icon">💼</div>
                    <h4>Oportunidades Laborales</h4>
                    <p>Conectamos talento con empresas líderes.</p>
                </div>
                <div class="col-md-4">
                    <div class="icon">🎓</div>
                    <h4>Educación y Becas</h4>
                    <p>Accede a programas educativos exclusivos.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Galería -->
    <section id="gallery" class="section bg-white">
        <div class="container text-center">
            <h2>Nuestra Galería</h2>
            <div class="row">
                <div class="col-md-4"><img src="https://via.placeholder.com/400" alt="Imagen 1" class="gallery"></div>
                <div class="col-md-4"><img src="https://via.placeholder.com/400" alt="Imagen 2" class="gallery"></div>
                <div class="col-md-4"><img src="https://via.placeholder.com/400" alt="Imagen 3" class="gallery"></div>
            </div>
        </div>
    </section>

    <!-- Testimonios -->
    <section class="section text-center">
        <div class="container">
            <h2>Lo que dicen de nosotros</h2>
            <div class="row">
                <div class="col-md-4">
                    <div class="testimonial">
                        <p>“Excelente organización, me ayudaron a encontrar el trabajo ideal.”</p>
                        <h5>- Juan Pérez</h5>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="testimonial">
                        <p>“Gracias a ellos mejoré mis habilidades y conseguí una beca.”</p>
                        <h5>- María Rodríguez</h5>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="testimonial">
                        <p>“Gran equipo, ofrecen oportunidades reales y apoyo constante.”</p>
                        <h5>- Carlos Gómez</h5>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contacto -->
    <section id="contact" class="section bg-white">
        <div class="container text-center">
            <h2>Contacto</h2>
            <p>Envíanos un mensaje y te responderemos lo antes posible.</p>
            <form class="row g-3">
                <div class="col-md-6">
                    <input type="text" class="form-control" placeholder="Nombre" required>
                </div>
                <div class="col-md-6">
                    <input type="email" class="form-control" placeholder="Correo Electrónico" required>
                </div>
                <div class="col-12">
                    <textarea class="form-control" rows="4" placeholder="Mensaje" required></textarea>
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-success">Enviar Mensaje</button>
                </div>
            </form>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <p>&copy; 2025 Corporación Nuevo Talento Humano. Todos los derechos reservados.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
