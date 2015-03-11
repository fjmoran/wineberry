<?php
if (($_GET['debug']) || ($_POST['debug'])){
	$debug = 1;
}else{
	unset($debug);
}

if ((isset($campos_busqueda)) && ($_GET['table']) && ($_GET['callerURL'])){
	if ($debug){
		echo "arreglo campos busqueda :";
		print_r($campos_busqueda);
		echo "</br>";
		echo "Tabla:";
		echo $_GET['table']."</br>";
	}

	$lista_opciones = "";

	$table = substr($_GET['table'],strpos($_GET['table'],".")+1);

	$query_fk = "SELECT k.REFERENCED_TABLE_NAME, k.REFERENCED_COLUMN_NAME, k.COLUMN_NAME\n"
	    . "FROM information_schema.TABLE_CONSTRAINTS i \n"
	    . "LEFT JOIN information_schema.KEY_COLUMN_USAGE k ON i.CONSTRAINT_NAME = k.CONSTRAINT_NAME \n"
	    . "WHERE i.CONSTRAINT_TYPE ='FOREIGN KEY'AND i.TABLE_SCHEMA = database() AND i.TABLE_NAME ='".$table."' order by k.REFERENCED_TABLE_NAME";

	if ($debug) {echo "Query para buscar llaves foraneas ".$query_fk."</br>";}

	if ($rs_fk = $mysqli->query($query_fk)){
		$fkeys = array();
		while ($row = $rs_fk->fetch_assoc()){
			$fkeys[$row['COLUMN_NAME']] = array($row['REFERENCED_TABLE_NAME'],$row['REFERENCED_COLUMN_NAME']);
		}
		if ($debug) {echo "Resultado de la query que retorna el listado de llaves foraneas ";print_r($fkeys); echo "</br>";}

	}else {
		echo "Falló al ejecutar la consulta: (". $mysqli->errno .") ". $mysqli->error;
	}
	$rs_fk->free();

	foreach ($campos_busqueda as $nombre => $columna){
		$lista_opciones .= "<li ";
		if ($debug){
			echo "nombre :".$nombre."</br>";
			echo "columna :".$columna."</br>";
		}
		if (array_key_exists($columna,$fkeys)){
			if ($debug){
				echo "Tabla Llave Foranea : ".$fkeys[$columna][0]."</br>";
				echo "Columna llave Foranea : ".$fkeys[$columna][1]."</br>";
			}
			$lista_opciones .= "foreign=\"1\" ";
			$lista_opciones .= "fkcolumna=\"".$fkeys[$columna][1]."\" ";
			$lista_opciones .= "fktable=\"".$fkeys[$columna][0]."\"";
		}else{
			$lista_opciones .= "foreign=\"0\" ";

		}
		$lista_opciones .= "columna=\"".$columna."\" ";
		$lista_opciones .= "><a href=\"#\">por : $nombre</a></li>\n";
	}
?>

<form role="form" id="basic_search" name="basic_search" method="GET" onsubmit="return false">
	<div class="row">
		<div class="col-md-4">	
			<div class="form-group">
				<div class="input-group">
				    <input type="text" class="form-control input-sm no-glow" id="txt_search" name="txt_search" placeholder="Buscar..." style="border-right-color: transparent;" value="<?php echo $_GET['txt_search'];?>">

				      <div id="div_reset_button" class="input-group-btn <?php if (!isset($_GET['txt_search'])) { echo "hide"; } ?>"> <!-- este es el hide del reset-search -->
				        <button class="btn btn-link btn-sm reset-search" type="button" id="reset_search_button"><span id="reset" class="glyphicon glyphicon-remove"></span></button>
				      </div>

				      <div class="input-group-btn">
				        <button type="button" class="btn btn-default dropdown-toggle btn-sm" data-toggle="dropdown" name="select_field"><span class="glyphicon glyphicon-search"></span>&nbsp<span class="glyphicon glyphicon-chevron-down"></span></button>
				        <ul id="listado_busqueda"class="dropdown-menu pull-right">
				        	<?php
				        	echo $lista_opciones;
				        	?>
				        </ul>
				      </div><!-- /btn-group -->
				</div><!-- /input-group -->
			</div>
		</div>
	</div>
</form>

<script type="text/javascript">
    $("#listado_busqueda > li").click(function() {
        target = $(this).text();
        columna = $(this).attr('columna');
        foreign = $(this).attr('foreign');
        if (foreign == 1){
        	fktabla = $(this).attr('fktable');
        	fkcolumna = $(this).attr('fkcolumna')
        }

	variable = $('#basic_search').serialize();

	variable += "&select_field=" + columna;
	if (foreign == 1){
		variable += "&foreign=" + foreign + "&fktabla=" + fktabla + "&fkcolumna=" + fkcolumna;
	}
	//alert(variable);
  $.ajax({
    url: '<?php echo $_GET['callerURL']; ?>',
    type: 'get',
   data: variable,
   success: function(response, textStatus, jqXHR){
      $('#cuerpo').html(response);   //select the id and put the response in the html
    },
   error: function(jqXHR, textStatus, errorThrown){
      console.log('error(s):'+textStatus, errorThrown);
   }
 });
 });

$("#txt_search").keydown(function(){
	$('#div_reset_button').removeClass('hide');
});

$("#reset_search_button").click(function(){
	$.ajax({
		url: '<?php echo $_GET['callerURL']; ?>',
		success: function(response, textStatus, jqXHR){
      		$('#cuerpo').html(response);   //select the id and put the response in the html
    	},
   		error: function(jqXHR, textStatus, errorThrown){
      		console.log('error(s):'+textStatus, errorThrown);
   		}
	});
});
</script>

<?php
}
?>