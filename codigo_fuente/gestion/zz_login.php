<!DOCTYPE html>
<html lang="es">
  <head>    
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">    
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="favicon.ico">

    <title>Login</title>

    <!-- Bootstrap core CSS -->
    <link href="../includes/bootstrap/css/bootstrap.min.css" rel="stylesheet">


    
    <link href="../includes/css/login.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="../includes/bootstrap/js/ie-emulation-modes-warning.js"></script>


    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <div class="container">

<form class="form-signin" name="" method="post" action="z_login.php">

    <h2 class="form-signin-heading">Admin</h2>

    <label for="inputEmail" class="sr-only">Email address</label>
    <input type="text" id="user" name="username" class="form-control" placeholder="Email address" required autofocus>

    <label for="inputPassword" class="sr-only">Password</label>
    <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Password" required>

    <button 
        class="btn btn-lg btn-primary btn-block" 
        type="submit">Login</button>   
</form>
        
        

    </div> <!-- /container -->
	
	

    


    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="../includes/bootstrap/js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>




























