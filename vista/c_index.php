<h1 class="page-header">
</span> <a href="?p=magia">/</a><?php echo "$tabla"; ?>/controlador/index.php
</h1>

<textarea class="form-control" rows="20">
&lt;?php
$accion = "ver";
$pagina = "<?php echo $tabla;  ?>";
if (permisos_tiene_permiso($accion, '<?php echo $tabla;  ?>', $u_grupo)) {
    include "<?php echo "$tabla";  ?>/modelos/index.php";
    include "<?php echo "$tabla";  ?>/vista/index.php";
} else {
    permisos_sin_permiso($aacion, '<?php echo $tabla;  ?>', $u_id_usuario);
}
</textarea>
