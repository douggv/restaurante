<?php
include '../../../config.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recibir datos
    $id_menu        = $_POST['id_menu'];
    $nombre_comida  = $_POST['nombre_comida'];
    $tipo           = $_POST['tipo'];
    $categoria      = $_POST['categoria'];
    $precio         = $_POST['precio'];
    $descripcion    = $_POST['descripcion'];
    $disponible     = $_POST['disponible'];

    $sql = "UPDATE menu 
            SET nombre_comida = :nombre_comida, 
                tipo = :tipo, 
                categoria = :categoria, 
                precio = :precio, 
                descripcion = :descripcion, 
                disponible = :disponible 
            WHERE id_comida= :id_menu";

    $query = $pdo->prepare($sql);

    $query->bindParam(':nombre_comida', $nombre_comida);
    $query->bindParam(':tipo', $tipo);
    $query->bindParam(':categoria', $categoria);
    $query->bindParam(':precio', $precio);
    $query->bindParam(':descripcion', $descripcion);
    $query->bindParam(':disponible', $disponible);
    $query->bindParam(':id_menu', $id_menu);

    if ($query->execute()) {
        $_SESSION['mensaje'] = "El plato se actualizó correctamente.";
        $_SESSION['icono'] = "success";
        $_SESSION['color'] = "alert-success";
    } else {
        $_SESSION['mensaje'] = "Error al intentar actualizar el plato.";
        $_SESSION['icono'] = "error";
        $_SESSION['color'] = "alert-danger";
    }

    header('Location: ' . $URL . '/client/admin/views/menu/index.php');
    exit();
}