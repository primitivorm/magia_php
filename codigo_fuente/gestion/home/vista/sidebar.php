


﻿ <div class="col-sm-3 col-md-2 sidebar">
 
        <ul class="nav nav-sidebar">
            
            
            
            
            <?php if (permisos_tiene_permiso("ver", "home", $u_grupo) == true) { ?>            
                <li <?php if ($p == "home") { echo " class=\"active\" "; } ?> >
                    <a href="?p=home&c=index">
                        <span class="glyphicon glyphicon-folder-close"></span> 
                <?php _t("Inicio"); ?>
                    </a>
                </li>
            <?php } ?>        
            
            
            
            <?php 
            _magia_menu($p);
            ?>
      
                        
</ul>
       


    
    
    
		  
</div> 							
