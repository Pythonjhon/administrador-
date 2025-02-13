<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Tareas</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="container mt-5">
    <h1 class="mb-4">Lista de Tareas</h1>

    <!-- Filtros -->
    <div class="mb-3">
        <a href="{{ route('tasks.index') }}" class="btn btn-secondary {{ !$filter ? 'active' : '' }}">Todas</a>
        <a href="{{ route('tasks.index', ['filter' => 'completed']) }}" class="btn btn-success {{ $filter === 'completed' ? 'active' : '' }}">Completadas</a>
        <a href="{{ route('tasks.index', ['filter' => 'pending']) }}" class="btn btn-warning {{ $filter === 'pending' ? 'active' : '' }}">Pendientes</a>
    </div>

    <a href="{{ route('tasks.create') }}" class="btn btn-primary mb-3">Nueva Tarea</a>

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Título</th>
                <th>Descripción</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tasks as $task)
                <tr>
                    <td>{{ $task->id }}</td>
                    <td>{{ $task->title }}</td>
                    <td>{{ $task->description }}</td>
                    <td>
                        <span class="badge {{ $task->completed ? 'bg-success' : 'bg-warning' }}">
                            {{ $task->completed ? 'Completada' : 'Pendiente' }}
                        </span>
                    </td>
                    <td>
                        <form action="{{ route('tasks.toggle', $task->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="btn btn-info btn-sm">
                                {{ $task->completed ? 'Marcar como Pendiente' : 'Marcar como Completada' }}
                            </button>
                        </form>
                        <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-warning btn-sm">Editar</a>
                        <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Paginación -->
    <div class="d-flex justify-content-center">
        {{ $tasks->appends(['filter' => $filter])->links() }}
    </div>

</body>
</html>
