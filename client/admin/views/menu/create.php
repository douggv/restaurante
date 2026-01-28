<?php include '../../layouts/verificacion.php'; ?>
<?php include '../../layouts/parte1.php'; ?>
    



<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Registrar Nuevo Plato</h1>
            </div>
        </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-10">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Llene los datos con cuidado</h3>
                    </div>
                    <div class="card-body">
                        <form action="../../../../app/controllers/controllers_admin/platos/create.php" method="POST">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nombre_comida">Nombre del Plato</label>
                                        <input type="text" name="nombre_comida" class="form-control" placeholder="Ej: Pizza Napolitana" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="tipo">Tipo</label>
                                        <input type="text" name="tipo" class="form-control" placeholder="Ej: Fuerte, Entrada" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="categoria">Categoría</label>
                                        <select name="categoria" class="form-control" required>
                                            <option value="" disabled selected>Seleccione una...</option>
                                            <option value="Comida Rápida">Comida Rápida</option>
                                            <option value="Bebidas">Bebidas</option>
                                            <option value="Postres">Postres</option>
                                            <option value="Especialidades">Especialidades</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="precio">Precio</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">$</span>
                                            </div>
                                            <input type="number" step="0.01" name="precio" class="form-control" placeholder="0.00" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="disponible">¿Está Disponible?</label>
                                        <select name="disponible" class="form-control" required>
                                            <option value="1">Sí, disponible ahora</option>
                                            <option value="0">No, agotado</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="descripcion">Descripción del Plato</label>
                                        <textarea name="descripcion" rows="3" class="form-control" placeholder="Ingredientes, alérgenos o detalles extra..."></textarea>
                                    </div>
                                </div>
                            </div>

                            <hr>

                            <div class="row">
                                <div class="col-md-12">
                                    <a href="index.php" class="btn btn-secondary">Cancelar</a>
                                    <button type="submit" class="btn btn-primary">Guardar Registro</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>



<?php include '../../layouts/parte2.php'; ?>