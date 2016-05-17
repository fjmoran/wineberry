<?php

include_once "../recursos/zhi/CreaConnv2.php";

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
                pointInterval: 3600000, // one hour
                pointStart: Date.UTC(2015, 4, 31, 0, 0, 0)
            }
        },
        series: [{
            name: 'tº',
            color: '#00FF00',
            data: [7.2, 7.8, 7.8, 7.8, 7, 6.3, 6.5, 7.9, 6.9, 7.6, 6.6, 8, 9, 8.6, 9.5, 9.2, 9.5, 9.5, 9, 8.1, 7.7, 9, 7.7, 7.3, 7.3, 9.1, 12.7, 12.1, 10.6, 11.1, 10.8, 13.6, 12.2, 14, 15.9, 16.5, 16.6, 16.1, 18, 25.3, 15.7, 14.4, 14.8, 14.6, 14.8, 14.5, 13.5, 12.4, 12.6]

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
                pointInterval: 3600000, // one hour
                pointStart: Date.UTC(2015, 4, 31, 0, 0, 0)
            }
        },
        series: [{
            name: '%',
            data: [7.2, 7.8, 7.8, 7.8, 7, 6.3, 6.5, 7.9, 6.9, 7.6, 6.6, 8, 9, 8.6, 9.5, 9.2, 9.5, 9.5, 9, 8.1, 7.7, 9, 7.7, 7.3, 7.3, 9.1, 12.7, 12.1, 10.6, 11.1, 10.8, 13.6, 12.2, 14, 15.9, 16.5, 16.6, 16.1, 18, 25.3, 15.7, 14.4, 14.8, 14.6, 14.8, 14.5, 13.5, 12.4, 12.6]

        }],
        navigation: {
            menuItemStyle: {
                fontSize: '10px'
            }
        }
    });
});

</script>