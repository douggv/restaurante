<?php
include '../../../config.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_menu = $_POST['id_menu'];

    // En lugar de DELETE, usamos UPDATE para cambiar la disponibilidad a 0
    $sql = "UPDATE menu SET disponible = '0' WHERE id_comida = :id_menu";
    
    $query = $pdo->prepare($sql);
    $query->bindParam(':id_menu', $id_menu);

    if ($query->execute()) {
        $_SESSION['mensaje'] = "El plato se ha marcado como 'No disponible' correctamente.";
        $_SESSION['icono'] = "success";
        $_SESSION['color'] = "alert-success";
    } else {
        $_SESSION['mensaje'] = "Error al intentar cambiar el estado del plato.";
        $_SESSION['icono'] = "error";
        $_SESSION['color'] = "alert-danger";
    }

    header('Location: ' . $URL . '/client/admin/views/menu/index.php');
    exit();
}