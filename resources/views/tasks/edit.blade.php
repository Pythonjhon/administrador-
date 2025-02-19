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
            background: #2e7d32;
        }

        .content {
            margin-left: 270px;
            flex-grow: 1;
            padding: 20px;
            width: 100%;
        }

        .form-container {
            background: white;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        .form-control {
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        .form-control:focus {
            border-color: #2e7d32;
            box-shadow: 0 0 0 0.2rem rgba(46, 125, 50, 0.25);
        }

        .file-preview {
            background: #f8f9fa;
            padding: 10px;
            border-radius: 4px;
            margin-top: 8px;
        }

        .btn-success {
            background-color: #2e7d32;
            border: none;
        }

        .btn-success:hover {
            background-color: #2e7d32;
        }

        .alert-danger {
            border-radius: 4px;
            padding: 10px 15px;
            margin-bottom: 15px;
        }

        .form-label {
            margin-bottom: 5px;
            font-weight: normal;
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <h4 class="text-center">📌 Panel de Tareas</h4>
        <a href="{{ route('tasks.index') }}">📋 Lista de Tareas</a>
        <a href="{{ route('tasks.create') }}" class="btn w-100 mt-3">+ Nueva Tarea</a>
    </div>

    <!-- Contenido Principal -->
    <div class="content">
        <h2 class="mb-3">✏️ Editar Tarea</h2>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="form-container">
            <form action="{{ route('tasks.update', $task->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="title" class="form-label">Título:</label>
                    <input type="text" name="title" id="title" class="form-control" 
                           value="{{ old('title', $task->title) }}" required>
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Descripción:</label>
                    <textarea name="description" id="description" class="form-control" 
                            rows="3">{{ old('description', $task->description) }}</textarea>
                </div>

                <div class="mb-3">
                    <label for="assigned_to" class="form-label">Asignado a:</label>
                    <select name="assigned_to" id="assigned_to" class="form-control">
                        <option value="">-- No asignado --</option>
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}" 
                                {{ old('assigned_to', $task->assigned_to) == $user->id ? 'selected' : '' }}>
                                {{ $user->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="completed" class="form-label">Estado:</label>
                    <select name="completed" id="completed" class="form-control">
                        <option value="0" {{ !$task->completed ? 'selected' : '' }}>Pendiente</option>
                        <option value="1" {{ $task->completed ? 'selected' : '' }}>Completada</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="image" class="form-label">Imagen:</label>
                    <input type="file" name="image" id="image" class="form-control">
                    @if($task->image)
                        <div class="file-preview mt-2">
                            <p class="mb-2">Imagen actual:</p>
                            <img src="{{ asset('storage/' . $task->image) }}" 
                                 alt="Imagen de la tarea" width="150">
                        </div>
                    @endif
                </div>

                <div class="mb-3">
                    <label for="archivo" class="form-label">Subir Archivo:</label>
                    <input type="file" name="archivo" id="archivo" class="form-control">
                    @if($task->archivo)
                        <div class="mt-2">
                            <p class="mb-2">Archivo actual: <a href="{{ asset('storage/' . $task->archivo) }}" target="_blank">Ver archivo</a></p>
                        </div>
                    @endif
                    
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-success">💾 Guardar Cambios</button>
                    <a href="{{ route('tasks.index') }}" class="btn btn-secondary">🔙 Volver</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
