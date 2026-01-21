

<?php
    $sql = "SELECT * FROM mesas";
    $query = $pdo->prepare($sql);
    $query->execute();
    $mesas = $query->fetchAll(PDO::FETCH_ASSOC);
?>