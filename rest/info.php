<?php
$host = "localhost";
$user = "root";
$passwd = "root";
$bd = "data_wineberry";
$port = 8889;

$mysqli = new mysqli($host, $user, $passwd, $bd, $port);
if ($mysqli->connect_errno) {
    echo "Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}

$idSwitch = isset($_GET['idSwitch'])? $mysqli->real_escape_string($_GET['idSwitch']):"";

if (!empty($idSwitch)){
  $query = $mysqli->query("select * from Switching where Switch_idSwitch = '$idSwitch' AND syncSwitching = 0");
  $result = array();
  while ($r = $query->fetch_array()){
    extract($r);
    $result[]= array("idSwitching"=>$idSwitching,"Switch_idSwitch"=>$Switch_idSwitch,"estadoSwitching"=>$estadoSwitching,"fechahoracambioSwitching"=>$fechahoracambioSwitching,"syncSwitching"=>$syncSwitching);
  }
  $json = array("status"=>1,"info"=>$result);
}else{
  $json = array("status"=>0,"msg"=>"ID no presenta cambios IdSwitch = '$idSwitch'");
}
$mysqli->close();

header('Content-type: application/json');
echo json_encode($json);
?>
