<h1 class="page-header">
</span> <a href="?p=magia">/</a><?php echo "$tabla"; ?>/modelos/buscar.php
</h1>


SQL
<textarea class="form-control" rows="10">
&lt;?php 
$sql=mysql_query(
        "SELECT * 
FROM <?php echo "$tabla";  ?> 
WHERE 
<?php 
$t = count($resultado);
$i=0;
foreach($resultado as $reg=>$item ) {
    //echo var_dump($item);
    echo "$item[Field] like ".'\'%$busqueda%\''; 
    echo $c = ($i < $t-1)?" OR ":"";
    $i++;
}
?>

ORDER BY id DESC   
",$conexion) or die ("Error:".mysql_error());	

</textarea>


PDO
<textarea class="form-control" rows="10">




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


