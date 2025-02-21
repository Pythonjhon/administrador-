<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Tarea</title>
    
    <!-- Importar Bootstrap 5 desde un CDN para estilos responsivos y modernos -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

    <style>
        /* Estilos generales para centrar la tarjeta en la pantalla */
        body {
            display: flex;
            height: 100vh; /* Ocupa toda la altura de la pantalla */
            justify-content: center; /* Centra horizontalmente */
            align-items: center; /* Centra verticalmente */
            background-color: #f8f9fa; /* Color de fondo claro */
        }

        /* Estilos para la tarjeta */
        .card {
            width: 100%;
            max-width: 500px; /* Máximo ancho de la tarjeta */
            border-radius: 10px; /* Bordes redondeados */
        }
    </style>
</head>
<body>

    <!-- Contenedor de la tarjeta con sombra y espaciado -->
    <div class="card shadow p-4">
        <h3 class="text-center mb-3">🚀 Nueva Tarea</h3>

        <!-- Mostrar errores de validación si existen -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Formulario para crear una nueva tarea -->
        <form action="{{ route('tasks.store') }}" method="POST" enctype="multipart/form-data">
            @csrf  <!-- Protección contra ataques CSRF -->

            <!-- Campo para el título de la tarea -->
            <div class="mb-3">
                <label for="title" class="form-label">📌 Título:</label>
                <input type="text" name="title" id="title" class="form-control" required value="{{ old('title') }}">
            </div>

            <!-- Campo para la descripción de la tarea -->
            <div class="mb-3">
                <label for="description" class="form-label">📝 Descripción:</label>
                <textarea name="description" id="description" class="form-control">{{ old('description') }}</textarea>
            </div>

            <!-- Campo para seleccionar a qué usuario se asigna la tarea -->
            <div class="mb-3">
                <label for="assigned_to" class="form-label">👤 Asignado a:</label>
                <select name="assigned_to" id="assigned_to" class="form-select" required>
                    <option value="">-- Seleccionar usuario --</option>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}" {{ old('assigned_to') == $user->id ? 'selected' : '' }}>
                            {{ $user->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Campo para seleccionar el estado de la tarea (Pendiente o Completada) -->
            <div class="mb-3">
                <label for="completed" class="form-label">⚡ Estado:</label>
                <select name="completed" id="completed" class="form-select">
                    <option value="0" selected>Pendiente</option>
                    <option value="1">Completada</option>
                </select>
            </div>

            <!-- Campo para subir una imagen opcional -->
            <div class="mb-3">
                <label for="image" class="form-label">🖼️ Imagen:</label>
                <input type="file" name="image" id="image" class="form-control">
            </div>

            <!-- Campo para adjuntar un archivo opcional -->
            <div class="mb-3">
                <label for="archivo" class="form-label">📂 Archivo adjunto:</label>
                <input type="file" name="archivo" id="archivo" class="form-control">
            </div>

            <!-- Botones de acción: Volver o Guardar la tarea -->
            <div class="d-flex justify-content-between">
                <a href="{{ route('tasks.index') }}" class="btn btn-secondary">⬅ Volver</a>
                <button type="submit" class="btn btn-success">💾 Guardar</button>
            </div>
        </form>
    </div>

</body>
</html>
