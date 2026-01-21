    <?php
    include '../../config.php';
    // cerrar la sesión
    session_start();
    session_destroy();
    
    header('Location: '.$URL.'/loginadmin.php');
?>