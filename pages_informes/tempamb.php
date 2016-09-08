<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once "../recursos/zhi/CreaConnv2.php";

$query = "select DatosTemp_c, UNIX_TIMESTAMP(DatosDateTime) as fecha from Datos  WHERE DatosDateTime >= DATE_SUB(NOW(), INTERVAL 1 HOUR) ORDER BY DatosDateTime ASC";
$results = $data_mysqli->query($query);
if ($results) {
	$serie = "[";
	$categoria = "[";
	$contador = 0;

	while ($row = $results->fetch_array(MYSQLI_NUM)){
		if ($row[0] < 125){
			/*$timestamp = $row[1];
			$splitTimeStamp = explode(" ",$timestamp);
			list($año,$mes,$dia) = explode("-",$splitTimeStamp[0]);
			list($hora,$minuto,$segundo) = explode(":",$splitTimeStamp[1]);
			$mes = intval($mes) - 1;
			$hora = intval($hora);
			$minuto = intval($minuto);
			$segundo = intval($segundo); */
			$serie .="[$row[1],$row[0]],";
			$categoria .= "$row[0],";
		}
	}
	$serie = substr($serie,0,-1)."]";
	$categoria = substr($categoria,0,-1)."]";
	$results->free();
}

?>

<div class="col-md-1"></div>
<div class="col-md-10">
	<h2>Sensores ambientales</h2>
	<div class="graph-report" id="grafico_temp">
	</div> </br>
    <div class="graph-report" id="grafico_hum">
    </div> </br>
<div class="col-md-1"></div>
</div><!-- col-md -->

<script type="text/javascript">
$(function () {
    $('#grafico_temp').highcharts({
        credits: {
            enabled: false
        },
        exporting: {
            enabled: false
        },
        chart: {
            type: 'spline'
        },
        title: {
            text: 'Temperatura ambiental'
        },
        subtitle: {
            text: ''
        },
        xAxis: {
            type: 'datetime',
            labels: {
                overflow: 'justify'
            }
        },
        yAxis: {
            title: {
                text: 'Temperatura (ºC)'
            },
            minorGridLineWidth: 0,
            gridLineWidth: 1,
            alternateGridColor: null
        },
        tooltip: {
            valueSuffix: ' ºC'
        },
        plotOptions: {
            spline: {
                lineWidth: 4,
                states: {
                    hover: {
                        lineWidth: 5
                    }
                },
                marker: {
                    enabled: false
                },
              //  pointInterval: 3600000, 
              //  pointStart: Date.UTC(2015, 4, 31, 0, 0, 0)
            }
        },
        series: [{
            name: 'tº',
            color: '#00FF00',
            data: [
                [Date.UTC(1970, 9, 21), 0],
                [Date.UTC(1970, 10, 4), 0.28],
                [Date.UTC(1970, 10, 9), 0.25],
                [Date.UTC(1970, 10, 27), 0.2],
                [Date.UTC(1970, 11, 2), 0.28],
                [Date.UTC(1970, 11, 26), 0.28],
                [Date.UTC(1970, 11, 29), 0.47],
                [Date.UTC(1971, 0, 11), 0.79],
                [Date.UTC(1971, 0, 26), 0.72],
                [Date.UTC(1971, 1, 3), 1.02],
                [Date.UTC(1971, 1, 11), 1.12],
                [Date.UTC(1971, 1, 25), 1.2],
                [Date.UTC(1971, 2, 11), 1.18],
                [Date.UTC(1971, 3, 11), 1.19],
                [Date.UTC(1971, 4, 1), 1.85],
                [Date.UTC(1971, 4, 5), 2.22],
                [Date.UTC(1971, 4, 19), 1.15],
                [Date.UTC(1971, 5, 3), 0]
            ]

        }],
        navigation: {
            menuItemStyle: {
                fontSize: '10px'
            }
        }
    });
});

$(function () {
    $('#grafico_hum').highcharts({
        credits: {
            enabled: false
        },
        exporting: {
            enabled: false
        },
        chart: {
            type: 'spline'
        },
        title: {
            text: 'Humedad ambiental'
        },
        subtitle: {
            text: ''
        },
        xAxis: {
            type: 'datetime',
            labels: {
                overflow: 'justify'
            }
        },
        yAxis: {
            title: {
                text: 'Humedad (%)'
            },
            minorGridLineWidth: 0,
            gridLineWidth: 1,
            alternateGridColor: null
        },
        tooltip: {
            valueSuffix: ' %'
        },
        plotOptions: {
            spline: {
                lineWidth: 4,
                states: {
                    hover: {
                        lineWidth: 5
                    }
                },
                marker: {
                    enabled: false
                },
              //  pointInterval: 3600000,
              //  pointStart: Date.UTC(2015, 4, 31, 0, 0, 0)
            }
        },
        series: [{
            name: '%',
            data: [
                [Date.UTC(1970, 9, 21), 0],
                [Date.UTC(1970, 10, 4), 0.28],
                [Date.UTC(1970, 10, 9), 0.25],
                [Date.UTC(1970, 10, 27), 0.2],
                [Date.UTC(1970, 11, 2), 0.28],
                [Date.UTC(1970, 11, 26), 0.28],
                [Date.UTC(1970, 11, 29), 0.47],
                [Date.UTC(1971, 0, 11), 0.79],
                [Date.UTC(1971, 0, 26), 0.72],
                [Date.UTC(1971, 1, 3), 1.02],
                [Date.UTC(1971, 1, 11), 1.12],
                [Date.UTC(1971, 1, 25), 1.2],
                [Date.UTC(1971, 2, 11), 1.18],
                [Date.UTC(1971, 3, 11), 1.19],
                [Date.UTC(1971, 4, 1), 1.85],
                [Date.UTC(1971, 4, 5), 2.22],
                [Date.UTC(1971, 4, 19), 1.15],
                [Date.UTC(1971, 5, 3), 0]
            ]

        }],
        navigation: {
            menuItemStyle: {
                fontSize: '10px'
            }
        }
    });
});

</script>
