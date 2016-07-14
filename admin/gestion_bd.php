<?php
// para crear la tabla 
function gestion_bd_crear_tabla(){
global $servidor, $bdatos, $usuario, $clave; 
// Create connection
$conn = new mysqli($servidor, $usuario, $clave, $bdatos);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = explode(";",file_get_contents('bd_extructura.sql'));

foreach($sql as $query) {

    if ($conn->query($query) === TRUE) {
        echo "<p>Table: $ query creada con exito</p>";
    } else {
        echo "<p>Error creating table: $query[0] " . $conn->error . "</p>";
    }

}




$conn->close();

    
}






