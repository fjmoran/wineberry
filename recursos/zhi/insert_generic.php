<?php

require_once "CreaConnv2.php";
require_once "auth.php";

if ((isset($_GET['debug']))||(isset($_POST['debug']))) { $debug = TRUE; } else {$debug = FALSE;}
	
if ($debug)	{echo "Insert Generic</br>";}

$select_all = "select * from ".$_POST['table']." LIMIT 1;";
if ($debug) {
	echo $select_all;
	echo "</br>";
}

$select = "select ";
if (isset($_POST['select'])){
	$select = $select.$_POST['select'];
}else {
	$select = $select."*";
}

$select = $select." from ".$_POST['table']." LIMIT 1;";
if ($debug) {
	echo $select;
	echo "</br>";
}

$select_all = $select_all.$select;

if ($mysqli->multi_query($select_all)) {
	if ($debug) {
		echo "despues de query";
		echo "</br>";
	}
	$resultado_tabla_completa = $mysqli->store_result();
	$mysqli->next_result();
	$resultado_tabla_select = $mysqli->store_result();
	if ($debug) {
		echo "Despues del store result";
		echo "</br>";
	}
	$info_tabla = $resultado_tabla_completa->fetch_fields();
	if ($debug) {
		print_r($info_tabla);
		echo "</br>";
	}
	$info_select = $resultado_tabla_select->fetch_fields();	
	if ($debug) {
		print_r($info_select);
		echo "</br>";
	}
	$VALUES = array();
	foreach ($info_tabla as $campo_tabla){
		$salida = 1;
		foreach ($info_select as $campo_select){
			if ($campo_tabla->orgname == $campo_select->orgname){
				if ($debug) {
					echo "campo_select ".$campo_select->orgname."=".$_POST[$campo_select->orgname];
					echo "</br> campo_tabla->type ".$campo_tabla->type;
					echo "</br>";
				}
				$type = $campo_tabla->type;
				switch ($type){
					case 10:
						$_POST[$campo_select->orgname] = date('Y-m-d',strtotime($_POST[$campo_select->orgname]));
						if (isset($debug)) { echo "En Case por tipo Fecha ".$_POST[$campo_select->orgname]." </br>";}
						break;
					case 3:
						if ($debug) {echo "En case por integer :@".$_POST[$campo_select->orgname]."@</br>";}
						if ((empty($_POST[$campo_select->orgname])) && ($_POST[$campo_select->orgname]!=0)) {
							$_POST[$campo_select->orgname] = "NULL";
						}
						break;
				}

				array_push($VALUES,$mysqli->real_escape_string($_POST[$campo_select->orgname])); 
				$salida = 0;
				break;
			}
		}
		if ($salida == 1){
			if ($debug){
				echo "campo_tabla ".$campo_tabla->orgname."=NULL";
				echo "</br>";
			}
			array_push($VALUES,"NULL"); 
		}
	}
	
	if ($debug) {
		print_r($VALUES);
		echo "</br>";
	}
	
	$list_value = "('";
	$list_value .= implode("','",$VALUES);
	$list_value .="')";
	$list_value = str_replace("'NULL'","NULL",$list_value);
	$insert = "INSERT INTO ".$_POST['table']." VALUES ".$list_value;
	if ($debug){
		echo $insert;
		echo "</br>";
	}
	
	$resultado_tabla_select->free();
	$resultado_tabla_completa->free();
	
	if ($mysqli->query($insert) === TRUE){
		$ID = $mysqli->insert_id;

echo "<html>
	<body>
	<p>Se insertado con exito en la tabla ".$_POST['table']." con el id ".$ID." </p>
	
	<script src=\"../jquery/jquery-1.10.2.min.js\"></script>    
  <script src=\"../bootstrap3/js/bootstrap.min.js\"></script>
	<script type=\"text/javascript\">
		parent.".$_POST['jquery']."
	</script>
	</body>
</html>";
	}
	else {
		echo "Falló al ejecutar el insert: (". $mysqli->errno .") ". $mysqli->error; 
	}
	
 } else{
	echo "Falló al ejecutar la consulta: (". $mysqli->errno .") ". $mysqli->error;
}
 
?>
