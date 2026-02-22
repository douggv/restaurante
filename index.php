<?php
    include 'app/config.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php  echo APP_NAME; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    
    <style>
        :root {
            --dorado: #c5a059;
            --oscuro: #1a1a1a;
        }

        body { font-family: 'Poppins', sans-serif; }
        h1, h2, .navbar-brand { font-family: 'Playfair Display', serif; }

        /* Navbar */
        .navbar {
            background-color: rgba(26, 26, 26, 0.95);
            padding: 15px 0;
            transition: all 0.3s;
        }
        .navbar-brand { color: var(--dorado) !important; font-size: 1.8rem; }
        .nav-link { color: #fff !important; margin: 0 10px; text-transform: uppercase; font-size: 0.9rem; }
        .nav-link:hover { color: var(--dorado) !important; }

        /* Hero Section */
        .hero {
            height: 90vh;
            background: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)), 
                        url('https://images.unsplash.com/photo-1514362545857-3bc16c4c7d1b?q=80&w=1470&auto=format&fit=crop');
            background-size: cover;
            background-position: center;
            display: flex;
            align-items: center;
            color: white;
            text-align: center;
        }
        .hero h1 { font-size: 4.5rem; margin-bottom: 20px; }
        .btn-reserva {
            background-color: var(--dorado);
            color: white;
            padding: 12px 30px;
            border: none;
            border-radius: 0;
            font-weight: 600;
        }

        /* Secciones */
        .section-padding { padding: 80px 0; }
        .section-title { position: relative; padding-bottom: 15px; margin-bottom: 40px; }
        .section-title::after {
            content: '';
            position: absolute;
            width: 60px;
            height: 3px;
            background: var(--dorado);
            bottom: 0;
            left: 0;
        }

        /* Menu Preview */
        .card-menu {
            border: none;
            transition: transform 0.3s;
        }
        .card-menu:hover { transform: translateY(-10px); }
        .price { color: var(--dorado); font-weight: bold; font-size: 1.2rem; }
    </style>
</head>
<body>

    <?php include 'layout/nav.php'; ?>

    <header class="hero">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <h1 class="display-2">Sabores que Cuentan Historias</h1>
                    <p class="lead mb-4">Reserva tu mesa hoy y disfruta de una experiencia gastronómica inigualable.</p>
                    <a href="login.php" class="btn btn-reserva btn-lg">RESERVAR MESA</a>
                </div>
            </div>
        </div>
    </header>

    

    <footer class="bg-dark text-white pt-5 pb-3">
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-4">
                    <h4 class="nav-link p-0 mb-3" style="color: var(--dorado) !important;"><?php  echo APP_NAME; ?></h4>
                    <p class="small text-muted">Donde cada bocado es un recuerdo.</p>
                </div>
                <div class="col-md-4 mb-4">
                    <h5>Contacto</h5>
                    <ul class="list-unstyled small text-muted">
                        <li><i class="bi bi-geo-alt me-2"></i> Calle Gastronomía 123, Ciudad</li>
                        <li><i class="bi bi-telephone me-2"></i> +1 234 567 890</li>
                        <li><i class="bi bi-envelope me-2"></i> contacto@sabor-reserva.com</li>
                    </ul>
                </div>
                <div class="col-md-4 mb-4">
                    <h5>Síguenos</h5>
                    <div class="fs-4">
                        <i class="bi bi-facebook me-3"></i>
                        <i class="bi bi-instagram me-3"></i>
                        <i class="bi bi-whatsapp"></i>
                    </div>
                </div>
            </div>
            <hr class="bg-secondary">
            <p class="text-center small text-muted">&copy; 2026 . Todos los derechos reservados.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>