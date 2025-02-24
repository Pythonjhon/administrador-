<!-- resources/views/admin/login.blade.php -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de Sesión - Administrador</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f5f5f5;
            color: #333;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
        
        .container {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 500px;
            padding: 30px;
        }
        
        h2 {
            color: #2e7d32; /* Verde oscuro */
            text-align: center;
            margin-bottom: 30px;
            font-size: 28px;
            border-bottom: 2px solid #2e7d32;
            padding-bottom: 10px;
        }
        
        .error-container {
            background-color: #ffebee;
            border-left: 4px solid #f44336;
            padding: 12px;
            margin-bottom: 20px;
            border-radius: 4px;
        }
        
        .error-container ul {
            margin: 0;
            padding-left: 20px;
        }
        
        .error-container li {
            color: #d32f2f;
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        label {
            display: block;
            margin-bottom: 8px;
            color: #2e7d32; /* Verde oscuro */
            font-weight: bold;
        }
        
        input {
            width: 100%;
            padding: 12px;
            border: 2px solid #e0e0e0;
            border-radius: 4px;
            font-size: 16px;
            transition: border-color 0.3s;
            box-sizing: border-box;
        }
        
        input:focus {
            border-color: #2e7d32; /* Verde oscuro */
            outline: none;
        }
        
        button {
            background-color: #2e7d32; /* Verde oscuro */
            color: white;
            border: none;
            border-radius: 4px;
            padding: 14px 20px;
            font-size: 16px;
            cursor: pointer;
            width: 100%;
            font-weight: bold;
            transition: background-color 0.3s;
        }
        
        button:hover {
            background-color: #1b5e20; /* Verde más oscuro */
        }
        
        .footer {
            text-align: center;
            margin-top: 20px;
            color: #666;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Inicio de Sesión - Administrador</h2>

        @if ($errors->any())
            <div class="error-container">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.login.submit') }}" method="POST" autocomplete="off">
            @csrf
            <div class="form-group">
                <label for="email">Correo Electrónico:</label>
                <input type="email" name="email" id="email" autocomplete="new-email" required>
            </div>

            <div class="form-group">
                <label for="password">Contraseña:</label>
                <input type="password" name="password" id="password" autocomplete="new-password" required>
            </div>

            <button type="submit">Iniciar Sesión</button>
        </form>
        
        <div class="footer">
            Panel de Administración - Nuevo Talento Humano
        </div>
    </div>
</body>
</html>