<?php 
include '../../../config.php'; 

// Iniciamos sesión al principio para evitar errores de cabecera
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') { 
    // Captura de datos del formulario
    $nombre_comida = $_POST['nombre_comida'];
    $tipo          = $_POST['tipo'];
    $categoria     = $_POST['categoria'];
    $precio        = $_POST['precio'];
    $descripcion   = $_POST['descripcion'];
    $disponible    = $_POST['disponible'];

    // Preparación de la consulta SQL
    $sql = "INSERT INTO menu (nombre_comida, tipo, categoria, precio, descripcion, disponible) 
            VALUES (:nombre_comida, :tipo, :categoria, :precio, :descripcion, :disponible)";
    
    $query = $pdo->prepare($sql);

    // Vinculación de parámetros
    $query->bindParam(':nombre_comida', $nombre_comida);
    $query->bindParam(':tipo', $tipo);
    $query->bindParam(':categoria', $categoria);
    $query->bindParam(':precio', $precio);
    $query->bindParam(':descripcion', $descripcion);
    $query->bindParam(':disponible', $disponible);

    try {
        if ($query->execute()) {
            $_SESSION['mensaje'] = "El plato se registró correctamente en el menú.";
            $_SESSION['icono'] = "success"; // Por si usas SweetAlert
            $_SESSION['color'] = "alert-success";
        } else {
            $_SESSION['mensaje'] = "No se pudo registrar el plato. Verifique los datos.";
            $_SESSION['icono'] = "error";
            $_SESSION['color'] = "alert-danger";
        }
    } catch (Exception $e) {
        $_SESSION['mensaje'] = "Error en el sistema: " . $e->getMessage();
        $_SESSION['color'] = "alert-danger";
    }

    // Redirección a la vista principal del menú
    header('Location: ' . $URL . '/client/admin/views/menu/index.php');
    exit();
}
?>