<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil de Usuario</title>
    <!-- Enlace a Bootstrap 5 para estilos -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        /* Estilos generales */
        body {
            display: flex;
            min-height: 100vh;
            background-color: #f8f9fa;
        }

        /* Estilos de la barra lateral */
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

        /* Imagen de perfil en la barra lateral */
        .profile-sidebar-pic {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            overflow: hidden;
            background: #ddd;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 10px;
        }

        .profile-sidebar-pic img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        /* Información del usuario en la barra lateral */
        .user-info {
            text-align: center;
            padding: 15px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.3);
            margin-bottom: 15px;
        }

        .user-info h5 {
            margin-bottom: 5px;
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

        .sidebar a:hover, .sidebar .active {
            background: #2e7d32;
        }

        .home-link {
            background: #212529;
        }

        .home-link:hover {
            background: #2e7d32;
        }

        .sidebar-content {
            flex-grow: 1;
        }
        
        /* Botón de cierre de sesión */
        .logout-btn {
            background: #2e7d32;
            color: white !important;
            text-align: center;
            display: block;
            padding: 12px;
            margin-top: 10px;
            border-radius: 5px;
            font-weight: 500;
            text-decoration: none;
            transition: background 0.3s ease;
            border: none;
            width: 100%;
        }

        .logout-btn:hover {
            background: #19692c;
        }

        /* Contenido principal */
        .content {
            margin-left: 270px;
            flex-grow: 1;
            padding: 30px;
        }

        /* Contenedor del perfil */
        .profile-container {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            display: flex;
            align-items: center;
            gap: 20px;
            margin-bottom: 20px;
        }

        /* Estilo de la foto de perfil */
        .profile-pic {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            overflow: hidden;
            background: #ddd;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .profile-pic img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        /* Botones */
        .btn {
            background: #2e7d32;
            color: white;
            text-decoration: none;
            padding: 10px 15px;
            border-radius: 5px;
            font-weight: 500;
            transition: background 0.3s ease;
            display: inline-block;
            text-align: center;
        }

        .btn:hover {
            background: #19692c;
        }

        /* Botón de eliminar cuenta */
        .delete-btn {
            background: red;
            margin-top: 10px;
        }

        .delete-btn:hover {
            background: darkred;
        }

        /* Color de los textos en la barra lateral */
        .sidebar a, .sidebar p {
            color: white !important;
        }

        /* Estilo para imágenes de tareas */
        .task-image {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 5px;
        }

        /* Estilo para textos con opacidad */
        .text-muted {
            color: white !important;
            opacity: 0.7;
        }
    </style>
</head>
<body>

    <!-- Barra lateral -->
    <div class="sidebar">
        <div class="user-info">
            <h5>👤 {{ $user->name }}</h5>
            <p class="text-muted">{{ $user->email }}</p>
        </div>
        <div class="sidebar-content">
            <a href="#" class="active">📄 Datos Personales</a>
            <a href="{{ route('profile.edit') }}">✏️ Editar Perfil</a>
            <a href="{{ route('tasks.index') }}">🔧 Administrador</a>
            <a href="/" class="home-link">🏠 Inicio</a>
        </div>
        <!-- Botón de cierre de sesión -->
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="logout-btn">🚪 Cerrar Sesión</button>
        </form>
    </div>
    
    <!-- Contenido Principal -->
    <div class="content">
        <h2>Perfil de Usuario</h2>

        <!-- Contenedor de perfil -->
        <div class="profile-container">
            <!-- Foto de perfil en la sección principal -->
            <div class="profile-pic">
                @if ($user->image)
                    <img src="{{ asset('storage/' . $user->image) }}" alt="Foto de perfil">
                @else
                    📷
                @endif
            </div>

            <div>
                <p><strong>Nombre:</strong> {{ $user->name }}</p>
                <p><strong>Email:</strong> {{ $user->email }}</p>
                <p><strong>Teléfono:</strong> {{ $user->phone ?? 'No registrado' }}</p>
                <p><strong>Dirección:</strong> {{ $user->address ?? 'No registrada' }}</p>
                <p><strong>Trabajo:</strong> {{ $user->job ?? 'No especificado' }}</p>
                <p><strong>Contacto Alternativo:</strong> {{ $user->contact_number ?? 'No disponible' }}</p>
            </div>
        </div>

        <!-- Formulario para eliminar la cuenta -->
        <form action="{{ route('profile.delete') }}" method="POST" 
              onsubmit="return confirm('¿Estás seguro de que deseas eliminar tu cuenta? Esta acción no se puede deshacer.');">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger delete-btn">❌ Eliminar Cuenta</button>
        </form>
    </div>

</body>
</html>