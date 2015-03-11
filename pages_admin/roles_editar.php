<div class="col-md-11">
 <h2>Editar Rol</h2>
 <h5>Edición de roles del sistema</h5><br>
<?php

$_GET['table'] = $bd.".Perfil";
$_GET['select'] = "nombrePerfil as Nombre, descripcionPerfil as Descripcion, activoPerfil as Estado";
$_GET['where'] = "idPerfil='".$_GET['idPerfil']."'";
$_GET['edit'] = 1;
$_GET['jquery'] = "$('#cuerpo').load('pages_admin/roles_mod.php');";
#$_GET['debug'] = 1;

require("../recursos/zhi/insert_table_generic.php");
?>

</div><!-- col-md-11 -->