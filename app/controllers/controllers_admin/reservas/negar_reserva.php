<?php
include '../../../config.php'; 
$id_reserva = $_POST['id_reserva'];
$id_cliente = $_POST['id_cliente'];
$motivo = $_POST['motivo'];
$estado = "Negada";
$fecha_notificacion = date('Y-m-d H:i:s');

try {
    $pdo->beginTransaction();

    // 1. Actualizar el estado de la reserva
    $sentencia = $pdo->prepare("UPDATE reservas SET estado_reserva = :estado WHERE id_reserva = :id_reserva");
    $sentencia->bindParam(':estado', $estado);
    $sentencia->bindParam(':id_reserva', $id_reserva);
    $sentencia->execute();

    // 2. Insertar notificación para el cliente
    // Ajusta los nombres de las columnas según tu tabla 'notificacion'
    $texto_notificacion = "Tu reserva ha sido negada. Motivo: " . $motivo;
    
    $notif = $pdo->prepare("INSERT INTO notificaciones (id_cliente_fk, texto, fecha_creacion) 
                            VALUES (:id_cliente, :mensaje, :fecha)");
    $notif->bindParam(':id_cliente', $id_cliente);
    $notif->bindParam(':mensaje', $texto_notificacion);
    $notif->bindParam(':fecha', $fecha_notificacion);
    $notif->execute();

    $pdo->commit();
    
    session_start();
    $_SESSION['mensaje'] = "La reserva se ha negado correctamente y se notificó al cliente.";
    $_SESSION['color'] = "alert alert-success";
    header('Location: ' . $_SERVER['HTTP_REFERER']);

} catch (Exception $e) {
    $pdo->rollBack();
    session_start();
    $_SESSION['mensaje'] = "Error al procesar la solicitud: " . $e->getMessage();
    $_SESSION['color'] = "alert alert-danger";
    header('Location: ' . $_SERVER['HTTP_REFERER']);
}
?>