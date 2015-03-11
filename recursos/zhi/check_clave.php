<?php
require_once ("auth.php");
require_once ("CreaConnv2.php");

$valid = false;
$message = 'Invalid Password!';


if (isset($_POST['antclave'])) {$_POST['clave'] = $_POST['antclave'];}
  
if( isset($_POST['clave']) ) {
  
  $query_check_password = "select * from Usuario where idUsuario ='".$_SESSION['idUsuario']."' AND claveUsuario=sha1('".$_POST['clave']."')";

  //$userFactory = new UserFactory( DataStorage::instance() );
  //$user = $userFactory->loadUser( $_POST['user'] );
  //$message .= $query_check_password;

  $rs_check = $mysqli->query($query_check_password);

  //$message .= "After execute query".$mysqli->errorno;
  
  if( $rs_check ) {
    //$message .= ' Inside result query ';
      $rs_count = $rs_check->num_rows;
      //$message .= " ".$rs_count;
      $rs_check->close();
      if ($rs_count) {
        $valid = true;
        $message = 'Succesful!';
      }else{
        $valid = false;
        $message = "Wrong Password !";
      }
  } else {
    $valid = false;
    $message .= "Invalid Query Failed!";
  } 
}

$response = array(
  'valid' => $valid,
  'message' => $message
);

echo json_encode($response);
?>