<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Usuario</title>
    <style>
        /* Reset y estilos base */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Arial', sans-serif;
        }

        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background: linear-gradient(135deg, #2e7d32, #4CAF50);
        }

        .container {
            background: white;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
            text-align: center;
            width: 100%;
            max-width: 400px;
        }

        h1 {
            font-size: 24px;
            color: #2e7d32;
            margin-bottom: 10px;
        }

        .subtitle {
            font-size: 16px;
            color: #4CAF50;
            margin-bottom: 20px;
        }

        .form-input {
            width: 100%;
            padding: 14px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 16px;
            transition: all 0.3s;
        }

        .form-input:focus {
            border-color: #2e7d32;
            box-shadow: 0 0 5px rgba(46, 125, 50, 0.3);
        }

        .submit-button {
            width: 100%;
            background: #2e7d32;
            color: white;
            padding: 14px;
            font-size: 16px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: 0.3s;
            text-transform: uppercase;
        }

        .submit-button:hover {
            background: #1b5e20;
        }

        .register-link {
            display: block;
            margin-top: 15px;
            font-size: 14px;
            color: #2e7d32;
            text-decoration: none;
            transition: 0.3s;
        }

        .register-link:hover {
            color: #1b5e20;
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Crear Nueva Cuenta</h1>
        <p class="subtitle">Regístrate para acceder</p>
        
        <form method="POST" action="{{ route('register') }}" autocomplete="off">
            @csrf  <!-- Token de seguridad de Laravel para evitar ataques CSRF -->
            
            <input 
                type="text" 
                name="name" 
                placeholder="Nombre completo" 
                required 
                class="form-input"
                autocomplete="off">
            
            <input 
                type="email" 
                name="email" 
                placeholder="Correo electrónico" 
                required 
                class="form-input"
                autocomplete="off">
            
            <input 
                type="password" 
                name="password" 
                placeholder="Contraseña" 
                required 
                class="form-input"
                autocomplete="new-password">
            
            <input 
                type="password" 
                name="password_confirmation" 
                placeholder="Confirmar contraseña" 
                required 
                class="form-input"
                autocomplete="new-password">
            
            <button type="submit" class="submit-button">
                Crear Cuenta
            </button>
        </form>

        <a href="{{ route('login') }}" class="register-link">¿Ya tienes una cuenta? Iniciar sesión</a>
    </div>
</body>
</html>
