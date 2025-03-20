<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Tarea</title>
    
    <!-- Bootstrap 5 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <!-- Font Awesome for professional icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <style>
        body {
            display: flex;
            min-height: 100vh;
            background-color: #f4f4f9;
        }

        /* Sidebar styles */
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
            width: 100%;
        }

        .sidebar a:hover, .sidebar .active {
            background: #28a745;
        }

        .logout-btn {
            width: 100%;
            padding: 12px;
            margin-top: auto;
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

        /* Main content styles */
        .content {
            margin-left: 280px;
            flex-grow: 1;
            padding: 30px;
            display: flex;
            justify-content: center;
        }
        
        .card {
            width: 100%;
            max-width: 700px;
            border-radius: 10px;
            border: none;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            margin-top: 20px;
        }
        
        .card-header {
            background-color: #ffffff;
            border-bottom: 1px solid #e9ecef;
            padding: 1.5rem 1.5rem;
            border-top-left-radius: 8px;
            border-top-right-radius: 8px;
        }
        
        .card-body {
            padding: 1.5rem;
            background-color: #ffffff;
        }
        
        .form-label {
            font-weight: 500;
            color: #495057;
        }
        
        .form-control, .form-select {
            padding: 0.6rem 0.75rem;
            border-radius: 6px;
            border: 1px solid #ced4da;
            transition: border-color 0.2s ease;
        }
        
        .form-control:focus, .form-select:focus {
            border-color: #6c757d;
            box-shadow: 0 0 0 0.15rem rgba(108, 117, 125, 0.15);
        }
        
        .btn {
            padding: 0.5rem 1.5rem;
            border-radius: 6px;
            font-weight: 500;
        }
        
        .btn-primary {
            background-color: #28a745;
            border-color: #28a745;
        }
        
        .btn-primary:hover {
            background-color: #218838;
            border-color: #218838;
        }
        
        .btn-outline-secondary {
            color: #6c757d;
            border-color: #6c757d;
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
        
        .nav-menu {
            width: 100%;
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        {{-- <div class="profile-sidebar-pic">
            <img src="/api/placeholder/100/100" alt="Imagen de perfil">
        </div> --}}
        <div class="user-info">
            <h5 class="mb-1">Nombre Usuario</h5>
            <p class="mb-3 small">usuario@correo.com</p>
        </div>
        
        <div class="nav-menu">
            {{-- <a href="#" class="active">
                <i class="fas fa-tasks me-2"></i> Tareas
            </a>
            <a href="#">
                <i class="fas fa-calendar me-2"></i> Calendario
            </a> --}}
            <a href="#">
                <i class="fas fa-users me-2"></i> Equipo
            </a>
            <a href="#">
                <i class="fas fa-chart-line me-2"></i> Reportes
            </a>
            {{-- <a href="#">
                <i class="fas fa-cog me-2"></i> Configuración
            </a> --}}
        </div>
        
        <button class="logout-btn mt-auto">
            <i class="fas fa-sign-out-alt me-2"></i> Cerrar Sesión
        </button>
    </div>

    <!-- Main Content -->
    <div class="content">
        <div class="card">
            <div class="card-header">
                <h4 class="mb-0 text-center">Nueva Tarea</h4>
            </div>
            
            <div class="card-body">
                <!-- Validación de errores -->
                @if ($errors->any())
                    <div class="alert alert-danger mb-4">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Formulario -->
                <form action="{{ route('tasks.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="mb-3">
                        <label for="title" class="form-label">
                            <i class="fas fa-heading me-1"></i> Título
                        </label>
                        <input type="text" name="title" id="title" class="form-control" required value="{{ old('title') }}" placeholder="Ingrese el título de la tarea">
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">
                            <i class="fas fa-align-left me-1"></i> Descripción
                        </label>
                        <textarea name="description" id="description" class="form-control" rows="4" placeholder="Describa los detalles de la tarea">{{ old('description') }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label for="assigned_to" class="form-label">
                            <i class="fas fa-user me-1"></i> Asignado a
                        </label>
                        <select name="assigned_to" id="assigned_to" class="form-select" required>
                            <option value="">Seleccionar responsable</option>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}" {{ old('assigned_to') == $user->id ? 'selected' : '' }}>
                                    {{ $user->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="completed" class="form-label">
                            <i class="fas fa-tasks me-1"></i> Estado
                        </label>
                        <select name="completed" id="completed" class="form-select">
                            <option value="0" selected>Pendiente</option>
                            <option value="1">Completada</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="image" class="form-label">
                            <i class="fas fa-image me-1"></i> Imagen
                        </label>
                        <input type="file" name="image" id="image" class="form-control" accept="image/*">
                        <small class="text-muted">Formatos soportados: JPG, PNG, GIF</small>
                    </div>

                    <div class="mb-4">
                        <label for="archivo" class="form-label">
                            <i class="fas fa-paperclip me-1"></i> Archivo adjunto
                        </label>
                        <input type="file" name="archivo" id="archivo" class="form-control">
                        <small class="text-muted">Tamaño máximo: 10MB</small>
                    </div>

                    <div class="d-flex justify-content-between mt-4">
                        <a href="{{ route('tasks.index') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-arrow-left me-1"></i> Volver
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-1"></i> Guardar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>