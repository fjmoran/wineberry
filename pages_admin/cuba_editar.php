<div class="col-md-11">
 <h2>Editar País</h2>
 <h5>Edición de país</h5><br>

<?php

$_GET['table'] = $data_bd.".Cuba";
$_GET['select'] = "nombreCuba as Cuba, ubicacionCuba as Ubicacion, activoCuba as Estado";
$_GET['where'] = "idCuba='".$_GET['idCuba']."'";
$_GET['edit'] = 1;
$_GET['jquery'] = "$('#cuerpo').load('pages_admin/cuba_mod.php');";

require("../recursos/zhi/insert_table_generic.php");
?>

</div><!-- col-md-11 -->