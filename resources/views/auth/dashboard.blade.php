<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil</title>
</head>
<body>
    <h2>Bienvenido</h2>

    <p><strong>Nombre:</strong> {{ $user->name }}</p>
    <p><strong>Email:</strong> {{ $user->email }}</p>
    <p><strong>Fecha de Registro:</strong> {{ $user->created_at }}</p>

      <!-- Botón de cierre de sesión -->
      <form action="{{ route('logout') }}" method="POST" class="mt-auto">
        @csrf
        <button type="submit" class="logout-btn">Cerrar Sesión</button>
    </form>
</body>
</html>
