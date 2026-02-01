<?php include '../../layouts/verificacion.php'; ?>
<?php include '../../layouts/parte1.php'; ?>
<?php include '../../../../app/controllers/controllers_admin/reservas/read.php'; ?>


<div class="container mt-4">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Gestión de Reservas</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Evento</th>
                            <th>Fecha y Hora</th>
                            <th>Estado</th>
                            <th>Mesa</th>
                            <th>Cliente</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($reservas as $reserva): ?>
                        <tr>
                            <td>
                                <strong><?php echo htmlspecialchars($reserva['titulo_evento']); ?></strong>
                            </td>
                            <td>
                                <div class="small text-muted"><?php echo $reserva['fecha_reserva']; ?></div>
                                <div><?php echo $reserva['hora_inicio'] . " - " . $reserva['hora_fin']; ?></div>
                            </td>
                            <td>
                                <?php 
                                    $claseBadge = 'bg-secondary';
                                    if($reserva['estado_reserva'] == 'Confirmada') $claseBadge = 'bg-success';
                                    if($reserva['estado_reserva'] == 'Pendiente') $claseBadge = 'bg-warning text-dark';
                                ?>
                                <span class="badge rounded-pill <?php echo $claseBadge; ?>">
                                    <?php echo $reserva['estado_reserva']; ?>
                                </span>
                            </td>
                            <td>
                                <span class="d-block">Mesa #<?php echo $reserva['nro_mesa']; ?></span>
                                <small class="text-muted"><?php echo $reserva['sillas']; ?> sillas | <?php echo $reserva['tipo']; ?></small>
                            </td>
                            <td>
                                <div class="fw-bold"><?php echo htmlspecialchars($reserva['nombre_cliente']); ?></div>
                                <div class="small text-muted"><i class="bi bi-telephone"></i> <?php echo $reserva['telefono']; ?></div>
                            </td>
                            <td class="text-center">
                                <form action="negar_reserva.php" method="POST">
                                    <input type="hidden" name="id" value="<?php echo $reserva['id_reserva']; ?>">
                                    <button type="submit" class="btn btn-outline-danger btn-sm shadow-sm" onclick="return confirm('¿Deseas denegar esta reserva?')">
                                        <i class="bi bi-x-circle"></i> Negar
                                    </button>
                                </form>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>




<?php include '../../layouts/parte2.php'; ?>