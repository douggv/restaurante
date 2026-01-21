<?php include '../layouts/verificacion.php'; ?>   
<?php include '../layouts/parte1.php'; ?>    
<?php include '../layouts/nav.php'; ?>

<!-- Menú Section -->
<section class="section-padding">
    <div class="container">
        <div class="section-title text-center mb-5">
            <h2 class="fw-bold">Nuestro Menú</h2>
        </div>
        <div class="row g-4">
            <?php
                $sql = "SELECT * FROM menu WHERE disponible = 1";
                $query = $pdo->prepare($sql);
                $query->execute();
                $platos = $query->fetchAll(PDO::FETCH_ASSOC);
                foreach ($platos as $plato) {
            ?>
            <div class="col-md-6 col-lg-4">
                <div class="card card-menu h-100">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $plato['nombre_comida']; ?></h5>
                        <p class="card-text"><?php echo $plato['descripcion']; ?></p>
                        <p class="price">$<?php echo number_format($plato['precio'], 2); ?></p>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
</section>







<?php include '../layouts/parte2.php'; ?>