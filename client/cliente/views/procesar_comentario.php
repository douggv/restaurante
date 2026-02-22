<?php
include ('../../../app/config.php');

// Recibir datos del formulario
$id_cliente = $_POST['id_cliente'];
$id_usuario_fk = $_POST['id_usuario_fk']; // ID del mesero
$puntuacion = $_POST['puntuacion'];
$resena = $_POST['resena'];
$fechaHora = date('Y-m-d H:i:s');

try {
    // Preparar la consulta de inserción
    $sentencia = $pdo->prepare("INSERT INTO comentarios 
           (id_cliente_fk, id_usuario_fk, puntuacion, resena, fecha_comentario) 
    VALUES (:id_cliente_fk, :id_usuario_fk, :puntuacion, :resena, :fyh_creacion)");

    $sentencia->bindParam(':id_cliente_fk', $id_cliente);
    $sentencia->bindParam(':id_usuario_fk', $id_usuario_fk);
    $sentencia->bindParam(':puntuacion', $puntuacion);
    $sentencia->bindParam(':resena', $resena);
    $sentencia->bindParam(':fyh_creacion', $fechaHora);

    if ($sentencia->execute()) {
        session_start();
        $_SESSION['mensaje'] = "Se registró tu reseña correctamente. ¡Gracias por tu opinión!";
        $_SESSION['color'] = "alert alert-success";
        // Redirigir de vuelta al historial
        header('Location: ' . $URL . '/client/cliente/views/historial.php');
    } else {
        throw new Exception("Error al ejecutar la sentencia");
    }

} catch (Exception $e) {
    session_start();
    $_SESSION['mensaje'] = "Error al guardar el comentario: " . $e->getMessage();
    $_SESSION['color'] = "alert alert-danger";

    header('Location: ' . $URL . '/client/cliente/views/historial.php');
}
