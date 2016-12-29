<div class="col-md-11">
 <h2>Crear Cuba</h2>
 <h5>Creación de nuevas cubas en el sistema</h5><br>


<?php 

$_GET['table'] = "Data_WineBerry".".Cuba";
$_GET['select'] = "nombreCuba as Cuba, ubicacionCuba as Ubicacion, tobjetivoCuba as Objetivo, tminimaCuba as Minima, tmaximaCuba as Maxima, rangotoleranciaCuba as Rango, activoCuba as Estado, descripcionCuba as Descripcion";
$_GET['jquery'] = "$('#cuerpo').load('pages_admin/cuba_mod.php');";

print_r($_GET);

require("../recursos/zhi/insert_table_generic.php");

?>
</div><!-- col-md-11 -->