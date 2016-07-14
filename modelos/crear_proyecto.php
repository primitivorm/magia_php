<?php
$nombreProyecto = "blog"; 

echo "<p>Vamos a crear los ficheros del proyecto</p>"; 
echo "El path_plugins: ". $path_plugins; 
magia_crear_ficheros_en_proyecto($nombreProyecto);



/*
// una vez creado el proyecto, creamos todo lo que es la config base

$p = ["grupos","idiomas","menu","paginas","permisos","usuarios"];

$i =0; 
while ($i < count($p)) {
    
    //plugin_crear($path_plugins, $nombrePlugin, $padre, $label);
   plugin_crear($path_plugins, $p[$i], 'config', $p[$i]);
    echo "<br>"; 
    
    $i++;
}

*/
?>


