<?php include '../../../config.php'; ?>
<?php include 'read.php'; ?>

<?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $nro_mesa = $_POST['nro_mesa'];
        $sillas = $_POST['sillas'];
        $estado = "disponible";
        $tipo = $_POST['tipo'];

        $sql = "INSERT INTO mesas (nro_mesa, sillas, estado, tipo) VALUES (:nro_mesa, :sillas, :estado, :tipo)";
        $query = $pdo->prepare($sql);
        $query->bindParam(':nro_mesa', $nro_mesa);
        $query->bindParam(':sillas', $sillas);
        $query->bindParam(':estado', $estado);
        $query->bindParam(':tipo', $tipo);
        $query->execute();
        if ($query) {
            session_start();
            $_SESSION['mensaje'] = "Mesa creada exitosamente.";
            $_SESSION['color'] = "alert-success";
        } else {
            session_start();
            $_SESSION['mensaje'] = "Error al crear la mesa. Por favor, intenta nuevamente.";
            $_SESSION['color'] = "alert-danger";
        }
        header('Location: ' . $URL . '/client/admin/views/mesas/index.php');
        
        
        exit();
    }
?>