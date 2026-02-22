<?php include '../layouts/verificacion.php'; ?>   
<?php include '../layouts/parte1.php'; ?>    
<?php include '../layouts/nav.php'; ?>

<?php include '../../../app/controllers/controllers_admin/mesas/read.php'; ?>

<?php
// 1. Consulta para obtener LA RESERVA ACTIVA (Confirmada o Pendiente más cercana)
$sql_reserva = "SELECT titulo_evento, fecha_reserva, hora_inicio, hora_fin, estado_reserva 
                FROM reservas 
                WHERE id_cliente_fk = :id_cliente 
                AND estado_reserva IN ('Confirmada', 'Pendiente')
                ORDER BY fecha_reserva DESC LIMIT 1";
$query_reserva = $pdo->prepare($sql_reserva);
$query_reserva->execute(['id_cliente' => $id_cliente_sesion]);
$reserva_activa = $query_reserva->fetch(PDO::FETCH_ASSOC);

// 2. Consulta de NOTIFICACIONES con detalles de reservas negadas
// Nota: Usamos un JOIN para traer los datos de la reserva si la notificación está ligada a una
$sql_notif = "SELECT n.*, r.titulo_evento as evento_ref, r.fecha_reserva as fecha_ref, r.hora_inicio as hora_ref
              FROM notificaciones n
              LEFT JOIN reservas r ON n.texto LIKE CONCAT('%', r.titulo_evento, '%') 
              AND n.id_cliente_fk = r.id_cliente_fk
              WHERE n.id_cliente_fk = :id_cliente 
              ORDER BY n.fecha_creacion DESC";

// Si tu tabla notificaciones tiene un campo 'id_reserva_fk', cámbialo por:
// LEFT JOIN reservas r ON n.id_reserva_fk = r.id_reserva

$query_notif = $pdo->prepare($sql_notif);
$query_notif->execute(['id_cliente' => $id_cliente_sesion]);
$notificaciones = $query_notif->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-9">
            
            <?php if ($reserva_activa): ?>
                <div class="mb-5">
                    <div class="d-flex align-items-center mb-3">
                        <div class="bg-primary p-2 rounded-circle me-3 shadow-sm">
                            <i class="bi bi-calendar2-check text-white fs-4"></i>
                        </div>
                        <h4 class="mb-0 fw-bold">Mi Reserva Próxima</h4>
                    </div>
                    
                    <div class="card border-0 shadow-sm overflow-hidden" style="border-radius: 20px;">
                        <div class="row g-0">
                            <div class="col-md-3 bg-primary text-white d-flex flex-column justify-content-center align-items-center p-4">
                                <span class="h1 fw-bold mb-0"><?php echo date('d', strtotime($reserva_activa['fecha_reserva'])); ?></span>
                                <span class="text-uppercase"><?php echo date('M', strtotime($reserva_activa['fecha_reserva'])); ?></span>
                            </div>
                            <div class="col-md-9 p-4 bg-white">
                                <div class="d-flex justify-content-between">
                                    <h4 class="fw-bold text-dark"><?php echo htmlspecialchars($reserva_activa['titulo_evento']); ?></h4>
                                    <span class="badge <?php echo ($reserva_activa['estado_reserva'] == 'Confirmada') ? 'bg-success' : 'bg-warning text-dark'; ?> rounded-pill">
                                        <?php echo $reserva_activa['estado_reserva']; ?>
                                    </span>
                                </div>
                                <div class="mt-3 d-flex gap-4">
                                    <span><i class="bi bi-clock text-primary me-2"></i><?php echo date('h:i A', strtotime($reserva_activa['hora_inicio'])); ?></span>
                                    <span><i class="bi bi-arrow-right text-muted me-2"></i><?php echo date('h:i A', strtotime($reserva_activa['hora_fin'])); ?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <h4 class="fw-bold mb-4">Centro de Notificaciones</h4>

            <?php if (count($notificaciones) > 0): ?>
                <?php foreach ($notificaciones as $n): 
                    $mensaje_completo = $n['texto'] ?? $n['mensaje'];
                    $es_negada = (strpos(strtolower($mensaje_completo), 'negada') !== false);
                ?>
                    <div class="card mb-3 border-0 shadow-sm rounded-4 <?php echo $es_negada ? 'bg-danger-subtle' : 'bg-white'; ?>">
                        <div class="card-body p-4">
                            <div class="d-flex align-items-start">
                                <div class="me-3">
                                    <?php if($es_negada): ?>
                                        <div class="bg-danger p-3 rounded-circle text-white shadow-sm">
                                            <i class="bi bi-calendar-x fs-4"></i>
                                        </div>
                                    <?php else: ?>
                                        <div class="bg-success p-3 rounded-circle text-white shadow-sm">
                                            <i class="bi bi-calendar-check fs-4"></i>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <div class="flex-grow-1">
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <h5 class="fw-bold mb-0 <?php echo $es_negada ? 'text-danger' : 'text-success'; ?>">
                                            <?php echo $es_negada ? 'Reserva Rechazada' : 'Reserva Actualizada'; ?>
                                        </h5>
                                        <small class="text-muted fw-bold"><?php echo date('d/m/Y H:i', strtotime($n['fecha_creacion'])); ?></small>
                                    </div>
                                    
                                    <p class="mb-3 text-dark"><?php echo htmlspecialchars($mensaje_completo); ?></p>

                                    <?php if($es_negada): ?>
                                        <div class="p-3 bg-white rounded-3 border border-danger-subtle border-start-4">
                                            <div class="row align-items-center">
                                                <div class="col-sm-8">
                                                    <small class="text-muted d-block text-uppercase fw-bold" style="font-size: 0.7rem;">Datos de la reserva original:</small>
                                                    <span class="text-dark fw-bold"><?php echo $n['evento_ref'] ?? 'Reserva'; ?></span>
                                                    <div class="small">
                                                        <i class="bi bi-calendar-event me-1"></i> Fecha: <strong><?php echo $n['fecha_ref'] ? date('d/m/Y', strtotime($n['fecha_ref'])) : 'No disponible'; ?></strong>
                                                        <br>
                                                        <i class="bi bi-clock me-1"></i> Horario: <strong><?php echo $n['hora_ref'] ? date('h:i A', strtotime($n['hora_ref'])) : '--:--'; ?></strong>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4 text-sm-end mt-2 mt-sm-0">
                                                    <span class="text-danger fw-bold small">NO DISPONIBLE</span>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="text-center p-5 bg-white rounded-4 shadow-sm border">
                    <i class="bi bi-mailbox display-1 text-muted opacity-25"></i>
                    <p class="mt-3 text-muted">No tienes mensajes nuevos en este momento.</p>
                </div>
            <?php endif; ?>

        </div>
    </div>
</div>

<style>
    .bg-danger-subtle { background-color: #fff5f5 !important; }
    .border-start-4 { border-left: 4px solid #dc3545 !important; }
    .card { transition: transform 0.2s ease; }
    .card:hover { transform: translateY(-2px); }
    .rounded-4 { border-radius: 1rem !important; }
</style>

<?php include '../layouts/parte2.php'; ?>    
