<h1 class="page-header">
</span> <a href="?p=magia">/</a><?php echo "$tabla"; ?>/controlador/ver.php
</h1>

<textarea class="form-control" rows="20">
&lt;?php
$pagina = "<?php echo $tabla ?>";
//include 'header.php';
include "<?php echo "$path_magia_plugins/$tabla";  ?>/funciones.php";
if (permisos_tiene_permiso('ver', '<?php echo $tabla; ?>', $u_grupo)) {
    $id 		= mysql_real_escape_string($_REQUEST['id']);     
    include "<?php echo "$path_magia_plugins/$tabla"; ?>/modelos/ver.php";
    include "<?php echo "$path_magia_plugins/$tabla"; ?>/reg/reg.php";
    include "<?php echo "$path_magia_plugins/$tabla"; ?>/vista/ver.php";
} else {
    permisos_sin_permiso('ver', '<?php echo $tabla ?>', $u_id_usuario);
}

</textarea>