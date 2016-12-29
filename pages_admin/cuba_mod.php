<?php

require_once("../recursos/zhi/CreaConnv2.php");
//require_once ("../recursos/zhi/auth.php");
require_once ("../recursos/zhi/funciones.php");

if (($_GET['debug']) || ($_POST['debug'])){
	$debug = 1;
}

//$debug = 1;

// Acá se definen los campos por los cuales se puede realizar las busquedas (basic_search)
$campos_busqueda = array("Cuba"=>"nombreCuba","Ubicación"=>"ubicacionCuba");

if (!isset($_GET['pagina'])){ $_GET['pagina']=1;} // pagina inicial
if (!isset($_GET['tampag'])){ $_GET['tampag']=10;} // cantidad de items por pagina
if (($_GET['txt_search'])&&($_GET['select_field'])){
	if ($_GET['foreign']){
	$query_fk = "SELECT ".$_GET['fkcolumna']." FROM ".$_GET['fktabla']." WHERE nombre".$_GET['fktabla']." like '%".$_GET['txt_search']."%'";
	$_GET['where'] = $_GET['select_field']." IN (".$query_fk.")";
	} else {
		$_GET['where'] = $_GET['select_field']." like '%".$_GET['txt_search']."%'";
	}
}

$_GET['callerURL'] = $_SERVER ['PHP_SELF'];
$_GET['table'] = $data_db.".Cuba"; //Aca se define la tabla donde se esta trabajando ($db es la BD de administracion y $data_db es la db de los datos del sistema)

if ($debug){
echo "GET : ";
print_r($_GET);
echo "<br>";
echo "POST : ";
print_r($_POST);
echo "<br>";
}

?>

<div class="col-md-11">
 	<h2>Cubas</h2>
	<h5>Administración de cubas</h5>
	<br>
	<?php
	if ((isset($_GET['txt_search'])) && ($debug)) {
		echo $_GET['txt_search']."</br>";
		echo "@".$_GET['select_field']."@</br>";
		echo "Where : ".$_GET['where']."</br>";
	}
	include("../recursos/zhi/basic_search.php");
	?>

		<a onclick="$('#cuerpo').load('pages_admin/cuba_crear.php');" href="#cuba_crear" role="button" class="btn btn-sm btn-success pull-right"><span class="glyphicon glyphicon-plus-sign"></span> Agregar</a>

	<h4>Cubas registradas en el sistema</h4>

	<?php 
	$_GET['select'] = "nombreCuba as Cuba, tobjetivoCuba as TempObjetivo, ubicacionCuba as Ubicacion, activoCuba as Estado";
	$_GET['orderby'] = "activoCuba DESC, ubicacionCuba";
	$_GET['tabla']['width'] = "50%, 20%, 20%, 10%";
	$_GET['tabla']['title'] = "Cuba, Tº Objetivo, Ubicación, Estado";
	$_GET['acciones'] = "true";
	$_GET['accion']['editar']['URL'] = "pages_admin/cuba_editar.php";
	$_GET['accion']['editar']['title'] = "Editar";
	$_GET['accion']['editar']['class'] = "glyphicon glyphicon-pencil";
	$_GET['accion']['activar']['URL'] = "pages_admin/pais_estado.php";

	list($reg,$total)=select_paginar($_GET['table'],$_GET['where'],$_GET['pagina'],$_GET['tampag'],"id".$_GET['table'],$mysqli);

	$hasta = $_GET['tampag'];
	$_GET['limit'] = $reg.",".$hasta;

	require("../recursos/zhi/table_generator.php");
	?>

	<div class="col-md-12 text-center">
	<?php

		if ($_GET['tampag'] < $total){
			echo paginar($_GET['pagina'],$total,$_GET['tampag'],"pages_admin/cuba_mod.php?".http_build_query($_GET)."&tampag=".$_GET['tampag']."&pagina=","#cuba_mod");
		}
	?>
	</div>

</div><!-- col-md-11 -->

<div id="generic_modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="act_deasctLabel" aria-hidden="true">
	<div class="modal-dialog">
	    <div class="modal-content" id="generic_modal_content">
	    	<!-- Contenido Modal -->
	    </div>
	</div>        
</div>

    <script type="text/javascript"> 
      
      $(document).ready(function(){       
        /* Tooltip */
        $('.table').tooltip({
          selector: "[rel=tooltip]"
         })
      })    
    </script>
    
    <script type="text/javascript">
		$('.modal').on('hidden.bs.modal', function () {
			// alert("cerrado!");
			$(this).removeData();
		});
	</script>  