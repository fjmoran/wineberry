<div class="col-md-11">
 <h2>Editar Tipo Materia</h2>
 <h5>Edición de tipo materia</h5><br>

<?php

$_GET['table'] = $bd.".TipoMateria";
$_GET['select'] = "nombreTipoMateria as Nombre, descripcionTipoMateria as Descripcion, activoTipoMateria as Estado";
$_GET['where'] = "idTipoMateria='".$_GET['idTipoMateria']."'";
$_GET['edit'] = 1;
$_GET['jquery'] = "$('#cuerpo').load('pages_admin/mat_tipo_mod.php');";

require("../recursos/zhi/insert_table_generic.php");
?>

</div><!-- col-md-11 -->