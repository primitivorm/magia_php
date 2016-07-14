<?php
$pagina = "home";
$accion = "ver";
//$id_contacto 			= mysql_real_escape_string($_GET['id_contacto']);
if (permisos_tiene_permiso($accion, $pagina, $u_grupo) == true) {
    include "home/modelo/index.php";
    include "home/vista/index.php";
} else {
    permisos_sin_permiso($accion,$pagina, $u_login); 
}