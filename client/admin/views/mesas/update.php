<?php include '../../layouts/verificacion.php'; ?>
<?php include '../../layouts/parte1.php'; ?>
<?php include '../../../../app/controllers/controllers_admin/mesas/read.php'; ?>

<?php 


// Obtener el ID de la mesa
$id_mesa_get = $_GET['id'];

// Consultar los datos actuales
$sql = "SELECT * FROM mesas WHERE id_mesa = :id_mesa";
$query = $pdo->prepare($sql);
$query->bindParam(':id_mesa', $id_mesa_get);
$query->execute();
$mesa = $query->fetch(PDO::FETCH_ASSOC);

$nro_mesa = $mesa['nro_mesa'];
$sillas = $mesa['sillas'];
$tipo = $mesa['tipo'];
$estado = $mesa['estado'];
?>

<style>
    body { font-family: 'Inter', sans-serif; background-color: #f8f9fa; }
    .card { border: none; border-radius: 15px; }
    .form-label { font-weight: 600; color: #495057; }
    .input-group-text { border-right: none; background-color: #fff; }
    .form-control, .form-select { border-left: none; }
    .form-control:focus, .form-select:focus { box-shadow: none; border-color: #dee2e6; }
</style>

<div class="container py-5">
    <div class="row mb-4">
        <div class="col-md-8 mx-auto d-flex justify-content-between align-items-center">
            <div>
                <h2 class="fw-bold mb-0">Editar Mesa #<?php echo $nro_mesa; ?></h2>
                <p class="text-muted">Modifica los parámetros de la mesa seleccionada.</p>
            </div>
            <a href="index.php" class="btn btn-outline-secondary shadow-sm">
                <i class="bi bi-arrow-left me-2"></i>Volver
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="card shadow-sm p-4">
                <form action="<?php echo $URL; ?>/app/controllers/controllers_admin/mesas/update.php" method="POST">
                    <input type="hidden" name="id_mesa" value="<?php echo $id_mesa_get; ?>">

                    <div class="row g-4">
                        <div class="col-md-6">
                            <label for="nro_mesa" class="form-label">Número de Mesa</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-hash text-primary"></i></span>
                                <input type="number" class="form-control" name="nro_mesa" value="<?php echo $nro_mesa; ?>" required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label for="sillas" class="form-label">Cantidad de Sillas</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-people text-primary"></i></span>
                                <input type="number" class="form-control" name="sillas" value="<?php echo $sillas; ?>" required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label for="tipo" class="form-label">Tipo de Mesa</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-star-fill text-primary"></i></span>
                                <select class="form-select" name="tipo" required>
                                    <option value="basica" <?php if($tipo == "basica") echo "selected"; ?>>Básica</option>
                                    <option value="premium" <?php if($tipo == "premium") echo "selected"; ?>>Premium</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label for="estado" class="form-label">Estado de la Mesa</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-info-circle text-primary"></i></span>
                                <select class="form-select" name="estado" required>
                                    <option value="disponible" <?php if($estado == "disponible") echo "selected"; ?>>Disponible</option>
                                    <option value="ocupada" <?php if($estado == "ocupada") echo "selected"; ?>>Ocupada</option>
                                    <option value="mantenimiento" <?php if($estado == "mantenimiento") echo "selected"; ?>>Mantenimiento</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-12 mt-5">
                            <hr class="text-muted opacity-25">
                            <div class="d-flex justify-content-end gap-2">
                                <a href="index.php" class="btn btn-light px-4">Cancelar</a>
                                <button type="submit" class="btn btn-success px-5 fw-bold shadow">
                                    <i class="bi bi-pencil-square me-2"></i>Actualizar Mesa
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include '../../layouts/parte2.php'; ?>