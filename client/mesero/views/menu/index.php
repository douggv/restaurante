<?php 
include '../../layouts/verificacion.php'; 
include '../../layouts/parte1.php'; 
?>

<div class="container py-4">
    <div class="row mb-4 align-items-center">
        <div class="col-md-6 d-flex align-items-center">
            <a href="../index.php" class="btn btn-light shadow-sm me-3" style="border-radius: 10px;">
                <i class="bi bi-arrow-left-circle-fill text-primary"></i> Regresar
            </a>
            <h2 class="fw-bold mb-0"><i class="bi bi-journal-richtext text-primary"></i> Carta del Menú</h2>
        </div>
        <div class="col-md-6 mt-3 mt-md-0">
            <div class="input-group shadow-sm">
                <span class="input-group-text bg-white border-end-0"><i class="bi bi-search"></i></span>
                <input type="text" id="searchInput" class="form-control border-start-0" placeholder="Buscar plato o bebida...">
            </div>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-12">
            <ul class="nav nav-pills nav-fill bg-white p-2 rounded shadow-sm" id="categoryFilters">
                <li class="nav-item">
                    <button class="nav-link active" data-filter="all">Todos</button>
                </li>
                <?php
                // Obtenemos las categorías únicas de la base de datos
                $sql_cat = "SELECT DISTINCT categoria FROM menu";
                $query_cat = $pdo->prepare($sql_cat);
                $query_cat->execute();
                $categorias = $query_cat->fetchAll(PDO::FETCH_ASSOC);
                foreach($categorias as $cat) {
                    echo '<li class="nav-item">
                            <button class="nav-link" data-filter="'.strtolower($cat['categoria']).'">'.$cat['categoria'].'</button>
                          </li>';
                }
                ?>
            </ul>
        </div>
    </div>

    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0" id="menuTable">
                    <thead class="bg-light">
                        <tr>
                            <th class="ps-4">Plato / Bebida</th>
                            <th>Tipo</th>
                            <th>Categoría</th>
                            <th>Precio</th>
                            <th class="text-center">Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql_menu = "SELECT * FROM menu ORDER BY categoria ASC, nombre_comida ASC";
                        $query_menu = $pdo->prepare($sql_menu);
                        $query_menu->execute();
                        $items = $query_menu->fetchAll(PDO::FETCH_ASSOC);

                        foreach($items as $item) {
                            $disponible = $item['disponible'];
                            $clase_disponible = ($disponible == 1) ? 'bg-success' : 'bg-secondary';
                            $texto_disponible = ($disponible == 1) ? 'Disponible' : 'Agotado';
                            $filtro_cat = strtolower($item['categoria']);
                        ?>
                        <tr class="menu-item" data-category="<?php echo $filtro_cat; ?>">
                            <td class="ps-4">
                                <div class="fw-bold text-dark"><?php echo $item['nombre_comida']; ?></div>
                                <small class="text-muted d-block"><?php echo $item['descripcion']; ?></small>
                            </td>
                            <td><span class="badge bg-light text-dark border"><?php echo $item['tipo']; ?></span></td>
                            <td><span class="text-uppercase small fw-bold"><?php echo $item['categoria']; ?></span></td>
                            <td class="fw-bold text-primary">$<?php echo number_format($item['precio'], 2); ?></td>
                            <td class="text-center">
                                <span class="badge rounded-pill <?php echo $clase_disponible; ?> px-3">
                                    <?php echo $texto_disponible; ?>
                                </span>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    // Buscador por Texto
    document.getElementById('searchInput').addEventListener('keyup', function() {
        let value = this.value.toLowerCase();
        let rows = document.querySelectorAll('#menuTable tbody tr');
        
        rows.forEach(row => {
            let text = row.textContent.toLowerCase();
            row.style.display = text.includes(value) ? '' : 'none';
        });
    });

    // Filtro por Botones de Categoría
    const filterButtons = document.querySelectorAll('#categoryFilters .nav-link');
    filterButtons.forEach(btn => {
        btn.addEventListener('click', function() {
            // Cambiar estado activo de botones
            filterButtons.forEach(b => b.classList.remove('active'));
            this.classList.add('active');

            let filter = this.getAttribute('data-filter');
            let rows = document.querySelectorAll('.menu-item');

            rows.forEach(row => {
                if (filter === 'all' || row.getAttribute('data-category') === filter) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
    });
</script>

<?php include '../../layouts/parte2.php'; ?>