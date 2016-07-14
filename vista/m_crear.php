<h1 class="page-header">
</span> <a href="?p=magia">/</a><?php echo "$tabla"; ?>/modelos/crear.php
</h1>


<textarea class="form-control" rows="50">
&lt;?php
$sql = "INSERT INTO <?php echo "$tabla";  ?> (
<?php 
$t = count($resultado);
$i=0;
foreach($resultado as $reg ) {
    echo "$reg[0]"; 
    echo $c = ($i < $t-1)?",":"";
    $i++;
}
?>

) VALUES (
<?php 
$t = count($resultado);
$i=0;
foreach($resultado as $reg ) {
    echo ":$reg[0]"; 
    echo $c = ($i < $t-1)?",":"";
    $i++;
}
?>
)";
$stmt = $dbh-&gt;prepare($sql);
$stmt-&gt;execute(array(
<?php 
$t = count($resultado);
$i=0;
foreach($resultado as $reg ) {
    echo '":'.$reg[0].'"=&gt;"$'.$reg[0].'"
            '; 
    
    echo $c = ($i < $t-1)?",":"";
    $i++;
}
?>
)
);
$mensaje = "Realizado con exito";







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


