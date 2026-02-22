<?php
include '../../../../app/config.php'; // Tu conexión PDO

// Consulta de meseros
$sql = "SELECT * FROM usuarios WHERE id_rol_fk = '2'";
$query = $pdo->prepare($sql);
$query->execute();
$usuarios = $query->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reporte de Meseros - <?php echo APP_NAME; ?></title>
    <style>
        /* Estilos para pantalla */
        body { font-family: Arial, sans-serif; padding: 30px; color: #333; }
        .btn-imprimir { 
            background: #007bff; color: white; padding: 10px 20px; 
            border: none; border-radius: 5px; cursor: pointer; margin-bottom: 20px;
        }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 12px; text-align: left; }
        th { background-color: #f4f4f4; }
        .header { text-align: center; margin-bottom: 40px; }
        
        /* ESTILOS DE IMPRESIÓN (Aquí ocurre la magia) */
        @media print {
            .btn-imprimir { display: none; } /* Oculta el botón al imprimir */
            body { padding: 0; }
            table { border: 1px solid #000; }
            th { background-color: #eee !important; color: #000; }
        }
    </style>
</head>
<body>

    <button class="btn-imprimir" onclick="window.print();">
        Confirmar y Guardar como PDF
    </button>

    <div class="header">
        <h1><?php echo APP_NAME; ?></h1>
        <h2>Reporte Oficial de Personal (Meseros)</h2>
        <p>Generado el: <?php echo date('d/m/Y H:i:s'); ?></p>
    </div>

    <table>
        <thead>
            <tr>
                <th>Nro</th>
                <th>Nombre Completo</th>
                <th>Correo Electrónico</th>
                <th>Teléfono</th>
                <th>Fecha de Registro</th>
                <th>Imagen</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $contador = 0;
            foreach ($usuarios as $usuario) { 
                $contador++;
            ?>
            <tr>
                <td><?php echo $contador; ?></td>
                <td><?php echo $usuario['nombre']; ?></td>
                <td><?php echo $usuario['email']; ?></td>
                <td><?php echo $usuario['telefono']; ?></td>
                <td><?php echo date('d/m/Y', strtotime($usuario['fecha_creacion'])); ?></td>
                <td><img src="../../../../public/assets/img/meseros/<?php echo $usuario['imagen']; ?>" width="50px" height="50px" alt="Imagen de Mesero"></td>
            </tr>
            <?php } ?>
        </tbody>
    </table>

    <script>
        // Opcional: Abre el cuadro de impresión automáticamente al cargar
        window.onload = function() {
            // window.print(); 
        }
    </script>
</body>
</html>