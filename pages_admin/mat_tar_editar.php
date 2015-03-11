<div class="col-md-11">
 <h2>Editar Tarifa por Materia</h2>
 <h5>Edición de tarifa por materia</h5><br>

<?php

$_GET['table'] = $bd.".TarifaMateria";
$_GET['select'] = "Materia_idMateria as Materia, Moneda_idMoneda as Moneda, Materia_Cliente_idCliente as Cliente, valorTarifaMateria as Tarifa";
$_GET['where'] = "idTarifaMateria='".$_GET['idTarifaMateria']."'";
$_GET['edit'] = 1;
$_GET['jquery'] = "$('#cuerpo').load('pages_admin/mat_tar_mod.php');";

require("../recursos/zhi/insert_table_generic.php");
?>

</div><!-- col-md-11 -->