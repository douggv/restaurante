<?php include '../../layouts/verificacion.php'; ?>
<?php include '../../layouts/parte1.php'; ?>
<?php include '../../../../app/controllers/controllers_admin/platos/read.php'; ?>


<?php 


// 1. Obtener el ID desde la URL
if(isset($_GET['id'])) {
    $id_menu_get = $_GET['id'];
} else {
    // Si no hay ID, redirigir al listado
    header('Location: index.php');
}

// 2. Consulta para obtener los datos del plato específico
$sql = "SELECT * FROM menu WHERE id_comida = :id_menu";
$query = $pdo->prepare($sql);
$query->bindParam(':id_menu', $id_menu_get);
$query->execute();
$item = $query->fetch(PDO::FETCH_ASSOC);

// Si el plato no existe en la BD
if (!$item) {
    header('Location: index.php');
}
?>

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Detalles del Plato: <?php echo $item['nombre_comida']; ?></h1>
            </div>
        </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8">
                <div class="card card-outline card-info">
                    <div class="card-header">
                        <h3 class="card-title">Información del Registro</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table table-hover table-striped">
                                    <tr>
                                        <th style="width: 30%"><i class="bi bi-tag"></i> Nombre del Plato</th>
                                        <td><?php echo $item['nombre_comida']; ?></td>
                                    </tr>
                                    <tr>
                                        <th><i class="bi bi-list-stars"></i> Tipo</th>
                                        <td><?php echo $item['tipo']; ?></td>
                                    </tr>
                                    <tr>
                                        <th><i class="bi bi-grid"></i> Categoría</th>
                                        <td><?php echo $item['categoria']; ?></td>
                                    </tr>
                                    <tr>
                                        <th><i class="bi bi-currency-dollar"></i> Precio</th>
                                        <td>$ <?php echo number_format($item['precio'], 2); ?></td>
                                    </tr>
                                    <tr>
                                        <th><i class="bi bi-info-circle"></i> Descripción</th>
                                        <td><?php echo (!empty($item['descripcion'])) ? $item['descripcion'] : "Sin descripción disponible"; ?></td>
                                    </tr>
                                    <tr>
                                        <th><i class="bi bi-check2-circle"></i> Estado</th>
                                        <td>
                                            <?php if($item['disponible'] == 1): ?>
                                                <span class="badge badge-success">Activo / Disponible</span>
                                            <?php else: ?>
                                                <span class="badge badge-danger">Inactivo / No Disponible</span>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="index.php" class="btn btn-secondary">Regresar al Listado</a>
                        <a href="update.php?id=<?php echo $id_menu_get; ?>" class="btn btn-success">Ir a Editar</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include '../../layouts/parte2.php'; ?>