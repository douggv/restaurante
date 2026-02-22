<?php 
include '../layouts/verificacion.php'; 
include '../layouts/parte1.php'; 
?>
<?php include '../../../alert.php'; ?>

<?php
// ... tus includes anteriores ...
$id_sesion_actual = $datos_usuario['id_usuario']; // ID del mesero en sesión
$fecha_hoy = date('Y-m-d');

// 1. Total de Mesas Atendidas (Histórico total de esta mesera)
$sql_total = "SELECT COUNT(DISTINCT id_mesa_fk, fyh_creacion) as total 
              FROM pedidos 
              WHERE id_usuario_fk = :id_user";
$query_total = $pdo->prepare($sql_total);
$query_total->execute([':id_user' => $id_sesion_actual]);
$res_total = $query_total->fetch();
$total_atendidas = $res_total['total'];

// 2. Mesas Atendidas HOY
$sql_hoy = "SELECT COUNT(DISTINCT id_mesa_fk, fyh_creacion) as total_hoy 
            FROM pedidos 
            WHERE id_usuario_fk = :id_user AND DATE(fyh_creacion) = :fecha";
$query_hoy = $pdo->prepare($sql_hoy);
$query_hoy->execute([':id_user' => $id_sesion_actual, ':fecha' => $fecha_hoy]);
$res_hoy = $query_hoy->fetch();
$atendidas_hoy = $res_hoy['total_hoy'];

// 3. Pendientes (De todo el tiempo o solo hoy, según prefieras. Aquí puse total pendientes)
$sql_pendientes = "SELECT COUNT(DISTINCT id_mesa_fk, fyh_creacion) as total_pend 
                   FROM pedidos 
                   WHERE id_usuario_fk = :id_user AND estado_pedido = 'pendiente'";
$query_pendientes = $pdo->prepare($sql_pendientes);
$query_pendientes->execute([':id_user' => $id_sesion_actual]);
$res_pend = $query_pendientes->fetch();
$total_pendientes = $res_pend['total_pend'];
?>
<?php
// ... tus consultas anteriores ...

// 4. Total en ventas del día (Suma de los precios de los platos vendidos hoy por la mesera)
$sql_ventas_dia = "SELECT SUM(m.precio) as total_dinero 
                   FROM pedidos p 
                   INNER JOIN menu m ON p.id_menu_fk = m.id_comida 
                   WHERE p.id_usuario_fk = :id_user 
                   AND DATE(p.fyh_creacion) = :fecha 
                   AND p.estado_pedido != 'cancelado'"; // No sumamos lo cancelado
$query_ventas = $pdo->prepare($sql_ventas_dia);
$query_ventas->execute([':id_user' => $id_sesion_actual, ':fecha' => $fecha_hoy]);
$res_ventas = $query_ventas->fetch();
$ventas_del_dia = $res_ventas['total_dinero'] ?? 0.00;

// 5. Producto más vendido hoy por esta mesera
$sql_top_producto = "SELECT m.nombre_comida, COUNT(p.id_menu_fk) as cantidad 
                      FROM pedidos p 
                      INNER JOIN menu m ON p.id_menu_fk = m.id_comida 
                      WHERE p.id_usuario_fk = :id_user 
                      AND DATE(p.fyh_creacion) = :fecha 
                      GROUP BY p.id_menu_fk 
                      ORDER BY cantidad DESC 
                      LIMIT 1";
$query_top = $pdo->prepare($sql_top_producto);
$query_top->execute([':id_user' => $id_sesion_actual, ':fecha' => $fecha_hoy]);
$res_top = $query_top->fetch();
$producto_estrella = $res_top['nombre_comida'] ?? "Ninguno";
?>
<div class="container">
    <div class="row mb-4">
        <div class="col-12 text-center">
            <h2 class="fw-bold text-dark">Panel de Operaciones</h2>
            <p class="text-muted">Selecciona una opción para comenzar el servicio</p>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-6 col-md-4">
            <a href="menu/index.php" class="text-decoration-none">
                <div class="card card-menu p-4 shadow-sm h-100">
                    <div class="icon-box bg-light-blue">
                        <i class="bi bi-journal-text fs-2"></i>
                    </div>
                    <h5 class="fw-bold text-dark">Menú</h5>
                    <span class="text-muted small">Ver platos</span>
                </div>
            </a>
        </div>

        <div class="col-6 col-md-4">
            <a href="mesas/index.php" class="text-decoration-none">
                <div class="card card-menu p-4 shadow-sm h-100">
                    <div class="icon-box bg-light-green">
                        <i class="bi bi-grid-3x3-gap-fill fs-2"></i>
                    </div>
                    <h5 class="fw-bold text-dark">Mesas</h5>
                    <span class="text-muted small">Disponibilidad</span>
                </div>
            </a>
        </div>

        <div class="col-12 col-md-4">
            <a href="pedidos/pedidos.php" class="text-decoration-none">
                <div class="card card-menu p-4 shadow-sm h-100 border-primary border-2">
                    <div class="icon-box bg-light-orange">
                        <i class="bi bi-receipt fs-2"></i>
                    </div>
                    <h5 class="fw-bold text-dark">Pedidos</h5>
                    <span class="text-muted small">Comandas hoy</span>
                </div>
            </a>
        </div>
    </div>
    <br>
    <br>
<div class="row g-3 mb-4">
    <div class="col-md-2">
        <div class="text-center shadow-sm p-3 bg-white rounded-4 border-bottom border-primary border-4">
            <h4 class="mb-0 fw-bold text-primary"><?php echo $total_atendidas; ?></h4>
            <small class="text-muted text-uppercase" style="font-size: 0.7rem;">Histórico</small>
        </div>
    </div>

    <div class="col-md-2">
        <div class="text-center shadow-sm p-3 bg-white rounded-4 border-bottom border-success border-4">
            <h4 class="mb-0 fw-bold text-success"><?php echo $atendidas_hoy; ?></h4>
            <small class="text-muted text-uppercase" style="font-size: 0.7rem;">Mesas Hoy</small>
        </div>
    </div>

    <div class="col-md-3">
        <div class="text-center shadow-sm p-3 bg-white rounded-4 border-bottom border-info border-4">
            <h4 class="mb-0 fw-bold text-info">$<?php echo number_format($ventas_del_dia, 2); ?></h4>
            <small class="text-muted text-uppercase" style="font-size: 0.7rem;">Ventas de Hoy</small>
        </div>
    </div>

    <div class="col-md-3">
        <div class="text-center shadow-sm p-3 bg-white rounded-4 border-bottom border-warning border-4">
            <h4 class="mb-0 fw-bold text-warning text-truncate" title="<?php echo $producto_estrella; ?>">
                <?php echo $producto_estrella; ?>
            </h4>
            <small class="text-muted text-uppercase" style="font-size: 0.7rem;">Más Vendido</small>
        </div>
    </div>

    <div class="col-md-2">
        <div class="text-center shadow-sm p-3 bg-white rounded-4 border-bottom border-danger border-4">
            <div class="d-flex justify-content-around align-items-center">
                <div>
                    <h4 class="mb-0 fw-bold text-danger"><?php echo $total_pendientes; ?></h4>
                    <small class="text-muted" style="font-size: 0.6rem;">Pend.</small>
                </div>
                <div class="vr"></div>
                <div>
                    <h4 id="clock" class="mb-0 fw-bold text-dark">00:00</h4>
                    <small class="text-muted" style="font-size: 0.6rem;">Hora</small>
                </div>
            </div>
        </div>
    </div>
</div>
    


<script>
    function updateClock() {
        const now = new Date();
        document.getElementById('clock').innerText = now.toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'});
    }
    setInterval(updateClock, 1000);
    updateClock();
</script>

<?php include '../layouts/parte2.php'; ?>