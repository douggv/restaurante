<?php 
include '../../layouts/verificacion.php'; 
include '../../layouts/parte1.php'; 

// Fecha de hoy para la comparación
$fecha_hoy = date('Y-m-d');
?>
<?php include '../../../../alert.php'; ?>


<div class="container py-4">
    <div class="row mb-4 align-items-center">
        <div class="col-12 d-flex align-items-center">
            <a href="../index.php" class="btn btn-light shadow-sm me-3" style="border-radius: 10px;">
                <i class="bi bi-arrow-left-circle-fill text-primary"></i> Regresar
            </a>
            <h2 class="fw-bold mb-0">Selección de Mesas</h2>
        </div>
    </div>

    <div class="row g-4">
        <?php
        // Consulta: Unimos mesas con sus reservas de HOY (si existen)
        // Usamos LEFT JOIN para traer todas las mesas aunque no tengan reserva
        $sql_mesas = "SELECT m.*, 
                            r.titulo_evento, r.hora_inicio, r.hora_fin, r.estado_reserva
                     FROM mesas m 
                     LEFT JOIN reservas r ON m.id_mesa = r.id_mesa_fk 
                                         AND r.fecha_reserva = :fecha_hoy 
                                         AND r.estado_reserva = 'pendiente'
                     ORDER BY m.nro_mesa ASC";

        
        $query_mesas = $pdo->prepare($sql_mesas);
        $query_mesas->bindParam(':fecha_hoy', $fecha_hoy);
        $query_mesas->execute();
        $mesas = $query_mesas->fetchAll(PDO::FETCH_ASSOC);

        foreach($mesas as $mesa) {
            $id_mesa = $mesa['id_mesa'];
            $nro_mesa = $mesa['nro_mesa'];
            $capacidad = $mesa['sillas'];
            
            // Verificamos si hay una reserva activa para hoy basándonos en si trajo datos de la reserva
            $tiene_reserva_hoy = !empty($mesa['hora_inicio']);

            if ($tiene_reserva_hoy) {
                $clase_card = "border-warning bg-white";
                $text_color = "text-warning";
                $info_reserva = "<b>RESERVADA:</b><br>" . 
                                $mesa['titulo_evento'] . "<br>" . 
                                date("H:i", strtotime($mesa['hora_inicio'])) . " a " . 
                                date("H:i", strtotime($mesa['hora_fin']));
            } else {
                $clase_card = "border-success bg-white";
                $text_color = "text-success";
                $info_reserva = "<span class='text-muted'>Sin reservas para hoy</span>";
            }
        ?>
            <div class="col-6 col-md-4 col-lg-3">
                <a href="../pedidos/create.php?id_mesa=<?php echo $id_mesa; ?>" class="text-decoration-none">
                    <div class="card h-100 shadow-sm border-2 card-mesa <?php echo $clase_card; ?>" style="border-radius: 15px; transition: 0.3s;">
                        <div class="card-body text-center p-3">
                            <div class="small fw-bold text-secondary mb-1">MESA</div>
                            <h2 class="display-6 fw-bold mb-0 <?php echo $text_color; ?>">
                                <?php echo $nro_mesa; ?>
                            </h2>
                            <p class="small text-muted mb-2"><?php echo $mesa['tipo']; ?> (<?php echo $capacidad; ?> sillas)</p>
                            
                            <div class="alert <?php echo $tiene_reserva_hoy ? 'alert-warning' : 'alert-light'; ?> p-2 mb-0" style="font-size: 0.85rem; border-radius: 10px;">
                                <?php echo $info_reserva; ?>
                            </div>
                            
                            <div class="mt-3">
                                <span class="btn btn-sm <?php echo $tiene_reserva_hoy ? 'btn-warning' : 'btn-primary'; ?> w-100 rounded-pill">
                                    Seleccionar
                                </span>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        <?php } ?>
    </div>
</div>

<style>
    .card-mesa:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 15px rgba(0,0,0,0.1) !important;
    }
</style>

<?php include '../../layouts/parte2.php'; ?>