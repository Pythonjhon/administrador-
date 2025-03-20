<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Perfil</title>
    
    <!-- Bootstrap 5 -->
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
        <h5>⚙️ Configuración</h5>
        <a href="{{ route('dashboard') }}">🏠 Volver al Perfil</a>
        <a href="#" class="active">✏️ Editar Perfil</a>
        {{-- <a href="#"> Cambiar Contraseña</a>
        <a href="#">📧 Configuración de Notificaciones</a>
        <a href="#">📝 Preferencias de Usuario</a>
        <a href="#">📱 Dispositivos Conectados</a>
        <a href="#">🆘 Centro de Ayuda</a>
        <a href="#">📞 Soporte</a> --}}
        <form action="{{ route('logout') }}" method="POST" class="mt-auto">
            @csrf
            <button type="submit" class="logout-btn">🚪 Cerrar Sesión</button>
        </form>
    </div>

    <div class="content">
        <h2 class="mb-4">Editar Perfil</h2>
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="profile-container">
            <div class="profile-pic">
                <img src="{{ asset('storage/' . $user->image) }}" alt="Imagen de perfil">
            </div>
            <div>
                <h4>{{ $user->name }}</h4>
                <p>{{ $user->email }}</p>
            </div>
        </div>

        <div class="form-container mt-4">
            <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Nombre:</label>
                    <input type="text" name="name" class="form-control" value="{{ $user->name }}" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Email:</label>
                    <input type="email" name="email" class="form-control" value="{{ $user->email }}" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Teléfono:</label>
                    <input type="text" name="phone" class="form-control" value="{{ $user->phone }}" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Dirección:</label>
                    <input type="text" name="address" class="form-control" value="{{ $user->address }}" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Imagen de Perfil:</label>
                    <input type="file" name="image" class="form-control">
                </div>
                <button type="submit" class="btn btn-success w-100">Actualizar Perfil</button>
                <a href="{{ route('dashboard') }}" class="btn btn-success w-100 mt-2">Cancelar</a>
            </form>
        </div>
    </div>
</body>
</html>
