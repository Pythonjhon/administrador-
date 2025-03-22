<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Tareas</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #0e5937;
            --secondary-color: #f8f9fa;
            --sidebar-width: 250px;
            --sidebar-dark: #1a1a2e;
            --accent-color: #16a34a;
            --text-light: #e2e8f0;
            --border-radius: 6px;
            --box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
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
            padding: 15px;
            position: fixed;
            height: 100%;
            display: flex;
            flex-direction: column;
            z-index: 1000;
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.1);
            overflow-y: auto;
        }

        .sidebar-header {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .logo {
            font-size: 1.25rem;
            font-weight: 700;
            color: white;
            margin: 0;
        }

        .logo-accent {
            color: var(--accent-color);
        }

        .user-info {
            text-align: center;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .profile-sidebar-pic {
            width: 70px;
            height: 70px;
            border-radius: 50%;
            overflow: hidden;
            background: #e0e0e0;
            margin: 0 auto 10px;
            border: 2px solid var(--accent-color);
        }

        .profile-sidebar-pic img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .user-name {
            font-size: 1rem;
            font-weight: 600;
            margin-bottom: 3px;
            color: white;
        }

        .user-role {
            font-size: 0.8rem;
            color: rgba(255, 255, 255, 0.6);
            margin-bottom: 0;
        }

        .nav-section {
            margin-bottom: 15px;
        }

        .nav-header {
            font-size: 0.7rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: rgba(255, 255, 255, 0.5);
            margin-bottom: 8px;
            padding-left: 8px;
        }

        .nav-menu {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }

        .nav-item {
            margin-bottom: 3px;
        }

        .nav-link {
            display: flex;
            align-items: center;
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            padding: 8px 12px;
            border-radius: var(--border-radius);
            transition: var(--transition);
        }

        .nav-link:hover, .nav-link.active {
            background: var(--accent-color);
            color: white;
        }

        .nav-link i {
            margin-right: 8px;
            font-size: 1rem;
            width: 16px;
            text-align: center;
        }

        .admin-badge {
            display: inline-block;
            background-color: rgba(255, 255, 255, 0.1);
            color: white;
            font-size: 0.7rem;
            font-weight: 500;
            padding: 2px 6px;
            border-radius: 3px;
            margin-left: auto;
        }

        .sidebar-footer {
            margin-top: auto;
            padding-top: 15px;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
        }

        .logout-btn {
            display: flex;
            align-items: center;
            width: 100%;
            padding: 8px 12px;
            border: none;
            border-radius: var(--border-radius);
            background: rgba(220, 53, 69, 0.8);
            color: white;
            font-weight: 500;
            transition: var(--transition);
            text-align: left;
            font-size: 0.9rem;
        }

        .logout-btn:hover {
            background: #dc3545;
        }

        .logout-btn i {
            margin-right: 8px;
        }

        /* Content styles */
        .content {
            margin-left: var(--sidebar-width);
            flex-grow: 1;
            padding: 20px;
            max-width: calc(100% - var(--sidebar-width));
        }

        .page-header {
            background-color: white;
            border-radius: var(--border-radius);
            padding: 15px 20px;
            margin-bottom: 20px;
            box-shadow: var(--box-shadow);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .page-title {
            font-size: 1.3rem;
            font-weight: 600;
            color: #333;
            margin: 0;
        }

        .header-actions {
            display: flex;
            gap: 8px;
        }

        .card {
            border-radius: var(--border-radius);
            border: none;
            box-shadow: var(--box-shadow);
            margin-bottom: 20px;
            background-color: white;
            overflow: hidden;
        }

        .card-header {
            background-color: white;
            padding: 15px 20px;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        }

        .card-title {
            font-size: 1.1rem;
            font-weight: 600;
            color: #333;
            margin: 0;
        }

        .card-body {
            padding: 20px;
        }

        .profile-container {
            display: flex;
            gap: 20px;
            align-items: flex-start;
            flex-wrap: wrap;
        }

        .profile-pic {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            overflow: hidden;
            background: #e0e0e0;
            box-shadow: var(--box-shadow);
            border: 3px solid white;
            flex-shrink: 0;
        }

        .profile-pic img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .profile-info {
            flex: 1;
            min-width: 200px;
        }

        .info-item {
            margin-bottom: 12px;
            padding-bottom: 12px;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            display: flex;
            flex-wrap: wrap;
        }

        .info-item:last-child {
            border-bottom: none;
            margin-bottom: 0;
            padding-bottom: 0;
        }

        .info-label {
            font-weight: 600;
            color: #555;
            width: 100px;
            min-width: 100px;
        }

        .info-value {
            color: #333;
            flex: 1;
        }

        .btn {
            font-size: 0.85rem;
            padding: 0.375rem 0.75rem;
        }

        .btn-primary {
            background-color: var(--accent-color);
            border-color: var(--accent-color);
            box-shadow: 0 2px 4px rgba(22, 163, 74, 0.2);
        }

        .btn-primary:hover {
            background-color: #15803d;
            border-color: #15803d;
        }

        .btn-outline-primary {
            color: var(--accent-color);
            border-color: var(--accent-color);
        }

        .btn-outline-primary:hover {
            background-color: var(--accent-color);
            border-color: var(--accent-color);
            color: white;
        }

        .btn-danger {
            background-color: #dc3545;
            border-color: #dc3545;
        }

        .delete-btn {
            background-color: rgba(220, 53, 69, 0.1);
            color: #dc3545;
            border: 1px solid rgba(220, 53, 69, 0.2);
            font-weight: 500;
            padding: 8px 12px;
            border-radius: var(--border-radius);
            transition: var(--transition);
            font-size: 0.85rem;
        }

        .delete-btn:hover {
            background-color: #dc3545;
            color: white;
            border-color: #dc3545;
        }

        .delete-btn i {
            margin-right: 5px;
        }

        .action-buttons {
            margin-top: 15px;
            display: flex;
            gap: 8px;
        }

        .empty-profile-placeholder {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            background-color: #e0e0e0;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            color: #999;
            box-shadow: var(--box-shadow);
            border: 3px solid white;
            flex-shrink: 0;
        }

        /* Responsive adjustments */
        @media (max-width: 991px) {
            :root {
                --sidebar-width: 220px;
            }
            
            .profile-container {
                flex-direction: column;
                align-items: center;
                text-align: center;
            }
            
            .info-item {
                text-align: left;
            }
            
            .action-buttons {
                justify-content: center;
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
            
            .page-header {
                margin-top: 50px;
            }
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="sidebar-header">
            <h3 class="logo">Task<span class="logo-accent">Manager</span></h3>
        </div>
        
        <div class="user-info">
            <div class="profile-sidebar-pic">
                <img src="/api/placeholder/100/100" alt="Imagen de perfil">
            </div>
            <h4 class="user-name">{{ Auth::user()->name }}</h4>
            <p class="user-role">{{ Auth::user()->email }}</p>
        </div>
        
        <div class="nav-section">
            <h5 class="nav-header">Gestión de Tareas</h5>
            <ul class="nav-menu">
                <li class="nav-item">
                    <a href="{{ route('tasks.index') }}" class="nav-link active">
                        <i class="fa fa-list"></i> Todas las Tareas
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('tasks.index', ['filter' => 'completed']) }}" class="nav-link">
                        <i class="fa fa-check-circle"></i> Completadas
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('tasks.index', ['filter' => 'pending']) }}" class="nav-link">
                        <i class="fa fa-clock"></i> Pendientes
                    </a>
                </li>
            </ul>
        </div>
        
        <div class="nav-section">
            <h5 class="nav-header">Acciones</h5>
            <ul class="nav-menu">
                <li class="nav-item">
                    <a href="{{ route('tasks.create') }}" class="nav-link">
                        <i class="fa fa-plus"></i> Nueva Tarea
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}" class="nav-link">
                        <i class="fa fa-user"></i> Mi Perfil
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('welcome') }}" class="nav-link">
                        <i class="fa fa-home"></i> Volver a Inicio
                    </a>
                </li>
            </ul>
        </div>
        
        <div class="sidebar-footer">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="logout-btn">
                    <i class="fa fa-sign-out"></i> Cerrar Sesión
                </button>
            </form>
        </div>
    </div>

    <!-- Main Content -->
    <div class="content">
        <div class="page-header">
            <h1 class="page-title">Panel de Tareas</h1>
            <div class="header-actions">
                <a href="{{ route('tasks.create') }}" class="btn btn-primary">
                    <i class="fa fa-plus"></i> Nueva Tarea
                </a>
            </div>
        </div>
        
        <div class="card">
            <div class="card-header">
                <h2 class="card-title">Lista de tareas</h2>
                <div style="display: flex; gap: 10px;">
                    <a href="{{ route('tasks.index') }}" class="btn btn-sm {{ !$filter ? 'btn-primary' : 'btn-outline-primary' }}">
                        <i class="fa fa-list"></i> Todas
                    </a>
                    <a href="{{ route('tasks.index', ['filter' => 'completed']) }}" class="btn btn-sm {{ $filter == 'completed' ? 'btn-primary' : 'btn-outline-primary' }}">
                        <i class="fa fa-check-circle"></i> Completadas
                    </a>
                    <a href="{{ route('tasks.index', ['filter' => 'pending']) }}" class="btn btn-sm {{ $filter == 'pending' ? 'btn-primary' : 'btn-outline-primary' }}">
                        <i class="fa fa-clock"></i> Pendientes
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Imagen</th>
                                <th>Archivo</th>
                                <th>Nombre</th>
                                <th>Descripción</th>
                                <th>Asignado</th>
                                <th>Creación</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($tasks as $task)
                                <tr>
                                    <td>{{ $task->id }}</td>
                                    <td>
                                        @if ($task->image)
                                            <img src="{{ asset('storage/' . $task->image) }}" alt="Imagen" style="width: 50px; height: 50px; object-fit: cover; border-radius: var(--border-radius);">
                                        @else
                                            <div style="width: 50px; height: 50px; background-color: #e0e0e0; display: flex; align-items: center; justify-content: center; border-radius: var(--border-radius);">
                                                <i class="fa fa-image" style="color: #aaa;"></i>
                                            </div>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($task->archivo)
                                            <a href="{{ asset('storage/' . $task->archivo) }}" class="btn btn-outline-primary" target="_blank">
                                                <i class="fa fa-download"></i> Archivo
                                            </a>
                                        @else
                                            <span style="color: #888;">Sin archivo</span>
                                        @endif
                                    </td>
                                    <td style="font-weight: 600;">{{ $task->title }}</td>
                                    <td>{{ Str::limit($task->description, 50) }}</td>
                                    <td>{{ $task->assigned_to }}</td>
                                    <td>{{ $task->created_at->format('d/m/Y H:i') }}</td>
                                    <td>
                                        <span style="display: inline-block; padding: 5px 8px; border-radius: var(--border-radius); background-color: {{ $task->completed ? 'var(--accent-color)' : '#f59e0b' }}; color: white; font-size: 0.85rem;">
                                            <i class="fa {{ $task->completed ? 'fa-check-circle' : 'fa-clock' }}"></i>
                                            {{ $task->completed ? 'Completada' : 'Pendiente' }}
                                        </span>
                                    </td>
                                    <td>
                                        <div style="display: flex; gap: 5px;">
                                            <form action="{{ route('tasks.toggle', $task->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit" class="btn btn-sm {{ $task->completed ? 'btn-outline-primary' : 'btn-primary' }}">
                                                    <i class="fa {{ $task->completed ? 'fa-clock' : 'fa-check' }}"></i>
                                                    {{ $task->completed ? 'Marcar Pendiente' : 'Completar' }}
                                                </button>
                                            </form>
                                            <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-sm btn-primary">
                                                <i class="fa fa-edit"></i> Editar
                                            </a>
                                            <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" onsubmit="return confirm('¿Está seguro que desea eliminar esta tarea?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="delete-btn">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div style="display: flex; justify-content: center; margin-top: 20px;">
            {{ $tasks->appends(['filter' => $filter])->links() }}
        </div>
    </div>
</body>
</html>