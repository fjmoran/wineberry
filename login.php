<?php
session_start();
session_unset();
session_destroy();
?>

<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <title>SensoSmart&trade; - Sistema de control ambiental vitivinicola</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="recursos/bootstrap3/css/bootstrap.min.css" rel="stylesheet" media="screen">

    <link href='fonts/fonts.css' rel='stylesheet' type='text/css'>

    <link href="img/favicon.ico" rel="SHORTCUT ICON">
    <!-- Zhi header CSS -->
    <link href="recursos/zhi/css/header.css" rel="stylesheet"> 

  </head>

  <body>

    <div class="navbar navbar-inverse" role="navigation">
      <div class="navbar-header">
     <!-- <img class="pull-left img-header" src="img/logo_zhi_small.png" alt="Logo">  -->
      <a class="navbar-brand" href="#">SensoSmart&trade;</a>
      </div>
    </div><!--.navbar-->

    <div class="col-sm-12 col-12 bg-image">

      <form class="form-signin" name="login" action="recursos/zhi/controlv2.php" method="post">
        <h2 class="form-signin-heading">Acceso</h2>
        <input type="text" class="form-control reset-alert" placeholder="Usuario" name="user" <?php 
        if (isset($_GET['user'])) {
        	echo "value=\"".$_GET['user']."\"";
        } ?>
        ">
        <input type="password" class="form-control reset-alert" placeholder="Contraseña" name="password">
        <h4 class="text-center"><span id="login-error" class="label label-danger 
        	<?php 
        	if (!isset($_GET['error'])) {
        		echo " hide \">";
        	}else if ($_GET['error'] == 1) {
        		echo "\">Usuario o Contraseña incorrecto";
        	}else if ($_GET['error'] == 2) {
        		echo "\">Autentificación necesaria";
        	}else if ($_GET['error']){
            echo "\">No tiene permisos suficientes";
          }
        	?>
        </span></h4>
        <label class="checkbox">
          <input type="checkbox" value="remember_me" id="remeber_me" checked> Recordarme
        </label>
        <button class="btn btn-primary btn-block" type="submit">Ingresar</button><br>
        <a href="#recuperar" data-toggle="modal">Recuperar contraseña</a>
      </form>

    </div> <!-- /container -->

<!-- Modal -->
<div id="recuperar" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="recuperarLabel" aria-hidden="true">
  
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title" id="myModalLabel">¿Olvidaste tu contraseña?</h4>
      </div>
      <div class="modal-body">
        <p>Ingresa tu correo electrónico para recuperarla</p>
        <input type="email" class="form-control" placeholder="correo@dominio.com">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary">Enviar</button>
      </div>
    </div><!-- modal-content -->
  </div><!-- modal-dialog -->
</div><!-- modal -->

    <!-- javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="recursos/jquery/jquery-1.10.2.min.js"></script>    
    <script src="recursos/bootstrap3/js/bootstrap.min.js"></script>
    <script src="recursos/CryptoJSv3/rollups/sha1.js"></script>
    <script src="recursos/zhi/rememberme.js"></script>
    
    <script type="text/javascript">
    	$('form.form-signin').on('submit', function(){
    		var clave = $('input:password');
    		var clavesha1 = CryptoJS.SHA1(clave.val());
    		clave.val(clavesha1);
    	});

      $('.reset-alert').focus(function() {
      $('#login-error').addClass('hide');
      });

    </script>

  </body>
</html>
