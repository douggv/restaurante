<?php
include '../../../config.php';
session_start();

$id_mesa_fk = $_POST['id_mesa_fk'];
$id_usuario_fk = $_POST['id_usuario_fk'];
$id_cliente_fk = !empty($_POST['id_cliente_fk']) ? $_POST['id_cliente_fk'] : NULL;
$total_pagar = $_POST['total_pagar'];

// Recibimos los arreglos de productos y descripciones
$comidas = $_POST['id_menu_fk']; // Es un array
$descripciones = $_POST['descripcion_pedido']; // Es un array

try {
    $pdo->beginTransaction();

    // Recorremos cada comida enviada
    for ($i = 0; $i < count($comidas); $i++) {
        $id_menu = $comidas[$i];
        $desc = $descripciones[$i];

        $sql = "INSERT INTO pedidos 
                (id_mesa_fk, id_cliente_fk, id_usuario_fk, id_menu_fk, descripcion_pedido, total_pagar) 
                VALUES 
                (:id_mesa_fk, :id_cliente_fk, :id_usuario_fk, :id_menu, :desc, :total)";
        
        $sentencia = $pdo->prepare($sql);
        $sentencia->bindParam(':id_mesa_fk', $id_mesa_fk);
        $sentencia->bindParam(':id_cliente_fk', $id_cliente_fk);
        $sentencia->bindParam(':id_usuario_fk', $id_usuario_fk);
        $sentencia->bindParam(':id_menu', $id_menu);
        $sentencia->bindParam(':desc', $desc);
        $sentencia->bindParam(':total', $total_pagar);
        $sentencia->execute();
    }

    // Actualizar mesa a OCUPADA
    $sql_mesa = "UPDATE mesas SET estado = 'OCUPADA' WHERE id_mesa = :id_mesa";
    $query_mesa = $pdo->prepare($sql_mesa);
    $query_mesa->bindParam(':id_mesa', $id_mesa_fk);
    $query_mesa->execute();

    $pdo->commit();
    $_SESSION['mensaje'] = "Comanda registrada con éxito";
    $_SESSION['color'] = "alert alert-success";
    header('Location: ' . $URL . '/client/mesero/views/mesas/index.php');

} catch (Exception $e) {
    $pdo->rollBack();
    echo "Error: " . $e->getMessage();
}