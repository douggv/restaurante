<?php include '../../layouts/verificacion.php'; ?>
<?php include '../../layouts/parte1.php'; ?>
<?php include '../../../../alert.php'; ?>
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h3 class="card-title mb-0"><b>Registrar Nuevo Mesero/a</b></h3>
                </div>
                <div class="card-body">
                    <form action="../../../../app/controllers/controllers_admin/meseros/create.php" method="POST" enctype="multipart/form-data">
                        
                        <input type="hidden" name="id_rol_fk" value="2">

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="nombre">Nombre Completo</label>
                                <input type="text" name="nombre" class="form-control" placeholder="Ej: Juan Pérez" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="email">Correo Electrónico</label>
                                <input type="email" name="email" class="form-control" placeholder="usuario@correo.com" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="telefono">Teléfono</label>
                                <input type="text" 
                                    name="telefono" 
                                    class="form-control" 
                                    placeholder="Ej: 04121234567" 
                                    pattern="\d{11}" 
                                    maxlength="11"
                                    title="Debe ingresar solo números y exactamente 11 dígitos" 
                                    onkeypress="return (event.charCode >= 48 && event.charCode <= 57)"
                                    required>
                                <small class="text-muted">Formato: 11 dígitos numéricos.</small>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="password">Contraseña de Acceso</label>
                                <input type="password" name="password" class="form-control" placeholder="Mínimo 6 caracteres" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label for="imagen">Foto de Perfil</label>
                                <input type="file" name="imagen" class="form-control" accept="image/*">
                                <small class="text-muted">Formatos permitidos: JPG, PNG, JPEG.</small>
                            </div>
                        </div>

                        <hr>

                        <div class="row">
                            <div class="col-md-12">
                                <a href="index.php" class="btn btn-secondary">Cancelar</a>
                                <button type="submit" class="btn btn-primary">Registrar Mesero</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include '../../layouts/parte2.php'; ?>