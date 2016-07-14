<h1>Web</h1>

<p>Donde deseas crear tu web?</p>


<?php
/*
 * 
echo "La carpeta donde se instalar los plugins (path_instalacion_plugins) es: ";
echo "$path_web";
echo "<br>";
echo "La carpeta donde se instalara los archivos de gestion (path_plugins) es: ";
echo "$path_plugins";
echo "<br>";




echo "La carpeta donde se instalar los controladores es: ";
echo "$path_plugins_controlador";
echo "<br>";
echo "La carpeta donde se instalar los modelos es: ";
echo "$path_plugins_modelos";
echo "<br>";
echo "La carpeta donde se instalar las vistas es: ";
echo "$path_plugins_vista";

echo "<br>";
echo "La carpeta donde se instalar los registros es: ";
echo "$path_plugins_reg";
 * 
 */
?>

<hr>

<form class="form-horizontal" action="" method="post">
    <input type="hidden" name="a" value="config">
    <input type="hidden" name="p" value="index">


    <div class="form-group">
        <label for="path_web" class="col-sm-2 control-label">
            Raiz de tu web</label>
        <div class="col-sm-10">
            <input type="text" 
                   name="path_web" 
                   class="form-control" 
                   id="path_web" 
                   placeholder="/home/robinson/public_html/miweb" 
                   value="<?php echo "$path_web"; ?>">
        </div>
    </div>

    <div class="form-group">
        <label for="path_magia_plugins" class="col-sm-2 control-label">
            Gestion</label>
        <div class="col-sm-10">
            <input type="text" 
                   name="path_plugins" 
                   class="form-control" 
                   id="path_plugins" 
                   placeholder="/home/robinson/public_html/miweb/gestion" 
                   value="<?php echo "$path_plugins"; ?>"
                   readonly="">
        </div>
    </div>

    
    
    <div class="form-group">
        <label for="path_plugins_controlador" class="col-sm-2 control-label">Path Controlador</label>
        <div class="col-sm-10">
            <input type="text" 
                   name="path_plugins_controlador" 
                   class="form-control" 
                   id="path_plugins_controlador" 
                   placeholder="path_plugins_controlador" 
                   value="<?php echo "path_plugins_controlador"; ?>"
                   readonly="">
        </div>
    </div>

    <div class="form-group">
        <label for="path_plugins_modelos" class="col-sm-2 control-label">Path Modelos</label>
        <div class="col-sm-10">
            <input type="text" 
                   name="path_plugins_modelos" 
                   class="form-control" 
                   id="path_plugins_modelos" 
                   placeholder="path_plugins_modelos" 
                   value="<?php echo "$path_plugins_modelos"; ?>"
                   readonly="">
        </div>
    </div>

    <div class="form-group">
        <label for="path_magia_plugins" class="col-sm-2 control-label">Path vista</label>
        <div class="col-sm-10">
            <input type="text" 
                   name="path_plugins_vista" 
                   class="form-control" 
                   id="path_plugins_vista" 
                   placeholder="path_plugins_vista" 
                   value="<?php echo "$path_plugins_vista"; ?>"
                   readonly="">
        </div>
    </div>

    <div class="form-group">
        <label for="path_plugins_reg" class="col-sm-2 control-label">Path reg</label>
        <div class="col-sm-10">
            <input type="text" 
                   name="path_plugins_reg" 
                   class="form-control" 
                   id="path_plugins_reg" 
                   placeholder="path_plugins_reg" 
                   value="<?php echo "$path_plugins_reg"; ?>"
                   readonly="">
        </div>
    </div>





    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-default">Editar</button>
        </div>
    </div>


</form>