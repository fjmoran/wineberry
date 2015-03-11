<div class="col-md-11">
 <h2>Crear Materia</h2>
 <h5>Creación de nuevas materias en el sistema</h5><br>


<?php 
$_GET['table'] = $bd.".Materia";
$_GET['select'] = "nombreMateria as Materia, descripcionMateria as Descripcion, Cliente_idCliente as Cliente, Usuario_idUsuario as Abogado, TipoMateria_idTipoMateria as TipoMateria, activoMateria as Estado";
$_GET['jquery'] = "$('#cuerpo').load('pages_admin/mat_mod.php');";

require("../recursos/zhi/insert_table_generic.php");

?>
</div><!-- col-md-11 -->