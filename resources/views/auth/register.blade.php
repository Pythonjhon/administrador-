<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Usuario</title>
    <style>
        /* Estilos generales para la página */
        body {
            margin: 0;
            padding: 0;
            min-height: 100vh; /* Hace que el contenido ocupe toda la altura de la pantalla */
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            background-color: #f5f5f5;
            font-family: Arial, sans-serif;
        }

        /* Contenedor del título */
        .title-container {
            text-align: center;
            margin-bottom: 20px;
        }

        /* Estilos para el título principal */
        .main-title {
            color: #2e7d32;
            font-size: 26px;
            margin: 0;
            font-weight: bold;
        }

        /* Contenedor del formulario de registro */
        .register-container {
            width: 100%;
            max-width: 420px; /* Limita el ancho del formulario */
            margin: 20px;
            padding: 30px;
            border-radius: 10px; /* Bordes redondeados */
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); /* Sombra sutil */
            background-color: white;
        }

        /* Estilos para el formulario */
        .register-form {
            display: flex;
            flex-direction: column;
            gap: 18px; /* Espaciado entre los campos */
        }

        /* Estilos para los campos de entrada */
        .form-input {
            padding: 12px;
            border: 2px solid #4CAF50; /* Borde verde */
            border-radius: 6px;
            font-size: 15px;
            outline: none;
            transition: border-color 0.3s;
        }

        /* Efecto cuando el campo está en foco */
        .form-input:focus {
            border-color: #2e7d32;
            box-shadow: 0 0 5px rgba(76, 175, 80, 0.3);
        }

        /* Estilos para el botón de enviar */
        .submit-button {
            background-color: #4CAF50;
            color: white;
            padding: 14px;
            border: none;
            border-radius: 6px;
            font-size: 15px;
            cursor: pointer;
            transition: background-color 0.3s;
            font-weight: bold;
        }

        /* Efecto hover en el botón */
        .submit-button:hover {
            background-color: #2e7d32;
        }

        /* Color del placeholder en los inputs */
        .form-input::placeholder {
            color: #777;
        }

        /* Estilos para el enlace de inicio de sesión */
        .login-link {
            text-align: center;
            margin-top: 10px;
            font-size: 14px;
        }

        /* Estilos para el enlace dentro de la sección de inicio de sesión */
        .login-link a {
            color: #4CAF50;
            text-decoration: none;
            font-weight: bold;
        }

        /* Efecto hover en el enlace */
        .login-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <!-- Contenedor del título principal -->
    <div class="title-container">
        <h1 class="main-title">Crear Nueva Cuenta</h1>
    </div>

    <!-- Contenedor del formulario -->
    <div class="register-container">
        <!-- Formulario de registro -->
        <form method="POST" action="{{ route('register') }}" class="register-form" autocomplete="off">
            @csrf  <!-- Token de seguridad de Laravel para evitar ataques CSRF -->
            
            <!-- Campo para el nombre -->
            <input 
                type="text" 
                name="name" 
                placeholder="Nombre completo" 
                required 
                class="form-input"
                autocomplete="off">
            
            <!-- Campo para el correo electrónico -->
            <input 
                type="email" 
                name="email" 
                placeholder="Correo electrónico" 
                required 
                class="form-input"
                autocomplete="off">
            
            <!-- Campo para la contraseña -->
            <input 
                type="password" 
                name="password" 
                placeholder="Contraseña" 
                required 
                class="form-input"
                autocomplete="new-password">
            
            <!-- Campo para confirmar la contraseña -->
            <input 
                type="password" 
                name="password_confirmation" 
                placeholder="Confirmar contraseña" 
                required 
                class="form-input"
                autocomplete="new-password">
            
            <!-- Botón para enviar el formulario -->
            <button type="submit" class="submit-button">
                Crear Cuenta
            </button>
        </form>

        <!-- Enlace para redirigir a la página de inicio de sesión -->
        <div class="login-link">
            ¿Ya tienes una cuenta? <a href="{{ route('login') }}">Iniciar sesión</a>
        </div>
    </div>
</body>
</html>
