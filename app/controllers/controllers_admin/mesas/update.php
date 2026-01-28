<?php
include '../../../config.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_mesa  = $_POST['id_mesa'];
    $nro_mesa = $_POST['nro_mesa'];
    $sillas   = $_POST['sillas'];
    $tipo     = $_POST['tipo'];
    $estado   = $_POST['estado'];

    $sql = "UPDATE mesas 
            SET nro_mesa = :nro_mesa, 
                sillas = :sillas, 
                tipo = :tipo, 
                estado = :estado 
            WHERE id_mesa = :id_mesa";

    $query = $pdo->prepare($sql);
    $query->bindParam(':nro_mesa', $nro_mesa);
    $query->bindParam(':sillas', $sillas);
    $query->bindParam(':tipo', $tipo);
    $query->bindParam(':estado', $estado);
    $query->bindParam(':id_mesa', $id_mesa);

    if ($query->execute()) {
        $_SESSION['mensaje'] = "Mesa actualizada exitosamente.";
        $_SESSION['color'] = "alert-success";
    } else {
        $_SESSION['mensaje'] = "Error al actualizar la mesa.";
        $_SESSION['color'] = "alert-danger";
    }
    header('Location: ' . $URL . '/client/admin/views/mesas/index.php');
    exit();
}