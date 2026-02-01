<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Menu | Panel de Control</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #f8f9fa; overflow-x: hidden; }
        
        /* Sidebar Styles */
        #sidebar {
            min-width: 250px;
            max-width: 250px;
            min-height: 100vh;
            background: #212529;
            color: #fff;
            transition: all 0.3s;
            z-index: 1000;
        }

        /* Responsive Sidebar */
        @media (max-width: 768px) {
            #sidebar {
                margin-left: -250px;
                position: fixed;
            }
            #sidebar.active {
                margin-left: 0;
            }
            .content-wrapper {
                min-width: 100vw;
            }
        }

        #sidebar .sidebar-header { padding: 20px; background: #1a1d20; }
        #sidebar ul.components { padding: 20px 0; }
        #sidebar ul li a {
            padding: 10px 20px;
            display: block;
            color: #adb5bd;
            text-decoration: none;
        }
        #sidebar ul li a:hover { color: #fff; background: #343a40; border-left: 4px solid #0d6efd; }
        #sidebar ul li.active > a { color: #fff; background: #343a40; border-left: 4px solid #0d6efd; }

        /* Navbar & Content */
        .navbar { background: #fff; border-bottom: 1px solid #dee2e6; }
        .content-wrapper { width: 100%; transition: all 0.3s; }
        .card { border: none; box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075); }
        
        /* Overlay para móvil cuando el menú está abierto */
        .overlay {
            display: none;
            position: fixed;
            width: 100vw;
            height: 100vh;
            background: rgba(0, 0, 0, 0.5);
            z-index: 999;
        }
        .overlay.active { display: block; }
    </style>
</head>
<body>

<div class="overlay" id="overlay"></div>

<div class="d-flex">
    <nav id="sidebar">
        <div class="sidebar-header d-flex justify-content-between align-items-center">
            <h4 class="mb-0"><i class="bi bi-egg-fried me-2"></i>MenuAdmin</h4>
            <button class="btn btn-link text-white d-md-none" id="closeSidebar">
                <i class="bi bi-x-lg"></i>
            </button>
        </div>

        <ul class="list-unstyled components">
            <li class="active"><a href="#"><i class="bi bi-speedometer2 me-2"></i>Panel</a></li>
            <li><a href="<?php echo $URL; ?>/client/admin/views/reservas/index.php"><i class="bi bi-calendar me-2"></i>Reservas</a></li>
            <li><a href="<?php echo $URL; ?>/client/admin/views/mesas/index.php"><i class="bi bi-table me-2"></i>Gestión de Mesas</a></li>
            <li><a href="<?php echo $URL; ?>/client/admin/views/menu/index.php"><i class="bi bi-journal-text me-2"></i> Ver Platos</a></li>
            <li><a href="<?php echo $URL; ?>/client/admin/views/menu/create.php"><i class="bi bi-plus-circle me-2"></i> Agregar Plato</a></li>
            <li><a href="#"><i class="bi bi-tags me-2"></i> Categorías</a></li>
            <li><a href="#"><i class="bi bi-people me-2"></i> Usuarios</a></li>
            <hr class="bg-light mx-3">
            <li><a href="#"><i class="bi bi-check-circle me-2"></i>Control</a></li>
        </ul>
    </nav>

    <div class="content-wrapper">
        <nav class="navbar navbar-expand-lg navbar-light px-3">
            <div class="container-fluid">
                <button type="button" id="sidebarCollapse" class="btn btn-outline-secondary btn-sm me-3">
                    <i class="bi bi-list"></i>
                </button>
                
                <div class="ms-auto d-flex align-items-center">
                    <div class="dropdown">
                        <a href="#" class="d-flex align-items-center text-decoration-none dropdown-toggle text-dark" data-bs-toggle="dropdown">
                            <img src="https://ui-avatars.com/api/?name=Admin+User&background=0D6EFD&color=fff" alt="mdo" width="32" height="32" class="rounded-circle me-2">
                            <strong class="d-none d-sm-inline"><?php echo $usuario_sesion ?></strong>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end shadow">
                            <li><a class="dropdown-item" href="#">Perfil</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="<?php echo $URL ?>/app/controllers/controllers_admin/logout.php">Cerrar Sesión</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>