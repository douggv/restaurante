<?php 
include '../../layouts/verificacion.php'; 
include '../../layouts/parte1.php'; 

$id_usuario = $_GET['id'];

// Consultamos los datos para mostrarle al admin qué está borrando
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
        <div class="col-md-6 mx-auto">
            <div class="card shadow border-danger">
                <div class="card-header bg-danger text-white">
                    <h3 class="card-title mb-0"><b>¿Desea eliminar este registro?</b></h3>
                </div>
                <div class="card-body">
                    <form action="../../../../app/controllers/controllers_admin/meseros/delete.php" method="POST">
                        
                        <input type="hidden" name="id_usuario" value="<?php echo $id_usuario; ?>">
                        <input type="hidden" name="nombre_mesero" value="<?php echo $usuario['nombre']; ?>">

                        <div class="text-center mb-4">
                            <img src="../../../../public/assets/img/meseros/<?php echo $usuario['imagen']; ?>" 
                                 class="rounded-circle shadow" width="120px" height="120px" style="object-fit: cover;">
                            <h4 class="mt-3"><?php echo $usuario['nombre']; ?></h4>
                            <p class="text-muted">Mesero / Mesera</p>
                        </div>

                        <div class="alert alert-warning">
                            <i class="bi bi-exclamation-triangle"></i> 
                            <b>Atención:</b> Esta acción no se puede deshacer. Se eliminarán todos los datos del usuario del sistema.
                        </div>

                        <hr>
                        <div class="d-flex justify-content-between">
                            <a href="index.php" class="btn btn-secondary">Cancelar, volver atrás</a>
                            <button type="submit" class="btn btn-danger">Sí, eliminar permanentemente</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include '../../layouts/parte2.php'; ?>