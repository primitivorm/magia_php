<?php

$busqueda = mysql_real_escape_string($_GET['busqueda']);

$sql = "SHOW FULL TABLES";
$stmt = $dbh->prepare($sql);
$stmt->execute(array(
    ":nombres" => "$busqueda"
        )
);
$resultado = $stmt->fetchAll();
?>   

