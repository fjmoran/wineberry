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
        <?php
          // Se selecciona el id del padre que invoca.
          $select_padre = "select Menu.idMenu, Menu.nivelMenu from Menu, Pagina where Pagina.urlPagina='admin.php' and Menu.Pagina_idPagina = Pagina.idPagina";
          if ($rs_padre = comando_mysql($select_padre,$mysqli)){
            $fila = $rs_padre->fetch_array();
            $idMenuPadre = $fila[0];
            $nivelMenuPadre = $fila[1];
            $rs_padre->free();
          }
          // se definen los formatos tanto para los titulos como para los item del menu
          $title = "<li class=\"nav-header\">%s</li>";
          $item = "<li onclick=\"$('#cuerpo').load('%s');\"><a href=\"%s\"><span class=\"%s\"></span> %s</a></li>";

          // Se selecciona unicamente del Menu para saber cuales son todos los elementos que componen el Menu.
          $nivelMenu = $nivelMenuPadre + 1 ;
          $select_menu1 = "select Menu.posicionMenu, Menu.Pagina_idPagina as pagina, Menu.nombreMenu as nombre, Menu.spanclassMenu as class from Menu where Menu.nivelMenu='".$nivelMenu."' and Menu.activoMenu = '1' and Menu.Menu_idMenu ='".$idMenuPadre."' ORDER BY Menu.posicionMenu";
          if($rs_menu1 = comando_mysql($select_menu1,$mysqli)){
            while($fila = $rs_menu1->fetch_assoc()){
              if (empty($fila['pagina'])){ // si es un titulo del menu no tiene pagina asociada
                printf($title,$fila['nombre']);
              }else{
                //si no es titulo tiene pagina, por lo que es necesario ir a buscar la información de la pagina
                $select_pagina = "select nombrePagina as URL, urlPagina as href from Pagina where idPagina = '".$fila['pagina']."'";
                if ($rs_pagina = comando_mysql($select_pagina,$mysqli)){
                  $fila_pagina = $rs_pagina->fetch_assoc();
                  printf($item,$fila_pagina['URL'],$fila_pagina['href'],$fila['class'],$fila['nombre']);
                  $rs_pagina->free();
                } 
              }
            }
            $rs_menu1->free();
          }
        ?>
        
      </ul>
    </div>
   </div>
   <div class="col-md-10"> <!-- style="background-color: lightgrey" -->
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