<?php

//include "auth.php";
include_once "../recursos/zhi/CreaConnv2.php";

$sql = "select infoData, timeData from Data where Device_idDevice='1' order by timeData desc limit 1";

if($result = $mysqli->query($sql))
{
	if ($debug)
	{
		echo "despues de query";
		echo "</br>";
	}
	$data = $result->fetch_array(MYSQLI_ASSOC);
	$result->free();
}

?>


<div class="col-md-11">
 	<h2>Panel de temperaturas actuales</h2>
 	</br>
 	<div class="row bs-sidenav">
 		<div class="col-md-12">
 			<h4>Temperatura ambiental</h4>
 		</div>
	 	<div class="col-md-4">
	 		<h5 class="text-center">Sensor 001 - Galpón norte</h5>
	 		<button type="button" class="btn btn-info btn-lg btn-block">
	 			<?php 
	 			echo $data[infoData];
	 			?>ºC</button>
	 		<h6>Fecha última medición:
	 			<?php
	 			echo $data[timeData];
	 			?></h6>
	 	</div>
	 	<div class="col-md-4">
	 		<h5 class="text-center">Sensor 002 - Galpón sur</h5>
	 		<button type="button" class="btn btn-info btn-lg btn-block">25ºC</button>
	 		<h6>Fecha última medición: 25-03-2015 - 15:03:45</h6>
	 	</div>
	 	<div class="col-md-4">
	 		<h5 class="text-center">Sensor 003 - Exterior</h5>
	 		<button type="button" class="btn btn-info btn-lg btn-block">29ºC</button>
	 		<h6>Fecha última medición: 25-03-2015 - 15:03:45</h6>	 		
	 	</div>	 	
	</div>
	
 	<div class="row bs-sidenav">
 		<div class="col-md-12">
 			<h4>Temperatura cubas</h4>
 		</div>
	 	<div class="col-md-4">
	 		<h5 class="text-center">Sensor 003 - Cuba 1 - 15.000 lts</h5>
	 		<button type="button" class="btn btn-success btn-lg btn-block">12ºC</button>
	 		<h6>Fecha última medición: 25-03-2015 - 15:03:45</h6>	 		
	 	</div>
	 	<div class="col-md-4">
	 		<h5 class="text-center">Sensor 004 - Cuba 2 - 30.000 lts</h5>
	 		<button type="button" class="btn btn-success btn-lg btn-block">10ºC</button>
	 		<h6>Fecha última medición: 25-03-2015 - 15:03:45</h6>	 		
	 	</div>
	 	<div class="col-md-4">
	 		<h5 class="text-center">Sensor 005 - Cuba 3 - 20.000 lts</h5>
	 		<button type="button" class="btn btn-success btn-lg btn-block">11ºC</button>
	 		<h6>Fecha última medición: 25-03-2015 - 15:03:45</h6>	 		
	 	</div>	 	
	 </div>
	 <br> 	
</div><!-- col-md-11 -->