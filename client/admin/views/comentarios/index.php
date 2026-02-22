<?php include '../../layouts/verificacion.php'; ?>
<?php include '../../layouts/parte1.php'; ?>
<?php
// Incluir configuración de base de datos

try {
    $sql = "SELECT 
                c.id_comentario,
                c.puntuacion,
                c.resena,
                c.fecha_comentario,
                cli.nombre_cliente,
                u.nombre AS nombre_mesero,
                u.imagen AS imagen_mesero
            FROM comentarios c
            INNER JOIN clientes cli ON c.id_cliente_fk = cli.id_cliente
            INNER JOIN usuarios u ON c.id_usuario_fk = u.id_usuario
            ORDER BY c.fecha_comentario DESC";

    $query = $pdo->prepare($sql);
    $query->execute();
    $comentarios = $query->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>



<div class="container-fluid py-5" style="background-color: #f0f2f5;">
    <div class="text-center mb-5">
        <h1 class="fw-bold text-dark">Experiencias de nuestros Clientes</h1>
        <p class="text-muted">Lo que dicen sobre nuestro servicio y nuestro equipo.</p>
        <div class="mx-auto" style="width: 80px; height: 4px; background: #0d6efd; border-radius: 2px;"></div>
    </div>

    <div class="row px-4">
        <?php foreach ($comentarios as $com): ?>
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card border-0 shadow-lg h-100" style="border-radius: 20px;">
                    <div class="card-body p-4">
                        <div class="mb-3 text-warning">
                            <?php 
                            for($i=1; $i<=5; $i++) {
                                echo ($i <= $com['puntuacion']) ? '★' : '☆';
                            }
                            ?>
                        </div>

                        <p class="card-text fs-5 italic text-dark mb-4">
                            "<?php echo htmlspecialchars($com['resena']); ?>"
                        </p>

                        <hr class="text-light">

                        <div class="d-flex justify-content-between align-items-center mt-3">
                            <div>
                                <h6 class="mb-0 fw-bold"><?php echo htmlspecialchars($com['nombre_cliente']); ?></h6>
                                <small class="text-muted"><?php echo date('d/m/Y', strtotime($com['fecha_comentario'])); ?></small>
                            </div>
                            
                            <div class="text-end">
                                <div class="d-flex align-items-center bg-light p-2 rounded-pill shadow-sm border">
                                    <img src="../../../../public/assets/img/meseros/<?php echo !empty($com['imagen_mesero']) ? $com['imagen_mesero'] : 'default.png'; ?>" 
                                         class="rounded-circle me-2" width="30" height="30" style="object-fit: cover;">
                                    <div class="text-start">
                                        <p class="mb-0 text-muted" style="font-size: 0.6rem; line-height: 1;">Atendió:</p>
                                        <span class="fw-bold text-primary" style="font-size: 0.75rem;"><?php echo $com['nombre_mesero']; ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<?php include '../../layouts/parte2.php'; ?>