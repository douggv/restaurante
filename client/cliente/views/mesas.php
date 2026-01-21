<?php include '../layouts/verificacion.php'; ?>   
<?php include '../layouts/parte1.php'; ?>    
<?php include '../layouts/nav.php'; ?>

<?php include '../../../app/controllers/controllers_admin/mesas/read.php'; ?>


<div class="container mt-5">
    <h2 class="mb-4 text-center">Gestión de Reservas</h2>
    
    <div class="table-responsive">
        <table class="table table-hover align-middle shadow-sm">
            <thead class="table-dark">
                <tr>
                    <th>Nro Mesa</th>
                    <th>Sillas</th>
                    <th>Tipo</th>
                    <th class="text-center">Acción</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($mesas as $mesa): ?>
                    <tr>
                        <td class="fw-bold text-primary"># <?php echo htmlspecialchars($mesa['nro_mesa']); ?></td>
                        <td><?php echo htmlspecialchars($mesa['sillas']); ?> asientos</td>
                        <td>
                            <span class="badge rounded-pill bg-light text-dark border">
                                <?php echo htmlspecialchars($mesa['tipo']); ?>
                            </span>
                        </td>
                        <td class="text-center">
                            <a href="reservar.php?id=<?php echo $mesa['id_mesa']; ?>" class="btn btn-success btn-sm px-4">
                                <i class="bi bi-calendar-plus"></i> Reservar
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>


<?php include '../layouts/parte2.php'; ?>    
