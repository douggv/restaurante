<?php
include '../../../config.php'; 
session_start();

$id_usuario = $_POST['id_usuario'];
$nombre = $_POST['nombre'];
$email = $_POST['email'];
$telefono = $_POST['telefono'];
$password = $_POST['password'];
$imagen_actual = $_POST['imagen_actual'];

// 1. Lógica de la Imagen
if (isset($_FILES['imagen']['name']) && $_FILES['imagen']['name'] != "") {
    // Si subió una nueva, borramos la vieja (si no es la default)
    if($imagen_actual != "default.png" && file_exists("../../../../public/assets/img/meseros/".$imagen_actual)){
        unlink("../../../../public/assets/img/meseros/".$imagen_actual);
    }
    // Subimos la nueva con solo fecha y código corto
    $nombre_del_archivo = date("Y-m-d") . "-" . substr(md5(rand()), 0, 5) . "-" . $_FILES['imagen']['name'];
    $location = "../../../../public/assets/img/meseros/" . $nombre_del_archivo;
    move_uploaded_file($_FILES['imagen']['tmp_name'], $location);
} else {
    // Si no subió nada, mantenemos la que ya tenía
    $nombre_del_archivo = $imagen_actual;
}

// 2. Lógica de la Contraseña
if (!empty($password)) {
    // Si escribió algo, la encriptamos
    $password_final = password_hash($password, PASSWORD_DEFAULT);
    $sql_pass = ", pasword = :pasword";
} else {
    // Si no, no actualizamos ese campo
    $sql_pass = "";
}

// 3. Ejecutar actualización
try {
    $sql = "UPDATE usuarios 
            SET nombre = :nombre, 
                email = :email, 
                telefono = :telefono, 
                imagen = :imagen 
                $sql_pass 
            WHERE id_usuario = :id_usuario";
            
    $sentencia = $pdo->prepare($sql);
    $sentencia->bindParam(':nombre', $nombre);
    $sentencia->bindParam(':email', $email);
    $sentencia->bindParam(':telefono', $telefono);
    $sentencia->bindParam(':imagen', $nombre_del_archivo);
    $sentencia->bindParam(':id_usuario', $id_usuario);
    
    if (!empty($password)) {
        $sentencia->bindParam(':pasword', $password_final);
    }

    if ($sentencia->execute()) {
        $_SESSION['mensaje'] = "Datos actualizados correctamente.";
        $_SESSION['color'] = "alert alert-success";
        header('Location: ' . $URL . '/client/admin/views/meseras/index.php');
    }
} catch (Exception $e) {
    $_SESSION['mensaje'] = "Error: " . $e->getMessage();
    $_SESSION['color'] = "alert alert-danger";
    header('Location: ' . $URL . '/client/admin/views/meseras/index.php');
}