<div class="col-md-11">
 <h2>Editar País</h2>
 <h5>Edición de país</h5><br>

<?php

$_GET['table'] = $bd.".Pais";
$_GET['select'] = "nombrePais as Pais, intcodePais as Codigo, activoPais as Estado";
$_GET['where'] = "idPais='".$_GET['idPais']."'";
$_GET['edit'] = 1;
$_GET['jquery'] = "$('#cuerpo').load('pages_admin/pais_mod.php');";

require("../recursos/zhi/insert_table_generic.php");
?>

</div><!-- col-md-11 -->