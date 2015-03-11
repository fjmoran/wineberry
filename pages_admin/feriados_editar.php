<div class="col-md-11">
 <h2>Editar Día Feriado</h2>
 <h5>Edición de días feriados</h5><br>


<?php 
$_GET['table'] = $bd.".Feriado";
$_GET['select'] = "fechaFeriado as Fecha, tipoFeriado as Tipo, Pais_idPais as Pais, descripcionFeriado as Descripcion, activoFeriado as Estado";
$_GET['where'] = "idFeriado='".$_GET['idFeriado']."'";
$_GET['edit'] = 1;
$_GET['jquery'] = "$('#cuerpo').load('pages_admin/feriados_mod.php');";

require("../recursos/zhi/insert_table_generic.php");

?>
</div><!-- col-md-11 -->