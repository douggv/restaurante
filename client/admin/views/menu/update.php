
<?php include '../../layouts/verificacion.php'; ?>
<?php include '../../layouts/parte1.php'; ?>
<?php include '../../../../app/controllers/controllers_admin/platos/read.php'; ?>
<?php 
// Obtener el ID del plato a editar
$id_menu_get = $_GET['id'];

// Consulta para traer los datos actuales
$sql = "SELECT * FROM menu WHERE id_comida = :id_menu_get";
$query = $pdo->prepare($sql);
$query->bindParam(':id_menu_get', $id_menu_get);
$query->execute();
$datos_menu = $query->fetch(PDO::FETCH_ASSOC);

// Extraer variables para facilitar el llenado
$nombre_comida = $datos_menu['nombre_comida'];
$tipo = $datos_menu['tipo'];
$categoria = $datos_menu['categoria'];
$precio = $datos_menu['precio'];
$descripcion = $datos_menu['descripcion'];
$disponible = $datos_menu['disponible'];
?>

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Actualizar Plato: <?php echo $nombre_comida; ?></h1>
            </div>
        </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">
        <div class="card card-success"> <div class="card-header">
                <h3 class="card-title">Modifique los campos necesarios</h3>
            </div>
            <div class="card-body">
                <form action="../../../../app/controllers/controllers_admin/platos/update.php" method="POST">
                    <input type="hidden" name="id_menu" value="<?php echo $id_menu_get; ?>">

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Nombre del Plato</label>
                                <input type="text" name="nombre_comida" class="form-control" value="<?php echo $nombre_comida; ?>" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Tipo</label>
                                <input type="text" name="tipo" class="form-control" value="<?php echo $tipo; ?>" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Categoría</label>
                                <select name="categoria" class="form-control" required>
                                    <option value="Comida Rápida" <?php if($categoria == "Comida Rápida") echo "selected"; ?>>Comida Rápida</option>
                                    <option value="Bebidas" <?php if($categoria == "Bebidas") echo "selected"; ?>>Bebidas</option>
                                    <option value="Postres" <?php if($categoria == "Postres") echo "selected"; ?>>Postres</option>
                                    <option value="Especialidades" <?php if($categoria == "Especialidades") echo "selected"; ?>>Especialidades</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Precio</label>
                                <input type="number" step="0.01" name="precio" class="form-control" value="<?php echo $precio; ?>" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>¿Está Disponible?</label>
                                <select name="disponible" class="form-control" required>
                                    <option value="1" <?php if($disponible == "1") echo "selected"; ?>>Sí, disponible</option>
                                    <option value="0" <?php if($disponible == "0") echo "selected"; ?>>No, agotado</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Descripción</label>
                                <textarea name="descripcion" rows="3" class="form-control"><?php echo $descripcion; ?></textarea>
                            </div>
                        </div>
                    </div>

                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <a href="index.php" class="btn btn-secondary">Cancelar</a>
                            <button type="submit" class="btn btn-success">Actualizar Registro</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<?php include '../../layouts/parte2.php'; ?>