
<h1 class="page-header">
</span> <a href="?p=magia">/</a><?php echo "$tabla"; ?>/vista/index.php
</h1>


<textarea class="form-control" rows="20">
<h4>
    &lt;?php echo _t('Lista de <?php echo $tabla; ?>'); ?>     
</h4>	

<table class="table table-striped">
    <thead>
        <tr> 
            <?php 
            foreach($resultado as $reg ) {
                include "./reg/reg.php";
                echo '<th>&lt;?php echo _t("'.$mayusculas_pri_let_de_frase.'"); ?></th>';
                
                echo '
                ';
            }
            ?>  
            <th>&lt;?php echo _t('Accion'); ?></th>
        </tr>
    </thead>
    <tbody>
        &lt;?php
        while ($reg = mysql_fetch_array($sql)) {
            include "<?php echo "$path_magia_plugins/$tabla"; ?>/reg/reg.php";
                if(permisos_tiene_permiso('editar', '<?php echo $tabla; ?>', $u_grupo)){
                    include "<?php echo "$path_magia_plugins/$tabla"; ?>/vista/tr_editar.php";
                }else{
                    include "<?php echo "$path_magia_plugins/$tabla"; ?>/vista/tr.php";
                }            
        }
        ?>
    </tbody>
     &lt;?php
   if(permisos_tiene_permiso('crear', '<?php echo "$tabla"; ?>', $u_grupo)){
                include "<?php echo "$path_magia_plugins/$tabla"; ?>/vista/tr_anadir.php";
            }
   ?>
    
    
</table> 


</textarea>


<br><br><br><br><br><br><br><br><br><br><br><br>
<br><br><br><br><br><br><br><br><br><br><br><br>
<br><br><br><br><br><br><br><br><br><br><br><br>
<br><br><br><br><br><br><br><br><br><br><br><br>
<br><br><br><br><br><br><br><br><br><br><br><br>
<br><br><br><br><br><br><br><br><br><br><br><br>


