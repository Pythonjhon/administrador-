<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Usuarios</title>
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
            background: #2e7d32;
        }
        .content {
            margin-left: 270px;
            flex-grow: 1;
            padding: 30px;
        }
        .task-image {
            max-width: 100px;
            max-height: 100px;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <h4 class="text-center mb-3">📌 Panel de Usuarios</h4>
        <a href="{{ route('users.index') }}" class="active">👥 Lista de Usuarios</a>
        <a href="{{ route('admin.dashboard') }}">🏠 Volver al Panel</a>
    </div>

    <div class="content">
        <h2 class="mb-4 text-dark">👥 Lista de Usuarios</h2>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Última Tarea</th>
                        <th>Imagen</th>
                        <th>Archivo</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            @if($user->tasks->isNotEmpty())
                                {{ $user->tasks->last()->title }}
                            @else
                                <span class="text-muted">Sin tareas</span>
                            @endif
                        </td>
                        <td>
                            @if($user->tasks->isNotEmpty() && $user->tasks->last()->image)
                                <img src="{{ asset('storage/' . $user->tasks->last()->image) }}" alt="Imagen de tarea" class="task-image">
                            @else
                                <span class="text-muted">Sin imagen</span>
                            @endif
                        </td>
                        <td>
                            @if($user->tasks->isNotEmpty() && $user->tasks->last()->archivo)
                                <a href="{{ asset('storage/' . $user->tasks->last()->archivo) }}" class="btn btn-sm btn-info" target="_blank">
                                    📂 Ver archivo
                                </a>
                            @else
                                <span class="text-muted">Sin archivo</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-primary">✏️ Editar</a>
                            <form action="{{ route('users.delete', $user->id) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Eliminar este usuario?');">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">🗑️ Eliminar</button>
                            </form>
                            <a href="{{ route('users.assign-task', $user->id) }}" class="btn btn-sm btn-info">📌 Asignar Tarea</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>