<?php

require "../recursos/zhi/CreaConnv2.php";

$RASPBERRY = "";
$DEVICE = "";

if ((isset($_GET['RASPBERRY'])) && (!empty($_GET['RASPBERRY']))){
	$RASPBERRY = $_GET['RASPBERRY'];
}

if ((isset($_GET['DEVICE'])) && (!empty($_GET['DEVICE']))){
	$DEVICE = $_GET['DEVICE'];
	//echo "DEVICE = $DEVICE";
}

$POSICION = $_GET['POSICION'];

$query = "select DatosHum_perc, TIMESTAMPDIFF(MINUTE,DatosHumDateTime,NOW()) as DIFF FROM DatosHum ";
if (!(empty($DEVICE))) {
	$query .= " WHERE DatosHumDevId = '$DEVICE' ";
}

$query .= " ORDER BY DatosHumDateTime DESC LIMIT 1";

$results = $data_mysqli->query($query);
if ($results) {
	$row = $results->fetch_array(MYSQLI_NUM);
	if ($POSICION=="AMBIENTE"){
		echo "
	        <div class=\"small-box bg-aqua\">
            <div class=\"inner\" id=\"humedad\">
                <h3>$row[0] %</h3>
                <p>Humedad</p>
            </div>
            <div class=\"icon\">
                <i class=\"ion ion-waterdrop\"></i>
            </div>
            <a href=\"#\" class=\"small-box-footer\" onclick=\"$('#cuerpo').load('pages_informes/tempamb.php');\">Ver más <i class=\"fa fa-arrow-circle-right\"></i></a>
        </div>
        <h6 class=\"text-center\">Fecha última medición: Hace $row[1] minutos</h6>
        </div>
		";
	}else if ($POSICION == "CUBA"){
		echo "
                <span class=\"info-box-icon\"><i class=\"fa fa-check\"></i></span>
                <div class=\"info-box-content\">
                    <span class=\"info-box-text\" onclick=\"$('#cuerpo').load('pages_informes/tempcuba1.php');\"><a href=\"#inf_tempamb\"><i class=\"fa fa-info-circle\"></i> Cuba $DEVICE</a></span>
                    <span class=\"info-box-number\">$row[0]ºC</span>
                    <div class=\"progress\">
                        <div class=\"progress-bar\" style=\"width: 30%\"></div>
                    </div>
                    <span class=\"progress-description\">
                        Hace $row[1] minutos
                    </span>
                </div><!-- /.info-box-content -->
";
	}
	
	$results->free();
} else {
	echo " Fail <br>" . $data_mysqli->error;
}
?>