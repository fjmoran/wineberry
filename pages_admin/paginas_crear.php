<div class="col-md-11">
 <h2>Crear Página</h2>
 <h5>Creación de páginas</h5><br>

<?php 
$_GET['table'] = $bd.".Pagina";
$_GET['select'] = "urlPagina as URL, nombrePagina as Pagina, descripcionPagina as Descripcion, activoPagina as Estado";
$_GET['jquery'] = "$('#cuerpo').load('pages_admin/paginas_mod.php');";

require("../recursos/zhi/insert_table_generic.php");

?>

</div><!-- col-md-11 -->