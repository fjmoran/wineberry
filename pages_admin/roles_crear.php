<div class="col-md-11">
 <h2>Crear Rol</h2>
 <h5>Creación de nuevos roles en el sistema</h5><br>


<?php 
$_GET['table'] = $bd.".Perfil";
$_GET['select'] = "nombrePerfil as Nombre, descripcionPerfil as Descripcion, activoPerfil as Estado";
$_GET['jquery'] = "$('#cuerpo').load('pages_admin/roles_mod.php');";

require("../recursos/zhi/insert_table_generic.php");

?>
</div><!-- col-md-11 -->