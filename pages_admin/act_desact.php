<?php
require_once("../recursos/zhi/auth.php");
require_once("../recursos/zhi/CreaConnv2.php");
require_once("../recursos/zhi/funciones.php");

$pos = 0;
$tabla = "";
$id = "";
$nombre = "";

if (isset($_GET['debug'])) { echo "Activación y Desactivación </br>";}

$pos = strpos($_GET['table'],".") + 1;
$tabla = substr($_GET['table'],$pos);
$id = "id".$tabla;

$select_nombre = "select nombre".$tabla." from ".$tabla." where ".$id." = '".$_GET[$id]."'";
if($rs_nombre = comando_mysql($select_nombre,$mysqli)){
  $fila = $rs_nombre->fetch_array();
  $nombre = $fila[0];
  $rs_nombre->free();
}
?>
<div class="modal-header">
 <!--  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> -->
  <h4 class="modal-title" id="myModalLabel">
  <?php
  	if ($_GET['activar'] == 0) {
    	echo "Activaci&oacute;n";
  	}else {
    	echo "Desactivaci&oacute;n";
  	}
  ?>
  </h4>
</div>
<form role="form" method="post" target="IframeOutput" action="recursos/zhi/activar.php">
  <div class="modal-body">
    <div class="row"> 
      <div class="col-md-12">

        Esta seguro que desea <?php if ($_GET['activar'] == 0) { echo "activar"; } else { echo "desactivar";} ?> el registro con nombre <b>'<?php echo $nombre."'</b>?"; //$id." ".$_GET[$id];
        //echo $_GET['callerURL'];
        ?>
       
      </div>  
    </div>   
  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal" aria-hidden="true">Cancelar</button>
    <button type="submit" class="btn 
    <?php 
    if ($_GET['activar'] == 0) {
    	echo "btn-success";
    }else{
      echo "btn-danger"; 
    }
    ?>
    ">
    <?php
    if ($_GET['activar']==0){
      echo "Activar";
    }else{
      echo "Desactivar";
    }
    ?>
    </button> <!-- class="btn btn-success" -->
  </div>
  <input type="hidden" name="<?php echo $id; ?>" value="<?php echo $_GET[$id]; ?>">
  <input type="hidden" name="table" value="<?php echo $_GET['table']; ?>">
  <input type="hidden" name="activo<?php echo $tabla; ?>" value="<?php echo $_GET['activar']?0:1; ?>">
  <input type="hidden" name="callerURL" value="<?php echo $_GET['callerURL']; ?>">
  <input type="hidden" name="debug" value="1"> <!-- Borrar antes de paso a producción -->
</form>
