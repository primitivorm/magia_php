<?php
$icon_ok = '<span class="glyphicon glyphicon-ok"></span>'; 
$icon_error = '<span class="glyphicon glyphicon-remove"></span>'; 
$icon_carpeta_cerrada = '<span class="glyphicon glyphicon-folder-close"></span>'; 
$icon_carpeta_abierta = '<span class="glyphicon glyphicon-folder-open"></span>'; 
$icon_fichero = '<span class="glyphicon glyphicon-file"></span>'; 
$icon_fichero_copiar = '<span class="glyphicon glyphicon-copy"></span>'; 


function muestra_errores($d, $f, $l) {
    echo "<pre>";
    echo "Documento: $d <br>";
    echo "Funcion: $f <br>";
    echo "Linea: $l <br>";
    echo "</pre>";
}


function plugin_crear($path_plugins, $nombrePlugin, $padre, $label) {
    global $path_web;
    // verifico si el nombre existe
    // verifico que la carpeta de plugins existe $path_plugins 


    if ($nombrePlugin) {

        echo "<h3>1020 Dentro de plugin crear: <br>$path_plugins</h3>";


        $mvc = ['controlador', 'modelos', 'reg', 'vista', 'raiz'];

        $t = count($mvc); // cuenta las carpetas
        crear_carpeta("$path_plugins", "$nombrePlugin");
        crear_fichero("$path_web/extenciones/funciones", "$nombrePlugin.php", "<?php //funciones extendidas de $nombrePlugin");





// si la carpeta existe, registro el nombre del plugin en la base de datos como una pagina
        registrar_pagina_en_bd($nombrePlugin);

// tambien registro el item en el menu    
        registra_item_al_menu($nombrePlugin, $padre, $label);

// ahora registro el permiso del root en 1111
        registrar_permiso_pagina_grupo('root', "$nombrePlugin", '1111');

        // registro el permiso de invitados, 
        registrar_permiso_pagina_grupo('invitados', "$nombrePlugin", '1000');


        // ahora hago una repeticion creando a cada vuelta las carpetas dentro del plugin
        $i = 0; // pongo 1 para no crear elfichero raiz
        while ($i < $t) {
            if ($mvc[$i] != 'raiz') { // la ultima no la creo (raiz)
                crear_carpeta("$path_plugins/$nombrePlugin", $mvc[$i]);                                
            }
            // dentro de cada carpeta creo los ficheros que cada carpeta debe contenir
            magia_crear_ficheros_dentro_mvc($nombrePlugin, $mvc[$i]);
            $i++;
        }
    }
}

function menu_add_plugin() {
    global $dbh;
    $sql = "SELECT padre,label FROM _menu where padre like '' group by padre  order by label ";

    $stmt = $dbh->prepare($sql);
    $stmt->execute(array(
            // ":id_personal"=>"$u_id_personal"
            )
    );
    $resultado = $stmt->fetchAll();


    $i = 1;
    foreach ($resultado as $reg) {
        echo '<option value="' . $reg['label'] . '" >' . strtoupper($reg['label']) . ' </option>' . "\n";
        menu_add_plugin_segun_padre($reg['padre']);


        $i++;
    }
}

function menu_add_plugin_segun_padre($padre) {
    global $dbh;
    $sql = "SELECT * FROM _menu where padre like '$padre'  order by label ";

    $stmt = $dbh->prepare($sql);
    $stmt->execute(array(
        ":padre" => "$padre"
            )
    );
    $resultado = $stmt->fetchAll();

    $i = 1;
    foreach ($resultado as $reg) {
        echo '<option value="' . $reg['label'] . '" disabled> ->' . $reg['label'] . ' </option>' . "\n";
        $i++;
    }
}

function crear_carpeta($path, $nombre_carpeta) {
    global $icon_error, $icon_ok, $icon_carpeta_cerrada, $icon_carpeta_abierta; 
    if (file_exists("$path/$nombre_carpeta")) {
        echo "<p><b>$icon_error [error]</b> La carpeta $path/<b>$nombre_carpeta</b>, existe o no tiene derechos de escritura</p>";
    } else {
        mkdir("$path/$nombre_carpeta", 0777);
        chmod("$path/$nombre_carpeta", 0777);
        echo "<p><b>$icon_carpeta_abierta</b>: $path/<b>$nombre_carpeta</b>, creada con exito</p>";
    }


    return 0;
}

function crear_carpetas($path, $carpetas) {
    $i = 0;
    while ($i < count($carpetas)) {
        crear_carpeta($path, $carpetas[$i]);
        $i++;
    }
}

function crear_fichero($path, $fichero, $contenido = '') {
global $icon_error, $icon_ok, $icon_fichero; 
    $contiene = ($contenido) ? $contenido : '';

    if (file_exists("$path/$fichero")) {
        echo "<p><b>$icon_error [error]</b> El fichero $path/<b>$fichero</b> Ya existe</p>";
        return 1;
    } else {
        echo "<p>---$icon_fichero $fichero creado con exito</p>";
        $fp = fopen("$path/$fichero", 'w+');
        fwrite($fp, $contiene);
        fclose($fp);
        chmod("$path/$fichero", 0777);
        return 0;
    }
}

function copiar_carpeta($origen, $destino) {
     echo "<p>Copiar $origen a $destino</p>";     
    if (is_dir($origen)) {
        @mkdir($destino);
        $d = dir($origen);
        while (FALSE !== ( $entry = $d->read() )) {
            if ($entry == '.' || $entry == '..') {
                continue;
            }
            $Entry = $origen . '/' . $entry;
            if (is_dir($Entry)) {
                copiar_carpeta($Entry, $destino . '/' . $entry);                
                continue;
            }
            copy($Entry, $destino . '/' . $entry);
            chmod("$destino", 0777);
            
        }

        $d->close();
    } else {
        copy($origen, $destino);
        chmod("$destino", 0777);
    }
}

function contenido_controlador($controlador, $nombrePlugin) {
    global $path_plugins, $dbh;
    //$resultados = resultados($nombrePlugin);
    include "./modelos/v_crea_plug.php";
    $total_resultados = count($resultados);

    switch ($controlador) {

        case 'borrar.php':
            $fuente  = ' <?php ' . "\n";
            $fuente .= ' $accion = "borrar"; ' . "\n";
            $fuente .= ' $pagina = "' . $nombrePlugin . '"; ' . "\n";
            $fuente .= ' if (permisos_tiene_permiso($accion, $pagina, $u_grupo)) { ' . "\n";
            $fuente .= ' $id 		= mysql_real_escape_string($_REQUEST[\'id\']); ' . "\n";
            $fuente .= ' include "./' . $nombrePlugin . '/modelos/borrar.php"; ' . "\n";
            $fuente .= ' } else { ' . "\n";
            $fuente .= '     permisos_sin_permiso($accion,$pagina, $u_login); ' . "\n";
            $fuente .= ' } ' . "\n";

            return $fuente;
            break;

        case 'buscar.php':
            $fuente = ' <?php ' . "\n";
            $fuente .= ' $accion = "buscar"; ' . "\n";
            $fuente .= ' $pagina = "' . $nombrePlugin . '"; ' . "\n";
            $fuente .= ' if (permisos_tiene_permiso($accion,$pagina, $u_grupo)) { ' . "\n";
            
           
            
            $i = 0;
            $usar_id = 0; // 0 no usa, -1 si usa
            foreach ($resultados as $reg) {
                if ($i > $usar_id) {
                    $fuente .= ' $' . $reg[0] . ' = mysql_real_escape_string($_REQUEST[\'' . $reg[0] . '\']);' . "\n";
                    $fuente .= ($i < $total_resultados - 1) ? " " : "";
                }
                $i++;
            }
            
            
            
            $fuente .= '     include "./' . $nombrePlugin . '/modelos/buscar.php"; ' . "\n";
            $fuente .= '     include "./' . $nombrePlugin . '/vista/buscar.php"; ' . "\n";
            $fuente .= ' } else { ' . "\n";
            $fuente .= '     permisos_sin_permiso($accion,$pagina,$u_login); ' . "\n";
            $fuente .= ' } ' . "\n";


            return $fuente;
            break;

        case 'crear.php':
            $fuente = ' <?php ' . "\n";
            $fuente .= ' $accion = "crear"; ' . "\n";
            $fuente .= ' $pagina = "' . $nombrePlugin . '"; ' . "\n";
            // $fuente .= ' //include \'header.php\';  '."\n";
            // $fuente .= ' include "./'.$nombrePlugin.'/funciones.php"; '."\n";
            $fuente .= ' if (permisos_tiene_permiso($accion,$pagina,$u_grupo)) { ' . "\n";
            $fuente .= ' if(isset($_REQUEST[\'a\'])==\'crear\'){ ' . "\n";
            
            $fuente .= ' include "./' . $nombrePlugin . '/reg/post.php";  ' . "\n";            
            /*
            $i = 0;
            $usar_id = 0; // 0 no usa, -1 si usa
            foreach ($resultados as $reg) {
                if ($i > $usar_id) {
                    //$fuente .= ' $'.$reg[0].' = $_REQUEST[\''.$reg[0].'\'];     '."\n"; 
                    $fuente .= ' $' . $reg[0] . ' = mysql_real_escape_string($_REQUEST[\'' . $reg[0] . '\']);     ' . "\n";
                    $fuente .= ($i < $total_resultados - 1) ? " " : "";
                }
                $i++;
            }
             * 
             */
            $fuente .= ' include "./' . $nombrePlugin . '/modelos/crear.php";  ' . "\n";

            $fuente .= ' include "./' . $nombrePlugin . '/modelos/index.php";  ' . "\n";
            $fuente .= ' include "./' . $nombrePlugin . '/vista/index.php";  ' . "\n";
            $fuente .= ' }else{ ' . "\n";
            $fuente .= ' include "./' . $nombrePlugin . '/vista/crear.php";  ' . "\n";
            $fuente .= ' }          ' . "\n";
            $fuente .= ' } else { ' . "\n";
            $fuente .= '     permisos_sin_permiso($accion,$pagina, $u_login); ' . "\n";
            $fuente .= ' } ' . "\n";


            return $fuente;
            break;

        case 'editar.php':
            $fuente = ' <?php ' . "\n";
            $fuente .= ' $accion = "editar"; ' . "\n";
            $fuente .= ' $pagina = "' . $nombrePlugin . '"; ' . "\n";
            // $fuente .= ' //include \'header.php\'; '."\n";
            // $fuente .= ' include "./'.$nombrePlugin.'/funciones.php"; '."\n";
            $fuente .= ' if (permisos_tiene_permiso($accion,$pagina, $u_grupo)) { ' . "\n";
            $fuente .= ' if(isset($_REQUEST[\'a\'])==\'editar\'){ ' . "\n";
            
            $fuente .= ' include "./' . $nombrePlugin . '/reg/post.php";  ' . "\n";            
            
            /*
            $i = 0;
            foreach ($resultados as $reg) {
                include './reg/reg.php';
                //$fuente .= ' $'.$resultados[$i].' = mysql_real_escape_string($_REQUEST[\''.$resultados[$i].'\']);     '."\n"; 
                $fuente .= ' $' . $reg[0] . ' = mysql_real_escape_string($_REQUEST[\'' . $reg[0] . '\']);     ' . "\n";
                $fuente .= ($i < $total_resultados - 1) ? " " : "";

                $i++;
            }
            */
            $fuente .= ' include "./' . $nombrePlugin . '/modelos/editar.php";  ' . "\n\n";

            $fuente .= ' include "./' . $nombrePlugin . '/modelos/ver.php";  ' . "\n";
            $fuente .= ' include "./' . $nombrePlugin . '/reg/reg.php"; ' . "\n";
            $fuente .= ' include "./' . $nombrePlugin . '/vista/ver.php";  ' . "\n";
            $fuente .= ' }else{ ' . "\n";
            $fuente .= ' $id = mysql_real_escape_string($_REQUEST[\'id\']);      ' . "\n";
            $fuente .= ' include "./' . $nombrePlugin . '/modelos/ver.php"; ' . "\n";
            $fuente .= ' include "./' . $nombrePlugin . '/reg/reg.php"; ' . "\n";
            $fuente .= ' include "./' . $nombrePlugin . '/vista/editar.php"; ' . "\n";
            $fuente .= ' }  ' . "\n";

            $fuente .= ' } else { ' . "\n";
            $fuente .= ' permisos_sin_permiso($accion,$pagina, $u_login); ' . "\n";
            $fuente .= ' } ' . "\n";

            return $fuente;

            break;


        case 'index.php':
            $fuente = ' <?php ' . "\n";
            $fuente .= ' $accion = "ver"; ' . "\n";
            $fuente .= ' $pagina = "' . $nombrePlugin . '"; ' . "\n";
            $fuente .= ' if (permisos_tiene_permiso($accion,$pagina,$u_grupo)) { ' . "\n";
            $fuente .= '     include "./' . $nombrePlugin . '/modelos/index.php"; ' . "\n";
            $fuente .= '     include "./' . $nombrePlugin . '/vista/index.php"; ' . "\n";
            $fuente .= ' } else { ' . "\n";
            $fuente .= '     permisos_sin_permiso($accion,$pagina, $u_login); ' . "\n";
            $fuente .= ' } ' . "\n";
            return $fuente;

        case 'ver.php':
            $fuente = ' <?php ' . "\n";
            $fuente .= ' $accion = "ver"; ' . "\n";
            $fuente .= ' $pagina = "' . $nombrePlugin . '"; ' . "\n";
            //     $fuente .= ' include \'header.php\';  '."\n";
            //     $fuente .= ' include "./'.$nombrePlugin.'/funciones.php"; '."\n";
            $fuente .= ' if (permisos_tiene_permiso($accion,$pagina,$u_grupo)) { ' . "\n";

            $fuente .= '     $id 		= mysql_real_escape_string($_REQUEST[\'id\']);   ' . "\n";

            $fuente .= '     include "./' . $nombrePlugin . '/modelos/ver.php"; ' . "\n";
            $fuente .= '     include "./' . $nombrePlugin . '/reg/reg.php"; ' . "\n";
            $fuente .= '     include "./' . $nombrePlugin . '/vista/ver.php"; ' . "\n";
            $fuente .= ' } else { ' . "\n";
            $fuente .= '     permisos_sin_permiso($accion,$pagina, $u_login); ' . "\n";
            $fuente .= ' } ' . "\n";
            return $fuente;
            break;

        default:
            $fuente = "";
            return $fuente;
            break;
    }
}

function contenido_modelos($modelos, $nombrePlugin) {
    global $path_plugins, $dbh;
    //$resultados = resultados($nombrePlugin);
    include "./modelos/v_crea_plug.php";
    $total_resultados = count($resultados);


    switch ($modelos) {
        case 'borrar.php':
            $fuente = ' <?php ' . "\n";
            $fuente .= ' $sql=mysql_query(" ' . "\n";
            $fuente .= ' DELETE FROM  ' . "\n";
            $fuente .= ' ' . $nombrePlugin . '  ' . "\n";
            $fuente .= ' WHERE id = \'$id\' ' . "\n";
            $fuente .= ' ",$conexion) or die ("Error ".mysql_error()); ' . "\n";
            $fuente .= '  ' . "\n";
            $fuente .= ' $mensaje = "Realizado"; ' . "\n";
            return $fuente;
            break;

        case 'buscar.php':
            $fuente = ' <?php ' . "\n";
            $fuente .= ' $sql=mysql_query( ' . "\n";
            $fuente .= '         "SELECT *  ' . "\n";
            $fuente .= ' FROM ' . $nombrePlugin . '  ' . "\n";
            $fuente .= ' WHERE  ' . "\n";
            
                       
            
            
            $i = 0;
            $usar_id = 0; // 0 no usa, -1 si usa
            foreach ($resultados as $reg) {
                if ($i > $usar_id) {
                    // esto es para correjir el error
                    $remplaza_busqueda = '$busqueda';

                    //$fuente .= " $reg[0] like '%$remplaza_busqueda%'    "."\n";
                    $fuente .= " $reg[0] like '%$$reg[0]%'    " . "\n";
                    $fuente .= ($i < $total_resultados - 1) ? " AND " : "";
                }
                $i++;
            }
            
            $fuente .= ' ORDER BY id DESC    ' . "\n";
            $fuente .= ' ",$conexion) or die ("Error:".mysql_error());  ' . "\n";
            //$fuente .=  ' $reg = mysql_fetch_array($sql);	  '."\n";          
            return $fuente;
            break;

        case 'crear.php':
            $fuente = ' <?php ' . "\n";
            $fuente .= ' $sql = "INSERT INTO ' . $nombrePlugin . ' ( ' . "\n";
            
            $i = 0;
            $usar_id = 0; // 0 no usa, -1 si usa
            foreach ($resultados as $reg) {
                if ($i > $usar_id) {
                    $fuente .= ' ' . $reg[0] . ' ';
                    $fuente .= ($i < $total_resultados - 1) ? " , " : "";
                }
                $i++;
            }
             
             
            $fuente .= ' ) VALUES ( ' . "\n";
            $i = 0;
            $usar_id = 0; // 0 no usa, -1 si usa
            foreach ($resultados as $reg) {
                if ($i > $usar_id) {
                    $fuente .= ' :' . $reg[0] . ' ';
                    $fuente .= ($i < $total_resultados - 1) ? " , " : "   )\";  " . "\n";
                }
                $i++;
            }
            $fuente .= ' $stmt = $dbh->prepare($sql); ' . "\n";
            $fuente .= ' $stmt->execute(array( ' . "\n";
            $i = 0;
            $usar_id = 0; // 0 no usa, -1 si usa
            foreach ($resultados as $reg) {
                if ($i > $usar_id) {
                    $fuente .= ' ":' . $reg[0] . '"=>"$' . $reg[0] . '" ' . "";
                    $fuente .= ($i < $total_resultados - 1) ? " , " : "";
                }
                $i++;
            }
            $fuente .= '             ) ' . "\n";
            $fuente .= ' ); ' . "\n";
            $fuente .= ' $mensaje = "Realizado con exito"; ' . "\n";
            return $fuente;
            break;

        case 'editar.php':
            $fuente = ' <?php  ' . "\n";
            $fuente .= ' $sql=mysql_query(" UPDATE ' . $nombrePlugin . ' SET  ' . "\n";
            $i = 0;
            $usar_id = 0; // 0 no usa, -1 si usa
            foreach ($resultados as $reg) {
                if ($i > $usar_id) {
                    $fuente .= ' ' . $reg[0] . ' = \'$' . $reg[0] . '\'  ' . "\n";
                    $fuente .= ($i < $total_resultados - 1) ? " , " : "";
                }
                $i++;
            }
            $fuente .= ' WHERE id = \'$id\' ",$conexion) or die ("Error: ".mysql_error());   ' . "\n";
            return $fuente;
            break;

        case 'index.php':
            $fuente = '<?php ' . "\n";
            $fuente .= '$sql=mysql_query("SELECT * FROM ' . $nombrePlugin . ' ORDER BY id DESC ",$conexion) ' . "\n";
            $fuente .= 'or die ("Error: en el fichero:" .__FILE__ .\' linea: \'. __LINE__ .\'  \'.mysql_error());	  ' . "\n";
            // $fuente .= '$reg = mysql_fetch_array($sql);	  '."\n";

            return $fuente;
            break;

        case 'ver.php':
            $fuente = ' <?php ' . "\n";
            $fuente .= '$sql=mysql_query( ' . "\n";
            $fuente .= ' "SELECT * FROM ' . $nombrePlugin . ' WHERE id = \'$id\' ORDER BY id DESC   ",$conexion) 	  ' . "\n";
            $fuente .= ' or die ("Error: en el fichero:" .__FILE__ .\' linea: \'. __LINE__ .\' / \'.mysql_error());	' . "\n";
            $fuente .= ' $reg = mysql_fetch_array($sql);	  ' . "\n";
            return $fuente;
            break;

        default:
            $fuente = "";
            return $fuente;
            break;
    }
}

function contenido_vista($vista, $nombrePlugin) {
    global $path_plugins, $dbh;    
    include "./modelos/v_crea_plug.php";
    $total_resultados = count($resultados);
    

    switch ($vista) {
        case 'borrar.php':
            $fuente = '<h2><?php _t("Atencion","' . $nombrePlugin . '"); ?></h2>
                <p><?php _t("Ud esta a por borrar definiticamente este registro, desea hacerlo?"); ?></p>
                <a class="btn btn-danger" href="index.php?p=' . $nombrePlugin . '&c=borrar&id=<?php echo $id; ?>"><?php _t("Si,borrar"); ?></a>';

            return $fuente;
            break;

        case 'buscar.php':

            $fuente = '<h2><?php _t("Resultados de su busqueda","' . $nombrePlugin . '"); ?></h2>' . "\n\n";
            $fuente .= '
<table class="table table-striped">
    <thead>
        <tr> ' . "\n";

            $i = 0;
            $usar_id = 0; // 0 no usa, -1 si usa
            foreach ($resultados as $reg) {
                if ($i > $usar_id) {
                    $fuente .= '<th><?php _t("' . ucfirst($reg[0]) . '","' . $nombrePlugin . '"); ?></th> ' . "\n";
                }
                $i++;
            }
            $fuente .= ' <th><?php _t("Accion","' . $nombrePlugin . '"); ?></th> ' . "\n";
            $fuente .=' </tr>
    </thead>
    <tbody>
    
 <?php
   if(permisos_tiene_permiso("ver", "' . $nombrePlugin . '", $u_grupo)){
             //   include "./' . $nombrePlugin . '/vista/tr_buscar.php";
                
            }
   ?>
   

        <?php
        while ($reg = mysql_fetch_array($sql)) {
            include "./' . $nombrePlugin . '/reg/reg.php"; 
                if(permisos_tiene_permiso("editar", "' . $nombrePlugin . '", $u_grupo)){
                    include "./' . $nombrePlugin . '/vista/tr.php";
                   // include "./' . $nombrePlugin . '/vista/tr_editar.php";
                }else{
                    include "./' . $nombrePlugin . '/vista/tr.php";
                }            
        }
        ?>
    </tbody>
     <?php
   if(permisos_tiene_permiso("crear", "' . $nombrePlugin . '", $u_grupo)){
             //   include "./' . $nombrePlugin . '/vista/tr_anadir.php";
                
            }
   ?>
    
    
</table> 


';

            return $fuente;
            break;

        case 'crear.php':
           
            
            
            $f  = '<h2><?php _t("Nuevo ' . $nombrePlugin . '","' . $nombrePlugin . '"); ?></h2> ' . "\n\n";            
            $f .= '<form class="form-horizontal" action="index.php" method="post"> ' . "\n";
            $f .= '<input type="hidden" name="p" value="' . $nombrePlugin . '"> ' . "\n";
            $f .= '<input type="hidden" name="c" value="crear"> ' . "\n";
            $f .= '<input type="hidden" name="a" value="crear"> ' . "\n\n";
            $f .= '<?php
                        $c = [ ' . "\n\n";
            $i = 0;
            $usar_id = 0; // 0 no usa, -1 si usa
            foreach ($resultados as $reg) {
                if ($i > $usar_id) {
                    $f .= ' [ ' . "\n";
                    $f .= '        "tipo" => "text", ' . "\n";
                    $f .= '        "nombre" => "' . $reg[0] . '",' . "\n";
                    $f .= '        "valor" => "",' . "\n";
                    $f .= '        "clase" => "form-control",' . "\n";
                    $f .= '        "id" => "' . $reg[0] . '",' . "\n";
                    $f .= '        "placeholder" => "' . ucfirst($reg[0]) . '",' . "\n";                    
                    $f .= '    ], ' . "\n";
                    
                }
                $i++;
            }
            
            $f .= '        
                    ];
                    ?>   ' . "\n";
            
            
            $f .= ' <?php
                    for ($i = 0; $i < count($c); $i++) {

                        $tipo = $c[$i][\'tipo\'];
                        $nombre = $c[$i][\'nombre\'];
                        $id = $c[$i][\'id\'];
                        $valor = $c[$i][\'valor\'];
                        $clase = $c[$i][\'clase\'];
                        $placeholder = $c[$i][\'placeholder\'];

                        echo \'<div class="form-group"> 
                        <label for="\' . $id . \'" class="col-sm-2 control-label">\' . $nombre . \'</label> 
                        <div class="col-sm-8"> \';
                            formularios_campo($tipo, $nombre, $id, $valor, $clase, $placeholder);
                        echo \'</div> 
                    </div> \';
                    }
                    ?>';
            
            
            
            
            
            $f .= ' <div class="form-group"> ' . "\n";
            $f .= '     <div class="col-sm-offset-2 col-sm-10"> ' . "\n";
            $f .= '       <button type="submit" class="btn btn-primary"><?php _t("Registrar","' . $nombrePlugin . '"); ?></button> ' . "\n";
            $f .= '     </div> ' . "\n";
            $f .= '   </div> ' . "\n";
            $f .= ' </form> ' . "\n";
            
            
            return $f;
            
            
            
            break;

        case 'editar.php':
            $fuente = '<h2><?php echo _t("Editar","' . $nombrePlugin . '"); ?></h2>' . "\n\n";
            $fuente .= '     <form class="form-horizontal" method="post" action="index.php"> ' . "\n";
            $fuente .= '     <input type="hidden" name="p" value="' . $nombrePlugin . '"> ' . "\n";
            $fuente .= '     <input type="hidden" name="c" value="editar"> ' . "\n";
            $fuente .= '     <input type="hidden" name="a" value="editar"> ' . "\n";
            $fuente .= '     <input type="hidden" name="id" value="<?php echo $id; ?>"> ' . "\n\n";
            $i = 0;
            $usar_id = 0; // 0 no usa, -1 si usa
            foreach ($resultados as $reg) {
                if ($i > $usar_id) {
                    $fuente .= ' <div class="form-group"> ' . "\n";
                    $fuente .= '     <label for="' . $reg[0] . '" class="col-sm-2 control-label"><?php _t("' . ucfirst($reg[0]) . '","' . $nombrePlugin . '"); ?></label> ' . "\n";
                    $fuente .= '     <div class="col-sm-10"> ' . "\n";
                    $fuente .= '       <input type="text" class="form-control" name="' . $reg[0] . '" id="' . $reg[0] . '" placeholder="<?php _t("' . ucfirst($reg[0]) . '","' . $nombrePlugin . '"); ?>" value="<?php echo $' . $reg[0] . '; ?>"> ' . "\n";
                    $fuente .= '     </div> ' . "\n";
                    $fuente .= '   </div> ' . "\n\n\n";
                }
                $i++;
            }

            $fuente .= '   <div class="form-group"> ' . "\n";
            $fuente .= ' <div class="col-sm-offset-2 col-sm-10"> ' . "\n";
            $fuente .= '       <button type="submit" class="btn btn-primary"><?php _t("Editar","' . $nombrePlugin . '"); ?></button> ' . "\n";
            $fuente .= '     </div> ' . "\n";
            $fuente .= '   </div>     ' . "\n";
            $fuente .= ' </form> ' . "\n";
            return $fuente;
            break;
       
        case 'index.php':

            $fuente = '<h2><?php echo _t("Lista de ' . $nombrePlugin . '","' . $nombrePlugin . '"); ?>
                <a type="button" class="btn btn-primary navbar-btn" href="?p=' . $nombrePlugin . '&c=crear"><?php _t("Nueva","' . $nombrePlugin . '"); ?></a></h2>';

            $fuente .= '
<table class="table table-striped">
    <thead>
        <tr> ' . "\n\n";
            $i = 0;
            $usar_id = 0; // 0 no usa, -1 si usa
            foreach ($resultados as $reg) {
                if ($i > $usar_id) {
                    $fuente .= ' <th><?php echo _t("' . ucfirst($reg[0]) . '","' . $nombrePlugin . '"); ?></th> ' . "\n";
                }
                $i++;
            }
            $fuente .= ' <th><?php echo _t("Accion","' . $nombrePlugin . '"); ?></th> ' . "\n";
            $fuente .=' </tr>
    </thead>
    <tbody>
    
 <?php
   if(permisos_tiene_permiso("ver", "' . $nombrePlugin . '", $u_grupo)){
             //   include "./' . $nombrePlugin . '/vista/tr_buscar.php";
                
            }
   ?>
   

        <?php
        while ($reg = mysql_fetch_array($sql)) {
            include "./' . $nombrePlugin . '/reg/reg.php"; 
                if(permisos_tiene_permiso("editar", "' . $nombrePlugin . '", $u_grupo)){
                    include "./' . $nombrePlugin . '/vista/tr.php";
                   // include "./' . $nombrePlugin . '/vista/tr_editar.php";
                }else{
                    include "./' . $nombrePlugin . '/vista/tr.php";
                }            
        }
        ?>
    </tbody>
     <?php
   if(permisos_tiene_permiso("crear", "' . $nombrePlugin . '", $u_grupo)){
             //   include "./' . $nombrePlugin . '/vista/tr_anadir.php";
                
            }
   ?>
    
    
</table> 


';

            return $fuente;
            break;

        case 'menu.php':

            $fuente = '<h1><?php _t("Buscar","' . $nombrePlugin . '"); ?></h1>

<form method="get" action="index.php">
    <input  type="hidden" name="p" value="' . $nombrePlugin . '">
    <input  type="hidden" name="c" value="buscar">';

            $i = 0;
            $usar_id = 0; // 0 no usa, -1 si usa
            foreach ($resultados as $reg) {
                if ($i > $usar_id) {
                    /* $fuente .=  ' <div class="form-group">
                      <label for="'.$nombrePlugin.'">'.$reg[0].'</label>
                      <select class="form-control" name="'.$nombrePlugin.'">
                      <option value="todas"><?php _t("Todas","' . $nombrePlugin . '"); ?></option>
                      <?php '.$nombrePlugin.'_add(); ?>
                      </select>
                      </div> '."\n"; */




                    $fuente .= '
  <div class="form-group">
    <label for="' . ucfirst($reg[0]) . '"><?php _t("' . ucfirst($reg[0]) . '","' . $nombrePlugin . '"); ?></label>
    <input type="text" class="form-control" name="' . $reg[0] . '" id="' . $reg[0] . '" placeholder="<?php _t("' . ucfirst($reg[0]) . '","' . $nombrePlugin . '"); ?>">
  </div>
   ';
                }

                $i++;
            }





            $fuente .= '    
  <button type="submit" class="btn btn-default"><?php _t("Buscar","' . $nombrePlugin . '"); ?></button>
</form>';



            return $fuente;
            break;

        case 'sidebar.php':
            $fuente = '﻿ <div class="col-sm-3 col-md-2 sidebar"> ' . "\n\n";
            $fuente .= '<h2><?php _t("Buscar","' . $nombrePlugin . '"); ?></h2> ' . "\n\n";
            $fuente .= '<form class="" action="index.php" method="get"> ' . "\n";
            $fuente .= '<input type="hidden" name="p" value="' . $nombrePlugin . '"> ' . "\n";
            $fuente .= '<input type="hidden" name="c" value="buscar"> ' . "\n";

            $i = 0;
            $usar_id = 0; // 0 no usa, -1 si usa
            foreach ($resultados as $reg) {
                if ($i > $usar_id) {
                    $fuente .= '     <div class="form-group"> ' . "\n";
                    $fuente .= '     <label for="' . $reg[0] . '" class="col-sm-2 control-label"><?php _t("' . ucfirst($reg[0]) . '","' . $nombrePlugin . '");?></label> ' . "\n";
                    // $fuente .= '     <div class="col-sm-10"> ' . "\n";
                    $fuente .= '       <input type="text" class="form-control" name="' . $reg[0] . '" id="' . $reg[0] . '" placeholder="<?php _t("' . ucfirst($reg[0]) . '","' . $nombrePlugin . '"); ?> "> ' . "\n";
                    // $fuente .= '     </div> ' . "\n";
                    $fuente .= '   </div> ' . "\n\n\n";
                }
                $i++;
            }
            //  $fuente .= ' <div class="form-group"> ' . "\n";
            //  $fuente .= '     <div class="col-sm-offset-2 col-sm-10"> ' . "\n";
            $fuente .= '       <button type="submit" class="btn btn-primary"><?php _t("Buscar","' . $nombrePlugin . '"); ?></button> ' . "\n";
            //$fuente .= '     </div> ' . "\n";
            //$fuente .= '   </div> ' . "\n";
            $fuente .= ' </form> ' . "\n";
            $fuente .= ' </div> ' . "\n";




            return $fuente;
            break;

        case 'tr.php':
            $fuente = ' <?php  ' . "\n";
            $fuente .= '    echo \' <tr>';
            $i = 0;
            $usar_id = 0; // 0 no usa, -1 si usa
            foreach ($resultados as $reg) {
                if ($i > $usar_id) {
                    $fuente .= ' <td>\'.$' . $reg[0] . '.\'</td> ' . "\n";
                }

                $i++;
            }
            $fuente .=' <td>
<a href=\'.$_SERVER[\'PHP_SELF\'].\'?p=' . $nombrePlugin . '&c=ver&id=\'.$id.\'>Ver</a> |  
<a href=\'.$_SERVER[\'PHP_SELF\'].\'?p=' . $nombrePlugin . '&c=editar&id=\'.$id.\'>Editar</a>  
                      
                </td></tr>\';  ';

            return $fuente;
            break;

        case 'tr_anadir.php':
            $fuente = '
            <form method="post" action="index.php" >
                <input type="hidden" name="p" value="' . $nombrePlugin . '">
                <input type="hidden" name="c" value="crear">    
                <input type="hidden" name="a" value="crear">    
                <tr>';
            $i = 0;
            $usar_id = 0; // 0 no usa, -1 si usa
            foreach ($resultados as $reg) {
                if ($i > $usar_id) {
                    $fuente .= ' <td><input class="form-control" type="text" name="' . $reg[0] . '" value="" placeholder="<?php _t("' . ucfirst($reg[0]) . '","' . $nombrePlugin . '"); ?>"></td> ' . "\n";
                }
                $i++;
            }
            $fuente .='<td><input class="btn btn-primary" type="submit" value="<?php _t("Registrar","' . $nombrePlugin . '"); ?>" ></td>        
    </tr>
</form> ';
            return $fuente;
            break;

        case 'tr_editar.php':


            $fuente = ' <?php  ' . "\n";
            $fuente .= '$borrar = (permisos_tiene_permiso("borrar", "' . $nombrePlugin . '", $u_grupo))?\'<a class="btn btn-danger" href="index.php?p=' . $nombrePlugin . '&c=borrar&a=borrar&id=\'.$id.\'">Borrar</a>\':\'\'; ?>
';



            $fuente .= '<form method="post" action="index.php" >
    <input type="hidden" name="p" value="' . $nombrePlugin . '">
    <input type="hidden" name="c" value="editar">    
    <input type="hidden" name="a" value="editar">    
    <input type="hidden" name="id" value="<?php echo $id; ?>">    
    <tr>';
            $i = 0;
            $usar_id = 0; // 0 no usa, -1 si usa
            foreach ($resultados as $reg) {
                if ($i > $usar_id) {
                    $fuente .= ' <td><input class="form-control" type="text" name="' . $reg[0] . '" value="<?php echo $' . $reg[0] . '; ?>" placeholder="<?php _t("' . ucfirst($reg[0]) . '","' . $nombrePlugin . '"); ?>"></td> ' . "\n";
                }
                $i++;
            }

            $fuente .= '<td><input class="btn btn-primary" type="submit" value="<?php _t("Registrar","' . $nombrePlugin . '"); ?>" >
        <?php echo $borrar; ?>
        </td>        
    </tr>
</form> ';

            return $fuente;
            break;

        case 'tr_buscar.php':
            $fuente = '<form method="get" action="index.php" >
    <input type="hidden" name="p" value="' . $nombrePlugin . '">
    <input type="hidden" name="c" value="buscar">       
    <tr>';

            $i = 0;
            $usar_id = 0; // 0 no usa, -1 si usa
            foreach ($resultados as $reg) {
                if ($i > $usar_id) {
                    $fuente .= ' <td><input class="form-control" type="text" name="' . $reg[0] . '" value="" placeholder="<?php _t("' . ucfirst($reg[0]) . '","' . $nombrePlugin . '"); ?>"></td> ' . "\n";
                }
                $i++;
            }

            $fuente .= '<td><input class="btn btn-info" type="submit" value="<?php _t("Buscar","' . $nombrePlugin . '"); ?>" >
        
        </td>        
    </tr>
</form> ';

            return $fuente;
            break;

        case 'ver.php':
            $fuente = '<h1><?php _t("Detalles","' . $nombrePlugin . '"); ?></h1> ' . "\n";
            /* $fuente .= '<h2>
              <?php echo _t("Lista de '.$nombrePlugin.'","' . $nombrePlugin . '"); ?>
              <a type="button" class="btn btn-primary navbar-btn" href="?p='.$nombrePlugin.'&c=crear">Nueva</a>
              </h2>'; */


            $fuente .= '     <form class="form-horizontal" method="" action=""> ' . "\n";
            $fuente .= '     <input type="hidden" name="p" value="' . $nombrePlugin . '"> ' . "\n";
            $fuente .= '     <input type="hidden" name="c" value="editar"> ' . "\n";
            $fuente .= '     <input type="hidden" name="id" value="<?php echo $id; ?>"> ' . "\n";
            $i = 0;
            $usar_id = 0; // 0 no usa, -1 si usa
            foreach ($resultados as $reg) {
                if ($i > $usar_id) {
                    $fuente .= ' <div class="form-group"> ' . "\n";
                    $fuente .= '     <label for="' . $reg[0] . '" class="col-sm-2 control-label"><?php _t("' . ucfirst($reg[0]) . '","' . $nombrePlugin . '"); ?></label> ' . "\n";
                    $fuente .= '     <div class="col-sm-10"> ' . "\n";
                    $fuente .= '       <input type="text" class="form-control" name="' . $reg[0] . '" id="' . $reg[0] . '" placeholder="<?php _t("' . ucfirst($reg[0]) . '","' . $nombrePlugin . '"); ?>" value="<?php echo $' . $reg[0] . '; ?>" disabled=""> ' . "\n";
                    $fuente .= '     </div> ' . "\n";
                    $fuente .= '   </div> ' . "\n";
                    $fuente .= '  ' . "\n\n";
                }
                $i++;
            }

            $fuente .= '   <div class="form-group"> ' . "\n";
            $fuente .= ' <div class="col-sm-offset-2 col-sm-10"> ' . "\n";
            $fuente .= '       <button type="submit" class="btn btn-primary"><?php _t("Editar","' . $nombrePlugin . '"); ?></button> ' . "\n";
            $fuente .= '     </div> ' . "\n";
            $fuente .= '   </div>     ' . "\n";
            $fuente .= ' </form> ' . "\n";
            return $fuente;
            break;

        default:
            $fuente = "";
            return $fuente;
            break;
    }
}

function contenido_reg($controlador, $nombrePlugin) {
    global $path_plugins, $dbh;
    //$resultados = resultados($nombrePlugin);
    include "./modelos/v_crea_plug.php";
    $total_resultados = count($resultados);


    switch ($controlador) {
        case 'get.php':
            $fuente = ' <?php ' . "\n";
            $i = 0;
            foreach ($resultados as $reg) {
                $var = $reg[0];
                //$fuente .= " $$var = mysql_real_escape_string($_GET['$var']);   ";    
                $fuente .= '  $' . $var . ' = mysql_real_escape_string($_GET[\'' . $var . '\']); ' . "\n";
                $i++;
            }

            return $fuente;
            break;
        case 'post.php':
            $fuente = ' <?php ' . "\n";
            $i = 0;
            foreach ($resultados as $reg) {
                $var = $reg[0];
                $fuente .= '  $' . $var . ' = mysql_real_escape_string($_POST[\'' . $var . '\']); ' . "\n";
                $i++;
            }
            return $fuente;
            break;
        case 'reg.php':
            $fuente = ' <?php ' . "\n";
            $i = 0;
            foreach ($resultados as $reg) {
                $var = $reg[0];
                $fuente .= '  $' . $var . ' = $reg[\'' . $var . '\']; ' . "\n";
                $i++;
            }

            return $fuente;
            break;
        case 'request.php':
            $fuente = ' <?php ' . "\n";
            $i = 0;
            foreach ($resultados as $reg) {
                $var = $reg[0];
                $fuente .= '  $' . $var . ' = mysql_real_escape_string($_REQUEST[\'' . $var . '\']); ' . "\n";
                $i++;
            }
            return $fuente;
            break;
        default:
            $fuente = "";
            return $fuente;
            break;
    }
}

function contenido_plugin($pagina, $nombrePlugin) {
    global $path_plugins, $dbh;
   
    include "./modelos/v_crea_plug.php";
    $total_resultados = count($resultados);


    switch ($pagina) {
        case 'funciones.php':

            $fuente = '<?php ';
            /*   $fuente .=  '  function ' . $nombrePlugin . '_campo($tabla,$id, $campo){
              global $conexion;
              $sql=mysql_query(
              "SELECT $campo FROM $tabla WHERE id = \'$id\'   ",$conexion) or die ("Error:".mysql_error());
              $reg = mysql_fetch_array($sql);
              return $reg[$campo];
              }';

             * 
             */

            $fuente .='/**
 * si deseas agregar alguna funcion haslo en las extenciones
 */
';

            $fuente .= 'function ' . $nombrePlugin . '_campo_add($campo, $label, $selecionado = "", $excluir = "") {
    global $conexion;
    $sql = mysql_query(
            "SELECT DISTINCT $campo FROM _menu order by $campo   ", $conexion) 
            or die("Error:" . mysql_error());
    while ($reg = mysql_fetch_array($sql)) {

        echo "<option ";
        if ($selecionado == $reg[$campo]) {
            echo " selected ";
        } else {
            echo "";
        }
        if ($excluir == $reg[$campo]) {
            echo " disabled ";
        } else {
            echo "";
        }
        echo "value=\"$reg[$campo]\">$reg[$campo]</option> \n";
    }
}

function ' . $nombrePlugin . '_add($selecionado="",$excluir=""){  
global $conexion; 
$sql=mysql_query(
        "SELECT * FROM ' . $nombrePlugin . '  ",$conexion) or die ("Error:".mysql_error());
while ($reg = mysql_fetch_array($sql)) {
    
   echo "<option "; 
   if($selecionado==$reg[0]) {echo " selected "; } else {echo ""; }
   if($excluir==$reg[0]) {echo " disabled "; } else {echo ""; }
   echo "value=\"$reg[0]\">$reg[0]</option>";
} 
}

';

            $fuente .='/**
 * si deseas agregar alguna funcion haslo en las extenciones
 */
';

            return $fuente;
            break;
        case 'readme.txt':
            $fuente = "Plugin: $nombrePlugin ";
            return $fuente;
            break;
        case 'COPYING':
            $fuente = "Aca escriba el texto de la licencia del plugin: $nombrePlugin ";
            return $fuente;
            break;
        case '.gitignore':
            $fuente = "poner las exepciones para el github ";
            return $fuente;
            break;
        case 'version':
            $fuente = "0.01 ";
            return $fuente;
            break;
        case 'menu':
            $fuente = "<ul><li>Menu</li></ul>";
            return $fuente;
            break;
        default :
            return;
            break;
    }
}

function contenido_admin($pagina) {
    global $servidor, $bdatos, $usuario, $clave;
    switch ($pagina) {
        case 'bd.php':
            $fuente = '<?php  
                        $servidor = "' . $servidor . '"; 
                        $bdatos = "' . $bdatos . '"; 
                        $usuario = "' . $usuario . '"; 
                        $clave = "' . $clave . '";';
            return $fuente;
            break;
        case 'conec.php':
            $fuente = '<?php	
$dbh = new PDO("mysql:host=$servidor; dbname=$bdatos",   $usuario, $clave);
';
            return $fuente;
            break;
        case 'coneccion.php':
            $fuente = '<?php
$conexion = mysql_connect("$servidor", "$usuario", "$clave") or die("Problemas en la conexion");
mysql_select_db("$bdatos", $conexion) or die("Problemas conexion en local");

';
            return $fuente;
            break;
        case 'configuracion.php':
            $fuente = '<?php 
$config_nombre_web          = "Mi sitio web";
$config_idioma_por_defecto  = "es"; ';
            return $fuente;
            break;
        case 'funciones.php':
            $fuente = '<?php 

function _campo($tabla, $id, $campo) {
    global $conexion;
    $sql = mysql_query(
            "SELECT $campo FROM $tabla WHERE id = \'$id\'   ", $conexion) or die("Error:" . mysql_error());
    $reg = mysql_fetch_array($sql);
    return $reg[$campo];
}



function _incluir_funciones(){
    
    $funciones = _listar_directorios_ruta();
    foreach ($funciones as $valor) {
        
        $f = "./$valor/funciones.php"; 
        
        if(file_exists($f)){
            include $f; 
        }
        else {
            $sms = "El plugin $valor no existe";  
            return $sms ;
        }
        
    }
}
function _listar_directorios_ruta($ruta="./"){ 
   // abrir un directorio y listarlo recursivo 
   if (is_dir($ruta)) { 
      if ($dh = opendir($ruta)) { 
         $carpetas = [];
          while (($file = readdir($dh)) !== false) { 
            //esta línea la utilizaríamos si queremos listar todo lo que hay en el directorio 
            //mostraría tanto archivos como directorios 
            //echo "<br>Nombre de archivo: $file : Es un: " . filetype($ruta . $file); 
            if (is_dir($ruta . $file) && $file!="." && $file!=".."){ 
               //solo si el archivo es un directorio, distinto que "." y ".." 
               
               $c = array_push($carpetas, $file);
               
                
              //  echo "<br>Directorio: $ruta$file"; 
               
              // _listar_directorios_ruta($ruta . $file . "/"); 
            } 
         } 
      closedir($dh); 
      } 
}else {
      echo "<br>No es ruta valida"; 
}
return $carpetas;

}



function _magia_menu($selecionado){
$menu_items = _listar_directorios_ruta();
$menu_total_items = count(_listar_directorios_ruta());
$i = 0;
while ($i < $menu_total_items) {    
    
    $activa = ($selecionado == $menu_items[$i] )? \'active\' : 0 ;  
    if($activa){
        $clase = \' glyphicon glyphicon-folder-open \'; 
    }else  {
        $clase = \' glyphicon glyphicon-folder-close \'; 
    }
    
    if($menu_items[$i] != \'home\'){
    echo \'<li class="\'.$activa.\'"><a href="?p=\' . $menu_items[$i] . \'&c=index"> <span class="\'.$clase.\'"></span> \' . ucwords($menu_items[$i]) . \'</a></li>\';
    }
    $i++;    
}

}




function _estatus($estatus) {
    if($estatus==0){
        return _t("Activo","' . $nombrePlugin . '");
    }else {
        return _t("Bloqueado","' . $nombrePlugin . '");
    }
}


function _formulario_texto($nombre, $marca_agua="",$valor="", $desactivar=false, $clase="form-control") {    
    
    $desactivado    = ($desactivar)? " disabled " : "";
    //$clase          = ($clase)? " form-control " : "";
    
    return "<input "
            . "type=\"text\" "
            . "class=\"$clase\" "
            . "name=\"$nombre\" "
            . "id=\"$nombre\" "
            . "placeholder=\"$marca_agua\" "
            . "value=\"$valor\" $desactivado > ";
}


function _formulario_opciones($tabla, $campo, $selecionado = "", $excluir = "") {
    global $conexion;
    $sql = mysql_query(
            "SELECT $campo FROM $tabla  ", $conexion) or die("Error:" . mysql_error());
    while ($reg = mysql_fetch_array($sql)) {

        echo "<option ";
        if ($selecionado == $reg[0]) {
            echo " selected ";
        } else {
            echo "";
        }
        if ($excluir == $reg[0]) {
            echo " disabled ";
        } else {
            echo "";
        }
        echo "value=\"$reg[0]\">$reg[0]</option>";
    }
}

function _formulario_radio($tabla, $campo, $selecionado = "", $excluir = "") {
    global $conexion;
    $sql = mysql_query(
            "SELECT $campo FROM $tabla  ", $conexion) or die("Error:" . mysql_error());
    while ($reg = mysql_fetch_array($sql)) {

        echo "<input ";
        if ($selecionado == $reg[0]) {
            echo " checked ";
        } else {
            echo "";
        }
        if ($excluir == $reg[0]) {
            echo " disabled ";
        } else {
            echo "";
        }
        echo "type=\"radio\" name=\"$campo\" id=\"$reg[0]\" value=\"$reg[0]\" ><label for=\"$reg[0]\">$reg[0]</label> \n";
    }
}

function _formulario_checkbox($tabla, $campo, $selecionar = "", $desactivar = "",$excluir="") {
    global $conexion;
    $sql = mysql_query(
            "SELECT $campo FROM $tabla  ", $conexion) or die("Error:" . mysql_error());
    while ($reg = mysql_fetch_array($sql)) {

        $seleccionado   =  ($selecionar == $reg[0]) ? " checked " : "" ;
        $excluido       =  ($excluir == $reg[0]) ? true : false ;
        $desactivado    =  ($desactivar == $reg[0]) ? " disabled " : "" ;
        
        if(!$excluido){
        echo "<input "
        . "$seleccionado "
                . "$excluido "
                . "$desactivado "
                . "type=\"checkbox\" "
                . "name=\"$reg[0]\" "
                . "id=\"$reg[0]\" "
                . "value=\"$reg[0]\" >"
                . "<label for=\"$reg[0]\">$reg[0]</label>\n ";
        }
    }
}


';
            return $fuente;
            break;
        case 'index.php':
            $fuente = '<?php 
$u_grupo = "admin";
include "bd.php";
include "conec.php";
include "coneccion.php";
include "funciones.php";
include "permisos.php";
incluir_funciones();
?>
<?php
    $p = (isset($_REQUEST[\'p\']))?  $_REQUEST[\'p\']  : "admin" ; 
    $c = (isset($_REQUEST[\'c\']))?  $_REQUEST[\'c\']  : "index" ; 
    
?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="MagiaPHP">
    <link rel="icon" href="../../favicon.ico">
    <title>Admin</title>
    <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <link href="starter-template.css" rel="stylesheet">
    <link href="modelo.css" rel="stylesheet" type="text/css"/>
  </head>
  <body>
<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" 
                    class="navbar-toggle collapsed" 
                    data-toggle="collapse" 
                    data-target="#navbar" 
                    aria-expanded="false" 
                    aria-controls="navbar">
                <span class="sr-only">Menu</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php">MagiaPHP</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">                                       
                <?php
                magia_menu($p);
                ?>
            </ul>
        </div>
    </div>
</nav>
      
      
<div class="container">  
<div class="row">
    <div class="col-lg-12">
    <?php
    $url = "./$p/controlador/";
    $url .= "$c";
    $url .= ".php";       
    include "$url";      
    ?>
    </div>
</div>
    </div><!-- /.container -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="../../dist/js/bootstrap.min.js"></script>
    <script src="../bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
  </body>
</html>
';
            return $fuente;
            break;
        case 'modelo.css':
            $fuente = 'body {
  padding-top: 50px;
}
.starter-template {
  padding: 40px 15px;
  text-align: center;
}';
            return $fuente;
            break;
        case 'permisos.php':
            $fuente = '<?php 
function permisos_obtiene_permiso($p,$g){
    global $conexion;
$sql=mysql_query( 
 "SELECT permiso  FROM _permisos WHERE grupo = \'$g\' and pagina = \'$p\'  ",$conexion);
 $reg = mysql_fetch_array($sql);	   
 return $reg[0];
}



function permisos_tiene_permiso($accion, $pagina, $grupo){  

if($accion==\'buscar\'){$accion = \'ver\';}


    $p = permisos_obtiene_permiso($pagina,$grupo);    
    $ver     = $p[0];
    $crear   = $p[1];
    $editar  = $p[2];
    $borrar  = $p[3];
    
    switch ($accion) {
        case "ver":
            //return ($ver == 1)? true:false; 
            return ($ver)? true:false; 
            break;
        
        case "crear":
            return ($crear)? true:false; 
            break;
        
        case "editar":
            return ($editar)? true:false; 
            break;
        
        case "borrar":
            return ($borrar)? true:false; 
            break;

        default: // por defecto enviamos falso
            return false;    
            break;
    }
    
    
    
    
}

function permisos_sin_permiso($accion, $pagina, $u_login){
    
    echo "Estimado $u_login, ud no puede realizar la accion [$accion] en la pagina [$pagina]"; 
    
}


';
            return $fuente;
            break;
        case 'traductor.php':
            $fuente = '<?php

function _traducir($f, $ccontexto="", $idioma="") {
    echo $f;
}

function _t($frase, $contexto="", $idioma="") {
global $config_idioma_por_defecto; 
   $idioma = (!$idioma)? $config_idioma_por_defecto : $idioma ;
   
   if(!$contexto){
       $contexto = "";
   }

$id_contenido = contenido_id_frase_segun_frase_contexto($frase, $contexto); 


if(!$id_contenido){
    contenido_registra($frase, $contexto);
$id_contenido = contenido_id_frase_segun_frase_contexto($frase, $contexto); 
}
    

// sacamos la traduccion 

$frase_traducida = traduccion_segun_id_contenido_idioma($id_contenido, $idioma);

// si no hay traduccion registramos la traduccicon 

if(!$frase_traducida){
    $traduccion = "$frase"; 
    
    traduccion_registra_traduccion($id_contenido, $idioma, $traduccion);
    $frase_traducida = traduccion_segun_id_contenido_idioma($id_contenido, $idioma);
}
    
    echo $frase_traducida;
}


// si existe devuelve la traduccion sino devuelve falso
function traduccion_segun_id_contenido_idioma($id_contenido,$idioma) {
    global $conexion;
   $sql=mysql_query("SELECT traduccion FROM _traducciones WHERE contenido_id = \'$id_contenido\' AND idioma = \'$idioma\' ",$conexion) 
       or die ("Error:".mysql_error());   
   $reg = mysql_fetch_array($sql);
   
    $total = mysql_num_rows($sql);
    if($total > 0){
        return $reg[0] ;
    }else{
        return FALSE;
    } 
    
}
function traduccion_registra_traduccion($id_contenido, $idioma, $traduccion) {
    global $conexion;
   $sql=mysql_query("INSERT INTO _traducciones (contenido_id, idioma, traduccion) VALUES (\'$id_contenido\',\'$idioma\',\'$traduccion\') ",$conexion) 
   or die ("Error:".mysql_error());     
return 0;
}';
            return $fuente;
            break;       
        case 'contenido.php':
            $fuente = '<?php

// si existe devuelve la traduccion sino devuelve falso
function contenido_id_frase_segun_frase_contexto($frase,$contexto="") {
    global $conexion;
    
    if(!$contexto){
        $filtro = " WHERE frase = \'$frase\' AND contexto =\'\' "; 
    } else {
        $filtro = " WHERE frase = \'$frase\' AND contexto = \'$contexto\'  "; 
    }
        
   $sql=mysql_query("SELECT id FROM _contenido $filtro ",$conexion) 
       or die ("Error:".mysql_error());   
   $reg = mysql_fetch_array($sql);
   
    $total = mysql_num_rows($sql);
    if($total > 0){
        return $reg[0];
    } else {
        return FALSE;
    } 
    
}
function contenido_registra($frase,$contexto="") {
    global $conexion;
    
    if(!$contexto){
        $contexto = null;
    }
    
   $sql=mysql_query("INSERT INTO _contenido (frase, contexto) "
           . "VALUES (\'$frase\',\'$contexto\') ",$conexion) 
   or die ("Error:".mysql_error());        
   
return 0;
}';
            return $fuente;
    
    
    case 'formularios.php':
            $fuente = '<?php


function formularios_campo_escondido($nombre,$valor){    
    echo \'<input type="hidden" name="\'.$nombre.\'" value="\'.$valor.\'">\'; 
}


function formularios_campo($tipo, $nombre, $id, $valor="", $clase="", $placeholder=""){    
    echo \'<input 
                type="\'.$tipo.\'" 
                name="\'.$nombre.\'" 
                value="\'.$valor.\'" 
                id="\'.$id.\'"                 
                class="\'.$clase.\'"                                     
                placeholder="\'.$placeholder.\'" > \'; 
}
function formularios_opciones(){
    
}
';
            return $fuente;
    }
}

function contenido_config($pagina) {
    switch ($pagina) {
        case 'footer.php':
            $fuente = '<br><br><br><br><br><br><br>
<br><br><br><br><br><br><br>
<br><br><br><br><br><br><br>
<br><br><br><br><br><br><br>
<br><br><br><br><br><br><br>
    </div><!-- /.container -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="../includes/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
  </body>
</html>
';
            return $fuente;
            break;
        case 'funciones.php':
            $fuente = '// funciones';
            return $fuente;
            break;
        case 'header.php':
            $fuente = 'header contenido';
            return $fuente;
            break;

        case 'index.php':
            $fuente = 'index contenido';
            return $fuente;
            break;


        case 'menu.php':
            $fuente = 'menu contanido';
            return $fuente;
            break;


        case 'modelo.css':
            $fuente = '';
            return $fuente;
            break;

        case 'z_verificar.php':
            $fuente = 'verif';
            return $fuente;
            break;
    }
}

function contenido_gestion($pagina) {
    switch ($pagina) {
        case 'estilo.css':
            $fuente = '/*-------------------------
    Simple reset
--------------------------*/


*{
    margin:0;
    padding:0;
}


/*-------------------------
    General Styles
--------------------------*/

/*----------------------------
    The file upload form
-----------------------------*/
#upload{
    font-family:\'PT Sans Narrow\', sans-serif;
    background-color:#373a3d;

    background-image:-webkit-linear-gradient(top, #373a3d, #313437);
    background-image:-moz-linear-gradient(top, #373a3d, #313437);
    background-image:linear-gradient(top, #373a3d, #313437);

    width:250px;
    padding:30px;
    border-radius:3px;

    margin:20px auto 100px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
    width: auto; 
}

#drop{
    background-color: #2E3134;
    padding: 40px 50px;
    margin-bottom: 30px;
    border: 20px solid rgba(0, 0, 0, 0);
    border-radius: 3px;
    border-image: url(\'../img/border-image.png\') 25 repeat;
    text-align: center;
    text-transform: uppercase;

    font-size:16px;
    font-weight:bold;
    color:#7f858a;
}




#drop input{
    display:none;
}

#upload ul{
    list-style:none;
    margin:0 -30px;
    border-top:1px solid #2b2e31;
    border-bottom:1px solid #3d4043;
}

#upload ul li{

    background-color:#333639;

    background-image:-webkit-linear-gradient(top, #333639, #303335);
    background-image:-moz-linear-gradient(top, #333639, #303335);
    background-image:linear-gradient(top, #333639, #303335);

    border-top:1px solid #3d4043;
    border-bottom:1px solid #2b2e31;
    padding:15px;
    height: 52px;

    position: relative;
}

#upload ul li input{
    display: none;
}

#upload ul li p{
    width: 144px;
    overflow: hidden;
    white-space: nowrap;
    color: #EEE;
    font-size: 16px;
    font-weight: bold;
    position: absolute;
    top: 20px;
    left: 100px;
}

#upload ul li i{
    font-weight: normal;
    font-style:normal;
    color:#7f7f7f;
    display:block;
}

#upload ul li canvas{
    top: 15px;
    left: 32px;
    position: absolute;
}

#upload ul li span{
    width: 15px;
    height: 12px;
    background: url(\'../img/icons.png\') no-repeat;
    position: absolute;
    top: 34px;
    right: 33px;
    cursor:pointer;
}

#upload ul li.working span{
    height: 16px;
    background-position: 0 -12px;
}

#upload ul li.error p{
    color:red;
}
';
            return $fuente;
            break;
        case 'index.php':
            $fuente = '<?php
session_start("inmoweb_username") ;
$u_grupo = "root";
include "z_verificar.php";
include "../admin/bd.php";
include "../admin/configuracion.php";
include "../admin/coneccion.php";
include "../admin/conec.php";
include "../admin/funciones.php";
include "../admin/permisos.php";
include "../admin/traductor.php";
_incluir_funciones();
$aqui_seccion = "";
$aqui_pagina = "";
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="icon" href="favicon.ico">

        <title><?php echo "$config_nombre_web"; ?></title>

        <link rel="stylesheet" href="../includes/js/jquery-ui-1.10.3/themes/base/jquery.ui.all.css">
        <link rel="stylesheet" href="../includes/js/jquery-ui-1.10.3/demos.css">
        <script src="../includes/js/jquery-ui-1.10.3/jquery-1.9.1.js"></script>
        <script src="../includes/js/jquery-ui-1.10.3/ui/jquery.ui.core.js"></script>
        <script src="../includes/js/jquery-ui-1.10.3/ui/jquery.ui.widget.js"></script>
        <script src="../includes/js/jquery-ui-1.10.3/ui/jquery.ui.datepicker.js"></script>
        <script src="../includes/js/jquery-ui-1.10.3/ui/jquery.ui.tabs.js"></script>

        <link href="../includes/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="../modelos/font-awesome/css/font-awesome.min.css">
        <link href="home/vista/gestion.css" rel="stylesheet">
        <script src="../includes/bootstrap/js/ie-emulation-modes-warning.js"></script>
        <link href="estilo.css" rel="stylesheet" />


    </head>

    <body>

<?php
include "home/vista/nav_sup.php";
?>

        <div class="container-fluid"> <!-- 1 -->
            <div class="row">	<!-- 2 -->

                <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main"> <!-- 3 --> 

<?php
$p = (isset($_REQUEST[\'p\']))? $_REQUEST[\'p\']  : "home" ;
$c = (isset($_REQUEST[\'c\']))? $_REQUEST[\'c\']  : "index" ;



switch ($p) {
    case \'config\':
        include "config/vista/sidebar.php";
        break;

    default:
        include "home/vista/sidebar.php";
        break;
}


include \'./\'.$p.\'/controlador/\'.$c.\'.php\';

?>

                </div>	  <!-- /3 --> 
            </div>  <!-- /2 -->
        </div>	<!-- /1 -->

<?php
include "home/vista/footer.php";
?>

        <!-- JavaScript Includes -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
        <script src="./img2/assets/js/jquery.knob.js"></script>

        <!-- jQuery File Upload Dependencies -->
        <script src="./img2/assets/js/jquery.ui.widget.js"></script>
        <script src="./img2/assets/js/jquery.iframe-transport.js"></script>
        <script src="./img2/assets/js/jquery.fileupload.js"></script>

        <!-- Our main JS file -->
        <script src="./img2/assets/js/script.js"></script>


    </body>
</html>

';
            return $fuente;
            break;
        case 'z_index.php':
            $fuente = 'z-index contenido';
            return $fuente;
            break;

        case 'z_login.php':
            $fuente = 'z_login contenido';
            return $fuente;
            break;


        case 'z_logount.php':
            $fuente = 'logunt contanido';
            return $fuente;
            break;


        case 'z_verificar.css':
            $fuente = 'z-verfi';
            return $fuente;
            break;

        case 'z_login.php':
            $fuente = 'zz_login';
            return $fuente;
            break;
    }
}

function registrar_pagina_en_bd($pagina) {
    global $dbh;
    $sql = "INSERT INTO _paginas (pagina) VALUES (:pagina)";
    $stmt = $dbh->prepare($sql);
    $stmt->execute(array(
        ":pagina" => "$pagina"
            )
    );
}

function registrar_permiso_pagina_grupo($grupo, $pagina, $permiso) {
    global $dbh;
    $sql = "INSERT INTO _permisos (grupo,pagina,permiso) VALUES (:grupo,:pagina,:permiso)";
    $stmt = $dbh->prepare($sql);
    $stmt->execute(array(
        ":grupo" => "$grupo",
        ":pagina" => "$pagina",
        ":permiso" => "$permiso",
            )
    );
}

/**
 * 
 * @global type $dbh
 * @param type $nombre_carpeta
 */
function registra_item_al_menu($nombre_carpeta, $padre, $label) {
    global $dbh;
    
    $sql = "INSERT INTO _menu (padre,label,url,orden) VALUES (:padre,:label,:url,:orden)";
    $stmt = $dbh->prepare($sql);
    $stmt->execute(array(
        ":padre" => "$padre",
        ":label" => "$label",
        ":url" => "?p=$nombre_carpeta&c=index",
        ":orden" => 0
            )
    );
}

/**
 * Esta funcion es la que crea los diferentes ficheros dentro de : Modelos, vista, controlador, reg, del plugin
 * @global type $path_magia_plugins
 * @global type $dbh
 * @param type $nombrePlugin
 * @param type $mvcg
 */
function magia_crear_ficheros_dentro_mvc($nombrePlugin, $mvcg) {
    global $path_plugins, $dbh, $icon_fichero_copiar;

    switch ($mvcg) {
        case 'controlador':
            $c = ['index.php', 'ver.php', 'crear.php', 'editar.php', 'borrar.php', 'buscar.php'];            
            $i = 0;
            while ($i < count($c)) {
                $path = "$path_plugins/$nombrePlugin/controlador";
                // este va a ser el contedido que vamos a escribir en el documento
                $contenido = contenido_controlador($c[$i], $nombrePlugin);
                crear_fichero($path, "$c[$i]", $contenido);
                $i++;
            }
            break;
        case 'modelos':
            $c = ['index.php', 'ver.php', 'crear.php', 'editar.php', 'borrar.php', 'buscar.php'];            
            $i = 0;
            while ($i < count($c)) {
                $path = "$path_plugins/$nombrePlugin/modelos";
                // este va a ser el contedido que vamos a escribir en el documento
                $contenido = contenido_modelos($c[$i], $nombrePlugin);
                crear_fichero($path, "$c[$i]", $contenido);
                $i++;
            }
            break;
        case 'reg':
            $c = ['get.php', 'post.php', 'reg.php', 'request.php'];            
            $i = 0;
            while ($i < count($c)) {
                $path = "$path_plugins/$nombrePlugin/reg";
                // este va a ser el contedido que vamos a escribir en el documento
                $contenido = contenido_reg($c[$i], $nombrePlugin);                
                crear_fichero($path, "$c[$i]", $contenido);
                $i++;
            }
            break;
        case 'vista':
            //estas son las paginas  a crear
            $c = [
                'borrar.php',
                'buscar.php',
                'crear.php',
                'editar.php',
                'index.php',
                'sidebar.php',
                'menu.php',
                'tr.php',
                'tr_anadir.php',
                'tr_editar.php',
                'tr_buscar.php',
                'ver.php'
            ];
            $total = count($c);
            $i = 0;
            while ($i < $total) {
                $path = "$path_plugins/$nombrePlugin/vista";
                // este va a ser el contedido que vamos a escribir en el documento
                $contenido = contenido_vista($c[$i], $nombrePlugin);
                crear_fichero($path, "$c[$i]", $contenido);
                $i++;
            }
            break;
        case 'raiz':

            $c = [
                'funciones.php',
                'index.php',
                'readme.txt',
                'COPYING',
                '.gitignore',
                'version',
                'menu'
            ];                
            $total = count($c);
            $i = 0;
            while ($i < $total) {
                $path = "$path_plugins/$nombrePlugin";
                // este va a ser el contedido que vamos a escribir en el documento                
                $contenido = contenido_plugin($c[$i], $nombrePlugin);
                crear_fichero($path, "$c[$i]", $contenido);
                echo "<p>-----<b>$icon_fichero_copiar</b> $c[$i] se ha llenado el contenido </p>";
                $i++;
            }

            break;

        default :
            break;
    }
}

function magia_crear_ficheros_en_proyecto($nombreProyecto) {
    global $path_web, $icon_fichero_copiar;


    // preparo las carpetas a crear    
    $carpetas = [
        'admin',
        'gestion',
        'imagenes',
        'includes',
        'extenciones'
    ];
    // con esto creo las carpetas
    crear_carpetas($path_web, $carpetas);
    // copiamos el home en gestion y en config
    copiar_carpeta("./codigo_fuente/gestion", "$path_web/gestion");
    copiar_carpeta("./codigo_fuente/includes", "$path_web/includes");
    copiar_carpeta("./codigo_fuente/extenciones/funciones", "$path_web/extenciones/funciones");


    // ahora creamos los ficheros dentro de las carpetas
    // llenamos el contenido de los ficheros

    $i = 0;
    while ($i < count($carpetas)) {
        if (file_exists("$path_web/$carpetas[$i]")) {
            // creamos los ficheros denttro de cada carpeta del proyecto
            switch ($carpetas[$i]) {
                case 'admin':
                    $ficheros = [
                        'bd.php',
                        'conec.php',
                        'coneccion.php',
                        'configuracion.php',
                        'funciones.php',
                        'index.php',
                        'modelo.css',
                        'permisos.php',
                        'traductor.php',
                        'contenido.php',
                        'formularios.php'
                    ];                   
                    $j = 0;
                    while ($j < count($ficheros)) {
                        crear_fichero("$path_web/admin", $ficheros[$j], contenido_admin($ficheros[$j]));
                        $j++;
                    }
                    break;
                case 'config':
                    $ficheros = [
                        'footer.php',
                        'funciones.php',
                        'header.php',
                        'index.php',
                        'menu.php',
                        'modelo.css',
                        'z_verificar.php'
                    ];
                    crear_carpeta($path_web, 'config');
                    $j = 0;
                    while ($j < count($ficheros)) {
                        crear_fichero("$path_web/config", $ficheros[$j], contenido_config($ficheros[$j]));
                        $j++;
                    }
                    break;
                case 'gestion---------------------':
                    $ficheros = [
                        'estilo.css',
                        'index.php',
                        'z_index.php',
                        'z_login.php',
                        'z_logout.php',
                        'z_verificar.php',
                        'zz_login.php'
                    ];
                    crear_carpeta($path_web, 'gestion');

                    $j = 0;
                    while ($j < count($ficheros)) {

                        crear_fichero("$path_web/gestion", $ficheros[$j], contenido_gestion($ficheros[$j]));
                        $j++;
                    }
                    break;
            }
        }

        $i++;
    }

    // con esto creo el index de la parte publica del proyecto
    crear_fichero($path_web, 'index.php', 'inicio');
}

function _t($palabra) {
    return $palabra;
}

?>
