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
    $json[]=array("status"=>0,"info"=>"Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error);
}

$idSwitching = isset($_GET['idSwitching'])? $mysqli->real_escape_string($_GET['idSwitching']):"";
if (!empty($idSwitching)){
  $query = "update Switching set syncSwitching=2 where idSwitching=$idSwitching";
  if($mysqli->query($query)){
    if(!($mysqli->affected_rows)){
      $json[]=array("status"=>0,"info"=>"No se encontro $idSwitching");
    }else{
      $json[]=array("status"=>1,"info"=>"Insert Exitoso");
    }
  }else{
    $json[]=array("status"=>0,"info"=>"Error al Insertar".$mysqli->error);
  }
}else{
  $json[]=array("status"=>0,"info"=>"falta informacion");
}

echo json_encode($json);
?>
