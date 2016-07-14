

<h1 class="page-header">
</span> <a href="?p=magia">/</a><?php echo "$tabla"; ?>/modelos/borrar.php

</h1>



SQL
<textarea class="form-control" rows="15">
&lt;?php
$sql=mysql_query("
DELETE FROM 
<?php echo "$tabla";  ?> 
WHERE
id = '$id'
",$conexion) or die ("Error ".mysql_error());

$mensaje = "Realizado";


</textarea>

PDO

<textarea class="form-control" rows="15">
&lt;?php
$sql = "DELETE FROM <?php echo "$tabla";  ?> WHERE id=:id)"; $stmt = $dbh->prepare($sql);
$stmt->execute(array(
":id"=>"$id" 
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


