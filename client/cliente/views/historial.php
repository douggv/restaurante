<?php 
include '../layouts/verificacion.php'; 
include '../layouts/parte1.php'; 
include '../layouts/nav.php'; 
include '../../../alert.php'; 

try {
    $id_cliente = $id_cliente_sesion; 

    // Agregamos p.id_usuario_fk al SELECT para que el Modal sepa a quién calificar
    $sql = "SELECT 
                p.id_pedido,
                p.id_usuario_fk, 
                GROUP_CONCAT(CONCAT('• ', m_plato.nombre_comida) SEPARATOR '<br>') AS lista_comidas,
                SUM(p.total_pagar) AS total_final,
                p.fyh_creacion,
                p.estado_pedido AS estado,
                mesas.nro_mesa,
                u.nombre AS nombre_mesero,
                u.imagen AS imagen_mesero
            FROM pedidos p
            INNER JOIN mesas ON p.id_mesa_fk = mesas.id_mesa
            INNER JOIN usuarios u ON p.id_usuario_fk = u.id_usuario
            INNER JOIN menu m_plato ON p.id_menu_fk = m_plato.id_comida
            WHERE p.id_cliente_fk = :id_cliente
            GROUP BY p.fyh_creacion, p.id_mesa_fk 
            ORDER BY p.fyh_creacion DESC";

    $stmt = $pdo->prepare($sql);
    $stmt->execute(['id_cliente' => $id_cliente]);
    $consumos = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    echo "<div class='alert alert-danger'>Error: " . $e->getMessage() . "</div>";
    $consumos = [];
}
?>

<div class="container py-4">
    <h2 class="fw-bold mb-4 text-center">Mi Historial de Consumo</h2>
    
    <div class="row">
        <?php foreach ($consumos as $row): ?>
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card shadow-sm border-0 h-100" style="border-radius: 15px;">
                    <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center" style="border-radius: 15px 15px 0 0;">
                        <span class="badge bg-primary">Mesa <?php echo $row['nro_mesa']; ?></span>
                        <small><?php echo date("d/m/Y H:i", strtotime($row['fyh_creacion'])); ?></small>
                    </div>

                    <div class="card-body">
                        <div class="d-flex align-items-center mb-3">
                            <img src="<?php echo !empty($row['imagen_mesero']) ? '../../../public/assets/img/meseros/'.$row['imagen_mesero'] : 'https://ui-avatars.com/api/?name='.urlencode($row['nombre_mesero']); ?>" 
                                 class="rounded-circle me-2" width="40" height="40" style="object-fit: cover;">
                            <div>
                                <h6 class="mb-0 fw-bold"><?php echo htmlspecialchars($row['nombre_mesero']); ?></h6>
                                <small class="text-muted">Mesero(a)</small>
                            </div>
                        </div>

                        <div class="p-3 bg-light rounded mb-3">
                            <p class="small fw-bold text-uppercase mb-1">Lo que consumiste:</p>
                            <div class="small text-secondary">
                                <?php echo $row['lista_comidas']; ?>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <span class="badge bg-info text-dark"><?php echo ucfirst($row['estado']); ?></span>
                        </div>

                        <button type="button" class="btn btn-outline-primary w-100 rounded-pill fw-bold btn-sm shadow-sm" 
                                data-bs-toggle="modal" 
                                data-bs-target="#modalComentario<?php echo $row['id_pedido']; ?>">
                            <i class="fas fa-star me-1"></i> Enviar Comentario
                        </button>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="modalComentario<?php echo $row['id_pedido']; ?>" tabindex="-1" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content border-0 shadow" style="border-radius: 20px;">
                  <div class="modal-header bg-primary text-white border-0 py-3">
                    <h5 class="modal-title fw-bold"><i class="fas fa-pen-nib me-2"></i>Califica tu experiencia</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                  </div>
                  
                  <form action="<?php echo $URL; ?>/client/cliente/views/procesar_comentario.php" method="POST">
                    <div class="modal-body p-4 text-center">
                        <p class="text-muted">¿Cómo calificarías la atención de <strong><?php echo $row['nombre_mesero']; ?></strong>?</p>
                        
                        <input type="hidden" name="id_cliente" value="<?php echo $id_cliente; ?>">
                        <input type="hidden" name="id_usuario_fk" value="<?php echo $row['id_usuario_fk']; ?>">

                        <div class="mb-3">
                            <label class="form-label fw-bold">Puntuación</label>
                            <select name="puntuacion" class="form-select border-0 bg-light rounded-3 text-center" required>
                                <option value="5">⭐⭐⭐⭐⭐ Excelente</option>
                                <option value="4">⭐⭐⭐⭐ Muy Bueno</option>
                                <option value="3">⭐⭐⭐ Bueno</option>
                                <option value="2">⭐⭐ Regular</option>
                                <option value="1">⭐ Malo</option>
                            </select>
                        </div>

                        <div class="mb-3 text-start">
                            <label class="form-label fw-bold">Tu Reseña</label>
                            <textarea name="resena" class="form-control border-0 bg-light rounded-3" rows="3" placeholder="Escribe aquí tu opinión..." required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer border-0 p-3">
                      <button type="submit" class="btn btn-primary w-100 rounded-pill fw-bold py-2 shadow">Guardar Comentario</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
            <?php endforeach; ?>
    </div>
</div>

<?php include '../layouts/parte2.php'; ?>