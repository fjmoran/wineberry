<?php
require_once("auth.php");
require_once("CreaConnv2.php");

if (isset($_GET['debug'])) { echo "Generador de Formularios automatico </br>";}

if (!defined('ENT_SUBSTITUTE')) {
    define('ENT_SUBSTITUTE', 8);
}

$table = substr($_GET['table'],strpos($_GET['table'],".")+1);
$schema = substr($_GET['table'],0,strpos($_GET['table'],"."));
$validacion = array();
$edicion = false;

$script = "";

$select = "select ";

// se arma el select enviado por el usuario
if (isset($_GET['select'])) { 
	$select = $select . $_GET['select'];
}
else { 
	$select = $select . "*";
}

$select = $select ." from ". $_GET['table']; 

if (isset($_GET['where'])) { 
	$select = $select." where ".$_GET['where'];
}

if (isset($_GET['debug'])) {echo $select ."</br>";}

$rs = $mysqli->query($select);
if (!$rs) {
	echo "Falló al ejecutar la consulta: (". $mysqli->errno .") ". $mysqli->error;
}

if (isset($_GET['debug'])) {
	echo "Numero de Filas ". $rs->num_rows."</br>";
	echo "====================</br>";
}

$info_campo = $rs->fetch_fields();
if (isset($_GET['debug'])){ echo "info_campo : ";print_r($info_campo); echo "</br>";}
$info_fila = $rs->fetch_assoc();
if (isset($_GET['debug'])){ echo "info_fila : "; print_r($info_fila); echo "</br>";}
$rs->free();

$arreglo_campos_formulario = array();
$llave_primaria = array();

foreach ($info_campo as $valor) {
  
  $campo_formulario = "";

  if (isset($_GET['debug'])) {
    printf("Nombre:        %s</br>", $valor->name);
    printf("Tabla:         %s</br>", $valor->table);
    printf("Longitud max.: %d</br>", $valor->max_length);
    printf("Banderas:      %d</br>", $valor->flags);
    printf("Tipo:          %d</br>", $valor->type);
  }
  switch ($valor->type) {
    case 4: // si el campo es tipo FLOAT
    case 252: // si el campo es de tipo TEXT
    case 253:  // si el campo es de tipo VARCHAR
    // Todos se muestran como una input de texto
      if (isset($_GET['debug'])) { echo "Tipo FLOAT,TEXT o VARCHAR </br>";}
    	$campo_formulario = "<label for=\"".$valor->orgname."\">".htmlentities($valor->name,ENT_SUBSTITUTE,'UTF-8').":</label><input id=\"".$valor->orgname."\" class=\"form-control\" type=\"text\" name=\"".$valor->orgname."\"";
      if ((isset($_GET['where'])) and ($_GET['edit'])){
        $campo_formulario .= "value=\"".$info_fila[$valor->name]."\"";
      }
      $campo_formulario .= " >";
      if ($valor->flags & 1) { array_push($validacion,$valor->orgname); } // si el campo es NOT NULL
      break;
              
    case 1: // si el campo es del tipo boolean, este tipo se muestra como un checkbox.
      if (isset($_GET['debug'])) { echo "Tipo BOOLEAN </br>";}
      // Si el usuario se esta editando a si mismo no puede desactivarse
      // esto hara que cualquier checkbox que sea desplegada en algun formulario con campo idUsuario
      // y que el idUsuario sea igual a SESSION idUsuario no se desplegara ya que no se valida el nombre
      // de la URL llamadora.
      if ((isset($_GET['idUsuario'])) && ($_GET['idUsuario'] == $_SESSION['idUsuario'])) {
         	$campo_formulario .= "<input type=\"hidden\" name=\"".$valor->orgname."\" value=\"1\">";          
          //if ($valor->flags & 1) { array_push($validacion, $valor->orgname);}
      } else {
        $campo_formulario = "<label for=\"".$valor->orgname."\">".htmlentities($valor->name,ENT_SUBSTITUTE,'UTF-8').":</label><div class=\"checkbox\"><label><input type=\"checkbox\" value=\"1\" name=\"".$valor->orgname ."\"";
        if ((isset($_GET['where'])) and ($_GET['edit'])){
          if ($info_fila[$valor->name]){
            $campo_formulario .= "checked";
          }
        }else{
          $campo_formulario .= " checked";
        }
        $campo_formulario .= " > Activo</label></div>";            
      }
      break;

    case 10: 
    // si el campo es del tipo date/time, despliega un modal donde se muestra el calendario
    // para seleccionar la fecha
      if(isset($_GET['debug'])) { echo "Es del tipo Fecha </br>";}
      $campo_formulario .= "<div class=\"form-group\">";
      $campo_formulario .= "<label for=\"".$valor->orgname."\">Fecha:</label>";
      $campo_formulario .= "<div class=\"input-group\">";
      $campo_formulario .= "<span class=\"input-group-addon\">";
      $campo_formulario .= "<span class=\"glyphicon glyphicon-th\"></span>";
      $campo_formulario .= "</span>";
      $campo_formulario .= "<input type=\"text\" class=\"form-control\" id=\"".$valor->orgname."\" name=\"".$valor->orgname."\"";
      if ((isset($_GET['where'])) and ($_GET['edit'])){
        $campo_formulario .= "value=\"".date('d-m-Y',strtotime($info_fila[$valor->name]))."\"";
      }
      $campo_formulario .= "placeholder=\"Seleccione una fecha\" readonly=\"true\">";
      $campo_formulario .= "</div>";
      $campo_formulario .= "</div>";
      // Se agrega script para el calendario.
      $script .= "<script type=\"text/javascript\">\n";
      $script .= "$(document).ready(function(){";
      $script .= "$('#".$valor->orgname."').datepicker();";
      $script .= "})\n";
      $script .= "</script>";
      if ($valor->flags & 1) { array_push($validacion, $valor->orgname);}
      break;
      
    case 3: 
      // si el campo encontrado es una Integer (la restriccion es que todas las llaves
      // en el modelo son integer, en caso de no ser asi, hay que hacer todas estas validaciones
      // con los tipos de datos que sean llaves en el modelo.
      if (isset($_GET['debug'])) { echo "Tipo INTEGER </br>";}
      if (!($valor->flags & 2)) {
        // No es llave primaria, por lo que es una referencia.
        if (isset($_GET['debug'])) { echo "No es Llave Primaria</br>"; }
       	$query = "select REFERENCED_TABLE_NAME, REFERENCED_COLUMN_NAME from information_schema.key_column_usage where column_name = '".$valor->orgname."' and table_name='".$table."'";
        if (isset($_GET['debug'])) { echo "Query de FOREIGN key cuando no es primary key ".$query."</br>"; }
        $rsfk = $mysqli->query($query);
        $info = $rsfk->fetch_assoc();
        if (isset($_GET['debug'])) { print_r ($info); echo "</br>"; }
        $rsfk->free();

      } else {
        // Llave Primaria, puede ser compuesta o simple. 
        // En caso de ser compuesta hay que ver que se muestren los campos que son referencia
        // de otra tabla.
        // Se crea arreglo con los datos de los campos de la llave despues se vera si se despliega o no.
        if ($valor->flags & 16384) { 
          if (isset($_GET['debug'])) {echo "Es parte de una Llave ".$valor->orgname."</br>";}
          array_push($llave_primaria,$valor->orgname);
          if (isset($_GET['debug'])) {print_r($llave_primaria); echo "</br>";}
          $query = "select REFERENCED_TABLE_NAME, REFERENCED_COLUMN_NAME from information_schema.key_column_usage where column_name = '".$valor->orgname."' and table_name='".$table."'";
          if (isset($_GET['debug'])) { echo $query."</br>"; }
          $rspk = $mysqli->query($query);
          if ($rspk->num_rows > 1) {
            if (isset($_GET['debug'])) {echo "Son mas de una fila </br>"; }
            $rspk->data_seek(1);
          }
          $info = $rspk->fetch_assoc();
          if (isset($_GET['debug'])) { print_r ($info); echo "</br>"; }
          $rspk->free();

        }
      }

      if($info['REFERENCED_TABLE_NAME'] == NULL){
        if (!($valor->flags & 512)){ 
          $campo_formulario = "<label for=\"".$valor->orgname."\">".htmlentities($valor->name,ENT_SUBSTITUTE,'UTF-8').":</label><input id=\"".$valor->orgname."\" class=\"form-control\" type=\"text\" name=\"".$valor->orgname."\"";
          if ((isset($_GET['where'])) and ($_GET['edit'])){
            $campo_formulario .= "value=\"".$info_fila[$valor->name]."\"";
          }
          $campo_formulario .= " >";
        }
      }else {
        if (isset($_GET['debug'])) { echo " Es un Foreign Key de la tabla ".$info['REFERENCED_TABLE_NAME']."</br>"; }
        
        // Nuevo metodo de obtener el listado del FK desde el nombre del campo
        $fk_descomposicion_por_nombre = explode("_",$valor->orgname);
        $fk_tabla_consulta = $fk_descomposicion_por_nombre[count($fk_descomposicion_por_nombre)-2];
        $fk_llave_consulta = $fk_descomposicion_por_nombre[count($fk_descomposicion_por_nombre)-1];
        $fk_columna_consulta = "nombre".$fk_tabla_consulta;
        
        if ($_GET['debug']) {
	        echo "Descomposición por Nombre : ".$fk_descomposicion_por_nombre."</br>";
	        echo "Tabla consulta fk : ".$fk_tabla_consulta."</br>";
	        echo "Llave consulta fk : ".$fk_llave_consulta."</br>";
	        echo "Columna consulta fk : ".$fk_columna_consulta."</br>";
        }
        // haciendo compatibilidad con viejo sistema de llaves foraneas
        // $info['REFERENCED_COLUMN_NAME'] = $fk_descomposicion_por_nombre[count($fk_descomposicion_por_nombre)-1];
        // $info['REFERENCED_TABLE_NAME'] = $fk_descomposicion_por_nombre[count($fk_descomposicion_por_nombre)-2];
        
        $select_list = "select ".$fk_llave_consulta." as id, ".$fk_columna_consulta." as nombre from ".$db.".".$fk_tabla_consulta." where activo".$fk_tabla_consulta."='1'"; // Creo la consulta, posee varias restricciones con respecto a como esta hecha la tabla, entre ellas el hecho que la tabla tiene un campo llamado nombre<tabla> que se desplegara en los select para ser visto por el usuario
        if (isset($_GET['debug'])) { echo "Query Foreign Key ".$select_list."</br>"; }
        $rs_list_fk = $mysqli->query($select_list); // Ejecuto la consulta
        $campo_formulario = "<label for=\"".$valor->orgname."\">".htmlentities($valor->name,ENT_SUBSTITUTE,'UTF-8').":</label><select name=\"".$valor->orgname."\" class=\"form-control\">"; // Creo el label con el select del campo para el formulario
        if (!($valor->flags & 1)){ // verifico que NO sea una llave que tenga el flag de not null activo para agregar la opción de NULL en el select
	      $campo_formulario .= "<option value=\"NULL\"";
          if ((isset($_GET['where'])) and ($_GET['edit'])){
            if ($info_fila[$valor->name] == $list_fk['id']){
              $campo_formulario .= "selected";
            }
          }
          $campo_formulario .= " >&nbsp;</option>";
        }
        while ($list_fk=$rs_list_fk->fetch_assoc()) { // agrego todos los valores encontrados en la tabla de la llave. Estos son los option del select.
          $campo_formulario .= "<option value=\"".$list_fk['id']."\"";
          if ((isset($_GET['where'])) and ($_GET['edit'])){
            if ($info_fila[$valor->name] == $list_fk['id']){
              $campo_formulario .= "selected";
            }
          }
          $campo_formulario .= " >".$list_fk['nombre']."</option>";
        }
        $rs_list_fk->free();
        $campo_formulario .= "</select>";
      }
      #if($valor->flags & 1) { array_push($validacion, $valor->orgname);}
      break;
      
    case 254: // si el campo es de tipo SET
      if (isset($_GET['debug'])) { echo "Tipo SET </br>";}
      //Acá va lo que se tiene que hacer con el tipo set
      $show_setvalues = "show columns from ".$_GET['table']." LIKE '".$valor->orgname."'";
      $rs_setvalues = $mysqli->query($show_setvalues);
      $array_setvalues = $rs_setvalues->fetch_assoc();
      
      if (isset($_GET['debug'])) {echo "Array set values : ";print_r($array_setvalues);echo "</br>";}

      $line_values = $array_setvalues['Type'];
      $line_values = substr($line_values,4,-1);
      $line_values = str_replace("'","",$line_values);
      
      if (isset($_GET['debug'])) {echo "line values : ";print_r($line_values);echo "</br>";}

      $values = explode(",",$line_values);

      if (isset($_GET['debug'])) {echo "valores del SET : ";print_r($values);echo "</br>";}

      $campo_formulario = "<label for=\"".$valor->orgname."\">".htmlentities($valor->name,ENT_SUBSTITUTE,'UTF-8').":</label><select name=\"".$valor->orgname."\" class=\"form-control\">";
      foreach ($values as $val){
        $campo_formulario .= "<option value=\"".$val."\"";
        if ((isset($_GET['where'])) and ($_GET['edit'])){
          if ($info_fila[$valor->name] == $val){
            $campo_formulario .= "selected";
          }
        }
        $campo_formulario .=" >".htmlentities($val,ENT_SUBSTITUTE,'UTF-8')."</option>";
      }
      $campo_formulario .= "</select>";

      $rs_setvalues->free();
      #if($valor->flags & 1) { array_push($validacion, $valor->orgname);}
      break;
      
    default: //cualquier cosa que no esta clasificada pasara por esto.
      if(isset($_GET['debug'])) {echo "Tipo no clasificado ".$valor->type; echo "</br>";}
      break;
  }  
  array_push($arreglo_campos_formulario, $campo_formulario);
  if (isset($_GET['debug'])) {echo "====================</br>";}
}
if (isset($_GET['debug'])) {print_r ($arreglo_campos_formulario); echo "</br>";}
if (isset($_GET['debug'])) {echo " Arreglo de Validacion </br>";print_r ($validacion); echo "</br>";}
?>
<div id="alert" class="alert alert-danger alert-dismissable <?php if (!(isset($_GET['alert']))) {echo "hide";} ?>">
  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
  <span>Este registro ya existe!</span>
</div>
	<form name="InsertEditForm" id="InsertEditForm" role="form" method="POST" action="<?php
    if ($_GET['edit']){
      echo "recursos/zhi/update_generic.php";
    } else {
      echo "recursos/zhi/insert_generic.php";
    }
  ?>
" target="IframeOutput">
    <div class="row"> 
      <div class="col-md-6"> <!-- columna uno -->
        <?php
          for ($i=0; $i <= count($arreglo_campos_formulario) -1; $i += 2){
            echo "<div class=\"form-group\">";
            echo $arreglo_campos_formulario[$i];
            echo "</div>";
          }
        ?>
      </div>
    <div class="col-md-6"> <!-- columna dos -->
        <?php
          for ($i=1; $i <= count($arreglo_campos_formulario) -1; $i += 2){
            echo "<div class=\"form-group\">";
            echo $arreglo_campos_formulario[$i];
            echo "</div>";
          }
        ?>
    </div>
  </div>

  <div class="row pull-right"> <!-- fila para botones -->
    <div class="col-md-12">
      <p>
        <button class="btn btn-default" type="reset" onclick= "<?php echo ($_GET['jquery']); ?>" >Cancelar</button>
        <button class="btn btn-primary" type="submit">Guardar</button>
      </p>
    </div>
  </div> 
  <input type="hidden" name="table" value="<?php echo $_GET['table']; ?>">
  <input type="hidden" name="select" value="<?php echo $_GET['select']; ?>">
  <?php if ($_GET['edit']) {
    echo "<input type=\"hidden\" name=\"where\" value=\"".$_GET['where']."\">";
  }
  ?>
  <input type="hidden" name="jquery" value="<?php echo $_GET['jquery'];?>">
  <input type="hidden" name="debug" value="1">
  
</form>	

<?php echo $script; ?>
<script type="text/javascript">
$( "#InsertEditForm" ).submit(function( event ) {
var mensaje = "";
var error = 0;
  <?php
    foreach ($validacion as $valor) {
      echo "if (\$(\"#$valor\").val().length == 0) {
         mensaje+=\" $valor No puede ser vacio </br>\";
         error=1;
      }";
    }
  ?>

if (error == 1){
  $( "#alert span" ).html("Faltan Campos : "+mensaje);
  $( "#alert" ).removeClass("hide");
  event.preventDefault();
}
});
</script>