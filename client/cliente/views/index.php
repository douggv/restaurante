<?php include '../layouts/verificacion.php'; ?>   
<?php include '../layouts/parte1.php'; ?>    
<?php include '../layouts/nav.php'; ?>

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