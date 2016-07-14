<?php
session_start("magia_php");
error_reporting(E_ALL);
ini_set('display_errors', '1');
include "../admin/bd.php";
include "../admin/coneccion.php";



if ($_POST['username']) {

    $username = mysql_real_escape_string($_REQUEST['username']);
    $password = mysql_real_escape_string($_REQUEST['password']);

    if (!$username) {
        header("Location: zz_login.php");
        echo "Forget your login";
    }

    if (!$password) {
        header("Location: zz_login.php");
        echo "Forget your pass";
    }





    if ($username) {
        $query = mysql_query("SELECT usuario,clave "
                . "FROM _usuarios "
                . "WHERE usuario = '$username'")

                or die("<h1>Errores</h1> "
                        . "<b>Carpeta:</b>: " . __DIR__ . "<br>"
                        . "<b>Documento:</b>:" . __FILE__ . "<br>"
                        . "<b>Linea:</b>:" . __LINE__ . "<br>"
                        . "<b>Error SQL:</b>:" . mysql_error() . "<br>");

        $reg = mysql_fetch_array($query);

        if ($reg['clave'] == $password) {
            header("Location: index.php");
            echo "login ok";
            $_SESSION["s_username"] = $reg['usuario'];
        } else {
            header("Location: zz_login.php");
            echo "Login correcto";
        }
    }
}

echo "<hR>llego al gin<hr>"; 
?> 	