

<h1 class="page-header">
</span> <a href="?p=magia">/</a><?php echo "$tabla"; ?>/reg/ [post]
</h1>


Sin proteccion SQL
<textarea class="form-control" rows="10">
&lt;?php
<?php 
foreach($resultado as $reg ) {
    $min = strtolower($reg[0]); // la cadena a minusculas
    $MAY = strtoupper($reg[0]); // string en mayusculas
    $May = ucfirst($reg[0]); // el primero de la frase
    $Mcp = ucwords($reg[0]); // El primero de cada palabra
    $Mlf = mb_strtoupper($reg[0]);
    $tipo_campo = $reg[1];
    
    echo '$'.$reg[0].' = $_POST[\''.$reg[0].'\']);';
    //echo '$'.$reg[0].' = mysql_real_escape_string($_POST[\''.$reg[0].'\']);';
    echo "\n";        
}
?>
</textarea>

Proteccion sql
<textarea class="form-control" rows="10">
&lt;?php
<?php 
foreach($resultado as $reg ) {
    $min = strtolower($reg[0]); // la cadena a minusculas
    $MAY = strtoupper($reg[0]); // string en mayusculas
    $May = ucfirst($reg[0]); // el primero de la frase
    $Mcp = ucwords($reg[0]); // El primero de cada palabra
    $Mlf = mb_strtoupper($reg[0]);
    $tipo_campo = $reg[1];
    
    echo '$'.$reg[0].' = mysql_real_escape_string($_POST[\''.$reg[0].'\']);';
    echo "\n";        
}
?>
</textarea>






<br><br><br><br><br><br><br><br><br><br>
<br><br><br><br><br><br><br><br><br><br>
<br><br><br><br><br><br><br><br><br><br>
<br><br><br><br><br><br><br><br><br><br>
<br><br><br><br><br><br><br><br><br><br>
<br><br><br><br><br><br><br><br><br><br>
<br><br><br><br><br><br><br><br><br><br>
<br><br><br><br><br><br><br><br><br><br>
<br><br><br><br><br><br><br><br><br><br>
<br><br><br><br><br><br><br><br><br><br>
<br><br><br><br><br><br><br><br><br><br>
<br><br><br><br><br><br><br><br><br><br>


