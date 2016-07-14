<?php 
echo '<div class="form-group">
    <label for="'.$name.'" class="col-sm-2 control-label">'.$mayusculas_pri_let_de_frase.'</label>
    <div class="col-sm-10">
    <p class="form-control-static">&lt;?php echo $'.$name.'; ?&gt;</p>
    </div>
  </div>
  
  '; 
?>

        <td>
            <input 
                class="form-control" 
                type="text" 
                name="&lt;?php echo $name; ?&gt;" 
                value="&lt;?php echo $name; ?&gt;"
                >
        </td>
        <td>
            actualizar | editar
        </td>
