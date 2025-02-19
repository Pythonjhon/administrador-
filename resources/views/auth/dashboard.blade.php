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
            background-color: #f8f9fa;
        }
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
        .user-info {
            text-align: center;
            padding: 15px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.3);
            margin-bottom: 15px;
        }
        .user-info h5 {
            margin-bottom: 5px;
        }
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
        .content {
            margin-left: 270px;
            flex-grow: 1;
            padding: 30px;
        }
        .profile-container {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            display: flex;
            align-items: center;
            gap: 20px;
        }
        .profile-pic {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background: #ddd;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 40px;
            color: #218838;
        }
        .task-image {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 5px;
        }
        .btn {
            background: #2e7d32;
            color: white;
            text-decoration: none;
            padding: 10px 15px;
            border-radius: 5px;
            font-weight: 500;
            display: inline-block;
            margin-top: 10px;
            transition: background 0.3s ease;
        }
        .btn:hover {
            background: #19692c;
        }
        .delete-btn {
            background: red;
        }
        .delete-btn:hover {
            background: darkred;
        }
        .sidebar a, .sidebar p {
          color: white !important;
        }
    </style>
</head>
<body>

    <!-- Sidebar -->
    <div class="sidebar">
        <div class="user-info">
            <h5>👤 {{ $user->name }}</h5>
            <p class="text-muted">{{ $user->email }}</p>
        </div>
        <a href="#">📄 Datos Personales</a>
        <a href="{{ route('profile.edit') }}">✏️ Editar Perfil</a>
    </div>

    <!-- Contenido Principal -->
    <div class="content">
        <h2>Perfil de Usuario</h2>

        <div class="profile-container">
            <!-- Icono de Foto de Perfil -->
            <div class="profile-pic">📷</div>

            <div>
                <p><strong>Nombre:</strong> {{ $user->name }}</p>
                <p><strong>Email:</strong> {{ $user->email }}</p>

                <!-- Botón de cierre de sesión -->
                 <form action="{{ route('logout') }}" method="POST" class="mt-auto">
                 @csrf
                 <button type="submit" class="logout-btn">🚪 Cerrar Sesión</button>
                 </form>
            </div>
        </div>

        <form action="{{ route('profile.delete') }}" method="POST" onsubmit="return confirm('¿Estás seguro de que deseas eliminar tu cuenta? Esta acción no se puede deshacer.');">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn delete-btn">❌ Eliminar Cuenta</button>
        </form>
    </div>

</body>
</html>
