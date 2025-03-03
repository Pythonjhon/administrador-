<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h2>Editar Usuario</h2>
<form action="{{ route('users.update', $user->id) }}" method="POST">
    @csrf @method('PUT')
    <label>Nombre:</label>
    <input type="text" name="name" value="{{ $user->name }}" required>
    <label>Email:</label>
    <input type="email" name="email" value="{{ $user->email }}" required>
    <label>Contraseña (Opcional):</label>
    <input type="password" name="password">
    <input type="password" name="password_confirmation">
    <button type="submit">Actualizar</button>
</form>
    
</body>
</html>