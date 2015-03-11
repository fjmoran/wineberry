<div class="col-md-11">
 <h2>Editar Label (Etiqueta)</h2>
 <h5>Edición de etiquetas del sistema</h5><br>

<?php

$_GET['table'] = $bd.".Label";
$_GET['select'] = "nombreLabel as Label, despliegueLabel as Despliegue, classLabel as Clase";
$_GET['where'] = "idLabel='".$_GET['idLabel']."'";
$_GET['edit'] = 1;
$_GET['jquery'] = "$('#cuerpo').load('pages_admin/label_mod.php');";

require("../recursos/zhi/insert_table_generic.php");
?>

</div><!-- col-md-11 -->