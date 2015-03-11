<div class="col-md-11">
 <h2>Crear Moneda</h2>
 <h5>Creación de nuevas monedas en el sistema</h5><br>


<?php 
$_GET['table'] = $bd.".Moneda";
$_GET['select'] = "nombreMoneda as Simbolo, descripcionMoneda as Descripcion, activoMoneda as Estado";
$_GET['jquery'] = "$('#cuerpo').load('pages_admin/mon_mod.php');";

require("../recursos/zhi/insert_table_generic.php");

?>
</div><!-- col-md-11 -->