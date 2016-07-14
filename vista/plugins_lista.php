


<?php 
/*
 * 
 * 
<p>Lista de tablas en la base de datos <b><?php echo "$bdatos"; ?></b>: 
    <a href="index.php?p=plugins_lista" title="Update">
        <span class="glyphicon glyphicon-refresh"></span>
    </a>
</p>

<form action="?" method="get">
    <input type="hidden" name="p" value="plugins_crear">
    <div class="form-group">
        <label for="tabla">Tabla</label>
        <select class="form-control" name="nombrePlugin">
            <option value="base">Escoje una tabla </option>
            <?php
            $i = 1;
            foreach ($resultado as $reg) {
                $html = (file_exists($path_plugins . '/' . $reg[0])) ?
                        '<option disabled="">-- Ya Creada ' . $reg[0] . '</option>' :
                        '<option value="' . $reg[0] . '" >' . $reg[0] . ' </option>';
                echo $html;
                $i++;
            }
            ?> 
        </select>
    </div>

    <div class="form-group">
        <label for="menu">Menu padre</label>
        <select class="form-control" name="padre">
            <option value="">Sin Padre</option>
            <option value="config">Config</option>
            <?php
            menu_add_plugin();
            ?>
        </select>
    </div>

    <div class="form-group">
        <label for="menu">Menu</label>
        <input class="form-control" type="text" name="label">
    </div>
    <button type="submit" class="btn btn-primary">Crear plugin</button>
</form>*/
?>






<h2>Contenido de tu base de datos [<?php echo "$bdatos"; ?>]
    <a href="index.php?p=plugins_lista" title="Update">
        <span class="glyphicon glyphicon-refresh"></span>
    </a>

</h2>

<div class="table-responsive"> 		  
    <table class="table table-striped table-hover" width="100%">
        <thead>
            <tr>
                <th> #</th>
                <th> Table</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $i = 1;
            foreach ($resultado as $reg) {

                if (
                        file_exists($path_plugins . '/' . $reg[0])
                ) {
                    echo '<tr>        
                        <td>' . $i . '</td>
                        <td><b>' . $reg[0] . '</b><br>' . $path_plugins . '/' . $reg[0] . '</td>
                        <td>
                            <a href="index.php?tabla=' . $reg[0] . '&p=c_index">Codigos</a></a>
                         </td>                
                    </tr>';
                } else {
                    echo '<tr>        
                            <td>' . $i . '</td>                            
                            <td><b>' . $reg[0] . '</b><br>' . $path_plugins . '/' . $reg[0] . '</td>
                            <td>
                                <a href="index.php?tabla=' . $reg[0] . '&p=c_index">Codigos</a> |         
                                <a href="index.php?p=plugins_crear&nombrePlugin=' . $reg[0] . '&padre=&label=">Crear plugin</a></td>
                        </tr>';
                }
                $i++;
            }
            ?>
        </tbody>
    </table>
</div>

<h2>Lista de tablas</h2>
<p>Lista de tablas en la base de datos <b><?php echo "$bdatos"; ?></b>: 
    <a href="index.php?p=plugins_lista" title="Update">
        <span class="glyphicon glyphicon-refresh"></span>
    </a>
</p>
<ol>
    <?php
    $i = 1;
    foreach ($resultado as $reg) {
        echo "<li>$reg[0] </li>";
        $i++;
    }
    ?> 
</ol>
