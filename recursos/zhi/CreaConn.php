<?php

$user = "root";
$passwd = "root";
$host = "localhost";

//import_request_variables("Pg");
$connection = mysql_connect($host,$user,$passwd)
or die ("No me pude conectar con MYSQL --> " . mysql_error($conn));
mysql_select_db("SCH2",$connection) or die ("No puedo seleccionar BD");

?>