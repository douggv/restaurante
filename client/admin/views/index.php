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
        body { font-family: 'Inter', sans-serif; background-color: #f8f9fa; }
        
        /* Sidebar Styles */
        #sidebar {
            min-width: 250px;
            max-width: 250px;
            min-height: 100vh;
            background: #212529;
            color: #fff;
            transition: all 0.3s;
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
        .content-wrapper { width: 100%; }
        .card { border: none; box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075); }
    </style>
</head>
<body>

<div class="d-flex">
    <nav id="sidebar">
        <div class="sidebar-header">
            <h4 class="mb-0"><i class="bi bi-egg-fried me-2"></i>MenuAdmin</h4>
        </div>

        <ul class="list-unstyled components">
            <li class="active">
                <a href="#"><i class="bi bi-speedometer2 me-2"></i>Panel</a>
            </li>
            <li>
                <a href="#"><i class="bi bi-calendar me-2"></i>Reservas</a>
            </li>
            <li>
                <a href="#"><i class="bi bi-table me-2"></i>Gestion de Mesas</a>
            </li>
            <li>
                <a href="#"><i class="bi bi-journal-text me-2"></i> Ver Platos</a>
            </li>
            <li>
                <a href="#"><i class="bi bi-plus-circle me-2"></i> Agregar Plato</a>
            </li>
            <li>
                <a href="#"><i class="bi bi-tags me-2"></i> Categorías</a>
            </li>
            <li>
                <a href="#"><i class="bi bi-people me-2"></i> Usuarios</a>
            </li>
            <hr class="bg-light mx-3">
            <li>
                <a href="#"><i class="bi bi-check-circle me-2"></i>Control de Seguimiento</a>
            </li>
        </ul>
    </nav>

    <div class="content-wrapper">
        <nav class="navbar navbar-expand-lg navbar-light px-4">
            <div class="container-fluid">
                <button type="button" class="btn btn-outline-secondary btn-sm me-3">
                    <i class="bi bi-list"></i>
                </button>
                <div class="ms-auto d-flex align-items-center">
                    <div class="dropdown">
                        <a href="#" class="d-flex align-items-center text-decoration-none dropdown-toggle text-dark" data-bs-toggle="dropdown">
                            <img src="https://ui-avatars.com/api/?name=Admin+User&background=0D6EFD&color=fff" alt="mdo" width="32" height="32" class="rounded-circle me-2">
                            <strong>Administrador</strong>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end text-small shadow">
                            <li><a class="dropdown-item" href="#">Perfil</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="#">Cerrar Sesión</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>

        <div class="container-fluid p-4">
            <div class="row mb-4">
                <div class="col">
                    <h2 class="fw-bold">Gestión de Menú</h2>
                    <p class="text-muted">Bienvenido al panel, aquí puedes administrar tus 20 platos nuevos.</p>
                </div>
            </div>

            <div class="row mb-4">
                <div class="col-md-3">
                    <div class="card p-3 bg-primary text-white">
                        <h6>Total Platos</h6>
                        <h3>20</h3>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card p-3 bg-success text-white">
                        <h6>Disponibles</h6>
                        <h3>20</h3>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card p-3 bg-warning text-dark">
                        <h6>Categorías</h6>
                        <h3>8</h3>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card p-3 bg-white">
                        <h6>Precio Promedio</h6>
                        <h3>$11.50</h3>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header bg-white py-3">
                    <h5 class="mb-0 text-primary">Platos Recientes</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>Nombre</th>
                                    <th>Tipo</th>
                                    <th>Categoría</th>
                                    <th>Precio</th>
                                    <th>Estado</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Hamburguesa Clásica</td>
                                    <td>Plato Fuerte</td>
                                    <td>Carnes</td>
                                    <td>$12.50</td>
                                    <td><span class="badge bg-success">Disponible</span></td>
                                    <td>
                                        <button class="btn btn-sm btn-info text-white"><i class="bi bi-pencil"></i></button>
                                        <button class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
                                    </td>
                                </tr>
                                </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>