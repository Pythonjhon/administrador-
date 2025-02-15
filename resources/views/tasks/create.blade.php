<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Tarea</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            display: flex;
            height: 100vh;
            justify-content: center;
            align-items: center;
            background-color: #f8f9fa;
        }
        .card {
            width: 100%;
            max-width: 500px;
            border-radius: 10px;
        }
    </style>
</head>
<body>

    <div class="card shadow p-4">
        <h3 class="text-center mb-3">🚀 Nueva Tarea</h3>

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

        <form action="{{ route('tasks.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="title" class="form-label">📌 Título:</label>
                <input type="text" name="title" id="title" class="form-control" required value="{{ old('title') }}">
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">📝 Descripción:</label>
                <textarea name="description" id="description" class="form-control">{{ old('description') }}</textarea>
            </div>

            <div class="mb-3">
                <label for="assigned_to" class="form-label">👤 Asignado a:</label>
                <input type="text" name="assigned_to" id="assigned_to" class="form-control" required value="{{ old('assigned_to') }}">
            </div>

            <div class="mb-3">
                <label for="completed" class="form-label">⚡ Estado:</label>
                <select name="completed" id="completed" class="form-select">
                    <option value="0" selected>Pendiente</option>
                    <option value="1">Completada</option>
                </select>
            </div>

            <div class="d-flex justify-content-between">
                <a href="{{ route('tasks.index') }}" class="btn btn-secondary">⬅ Volver</a>
                <button type="submit" class="btn btn-success">💾 Guardar</button>
            </div>
        </form>
    </div>

</body>
</html>
