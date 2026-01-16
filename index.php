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
                    <a href="reservas.php" class="btn btn-reserva btn-lg">RESERVAR MESA</a>
                </div>
            </div>
        </div>
    </header>

    <section id="nosotros" class="section-padding container">
        <div class="row align-items-center">
            <div class="col-md-6 mb-4 mb-md-0">
                <img src="https://images.unsplash.com/photo-1552566626-52f8b828add9?q=80&w=1470&auto=format&fit=crop" class="img-fluid rounded shadow" alt="Nuestro Restaurante">
            </div>
            <div class="col-md-6 ps-md-5">
                <h2 class="section-title">Sobre Nosotros</h2>
                <p class="text-muted">Desde 1995, nos hemos dedicado a perfeccionar el arte de la cocina fusión. Nuestro compromiso es utilizar ingredientes frescos de productores locales para llevar a su mesa lo mejor de nuestra tierra.</p>
                <p>Ambiente acogedor, servicio de primera y una carta de vinos seleccionada para cada ocasión.</p>
                <a href="#" class="text-decoration-none fw-bold" style="color: var(--dorado);">Nuestra Historia <i class="bi bi-arrow-right"></i></a>
            </div>
        </div>
    </section>

    <section id="menu" class="section-padding bg-light">
        <div class="container text-center">
            <h2 class="section-title text-start">Nuestro Menú</h2>
            <div class="row mt-5">
                <div class="col-md-4 mb-4">
                    <div class="card card-menu h-100 shadow-sm">
                        <img src="https://images.unsplash.com/photo-1565299624946-b28f40a0ae38?q=80&w=1381&auto=format&fit=crop" class="card-img-top" alt="Pizza">
                        <div class="card-body">
                            <h5 class="card-title fw-bold">Pizza Artesanal</h5>
                            <p class="card-text text-muted small">Masa madre, tomates cherry y albahaca fresca.</p>
                            <p class="price">$15.00</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card card-menu h-100 shadow-sm">
                        <img src="https://images.unsplash.com/photo-1567620905732-2d1ec7bb7445?q=80&w=1380&auto=format&fit=crop" class="card-img-top" alt="Pasta">
                        <div class="card-body">
                            <h5 class="card-title fw-bold">Pasta Carbonara</h5>
                            <p class="card-text text-muted small">Receta original italiana con pecorino y guanciale.</p>
                            <p class="price">$18.50</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card card-menu h-100 shadow-sm">
                        <img src="https://images.unsplash.com/photo-1544025162-d76694265947?q=80&w=1469&auto=format&fit=crop" class="card-img-top" alt="Carnes">
                        <div class="card-body">
                            <h5 class="card-title fw-bold">Corte Prime</h5>
                            <p class="card-text text-muted small">Angus certificado madurado por 30 días.</p>
                            <p class="price">$32.00</p>
                        </div>
                    </div>
                </div>
            </div>
            <a href="menu_completo.php" class="btn btn-outline-dark mt-4">VER MENÚ COMPLETO</a>
        </div>
    </section>

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