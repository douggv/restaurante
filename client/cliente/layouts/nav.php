<nav class="navbar navbar-expand-lg sticky-top" style="background-color: rgba(26, 26, 26, 0.95); border-bottom: 2px solid #c5a059;">
    <div class="container">
        <a class="navbar-brand" href="index.php" style="font-family: 'Playfair Display', serif; color: #c5a059 !important; font-size: 1.5rem;">
            <i class="bi bi-egg-fried me-2"></i> <?php echo APP_NAME; ?>
        </a>
        
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" style="border-color: #c5a059;">
            <span class="navbar-toggler-icon" style="filter: invert(1);"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto align-items-center">
                <li class="nav-item">
                    <a class="nav-link text-white text-uppercase small px-3" href="index.php">Inicio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white text-uppercase small px-3" href="../views/menu.php">Menú</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white text-uppercase small px-3" href="../views/mesas.php">Reservar Mesa</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white text-uppercase small px-3" href="../views/notificaciones.php">Notificaciones</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white text-uppercase small px-3" href="../views/historial.php">Historial</a>
                </li>

                <?php if (isset($usuario_sesion)): ?>
                    <li class="nav-item ms-lg-3">
                        <span class="text-white small text-uppercase" style="border-left: 1px solid #c5a059; padding-left: 15px;">
                            <i class="bi bi-person-circle me-1" style="color: #c5a059;"></i> 
                            <?php echo $usuario_sesion; ?>
                        </span>
                    </li>
                    <li class="nav-item ms-lg-3">
                        <a class="btn btn-outline-danger btn-sm px-3" href="<?php echo $URL; ?>/app/controllers/controllers_cliente/logout.php" style="border-radius: 0; font-size: 0.8rem; border-color: #dc3545; color: #dc3545;">
                            CERRAR SESIÓN
                        </a>
                    </li>
                <?php else: ?>
                    <li class="nav-item ms-lg-3">
                        <a class="btn btn-outline-light btn-sm px-3" href="login.php" style="border-radius: 0; font-size: 0.8rem;">INICIAR SESIÓN</a>
                    </li>
                    <li class="nav-item ms-lg-2">
                        <a class="btn btn-sm px-3" href="register.php" style="background-color: #c5a059; color: white; border-radius: 0; font-size: 0.8rem; font-weight: 600;">REGISTRARSE</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>