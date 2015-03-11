<div class="col-md-11">
 <h2>Crear Estado Factura</h2>
 <h5>Creación de nuevos estados para facturas</h5><br>


<?php 
$_GET['table'] = $bd.".EstadoFactura";
$_GET['select'] = "nombreEstadoFactura as Estado, descripcionEstadoFactura as Descripcion";
$_GET['jquery'] = "$('#cuerpo').load('pages_admin/fact_estdo_mod.php');";

require("../recursos/zhi/insert_table_generic.php");

?>
</div><!-- col-md-11 -->