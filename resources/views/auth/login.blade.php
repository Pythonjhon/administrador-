<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <style>
        /* Estilos generales del cuerpo */
        body {
            margin: 0;
            padding: 0;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            background-color: #f5f5f5;
            font-family: Arial, sans-serif;
        }

        /* Contenedor del título principal */
        .title-container {
            text-align: center;
            margin-bottom: 30px;
        }

        /* Título principal */
        .main-title {
            color: #2e7d32;
            font-size: 28px;
            margin: 0;
            padding: 0;
            font-weight: bold;
        }

        /* Subtítulo */
        .subtitle {
            color: #4CAF50;
            font-size: 20px;
            margin-top: 10px;
        }

        /* Contenedor del formulario de inicio de sesión */
        .login-container {
            width: 100%;
            max-width: 400px;
            margin: 20px;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            background-color: white;
        }

        /* Estilo del formulario */
        .login-form {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        /* Estilos para los campos de entrada */
        .form-input {
            padding: 15px;
            border: 2px solid #4CAF50;
            border-radius: 8px;
            font-size: 16px;
            outline: none;
            transition: all 0.3s ease;
        }

        /* Efecto al enfocar un campo */
        .form-input:focus {
            border-color: #2e7d32;
            box-shadow: 0 0 5px rgba(76, 175, 80, 0.3);
        }

        /* Botón de envío */
        .submit-button {
            background-color: #4CAF50;
            color: white;
            padding: 15px;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        /* Efecto hover en el botón */
        .submit-button:hover {
            background-color: #2e7d32;
        }

        /* Color de los placeholders */
        .form-input::placeholder {
            color: #999;
        }
    </style>
</head>
<body>

    <!-- Contenedor del título -->
    <div class="title-container">
        <h1 class="main-title">Bienvenido a la Corporación</h1>
        <div class="subtitle">Nuevo Talento Humano</div>
    </div>

    <!-- Contenedor del formulario de inicio de sesión -->
    <div class="login-container">
        <form method="POST" action="{{ route('login') }}" class="login-form" autocomplete="off">
            @csrf
            
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
            
            <!-- Botón para enviar el formulario -->
            <button type="submit" class="submit-button">
                Iniciar sesión
            </button>
        </form>
    </div>

</body>
</html>
