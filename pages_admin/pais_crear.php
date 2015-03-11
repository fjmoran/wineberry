<div class="col-md-11">
 <h2>Crear País</h2>
 <h5>Creación de nuevos países en el sistema</h5><br>


<?php 
$_GET['table'] = $bd.".Pais";
$_GET['select'] = "nombrePais as Pais, intcodePais as Codigo, activoPais as Estado";
$_GET['jquery'] = "$('#cuerpo').load('pages_admin/pais_mod.php');";

require("../recursos/zhi/insert_table_generic.php");

?>
</div><!-- col-md-11 -->