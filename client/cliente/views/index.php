<?php
    //incluimos la verificación de sesión
    include '../layouts/verificacion.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Vista Cliente</h1>
    <a href="<?php echo $URL; ?>/app/controllers/controllers_cliente/logout.php">Cerrar Sesión</a>
</body>
</html>