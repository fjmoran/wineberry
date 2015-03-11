<?php

require_once "CreaConnv2.php";
require_once "auth.php";

if ((isset($_GET['debug']))||(isset($_POST['debug']))) { $debug = TRUE; } else {$debug = FALSE;}
	
if ($debug)	{
	echo "Update Generic</br>";
	echo "==============</br>";
}
if (isset($_GET)) {
	if ($debug){
		echo "_GET :";
		print_r($_GET);
	}
}
if (isset($_POST)){
	if ($debug){
		echo "_POST :";
		print_r($_POST);
	}
}

if ($debug){echo "</br>";}

$select = "select * from ".$_POST['table']." where ".$_POST['where']." LIMIT 1;";
$data_campos = array();
$tipos_campos_tabla = array();

if ($rs = $mysqli->query($select)){
	$info_campos = $rs->fetch_fields();
	foreach ($info_campos as $campo) { $info_campos_tabla[$campo->orgname]=$campo->type;}
	while($fila_campo = $rs->fetch_assoc()){
		array_push($data_campos,$fila_campo);
	}
	$rs->free();
}else{
	echo <<<HTML_BODY
	<html>
	<body>
	<p>Falló al ejecutar la consulta: ( $mysqli->errno )  $mysqli->error</p>
	</body>
	</html>
HTML_BODY;
}

if ($debug) { echo "info_campos :"; print_r($info_campos); echo "</br>";}
if ($debug) { echo "data_campos :"; print_r($data_campos); echo "</br>";}
if ($debug) { echo "info_campos_tabla :"; print_r($info_campos_tabla); echo "</br>";}

$update = "update ".$_POST['table']. " SET ";
$i = 0;

foreach ($data_campos as $data_fila){
	foreach ($data_fila as $llave => $valor){
		
		if ($debug) { echo "$llave => ".$_POST[$llave]." </br>";}

		if (isset($_POST[$llave])) {
			if ($debug) { echo "_POST[$llave]".$_POST[$llave]."</br>";}
			switch ($info_campos_tabla[$llave]) {
				case 10:
					$_POST[$llave] = date('Y-m-d',strtotime($_POST[$llave]));
					break;
			}
			if ($i > 0) {$update .= ",";}
			if ($_POST[$llave] === 'NULL'){
				$update .= "$llave = NULL";
			}else{ 
				$update .= "$llave = '".$_POST[$llave]."'";
					}
			$i++;
		} else {
			if ($debug) {echo "No esta definido $llave en _POST </br>";}
			switch ($info_campos_tabla[$llave]) {
				case 1:
					if ($debug) { echo "En checkbox no seleccionado $llave </br>";}
					if ($i > 0) {$update .= ",";}
					$update .= "$llave = '0'";
					$i++;
					break;
			}
		}
	}
}

$update .= " where ".$_POST['where'];

if ($debug) {echo "comando update : $update </br>";}

if ($mysqli->query($update) === TRUE){
	$filas_update = $mysqli->affected_rows;
	echo <<<HTML_BODY
	<html>
	<body>
	<p>Se actualizaron con exito en la tabla $_POST[table] $filas_update fila(s) con condición $_POST[where]</p>
	<script src="../jquery/jquery-1.10.2.min.js"></script>    
	<script src="../bootstrap3/js/bootstrap.min.js"></script>
	<script type="text/javascript">
		parent.$_POST[jquery]
	</script>
	</body>
</html>
HTML_BODY;

}else{
	echo <<<HTML_BODY
	<html>
	<body>
	<p>Falló al ejecutar la consulta: ( $mysqli->errno )  $mysqli->error</p>
	</body>
	</html>
HTML_BODY;
}

?>
