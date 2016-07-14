<textarea class="form-control" rows="30">


<form method="post" action="index.php" >
    <input type="hidden" name="p" value="<?php echo $tabla; ?>">
    <input type="hidden" name="c" value="crear">    
    <input type="hidden" name="a" value="crear">    
    <tr>
        

        <?php 
        foreach($resultado as $reg ) {
           
            echo '<td><input class="form-control" type="text" name="'.$reg[0].'" value="" placeholder=""></td>
            '; 
        }
        ?>

        <td><input class="btn btn-primary" type="submit" value="Registrar" ></td>
        
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