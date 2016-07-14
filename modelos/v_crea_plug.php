<?php

$sql = "SHOW COLUMNS FROM $nombrePlugin";
$stmt = $dbh->prepare($sql);
$stmt->execute(array(
    ":tabla" => "$nombrePlugin"
        )
);
$resultados = $stmt->fetchAll();
 



