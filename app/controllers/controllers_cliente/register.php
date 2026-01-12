<?php
    include '../../config.php';
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $nombre = $_POST['nombre'];
        $telefono = $_POST['telefono'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);
        $sql = "INSERT INTO clientes (nombre_cliente, telefono, email_cliente, password) VALUES (?, ?, ?, ?)";
        
        $query = $pdo->prepare($sql);
        $query->bindParam(1, $nombre, PDO::PARAM_STR);
        $query->bindParam(2, $telefono, PDO::PARAM_STR);
        $query->bindParam(3, $email, PDO::PARAM_STR);
        $query->bindParam(4, $hashed_password, PDO::PARAM_STR);

        $result = $query->execute();

        if($result){
            session_start();
            $_SESSION['mensaje'] = "Registro exitoso, ya puedes iniciar sesión";
            $_SESSION['color'] = "alert alert-success";
            header('Location: '.$URL.'/register.php');
        } else {
            session_start();
            $_SESSION['mensaje'] = "Error al registrar, intenta nuevamente";
            $_SESSION['color'] = "alert alert-danger";
            header('Location: '.$URL.'/register.php');
        }
    }
?>
