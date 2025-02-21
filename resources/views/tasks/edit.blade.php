<!--
Archivo: editar_tarea.html
Descripción: Este archivo representa una vista en HTML para editar una tarea dentro de una aplicación web.
Tecnologías utilizadas: HTML, CSS, Bootstrap 5, Blade (Laravel)

Estructura del documento:
1. Configuración inicial y estilos
2. Barra lateral de navegación
3. Contenido principal con formulario de edición de tarea
-->

<!DOCTYPE html>
<html lang="es">
<head>
    <!--
    Configuración del documento HTML:
    - Establece la codificación en UTF-8.
    - Configura la vista para que sea responsive.
    - Incluye Bootstrap 5 para estilos y diseño responsivo.
    -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Tarea</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        /*
        Estilos generales del documento
        - Se configura el body para usar flexbox y ocupar el 100% de la pantalla.
        */
        body {
            display: flex;
            height: 100vh;
        }

        /* Estilos para la barra lateral */
        .sidebar {
            width: 250px;
            background: #212529;
            color: white;
            padding: 20px;
            position: fixed;
            height: 100%;
        }

        /* Estilos para los enlaces de la barra lateral */
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

        /* Contenido principal */
        .content {
            margin-left: 270px;
            flex-grow: 1;
            padding: 20px;
            width: 100%;
        }

        /* Contenedor del formulario */
        .form-container {
            background: white;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }
    </style>
</head>
<body>
    <!-- Barra lateral de navegación -->
    <div class="sidebar">
        <h4 class="text-center">📌 Panel de Tareas</h4>
        <a href="{{ route('tasks.index') }}">📋 Lista de Tareas</a>
        <a href="{{ route('tasks.create') }}" class="btn w-100 mt-3">+ Nueva Tarea</a>
    </div>

    <!-- Contenido principal -->
    <div class="content">
        <h2 class="mb-3">✏️ Editar Tarea</h2>

        <!-- Sección para mostrar errores de validación -->
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
            <!-- Formulario de edición de tarea -->
            <form action="{{ route('tasks.update', $task->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Campo para el título -->
                <div class="mb-3">
                    <label for="title" class="form-label">Título:</label>
                    <input type="text" name="title" id="title" class="form-control" 
                           value="{{ old('title', $task->title) }}" required>
                </div>

                <!-- Campo para la descripción -->
                <div class="mb-3">
                    <label for="description" class="form-label">Descripción:</label>
                    <textarea name="description" id="description" class="form-control" 
                            rows="3">{{ old('description', $task->description) }}</textarea>
                </div>

                <!-- Selector de usuario asignado -->
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

                <!-- Selector de estado de la tarea -->
                <div class="mb-3">
                    <label for="completed" class="form-label">Estado:</label>
                    <select name="completed" id="completed" class="form-control">
                        <option value="0" {{ !$task->completed ? 'selected' : '' }}>Pendiente</option>
                        <option value="1" {{ $task->completed ? 'selected' : '' }}>Completada</option>
                    </select>
                </div>

                <!-- Subir imagen -->
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

                <!-- Subir archivo -->
                <div class="mb-3">
                    <label for="archivo" class="form-label">Subir Archivo:</label>
                    <input type="file" name="archivo" id="archivo" class="form-control">
                </div>

                <!-- Botones de acción -->
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-success">💾 Guardar Cambios</button>
                    <a href="{{ route('tasks.index') }}" class="btn btn-secondary">🔙 Volver</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
