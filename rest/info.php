<?php
$ini_array = parse_ini_file("../recursos/zhi/config.ini");

$user = $ini_array['user'];
$passwd = $ini_array['password'];
$host = $ini_array['host'];
$bd = $db = $ini_array['schema'];
$data_db = $data_bd = $ini_array['data'];
$port = $ini_array['port'];

$mysqli = new mysqli($host, $user, $passwd, $data_db, $port);
if ($mysqli->connect_errno) {
    echo "Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}

$idSwitch = isset($_GET['idSwitch'])? $mysqli->real_escape_string($_GET['idSwitch']):"";

if (!empty($idSwitch)){
  $query = $mysqli->query("select * from Switching where Switch_idSwitch = '$idSwitch' AND (syncSwitching = 0 OR syncSwitching = 1)");
  $result = array();
  while ($r = $query->fetch_array()){
    extract($r);
    $result[]= array("idSwitching"=>intval($idSwitching),"Switch_idSwitch"=>intval($Switch_idSwitch),"estadoSwitching"=>boolval($estadoSwitching),"fechahoracambioSwitching"=>$fechahoracambioSwitching,"syncSwitching"=>intval($syncSwitching));
  }
  $json = array("status"=>1,"info"=>$result);
  $query = $mysqli->query("update Switching set syncSwitching=1 where Switch_idSwitch ='$idSwitch' AND syncSwitching = 0");
}else{
  $json = array("status"=>0,"msg"=>"ID no presenta cambios IdSwitch = '$idSwitch'");
}
$mysqli->close();

header('Content-type: application/json');
echo json_encode($json);
?>
