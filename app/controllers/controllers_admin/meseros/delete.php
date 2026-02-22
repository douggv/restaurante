<?php
include '../../../config.php'; 
session_start();

$id_usuario = $_POST['id_usuario'];
$nombre_mesero = $_POST['nombre_mesero'];

// 1. Primero buscamos el nombre de la imagen para borrarla del servidor
$sql_img = "SELECT imagen FROM usuarios WHERE id_usuario = :id_usuario";
$query_img = $pdo->prepare($sql_img);
$query_img->bindParam(':id_usuario', $id_usuario);
$query_img->execute();
$res = $query_img->fetch(PDO::FETCH_ASSOC);

$nombre_imagen = $res['imagen'];

// 2. Ejecutar la eliminación en la Base de Datos
try {
    $sentencia = $pdo->prepare("DELETE FROM usuarios WHERE id_usuario = :id_usuario");
    $sentencia->bindParam(':id_usuario', $id_usuario);

    if ($sentencia->execute()) {
        
        // 3. Si se borró de la DB, borramos la imagen física (si no es la default)
        if($nombre_imagen != "default.png"){
            $ruta_archivo = "../../../../public/assets/img/meseros/" . $nombre_imagen;
            if(file_exists($ruta_archivo)){
                unlink($ruta_archivo);
            }
        }

        $_SESSION['mensaje'] = "Se eliminó al mesero(a) $nombre_mesero correctamente.";
        $_SESSION['color'] = "alert alert-success";
        header('Location: ' . $URL . '/client/admin/views/meseras/index.php');
    }
} catch (Exception $e) {
    $_SESSION['mensaje'] = "No se puede eliminar el registro porque tiene datos asociados.";
    $_SESSION['color'] = "alert alert-danger";
    header('Location: ' . $URL . '/client/admin/views/meseras/index.php');
}