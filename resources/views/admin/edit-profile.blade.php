<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Perfil de Administrador</title>
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

        .profile-picture {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            object-fit: cover;
            display: block;
            margin: 0 auto 10px;
        }
    </style>
</head>
<body>

    <div class="sidebar">
        <h5>⚙️ Configuración</h5>
        <a href="{{ route('admin.dashboard') }}">🏠 Volver al Panel</a>
        <a href="#" class="active">✏️ Editar Perfil</a>
    </div>

    <div class="content">
        <h2>Editar Perfil de Administrador</h2>
        <div class="form-container">
            <form action="{{ route('admin.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Vista previa de la imagen -->
                <div class="text-center">
                    <img id="imagePreview" src="{{ $admin->profile_picture ? asset('storage/' . $admin->profile_picture) : 'https://via.placeholder.com/120' }}" class="profile-picture" alt="Imagen de perfil">
                </div>

                <!-- Subir nueva imagen -->
                <div class="mb-3">
                    <label class="form-label">Imagen de Perfil:</label>
                    <input type="file" name="profile_picture" class="form-control" accept="image/*" onchange="previewImage(event)">
                </div>

                <div class="mb-3">
                    <label class="form-label">Nombre:</label>
                    <input type="text" name="name" class="form-control" value="{{ $admin->name }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Correo Electrónico:</label>
                    <input type="email" name="email" class="form-control" value="{{ $admin->email }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Teléfono:</label>
                    <input type="text" name="phone" class="form-control" value="{{ $admin->phone ?? '' }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Dirección:</label>
                    <input type="text" name="address" class="form-control" value="{{ $admin->address ?? '' }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Rol de Administrador:</label>
                    <select name="role" class="form-control" required>
                        <option value="superadmin" {{ $admin->role == 'superadmin' ? 'selected' : '' }}>Super Administrador</option>
                        <option value="moderador" {{ $admin->role == 'moderador' ? 'selected' : '' }}>Moderador</option>
                        <option value="editor" {{ $admin->role == 'editor' ? 'selected' : '' }}>Editor</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Nueva Contraseña (Opcional):</label>
                    <input type="password" name="password" class="form-control">
                </div>

                <div class="mb-3">
                    <label class="form-label">Confirmar Contraseña:</label>
                    <input type="password" name="password_confirmation" class="form-control">
                </div>

                <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">Cancelar</a>
            </form>
        </div>
    </div>

    <script>
        function previewImage(event) {
            var reader = new FileReader();
            reader.onload = function(){
                var output = document.getElementById('imagePreview');
                output.src = reader.result;
            }
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>

</body>
</html>
