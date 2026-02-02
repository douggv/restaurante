<?php
include '../../app/config.php'; // Tu conexión PDO

$fecha = $_GET['fecha'] ?? '';
$id_mesa = $_GET['id_mesa'] ?? '';

// Importante: No traer las reservas 'Negada'
$sql = "SELECT hora_inicio, hora_fin FROM reservas 
        WHERE fecha_reserva = :fecha 
        AND id_mesa_fk = :id_mesa 
        AND estado_reserva != 'Negada'";

$query = $pdo->prepare($sql);
$query->execute(['fecha' => $fecha, 'id_mesa' => $id_mesa]);
$reservas = $query->fetchAll(PDO::FETCH_ASSOC);

$ocupados = [];
foreach ($reservas as $r) {
    // Trim para quitar espacios fantasma y asegurar formato HH:mm:ss
    $inicio = trim($r['hora_inicio']);
    $fin = trim($r['hora_fin']);
    $ocupados[] = $inicio . "-" . $fin;
}

header('Content-Type: application/json');
echo json_encode($ocupados);
?>