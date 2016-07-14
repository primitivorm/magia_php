<?php
include "admin/bd.php";
include "admin/config.php";
include "admin/conec.php";
include "admin/coneccion.php";
include "admin/funciones.php";
include "admin/permisos.php";

$u_grupo = "Mareados"; 



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
        <title>Magia</title>
        
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>  
    </head>

    <body>
        <div class="container">
            <?php
            include "vista/header.php";
            ?>


            

            <div class="row">

                
                <div class="col-lg-12">


                    <?php 
                                include "$path_magia_plugins/$p/controlador/$c.php";
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




