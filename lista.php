<?php
    // lista de usuarios 
    // incluimos la configuracion
    include 'app/config.php';

    // llamamos a la tabla usuarios y la almacenamos 
    $sql = "SELECT * FROM clientes";
    $query = $pdo->prepare($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
    <h1>panel Ojeador</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Email</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $query->execute();
                $usuarios = $query->fetchAll(PDO::FETCH_ASSOC);
                foreach($usuarios as $usuario):
            ?>
            <tr>
                <td><?= $usuario['id_cliente'] ?></td>
                <td><?= $usuario['nombre_cliente'] ?></td>
                <td><?= $usuario['email_cliente'] ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>