<div class="col-md-11">
 <h2>Crear Input</h2>
 <h5>Creación de nuevas comunas en el sistema</h5><br>


<?php 
$_GET['table'] = $bd.".Input";
$_GET['select'] = "Pagina_idPagina as Pagina, nombreInput as Nombre, descripcionInput as Descripcion, activoinput as Activo, ocultoInput as Oculto, sololecturaInput as SoloLectura";
$_GET['jquery'] = "$('#cuerpo').load('pages_admin/input_mod.php');";

require("../recursos/zhi/insert_table_generic.php");

?>
</div><!-- col-md-11 --> 