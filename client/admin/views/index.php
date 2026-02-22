<?php 
include '../layouts/verificacion.php'; 
include '../layouts/parte1.php'; 

// 1. CONSULTAS PARA LAS CARDS ESTADÍSTICAS
// Total de platos
$query_total = $pdo->prepare("SELECT COUNT(*) FROM menu");
$query_total->execute();
$total_platos = $query_total->fetchColumn();

// Categorías únicas
$query_cat = $pdo->prepare("SELECT COUNT(DISTINCT categoria) FROM menu");
$query_cat->execute();
$total_categorias = $query_cat->fetchColumn();

// Precio promedio
$query_avg = $pdo->prepare("SELECT AVG(precio) FROM menu");
$query_avg->execute();
$precio_promedio = number_format($query_avg->fetchColumn(), 2);

// 2. CONSULTA PARA LA TABLA
$query_menu = $pdo->prepare("SELECT * FROM menu ORDER BY id_comida DESC");
$query_menu->execute();
$platos = $query_menu->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="container-fluid p-4">
    <div class="row mb-4 align-items-center">
        <div class="col-md-6">
            <h2 class="fw-bold"><i class="bi bi-egg-fried text-primary"></i> Gestión de Menú</h2>
            <p class="text-muted">Administra la oferta gastronómica en tiempo real.</p>
        </div>
        <div class="col-md-6 text-md-end">
            <button class="btn btn-primary shadow-sm" data-bs-toggle="modal" data-bs-target="#modalNuevoPlato">
                <i class="bi bi-plus-lg"></i> Agregar Nuevo Plato
            </button>
        </div>
    </div>

    <div class="row g-3 mb-4">
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card p-3 border-0 shadow-sm bg-primary text-white h-100">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="mb-1 opacity-75">Total Platos</h6>
                        <h3 class="fw-bold mb-0"><?php echo $total_platos; ?></h3>
                    </div>
                    <i class="bi bi-list-stars fs-1 opacity-50"></i>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card p-3 border-0 shadow-sm bg-success text-white h-100">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="mb-1 opacity-75">Categorías</h6>
                        <h3 class="fw-bold mb-0"><?php echo $total_categorias; ?></h3>
                    </div>
                    <i class="bi bi-tags fs-1 opacity-50"></i>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card p-3 border-0 shadow-sm bg-info text-white h-100">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="mb-1 opacity-75">Precio Promedio</h6>
                        <h3 class="fw-bold mb-0">$<?php echo $precio_promedio; ?></h3>
                    </div>
                    <i class="bi bi-currency-dollar fs-1 opacity-50"></i>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card p-3 border-0 shadow-sm bg-dark text-white h-100">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="mb-1 opacity-75">Última Actualización</h6>
                        <h3 class="fw-bold mb-0" style="font-size: 1.2rem;"><?php echo date('d/m/Y'); ?></h3>
                    </div>
                    <i class="bi bi-clock-history fs-1 opacity-50"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
            <h5 class="mb-0 fw-bold text-primary">Listado de Platos</h5>
            <div class="input-group style="width: 300px;">
                <span class="input-group-text bg-light border-0"><i class="bi bi-search"></i></span>
                <input type="text" id="buscadorMenu" class="form-control bg-light border-0" placeholder="Buscar plato o categoría...">
            </div>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0" id="tablaMenu">
                    <thead class="table-light">
                        <tr>
                            <th class="ps-4">Plato</th>
                            <th>Tipo</th>
                            <th>Categoría</th>
                            <th>Precio</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($platos as $plato): ?>
                        <tr>
                            <td class="ps-4">
                                <div class="fw-bold"><?php echo $plato['nombre_comida']; ?></div>
                            </td>
                            <td>
                                <span class="badge bg-light text-dark border">
                                    <?php echo $plato['tipo']; ?>
                                </span>
                            </td>
                            <td>
                                <span class="text-primary fw-semibold">
                                    <i class="bi bi-tag-fill me-1"></i><?php echo $plato['categoria']; ?>
                                </span>
                            </td>
                            <td class="fw-bold text-success">
                                $<?php echo number_format($plato['precio'], 2); ?>
                            </td>
                            <td>
                                <div class="btn-group">
                                    <a href="menu/update.php?id=<?php echo $plato['id_comida']; ?>" class="btn btn-sm btn-outline-info">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
document.getElementById('buscadorMenu').addEventListener('keyup', function() {
    let filtro = this.value.toLowerCase();
    let filas = document.querySelectorAll('#tablaMenu tbody tr');
    
    filas.forEach(fila => {
        let texto = fila.innerText.toLowerCase();
        fila.style.display = texto.includes(filtro) ? '' : 'none';
    });
});

function eliminarPlato(id) {
    Swal.fire({
        title: '¿Estás seguro?',
        text: "Esta acción no se puede deshacer",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Sí, eliminar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = "../../app/controllers/controllers_admin/menu/delete.php?id=" + id;
        }
    })
}
</script>

<?php include '../layouts/parte2.php'; ?>