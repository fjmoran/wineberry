<?php
//ini_set('display_errors', 1);
include "CreaConnv2.php";

$sql = "INSERT INTO switching (Switch_idSwitch,estadoSwitching,fechahoracambioSwitching) values (1,1,now())";

$rs = $data_mysqli->query($sql);
if (!$rs){
  echo "Insert failed: (" . $data_mysqli->errno . ") " . $data_mysqli->error;
} else {
  echo "Insertado Exitosamente";
}

//echo "<br>" . $sql;
?>
