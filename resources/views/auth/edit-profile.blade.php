<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Perfil</title>
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
        .content {
            margin-left: 270px;
            flex-grow: 1;
            padding: 30px;
        }
        .form-container {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 500px;
        }
        .btn-primary {
            background: #2e7d32;
            border: none;
            transition: background 0.3s ease;
        }
        .btn-primary:hover {
            background: #19692c;
        }
        .btn-secondary {
            background: #6c757d;
            border: none;
        }
        .btn-secondary:hover {
            background: #5a6268;
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
            background: #2e7d32;
        }
    </style>
</head>
<body>

    <!-- Sidebar -->
    <div class="sidebar">
        <h5>⚙️ Configuración</h5>
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

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="form-container">
            <form action="{{ route('profile.update') }}" method="POST">
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
                    <label class="form-label">Nueva Contraseña (opcional):</label>
                    <input type="password" name="password" class="form-control">
                </div>

                <div class="mb-3">
                    <label class="form-label">Confirmar Contraseña:</label>
                    <input type="password" name="password_confirmation" class="form-control">
                </div>

                <button type="submit" class="btn btn-primary">Actualizar Perfil</button>
                <a href="{{ route('dashboard') }}" class="btn btn-secondary">Cancelar</a>
            </form>
        </div>
    </div>

</body>
</html>
