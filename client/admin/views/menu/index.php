<?php include '../../layouts/verificacion.php'; ?>
<?php include '../../layouts/parte1.php'; ?>
<?php include '../../../../app/controllers/controllers_admin/platos/read.php'; ?>

<?php
    // Tu lógica de conexión y consulta (asegúrate que $pdo esté definido en tus controllers)
    $sql = "SELECT * FROM menu";
    $query = $pdo->prepare($sql);
    $query->execute();
    $menu = $query->fetchAll(PDO::FETCH_ASSOC);
    
    $totalMenu = count($menu);
?>
<?php include '../../../../alert.php'; ?> 

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Gestión de Menú</h1>
            </div>
        </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">
        <div class="card card-outline card-primary">
            <div class="card-header">
                <h3 class="card-title">Platos registrados (<?php echo $totalMenu; ?>)</h3>
                <div class="card-tools">
                    <a href="create.php" class="btn btn-primary btn-sm"><i class="bi bi-plus"></i> Nuevo Plato</a>
                </div>
            </div>
            <div class="card-body">
                <table id="tabla_menu" class="table table-bordered table-sm table-striped table-hover">
                    <thead>
                        <tr class="text-center">
                            <th>#</th>
                            <th>Nombre</th>
                            <th>Categoría</th>
                            <th>Precio</th>
                            <th>Descripción</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $contador = 0;
                        foreach ($menu as $item) { 
                            $contador++;
                            $id_menu = $item['id_comida']; // Asegúrate que este sea el nombre de tu PK
                        ?>
                        <tr>
                            <td class="text-center"><?php echo $contador; ?></td>
                            <td><?php echo $item['nombre_comida']; ?></td>
                            <td><?php echo $item['categoria']; ?></td>
                            <td>$<?php echo number_format($item['precio'], 2); ?></td>
                            <td><?php echo $item['descripcion']; ?></td>
                            <td class="text-center">
                                <?php if($item['disponible'] == 1): ?>
                                    <span style="background-color: #28a745; color: white; padding: 5px 10px; border-radius: 5px;">Disponible</span>
                                <?php else: ?>
                                    <span style="background-color: #dc3545; color: white; padding: 5px 10px; border-radius: 5px;">No Disponible</span>
                                <?php endif; ?>
                            </td>
                            <td class="text-center">
                                <div class="btn-group">
                                    <a href="read.php?id=<?php echo $id_menu; ?>" class="btn btn-info btn-sm" title="Ver"><i class="bi bi-eye"></i></a>
                                    <a href="update.php?id=<?php echo $id_menu; ?>" class="btn btn-success btn-sm" title="Editar"><i class="bi bi-pencil"></i></a>
                                    <a href="delete.php?id=<?php echo $id_menu; ?>" class="btn btn-danger btn-sm" title="Eliminar"><i class="bi bi-trash"></i></a>
                                </div>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>

<?php include '../../layouts/parte2.php'; ?>