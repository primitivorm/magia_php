<p>Lista de tablas en la base de datos <b><?php echo "$bdatos"; ?></b>: 
    <a href="index.php?p=plugins_lista"><span class="glyphicon glyphicon-refresh"></span></a>
</p>


<ul>
 <?php
            $i = 1;
            foreach ($resultado as $reg => $value) {
                echo "<pre>"; 
                var_dump($resultado);
                echo "</pre>"; 
                echo "Campo: $value[Field]<br>"; 
                echo "Tipo: $value[Type]<br>"; 
                echo "Null: $value[Null]<br>"; 
                echo "Key: $value[Key]<br>"; 
                echo "Defecto: $value[Default]<br>"; 
                echo "Extra: $value[Extra]<br>"; 

                $i++;
            }
           /*
array(12) {
    ["Field"]=>
    string(2) "id"
    [0]=>
    string(2) "id"
    ["Type"]=>
    string(7) "int(11)"
    [1]=>
    string(7) "int(11)"
    ["Null"]=>
    string(2) "NO"
    [2]=>
    string(2) "NO"
    ["Key"]=>
    string(3) "PRI"
    [3]=>
    string(3) "PRI"
    ["Default"]=>
    NULL
    [4]=>
    NULL
    ["Extra"]=>
    string(14) "auto_increment"
    [5]=>
    string(14) "auto_increment"
  }
            *             */
            
            ?> 
</ul>










