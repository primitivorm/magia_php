<?php
$fp = fopen('admin/bd.php', 'w');
$c = '<?php '; 
$c .= ' $servidor = "'.$_GET['servidor'].'";';
$c .= ' $bdatos = "'.$_GET['bdatos'].'";';
$c .= ' $usuario = "'.$_GET['usuario'].'";';
$c .= ' $clave = "'.$_GET['clave'].'";';
fwrite($fp, $c);
fclose($fp);
?>


