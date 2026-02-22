<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo APP_NAME; ?> - Panel de Servicio</title>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #f4f7f6; }
        .navbar-mesero { background-color: #1e3a8a; }
        .card-menu { 
            border: none; 
            border-radius: 16px; 
            transition: all 0.3s ease; 
            text-align: center;
            background: white;
        }
        .card-menu:hover { transform: translateY(-8px); box-shadow: 0 12px 24px rgba(0,0,0,0.1); }
        .icon-box {
            width: 60px; height: 60px;
            display: flex; align-items: center; justify-content: center;
            border-radius: 12px; margin: 0 auto 15px;
        }
        .bg-light-blue { background-color: #e0f2fe; color: #0369a1; }
        .bg-light-green { background-color: #dcfce7; color: #15803d; }
        .bg-light-orange { background-color: #ffedd5; color: #9a3412; }
    </style>
</head>
<body>

<nav class="navbar navbar-mesero navbar-dark shadow-sm mb-4">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center" href="#">
            <i class="bi bi-person-badge-fill me-2"></i>
            <span><?php echo APP_NAME; ?> - MESERO</span>
        </a>
        <div class="d-flex align-items-center text-white">
            <span class="me-3 d-none d-md-inline"><?php echo $_SESSION['sesionmesero']; ?></span>
            <a href="<?php echo $URL; ?>/app/controllers/controllers_admin/logout.php" class="btn btn-outline-light btn-sm">Salir</a>
        </div>
    </div>
</nav>