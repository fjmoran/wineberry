<?php

error_reporting(E_ALL);

require_once "CreaConnv2.php";
require "auth.php";

$table = substr($_GET[table],strpos($_GET[table],".")+1);
$schema = substr($_GET[table],0,strpos($_GET[table],"."));
$select = "select ";

if (isset($_GET[select])) { 
	$select = $select . $_GET[select];
}
else { 
	$select = $select . "*";
}

$select = $select ." from ". $_GET[table]; 

if (isset($_GET[where])) { 
	$select = $select." where ".$_GET[where];
}

if (isset($_GET[debug])) {echo $select ."</br>";}

$rs = $mysqli->query($select);
if (!$rs) {
	echo "Falló al ejecutar la consulta: (". $mysqli->errno .") ". $mysqli->error;
}

if (isset($_GET[debug])) {
	echo "Numero de Filas ". $rs->num_rows."</br>";
	echo "====================</br>";
}

$info_campo = $rs->fetch_fields();
if (isset($_GET[debug])){ print_r($info_campo);}
$info_fila = $rs->fetch_assoc();
if (isset($_GET[debug])){ print_r($info_fila);}
$rs->free();

$arreglo_campos_formulario = array();

foreach ($info_campo as $valor) {
  
  $campo_formulario = "";

  if (isset($_GET[debug])) {
    printf("Nombre:        %s</br>", $valor->name);
    printf("Tabla:         %s</br>", $valor->table);
    printf("Longitud max.: %d</br>", $valor->max_length);
    printf("Banderas:      %d</br>", $valor->flags);
    printf("Tipo:          %d</br>", $valor->type);
    echo "====================</br>";
  }
   switch ($valor->type) {
    case 252:
    case 253: $campo_formulario = "<label for=\"".$valor->orgname."\">".$valor->name.":</label><input id=\"".$valor->orgname."\" class=\"form-control\" type=\"text\" name=\"".$valor->orgname."\"";
              if ((isset($_GET[where])) and ($rs->num_rows)){
                $campo_formulario .= "value=\"".$info_fila[$valor->name]."\"";
              }
              $campo_formulario .= " >";
              break;
    case 1: $campo_formulario = "<label for=\"".$valor->orgname."\">".$valor->name.":</label><div class=\"checkbox\"><label><input type=\"checkbox\" value=\"1\" name=\"".$valor->orgname ."\"";
            if ((isset($_GET[where])) and ($rs->num_rows)){
              if ($info_fila[$valor->name]){
                $campo_formulario .= "checked";
              }
            }else{
              $campo_formulario .= " checked";
            }
            $campo_formulario .= " > Activo</label></div>";
            break;
    case 3:
      if (!($valor->flags & 2)) {
        if (isset($_GET[debug])) { echo "No es Llave Primaria</br>"; }
        $query = "select REFERENCED_TABLE_NAME, REFERENCED_COLUMN_NAME from information_schema.key_column_usage where column_name = '".$valor->orgname."' and table_name='".$table."'";
        if (isset($_GET[debug])) { echo $query."</br>"; }
        $rsfk = $mysqli->query($query);
        $info_fk = $rsfk->fetch_assoc();
        if (isset($_GET[debug])) { print_r ($info_fk); echo "</br>"; }
        $rsfk->free();
        if($info_fk[REFERENCED_TABLE_NAME] == NULL){
          $campo_formulario = "<label for=\"".$valor->orgname."\">".$valor->name.":</label><input id=\"".$valor->orgname."\" class=\"form-control\" type=\"text\" name=\"".$valor->orgname."\"";
          if ((isset($_GET[where])) and ($rs->num_rows)){
            $campo_formulario .= "value=\"".$info_fila[$valor->name]."\"";
          }
          $campo_formulario .= " >";
        }else {
          
          if (isset($_GET[debug])) { echo " Es un Foreign Key de la tabla ".$info_fk[REFERENCED_TABLE_NAME]."</br>"; }
          $select_list = "select ".$info_fk[REFERENCED_COLUMN_NAME]." as id, nombre".$info_fk[REFERENCED_TABLE_NAME]." as nombre from ".$schema.".".$info_fk[REFERENCED_TABLE_NAME]." where activo".$info_fk[REFERENCED_TABLE_NAME]."='1'";
          if (isset($_GET[debug])) { echo "Query Foreign Key ".$select_list."</br>"; }
          $rs_list_fk = $mysqli->query($select_list);
          $campo_formulario = "<label for=\"".$valor->orgname."\">".$valor->name.":</label><select name=\"".$valor->orgname."\" class=\"form-control\">";
          while ($list_fk=$rs_list_fk->fetch_assoc()) {
            $campo_formulario .= "<option value=\"".$list_fk[id]."\">".$list_fk[nombre]."</option>";
          }
          $rs_list_fk->free();
          $campo_formulario .= "</select>";
        }
      } 
      break;                   
    }  
  array_push($arreglo_campos_formulario, $campo_formulario);
}
if (isset($_GET[debug])) {print_r ($arreglo_campos_formulario); echo "</br>";}

?>
	<form role="form" method="POST" action="recursos/zhi/insert_generic.php" target="IframeOutput">
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
        <button class="btn btn-default" type="reset" onclick= "<?php echo ($_GET[jquery]); ?>" >Cancelar</button>
        <button class="btn btn-primary" type="submit">Guardar</button>
      </p>
    </div>
  </div> 
  <input type="hidden" name="table" value="<?php echo $_GET[table]; ?>">
  <input type="hidden" name="select" value="<?php echo $_GET[select]; ?>">
  <input type="hidden" name="jquery" value="<?php echo $_GET[jquery];?>">
    <input type="hidden" name="debug" value="1">
  
</form>	