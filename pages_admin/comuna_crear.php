<div class="col-md-11">
 <h2>Crear Comuna</h2>
 <h5>Creación de nuevas comunas en el sistema</h5><br>


<?php 
$_GET['table'] = $bd.".Comuna";
$_GET['select'] = "Region_idRegion as Region, nombreComuna as Comuna, codeComuna as Codigo, activoComuna as Estado";
$_GET['jquery'] = "$('#cuerpo').load('pages_admin/comuna_mod.php');";

require("../recursos/zhi/insert_table_generic.php");

?>
</div><!-- col-md-11 --> 