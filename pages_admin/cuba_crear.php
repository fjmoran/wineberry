<div class="col-md-11">
 <h2>Crear Cuba</h2>
 <h5>Creación de nuevas cubas en el sistema</h5><br>


<?php 

require_once("CreaConnv2.php");

$_GET['table'] = $data_bd.".Cuba";
$_GET['select'] = "nombreCuba as Cuba, ubicacionCuba as Ubicacion, activoCuba as Estado";
$_GET['jquery'] = "$('#cuerpo').load('pages_admin/cuba_mod.php');";

print_r($_GET);

require("../recursos/zhi/insert_table_generic.php");

?>
</div><!-- col-md-11 -->