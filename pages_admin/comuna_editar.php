<div class="col-md-11">
 <h2>Editar Comuna</h2>
 <h5>Edición de comuna</h5><br>

<?php

$_GET['table'] = $bd.".Comuna";
$_GET['select'] = "Region_idRegion as Region, nombreComuna as Comuna, codeComuna as Codigo, activoComuna as Estado";
$_GET['where'] = "idComuna='".$_GET['idComuna']."'";
$_GET['edit'] = 1;
$_GET['jquery'] = "$('#cuerpo').load('pages_admin/comuna_mod.php');";

require("../recursos/zhi/insert_table_generic.php");
?>

</div><!-- col-md-11 -->