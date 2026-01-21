<?php
    include '../../config.php';
    $email = $_POST['email'];
    $password = $_POST['password'];  
    $id_rol_fk = $_POST['id_rol_fk'];  
    $sql = "SELECT * FROM usuarios WHERE email = ? AND id_rol_fk = ?";    
    $query = $pdo->prepare($sql);
    $query->bindParam(1, $email, PDO::PARAM_STR);
    $query->bindParam(2, $id_rol_fk, PDO::PARAM_STR);   
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
        header('Location: '.$URL.'/client/admin/views/index.php');

            
    } else {
        session_start();
        $_SESSION['mensaje'] = "Error al iniciar sesion, verifique sus credenciales";
        $_SESSION['color'] = "alert alert-danger";
        header('Location: '.$URL.'/loginadmin.php');
    }
?>