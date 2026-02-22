<?php
    // 1. Verificación inteligente de sesión
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    // 2. Carga única de configuración
    // Usamos require_once para que si ya se cargó en el index, no lo vuelva a intentar
    require_once __DIR__ . '/../../../app/config.php';

    // 3. Lógica de control de acceso
    if (!isset($_SESSION['sesionmesero'])) {
        $_SESSION['mensaje'] = "Debes iniciar sesión para acceder al área de clientes";
        $_SESSION['color'] = "alert alert-warning"; // Útil para SweetAlert o iconos
        
        header('Location: ' . $URL . '/login.php');
        exit(); 
    } else {
        $usuario_sesion = $_SESSION['sesionmesero'];
        // Opcional: podrías cargar más datos del usuario desde la base de datos aquí
        $sql_usuario = "SELECT * FROM usuarios WHERE email = :email LIMIT 1";
        $query_usuario = $pdo->prepare($sql_usuario);
        $query_usuario->bindParam(':email', $usuario_sesion);
        $query_usuario->execute();
        $datos_usuario = $query_usuario->fetch(PDO::FETCH_ASSOC);
    }
?>