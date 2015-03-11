<div class="col-md-11">
 <h2>Crear Label</h2>
 <h5>Creación de nuevas etiquetas</h5><br>

<?php 
$_GET['table'] = $bd.".Label";
$_GET['select'] = "nombreLabel as Label, despliegueLabel as Despliegue, classLabel as Clase";
$_GET['jquery'] = "$('#cuerpo').load('pages_admin/label_mod.php');";

require("../recursos/zhi/insert_table_generic.php");

?>

</div><!-- col-md-11 -->