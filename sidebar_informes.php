<?php
require_once("recursos/zhi/auth.php");
require_once("recursos/zhi/CreaConnv2.php");
require_once("recursos/zhi/funciones.php");
?>
<div class="container">
<div class="row">
  <div class="col-md-2">
    <div class="bs-sidebar">
      <ul class="nav bs-sidenav">
        <li class="nav-header">Informes</li>
        <li onclick="$('#cuerpo').load('pages/default.php');"><a href="#inf_horascli"><span class="glyphicon glyphicon-chevron-right"></span> Horas cliente</a></li>
        <li onclick="$('#cuerpo').load('pages/default.php');"><a href="#inf_horasabg"><span class="glyphicon glyphicon-chevron-right"></span> Horas abogado</a></li>
        <li onclick="$('#cuerpo').load('pages/default.php');"><a href="#inf_gastoscli"><span class="glyphicon glyphicon-chevron-right"></span> Gastos cliente</a></li>
        <li onclick="$('#cuerpo').load('pages/default.php');"><a href="#inf_gastosabg"><span class="glyphicon glyphicon-chevron-right"></span> Gastos abogado</a></li>
        <li onclick="$('#cuerpo').load('pages/default.php');"><a href="#inf_horas"><span class="glyphicon glyphicon-chevron-right"></span> Consolidado de horas</a></li>
        <li onclick="$('#cuerpo').load('pages/default.php');"><a href="#inf_personal"><span class="glyphicon glyphicon-chevron-right"></span> Personal</a></li>
        <li onclick="$('#cuerpo').load('pages/default.php');"><a href="#inf_horasmat"><span class="glyphicon glyphicon-chevron-right"></span> Horas materia</a></li>  
      </ul>
    </div>
  </div>
 <div class="col-md-10"> 
   <div class="container">

    <div class="btn-group pull-right">
      <?php
        $generic_anchor = "<a class=\"btn btn-default\" href=\"%s\"><span class=\"%s\"></span> %s</a>";
        $select_menu0 = "select Menu.nombreMenu as nombre, Menu.spanclassMenu as class,Pagina.urlPagina as URL from Menu, Pagina where nivelMenu='0' AND activoMenu='1' AND Menu.Pagina_idPagina = Pagina.idPagina ORDER BY posicionMenu ASC;";
        if ($rs_menu0 = comando_mysql($select_menu0,$mysqli)){
          while ($fila = $rs_menu0->fetch_assoc()){
            printf($generic_anchor,$fila['URL'],$fila['class'],$fila['nombre']);
          }
          $rs_menu0->free();
        }
      ?>
    </div>

   </div>

 <div class="row" id="main-box">
  <!-- divs se cierran en footer -->