<?php include '../../layouts/verificacion.php'; ?>
<?php include '../../layouts/parte1.php'; ?>
<?php include '../../../../alert.php'; ?>

<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card shadow">
                <
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="card-title"><b>Listado de Meseros</b></h3>
                    <div>
                        <a href="reporte.php" target="_blank" class="btn btn-danger">
                            <i class="bi bi-file-pdf"></i> Descargar PDF
                        </a>
                        <a href="create.php" class="btn btn-primary">
                            <i class="bi bi-plus-circle"></i> Agregar Mesero
                        </a>
                    </div>
                </div>
                
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-sm table-hover">
                            <thead>
                                <tr style="background-color: #e9ecef">
                                    <th class="text-center">Nro</th>
                                    <th>Nombre</th>
                                    <th>Email</th>
                                    <th>Teléfono</th>
                                    <th>Imagen</th>
                                    <th class="text-center">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $contador = 0;
                                // Consulta usando PDO filtrando por el rol 2
                                $sql = "SELECT * FROM usuarios WHERE id_rol_fk = '2' ";
                                $query = $pdo->prepare($sql);
                                $query->execute();
                                $usuarios = $query->fetchAll(PDO::FETCH_ASSOC);

                                if ($usuarios) {
                                    foreach ($usuarios as $usuario) {
                                        $id_usuario = $usuario['id_usuario']; // Ajusta al nombre real de tu PK
                                        $contador++;
                                ?>
                                        <tr>
                                            <td class="text-center"><?php echo $contador; ?></td>
                                            <td><?php echo $usuario['nombre']; ?></td>
                                            <td><?php echo $usuario['email']; ?></td>
                                            <td><?php echo $usuario['telefono']; ?></td>
                                            <td class="text-center">
                                                <img src="../../../../public/assets/img/meseros/<?php echo $usuario['imagen']; ?>" width="80px" height="80px" style="border-radius: 20%" alt="user">

                                                </td>
                                            <td class="text-center">
                                                <div class="btn-group" role="group">
                                                    <a href="show.php?id=<?php echo $id_usuario; ?>" class="btn btn-info btn-sm"><i class="bi bi-eye"></i></a>
                                                    <a href="update.php?id=<?php echo $id_usuario; ?>" class="btn btn-success btn-sm"><i class="bi bi-pencil"></i></a>
                                                    <a href="delete.php?id=<?php echo $id_usuario; ?>" class="btn btn-danger btn-sm"><i class="bi bi-trash"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                <?php
                                    }
                                } else {
                                    // Mensaje solicitado si no hay registros
                                    echo '<tr><td colspan="6" class="text-center"><b>No hay meseros o meseras registrados</b></td></tr>';
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include '../../layouts/parte2.php'; ?>