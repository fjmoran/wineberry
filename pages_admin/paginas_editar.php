<div class="col-md-11">
 <h2>Editar Página</h2>
 <h5>Edición de página del sistema</h5><br>

<?php

$_GET['table'] = $bd.".Pagina";
$_GET['select'] = "urlPagina as URL, nombrePagina as Pagina, descripcionPagina as Descripcion, activoPagina as Estado";
$_GET['where'] = "idPagina='".$_GET['idPagina']."'";
$_GET['edit'] = 1;
$_GET['jquery'] = "$('#cuerpo').load('pages_admin/paginas_mod.php');";

require("../recursos/zhi/insert_table_generic.php");
?>

</div><!-- col-md-11 -->