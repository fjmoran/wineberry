<?php
/*
//include "auth.php"
*/
include_once "../recursos/zhi/CreaConnv2.php";

$sql = "select infoData, convert_tz(timeData,'+00:00','-03:00') as timeData from Data where Device_idDevice='1' and timeData > DATE_SUB(now(), INTERVAL 1 DAY) order by timeData ASC";
$contador_serie1 = 0;

//echo "$sql <br>";

if ($result = $mysqli->query($sql))
{
	while ($row = $result->fetch_assoc()) 
	{
		$data_serie1[$contador_serie1++]=$row;
	}
	$result->free();
}

$sql = "select infoData, convert_tz(timeData,'+00:00','-03:00') as timeData from Data where Device_idDevice='2' and timeData > DATE_SUB(now(), INTERVAL 1 DAY) order by timeData ASC";
$contador_serie2 = 0;
if ($result = $mysqli->query($sql))
{
	while ($row = $result->fetch_assoc()) 
	{
		$data_serie2[$contador_serie2++]=$row;
	}
	$result->free();
}


//print_r($data[0]);

$inicio_date_serie1 = preg_split("/[\s,]+/",$data_serie1[0][timeData]);
$inicio_date_serie2 = preg_split("/[\s,]+/",$data_serie2[0][timeData]);
//print_r($inicio_date);
?>


<div class="col-md-11">
	<h2>Sensores de temperatura ambiental</h2>
	<div class="graph-report" id="grafico">
	</div>	
</div><!-- col-md-11 -->


<script type="text/javascript">
$(function () {
    $('#grafico').highcharts({
    	credits: {
      		enabled: false
  		},
        chart: {
            zoomType: 'x'
        },
        title: {
            text: 'Temperatura en Zona #1'
        },
        subtitle: {
            text: document.ontouchstart === undefined ?
                    'Haga click y arrastre para hacer zoom' :
                    'Piche para hacer zoom'
        },
        xAxis: {
            type: 'datetime',
            minRange: 1 * 24 * 3600000 // un dia
        },
        yAxis: {
            title: {
                text: 'Temperatura Cº'
            }
        },
        legend: {
            enabled: true
        },
        plotOptions: {
            area: {
                fillColor: {
                    linearGradient: { x1: 0, y1: 0, x2: 0, y2: 1},
                    stops: [
                        [0, Highcharts.getOptions().colors[0]],
                        [1, Highcharts.Color(Highcharts.getOptions().colors[0]).setOpacity(0).get('rgba')]
                    ]
                },
                marker: {
                    radius: 2
                },
                lineWidth: 1,
                states: {
                    hover: {
                        lineWidth: 1
                    }
                },
                threshold: null
            }
        },

        series: [{
            type: 'line',
            name: 'Sensor 1 - Temperatura en Cº',
            pointInterval: 1 * 300 * 1000, //intervalos de 5 min (300000 milliseundos)
<?php

//print_r($inicio_date);
$fecha_inicio = preg_split("/-/",$inicio_date_serie1[0]);
$hora_inicio = preg_split("/:/",$inicio_date_serie1[1]);
//print_r($fecha_inicio);
?>            
            pointStart: Date.UTC(
<?php 
echo intval($fecha_inicio[0]) . ",";
echo intval($fecha_inicio[1])-1 . ",";
echo intval($fecha_inicio[2]) . ",";
echo intval($hora_inicio[0]) . ",";
echo intval($hora_inicio[1]) . ",";
echo intval($hora_inicio[2]);
?>
),  // año , mes (enero = 0) , dia
            data: [
<?php
$j=0;
while ($j<=$contador_serie1)
{
	echo $data[$j++][infoData] . ",";
}
?>
            ]
        },
        {
        	type :'line', name:'Sensor 2 - Temperatura en Cº', pointInterval : 1*300*1000,
        	pointStart : Date.UTC(
<?php
$fecha_inicio = preg_split("/-/",$inicio_date_serie2[0]);
$hora_inicio = preg_split("/:/",$inicio_date_serie2[1]); 
echo intval($fecha_inicio[0]) . ",";
echo intval($fecha_inicio[1])-1 . ",";
echo intval($fecha_inicio[2]) . ",";
echo intval($hora_inicio[0]) . ",";
echo intval($hora_inicio[1]) . ",";
echo intval($hora_inicio[2]);
?>
), data :[
<?php
$j=0;
while ($j<=$contador_serie2)
{
	echo $data[$j++][infoData] . ",";
}
?>

]
        ]}
    });
});
		</script>