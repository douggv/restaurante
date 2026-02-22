<?php include '../../layouts/verificacion.php'; 

// 2. CONSULTA DE DATOS (Asegúrate de que los nombres de tablas y campos coincidan con tu BD)
try {
    $sql = "SELECT r.*, c.nombre_cliente, m.nro_mesa 
            FROM reservas as r 
            INNER JOIN clientes as c ON r.id_cliente_fk = c.id_cliente 
            INNER JOIN mesas as m ON r.id_mesa_fk = m.id_mesa 
            ORDER BY r.fecha_reserva DESC";
    $query = $pdo->prepare($sql);
    $query->execute();
    $reservas = $query->fetchAll(PDO::FETCH_ASSOC);
} catch (Exception $e) {
    die("Error en la consulta: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte de Reservas - <?php echo date('d-m-Y'); ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f4f4f4; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        .report-container { background-color: white; padding: 40px; margin-top: 30px; border-radius: 8px; box-shadow: 0 0 20px rgba(0,0,0,0.1); }
        .header-logo { border-bottom: 3px solid #0d6efd; padding-bottom: 20px; margin-bottom: 30px; }
        
        /* Estilos específicos para generar el PDF al imprimir */
        @media print {
            .no-print { display: none !important; }
            body { background-color: white; }
            .report-container { box-shadow: none; margin-top: 0; padding: 0; width: 100% !important; }
            .table thead { background-color: #333 !important; color: white !important; -webkit-print-color-adjust: exact; }
        }
    </style>
</head>
<body>

<div class="container no-print mt-4 text-center">
    <button onclick="window.print();" class="btn btn-danger btn-lg shadow">
        <i class="bi bi-file-pdf"></i> DESCARGAR / IMPRIMIR PDF
    </button>
    <a href="javascript:window.close();" class="btn btn-secondary btn-lg shadow">CERRAR</a>
</div>

<div class="container report-container">
    <div class="header-logo d-flex justify-content-between align-items-center">
        <div>
            <h1 class="text-primary fw-bold">REPORTE DE RESERVAS</h1>
            <p class="text-muted mb-0">Sistema de Gestión de Restaurante</p>
        </div>
        <div class="text-end">
            <h5 class="mb-0">Fecha: <?php echo date('d/m/Y'); ?></h5>
            <p class="small text-muted">Hora: <?php echo date('H:i:s'); ?></p>
        </div>
    </div>

    <table class="table table-bordered align-middle">
        <thead class="table-dark">
            <tr>
                <th>Evento</th>
                <th>Fecha Reserva</th>
                <th>Horario (Inicio - Fin)</th>
                <th>Mesa</th>
                <th>Cliente</th>
                <th class="text-center">Estado</th>
            </tr>
        </thead>
        <tbody>
            <?php if (count($reservas) > 0): ?>
                <?php foreach ($reservas as $reserva): ?>
                <tr>
                    <td><strong><?php echo htmlspecialchars($reserva['titulo_evento']); ?></strong></td>
                    <td><?php echo date('d/m/Y', strtotime($reserva['fecha_reserva'])); ?></td>
                    <td><?php echo $reserva['hora_inicio'] . " - " . $reserva['hora_fin']; ?></td>
                    <td>Mesa #<?php echo $reserva['nro_mesa']; ?></td>
                    <td><?php echo htmlspecialchars($reserva['nombre_cliente']); ?></td>
                    <td class="text-center">
                        <span class="badge <?php 
                            echo ($reserva['estado_reserva'] == 'Confirmada') ? 'bg-success' : 
                                 (($reserva['estado_reserva'] == 'Negada') ? 'bg-danger' : 'bg-warning text-dark'); 
                        ?>">
                            <?php echo strtoupper($reserva['estado_reserva']); ?>
                        </span>
                    </td>
                </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="6" class="text-center">No se encontraron reservas registradas.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <div class="mt-5 row">
        <div class="col-6 text-center">
            <div style="border-top: 1px solid #ccc; width: 200px; margin: 0 auto; margin-top: 50px;"></div>
            <p class="small">Firma Administrador</p>
        </div>
        <div class="col-6 text-center text-muted">
            <p class="small mt-5">Este documento es un reporte oficial generado por el sistema.</p>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>