<?php

$sql = "SHOW COLUMNS FROM $tabla";
$stmt = $dbh->prepare($sql);
$stmt->execute(array(
    ":tabla" => "$tabla"
        )
);
$resultado = $stmt->fetchAll();
?>   



