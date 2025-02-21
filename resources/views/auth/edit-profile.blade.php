<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Perfil</title>
    
    <!-- Enlace a Bootstrap 5 para estilos -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

    <style>
        /* Estilos generales del cuerpo */
        body {
            display: flex;
            min-height: 100vh;
            background-color: #f8f9fa;
        }

        /* Barra lateral de navegación */
        .sidebar {
            width: 250px;
            background: #212529;
            color: white;
            padding: 20px;
            position: fixed;
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        /* Enlaces de la barra lateral */
        .sidebar a {
            color: white !important;
            text-decoration: none;
            display: block;
            padding: 12px;
            margin: 8px 0;
            border-radius: 5px;
            font-weight: 500;
            transition: background-color 0.3s ease;
        }

        /* Estilo cuando se pasa el cursor o está activo */
        .sidebar a:hover, .sidebar .active {
            background: #2e7d32;
        }

        /* Contenedor del contenido principal */
        .content {
            margin-left: 270px;
            flex-grow: 1;
            padding: 30px;
        }

        /* Contenedor del formulario */
        .form-container {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 500px;
        }

        /* Botón principal de actualización */
        .btn-primary {
            background: #2e7d32;
            border: none;
            transition: background 0.3s ease;
        }

        .btn-primary:hover {
            background: #19692c;
        }

        /* Botón secundario (cancelar) */
        .btn-secondary {
            background: #6c757d;
            border: none;
        }

        .btn-secondary:hover {
            background: #5a6268;
        }

        /* Botón de cierre de sesión */
        .logout-btn {
            background: #2e7d32;
            color: white;
            text-align: center;
            display: block;
            padding: 12px;
            margin-top: 10px;
            border-radius: 5px;
            font-weight: 500;
            text-decoration: none;
            transition: background 0.3s ease;
        }

        .logout-btn:hover {
            background: #19692c;
        }
    </style>
</head>
<body>

    <!-- Barra lateral -->
    <div class="sidebar">
        <h5>⚙️ Configuración</h5>
        
        <!-- Enlaces de navegación -->
        <a href="{{ route('dashboard') }}">🏠 Volver al Perfil</a>
        <a href="#" class="active">✏️ Editar Perfil</a>

        <!-- Botón de cierre de sesión -->
        <form action="{{ route('logout') }}" method="POST" class="mt-auto">
            @csrf
            <button type="submit" class="logout-btn">🚪 Cerrar Sesión</button>
        </form>
    </div>

    <!-- Contenido Principal -->
    <div class="content">
        <h2>Editar Perfil</h2>

        <!-- Mensaje de éxito si la actualización fue correcta -->
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <!-- Formulario para actualizar datos del usuario -->
        <div class="form-container">
            <form action="{{ route('profile.update') }}" method="POST">
                @csrf

                <!-- Campo para el nombre -->
                <div class="mb-3">
                    <label class="form-label">Nombre:</label>
                    <input type="text" name="name" class="form-control" value="{{ $user->name }}" required>
                </div>

                <!-- Campo para el correo -->
                <div class="mb-3">
                    <label class="form-label">Email:</label>
                    <input type="email" name="email" class="form-control" value="{{ $user->email }}" required>
                </div>

                <!-- Campo para la nueva contraseña -->
                <div class="mb-3">
                    <label class="form-label">Nueva Contraseña (opcional):</label>
                    <input type="password" name="password" class="form-control">
                </div>

                <!-- Campo para confirmar la nueva contraseña -->
                <div class="mb-3">
                    <label class="form-label">Confirmar Contraseña:</label>
                    <input type="password" name="password_confirmation" class="form-control">
                </div>

                <!-- Botón para actualizar el perfil -->
                <button type="submit" class="btn btn-primary">Actualizar Perfil</button>
                
                <!-- Botón para cancelar y volver al perfil -->
                <a href="{{ route('dashboard') }}" class="btn btn-secondary">Cancelar</a>
            </form>
        </div>
    </div>

</body>
</html>
