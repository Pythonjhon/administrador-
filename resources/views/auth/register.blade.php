<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <style>
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

        .title-container {
            text-align: center;
            margin-bottom: 20px;
        }

        .main-title {
            color: #2e7d32;
            font-size: 24px;
            margin: 0;
            padding: 0;
            font-weight: bold;
        }

        .register-container {
            width: 100%;
            max-width: 400px;
            margin: 20px;
            padding: 25px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            background-color: white;
        }

        .register-form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .form-input {
            padding: 10px;
            border: 2px solid #4CAF50;
            border-radius: 5px;
            font-size: 14px;
            outline: none;
            transition: border-color 0.3s;
        }

        .form-input:focus {
            border-color: #2e7d32;
        }

        .submit-button {
            background-color: #4CAF50;
            color: white;
            padding: 12px;
            border: none;
            border-radius: 5px;
            font-size: 14px;
            cursor: pointer;
            transition: background-color 0.3s;
            font-weight: bold;
        }

        .submit-button:hover {
            background-color: #2e7d32;
        }

        .form-input::placeholder {
            color: #666;
        }
    </style>
</head>
<body>
    <div class="title-container">
        <h1 class="main-title">Crear Nueva Cuenta</h1>
    </div>

    <div class="register-container">
        <form method="POST" action="{{ route('register') }}" class="register-form" autocomplete="off">
            @csrf
            
            <input 
                type="text" 
                name="name" 
                placeholder="Nombre" 
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
    </div>
</body>
</html>