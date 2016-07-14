<textarea class="form-control" rows="30">

&lt;?php
$borrar = (permisos_tiene_permiso('borrar', '<?php echo $tabla; ?>', $u_grupo))?'<a class="btn btn-danger" href="index.php?p=<?php echo $tabla; ?>&c=borrar&a=borrar&id='.$id.'">Borrar</a>':'';
?>

<form method="post" action="index.php" >
    <input type="hidden" name="p" value="<?php echo $tabla; ?>">
    <input type="hidden" name="c" value="editar">    
    <input type="hidden" name="a" value="editar">
    
    
    <input type="hidden" name="id" value="&lt;?php echo $id; ?>">    
    <tr>
        
        <?php 
        foreach($resultado as $reg ) {
           
            echo '<td><input class="form-control" type="text" name="'.$reg[0].'" value="&lt;?php echo $'.$reg[0].'; ?>" placeholder=""></td>
            '; 
        }
        ?>
        <td><input class="btn btn-primary" type="submit" value="Registrar" >
        &lt;?php echo $borrar; ?>
        </td>        
    </tr>
</form> 




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