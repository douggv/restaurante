
<?php include '../../layouts/verificacion.php'; ?>
<?php include '../../layouts/parte1.php'; ?>
<?php include '../../../../app/controllers/controllers_admin/mesas/read.php'; ?>
<?php 


// 1. Obtener el ID de la mesa
$id_mesa_get = $_GET['id'];

// 2. Consultar los datos actuales para mostrar qué se va a deshabilitar
$sql = "SELECT * FROM mesas WHERE id_mesa = :id_mesa";
$query = $pdo->prepare($sql);
$query->bindParam(':id_mesa', $id_mesa_get);
$query->execute();
$mesa = $query->fetch(PDO::FETCH_ASSOC);

$nro_mesa = $mesa['nro_mesa'];
$sillas = $mesa['sillas'];
$tipo = $mesa['tipo'];
?>

<style>
    body { font-family: 'Inter', sans-serif; background-color: #f8f9fa; }
    .card { border: none; border-radius: 15px; }
    .form-label { font-weight: 600; color: #495057; }
    .input-group-text { border-right: none; background-color: #fff; }
    .form-control { border-left: none; background-color: #e9ecef !important; }
</style>

<div class="container py-5">
    <div class="row mb-4">
        <div class="col-md-8 mx-auto d-flex justify-content-between align-items-center">
            <div>
                <h2 class="fw-bold mb-0 text-danger">Eliminar Mesa</h2>
                <p class="text-muted">¿Estás seguro de que deseas poner esta mesa fuera de servicio?</p>
            </div>
            <a href="index.php" class="btn btn-outline-secondary shadow-sm">
                <i class="bi bi-arrow-left me-2"></i>Volver
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="card shadow-sm p-4 border-top border-danger border-4">
                <form action="<?php echo $URL; ?>/app/controllers/controllers_admin/mesas/delete.php" method="POST">
                    
                    <input type="hidden" name="id_mesa" value="<?php echo $id_mesa_get; ?>">

                    <div class="row g-4">
                        <div class="col-md-6">
                            <label class="form-label">Número de Mesa</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-hash text-danger"></i></span>
                                <input type="text" class="form-control" value="<?php echo $nro_mesa; ?>" disabled>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Cantidad de Sillas</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-people text-danger"></i></span>
                                <input type="text" class="form-control" value="<?php echo $sillas; ?>" disabled>
                            </div>
                        </div>

                        <div class="col-12">
                            <label class="form-label">Tipo de Mesa</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-star-fill text-danger"></i></span>
                                <input type="text" class="form-control" value="<?php echo ucfirst($tipo); ?>" disabled>
                            </div>
                        </div>

                        <div class="col-12 mt-5">
                            <div class="alert alert-warning border-0 shadow-sm">
                                <i class="bi bi-exclamation-triangle-fill me-2"></i>
                                <strong>Nota:</strong> La mesa no se eliminará físicamente para mantener el historial de pedidos, pero cambiará su estado a <strong>Mantenimiento/Inactivo</strong>.
                            </div>
                            <hr class="text-muted opacity-25">
                            <div class="d-flex justify-content-end gap-2">
                                <a href="index.php" class="btn btn-light px-4">Cancelar</a>
                                <button type="submit" class="btn btn-danger px-5 fw-bold shadow">
                                    <i class="bi bi-trash me-2"></i>Confirmar Eliminación
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