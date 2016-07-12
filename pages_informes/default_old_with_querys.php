<?php

//include "auth.php";
include_once "../recursos/zhi/CreaConnv2.php";

$sql = "select infoData, convert_tz(timeData,'+00:00','-03:00') as timeData from Data where Device_idDevice='1' order by timeData desc limit 1";

if($result = $data_mysqli->query($sql))
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

			<div class="col-md-12" id="grafico_G1" style="width: 300px; height: 200px; float: left"></div>

	 		<h6 class="text-center">Fecha última medición:
	 			<?php
	 			echo $data[timeData];
	 			?></h6>
	 	</div>
<?php
$sql = "select infoData, convert_tz(timeData,'+00:00','-03:00') as timeData from Data where Device_idDevice='4' order by timeData desc limit 1";

if($result = $data_mysqli->query($sql))
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
	 		<h5 class="text-center">Tº ambiental sobre cuba 2</h5>

			<div class="col-md-12" id="grafico_G2" style="width: 300px; height: 200px; float: left"></div>

	 		<h6 class="text-center">Fecha última medición:
	 			<?php
	 			echo $data[timeData];
	 			?></h6>
	 	</div>

<?php
$sql = "select infoData, convert_tz(timeData,'+00:00','-03:00') as timeData from Data where Device_idDevice='6' order by timeData desc limit 1";

if($result = $data_mysqli->query($sql))
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
	 		<h5 class="text-center">Tº ambiental sobre cuba 3</h5>

			<div class="col-md-12" id="grafico_G3" style="width: 300px; height: 200px; float: left"></div>

	 		<h6 class="text-center">Fecha última medición:
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

if($result = $data_mysqli->query($sql))
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
			      <input type="checkbox" name="rf-switch-1"> &nbsp Válvula de refrigeración
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

if($result = $data_mysqli->query($sql))
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

if($result = $data_mysqli->query($sql))
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

if($result = $data_mysqli->query($sql))
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


<script type="text/javascript">
$(function () {

    var gaugeOptions = {

        chart: {
            type: 'solidgauge'
        },

        title: null,

        pane: {
            center: ['50%', '85%'],
            size: '140%',
            startAngle: -90,
            endAngle: 90,
            background: {
                backgroundColor: (Highcharts.theme && Highcharts.theme.background2) || '#EEE',
                innerRadius: '60%',
                outerRadius: '100%',
                shape: 'arc'
            }
        },

        tooltip: {
            enabled: false
        },

        // the value axis
        yAxis: {
            stops: [
                [0.1, '#55BF3B'], // green
                [0.5, '#DDDF0D'], // yellow
                [0.9, '#DF5353'] // red
            ],
            lineWidth: 0,
            minorTickInterval: null,
            tickPixelInterval: 400,
            tickWidth: 0,
            title: {
                y: -70
            },
            labels: {
                y: 16
            }
        },

        plotOptions: {
            solidgauge: {
                dataLabels: {
                    y: 5,
                    borderWidth: 0,
                    useHTML: true
                }
            }
        }
    };

    //temp 1
    $('#grafico_G1').highcharts(Highcharts.merge(gaugeOptions, {
        yAxis: {
            min: 0,
            max: 50,
            title: {
                text: ''
            }
        },

		exporting: { enabled: false
		},
        credits: {
            enabled: false
        },

        series: [{
            name: 'Temp',
            data: [19],
            dataLabels: {
                format: '<div style="text-align:center"><span style="font-size:25px;color:' +
                    ((Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black') + '">{y}ºC</span><br/>' +
                       '<span style="font-size:12px;color:silver"></span></div>'
            },
            tooltip: {
                valueSuffix: ' ºC'
            }
        }]

    }));

    //temp 2
    $('#grafico_G2').highcharts(Highcharts.merge(gaugeOptions, {
        yAxis: {
            min: 0,
            max: 50,
            title: {
                text: ''
            }
        },

		exporting: { enabled: false
		},
        credits: {
            enabled: false
        },

        series: [{
            name: 'Temp',
            data: [13],
            dataLabels: {
                format: '<div style="text-align:center"><span style="font-size:25px;color:' +
                    ((Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black') + '">{y}ºC</span><br/>' +
                       '<span style="font-size:12px;color:silver"></span></div>'
            },
            tooltip: {
                valueSuffix: ' ºC'
            }
        }]

    }));
    //temp 3
    $('#grafico_G3').highcharts(Highcharts.merge(gaugeOptions, {
        yAxis: {
            min: 0,
            max: 50,
            title: {
                text: ''
            }
        },

		exporting: { enabled: false
		},
        credits: {
            enabled: false
        },

        series: [{
            name: 'Temp',
            data: [38],
            dataLabels: {
                format: '<div style="text-align:center"><span style="font-size:25px;color:' +
                    ((Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black') + '">{y}ºC</span><br/>' +
                       '<span style="font-size:12px;color:silver"></span></div>'
            },
            tooltip: {
                valueSuffix: ' ºC'
            }
        }]

    }));

    //agregar otra acá

});
</script>
