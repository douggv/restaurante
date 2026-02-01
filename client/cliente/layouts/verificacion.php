<?php
    // 1. Verificación inteligente de sesión
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    // 2. Carga única de configuración
    // Usamos require_once para que si ya se cargó en el index, no lo vuelva a intentar
    require_once __DIR__ . '/../../../app/config.php';

    // 3. Lógica de control de acceso
    if (!isset($_SESSION['sesion'])) {
        $_SESSION['mensaje'] = "Debes iniciar sesión para acceder al área de clientes";
        $_SESSION['icon_mensaje'] = "warning"; // Útil para SweetAlert o iconos
        
        header('Location: ' . $URL . '/login.php');
        exit(); 
    } else {
        
        $usuario_sesion = $_SESSION['sesion'];
        $sql2 = "SELECT * FROM clientes WHERE email_cliente = :usuario_sesion LIMIT 1";
        $query2 = $pdo->prepare($sql2);
        $query2->bindParam(':usuario_sesion', $usuario_sesion);
        $query2->execute();
        $cliente = $query2->fetch(PDO::FETCH_ASSOC);

        $id_cliente_sesion = $cliente['id_cliente'];
        $nombre_cliente_sesion = $cliente['nombre_cliente'];
    }
?>

