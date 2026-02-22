<?php 
include '../../layouts/verificacion.php'; 
include '../../layouts/parte1.php'; 

// Recibimos el ID de la URL
$id_usuario = $_GET['id'];

// Consulta para obtener los datos del mesero
$sql = "SELECT * FROM usuarios WHERE id_usuario = :id_usuario AND id_rol_fk = '2'";
$query = $pdo->prepare($sql);
$query->bindParam(':id_usuario', $id_usuario);
$query->execute();
$usuario = $query->fetch(PDO::FETCH_ASSOC);

// Si no existe el usuario, redireccionamos
if (!$usuario) {
    header('Location: ' . $URL . '/admin/usuarios/meseros/index.php');
    exit();
}
?>

<div class="container-fluid py-4">
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="card shadow">
                <div class="card-header bg-info text-white">
                    <h3 class="card-title mb-0"><b>Detalles del Mesero: <?php echo $usuario['nombre']; ?></b></h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4 text-center mb-3">
                            <label>Foto de Perfil</label>
                            <br>
                            <img src="../../../../public/assets/img/meseros/<?php echo trim($usuario['imagen']); ?>" 
                                 class="img-fluid rounded shadow-sm" 
                                 style="width: 200px; height: 200px; object-fit: cover;" 
                                 alt="Perfil">
                        </div>

                        <div class="col-md-8">
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <label>Nombre Completo</label>
                                    <p class="form-control bg-light"><?php echo $usuario['nombre']; ?></p>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label>Correo Electrónico</label>
                                    <p class="form-control bg-light"><?php echo $usuario['email']; ?></p>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label>Teléfono</label>
                                    <p class="form-control bg-light"><?php echo $usuario['telefono']; ?></p>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label>Rol</label>
                                    <p class="form-control bg-light">Mesero / Mesera</p>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label>Fecha de Registro</label>
                                    <p class="form-control bg-light">
                                        <?php echo date('d/m/Y H:i:s', strtotime($usuario['fecha_creacion'])); ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr>

                    <div class="row">
                        <div class="col-md-12 text-right">
                            <a href="index.php" class="btn btn-secondary">Volver al Listado</a>
                            <a href="update.php?id=<?php echo $id_usuario; ?>" class="btn btn-success">
                                <i class="bi bi-pencil"></i> Editar Datos
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include '../../layouts/parte2.php'; ?>