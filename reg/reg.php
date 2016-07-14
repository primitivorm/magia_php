<?php 

$name                           = $reg[0];
$tipo_campo                     = $reg[1];


$sin_barra_inferior             = str_replace("_"," ",$reg[0]);    
$todo_minusculas                = strtolower($sin_barra_inferior); // la cadena a minusculas
$todo_mayusculas                = strtoupper($todo_minusculas); // string en mayusculas
$mayusculas_pri_let_de_frase    = ucfirst($todo_minusculas); // el primero de la frase
$mayusculas_pri_let_cad_pal      = ucwords($todo_minusculas); // El primero de cada palabra
$mayusculas_tod_la_fra          = mb_strtoupper($todo_minusculas); // toda la frase en mayuscula

             
 