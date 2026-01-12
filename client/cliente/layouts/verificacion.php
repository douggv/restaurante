<?php
    // SIEMPRE debe ser lo primero
    session_start(); 
    
    include '../../../app/config.php';

    if(!isset($_SESSION['sesion'])){
        // No es necesario el echo aquí porque el header lo redirigirá
        $_SESSION['mensaje'] = "Debes iniciar sesión para acceder al área de clientes";
        $_SESSION['color'] = "alert alert-warning";
        header('Location: '.$URL.'/login.php');
        exit(); // SIEMPRE usa exit() después de un header de redirección
    }
?>

