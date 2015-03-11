<?php
require ("recursos/zhi/auth.php");
?>	
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Sistema de Control de Horas</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="recursos/bootstrap3/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <!-- Bootstrap FileUload-->
    <link href="recursos/bootstrap-fileupload/bootstrap-fileupload.min.css" rel="stylesheet">        
    <!-- Jquery-ui -->
    <link href="recursos/jquery-ui/css/zhi/jquery-ui-1.10.3.custom.min.css" rel="stylesheet">
    <!-- Zhi CSS -->
    <link href="recursos/zhi/css/zhi.css" rel="stylesheet"> 
    <!-- Fonts -->
    <link href='fonts/fonts.css' rel='stylesheet' type='text/css'>
    <!-- Fav Icon -->    
    <link href="img/favicon.ico" rel="SHORTCUT ICON">

    <script src="recursos/jquery/jquery-1.10.2.min.js"></script> 

  </head>
  <body>
	<?php 
	include('header.php');
	include('sidebar.php');
	?>

	<div id="cuerpo">

   <?php 
   /*
    echo "<div class='alert alert-danger alert-dismissable col-md-8'> <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
		echo "Flag de manejo de variables = ";
		echo count($_SESSION) ."</br>";
		echo "user = ".$_SESSION[userUsuario]."</br>";
		echo "nombre = ".$_SESSION[nombreUsuario]."</br>";
		echo "id = ".$_SESSION[idUsuario]."</br>";
		echo "idperfil = ".$_SESSION[idperfilUsuario]."</br>";
		echo "</div>"; */
		
   include('pages/default.php'); 
   ?>

	</div>

	<?php
	include('footer.php');
	?>

<iframe name="IframeOutput" class="hide"></iframe>

 <!-- javascript
  ================================================== -->
  <!-- Placed at the end of the document so the pages load faster -->
   
  <script src="recursos/bootstrap3/js/bootstrap.min.js"></script>
  <script src="recursos/bootstrap-fileupload/bootstrap-fileupload.min.js"></script>  
  <script src="recursos/jquery-ui/js/jquery-ui-1.10.3.custom.min.js"></script>
  <script src="recursos/form-validator/jquery.form-validator.js"></script>
  <script src="recursos/CryptoJSv3/rollups/sha1.js"></script>
  
  <script type="text/javascript"> 
    
    $(document).ready(function(){
      
      /* Menu activo */
      $('ul.bs-sidenav > li').click(function (e) {
         // e.preventDefault();
          $('ul.bs-sidenav > li').removeClass('active');
          $(this).addClass('active');                
      }); 
      /* Carousel init */
      $('.carousel').carousel({
        interval: 4500
      });

      $('.carousel').carousel('cycle');
      
       jQuery(function($){
              $.datepicker.regional['es'] = {
                      closeText: 'Cerrar',
                      prevText: '&#x3c;Ant',
                      nextText: 'Sig&#x3e;',
                      currentText: 'Hoy',
                      monthNames: ['Enero','Febrero','Marzo','Abril','Mayo','Junio',
                      'Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],
                      monthNamesShort: ['Ene','Feb','Mar','Abr','May','Jun',
                      'Jul','Ago','Sep','Oct','Nov','Dic'],
                      dayNames: ['Domingo','Lunes','Martes','Mi&eacute;rcoles','Jueves','Viernes','S&aacute;bado'],
                      dayNamesShort: ['Dom','Lun','Mar','Mi&eacute;','Juv','Vie','S&aacute;b'],
                      dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','S&aacute;'],
                      weekHeader: 'Sm',
                      dateFormat: 'dd-mm-yy',
                      firstDay: 1,
                      isRTL: false,
                      showMonthAfterYear: false,
                      yearSuffix: ''};
              $.datepicker.setDefaults($.datepicker.regional['es']);
      }); 

    })
  </script>

 </body>
</html>