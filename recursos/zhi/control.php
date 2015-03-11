<?php

require "CreaConn.php";

//Definir consulta

$SSQL="SELECT * FROM SCH2.Usuario WHERE Usuario.userUsuario='".$_POST['user']."' and Usuario.claveUsuario='".$_POST['password']."'";
//Realizar consulta
$rs=mysql_query($SSQL) or die ("No se pudo realizar $SSQL ".mysql_error()."\n");

//Buscar coincidencias
if (mysql_num_rows($rs)>0){
	$row=mysql_fetch_array($rs);
	$usuario1 = $row[userUsuario];
	session_start();
	$_SESSION[auth]=1;
	$_SESSION[user]=$row[userUsuario];
	$_SESSION[nombre]=$row[nombreUsuario];
	$_SESSION[perfil] = $row[Perfil_idPerfil];
	header ("Location:../../index.php");
}
else
{
	header("Location:../../login.php?error=1&user=".$_POST[user]);
}

mysql_free_result($rs);

require "CloseConn.php";
?>
