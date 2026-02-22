<?php
include '../../../config.php'; 

session_start();

// Recibimos los datos del formulario
$nombre = $_POST['nombre'];
$email = $_POST['email'];
$telefono = $_POST['telefono'];
$password_form = $_POST['password']; 
$id_rol_fk = $_POST['id_rol_fk'];

// 1. Verificar si el correo ya existe
$sql_email = "SELECT * FROM usuarios WHERE email = :email";
$query_email = $pdo->prepare($sql_email);
$query_email->bindParam(':email', $email);
$query_email->execute();
if ($query_email->fetch(PDO::FETCH_ASSOC)) {
    $_SESSION['mensaje'] = "El correo electrónico ya se encuentra registrado.";
    $_SESSION['icono'] = "error";
    header('Location: ' . $URL . '/admin/usuarios/meseros/create.php');
    exit();
}

// 2. Gestión de la Imagen
if (isset($_FILES['imagen']['name']) && $_FILES['imagen']['name'] != "") {
    // Genera solo la fecha Y-m-d (Ejemplo: 2026-02-21)
    $fecha = date("Y-m-d");
    
    // Opcional: Agregar un ID único corto para evitar que se borren fotos con el mismo nombre el mismo día
    $codigo_unico = substr(md5(uniqid(rand())), 0, 5); 

    // Nombre final: 2026-02-21-abc12-nombre_original.jpg
    $nombre_del_archivo = $fecha . "-" . $codigo_unico . "-" . $_FILES['imagen']['name'];
    
    $location = "../../../../public/assets/img/meseros/" . $nombre_del_archivo;
    move_uploaded_file($_FILES['imagen']['tmp_name'], $location);
} else {
    $nombre_del_archivo = "default.png";
}

// 3. Encriptar Contraseña
$password_encriptada = password_hash($password_form, PASSWORD_DEFAULT);

// 4. INSERCIÓN - Sin fyh_creacion (la DB lo pone automático)
try {
    $sentencia = $pdo->prepare("INSERT INTO usuarios 
        (nombre, email, telefono, password, imagen, id_rol_fk) 
    VALUES 
        (:nombre, :email, :telefono, :password, :imagen, :id_rol_fk)");

    $sentencia->bindParam(':nombre', $nombre);
    $sentencia->bindParam(':email', $email);
    $sentencia->bindParam(':telefono', $telefono);
    $sentencia->bindParam(':password', $password_encriptada);
    $sentencia->bindParam(':imagen', $nombre_del_archivo);
    $sentencia->bindParam(':id_rol_fk', $id_rol_fk);

    if ($sentencia->execute()) {
        $_SESSION['mensaje'] = "Mesero registrado exitosamente.";
        $_SESSION['color'] = "alert alert-success";
        header('Location: ' . $URL . '/client/admin/views/meseras/index.php');
    }
} catch (Exception $e) {
    $_SESSION['mensaje'] = "Error: " . $e->getMessage();
    $_SESSION['color'] = "alert alert-danger";
    header('Location: ' . $URL . '/client/admin/views/meseras/create.php');
}