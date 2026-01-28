<?php
include '../../../config.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_mesa = $_POST['id_mesa'];

    // En lugar de DELETE, cambiamos el estado
    $sql = "UPDATE mesas SET estado = 'mantenimiento' WHERE id_mesa = :id_mesa";
    $query = $pdo->prepare($sql);
    $query->bindParam(':id_mesa', $id_mesa);

    if ($query->execute()) {
        $_SESSION['mensaje'] = "La mesa se ha puesto en mantenimiento.";
        $_SESSION['color'] = "alert-warning";
    } else {
        $_SESSION['mensaje'] = "Error al cambiar el estado de la mesa.";
        $_SESSION['color'] = "alert-danger";
    }
    header('Location: ' . $URL . '/client/admin/views/mesas/index.php');
    exit();
}