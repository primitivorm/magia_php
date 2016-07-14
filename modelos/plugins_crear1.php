<ul>
<?php 

if (isset($_GET['nombrePlugin'])) {
    $nombrePlugin = trim(strtolower($_GET['nombrePlugin']));
    echo "<li>ok: Nombre de plugin: $nombrePlugin</li>"; 
} else {    
    $nombrePlugin = false;
    die("Olvido el nombre del plugin");
}




if(file_exists($path_plugins.'/'.$nombrePlugin)){
   echo "El plugin <b>$path_plugins/$nombrePlugin</b>  YA existe" ; 
    $existe = true;
}
else 
{
    echo "<li>ok: El plugin: $nombrePlugin no existe, puede continuar</li>";
        
    $existe = false;
}


// fin de las verificaciones
// ahora proecemos a crear


if($existe == FALSE){
    // creo el folder
// verificar que solo tenga letras de a-z en minusculas
// talvez guion bajo, medio, 
// de todas maneras el nombre debe ser identico a la tabla de la BD
// caso de no encontrar una conrrespondencia con una de las tablas de la BD
// igual creamos pero tendremos en cuanta para ya no llenar los controladores por defecto 
// talvez crear en un futuro paginas por deecto 


    

if ($nombrePlugin) {

    
    
    $mvc = ['controlador', 'modelos', 'reg', 'vista', 'raiz'];
    
    $t = count($mvc); // cuenta las carpetas

// creo la carpeta con el nombre delplugin
    mkdir("$path_plugins/$nombrePlugin" );
    
    // creo la funcion extendida, solo si no existe    
    if(!file_exists("$path_web/extenciones/funciones/$nombrePlugin.php")){
    crear_fichero("$path_web/extenciones/funciones", "$nombrePlugin.php", "<?php //funciones extendidas de $nombrePlugin");    
    }
    
    
    
    
// si la carpeta existe, registro el nombre del plugin en la base de datos como una pagina
    registrar_pagina_en_bd($nombrePlugin);

// tambien registro el item en el menu    
    registra_item_al_menu($nombrePlugin);
    
// ahora registro el permiso del root en 1111
    registrar_permiso_pagina_grupo('root',"$nombrePlugin",'1111');
    
    // registro el permiso de invitados, 
    registrar_permiso_pagina_grupo('invitados',"$nombrePlugin",'1000');    
    

    // ahora hago una repeticion creando a cada vuelta las carpetas dentro del plugin
    $i = 0; // pongo 1 para no crear elfichero raiz
    while ($i < $t) {
        if ($mvc[$i] != 'raiz') {
            mkdir($path_plugins . './' . $nombrePlugin . '/' . $mvc[$i] . '');
        }


        // dentro de cada carpeta creo los ficheros que cada carpeta debe contenir
        magia_crear_ficheros_dentro_mvc($nombrePlugin, $mvc[$i]);

        $i++;
    }
}

}

?>
</ul>
<hr>