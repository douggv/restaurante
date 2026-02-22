<?php
include '../../../../client/mesero/layouts/verificacion.php';

session_start();

// Recibimos los identificadores
$fecha = $_GET['fecha']; // Ejemplo: 2026-02-21 12:22:47
$id_mesa = $_GET['id_mesa'];
$id_user_pedido = (int)$_GET['id_user'];
$id_usuario_sesion = (int)$datos_usuario['id_usuario'];

if ($id_user_pedido === $id_usuario_sesion) {
    
    // 1. Actualizamos el estado de los platos
    $sql = "UPDATE pedidos 
            SET estado_pedido = 'entregado' 
            WHERE id_mesa_fk = :id_mesa 
              AND id_usuario_fk = :id_user 
              AND fyh_creacion = :fecha 
              AND estado_pedido = 'pendiente'";
    
    $sentencia = $pdo->prepare($sql);
    $sentencia->execute([
        ':id_mesa' => $id_mesa,
        ':id_user' => $id_user_pedido,
        ':fecha'   => $fecha
    ]);

    // 2. Si hubo cambios, registramos en la tabla CONTROL
    if ($sentencia->rowCount() > 0) {
        
        // Consultamos los nombres de los platos y el total
        $sql_detalle = "SELECT GROUP_CONCAT(m.nombre_comida SEPARATOR ', ') as lista_platos, 
                               SUM(m.precio) as total_cuenta
                        FROM pedidos p
                        INNER JOIN menu m ON p.id_menu_fk = m.id_comida
                        WHERE p.id_mesa_fk = :id_mesa 
                          AND p.fyh_creacion = :fecha";
        
        $query_detalle = $pdo->prepare($sql_detalle);
        $query_detalle->execute([':id_mesa' => $id_mesa, ':fecha' => $fecha]);
        $resultado = $query_detalle->fetch(PDO::FETCH_ASSOC);

        // Creamos el identificador exacto que pediste: ID_MESA-FECHA_HORA
        $id_pedido_custom = $id_mesa . "-" . $fecha;

        // Insertamos en CONTROL
        $sql_control = "INSERT INTO control (id_pedido_fk, id_usuario_fk, platos, total_pagar, fyh_creacion) 
                        VALUES (:id_pedido_fk, :id_usuario, :platos, :total, :fecha_reg)";
        
        $sentencia_control = $pdo->prepare($sql_control);
        $sentencia_control->execute([
            ':id_pedido_fk' => $id_pedido_custom, // Guardará: 1-2026-02-21 12:22:47
            ':id_usuario'   => $id_usuario_sesion,
            ':platos'       => $resultado['lista_platos'],
            ':total'        => $resultado['total_cuenta'],
            ':fecha_reg'    => $fecha // Usamos la misma fecha del pedido original
        ]);

        $_SESSION['mensaje'] = "¡Comida entregada y control registrado!";
        $_SESSION['color'] = "alert alert-success";
    }

} else {
    $_SESSION['mensaje'] = "No tienes permiso para modificar pedidos de otros meseros.";
    $_SESSION['color'] = "alert alert-danger";
}

header('Location: ' . $_SERVER['HTTP_REFERER']);