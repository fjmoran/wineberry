<?php

//include "auth.php";
include_once "../recursos/zhi/CreaConnv2.php";

$sql = "select infoData, convert_tz(timeData,'+00:00','-03:00') as timeData from Data where Device_idDevice='1' order by timeData desc limit 1";

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
	 		<h5 class="text-center">Tº ambiental sobre cuba 1</h5>
	 		<button type="button" class="btn btn-info btn-lg btn-block">
	 			<?php 
	 			echo $data[infoData];
	 			?>ºC</button>
	 		<h6>Fecha última medición:
	 			<?php
	 			echo $data[timeData];
	 			?></h6>
	 	</div>
<?php
$sql = "select infoData, convert_tz(timeData,'+00:00','-03:00') as timeData from Data where Device_idDevice='4' order by timeData desc limit 1";

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
	 	<div class="col-md-4">
	 		<h5 class="text-center">Tº ambiental sobre cuba 2 (a)</h5>
	 		<button type="button" class="btn btn-info btn-lg btn-block">
	 			<?php 
	 			echo $data[infoData]; 
	 			?>ºC</button>
	 		<h6>Fecha última medición: 
	 			<?php 
	 			echo $data[timeData]; 
	 			?></h6>
	 	</div>

<?php
$sql = "select infoData, convert_tz(timeData,'+00:00','-03:00') as timeData from Data where Device_idDevice='6' order by timeData desc limit 1";

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
	 	<div class="col-md-4">
	 		<h5 class="text-center">Tº ambiental sobre cuba 2 (b)</h5>
	 		<button type="button" class="btn btn-info btn-lg btn-block">
	 			<?php 
	 			echo $data[infoData]; 
	 			?>ºC</button>
	 		<h6>Fecha última medición: 
	 			<?php 
	 			echo $data[timeData]; 
	 			?></h6>	 		
	 	</div>	 	
	</div>
	
 	<div class="row bs-sidenav">
 		<div class="col-md-12">
 			<h4>Temperatura cubas</h4>
 		</div>

<?php
$sql = "select infoData, convert_tz(timeData,'+00:00','-03:00') as timeData from Data where Device_idDevice='2' order by timeData desc limit 1";

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
	 	<div class="col-md-4">
	 		<h5 class="text-center">Cuba 1 - 40.000 lts</h5>
	 		<button type="button" class="btn btn-success btn-lg btn-block">
	 			<?php 
	 			echo $data[infoData]; 
	 			?>ºC</button>
	 		<h6>Fecha última medición: 
	 			<?php 
	 			echo $data[timeData]; 
	 			?></h6>	
	 			</br>	
			    <label>
			      <input type="checkbox" name="rf-switch"> Refrigeración
			    </label>
	 	</div>
	 	<div class="col-md-4">
 		 
	 	</div>
	 	<div class="col-md-4">
 		
	 	</div>	 	
	 </div>

 	<div class="row bs-sidenav">
 		<div class="col-md-12">
 			<h4>Humedad</h4>
 		</div>

<?php
$sql = "select infoData, convert_tz(timeData,'+00:00','-03:00') as timeData from Data where Device_idDevice='3' order by timeData desc limit 1";

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
	 	<div class="col-md-4">
	 		<h5 class="text-center">Humedad 1</h5>
	 		<button type="button" class="btn btn-success btn-lg btn-block">
	 			<?php 
	 			echo $data[infoData]; 
	 			?>%</button>
	 		<h6>Fecha última medición: 
	 			<?php 
	 			echo $data[timeData]; 
	 			?></h6>	 		
	 	</div>

<?php
$sql = "select infoData, convert_tz(timeData,'+00:00','-03:00') as timeData from Data where Device_idDevice='5' order by timeData desc limit 1";

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

	 	<div class="col-md-4">
	 		<h5 class="text-center">Humedad 2</h5>
	 		<button type="button" class="btn btn-success btn-lg btn-block">
	 			<?php 
	 			echo $data[infoData]; 
	 			?>%</button>
	 		<h6>Fecha última medición: 
	 			<?php 
	 			echo $data[timeData]; 
	 			?></h6>	 		
	 	</div>

<?php
$sql = "select infoData, convert_tz(timeData,'+00:00','-03:00') as timeData from Data where Device_idDevice='7' order by timeData desc limit 1";

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

	 	<div class="col-md-4">
	 		<h5 class="text-center">Humedad 3</h5>
	 		<button type="button" class="btn btn-success btn-lg btn-block">
	 			<?php 
	 			echo $data[infoData]; 
	 			?>%</button>
	 		<h6>Fecha última medición: 
	 			<?php 
	 			echo $data[timeData]; 
	 			?></h6>	 		
	 	</div> 	
	 </div>



	 <br> 	
</div><!-- col-md-11 -->