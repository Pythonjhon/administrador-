<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Tareas</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
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
            z-index: 1000;
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
            width: 100%;
        }

        .nav-menu {
            width: 100%;
            margin-bottom: 20px;
        }

        .sidebar-title {
            font-size: 1.1rem;
            font-weight: 600;
            margin-bottom: 15px;
            color: #a0a0b0;
            text-transform: uppercase;
            letter-spacing: 1px;
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

        .sidebar .btn {
            width: 100%;
            text-align: left;
            padding: 12px;
            margin: 8px 0;
        }

        .sidebar .btn i {
            margin-right: 8px;
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
            text-align: left;
        }

        .logout-btn:hover {
            background: #bb2d3b;
        }

        /* Content styles */
        .content {
            margin-left: 280px;
            flex-grow: 1;
            padding: 30px;
        }

        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
            padding-bottom: 15px;
            border-bottom: 1px solid #e0e0e0;
        }

        .card {
            border-radius: 8px;
            border: none;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.08);
            margin-bottom: 20px;
        }

        .task-image {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .badge {
            font-size: 0.85rem;
            font-weight: 500;
            padding: 0.5em 0.75em;
        }

        .table {
            vertical-align: middle;
        }

        .table thead th {
            background: #28a745;
            color: white;
            font-weight: 500;
            border: none;
            padding: 12px 15px;
        }

        .table thead th:first-child {
            border-top-left-radius: 8px;
        }
        
        .table thead th:last-child {
            border-top-right-radius: 8px;
        }

        .table tbody tr:hover {
            background-color: rgba(40, 167, 69, 0.05);
        }

        .btn-sm {
            padding: 0.35rem 0.65rem;
            font-size: 0.85rem;
        }

        .action-buttons {
            display: flex;
            gap: 5px;
        }

        .action-buttons .btn {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .action-buttons .btn i {
            margin-right: 4px;
        }

        .pagination {
            justify-content: center;
        }

        .pagination .page-item.active .page-link {
            background-color: #28a745;
            border-color: #28a745;
        }

        .pagination .page-link {
            color: #28a745;
        }

        .filter-badge {
            background-color: #f5f5f5;
            color: #444;
            padding: 6px 12px;
            border-radius: 20px;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            margin-right: 10px;
        }
        
        .filter-badge.active {
            background-color: #28a745;
            color: white;
        }
        
        .filter-badge i {
            margin-right: 5px;
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="profile-sidebar-pic">
            <img src="/api/placeholder/100/100" alt="Imagen de perfil">
        </div>
        <div class="user-info">
            <h5 class="mb-1">{{ Auth::user()->name }}</h5>
            <p class="small text-muted mb-3">{{ Auth::user()->email }}</p>
        </div>
        
        <div class="nav-menu">
            <div class="sidebar-title">Gestión de Tareas</div>
            
            <a href="{{ route('tasks.index') }}" class="active">
                <i class="fas fa-list me-2"></i> Todas las Tareas
            </a>
            <a href="{{ route('tasks.index', ['filter' => 'completed']) }}">
                <i class="fas fa-check-circle me-2"></i> Completadas
            </a>
            <a href="{{ route('tasks.index', ['filter' => 'pending']) }}">
                <i class="fas fa-clock me-2"></i> Pendientes
            </a>
            
            <div class="sidebar-title mt-4">Acciones</div>
            
            <a href="{{ route('tasks.create') }}" class="btn btn-success">
                <i class="fas fa-plus"></i> Nueva Tarea
            </a>
            
            <a href="{{ route('dashboard') }}" class="btn btn-outline-light mt-2">
                <i class="fas fa-user"></i> Mi Perfil
            </a>
        </div>
        
        <form action="{{ route('logout') }}" method="POST" class="mt-auto w-100">
            @csrf
            <button type="submit" class="logout-btn">
                <i class="fas fa-sign-out-alt me-2"></i> Cerrar Sesión
            </button>
        </form>
        
        <a href="{{ route('welcome') }}" class="btn btn-outline-secondary mt-2">
            <i class="fas fa-home me-2"></i> Volver a Inicio
        </a>
    </div>

    <!-- Main Content -->
    <div class="content">
        <div class="page-header">
            <div>
                <h2 class="mb-2">Panel de Tareas</h2>
                <div class="d-flex">
                    <a href="{{ route('tasks.index') }}" class="filter-badge {{ !$filter ? 'active' : '' }}">
                        <i class="fas fa-list"></i> Todas
                    </a>
                    <a href="{{ route('tasks.index', ['filter' => 'completed']) }}" class="filter-badge {{ $filter == 'completed' ? 'active' : '' }}">
                        <i class="fas fa-check-circle"></i> Completadas
                    </a>
                    <a href="{{ route('tasks.index', ['filter' => 'pending']) }}" class="filter-badge {{ $filter == 'pending' ? 'active' : '' }}">
                        <i class="fas fa-clock"></i> Pendientes
                    </a>
                </div>
            </div>
            <a href="{{ route('tasks.create') }}" class="btn btn-success">
                <i class="fas fa-plus me-2"></i> Nueva Tarea
            </a>
        </div>
        
        <div class="card">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th width="60">ID</th>
                                <th width="80">Imagen</th>
                                <th width="110">Archivo</th>
                                <th>Nombre</th>
                                <th>Descripción</th>
                                <th>Asignado a</th>
                                <th>Creación</th>
                                <th>Estado</th>
                                <th width="200">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($tasks as $task)
                                <tr>
                                    <td>{{ $task->id }}</td>
                                    <td>
                                        @if ($task->image)
                                            <img src="{{ asset('storage/' . $task->image) }}" alt="Imagen" class="task-image">
                                        @else
                                            <span class="text-muted"><i class="fas fa-image fa-2x text-light"></i></span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($task->archivo)
                                            <a href="{{ asset('storage/' . $task->archivo) }}" class="btn btn-sm btn-info" target="_blank">
                                                <i class="fas fa-download me-1"></i> Archivo
                                            </a>
                                        @else
                                            <span class="text-muted small">Sin archivo</span>
                                        @endif
                                    </td>
                                    <td class="fw-medium">{{ $task->title }}</td>
                                    <td>{{ Str::limit($task->description, 50) }}</td>
                                    <td>{{ $task->assigned_to }}</td>
                                    <td><span class="text-muted">{{ $task->created_at->format('d/m/Y H:i') }}</span></td>
                                    <td>
                                        <span class="badge {{ $task->completed ? 'bg-success' : 'bg-warning' }}">
                                            <i class="fas {{ $task->completed ? 'fa-check-circle' : 'fa-clock' }} me-1"></i>
                                            {{ $task->completed ? 'Completada' : 'Pendiente' }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="action-buttons">
                                            <form action="{{ route('tasks.toggle', $task->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit" class="btn btn-sm {{ $task->completed ? 'btn-warning' : 'btn-success' }}">
                                                    <i class="fas {{ $task->completed ? 'fa-clock' : 'fa-check' }}"></i>
                                                    {{ $task->completed ? 'Pendiente' : 'Completar' }}
                                                </button>
                                            </form>
                                            <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-sm btn-primary">
                                                <i class="fas fa-edit"></i> Editar
                                            </a>
                                            <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" onsubmit="return confirm('¿Está seguro que desea eliminar esta tarea?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">
                                                    <i class="fas fa-trash"></i>
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
        <div class="d-flex justify-content-center mt-4">
            {{ $tasks->appends(['filter' => $filter])->links() }}
        </div>
    </div>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>