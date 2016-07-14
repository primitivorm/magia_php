

<h1 class="page-header">
</span> <a href="?p=magia">/</a><?php echo "$tabla"; ?>/reg/ [request]
</h1>


Sin proteccion sql
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
    
    echo '$'.$reg[0].' = $_REQUEST[\''.$reg[0].'\']);';
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
    
    echo '$'.$reg[0].' = mysql_real_escape_string($_REQUEST[\''.$reg[0].'\']);';
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


