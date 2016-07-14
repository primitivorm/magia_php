<h1>Configurar la base de datos </h1>


<form class="form-horizontal" action="" method="get">
    <input type="hidden" name="a" value="configBd">
    
    
  <div class="form-group">
    <label for="hostname" class="col-sm-2 control-label">Servidor</label>
    <div class="col-sm-10">
        <input type="text" name="servidor" class="form-control" id="servidor" placeholder="Localhost" value="<?php echo $servidor ?>">
    </div>
  </div>
    
    
    
  <div class="form-group">
    <label for="inputPassword3" class="col-sm-2 control-label">Usuario</label>
    <div class="col-sm-10">
        <input type="text" name="usuario" class="form-control" id="usuario" placeholder="root" value="<?php echo $usuario; ?>">
    </div>
  </div>
    
  <div class="form-group">
    <label for="inputPassword3" class="col-sm-2 control-label">Clave</label>
    <div class="col-sm-10">
        <input type="text" name="clave" class="form-control" id="clave" placeholder="password, en ocaciones se deja en blanco" value="<?php echo $clave; ?>">
    </div>
  </div>
    
  <div class="form-group">
    <label for="dbname" class="col-sm-2 control-label">BaseDatos</label>
    <div class="col-sm-10">
        <input type="text" name="bdatos" class="form-control" id="bdatos" placeholder="MiSuperBaseDatos" value="<?php echo $bdatos; ?>">
    </div>
  </div>
    
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-default">Editar</button>
    </div>
  </div>
    
    
</form>

