<?php 
include '../../layouts/verificacion.php'; 
include '../../layouts/parte1.php'; 

$id_usuario = $_GET['id'];

// Obtener los datos actuales del mesero
$sql = "SELECT * FROM usuarios WHERE id_usuario = :id_usuario AND id_rol_fk = '2'";
$query = $pdo->prepare($sql);
$query->bindParam(':id_usuario', $id_usuario);
$query->execute();
$usuario = $query->fetch(PDO::FETCH_ASSOC);

if (!$usuario) {
    header('Location: ' . $URL . '/admin/usuarios/meseros/index.php');
    exit();
}
?>

<div class="container-fluid py-4">
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="card shadow">
                <div class="card-header bg-success text-white">
                    <h3 class="card-title mb-0"><b>Editar Mesero: <?php echo $usuario['nombre']; ?></b></h3>
                </div>
                <div class="card-body">
                    <form action="../../../../app/controllers/controllers_admin/meseros/update.php" method="POST" enctype="multipart/form-data">
                        
                        <input type="hidden" name="id_usuario" value="<?php echo $id_usuario; ?>">
                        <input type="hidden" name="imagen_actual" value="<?php echo $usuario['imagen']; ?>">

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label>Nombre Completo</label>
                                <input type="text" name="nombre" class="form-control" value="<?php echo $usuario['nombre']; ?>" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Correo Electrónico</label>
                                <input type="email" name="email" class="form-control" value="<?php echo $usuario['email']; ?>" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label>Teléfono</label>
                                <input type="text" name="telefono" class="form-control" value="<?php echo $usuario['telefono']; ?>" pattern="\d{11}" maxlength="11" title="Solo números y 11 dígitos" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Contraseña <small>(Dejar en blanco si no desea cambiarla)</small></label>
                                <input type="password" name="password" class="form-control" placeholder="Nueva contraseña">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label>Foto Actual</label><br>
                                <img src="../../../../public/assets/img/meseros/<?php echo $usuario['imagen']; ?>" width="80px" class="mb-2"><br>
                                <label>Cambiar Foto</label>
                                <input type="file" name="imagen" class="form-control" accept="image/*">
                            </div>
                        </div>

                        <hr>
                        <a href="index.php" class="btn btn-secondary">Cancelar</a>
                        <button type="submit" class="btn btn-success">Actualizar Mesero</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include '../../layouts/parte2.php'; ?>