<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Tareas</title>
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
        }
        .sidebar a {
            color: white;
            text-decoration: none;
            display: block;
            padding: 12px;
            margin: 8px 0;
            border-radius: 5px;
            font-weight: 500;
            transition: background-color 0.3s ease;
        }
        .sidebar a:hover, .sidebar .active {
            background: #198754;
        }
        .home-link {
            background: #212529 !important;
            margin-top: auto !important;
        }
        .home-link:hover {
            background: #198754 !important;
        }
        .sidebar-content {
            display: flex;
            flex-direction: column;
            height: calc(100% - 40px);
        }
        .content {
            margin-left: 270px;
            flex-grow: 1;
            padding: 30px;
        }
        .task-image {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 5px;
        }
    </style>
</head>
<body>

    <!-- Sidebar -->
    <div class="sidebar">
        <div class="sidebar-content">
            <h4 class="text-center mb-3">📌 Panel de Tareas</h4>
            <a href="{{ route('tasks.index') }}" class="{{ !$filter ? 'active' : '' }}">📋 Todas las Tareas</a>
            <a href="{{ route('tasks.index', ['filter' => 'completed']) }}" class="{{ $filter === 'completed' ? 'active' : '' }}">✅ Completadas</a>
            <a href="{{ route('tasks.index', ['filter' => 'pending']) }}" class="{{ $filter === 'pending' ? 'active' : '' }}">⏳ Pendientes</a>
            <a href="{{ route('tasks.create') }}" class="btn btn-success w-100 mt-3">+ Nueva Tarea</a>
            
            <!-- Enlace a página principal -->
            <a href="{{ route('welcome') }}" class="home-link mt-auto">🏠 Volver a Inicio</a>
        </div>
    </div>

    <!-- Contenido Principal -->
    <div class="content">
        <h2 class="mb-4 text-dark">📋 Lista de Tareas</h2>

        <div class="table-responsive">
            <table class="table table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Imagen</th>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Asignado a</th>
                        <th>Creación</th>
                        <th>Última Actualización</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tasks as $task)
                        <tr>
                            <td>{{ $task->id }}</td>
                            <td>
                                <img src="{{ asset('storage/' . $task->image) }}" alt="Imagen de la tarea" class="task-image">
                            </td>
                            <td>{{ $task->title }}</td>
                            <td>{{ $task->description }}</td>
                            <td>{{ $task->assigned_to }}</td>
                            <td>{{ $task->created_at->format('d/m/Y H:i') }}</td>
                            <td>{{ $task->updated_at->format('d/m/Y H:i') }}</td>
                            <td>
                                <span class="badge {{ $task->completed ? 'bg-success' : 'bg-warning' }}">
                                    {{ $task->completed ? 'Completada' : 'Pendiente' }}
                                </span>
                            </td>
                            <td>
                                <div class="d-flex gap-2">
                                    <form action="{{ route('tasks.toggle', $task->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="btn btn-sm {{ $task->completed ? 'btn-warning' : 'btn-success' }}">
                                            {{ $task->completed ? 'Pendiente' : 'Completar' }}
                                        </button>
                                    </form>
                                    <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-sm btn-primary">Editar</a>
                                    <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" onsubmit="return confirm('¿Eliminar esta tarea?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Paginación -->
        <div class="d-flex justify-content-center mt-3">
            {{ $tasks->appends(['filter' => $filter])->links() }}
        </div>
    </div>

</body>
</html>