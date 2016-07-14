
<?php 

if (isset($_GET['nombrePlugin'])) {
    $nombrePlugin = trim(strtolower($_GET['nombrePlugin']));
} else {
    $nombrePlugin = false;
}

if(file_exists($path_magia_plugins.'/'.$nombrePlugin)){
   echo "El plugin <b>$path_magia_plugins/$nombrePlugin</b>  existe" ; 
    $existe = true;
}
else 
{
    echo "El fichero $path_magia_plugins/$nombrePlugin no existe" ; 
    $existe = false;
}

if($existe == FALSE){
    // creo el folder
    echo "ok"; 

// verificar que solo tenga letras de a-z en minusculas
// talvez guion bajo, medio, 
// de todas maneras el nombre debe ser identico a la tabla de la BD
// caso de no encontrar una conrrespondencia con una de las tablas de la BD
// igual creamos pero tendremos en cuanta para ya no llenar los controladores por defecto 
// talvez crear en un futuro paginas por deecto 


    

if ($nombrePlugin) {
    $mvc = ['controlador', 'modelos', 'reg', 'vista', 'raiz'];
    
    $t = count($mvc); // cuenta las carpetas

// creo la carpeta conel nombre delplugin
    mkdir($path_magia_plugins . '/' . $nombrePlugin );

    // ahora hago una repeticion creando a cada vuelta las carpetas dentro del plugin
    $i = 0; // pongo 1 para no crear elfichero raiz
    while ($i < $t) {
        if ($mvc[$i] != 'raiz') {
            mkdir($path_magia_plugins . './' . $nombrePlugin . '/' . $mvc[$i] . '');
        }


        // dentro de cada carpeta creo los ficheros que cada carpeta debe contenir
        magia_crear_ficheros_dentro_mvc($nombrePlugin, $mvc[$i]);

        $i++;
    }
}

}

