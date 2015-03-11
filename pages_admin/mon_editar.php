<div class="col-md-11">
 <h2>Editar Moneda</h2>
 <h5>Edición de monedas del sistema</h5><br>

<?php

$_GET['table'] = $bd.".Moneda";
$_GET['select'] = "nombreMoneda as Simbolo, descripcionMoneda as Descripcion, activoMoneda as Estado";;
$_GET['where'] = "idMoneda='".$_GET['idMoneda']."'";
$_GET['edit'] = 1;
$_GET['jquery'] = "$('#cuerpo').load('pages_admin/mon_mod.php');";

require("../recursos/zhi/insert_table_generic.php");
?>

</div><!-- col-md-11 -->