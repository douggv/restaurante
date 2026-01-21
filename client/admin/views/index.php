<?php include '../layouts/verificacion.php'; ?>
<?php include '../layouts/parte1.php'; ?>

        <div class="container-fluid p-4">
            <div class="row mb-4">
                <div class="col">
                    <h2 class="fw-bold">Gestión de Menú</h2>
                    <p class="text-muted">Panel administrativo de platos.</p>
                </div>
            </div>

            <div class="row g-3 mb-4">
                <div class="col-12 col-sm-6 col-xl-3">
                    <div class="card p-3 bg-primary text-white h-100">
                        <h6>Total Platos</h6>
                        <h3>20</h3>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-xl-3">
                    <div class="card p-3 bg-success text-white h-100">
                        <h6>Disponibles</h6>
                        <h3>20</h3>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-xl-3">
                    <div class="card p-3 bg-warning text-dark h-100">
                        <h6>Categorías</h6>
                        <h3>8</h3>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-xl-3">
                    <div class="card p-3 bg-white h-100 border">
                        <h6>Precio Promedio</h6>
                        <h3>$11.50</h3>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header bg-white py-3">
                    <h5 class="mb-0 text-primary">Platos Recientes</h5>
                </div>
                <div class="card-body p-0"> <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Nombre</th>
                                    <th class="d-none d-md-table-cell">Tipo</th>
                                    <th>Categoría</th>
                                    <th>Precio</th>
                                    <th>Estado</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Hamburguesa Clásica</td>
                                    <td class="d-none d-md-table-cell">Plato Fuerte</td>
                                    <td>Carnes</td>
                                    <td>$12.50</td>
                                    <td><span class="badge bg-success">Disponible</span></td>
                                    <td>
                                        <div class="btn-group">
                                            <button class="btn btn-sm btn-info text-white"><i class="bi bi-pencil"></i></button>
                                            <button class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
<?php include '../layouts/parte2.php'; ?>