<h1 class="page-header">
</span> <a href="?p=magia">/</a><?php echo "$tabla"; ?>/modelos/ver.php
</h1>

SQL
<textarea class="form-control" rows="10">
&lt;?php 
$sql=mysql_query(
        "SELECT * FROM "
        . "<?php echo "$tabla";  ?> WHERE id = '$id' " 
        . "ORDER BY id DESC   ",$conexion) or die ("Error:".mysql_error());
$reg = mysql_fetch_array($sql);
	

</textarea>





PDO
<textarea class="form-control" rows="10">
&lt;?php
            $sql        = "SELECT FROM <?php echo "$tabla";  ?> WHERE id = :id";
            $stmt       = $dbh->prepare($sql);
            $stmt->execute(array(           
                ":id"=>"$id"
                )
            );        
            $reg = $stmt->fetchAll(); 



</textarea>









