<?php include '../../layouts/verificacion.php'; ?>
<?php include '../../layouts/parte1.php'; ?>
<?php include '../../../../app/controllers/controllers_admin/platos/read.php'; ?>
<?php 


// Obtener el ID del plato a eliminar
$id_menu_get = $_GET['id'];

// Consulta para mostrar qué se va a eliminar
$sql = "SELECT * FROM menu WHERE id_comida = :id_menu_get";
$query = $pdo->prepare($sql);
$query->bindParam(':id_menu_get', $id_menu_get);
$query->execute();
$datos_menu = $query->fetch(PDO::FETCH_ASSOC);

$nombre_comida = $datos_menu['nombre_comida'];
?>

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Eliminar Plato</h1>
            </div>
        </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8">
                <div class="card card-danger">
                    <div class="card-header">
                        <h3 class="card-title">¿Estás seguro de eliminar este registro?</h3>
                    </div>
                    <div class="card-body">
                        <form action="../../../../app/controllers/controllers_admin/platos/delete.php" method="POST">
                            <input type="hidden" name="id_menu" value="<?php echo $id_menu_get; ?>">
                            
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Nombre del Plato</label>
                                        <input type="text" class="form-control" value="<?php echo $nombre_comida; ?>" disabled>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Categoría</label>
                                        <input type="text" class="form-control" value="<?php echo $datos_menu['categoria']; ?>" disabled>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Precio</label>
                                        <input type="text" class="form-control" value="<?php echo $datos_menu['precio']; ?>" disabled>
                                    </div>
                                </div>
                            </div>

                            <hr>
                            <div class="row">
                                <div class="col-md-12">
                                    <a href="index.php" class="btn btn-secondary">Cancelar</a>
                                    <button type="submit" class="btn btn-danger">Eliminar Definitivamente</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include '../../layouts/parte2.php'; ?>