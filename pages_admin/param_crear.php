<div class="col-md-11">
 <h2>Crear Parámetro</h2>
 <h5>Creación de parámetros</h5><br>

<?php 
$_GET['table'] = $bd.".Parametro";
$_GET['select'] = "nombreParametro, valorParametro as Valor, activoParametro as Estado";
$_GET['jquery'] = "$('#cuerpo').load('pages_admin/param_mod.php');";

require("../recursos/zhi/insert_table_generic.php");

?>

</div><!-- col-md-11 -->