<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Tarea</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            display: flex;
            height: 100vh;
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
            padding: 10px;
            margin: 5px 0;
            border-radius: 5px;
        }
        .sidebar a:hover, .sidebar .active {
            background: #1c7430;
        }
        .content {
            margin-left: 270px;
            flex-grow: 1;
            padding: 20px;
            width: 100%;
        }
    </style>
</head>
<body>

    <!-- Sidebar -->
    <div class="sidebar">
        <h4 class="text-center">📌 Panel de Tareas</h4>
        <a href="{{ route('tasks.index') }}">📋 Lista de Tareas</a>
        <a href="{{ route('tasks.create') }}" class="btn  w-100 mt-3">+ Nueva Tarea</a>
    </div>

    <!-- Contenido Principal -->
    <div class="content">
        <h2 class="mb-4">✏️ Editar Tarea</h2>

        <!-- Mostrar errores de validación -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('tasks.update', $task->id) }}" method="POST" class="card p-4 shadow" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="title" class="form-label">Título:</label>
                <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $task->title) }}" required>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Descripción:</label>
                <textarea name="description" id="description" class="form-control">{{ old('description', $task->description) }}</textarea>
            </div>

            <div class="mb-3">
                <label for="assigned_to" class="form-label">Asignado a:</label>
                <input type="text" name="assigned_to" id="assigned_to" class="form-control" value="{{ old('assigned_to', $task->assigned_to) }}" required>
            </div>

            <div class="mb-3">
                <label for="completed" class="form-label">Estado:</label>
                <select name="completed" id="completed" class="form-control">
                    <option value="0" {{ !$task->completed ? 'selected' : '' }}>Pendiente</option>
                    <option value="1" {{ $task->completed ? 'selected' : '' }}>Completada</option>
                </select>
            </div>

            <!-- Campo para la imagen -->
            <div class="mb-3">
                <label for="image" class="form-label">Imagen:</label>
                <input type="file" name="image" id="image" class="form-control">
                @if($task->image)
                    <div class="mt-2">
                        <p>Imagen actual:</p>
                        <img src="{{ asset('storage/' . $task->image) }}" alt="Imagen de la tarea" width="150">
                    </div>
                @endif
            </div>

            <button type="submit" class="btn btn-success">💾 Guardar Cambios</button>
            <a href="{{ route('tasks.index') }}" class="btn btn-secondary">🔙 Volver</a>
        </form>
    </div>

</body>
</html>
