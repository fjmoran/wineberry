<?php
setlocale(LC_CTYPE, "es_ES");

define("LATIN1_UC_CHARS", "ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝ");
define("LATIN1_LC_CHARS", "àáâãäåæçèéêëìíîïðñòóôõöøùúûüý");

function SEC_TO_TIME($sec){
	$segundos = 0;
	$minutos = 0;
	$horas = 0;
	if ($sec != NULL){
		if($sec > 0){
			$segundos=$sec;
		}
		else {
			$segundos = 0;
		}
	}
	if ($segundos >= 60){
		$residuo = fmod($segundos,60);
		$minutos = ($segundos-$residuo)/ 60;
		$segundos = $segundos - $minutos*60;
	}
	if ($minutos >= 60){
		$horas = ($minutos-fmod($minutos,60)) / 60;
		$minutos = $minutos - $horas*60;
	}
	if ($segundos < 10){
		$seg = "0$segundos";
	}
	else {
		$seg = "$segundos";
	}
	if ($minutos < 10){
		$min = "0$minutos";
	}
	else {
		$min = "$minutos";
	}
	if ($horas < 10){
		$hrs = "0$horas";
	}
	else {
		$hrs ="$horas";
	}
	return sprintf("$hrs:$min");
}

function Cambia_Formato_Fecha($fecha){
	list($agno,$mes,$dia) = split("-",$fecha);
	$new_fecha = mktime(0,0,0,$mes,$dia,$agno);
	return $new_fecha;
}

function comando_mysql($sql,$connector){
	if ($rs = $connector->query($sql)){
		return $rs;
	}else{
		printf("Error: %s\n Error: %s", $mysqli->errno,$mysqli->error);
		return False;
	}
}

function Cambia_fmto_Hora($hora){
	list($horas,$minutos,$segundos) = split(":",$hora);
	$total = ($horas*60+$minutos)*60+$segundos;
	return $total;
}

function array_hora($hora){
	// recibe la en formato de horas no de segundos
	$horas = floor($hora);
	$minutos = ($hora - $horas) * 60;
	$minutos = round($minutos+0.1);
	return array($horas,$minutos);
}

function buscar_usuarios_mandante($id_tarea){ // Se ocupa en caso de se modifica la tarea desde ejecucion ya que necesito notificarle al mandante
	$usuarios = array();
	$s_select_mandante = "select * from mandantes where id = '$id_tarea'";
	$rs_select_mandante = comando_mysql($s_select);
	$f_select_mandante = mysql_fetch_object($rs_select_mandante);
	if ($f_select_mandante->id_tarea_padre != NULL){
		$s_select_ejecucion = "select * from ejecucion_tareas where id='$f_select_mandante->id_tarea_padre'";
		$rs_select_ejecucion = comando_mysql($s_select_ejecucion);
		$f_select_ejecucion = mysql_fetch_object($rs_select_ejecucion);
		array_push($usuarios,buscar_usuarios_mandante($f_select_ejecucion->id_mandante_tarea));
		mysql_free_result($rs_select_ejecucion);
	}
	array_push($usuarios,$f_select_mandante->id_usuario);
	mysql_free_result($rs_select_mandante);
	return $usuarios;
}

function buscar_usuario_ejecucion($id_tarea){ // Se ocupa cuando el se modifica la tarea desde mandante para notificarle a los ejecucion
	$usuarios = array();
	$s_select_mandante = "select * from mandante_tareas where id_tarea_padre = '$id_tarea'";
	$rs_select_mandante = comando_mysql($s_select_mandante);
	if (mysql_num_rows($rs_select_mandante)!=0){
		$s_select_ejecucion = "select * from ejecucion_tareas where id_mandante_tarea='$f_select_mandante->id_'";
		$rs_select_ejecucion = comando_mysql($s_select_ejecucion);
		while ($f_select_ejecucion = mysql_fetch_object($rs_select_ejecucion)){
			array_push($usuarios,buscar_usuario_ejecucion($f_select_ejecucion->id));
		}
		mysql_fee_result($rs_select_ejecucion);
	}
	mysql_free_result($rs_select_mandante);
	$s_select_ejecucion = "select * from ejecucion_tarea where id ='$id_tarea'";
	$rs_select_ejecucion = comando_mysql($s_select_ejecucion);
	$f_select_ejecucion = mysql_fetch_object($$rs_select_ejecucion);
	array_push($usuarios,$f_select_ejecucion->id_usuario);
	mysql_free_result($rs_select_ejecucion);
	return $usuarios;
}

function TIME_TO_SEC($hora){
	list($horas,$minutos,$segundo) = split(":",$hora);
	$sec = $horas * 3600 + $minutos * 60 + $segundo;
	return $sec;
}

function myfragment($str, $n, $delim='...') { // {{{
   $len = strlen($str);
   if ($len > $n) {
       preg_match('/(.{' . $n . '}.*?)\b/', $str, $matches);
       return rtrim($matches[1]) . $delim;
   }
   else {
       return $str;
   }
}

/******************************************************/
/* Funcion option_select
 * tabla:           Tablas que intervienen en el select
 * colNombre:		Columna del select que se pondra como titulo en el elemento de la lista
 * colValor:		Columna que se ocupara como indice en la lista
 * conector:		Variable de conexión a la BD.
 * where:			(Opcional) setencia where del select a la BD
 * selValor:		(Opcional) en caso de que exista un valor previamente selecccionado
 * orderby: 		(opcional) Si se quiere agregar algun orden especifico al select
 *
 * Devuelve un texto que representa la lista de todas las opciones que muestra el select
 */
function option_select($tabla,$colNombre,$colValor,$conector,$selValor="",$orderby=""){
	$result ="";
	$query = "select $colValor,$colNombre from $tabla ";
	if (!empty($orderby)){
		$query .= $orderby;
	}
	if ($rs_query = comando_mysql($query,$conector)){
		while ($fila = $rs_query->fetch_assoc()){
			$result .= "<option value=\"".$fila[$colValor]."\" ";
			if ((!(empty($selValor))) && ($selValor == $fila[$colValor])) {
				$result .= "selected ";
			}
			$result .= ">".$fila[$colNombre]."</option>\n";
		}
	}else{
		$result = "Fallo Query $query </br>";
	}
	return $result;
}

/******************************************************/
/* Funcion listado
 * class:			Clase del elemento de la lista
 * tabla:           Tablas que intervienen en el select
 * colNombre:		Columna del select que se pondra como titulo en el elemento de la lista
 * colValor:		Columna que se ocupara como indice en la lista
 * conector:		Variable de conexión a la BD.
 * where:			(Opcional) setencia where del select a la BD
 * selValor:		(Opcional) en caso de que exista un valor previamente selecccionado
 * orderby: 		(opcional) Si se quiere agregar algun orden especifico al select
 *
 * Devuelve un texto que representa la lista de todos los elementos seleccionados
 */
function listado($class,$tabla,$colNombre,$colValor,$conector,$where="",$selValor="",$orderby=""){
	$result ="";
	$title = "descripcion".$tabla;
	$query = "select $colValor,$colNombre,$title from $tabla ";
	
	if (!empty($where)){ $query .= "where ".$where." ";}
	if (!empty($orderby)){ $query .= $orderby;}
	if ($rs_query = comando_mysql($query,$conector)){
		while ($fila = $rs_query->fetch_assoc()){
			$result .= "<li id=\"tabla_".$fila[$colValor]."\" class=\"".$class."\" ";
			$result .= " rel=\"tooltip\" data-toogle=\"tooltip\" title=\"".$fila[$title]."\">".$fila[$colNombre]."</li>\n";
		}
	}else{
		$result = "Fallo Query $query </br>";
	}
	return $result;
}
/******************************************************/
/* Funcion paginar
 * actual:          Pagina actual
 * total:           Total de registros
 * por_pagina:      Registros por pagina
 * enlace:          Texto del enlace
 * Devuelve un texto que representa la paginacion
 */

function paginar($actual=1, $total, $por_pagina=10, $enlace,$href,$por_ventana=10) {
  $total_paginas = ceil($total/$por_pagina);
  $anterior = $actual - 1;
  $posterior = $actual + 1;
  $total_ventanas = ceil($total_paginas / $por_ventana);
  $ventana_actual = floor($actual / $por_pagina);
  
  $inicio_ventana = $ventana_actual * $por_pagina;
  if ($inicio_ventana < 1) { 
  	$inicio_ventana = 1;
  }
  
  $fin_ventana = (($ventana_actual + 1) * $por_pagina) - 1;
  if ($fin_ventana < 1) {
  	$fin_ventana = 1;
  }
  if ($fin_ventana > $total_paginas) {
  	$fin_ventana = $total_paginas;
  }


  $texto = "<ul class=\"pagination pagination-sm\" >";

  if ($actual > 1) {
    $texto .= "<li onclick=\"$('#cuerpo').load('$enlace$anterior');\"><a href=\"".$href."_".$anterior."\"><span class='glyphicon glyphicon-chevron-left'></span></a></li> ";
  }
  else {
    $texto .= "<li class=\"disabled\"><a href=#><span class='glyphicon glyphicon-chevron-left'></a></li> ";
  }
  for ($i=$inicio_ventana; $i<$actual; $i++) {
    $texto .= "<li onclick=\"$('#cuerpo').load('$enlace$i');\"><a href=\"".$href."_".$i."\">$i</a></li> ";
  }
  $texto .= "<li class=\"active\"><span>$actual<span class=\"sr-only\">(current)</span></span></li> ";
  for ($i=$actual+1; $i<=$fin_ventana; $i++) {
    $texto .= "<li onclick=\"$('#cuerpo').load('$enlace$i');\"><a href=\"".$href."_".$i."\">$i</a></li> ";
  }
  if ($actual<$total_paginas) {
    $texto .= "<li onclick=\"$('#cuerpo').load('$enlace$posterior');\"><a href=\"".$href."_".$posterior."\"><span class='glyphicon glyphicon-chevron-right'></a>";
  }
  else {
    $texto .= "<li class=\"disabled\"><a href=#><span class='glyphicon glyphicon-chevron-right'></a></li>";
  }
  
  $texto .= "</ul>";
  return $texto;
}

function select_paginar($tabla,$where="",$pag=1,$tampag=10,$CAMPO="TITULO",$connect){
	$sql_count = "SELECT COUNT(*) FROM ". $tabla;
	if ((isset($where)) and ($where != "")) $sql_count .= " WHERE ".$where;
	if ($result = $connect->query($sql_count)) { 
		list($total) = $result->fetch_row();
		$reg1 = ($pag-1) * $tampag;
		return array($reg1,$total);
	}else {
		echo "Falló al ejecutar la consulta: (". $connect->errno .") ". $connect->error;
		return 0;
	}
}
?>