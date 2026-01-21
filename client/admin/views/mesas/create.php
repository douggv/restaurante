<?php include '../../layouts/verificacion.php'; ?>
<?php include '../../layouts/parte1.php'; ?>
<style>
        body { font-family: 'Inter', sans-serif; background-color: #f8f9fa; }
        .card { border: none; border-radius: 15px; }
        .form-label { font-weight: 600; color: #495057; }
        .input-group-text { border-right: none; background-color: #fff; }
        .form-control, .form-select { border-left: none; }
        .form-control:focus, .form-select:focus { box-shadow: none; border-color: #dee2e6; }
    </style>
<div class="container py-5">
    <div class="row mb-4">
        <div class="col-md-8 mx-auto d-flex justify-content-between align-items-center">
            <div>
                <h2 class="fw-bold mb-0">Nueva Mesa</h2>
                <p class="text-muted">Completa los datos para registrar una mesa en el sistema.</p>
            </div>
            <a href="gestion_mesas.php" class="btn btn-outline-secondary shadow-sm">
                <i class="bi bi-arrow-left me-2"></i>Volver
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="card shadow-sm p-4">
                <form action="<?php echo $URL; ?>/app/controllers/controllers_admin/mesas/create.php" method="POST">
                    <div class="row g-4">
                        
                        <div class="col-md-6">
                            <label for="nro_mesa" class="form-label">Número de Mesa</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-hash text-primary"></i></span>
                                <input min="1" type="number" class="form-control" id="nro_mesa" name="nro_mesa" placeholder="Ejemplo: 12" required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label for="sillas" class="form-label">Cantidad de Sillas</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-people text-primary"></i></span>
                                <input min="1" type="number" class="form-control" id="sillas" name="sillas" placeholder="Ejemplo: 4" required>
                            </div>
                        </div>

                        <div class="col-12">
                            <label for="tipo" class="form-label">Tipo de Mesa</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-star-fill text-primary"></i></span>
                                <select class="form-select" id="tipo" name="tipo" required>
                                    <option value="" selected disabled>Selecciona el tipo de servicio...</option>
                                    <option value="basica">Básica</option>
                                    <option value="premium">Premium</option>
                                </select>
                            </div>
                            <div class="form-text mt-2">
                                * Las mesas <strong>Premium</strong> suelen tener una ubicación preferencial.
                            </div>
                        </div>

                        <div class="col-12 mt-5">
                            <hr class="text-muted opacity-25">
                            <div class="d-flex justify-content-end gap-2">
                                <button type="reset" class="btn btn-light px-4">Limpiar</button>
                                <button type="submit" class="btn btn-primary px-5 fw-bold shadow">
                                    <i class="bi bi-save me-2"></i>Registrar Mesa
                                </button>
                            </div>
                        </div>

                    </div>
                </form>
                </div>
        </div>
    </div>
</div>


<?php include '../../layouts/parte2.php'; ?>