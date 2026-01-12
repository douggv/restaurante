<?php
    include '../../config.php';
    $email = $_POST['email'];
    $password = $_POST['password'];    
    $sql = "SELECT * FROM clientes WHERE email_cliente = ?";    
    $query = $pdo->prepare($sql);
    $query->bindParam(1, $email, PDO::PARAM_STR);
    $query->execute();
    $clientes = $query->fetchAll(PDO::FETCH_ASSOC);
    $contador = 0;
    foreach ($clientes as $cliente) {
        $password_tabla = $cliente['password'];
        if (password_verify($password, $password_tabla)) {
            $contador = $contador + 1;
        }
    }
    
    if($contador > 0){
        session_start();
        $_SESSION['sesion'] = $email;
        header('Location: '.$URL.'/client/cliente/views/index.php');

            
    } else {
        session_start();
        $_SESSION['mensaje'] = "Error al iniciar sesion, verifique sus credenciales";
        $_SESSION['color'] = "alert alert-danger";
        header('Location: '.$URL.'/login.php');
    }
?>