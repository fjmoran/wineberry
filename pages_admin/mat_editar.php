<div class="col-md-11">
 <h2>Editar Materia</h2>
 <h5>Edición de la materia</h5><br>
<?php

$_GET['table'] = $bd.".Materia";
$_GET['select'] = "nombreMateria as Materia, descripcionMateria as Descripcion, Cliente_idCliente as Cliente, Usuario_idUsuario as Abogado, TipoMateria_idTipoMateria as TipoMateria, activoMateria as Estado";
$_GET['where'] = "idMateria='".$_GET['idMateria']."'";
$_GET['edit'] = 1;
$_GET['jquery'] = "$('#cuerpo').load('pages_admin/mat_mod.php');";

require("../recursos/zhi/insert_table_generic.php");
?>

</div><!-- col-md-11 -->