<?php
require_once("auth.php");
require_once("CreaConnv2.php");

if(($_SESSION['idUsuario'] == $_POST['idUsuario'])||(empty($_POST['idUsuario']))){
	$idUsuario = $_SESSION['idUsuario'];
}else{
	$idUsuario = $_POST['idUsuario'];
}

$update_clave = "update Usuario set claveUsuario='".$_POST['pass']."' where idUsuario='".$idUsuario."'";
if ($mysqli->query($update_clave)){
	printf("Update exitoso se han modificado %d filas",$mysqli->affected_rows);
}else{
	printf("Ha fallado la ejecución de la query %s por %d, %s",$update_clave,$mysqli->errno,$mysqli->error);
}
?>
<script src="recursos/jquery/jquery-1.10.2.min.js"></script>    
<script src="recursos/bootstrap3/js/bootstrap.min.js"></script>
<script type="text/javascript">
parent.$("#cuerpo").load('pages/default.php');
parent.$('body').removeClass('modal-open');
parent.$('.modal-backdrop').remove();
</script>