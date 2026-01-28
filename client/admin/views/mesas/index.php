<?php include '../../layouts/verificacion.php'; ?>
<?php include '../../layouts/parte1.php'; ?>
<?php include '../../../../app/controllers/controllers_admin/mesas/read.php'; ?>

<?php
    // Tu lógica de conexión y consulta
    $sql = "SELECT * FROM mesas";
    $query = $pdo->prepare($sql);
    $query->execute();
    $mesas = $query->fetchAll(PDO::FETCH_ASSOC);
    
    // Conteo para las tarjetas superiores (opcional)
    $totalMesas = count($mesas);
?>
<?php include  '../../../../alert.php'; ?> 

<div class="container-fluid p-4">
    <div class="row mb-4 align-items-center">
        <div class="col-md-6">
            <h2 class="fw-bold">Gestión de Mesas</h2>
            <p class="text-muted">Panel administrativo para el control de ubicación y estado de mesas.</p>
        </div>
        <div class="col-md-6 text-md-end">
            <a href="create.php" class="btn btn-primary shadow-sm">
                <i class="bi bi-plus-circle me-2"></i>Agregar Nueva Mesa
            </a>
        </div>
    </div>

    <div class="row g-3 mb-4">
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card p-3 bg-primary text-white h-100">
                <h6>Total Mesas</h6>
                <h3><?php echo $totalMesas; ?></h3>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card p-3 bg-success text-white h-100">
                <h6>Mesas Libres</h6>
                <h3>-</h3> 
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
            <h5 class="mb-0 text-primary">Listado de Mesas</h5>
        </div>
        <div class="card-body p-0">
            <?php if ($totalMesas > 0): ?>
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>ID</th>
                                <th>Número de Mesa</th>
                                <th>Capacidad</th>
                                <th>Tipo</th>
                                <th>Estado</th>
                                <th class="text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($mesas as $mesa): ?>
                                <tr>
                                    <td>#<?php echo $mesa['id_mesa']; ?></td>
                                    <td><strong>Mesa <?php echo $mesa['nro_mesa']; ?></strong></td>
                                    <td><?php echo $mesa['sillas']; ?> Personas</td>
                                    <td><?php echo ucfirst($mesa['tipo']); ?></td>
                                   
                                    <td>
                                        <?php if ($mesa['estado'] == 'disponible'): ?>
                                            <span class="badge bg-success">Disponible</span>
                                        <?php else: ?>
                                            <span class="badge bg-danger">Ocupada</span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="text-center">
                                        <div class="btn-group">
                                            <a href="update.php?id=<?php echo $mesa['id_mesa']; ?>" class="btn btn-sm btn-outline-info" title="Editar"><i class="bi bi-pencil"></i></a>
                                            <a href="delete.php?id=<?php echo $mesa['id_mesa']; ?>" class="btn btn-sm btn-outline-danger" title="Eliminar"><i class="bi bi-trash"></i></a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php else: ?>
                <div class="text-center py-5">
                    <i class="bi bi-exclamation-circle text-muted" style="font-size: 3rem;"></i>
                    <h4 class="mt-3 text-muted">No hay mesas registradas</h4>
                    <p>Haz clic en el botón "Agregar Nueva Mesa" para comenzar.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>


<?php include '../../layouts/parte2.php'; ?>