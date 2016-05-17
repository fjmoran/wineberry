<?php
require "recursos/zhi/auth.php";
?>	
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>SensoSmart&trade; - Sistema de control ambiental vitivinicola</title>
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
    <!-- switchButton -->
    <link href="recursos/jQuery-switchButton/jquery.switchButton.css" rel="stylesheet">
    <!-- Fav Icon -->    
    <link href="img/favicon.ico" rel="SHORTCUT ICON">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- jquery -->  
    <script src="recursos/jquery/jquery-1.10.2.min.js"></script> 

  </head>
  <body>
	<?php 
	include('header.php');
	include('sidebar.php');
	?>

	<div id="cuerpo">

   <?php 
		
   include('pages_informes/default.php'); 
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
  <script src="recursos/highcharts/js/highcharts.js"></script>
  <script src="recursos/highcharts/js/highcharts-more.js"></script>
  <script src="recursos/highcharts/js/modules/solid-gauge.js"></script>
  <script src="recursos/highcharts/js/modules/exporting.js"></script>
  <script src="recursos/jQuery-switchButton/jquery.switchButton.js"></script>
  
  <script type="text/javascript"> 
    
    $(document).ready(function(){
      
      /* Menu activo */
      $('ul.bs-sidenav > li').click(function (e) {
         // e.preventDefault();
          $('ul.bs-sidenav > li').removeClass('active');
          $(this).addClass('active');                
      }); 

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