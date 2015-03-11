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
        <li class="nav-header">Ingreso</li>
        <li onclick="$('#cuerpo').load('pages/ing_trabajos.php');"><a href="#ing_trabajos"><span class="glyphicon glyphicon-chevron-right"></span> Trabajos</a></li>
        <li onclick="$('#cuerpo').load('pages/ing_gastos.php');"><a href="#ing_gastos"><span class="glyphicon glyphicon-chevron-right"></span> Gastos</a></li>
        <li onclick="$('#cuerpo').load('pages/ing_abonos.php');"><a href="#ing_abonos"><span class="glyphicon glyphicon-chevron-right"></span> Abonos</a></li> 
        <li class="nav-header">Clientes</li>
        <li onclick="$('#cuerpo').load('pages/cli_buscar.php');"><a href="#cli_buscar"><span class="glyphicon glyphicon-chevron-right"></span> Buscar</a></li>
        <li onclick="$('#cuerpo').load('pages/cli_crear.php');"><a href="#cli_crear"><span class="glyphicon glyphicon-chevron-right"></span> Crear</a></li>
        <li onclick="$('#cuerpo').load('pages/cli_contacto.php');"><a href="#cli_contacto"><span class="glyphicon glyphicon-chevron-right"></span> Agregar contacto</a></li>                          
        <li class="nav-header">Contactos</li>
        <li onclick="$('#cuerpo').load('pages/cto_buscar.php');"><a href="#cto_buscar"><span class="glyphicon glyphicon-chevron-right"></span> Buscar</a></li>
        <li onclick="$('#cuerpo').load('pages/cto_crear.php');"><a href="#cto_crear"><span class="glyphicon glyphicon-chevron-right"></span> Crear</a></li>
        <li class="nav-header">Facturación</li>
        <li onclick="$('#cuerpo').load('pages/default.php');"><a href="#fact_nueva"><span class="glyphicon glyphicon-chevron-right"></span> Nueva factura</a></li>
        <li onclick="$('#cuerpo').load('pages/default.php');"><a href="#fact_buscar"><span class="glyphicon glyphicon-chevron-right"></span> Buscar facturas</a></li>              
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