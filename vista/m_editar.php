<h1 class="page-header">
</span> <a href="?p=magia">/</a><?php echo "$tabla"; ?>/modelos/editar.php
</h1>


<textarea class="form-control" rows="50">
&lt;?php 
$sql=mysql_query(" UPDATE <?php echo "$tabla"; ?> SET 
<?php 
$t = count($resultado);
$i=0;
foreach($resultado as $reg=>$item ) {
    //echo var_dump($item);
    echo "$item[Field] = '$$item[Field]'"; 
    echo $c = ($i < $t-1)?",":"";
    $i++;
}
?>


WHERE id = '$id' ",$conexion) or die ("Error: ".mysql_error());  





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


