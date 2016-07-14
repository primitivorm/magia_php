<?php
// para mostrar los errores
error_reporting(E_ALL);
ini_set('display_errors', '1');
     
include "./admin/bd.php";
include "./admin/config.php";
include "./admin/conec.php";
include "./admin/coneccion.php";
include "./admin/funciones.php";
include "./admin/gestion_bd.php";
include "./admin/permisos.php";
?>
<?php
if (isset($_REQUEST['a'])) {
    $a = $_REQUEST['a'];
} else {
    $a = "";
}
if (isset($_REQUEST['p'])) {
    $p = $_REQUEST['p'];
} else {
    $p = "index";
}
if (isset($_REQUEST['c'])) {
    $c = $_REQUEST['c'];
} else {
    $c = "index";
}
if (isset($_REQUEST['tabla'])) {
    $tabla = mysql_real_escape_string($_REQUEST['tabla']);
}
?>
<html>
    <head>
        <title>Magia php</title>

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>  
        <link href="estilo.css" rel="stylesheet" type="text/css"/>
    </head>

    <body>
        <div class="container">
            
           
            
            <?php
            include "./vista/header.php";
            ?>

            <?php
            if ($a == 'configBd') {
                include "./request/updateDb.php";
            }

            if ($a == 'config') {
                include "./request/config.php";
            }
            ?>

            <div class="row">
                <div class="col-lg-3">
                    
                    
                    <?php
                    if (isset($tabla)) {
                        include "./vista/menu.php";
                    }
                    
                    if($p =='maqueta' ){
                       include "./vista/maqueta_izq.php"; 
                    }
                    
                     if($p=='index'){
                       include "./vista/izq.php"; 
                    }
                    
                    
                    ?>                  

                </div>
                <div class="col-lg-9">

                    <?php
                    switch ($p) {
// borrar         
                        case "c_borrar":
                            include "./modelos/v_detalles.php";
                            include "./vista/c_borrar.php";
                            break;
// c_buscar         
                        case "c_buscar":
                            include "./modelos/v_detalles.php";
                            include "./vista/c_buscar.php";
                            break;

// c_crear         
                        case "c_crear":
                            include "./modelos/v_detalles.php";
                            include "./vista/c_crear.php";
                            break;

// c_detalles         
                        case "c_detalles":
                            include "./modelos/v_detalles.php";
                            include "./vista/c_detalles.php";
                            break;
// c_ver         
                        case "c_ver":
                            include "./modelos/v_detalles.php";
                            include "./vista/c_ver.php";
                            break;

// c_editar         
                        case "c_editar":
                            include "./modelos/v_detalles.php";
                            include "./vista/c_editar.php";
                            break;

// c_index         
                        case "c_index":
                            // include "modelos/v_detalles.php";
                            include "./vista/c_index.php";
                            break;



// d_get         
                        case "d_get":
                            include "./modelos/v_detalles.php";
                            include "./vista/d_get.php";
                            break;

// d_post         
                        case "d_post":
                            include "./modelos/v_detalles.php";
                            include "./vista/d_post.php";
                            break;

// d_request         
                        case "d_request":
                            include "./modelos/v_detalles.php";
                            include "./vista/d_request.php";
                            break;



// m_borrar         
                        case "m_borrar":
                            include "./modelos/v_detalles.php";
                            include "./vista/m_borrar.php";
                            break;
// m_buscar         
                        case "m_buscar":
                            include "./modelos/v_detalles.php";
                            include "./vista/m_buscar.php";
                            break;
// m_crear         
                        case "m_crear":
                            include "./modelos/v_detalles.php";
                            include "./vista/m_crear.php";
                            break;


// m_editar         
                        case "m_editar":
                            include "./modelos/v_detalles.php";
                            include "vista/m_editar.php";
                            break;

// m_index         
                        case "m_index":
                            //include "modelos/m_index.php";
                            include "./vista/m_index.php";
                            break;


// m_ver         
                        case "m_ver":
                            include "./modelos/v_detalles.php";
                            include "./vista/m_ver.php";
                            break;





// r_registros         
                        case "r_registros":
                            include "./modelos/v_detalles.php";
                            include "./vista/r_registros.php";
                            break;








// v_crear         
                        case "v_crear":
                            // include "./modelos/v_crear.php";
                            include "./vista/v_crear.php";
                            break;
// v_detalles         
                        case "v_ver":
                            // include "./modelos/v_ver.php";
                            include "./vista/v_ver.php";
                            break;
// Detalles1         
                        case "v_detalles1":
                            include "./modelos/v_detalles.php";
                            include "./vista/v_detalles1.php";
                            break;

// v_editar         
                        case "v_editar":
                            // include "./modelos/v_editar.php";
                            include "./vista/v_editar.php";
                            break;

// v_index         
                        case "v_index":
                            include "./modelos/v_detalles.php";
                            include "./vista/v_index.php";
                            break;

// v_borrar         
                        case "v_borrar":
                            //include "./modelos/v_borrar.php";
                            include "./vista/v_borrar.php";
                            break;


// v_tr         
                        case "v_tr":
                            include "./modelos/v_detalles.php";
                            include "./vista/v_tr.php";
                            break;

// v_tr_anadir         
                        case "v_tr_anadir":
                            include "./modelos/v_detalles.php";
                            include "./vista/v_tr_anadir.php";
                            break;

// v_tr_editar         
                        case "v_tr_editar":
                            include "./modelos/v_detalles.php";
                            include "./vista/v_tr_editar.php";
                            break;



// configBd         
                        case "configBd":                            
                            include "./vista/configBd.php";
                            break;


// define_variables         
                        case "config":
                            //include "./modelos/config.php";
                            include "./vista/config.php";
                            break;


// plugins_crear         
                        case "plugins_crear":
                            include "./modelos/plugins_crear.php";
                            include "./vista/plugins_crear.php";
                            break;
// plugins_lista         
                        case "plugins_lista":
                            include "./modelos/plugins_lista.php";
                            include "./vista/plugins_lista.php";
                            break;
// plugins_lista         
                        case "detalles_tabla":
                            include "./modelos/detalles_tabla.php";
                            include "./vista/detalles_tabla.php";
                            break;
// crear_proyecto         
                        case "crear_proyecto":
                           include "./modelos/crear_proyecto.php";
                           include "./vista/crear_proyecto.php";
                            break;
// copiar_bd         
                        case "copiar_bd":
                            include "./modelos/copiar_bd.php";
                          //  include "./vista/copiar_bd.php";
                            break;
                        
                        
//    maqueta                      
                        case "maqueta":                            
                            include "./vista/maqueta.php";
                            break;



                        default :
                            //  include "./modelos/index.php";
                            include "./vista/index.php";
                            break;
                    }
                    ?>        


                </div>
                

            </div>


        </div>            
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="http://getbootstrap.com/dist/js/bootstrap.min.js"></script>

    </body>
</html>









