<div class="col-md-11">
 <h2>Editar Estado Factura</h2>
 <h5>Edición de el estado de la factura</h5><br>

<?php

$_GET['table'] = $bd.".EstadoFactura";
$_GET['select'] = "nombreEstadoFactura as Estado, descripcionEstadoFactura as Descripcion";
$_GET['where'] = "idEstadoFactura='".$_GET['idEstadoFactura']."'";
$_GET['edit'] = 1;
$_GET['jquery'] = "$('#cuerpo').load('pages_admin/fact_estdo_mod.php');";

require("../recursos/zhi/insert_table_generic.php");
?>

</div><!-- col-md-11 -->