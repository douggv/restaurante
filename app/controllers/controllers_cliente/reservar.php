<?php
// 1. Iniciar sesión y conexión
session_start();
include '../../config.php'; // ASEGÚRATE DE QUE ESTA RUTA SEA CORRECTA A TU PDO

// 2. Recibir datos del formulario
$id_cliente = $_POST['id_cliente'];
$id_mesa = $_POST['id_mesa'];
$fecha_reserva = $_POST['fecha_reserva'];
$bloque_horario = $_POST['bloque_horario']; // Recibe "12:00:00-14:00:00"
$titulo_evento = $_POST['titulo_evento'] ?: "Reserva de Mesa";

// 3. Separar el bloque de horas
$horas = explode('-', $bloque_horario);
$hora_inicio = $horas[0];
$hora_fin = $horas[1];

try {
    // --- PASO CLAVE: VALIDACIÓN DE DISPONIBILIDAD ---
    // Verificamos si ya existe una reserva para esa mesa, fecha y hora que NO esté negada
    $check = $pdo->prepare("SELECT id_reserva FROM reservas 
                            WHERE fecha_reserva = :fecha 
                            AND id_mesa_fk = :mesa 
                            AND hora_inicio = :inicio 
                            AND estado_reserva != 'Negada'");
    
    $check->execute([
        'fecha' => $fecha_reserva,
        'mesa' => $id_mesa,
        'inicio' => $hora_inicio
    ]);

    if ($check->rowCount() > 0) {
        // Si el conteo es mayor a 0, significa que alguien ya ganó el horario
        $_SESSION['mensaje'] = "¡Error! Este horario ya ha sido reservado por otra persona.";
        $_SESSION['color'] = "danger";
        header('Location: ../../../client/cliente/views/index.php');
        exit();
    }

    // --- PASO 4: INSERTAR SI TODO ESTÁ BIEN ---
    $sql = "INSERT INTO reservas (titulo_evento, fecha_reserva, hora_inicio, hora_fin, estado_reserva, id_cliente_fk, id_mesa_fk) 
            VALUES (:titulo, :fecha, :inicio, :fin, 'Pendiente', :cliente, :mesa)";
    
    $query = $pdo->prepare($sql);
    $resultado = $query->execute([
        'titulo'  => $titulo_evento,
        'fecha'   => $fecha_reserva,
        'inicio'  => $hora_inicio,
        'fin'     => $hora_fin,
        'cliente' => $id_cliente,
        'mesa'    => $id_mesa
    ]);

    if ($resultado) {
        $_SESSION['mensaje'] = "Reserva realizada con éxito. Espera la confirmación.";
        $_SESSION['color'] = "success";
    } else {
        $_SESSION['mensaje'] = "No se pudo realizar la reserva. Intenta de nuevo.";
        $_SESSION['color'] = "danger";
    }

} catch (Exception $e) {
    $_SESSION['mensaje'] = "Error en el sistema: " . $e->getMessage();
    $_SESSION['color'] = "danger";
}


header('Location: ../../../client/cliente/views/index.php');
exit();
?>
   