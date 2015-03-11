<?php

require ("../recursos/zhi/auth.php");
require_once ("../recursos/zhi/CreaConnv2.php");
require_once ("../recursos/zhi/funciones.php");


$select_id = "select idPagina from Pagina where nombrePagina='".pathinfo($_SERVER['PHP_SELF'])."'";
if($rs = $mysqli->query($select_id)){
	$fila = $rs->fetch_assoc();
	$_SESSION['parent_page'] = $_SESSION['current_page'];
	$_SESSION['current_page'] = $fila['idPagina'];
}else{
	$_SESSION['parent_page'] = $_SESSION['current_page'];
	$_SESSION['current_page'] = FALSE;
}
$rs->free();


if (($_GET['debug']) || ($_POST['debug'])){
	$debug = 1;
}

#$debug = 1;
if ($debug){
echo "GET : ";
print_r($_GET);
echo "<br>";
echo "POST : ";
print_r($_POST);
echo "<br>";
}

// Acá se definen los campos por los cuales se puede realizar las busquedas (basic_search)
$campos_busqueda = array("Nombre"=>"nombreUsuario","Usuario"=>"userUsuario","Rol"=>"Perfil_idPerfil");

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
$_GET['table'] = $db.".Usuario";

?>

<div class="col-md-11">
 	<h2>Usuarios</h2>
	<h5>Administración de usuarios</h5>
	<br>

	<?php
	if ((isset($_GET['txt_search'])) && ($debug)) {
		echo $_GET['txt_search']."</br>";
		echo "@".$_GET['select_field']."@</br>";
		echo "Where : ".$_GET['where']."</br>";
	}
	include("../recursos/zhi/basic_search.php");
	?>

		<a onclick="$('#cuerpo').load('pages_admin/usr_crear.php');" href="#usr_crear" role="button" class="btn btn-sm btn-success pull-right"><span class="glyphicon glyphicon-plus-sign"></span> Agregar</a>

	<h4>Usuarios del sistema</h4>

	<?php 
	$_GET['select'] = "nombreUsuario as Nombre, userUsuario as Usuario, Perfil_idPerfil as Rol, activoUsuario as Estado";
	$_GET['orderby'] = "activoUsuario DESC, nombreUsuario";
	$_GET['tabla']['width'] = "25%, 25%, 25%, 15%";
	$_GET['tabla']['title'] = "Nombre, Usuario, Rol, Estado";
	$_GET['acciones'] = "true";
	$_GET['accion']['editar']['URL'] = "pages_admin/usr_editar.php";
	$_GET['accion']['editar']['title'] = "Editar";
	$_GET['accion']['editar']['class'] = "glyphicon glyphicon-pencil";	
	$_GET['accion']['tar']['URL'] = "pages_admin/usr_tar_mod.php";
	$_GET['accion']['tar']['title'] = "Tarifa del Usuario";
	$_GET['accion']['tar']['class'] = "glyphicon glyphicon-usd";	
	$_GET['accion']['clave']['URL'] = "pages_admin/usr_clave_mod.php";
	$_GET['accion']['clave']['title'] = "Cambiar clave";
	$_GET['accion']['clave']['class'] = "glyphicon glyphicon-user";
	$_GET['accion']['clave']['modal'] = "1";
	$_GET['accion']['activar']['URL'] = "pages_admin/usr_estado.php";

	list($reg,$total)=select_paginar($_GET['table'],$_GET['where'],$_GET['pagina'],$_GET['tampag'],"id".$_GET['table'],$mysqli);

	$hasta = $_GET['tampag'];
	$_GET['limit'] = $reg.",".$hasta;

	#$_GET['debug']=1;	

	require("../recursos/zhi/table_generator.php");
	?>
	
	<div class="col-md-12 text-center">
	<?php

		if ($_GET['tampag'] < $total){
			echo paginar($_GET['pagina'],$total,$_GET['tampag'],"pages_admin/usr_mod.php?".http_build_query($_GET)."&tampag=".$_GET['tampag']."&pagina=","#usr_mod");
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
