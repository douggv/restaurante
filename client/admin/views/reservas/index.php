<?php include '../../layouts/verificacion.php'; ?>
<?php include '../../layouts/parte1.php'; ?>
<?php include '../../../../app/controllers/controllers_admin/reservas/read.php'; ?>
<?php include '../../../../alert.php'; ?>

<div class="container mt-4">
    <div class="card shadow">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h4 class="mb-0">Gestión de Reservas</h4>
            <a href="reporte.php" target="_blank" class="btn btn-light btn-sm shadow-sm">
                <i class="bi bi-file-earmark-pdf-fill text-danger"></i> Generar Reporte PDF
            </a>
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
                            <td><strong><?php echo htmlspecialchars($reserva['titulo_evento']); ?></strong></td>
                            <td>
                                <div class="small text-muted"><?php echo $reserva['fecha_reserva']; ?></div>
                                <div><?php echo $reserva['hora_inicio'] . " - " . $reserva['hora_fin']; ?></div>
                            </td>
                            <td>
                                <?php 
                                    $claseBadge = 'bg-secondary';
                                    if($reserva['estado_reserva'] == 'Confirmada') $claseBadge = 'bg-success';
                                    if($reserva['estado_reserva'] == 'Pendiente') $claseBadge = 'bg-warning text-dark';
                                    if($reserva['estado_reserva'] == 'Negada') $claseBadge = 'bg-danger';
                                ?>
                                <span class="badge rounded-pill <?php echo $claseBadge; ?>">
                                    <?php echo $reserva['estado_reserva']; ?>
                                </span>
                            </td>
                            <td>
                                <span class="d-block">Mesa #<?php echo $reserva['nro_mesa']; ?></span>
                                <small class="text-muted"><?php echo $reserva['sillas']; ?> sillas</small>
                            </td>
                            <td>
                                <div class="fw-bold"><?php echo htmlspecialchars($reserva['nombre_cliente']); ?></div>
                            </td>
                            <td class="text-center">
                                <button type="button" class="btn btn-outline-danger btn-sm shadow-sm" 
                                        data-bs-toggle="modal" 
                                        data-bs-target="#modalNegar" 
                                        data-id="<?php echo $reserva['id_reserva']; ?>" 
                                        data-cliente="<?php echo $reserva['id_cliente_fk']; ?>"
                                        data-nombre="<?php echo htmlspecialchars($reserva['nombre_cliente']); ?>">
                                    <i class="bi bi-x-circle"></i> Negar
                                </button>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalNegar" tabindex="-1" aria-labelledby="modalNegarLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-danger text-white">
        <h5 class="modal-title" id="modalNegarLabel">Negar Reserva</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="<?php echo $URL; ?>/app/controllers/controllers_admin/reservas/negar_reserva.php" method="POST">
        <div class="modal-body">
            <input type="hidden" name="id_reserva" id="input_id_reserva">
            <input type="hidden" name="id_cliente" id="input_id_cliente">
            
            <p>Vas a negar la reserva de: <strong id="nombre_cliente_modal"></strong></p>
            
            <div class="mb-3">
                <label for="motivo" class="form-label fw-bold">Motivo de la negación (se enviará al cliente):</label>
                <textarea class="form-control" name="motivo" id="motivo" rows="3" placeholder="Ej: Lo sentimos, la mesa no estará disponible por mantenimiento..." required></textarea>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-danger">Confirmar Negación</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
    // Script para pasar datos al modal al abrirse
    var modalNegar = document.getElementById('modalNegar');
    modalNegar.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget;
        
        // Extraer info de los atributos data-*
        var idReserva = button.getAttribute('data-id');
        var idCliente = button.getAttribute('data-cliente');
        var nombre = button.getAttribute('data-nombre');

        // Rellenar los inputs del modal
        modalNegar.querySelector('#input_id_reserva').value = idReserva;
        modalNegar.querySelector('#input_id_cliente').value = idCliente;
        modalNegar.querySelector('#nombre_cliente_modal').textContent = nombre;
    });
</script>

<?php include '../../layouts/parte2.php'; ?>