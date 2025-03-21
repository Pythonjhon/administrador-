<!-- resources/views/admin/register.blade.php -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Administrador | Nuevo Talento Humano</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
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

        .logo {
            font-size: 30px;
            color: #2e7d32;
            margin-bottom: 15px;
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

        .error-container {
            background-color: #ffebee;
            border-left: 4px solid #f44336;
            padding: 12px;
            margin-bottom: 20px;
            border-radius: 4px;
            text-align: left;
        }

        .error-container ul {
            margin: 0;
            padding-left: 20px;
        }

        .error-container li {
            color: #d32f2f;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .input-container {
            position: relative;
        }

        .input-container i {
            position: absolute;
            left: 12px;
            top: 15px;
            color: #999;
        }

        .form-input {
            width: 100%;
            padding: 14px 14px 14px 40px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 16px;
            transition: all 0.3s;
        }

        .form-input:focus {
            border-color: #2e7d32;
            box-shadow: 0 0 5px rgba(46, 125, 50, 0.3);
            outline: none;
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
            font-weight: bold;
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 8px;
        }

        .submit-button:hover {
            background: #1b5e20;
        }

        .login-link {
            display: block;
            margin-top: 20px;
            font-size: 14px;
            color: #666;
        }

        .register-link {
            display: inline-block;
            margin-left: 5px;
            font-size: 14px;
            color: #2e7d32;
            text-decoration: none;
            transition: 0.3s;
            font-weight: bold;
        }

        .register-link:hover {
            color: #1b5e20;
            text-decoration: underline;
        }

        .footer {
            margin-top: 30px;
            font-size: 12px;
            color: #666;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="logo">
            <i class="fas fa-users"></i>
        </div>
        <h1>Registro de Administrador</h1>
        <p class="subtitle">Completa tus datos para crear una cuenta</p>
        
        @if ($errors->any())
            <div class="error-container">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        
        <form action="{{ route('admin.register.submit') }}" method="POST" autocomplete="off">
            @csrf
            <div class="form-group">
                <div class="input-container">
                    <i class="fas fa-user"></i>
                    <input type="text" name="name" id="name" class="form-input" required autocomplete="off" placeholder="Nombre completo">
                </div>
            </div>
            
            <div class="form-group">
                <div class="input-container">
                    <i class="fas fa-envelope"></i>
                    <input type="email" name="email" id="email" class="form-input" required autocomplete="new-email" placeholder="Correo electrónico">
                </div>
            </div>
            
            <div class="form-group">
                <div class="input-container">
                    <i class="fas fa-lock"></i>
                    <input type="password" name="password" id="password" class="form-input" required autocomplete="new-password" placeholder="Contraseña">
                </div>
            </div>
            
            <div class="form-group">
                <div class="input-container">
                    <i class="fas fa-lock"></i>
                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-input" required autocomplete="new-password" placeholder="Confirmar contraseña">
                </div>
            </div>
            
            <button type="submit" class="submit-button">
                <i class="fas fa-user-plus"></i> Registrarse
            </button>
        </form>
        
        <div class="login-link">
            ¿Ya tienes cuenta? 
            <a href="{{ route('admin.login') }}" class="register-link">
                Iniciar sesión
            </a>
        </div>
        
        <div class="footer">
            <strong>Nuevo Talento Humano</strong> - Panel de Administración
        </div>
    </div>
</body>
</html>