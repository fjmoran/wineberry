<div class="col-md-11">
 <h2>Editar Región</h2>
 <h5>Edición de región</h5><br>

<?php

$_GET['table'] = $bd.".Region";
$_GET['select'] = "Pais_idPais as Pais, nombreRegion as Region, codeRegion as Codigo, activoRegion as Estado";
$_GET['where'] = "idRegion='".$_GET['idRegion']."'";
$_GET['edit'] = 1;
$_GET['jquery'] = "$('#cuerpo').load('pages_admin/region_mod.php');";

require("../recursos/zhi/insert_table_generic.php");
?>

</div><!-- col-md-11 -->