<?php

require_once("../recursos/zhi/CreaConnv2.php");
require_once("../recursos/zhi/auth.php");

?>

<div class="col-md-11">
 <h2>Crear Tarifa por Materia</h2>
 <h5>Creación de nuevas tarifas por materia</h5><br>


<?php 
$_GET['table'] = $bd.".TarifaMateria";
$_GET['select'] = "Materia_idMateria as Materia, Moneda_idMoneda as Moneda, Materia_Cliente_idCliente as Cliente, valorTarifaMateria as Tarifa";
$_GET['jquery'] = "$('#cuerpo').load('pages_admin/mat_tar_mod.php');";
#$_GET['debug'] = 1;

require("../recursos/zhi/insert_table_generic.php");

?>
</div><!-- col-md-11 -->