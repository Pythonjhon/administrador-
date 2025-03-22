<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Perfil de Administrador</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
       :root {
            --primary-color: #0e5937;
            --secondary-color: #f8f9fa;
            --sidebar-width: 250px;
            --sidebar-dark: #1a2942;
            --accent-color: #16a34a;
            --text-light: #e2e8f0;
            --border-radius: 8px;
            --box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            --transition: all 0.3s ease;
        }

        body {
            display: flex;
            min-height: 100vh;
            background-color: #f4f7f9;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            font-size: 14px;
        }

        /* Sidebar styles */
        .sidebar {
            width: var(--sidebar-width);
            background: var(--sidebar-dark);
            color: var(--text-light);
            padding: 25px 15px;
            position: fixed;
            height: 100%;
            display: flex;
            flex-direction: column;
            z-index: 1000;
            box-shadow: 2px 0 15px rgba(0, 0, 0, 0.15);
            overflow-y: auto;
        }

        .sidebar h5 {
            font-size: 1.1rem;
            font-weight: 600;
            margin-top: 0;
            margin-bottom: 20px;
            color: white;
            padding-bottom: 15px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .sidebar a {
            display: flex;
            align-items: center;
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            padding: 12px 15px;
            border-radius: var(--border-radius);
            transition: var(--transition);
            margin-bottom: 8px;
            font-weight: 500;
        }

        .sidebar a:hover, .sidebar a.active {
            background: var(--accent-color);
            color: white;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
        }

        .sidebar a.active {
            border-left: 4px solid white;
        }

        /* Content styles */
        .content {
            margin-left: var(--sidebar-width);
            flex-grow: 1;
            padding: 30px;
            max-width: calc(100% - var(--sidebar-width));
        }

        .content h2 {
            font-size: 1.5rem;
            font-weight: 600;
            color: #222;
            margin-top: 0;
            margin-bottom: 25px;
            padding-bottom: 15px;
            border-bottom: 1px solid #eaeaea;
        }

        .form-container {
            background-color: white;
            border-radius: var(--border-radius);
            padding: 30px;
            box-shadow: var(--box-shadow);
            border: 1px solid rgba(0, 0, 0, 0.05);
        }

        .form-label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
            color: #444;
        }

        .form-control {
            display: block;
            width: 100%;
            padding: 0.6rem 0.75rem;
            font-size: 0.95rem;
            line-height: 1.5;
            color: #495057;
            background-color: #fff;
            background-clip: padding-box;
            border: 1px solid #ced4da;
            border-radius: var(--border-radius);
            transition: var(--transition);
            margin-bottom: 1rem;
            box-sizing: border-box;
        }

        .form-control:focus {
            border-color: var(--accent-color);
            outline: 0;
            box-shadow: 0 0 0 0.2rem rgba(22, 163, 74, 0.15);
        }

        .mb-3 {
            margin-bottom: 1.5rem;
        }

        .text-center {
            text-align: center;
        }

        .profile-picture {
            width: 140px;
            height: 140px;
            border-radius: 50%;
            object-fit: cover;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            border: 4px solid white;
            margin-bottom: 1.5rem;
        }

        .btn {
            font-size: 0.9rem;
            padding: 0.5rem 1.2rem;
            border-radius: var(--border-radius);
            transition: var(--transition);
            cursor: pointer;
            display: inline-block;
            text-align: center;
            text-decoration: none;
            border: 1px solid transparent;
            font-weight: 500;
        }

        .btn-primary {
            background-color: var(--accent-color);
            border-color: var(--accent-color);
            box-shadow: 0 2px 4px rgba(22, 163, 74, 0.2);
            color: white;
        }

        .btn-primary:hover {
            background-color: #15803d;
            border-color: #15803d;
            box-shadow: 0 4px 6px rgba(22, 163, 74, 0.3);
        }

        .btn-secondary {
            background-color: #6c757d;
            border-color: #6c757d;
            color: white;
        }

        .btn-secondary:hover {
            background-color: #5a6268;
            border-color: #545b62;
            box-shadow: 0 4px 6px rgba(108, 117, 125, 0.3);
        }

        /* Form section spacing */
        form > div:not(:last-child) {
            margin-bottom: 15px;
        }

        /* Button spacing */
        form button, form a.btn {
            margin-right: 10px;
            margin-top: 15px;
        }

        /* Responsive adjustments */
        @media (max-width: 991px) {
            :root {
                --sidebar-width: 220px;
            }
        }

        @media (max-width: 767px) {
            :root {
                --sidebar-width: 0;
            }
            
            .sidebar {
                transform: translateX(-100%);
                transition: transform 0.3s ease;
            }
            
            .sidebar.show {
                transform: translateX(0);
                width: 250px;
            }
            
            .content {
                margin-left: 0;
                max-width: 100%;
                padding: 20px;
            }
            
            .toggle-sidebar {
                display: block;
                position: fixed;
                top: 15px;
                left: 15px;
                z-index: 1010;
                background: var(--accent-color);
                color: white;
                border: none;
                border-radius: 5px;
                width: 40px;
                height: 40px;
                display: flex;
                align-items: center;
                justify-content: center;
                box-shadow: 0 2px 5px rgba(0,0,0,0.2);
            }
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
                    <img id="imagePreview" src="{{ $admin->profile_picture ? asset('storage/' . $admin->profile_picture) : 'https://via.placeholder.com/140' }}" class="profile-picture" alt="Imagen de perfil">
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