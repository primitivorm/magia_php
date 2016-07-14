

<h1 class="page-header">
</span> <a href="?p=magia">/</a><?php echo "$tabla"; ?>/vista/crear.php

</h1>






<textarea rows="20" class="form-control">
    <form class="form-horizontal" action="index.php" method="post">
        <input type="hidden" name="p" value="<?php echo $tabla; ?>">        
        <input type="hidden" name="c" value="crear">        
        <input type="hidden" name="a" value="crear">      
    
    <?php
    foreach ($resultado as $reg) {
        include '../magia/reg/reg.php';
        include '../magia/vista/input_add.php';
    }
    ?>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-primary">Rgistrar</button>
    </div>
  </div>    
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
<br><br><br><br><br><br><br><br><br><br>
<br><br><br><br><br><br><br><br><br><br>