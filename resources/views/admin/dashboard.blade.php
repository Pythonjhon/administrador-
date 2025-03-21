<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administrador</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #0e5937;
            --secondary-color: #f8f9fa;
            --sidebar-width: 250px;
            --sidebar-dark: #1a1a2e;
            --accent-color: #16a34a;
            --text-light: #e2e8f0;
            --border-radius: 6px;
            --box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
            --transition: all 0.3s ease;
        }
        
        body {
            display: flex;
            min-height: 100vh;
            background-color: #f4f7f9;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            font-size: 14px;
        }

        /* Sidebar styles */
        .sidebar {
            width: var(--sidebar-width);
            background: var(--sidebar-dark);
            color: var(--text-light);
            padding: 15px;
            position: fixed;
            height: 100%;
            display: flex;
            flex-direction: column;
            z-index: 1000;
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.1);
            overflow-y: auto;
        }

        .sidebar-header {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .logo {
            font-size: 1.25rem;
            font-weight: 700;
            color: white;
            margin: 0;
        }

        .logo-accent {
            color: var(--accent-color);
        }

        .user-info {
            text-align: center;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .profile-sidebar-pic {
            width: 70px;
            height: 70px;
            border-radius: 50%;
            overflow: hidden;
            background: #e0e0e0;
            margin: 0 auto 10px;
            border: 2px solid var(--accent-color);
        }

        .profile-sidebar-pic img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .user-name {
            font-size: 1rem;
            font-weight: 600;
            margin-bottom: 3px;
            color: white;
        }

        .user-role {
            font-size: 0.8rem;
            color: rgba(255, 255, 255, 0.6);
            margin-bottom: 0;
        }

        .nav-section {
            margin-bottom: 15px;
        }

        .nav-header {
            font-size: 0.7rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: rgba(255, 255, 255, 0.5);
            margin-bottom: 8px;
            padding-left: 8px;
        }

        .nav-menu {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }

        .nav-item {
            margin-bottom: 3px;
        }

        .nav-link {
            display: flex;
            align-items: center;
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            padding: 8px 12px;
            border-radius: var(--border-radius);
            transition: var(--transition);
        }

        .nav-link:hover, .nav-link.active {
            background: var(--accent-color);
            color: white;
        }

        .nav-link i {
            margin-right: 8px;
            font-size: 1rem;
            width: 16px;
            text-align: center;
        }

        .admin-badge {
            display: inline-block;
            background-color: rgba(255, 255, 255, 0.1);
            color: white;
            font-size: 0.7rem;
            font-weight: 500;
            padding: 2px 6px;
            border-radius: 3px;
            margin-left: auto;
        }

        .sidebar-footer {
            margin-top: auto;
            padding-top: 15px;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
        }

        .logout-btn {
            display: flex;
            align-items: center;
            width: 100%;
            padding: 8px 12px;
            border: none;
            border-radius: var(--border-radius);
            background: rgba(220, 53, 69, 0.8);
            color: white;
            font-weight: 500;
            transition: var(--transition);
            text-align: left;
            font-size: 0.9rem;
        }

        .logout-btn:hover {
            background: #dc3545;
        }

        .logout-btn i {
            margin-right: 8px;
        }

        /* Content styles */
        .content {
            margin-left: var(--sidebar-width);
            flex-grow: 1;
            padding: 20px;
            max-width: calc(100% - var(--sidebar-width));
        }

        .page-header {
            background-color: white;
            border-radius: var(--border-radius);
            padding: 15px 20px;
            margin-bottom: 20px;
            box-shadow: var(--box-shadow);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .page-title {
            font-size: 1.3rem;
            font-weight: 600;
            color: #333;
            margin: 0;
        }

        .header-actions {
            display: flex;
            gap: 8px;
        }

        .card {
            border-radius: var(--border-radius);
            border: none;
            box-shadow: var(--box-shadow);
            margin-bottom: 20px;
            background-color: white;
            overflow: hidden;
        }

        .card-header {
            background-color: white;
            padding: 15px 20px;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        }

        .card-title {
            font-size: 1.1rem;
            font-weight: 600;
            color: #333;
            margin: 0;
        }

        .card-body {
            padding: 20px;
        }

        .profile-container {
            display: flex;
            gap: 20px;
            align-items: flex-start;
            flex-wrap: wrap;
        }

        .profile-pic {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            overflow: hidden;
            background: #e0e0e0;
            box-shadow: var(--box-shadow);
            border: 3px solid white;
            flex-shrink: 0;
        }

        .profile-pic img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .profile-info {
            flex: 1;
            min-width: 200px;
        }

        .info-item {
            margin-bottom: 12px;
            padding-bottom: 12px;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            display: flex;
            flex-wrap: wrap;
        }

        .info-item:last-child {
            border-bottom: none;
            margin-bottom: 0;
            padding-bottom: 0;
        }

        .info-label {
            font-weight: 600;
            color: #555;
            width: 100px;
            min-width: 100px;
        }

        .info-value {
            color: #333;
            flex: 1;
        }

        .btn {
            font-size: 0.85rem;
            padding: 0.375rem 0.75rem;
        }

        .btn-primary {
            background-color: var(--accent-color);
            border-color: var(--accent-color);
            box-shadow: 0 2px 4px rgba(22, 163, 74, 0.2);
        }

        .btn-primary:hover {
            background-color: #15803d;
            border-color: #15803d;
        }

        .btn-outline-primary {
            color: var(--accent-color);
            border-color: var(--accent-color);
        }

        .btn-outline-primary:hover {
            background-color: var(--accent-color);
            border-color: var(--accent-color);
            color: white;
        }

        .btn-danger {
            background-color: #dc3545;
            border-color: #dc3545;
        }

        .delete-btn {
            background-color: rgba(220, 53, 69, 0.1);
            color: #dc3545;
            border: 1px solid rgba(220, 53, 69, 0.2);
            font-weight: 500;
            padding: 8px 12px;
            border-radius: var(--border-radius);
            transition: var(--transition);
            font-size: 0.85rem;
        }

        .delete-btn:hover {
            background-color: #dc3545;
            color: white;
            border-color: #dc3545;
        }

        .delete-btn i {
            margin-right: 5px;
        }

        .action-buttons {
            margin-top: 15px;
            display: flex;
            gap: 8px;
        }

        .empty-profile-placeholder {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            background-color: #e0e0e0;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            color: #999;
            box-shadow: var(--box-shadow);
            border: 3px solid white;
            flex-shrink: 0;
        }

        /* Responsive adjustments */
        @media (max-width: 991px) {
            :root {
                --sidebar-width: 220px;
            }
            
            .profile-container {
                flex-direction: column;
                align-items: center;
                text-align: center;
            }
            
            .info-item {
                text-align: left;
            }
            
            .action-buttons {
                justify-content: center;
            }
        }

        @media (max-width: 767px) {
            :root {
                --sidebar-width: 0;
            }
            
            .sidebar {
                transform: translateX(-100%);
                transition: transform 0.3s ease;
            }
            
            .sidebar.show {
                transform: translateX(0);
                width: 250px;
            }
            
            .content {
                margin-left: 0;
                max-width: 100%;
            }
            
            .toggle-sidebar {
                display: block;
                position: fixed;
                top: 15px;
                left: 15px;
                z-index: 1010;
                background: var(--accent-color);
                color: white;
                border: none;
                border-radius: 5px;
                width: 40px;
                height: 40px;
                display: flex;
                align-items: center;
                justify-content: center;
                box-shadow: 0 2px 5px rgba(0,0,0,0.2);
            }
            
            .page-header {
                margin-top: 50px;
            }
        }
    </style>
</head>
<body>
    <!-- Mobile menu toggle button -->
    <button class="toggle-sidebar d-md-none">
        <i class="fas fa-bars"></i>
    </button>

    <div class="sidebar">
        <div class="sidebar-header">
            <h1 class="logo">Admin<span class="logo-accent">Panel</span></h1>
        </div>
        
        <div class="user-info">
            <div class="profile-sidebar-pic">
                @if($admin->profile_image)
                    <img src="{{ asset('storage/' . $admin->profile_image) }}" alt="Foto de perfil">
                @else
                    <div class="d-flex align-items-center justify-content-center h-100 bg-secondary text-white">
                        <i class="fas fa-user"></i>
                    </div>
                @endif
            </div>
            <h5 class="user-name">{{ $admin->name }}</h5>
            <p class="user-role">Administrador</p>
        </div>
        
        <div class="nav-section">
            <h6 class="nav-header">Perfil</h6>
            <ul class="nav-menu">
                <li class="nav-item">
                    <a href="#" class="nav-link active">
                        <i class="fas fa-user-circle"></i>
                        <span>Datos Personales</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.edit') }}" class="nav-link">
                        <i class="fas fa-edit"></i>
                        <span>Editar Perfil</span>
                    </a>
                </li>
            </ul>
        </div>
        
        <div class="nav-section">
            <h6 class="nav-header">Administración</h6>
            <ul class="nav-menu">
                <li class="nav-item">
                    <a href="{{ route('users.index') }}" class="nav-link">
                        <i class="fas fa-users"></i>
                        <span>Usuarios</span>
                        <span class="admin-badge">Admin</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fas fa-cog"></i>
                        <span>Configuración</span>
                    </a>
                </li>
            </ul>
        </div>
        
        <div class="sidebar-footer">
            <form action="{{ route('admin.logout') }}" method="POST">
                @csrf
                <button type="submit" class="logout-btn">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Cerrar Sesión</span>
                </button>
            </form>
        </div>
    </div>

    <div class="content">
        <div class="page-header">
            <h2 class="page-title">Panel de Administrador</h2>
            <div class="header-actions">
                <a href="{{ route('admin.edit') }}" class="btn btn-outline-primary btn-sm">
                    <i class="fas fa-edit"></i> Editar
                </a>
            </div>
        </div>
        
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Información Personal</h5>
            </div>
            <div class="card-body">
                <div class="profile-container">
                    @if($admin->profile_image)
                        <div class="profile-pic">
                            <img src="{{ asset('storage/' . $admin->profile_image) }}" alt="Foto de perfil">
                        </div>
                    @else
                        <div class="empty-profile-placeholder">
                            <i class="fas fa-user"></i>
                        </div>
                    @endif
                    
                    <div class="profile-info">
                        <div class="info-item">
                            <div class="info-label">Nombre:</div>
                            <div class="info-value">{{ $admin->name }}</div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">Email:</div>
                            <div class="info-value">{{ $admin->email }}</div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">Teléfono:</div>
                            <div class="info-value">{{ $admin->phone ?? 'No registrado' }}</div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">Dirección:</div>
                            <div class="info-value">{{ $admin->address ?? 'No registrada' }}</div>
                        </div>
                        
                        <div class="action-buttons">
                            <a href="{{ route('admin.edit') }}" class="btn btn-primary btn-sm">
                                <i class="fas fa-edit"></i> Editar Información
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Peligro</h5>
            </div>
            <div class="card-body">
                <p>Si desea eliminar su cuenta, todos sus datos serán eliminados permanentemente y esta acción no se puede deshacer.</p>
                
                <form action="{{ route('admin.destroy') }}" method="POST" 
                      onsubmit="return confirm('¿Estás seguro de que deseas eliminar tu cuenta? Esta acción no se puede deshacer.');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="delete-btn">
                        <i class="fas fa-trash-alt"></i> Eliminar Cuenta
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
    <script>
        // Simple toggle for mobile sidebar
        document.querySelector('.toggle-sidebar').addEventListener('click', function() {
            document.querySelector('.sidebar').classList.toggle('show');
        });
        
        // Close sidebar when clicking outside on mobile
        document.addEventListener('click', function(event) {
            const sidebar = document.querySelector('.sidebar');
            const toggleBtn = document.querySelector('.toggle-sidebar');
            
            if (window.innerWidth <= 767 && 
                sidebar.classList.contains('show') && 
                !sidebar.contains(event.target) &&
                event.target !== toggleBtn) {
                sidebar.classList.remove('show');
            }
        });
    </script>
</body>
</html>