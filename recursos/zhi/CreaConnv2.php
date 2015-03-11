<?php

$ini_array = parse_ini_file("config.ini");

$user = $ini_array['user'];
$passwd = $ini_array['password'];
$host = $ini_array['host'];
$bd = $db = $ini_array['schema'];

$mysqli = new mysqli($host, $user, $passwd, $bd);
if ($mysqli->connect_errno) {
    echo "Fallo al contenctar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}

$mysqli = new mysqli($host, $user, $passwd, $bd, $ini_array['port']);
if ($mysqli->connect_errno) {
    echo "Fallo al contenctar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}

?>