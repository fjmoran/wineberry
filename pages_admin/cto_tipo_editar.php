<div class="col-md-11">
 <h2>Editar Tipo de Contacto</h2>
 <h5>Edición de tipo de contacto</h5><br>

<?php

$_GET['table'] = $bd.".TipoContacto";
$_GET['select'] = "nombreTipoContacto as Nombre, descripcionTipoContacto as Descripcion";
$_GET['where'] = "idTipoContacto='".$_GET['idTipoContacto']."'";
$_GET['edit'] = 1;
$_GET['jquery'] = "$('#cuerpo').load('pages_admin/cto_tipo_mod.php');";

require("../recursos/zhi/insert_table_generic.php");
?>

</div><!-- col-md-11 -->