<?php

$ini_array = parse_ini_file("config.ini");

$user = $ini_array['user'];
$passwd = $ini_array['password'];
$host = $ini_array['host'];
$bd = $db = $ini_array['schema'];
$data_db = $data_bd = $ini_array['data'];

$mysqli = new mysqli($host, $user, $passwd, $bd);
if ($mysqli->connect_errno) {
    echo "Fallo al contenctar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}

$mysqli = new mysqli($host, $user, $passwd, $bd, $ini_array['port']);
if ($mysqli->connect_errno) {
    echo "Fallo al contenctar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}

$data_mysqli == new mysqli($host, $user, $passwd, $data_db);
if ($data_mysqli->connect_errno) {
    echo "Fallo al contenctar a MySQL: (" . $data_mysqli->connect_errno . ") " . $data_mysqli->connect_error;
}

$data_mysqli = new mysqli($host, $user, $passwd, $data_bd, $ini_array['port']);
if ($data_mysqli->connect_errno) {
    echo "Fallo al contenctar a MySQL: (" . $data_mysqli->connect_errno . ") " . $data_mysqli->connect_error;
}

?>
