

<?php
    $sql = "SELECT * FROM menu";
    $query = $pdo->prepare($sql);
    $query->execute();
    $menu = $query->fetchAll(PDO::FETCH_ASSOC);
?>