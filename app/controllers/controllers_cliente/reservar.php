<?php
    include '../../config.php';
    

    $id_cliente = $_POST['id_cliente'];
    $id_mesa = $_POST['id_mesa'];
    $fecha = $_POST['fecha_reserva'];
    $bloque = $_POST['bloque_horario']; // Ejemplo: "12:00-14:00"
    $titulo = $_POST['titulo_evento'];

    // Separar las horas
    $horas = explode('-', $bloque);
    $hora_inicio = $horas[0];
    $hora_fin = $horas[1];

    $sql = "INSERT INTO reservas (titulo_evento, fecha_reserva, hora_inicio, hora_fin, id_cliente_fk, id_mesa_fk, estado_reserva) 
            VALUES (?, ?, ?, ?, ?, ?, 'Pendiente')";
    $query = $pdo->prepare($sql);
    $query->execute([$titulo, $fecha, $hora_inicio, $hora_fin, $id_cliente, $id_mesa]);
    if ($query) {
        session_start();
        $_SESSION['mensaje'] = "Reserva realizada con éxito. Espera la confirmación.";
        $_SESSION['color'] = "success";
        header('Location: ../../../client/cliente/views/index.php');
    } else {
        session_start();
        $_SESSION['mensaje'] = "Error al realizar la reserva. Inténtalo de nuevo.";
        $_SESSION['color'] = "error";
        header('Location: ../../../client/cliente/views/index.php');
    }
    ?>