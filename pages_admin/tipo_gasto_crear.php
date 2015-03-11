<div class="col-md-11">
 <h2>Crear Tipo de Gasto</h2>
 <h5>Creación de nuevos tipos de gasto</h5><br>

<?php 
$_GET['table'] = $bd.".TipoGasto";
$_GET['select'] = "nombreTipoGasto as Nombre, descripcionTipoGasto as Descripcion";
$_GET['jquery'] = "$('#cuerpo').load('pages_admin/tipo_gasto_mod.php');";

require("../recursos/zhi/insert_table_generic.php");

?>

</div><!-- col-md-11 -->