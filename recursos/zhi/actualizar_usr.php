<?php
require_once("auth.php");
require_once("CreaConnv2.php");

$update_Usuario = "update Usuario set nombreUsuario = '".$mysqli->real_escape_string($_POST['nombreUsuario'])."', correoUsuario = '".$mysqli->real_escape_string($_POST['correoUsuario'])."', telefonoUsuario = '".$mysqli->real_escape_string($_POST['telefonoUsuario'])."', celularUsuario = '".$mysqli->real_escape_string($_POST['celularUsuario'])."' where idUsuario = '".$_SESSION['idUsuario']."'";

if($mysqli->query($update_Usuario)){
	printf("%d fila insertada.\n", $mysqli->affected_rows);
}else{
	printf("Error: %s\n Error: %s", $mysqli->sqlstate,$mysqli->error);
}

?>

<script type="text/javascript">
parent.$("#cuerpo").load('pages/default.php');
</script>