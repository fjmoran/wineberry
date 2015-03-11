<?php

if (isset($_GET['debug'])) { echo "Generador de tablas automatico </br>";}
#Requiere el nombre de la tabla, el schema y la consulta a ejecutar, en caso que no exista consulta trae toda la tabla.

if (!defined('ENT_SUBSTITUTE')) {
    define('ENT_SUBSTITUTE', 8);
}

require_once ("auth.php");
require_once("CreaConnv2.php");

$table = substr($_GET['table'],strpos($_GET['table'],".")+1);
$schema = substr($_GET['table'],0,strpos($_GET['table'],"."));
$select = "select ";

$callerURL = pathinfo($_GET['callerURL']);

// Validación de que estoy en la tabla de usuario y que el usuario listado soy yo.

$UserTable = 0;

if ($callerURL['filename'] == "usr_mod") {
	$UserTable = 1;
	if ($_GET['debug']) { echo "User Table : ".$UserTable."</br>"; }
}


$body_table = ""; //se guardan los campos que van en body de la tabla
$header_table = ""; //se guardan los campos que van en header de la tabla

//Obtención de llaves primarias
$show_key = "show keys from ".$_GET['table']." where key_name = 'PRIMARY'";

if (isset($_GET['debug'])) {echo "Query para buscar llaves primarias ".$show_key."</br>";}

if ($rs_show = $mysqli->query($show_key)){
	$keys = array();
	while ($row = $rs_show->fetch_assoc()){
		array_push($keys,$row['Column_name']);
	}
	if (isset($_GET['debug'])) {echo "Resultado de la query que retorna el listado de llaves primarias ";print_r($keys); echo "</br>";}

}else {
	echo "Falló al ejecutar la consulta: (". $mysqli->errno .") ". $mysqli->error;
}
$rs_show->free();

// Obtención de Llaves Foraneas
$query_fk = "SELECT k.REFERENCED_TABLE_NAME, k.REFERENCED_COLUMN_NAME, k.COLUMN_NAME\n"
    . "FROM information_schema.TABLE_CONSTRAINTS i \n"
    . "LEFT JOIN information_schema.KEY_COLUMN_USAGE k ON i.CONSTRAINT_NAME = k.CONSTRAINT_NAME \n"
    . "WHERE i.CONSTRAINT_TYPE ='FOREIGN KEY'AND i.TABLE_SCHEMA = database() AND i.TABLE_NAME ='".$table."' order by k.REFERENCED_TABLE_NAME";

if (isset($_GET['debug'])) {echo "Query para buscar llaves foraneas ".$query_fk."</br>";}

if ($rs_fk = $mysqli->query($query_fk)){
	$fkeys = array();
	while ($row = $rs_fk->fetch_assoc()){
		$fkeys[$row['COLUMN_NAME']] = array($row['REFERENCED_TABLE_NAME'],$row['REFERENCED_COLUMN_NAME']);
	}
	if (isset($_GET['debug'])) {echo "Resultado de la query que retorna el listado de llaves foraneas ";print_r($fkeys); echo "</br>";}

}else {
	echo "Falló al ejecutar la consulta: (". $mysqli->errno .") ". $mysqli->error;
}
$rs_fk->free();

// Generacion del select como el usuario lo solicita

if (isset($_GET['select'])) { 
	$select = $select . $_GET['select'];
}
else { 
	$select = $select . "*";
}

$select = $select ." from ". $_GET['table']; 

if ((isset($_GET['where'])) and ($_GET['where']!="")) { 
	$select = $select." where ".$_GET['where'];
}

if (isset($_GET['orderby'])) { 
	$select = $select." order by ".$_GET['orderby'];
}

if (isset($_GET['limit'])) {
	$select = $select." LIMIT ".$_GET['limit'];
}

if (isset($_GET['debug'])) {echo "query que viene del usuario ".$select ."</br>";}

// Se ejecuta la consulta con el select solicitado por el usuario
$rs = $mysqli->query($select);
if (!$rs) {
	echo "Falló al ejecutar la consulta: (". $mysqli->errno .") ". $mysqli->error;
}

if (isset($_GET['debug'])) {
	echo "Numero de Filas que retorna la query ". $rs->num_rows."</br>";
	echo "====================</br>";
}

$info_select = $rs->fetch_fields();
if (isset($_GET['debug'])){ echo "Informacion de los campos de la query que viene del usuario ";print_r($info_select); echo "</br>";}

$column_select = array();
$title_select = array();

foreach ($info_select as $valor){
	array_push($column_select,$valor->orgname);
	array_push($title_select,$valor->name);
}

if (isset($_GET['debug'])) {echo "columnas que vienen del select usuario ";print_r ($column_select); echo "</br>";}
if (isset($_GET['debug'])) {echo "Titulos que vienen del select del usuario (title_select) ";print_r ($title_select); echo "</br>";}

if (isset($_GET['tabla']['title'])){
	if(isset($_GET['debug'])) { echo "tabla.title ".$_GET['tabla']['title']."</br>";}
	$title_table = explode(",",$_GET['tabla']['title']);
}else{
	$title_table = $title_select;
}

if (isset($_GET['debug'])) {echo "Titulos que entrego el usuario ";print_r ($title_table); echo "</br>";}

if (isset($_GET['tabla']['width'])){
	$title_width = explode(",",$_GET['tabla']['width']);
	if (isset($_GET['debug'])) {echo "Ancho de columnas que entrego el usuario ";print_r ($title_width); echo "</br>";}
}

// Chequeo del las PRIMARY KEY en el select enviado por el usuario, en caso que no esten las PRIMARY KEY se agregan a la query y se ejecuta nuevamente.

$regen_select = false; // variable para indicar si hay que regenerar la query

foreach ($keys as $key){
	if (in_array($key,$column_select)){
		if (isset($_GET['debug'])) {echo "Se encontro la llave ".$key." </br>";}
	}else{
		if (isset($_GET['debug'])) {echo "No se econtro la llave ".$key." </br>";}
		if (!(isset($_GET['select']))) { $_GET['select'] = $table.".*";}
		$_GET['select'] .= ",".$key." ";
		$regen_select = true;
	}
}

//Cheque llaves Foraneas en el select del usuario
$left_join	= array();
$last_table = "";
foreach ($fkeys as $fkey=>$value){
	if (in_array($fkey,$column_select)){
		
		if (isset($_GET['debug'])) {echo "Se encontro la llave foranea ".$fkey." </br>";}
		
		if (substr_count($fkey, "_") > 1) {
			$descomposicion_fkey = explode("_",$fkey);
			$tabla_fkey = $descomposicion_fkey[count($descomposicion_fkey)-2];
			$columna_fkey = $descomposicion_fkey[count($descomposicion_fkey)-1];
		}else {
			$tabla_fkey = $value[0];
			$columna_fkey = $value[1];
		}
		if ($last_table == $tabla_fkey){
			
			$left_join[sizeof($left_join)-1] .= " AND ".$tabla_fkey.".".$columna_fkey."=".$table.".".$fkey;
			if (isset($_GET['debug'])) {
				echo "Misma Tabla ".$tabla_fkey." ";
				print_r ($left_join);
				echo "</br>";
			}
		}else{
				array_push ($left_join,"LEFT JOIN ".$tabla_fkey." ON ".$tabla_fkey.".".$columna_fkey."=".$table.".".$fkey);
				$pos = array_search($fkey,$column_select);
				if(isset($_GET['debug'])) {echo "position : ".$pos."</br>valor : ".$column_select[$pos]."</br>";}
				$title_select[$pos] = "nombre".$tabla_fkey;
				$last_table = $tabla_fkey;
			}
		
		if (!(isset($_GET['select']))) { $_GET['select'] = $table.".*";}
		
		$_GET['select'] .= ", ".$tabla_fkey.".nombre".$tabla_fkey." ";

		$regen_select = true;
	}
}
if (isset($_GET['debug'])) {echo "Arreglo de Left join: "; print_r($left_join); echo "</br>";}

if ($regen_select) { // Si falto algun PRIMARY KEY o hay alguna llave foranea, se agrego a la consulta y se ejecuta nuevamente.
	$select = "select ";
	if (isset($_GET['select'])) { 
		$select = $select . $_GET['select'];
	}
	else { 
		$select = $select . "*";
	}

	$select = $select ." from ". $_GET['table']; 

	if (!(empty($left_join))){
		$select = $select ." ". implode(" ",$left_join);
	}

	// echo $select."</br>";

	if (isset($_GET['where'])) { 
		$select = $select." where ".$_GET['where'];
	}

	if (isset($_GET['orderby'])) { 
		$select = $select." order by ".$_GET['orderby'];
	}
	
	if (isset($_GET['limit'])) {
		$select = $select." LIMIT ".$_GET['limit'];
	}
		
	if (isset($_GET['debug'])) {echo "Query con PRIMARYKEY ".$select ."</br>";}

	// Se libera el result de la query con select del usuario
	$rs->free();

	// se ejecuta el query con las PRIMARY KEY faltantes
	$rs = $mysqli->query($select);
	if (!$rs) {
		echo "Falló al ejecutar la consulta: (". $mysqli->errno .") ". $mysqli->error."</br>";
	}
}

if ($rs->num_rows > 0){
	 if (isset($_GET['debug'])) {echo "En if num_rows</br>";}
}

//Llenado de $header_table
$header_table = "<tr>\n";
if (isset($_GET['debug'])) {echo "title_table:"; print_r($title_table); echo "</br>";}
for($i = 0; $i < count($title_table); $i++){
	$header_table.= "<th ";
	if (isset($_GET['tabla']['width'])){
		$header_table .= "width='".$title_width[$i]."'";
	}
	$header_table .= " >";
	$header_table .= htmlentities($title_table[$i],ENT_SUBSTITUTE,'UTF-8');
	$header_table .= "</th>\n";
}
if (isset($_GET['acciones'])){
	$header_table .= "<th width=10% style=\"text-align: center; color:#428BCA; \">Acciones</th>\n";
}
$header_table .= "</tr>\n";
if(isset($_GET['debug'])){echo $header_table."</br>";}
//Llenado de los datos de la tabla.
$campos_tabla = array();

while ($row = $rs->fetch_assoc()) {array_push($campos_tabla,$row);} // se saca toda la información resultante de la query en la variable $campos_tabla

$campos_tabla_info = $rs->fetch_fields(); // Se obtiene la descripcion de los campos que tiene la query

$rs->free();

if (isset($_GET['debug'])) {echo "Listado de datos para la tabla : "; print_r($campos_tabla); echo "</br>";}
if (isset($_GET['debug'])) {echo "Listado de campos que trae la tabla : ";print_r($campos_tabla_info); echo "</br>";}

$campo_tipo = array(); // arreglo con los tipos de las columnas en la tabla
foreach ($campos_tabla_info as $valor){ // se extraen los tipos d
	$campo_tipo[$valor->name]=$valor->type;
}

if (isset($_GET['debug'])) {echo "Listado de tipos de los campos que trae la tabla : ";print_r($campo_tipo); echo "</br>";}

foreach ($campos_tabla as $campo) {
	if (isset($_GET['debug'])) {
		echo "Campo a desplegar en la tabla (campo de campos_tabla):";
		print_r ($campo);
		echo "</br>";
	}
	$body_table .= "<tr>";
	$activo = false;
	foreach ($title_select as $columna){
		if (isset($_GET['debug'])) {echo "Agregando ".$columna."</br>";}
		$body_table .= "<td>";
		switch ($campo_tipo[$columna]){
			case 3:
			case 253:
			case 254:
			case 252:
				$body_table .= htmlentities($campo[$columna],ENT_SUBSTITUTE,'UTF-8');
				break;
			case 4:
				if (substr_count($_GET['table'], "Tarifa")){
					$query_simbolo = "select nombreMoneda from MONEDA, ".$_GET['table']." WHERE idMoneda = ".$campo['Moneda_idMoneda'];
					$rs_moneda_simbolo = $mysqli->query($query_simbolo);
					$simbolo = $rs_moneda_simbolo->fetch_assoc();
					$rs_moneda_simbolo->close();
					$body_table .= sprintf("%s %s",$simbolo['nombreMoneda'],number_format($campo[$columna],2,",","."));
				}else{
					$body_table .= htmlentities($campo[$columna],ENT_SUBSTITUTE,'UTF-8');
				}
				break; 
			case 1:
				$body_table .= "<span class=\"label ";
				if ($campo[$columna]){
					$body_table .= "label-success";
				}else {
					$body_table .= "label-danger";
				}
				$body_table .= "\">";
				if ($campo[$columna]){
					$body_table .= "Activo";
					$activo = true;
				}else {
					$body_table .= "Inactivo";
					$activo = false;
				}
				$body_table .= "</span>";
				break;
			case 10:
				if(isset($_GET['debug'])) {echo "Tipo Fecha </br>";}
				$body_table .= date('d-m-Y',strtotime($campo[$columna]));
				break;
		}
		$body_table .= "</td>\n";
	}
		$id = "";
		foreach ($keys as $key){
			$id .= $key ."=".$campo[$key]."&";
		}
		
		if ($_GET['acciones']){
		$body_table .= "<td style=\"text-align: center; \" >\n";			
			if (isset($_GET['accion'])){
				foreach ($_GET['accion'] as $key => $value) {
					if(isset($_GET['debug'])) {
						echo "Accion </br>";
						echo "Llave : ".$key."</br>";
						echo "Valor : ";
						print_r($value);
						echo "</br>";
					}

					switch ($key){
						case "activar":
							if (isset($_GET['debug'])) { echo "En acción activar ".$campo['idUsuario']." = ".$_SESSION['idUsuario']."</br>";}
							if ($activo){
								if (!(($UserTable) && ($campo['idUsuario'] == $_SESSION['idUsuario']))){
									$body_table .= "<a data-target=\"#generic_modal\" href=\"pages_admin/act_desact.php?table=".$_GET['table']."&activar=1&".$id."callerURL=".$_GET['callerURL']."\" data-toggle=\"modal\" data-backdrop=\"static\" data-keyboard=\"false\">";
								}
								$body_table .= "<span class=\"glyphicon glyphicon-remove-circle\" style=\"color:";
								if (!(($UserTable) && ($campo['idUsuario'] == $_SESSION['idUsuario']))){
									$body_table .= "black";
								}else {
									$body_table .= "#777";
								}
								$body_table .= "; font-size:12px; margin-right: 3px; margin-left: 3px;\" rel=\"tooltip\" data-toggle=\"tooltip\" title=\"Desactivar\"></span>";
								if (!(($UserTable) && ($campo['idUsuario'] == $_SESSION['idUsuario']))){
									$body_table .= "</a>";
								}
								}else {
									$body_table .= "<a data-target=\"#generic_modal\" href=\"pages_admin/act_desact.php?table=".$_GET['table']."&activar=0&".$id."callerURL=".$_GET['callerURL']."\" data-toggle=\"modal\" data-backdrop=\"static\" data-keyboard=\"false\">";
									$body_table .= "<span class=\"glyphicon glyphicon-refresh\" style=\"color:";
									$body_table .= "black";
								$body_table .= "; font-size:12px; margin-right: 3px; margin-left: 3px;\" rel=\"tooltip\" data-toggle=\"tooltip\" title=\"Reactivar\"></span>";
									$body_table.= "</a>";
								}
							break;
						default:
							if ((array_key_exists('modal',$value)) && ($value['modal'] == 1)){
								$body_table .= "<a data-target=\"#generic_modal\" href=\"".$value['URL']."?table=".$_GET['table']."&".$id."callerURL=".$_GET['callerURL']."\" data-toggle=\"modal\">";
							}else {
								$body_table .= "<a onclick=\"$('#cuerpo').load('".$value['URL']."?".$id."');\" href=\"#".$table."_".$key."\" >";
							}
							$body_table .= "<span class=\"".$value['class']."\" style=\"color: black; font-size:12px; margin-right: 3px; margin-left: 3px;\" rel=\"tooltip\" data-toggle=\"tooltip\" title=\"".$value['title']."\"></span></a>";
							break;
					}
				}
			}
			$body_table .= "</td>\n";
		}
	$body_table .= "</tr>";
}

if (isset($_GET['debug'])) {print_r($body_table);}

if ($total != 0) {
?>
<br>
<div id='table_generated'>
	<table class="table table-striped table-condensed">
		  <thead style="text-align: center; color:#428BCA;">
		    <?php
		    	echo $header_table;
		   	?>	
		  </thead>
		  <tbody>
		  	<?php
		  		echo $body_table;
		  	?>

		  </tbody>
	</table>
</div>
<div class="row"> 
	<div class="col-md-12">

		<span class="pull-right"><h5><?php echo "Desplegando página ".$_GET['pagina']." de ".ceil($total/$_GET['tampag']); ?></h5></span>

	</div>
</div>

<?php
}else{ 
?>
<br>
<div class="alert alert-warning"><?php echo "No se encontraron registros que coincidan con su búsqueda, por favor intentelo de nuevo.</br>"; ?></div>
	
<?php 
}
?>