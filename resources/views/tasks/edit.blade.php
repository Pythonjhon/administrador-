<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Tarea</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
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

.sidebar h4 {
    color: white;
    margin-bottom: 20px;
    padding-bottom: 10px;
    border-bottom: 1px solid rgba(255, 255, 255, 0.1);
}

.sidebar a {
    display: block;
    color: rgba(255, 255, 255, 0.8);
    text-decoration: none;
    padding: 8px 12px;
    border-radius: var(--border-radius);
    transition: var(--transition);
}

.sidebar a:hover {
    background: var(--accent-color);
    color: white;
}

.sidebar .btn {
    background-color: var(--accent-color);
    color: white;
    border: none;
    font-weight: 500;
    transition: var(--transition);
}

.sidebar .btn:hover {
    background-color: #15803d;
}

/* Content styles */
.content {
    margin-left: var(--sidebar-width);
    flex-grow: 1;
    padding: 20px;
    max-width: calc(100% - var(--sidebar-width));
}

.content h2 {
    font-size: 1.3rem;
    font-weight: 600;
    color: #333;
    margin-bottom: 20px;
}

.alert {
    border-radius: var(--border-radius);
    padding: 15px;
    margin-bottom: 20px;
}

.alert-danger {
    background-color: rgba(220, 53, 69, 0.1);
    border: 1px solid rgba(220, 53, 69, 0.2);
    color: #dc3545;
}

.alert ul {
    padding-left: 20px;
    margin-bottom: 0;
}

.form-container {
    background-color: white;
    border-radius: var(--border-radius);
    padding: 20px;
    box-shadow: var(--box-shadow);
}

.form-label {
    font-weight: 600;
    color: #555;
    margin-bottom: 8px;
}

.form-control {
    border-radius: var(--border-radius);
    border: 1px solid #ced4da;
    padding: 8px 12px;
    transition: border-color 0.15s ease-in-out;
    width: 100%;
}

.form-control:focus {
    border-color: var(--accent-color);
    outline: 0;
    box-shadow: 0 0 0 0.2rem rgba(22, 163, 74, 0.25);
}

.mb-3 {
    margin-bottom: 1rem;
}

.mt-2 {
    margin-top: 0.5rem;
}

.mt-3 {
    margin-top: 1rem;
}

.mb-2 {
    margin-bottom: 0.5rem;
}

.mb-0 {
    margin-bottom: 0;
}

.file-preview {
    padding: 10px;
    border-radius: var(--border-radius);
    background-color: rgba(0, 0, 0, 0.03);
}

.file-preview img {
    border-radius: var(--border-radius);
    border: 1px solid #ddd;
}

.btn {
    font-size: 0.85rem;
    padding: 0.375rem 0.75rem;
    border-radius: var(--border-radius);
    transition: var(--transition);
    text-decoration: none;
    display: inline-block;
    text-align: center;
    cursor: pointer;
}

.btn-success {
    background-color: var(--accent-color);
    border: 1px solid var(--accent-color);
    color: white;
}

.btn-success:hover {
    background-color: #15803d;
    border-color: #15803d;
}

.btn-secondary {
    background-color: #6c757d;
    border: 1px solid #6c757d;
    color: white;
}

.btn-secondary:hover {
    background-color: #5a6268;
    border-color: #5a6268;
}

.d-flex {
    display: flex;
}

.gap-2 {
    gap: 0.5rem;
}

.w-100 {
    width: 100%;
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
        <h4 class="text-center">📌 Panel de Tareas</h4>
        <a href="{{ route('tasks.index') }}">📋 Lista de Tareas</a>
        <a href="{{ route('tasks.create') }}" class="btn w-100 mt-3">+ Nueva Tarea</a>
    </div>

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
                    <textarea name="description" id="description" class="form-control" rows="3">{{ old('description', $task->description) }}</textarea>
                </div>

                <div class="mb-3">
                    <label for="assigned_to" class="form-label">Asignado a:</label>
                    <select name="assigned_to" id="assigned_to" class="form-control">
                        <option value="">-- No asignado --</option>
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}" {{ old('assigned_to', $task->assigned_to) == $user->id ? 'selected' : '' }}>
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
                            <img src="{{ asset('storage/' . $task->image) }}" alt="Imagen de la tarea" width="150">
                        </div>
                    @endif
                </div>

                <div class="mb-3">
                    <label for="archivo" class="form-label">Subir Archivo:</label>
                    <input type="file" name="archivo" id="archivo" class="form-control">
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
