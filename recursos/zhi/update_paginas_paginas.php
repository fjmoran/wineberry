<?php
require_once("auth.php");
require_once("CreaConnv2.php");

/*
echo "_POST : ";
print_r($_POST);
echo "</br>";
*/


$query = "";
$paginas = $_POST['tabla'];
$padre = $_POST['pagina'];
$paginas_en_paginas = array();

$paginas_existentes = "select Pagina_idPagina1 from PaginaenPagina where Pagina_idPagina='".$padre."'";

if($result = $mysqli->query($paginas_existentes)){
	if ($result->num_rows > 0){
		while ($fila = $result->fetch_assoc()){
			array_push($paginas_en_paginas, $fila['Pagina_idPagina1']);
		}
	}
}else{
	printf("Error:%d\n Ha ocurrido un error %s",$mysqli->errno,$mysqli->error);
}

$result->free();

/*
echo "paginas :";
print_r($paginas);
echo "</br> Pagina Padre : $padre - Exito</br>";
*/

//Busco si las paginas que vienen en la web ya estaban ingresada, en caso que no agrego el INSERT correspondiente
foreach ($paginas as $idPagina1){
	if (!(in_array($idPagina1, $paginas_en_paginas))){
		$query .= "INSERT INTO PaginaenPagina VALUES ('','".$padre."','".$idPagina1."');";
	}
}

// Veo si se elimino alguna pagina del listado de paginas existentes
foreach($paginas_en_paginas as $idPagina1){
	if(!(in_array($idPagina1,$paginas))){
		$query .= "DELETE FROM PaginaenPagina WHERE Pagina_idPagina='".$padre."' AND Pagina_idPagina1='".$idPagina1."';";
	}
}
//echo "$query </br>";
if (empty($query)){
	echo "2";
}else{
	if ($mysqli->multi_query($query)) {
	    do {
	        /* store first result set */
	        if ($result = $mysqli->store_result()) {
	            while ($row = $result->fetch_row()) {
	//                printf("%s\n", $row[0]);
	            }
	            $result->free();
	        }
	        /* print divider */
	        if ($mysqli->more_results()) {
	//            printf("-----------------\n");
	        }
	    } while ($mysqli->next_result());
	    echo 1;
	    // echo <h2>Se ha terminado con exito la actualización de la tabla PaginaenPagina.</h2>
	} else {
		echo 0;
	}
}
sleep(0);
?>