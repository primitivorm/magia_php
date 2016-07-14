<?php
$cf = [
    [
        'nombre' => 'id',
        'tipo' => 'info',
        'valor' => '20',
        'opciones' => ''
    ],
    [
        'nombre' => 'nombres',
        'tipo' => 'texto',
        'valor' => 'robinson',
        'opciones' => ''
    ],
    [
        'nombre' => 'apellidos',
        'tipo' => 'texto',
        'valor' => 'Coello',
        'opciones' => ''
    ],
    [
        'nombre' => 'login',
        'tipo' => 'texto',
        'valor' => 'roencosa',
        'opciones' => ''
    ],
    [
        'nombre' => 'clave',
        'tipo' => 'descripcion',
        'valor' => 'abc123',
        'opciones' => ''
    ],
    [
        'nombre' => 'descripcion',
        'tipo' => 'textarea',
        'valor' => 'Estaes la descripcion del formulario',
        'opciones' => ''
    ],
    [
        'nombre' => 'estatus',
        'tipo' => 'checkbox',
        'valor' => '0',
        'opciones' => ['Activo', 'Bloqueado']
    ],
    [
        'nombre' => 'Ciudad',
        'tipo' => 'select',
        'valor' => '0',
        'opciones' => ['Quito', 'Guay', 'cuenca', 'Ambato']
    ]
        ]
?>


<?php
$nombre_campo = $_REQUEST['campo'];
$valor_del_campo = "robincoello@hotmail.com";
$placeholder = "Escriba aca la clave";
$opciones = ['Opcion 1 ', 'Opcion 2', 'Opcion 3']
?>




<?php

function tipo_de_campo($tipo, $nombre_campo, $valor_del_campo, $placeholder, $opciones = "") {
    
  $selecionada = ($nombre_campo)? " selecionada " : ""; 
    
    
    switch ($tipo) {

        case 'texto':
            $campo = '
            <div class="form-group '.$selecionada.'">
                    <label for="' . $nombre_campo . '" class="col-sm-2 control-label">' . $nombre_campo . '</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="' . $nombre_campo . '" placeholder="' . $placeholder . '" value="' . $valor_del_campo . '">
                    </div>
                  </div>';
            return $campo;
            break;


        case 'texto_inactivo':
            $campo = '<div class="form-group '.$selecionada.'">
                    <label for="' . $nombre_campo . '" class="col-sm-2 control-label">' . $nombre_campo . '</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="' . $nombre_campo . '" placeholder="' . $placeholder . '" value="' . $valor_del_campo . '" disabled >
                    </div>
                  </div>';

            return $campo;
            break;


        case 'readonly':
            $campo = '<div class="form-group '.$selecionada.'">
                    <label for="' . $nombre_campo . '" class="col-sm-2 control-label">' . $nombre_campo . '</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="' . $nombre_campo . '" placeholder="' . $placeholder . '" value="' . $valor_del_campo . '" readonly >
                    </div>
                  </div>';

            return $campo;
            break;

        case 'clave':
            $campo = '<div class="form-group '.$selecionada.'">
                    <label for="' . $nombre_campo . '" class="col-sm-2 control-label">' . $nombre_campo . '</label>
                    <div class="col-sm-10">
                      <input type="password" class="form-control" id="' . $nombre_campo . '" placeholder="' . $placeholder . '" value="' . $valor_del_campo . '">
                    </div>
                  </div>';
            return $campo;

            break;

        case 'textarea':
            $campo = '<div class="form-group '.$selecionada.'">
                    <label for="' . $nombre_campo . '" class="col-sm-2 control-label">' . $nombre_campo . '</label>
                    <div class="col-sm-10">
                      <textarea class="form-control" rows="3" placeholder="' . $placeholder . '">' . $valor_del_campo . '</textarea>
                    </div>
                  </div>';


            return $campo;
            break;

        case 'checkbox':
            $campo = '<div class="checkbox '.$selecionada.'">
                    <div class="col-sm-offset-2 col-sm-10">
                      <div class="checkbox">
                        ';
            $i = 0;
            while ($i < count($opciones)) {
                $campo .= '<label>
                          <input type="checkbox"> ' . $opciones[$i] . '
                        </label>';
                $i++;
            }


            $campo .= '
                      </div>
                    </div>
                  </div>';
            return $campo;
            break;


        case 'radio':
            $campo = '<div class="form-group '.$selecionada.'">
                    <div class="col-sm-offset-2 col-sm-10">
                      <div class="radio">';
            $i = 0;
            while ($i < count($opciones)) {
                $campo .= '<label>
                          <input type="radio"> ' . $opciones[$i] . '
                        </label>';
                $i++;
            }


            $campo .= '
                        
                      </div>
                    </div>
                  </div>';
            return $campo;
            break;


        case 'select':
            $campo = '<div class="form-group '.$selecionada.'">
                    <label for="' . $nombre_campo . '" class="col-sm-2 control-label">' . $nombre_campo . '</label>
                    <div class="col-sm-10">
                      <select class="form-control">';
            $i = 0;
            while ($i < count($opciones)) {
                $campo .= ' <option>' . $opciones[$i] . '</option>';
                $i++;
            }


            $campo .= '</select>
                    </div>
                  </div>';

            return $campo;
            break;


        case 'select_multiple':
            $campo = '<div class="form-group '.$selecionada.'">
                    <label for="' . $nombre_campo . '" class="col-sm-2 control-label">' . $nombre_campo . '</label>
                    <div class="col-sm-10">
                      <select multiple class="form-control">
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                            <option>5</option>
                          </select>
                    </div>
                  </div>';

            return $campo;
            break;

        case 'info':
            $campo = '<div class="form-group '.$selecionada.'">
                    <label class="col-sm-2 control-label">' . $nombre_campo . '</label>
                    <div class="col-sm-10">
                      <p class="form-control-static">' . $valor_del_campo . '</p>
                    </div>
                  </div>';

            return $campo;
            break;



        default:
            break;
    }
}
?>







<h2>Vista preliminar</h2>

<form class="form-horizontal">

<?php
$i = 0;
while ($i < count($cf)) {

echo tipo_de_campo($cf[$i]['tipo'], $cf[$i]['nombre'], $cf[$i]['valor'], $cf[$i]['valor'], $cf[$i]['opciones']);
 $i++;

 
}
?>

    <button type="submit" class="btn btn-default">Submit</button>
</form>





<h2>Cambiar tipo de campo para (xxxx) en el formulrio</h2>



<hr>
<hr>
<hr>


<p>Escoja el tipo de campo que desea tener en el formulario para este item</p>


<form>
    <div>

        <!-- Nav tabs -->
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active"><a href="#texto" aria-controls="texto" role="tab" data-toggle="tab">texto</a></li>    
            <li role="presentation"><a href="#texto_inactivo" aria-controls="texto_inactivo" role="tab" data-toggle="tab">texto_inactivo</a></li>
            <li role="presentation"><a href="#readonly" aria-controls="readonly" role="tab" data-toggle="tab">readonly</a></li>

            <li role="presentation"><a href="#clave" aria-controls="clave" role="tab" data-toggle="tab">clave</a></li>
            <li role="presentation"><a href="#textarea" aria-controls="textarea" role="tab" data-toggle="tab">textarea</a></li>
            <li role="presentation"><a href="#checkbox" aria-controls="checkbox" role="tab" data-toggle="tab">checkbox</a></li>
            <li role="presentation"><a href="#radio" aria-controls="radio" role="tab" data-toggle="tab">radio</a></li>
            <li role="presentation"><a href="#select" aria-controls="select" role="tab" data-toggle="tab">select</a></li>
            <li role="presentation"><a href="#select_multiple" aria-controls="select_multiple" role="tab" data-toggle="tab">select_multiple</a></li>
            <li role="presentation"><a href="#info" aria-controls="info" role="tab" data-toggle="tab">info</a></li>


        </ul>

        <!-- Tab panes -->
        <div class="tab-content">

            <div role="tabpanel" class="tab-pane active" id="texto">
<?php echo tipo_de_campo('texto', $nombre_campo, $valor_del_campo, $placeholder); ?>
            </div>


            <div role="tabpanel" class="tab-pane" id="texto_inactivo">
<?php echo tipo_de_campo('texto_inactivo', $nombre_campo, $valor_del_campo, $placeholder); ?>
            </div>    


            <div role="tabpanel" class="tab-pane" id="readonly">
<?php echo tipo_de_campo('readonly', $nombre_campo, $valor_del_campo, $placeholder); ?>
            </div>    


            <div role="tabpanel" class="tab-pane" id="clave">
<?php echo tipo_de_campo('clave', $nombre_campo, $valor_del_campo, $placeholder); ?>    
            </div>


            <div role="tabpanel" class="tab-pane" id="textarea">        
<?php echo tipo_de_campo('textarea', $nombre_campo, $valor_del_campo, $placeholder); ?>
            </div> 


            <div role="tabpanel" class="tab-pane" id="checkbox">
<?php echo tipo_de_campo('checkbox', $nombre_campo, $valor_del_campo, $placeholder, $opciones); ?>

            </div>


            <div role="tabpanel" class="tab-pane" id="radio">
<?php echo tipo_de_campo('radio', $nombre_campo, $valor_del_campo, $placeholder, $opciones); ?>
            </div>


            <div role="tabpanel" class="tab-pane" id="select">
<?php echo tipo_de_campo('select', $nombre_campo, $valor_del_campo, $placeholder, $opciones); ?>
            </div>


            <div role="tabpanel" class="tab-pane" id="select_multiple">
                <?php echo tipo_de_campo('select_multiple', $nombre_campo, $valor_del_campo, $placeholder, $opciones); ?>
            </div>


            <div role="tabpanel" class="tab-pane" id="info">
                <?php echo tipo_de_campo('info', $nombre_campo, $valor_del_campo, $placeholder); ?>
            </div>


        </div>
    </div>    
</form>





<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>