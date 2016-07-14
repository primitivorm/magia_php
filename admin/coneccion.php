<?php
$conexion = mysql_connect("$servidor", "$usuario", "$clave")
        or die("Problemas en la conexion");
mysql_select_db("$bdatos", $conexion) or die("Problemas conexion en local");
