Tablas

<form>
    <select class="form-control" name="">
    <?php 
    $tablas = ["uno","dos"];
    
    $i = 0;         
    while ($i < count($tablas)) {
        echo "<option>$tablas[$i]</option>";
        $i++; 
    }
    ?>
</select>
    
    
</form>



Campos de la tabla xxxxxxx

<?php
$campos = ["id","nombres","apellidos","login","clave","estatus"];
        
?>
<ul>
    
    <?php 
    $i=0;
    while ($i < count($campos)){
        echo "<li><a href=\"?p=maqueta&campo=$campos[$i]\">$campos[$i] - xxxx</a></li>";
        $i++;
    }
    ?>
</ul>

Ver el formulario

