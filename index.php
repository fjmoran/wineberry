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
    <!-- Font Awesome -->
    <link href="recursos/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- Ionicons -->
    <link href="recursos/ionicons/css/ionicons.min.css" rel="stylesheet">
    <!-- Zhi CSS -->
    <link href="recursos/zhi/css/zhi.css" rel="stylesheet">
    <!-- Button Select CSS -->
    <link href="recursos/zhi/css/button_select.css" rel="stylesheet">
    <!-- Fonts -->
    <link href='fonts/fonts.css' type='text/css' rel='stylesheet'>
    <!-- switchButton -->
    <link href="recursos/jQuery-switchButton/jquery.switchButton.css" rel="stylesheet">
    <!-- Fav Icon -->
    <link href="img/favicon.ico" rel="SHORTCUT ICON">
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

        $(".btn-select").each(function (e) {
            var value = $(this).find("ul li.selected").html();
            if (value != undefined) {
                $(this).find(".btn-select-input").val(value);
                $(this).find(".btn-select-value").html(value);
            }
        });
    });

    $(document).on('click', '.btn-select', function (e) {
        e.preventDefault();
        var ul = $(this).find("ul");
        if ($(this).hasClass("active")) {
            if (ul.find("li").is(e.target)) {
                var target = $(e.target);
                target.addClass("selected").siblings().removeClass("selected");
                var value = target.html();
                $(this).find(".btn-select-input").val(value);
                $(this).find(".btn-select-value").html(value);
            }
            ul.hide();
            $(this).removeClass("active");
        }
        else {
            $('.btn-select').not(this).each(function () {
                $(this).removeClass("active").find("ul").hide();
            });
            ul.slideDown(300);
            $(this).addClass("active");
        }
    });

    $(document).on('click', function (e) {
        var target = $(e.target).closest(".btn-select");
        if (!target.length) {
            $(".btn-select").removeClass("active").find("ul").hide();
        }
    });

  </script>

 </body>
</html>
