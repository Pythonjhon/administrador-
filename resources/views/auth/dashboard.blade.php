<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil de Usuario</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            display: flex;
            min-height: 100vh;
            background-color: #f4f4f9;
        }

        .sidebar {
            width: 280px;
            background: #1e1e2d;
            color: white;
            padding: 20px;
            position: fixed;
            height: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .profile-sidebar-pic {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            overflow: hidden;
            background: #ddd;
            margin-bottom: 15px;
        }

        .profile-sidebar-pic img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .user-info {
            text-align: center;
            margin-bottom: 20px;
        }

        .sidebar a {
            color: white;
            text-decoration: none;
            display: block;
            padding: 12px;
            margin: 8px 0;
            border-radius: 5px;
            transition: 0.3s;
        }

        .sidebar a:hover, .sidebar .active {
            background: #28a745;
        }

        .logout-btn {
            width: 100%;
            padding: 12px;
            margin-top: 20px;
            border: none;
            border-radius: 5px;
            background: #dc3545;
            color: white;
            font-weight: bold;
            transition: 0.3s;
        }

        .logout-btn:hover {
            background: #bb2d3b;
        }

        .content {
            margin-left: 300px;
            flex-grow: 1;
            padding: 30px;
        }

        .profile-container {
            background: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .profile-pic {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            overflow: hidden;
            background: #ddd;
        }

        .profile-pic img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .delete-btn {
            background: red;
            border: none;
            padding: 12px;
            color: white;
            font-weight: bold;
            border-radius: 5px;
            transition: 0.3s;
        }

        .delete-btn:hover {
            background: darkred;
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <div class="user-info">
            <div class="profile-sidebar-pic">
                <img src="{{ asset('storage/' . $user->image) }}" alt="Foto de perfil">
            </div>
            <h5>{{ $user->name }}</h5>
            <p>{{ $user->email }}</p>
        </div>
        <a href="#" class="active">📄 Datos Personales</a>
        <a href="{{ route('profile.edit') }}">✏️ Editar Perfil</a>
        <a href="{{ route('tasks.index') }}">🔧 Administrador</a>
        <a href="/">🏠 Inicio</a>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="logout-btn">🚪 Cerrar Sesión</button>
        </form>
    </div>
    <div class="content">
        <h2>Perfil de Usuario</h2>
        <div class="profile-container">
            <div class="profile-pic">
                <img src="{{ asset('storage/' . $user->image) }}" alt="Foto de perfil">
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
        <form action="{{ route('profile.delete') }}" method="POST" onsubmit="return confirm('¿Estás seguro de que deseas eliminar tu cuenta? Esta acción no se puede deshacer.');">
            @csrf
            @method('DELETE')
            <button type="submit" class="delete-btn">❌ Eliminar Cuenta</button>
        </form>
    </div>
</body>
</html>
