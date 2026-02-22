<?php 
include '../../layouts/verificacion.php'; 
include '../../layouts/parte1.php'; 

// --- LÓGICA DE FILTRADO Y PAGINACIÓN ---
$filtro = isset($_GET['filtro']) ? $_GET['filtro'] : 'todos';
$pagina = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
$registros_por_pagina = 10;
$inicio = ($pagina > 1) ? ($pagina * $registros_por_pagina) - $registros_por_pagina : 0;

$where = "";
if ($filtro == 'hoy') {
    $where = "WHERE DATE(c.fyh_creacion) = CURDATE()";
} elseif ($filtro == 'mes') {
    $where = "WHERE MONTH(c.fyh_creacion) = MONTH(CURDATE()) AND YEAR(c.fyh_creacion) = YEAR(CURDATE())";
}

try {
    // Consulta para contar total (para paginación)
    $total_sql = "SELECT COUNT(*) FROM control c $where";
    $total_registros = $pdo->query($total_sql)->fetchColumn();
    $total_paginas = ceil($total_registros / $registros_por_pagina);

    // Consulta Principal
    $sql = "SELECT c.id_control, c.total_pagar, c.fyh_creacion, u.nombre AS nombre_responsable, u.imagen AS imagen_responsable, m.nro_mesa
            FROM control c
            INNER JOIN pedidos p ON c.id_pedido_fk = p.id_pedido
            INNER JOIN usuarios u ON c.id_usuario_fk = u.id_usuario
            INNER JOIN mesas m ON p.id_mesa_fk = m.id_mesa
            $where
            ORDER BY c.id_control DESC
            LIMIT $inicio, $registros_por_pagina";

    $query = $pdo->prepare($sql);
    $query->execute();
    $controles = $query->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>

<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css">

<div class="container-fluid py-4">
    <div class="row mb-4">
        <div class="col-12">
            <div class="card shadow-sm border-0 bg-white p-4">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <h2 class="fw-bold mb-0 text-dark"><i class="fas fa-file-invoice-dollar text-success me-2"></i>Reporte de Ventas</h2>
                        <p class="text-muted mb-0">Control de ingresos y despachos finalizados.</p>
                    </div>
                    <div class="col-md-6 text-md-end mt-3 mt-md-0">
                        <div class="btn-group shadow-sm">
                            <a href="?filtro=hoy" class="btn btn-<?php echo $filtro == 'hoy' ? 'primary' : 'outline-primary'; ?>">Hoy</a>
                            <a href="?filtro=mes" class="btn btn-<?php echo $filtro == 'mes' ? 'primary' : 'outline-primary'; ?>">Mes</a>
                            <a href="?filtro=todos" class="btn btn-<?php echo $filtro == 'todos' ? 'primary' : 'outline-primary'; ?>">Todo</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card border-0 shadow-sm" style="border-radius: 15px;">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table id="tabla_control" class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="ps-4">ID Control</th>
                            <th>Fecha</th>
                            <th>Hora</th>
                            <th>Mesa</th>
                            <th>Cerrado por</th>
                            <th class="text-end pe-4">Total de Venta</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($controles as $reg): ?>
                            <tr>
                                <td class="ps-4 fw-bold text-primary">#<?php echo $reg['id_control']; ?></td>
                                <td><?php echo date('d/m/Y', strtotime($reg['fyh_creacion'])); ?></td>
                                <td class="text-muted"><?php echo date('H:i A', strtotime($reg['fyh_creacion'])); ?></td>
                                <td><span class="badge bg-light text-dark border">Mesa <?php echo $reg['nro_mesa']; ?></span></td>
                                <td>
                                    <img src="../../../../public/assets/img/meseros/<?php echo !empty($reg['imagen_responsable']) ? $reg['imagen_responsable'] : 'default.png'; ?>" class="rounded-circle me-1" width="25" height="25">
                                    <small><?php echo $reg['nombre_responsable']; ?></small>
                                </td>
                                <td class="text-end pe-4 fw-bold text-success">$<?php echo number_format($reg['total_pagar'], 2); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <nav class="mt-4">
        <ul class="pagination justify-content-center">
            <?php for($i=1; $i<=$total_paginas; $i++): ?>
                <li class="page-item <?php echo ($pagina == $i) ? 'active' : ''; ?>">
                    <a class="page-link" href="?pagina=<?php echo $i; ?>&filtro=<?php echo $filtro; ?>"><?php echo $i; ?></a>
                </li>
            <?php endfor; ?>
        </ul>
    </nav>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>

<script>
$(document).ready(function() {
    $('#tabla_control').DataTable({
        "paging": false, // Usamos la paginación de PHP
        "info": false,
        "searching": true,
        "dom": 'Bfrtip',
        "buttons": [
            {
                extend: 'pdfHtml5',
                text: '<i class="fas fa-file-pdf"></i> Descargar PDF',
                className: 'btn btn-danger mb-3',
                title: 'Reporte de Control de Ventas - <?php echo ucfirst($filtro); ?>'
            }
        ],
        "language": { "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json" }
    });
});
</script>

<?php include '../../layouts/parte2.php'; ?>