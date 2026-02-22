<?php 
include '../../layouts/verificacion.php'; 
include '../../layouts/parte1.php'; 

$fecha_hoy = date('Y-m-d');
$id_sesion_actual = $datos_usuario['id_usuario']; // ID del mesero en sesión
?>
<?php include '../../../../alert.php'; ?>
 <a href="../index.php" class="btn btn-light shadow-sm me-3" style="border-radius: 10px;">
                <i class="bi bi-arrow-left-circle-fill text-primary"></i> Regresar
            </a>
<div class="container-fluid py-4 px-4">
    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light text-primary">
                        <tr>
                            <th class="ps-4">Hora</th>
                            <th>Mesa</th>
                            <th>Mesero(a)</th>
                            <th>Consumo</th>
                            <th>Estado</th>
                            <th class="text-center">Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql_pedidos = "SELECT p.fyh_creacion, p.estado_pedido, p.id_mesa_fk, p.id_usuario_fk,
                                               m.nro_mesa, u.nombre as nombre_mesero,
                                               GROUP_CONCAT(menu.nombre_comida SEPARATOR '<br>') as detalle_consumo
                                        FROM pedidos p
                                        INNER JOIN mesas m ON p.id_mesa_fk = m.id_mesa
                                        INNER JOIN menu ON p.id_menu_fk = menu.id_comida
                                        INNER JOIN usuarios u ON p.id_usuario_fk = u.id_usuario
                                        WHERE DATE(p.fyh_creacion) = :fecha_hoy
                                        GROUP BY p.fyh_creacion, p.id_mesa_fk, p.id_usuario_fk
                                        ORDER BY p.fyh_creacion DESC";

                        $query_pedidos = $pdo->prepare($sql_pedidos);
                        $query_pedidos->execute([':fecha_hoy' => $fecha_hoy]);
                        $pedidos = $query_pedidos->fetchAll(PDO::FETCH_ASSOC);

                        foreach($pedidos as $pedido) {
                            $es_dueno = ((int)$pedido['id_usuario_fk'] === (int)$id_sesion_actual);
                            $estado = $pedido['estado_pedido'];
                        ?>
                            <tr>
                                <td class="ps-4 small text-muted"><?php echo date('H:i', strtotime($pedido['fyh_creacion'])); ?></td>
                                <td><span class="badge bg-dark">Mesa <?php echo $pedido['nro_mesa']; ?></span></td>
                                <td><?php echo $pedido['nombre_mesero']; ?></td>
                                <td class="small"><?php echo $pedido['detalle_consumo']; ?></td>
                                <td>
                                    <?php if($estado == 'pendiente'): ?>
                                        <span class="badge bg-warning text-dark">Pendiente</span>
                                    <?php else: ?>
                                        <span class="badge bg-success">Entregado</span>
                                    <?php endif; ?>
                                <td class="text-center">
                                    <?php if($estado == 'pendiente'): ?>
                                        <a href="../../../../app/controllers/controllers_mesera/pedidos/update_estado.php?fecha=<?php echo $pedido['fyh_creacion']; ?>&id_mesa=<?php echo $pedido['id_mesa_fk']; ?>&id_user=<?php echo $pedido['id_usuario_fk']; ?>" 
                                        class="btn btn-sm rounded-pill px-3 <?php echo $es_dueno ? 'btn-primary' : 'btn-light text-muted disabled'; ?>"
                                        <?php echo !$es_dueno ? 'style="pointer-events: none; opacity: 0.6;"' : ''; ?>>
                                        <i class="bi <?php echo $es_dueno ? 'bi-check-circle' : 'bi-lock'; ?>"></i> 
                                        Entregar Todo
                                        </a>
                                    <?php else: ?>
                                        <span class="text-success small fw-bold"><i class="bi bi-check-all"></i> ENTREGADO</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php include '../../layouts/parte2.php'; ?>