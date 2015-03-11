<div class="col-md-11">
 <h2>Editar Usuario</h2>
 <h5>Edición de datos del usuario</h5><br>

<?php

$_GET['table'] = $bd.".Usuario";
$_GET['select'] = "nombreUsuario as Nombre, userUsuario as Usuario, correoUsuario as Correo, telefonoUsuario as Telefono, celularUsuario as Movil, Perfil_idPerfil as Rol, activoUsuario as Estado";
$_GET['where'] = "idUsuario='".$_GET['idUsuario']."'";
$_GET['edit'] = 1;
$_GET['jquery'] = "$('#cuerpo').load('pages_admin/usr_mod.php');";

require("../recursos/zhi/insert_table_generic.php");
?>

</div><!-- col-md-11 -->