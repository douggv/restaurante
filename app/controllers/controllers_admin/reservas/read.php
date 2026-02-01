

<?php
    $sql = "SELECT * FROM reservas
    inner join mesas on reservas.id_mesa_fk = mesas.id_mesa
    inner join clientes on reservas.id_cliente_fk = clientes.id_cliente";
    $query = $pdo->prepare($sql);
    $query->execute();
    $reservas = $query->fetchAll(PDO::FETCH_ASSOC); 
?>