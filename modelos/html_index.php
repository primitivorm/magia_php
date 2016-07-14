<?php

$sql = "SHOW FULL TABLES";
$stmt = $dbh->prepare($sql);
$stmt->execute(array(
        // ":id_personal"=>"$u_id_personal"
        )
);
$resultado = $stmt->fetchAll();
?>   