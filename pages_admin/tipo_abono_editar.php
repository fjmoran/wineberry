<div class="col-md-11">
 <h2>Editar Tipo de Abono</h2>
 <h5>Edición de tipo de abono</h5><br>

<?php

$_GET['table'] = $bd.".TipoAbono";
$_GET['select'] = "nombreTipoAbono as Nombre, descripcionTipoAbono as Descripcion";
$_GET['where'] = "idTipoAbono='".$_GET['idTipoAbono']."'";
$_GET['edit'] = 1;
$_GET['jquery'] = "$('#cuerpo').load('pages_admin/tipo_abono_mod.php');";

require("../recursos/zhi/insert_table_generic.php");
?>

</div><!-- col-md-11 -->