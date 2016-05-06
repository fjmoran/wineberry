<?php

//include "auth.php";
include_once "../recursos/zhi/CreaConnv2.php";

?>
<div class="col-md-1"></div>
<div class="col-md-10">
 	<h2>Panel de control</h2>
 	</br>     
    <div class="row bs-sidenav">
        <div class="col-md-12">
            <h4>Condiciones ambientales</h4>
        </div>
        <div class="col-md-1"></div>
        <div class="col-md-4">
            <h5 class="text-center" onclick="$('#cuerpo').load('pages_informes/tempamb.php');"><a href="#inf_tempamb">Humedad</a></h5>
            <a class="btn btn-success btn-lg btn-block" href="#inf_tempamb" role="button" onclick="$('#cuerpo').load('pages_informes/tempamb.php');">74%</a>
            <h6 class="text-center">Fecha última medición: 3 min. atrás</h6>
        </div>
        <div class="col-md-2"></div>
        <div class="col-md-4">
            <h5 class="text-center" onclick="$('#cuerpo').load('pages_informes/tempamb.php');"><a href="#inf_tempamb">Temperatura</a></h5>
            <a class="btn btn-success btn-lg btn-block" href="#inf_tempamb" role="button" onclick="$('#cuerpo').load('pages_informes/tempamb.php');">27ºC</a>
            <h6 class="text-center">Fecha última medición: 4 min. atrás</h6>
        </div>
        <div class="col-md-1"></div>
     </div>
 	<div class="row bs-sidenav">
 		<div class="col-md-12">
 			<h4>Temperatura Cubas</h4>
 		</div>
	 	<div class="col-md-6">
	 		<h5 class="text-center" onclick="$('#cuerpo').load('pages_informes/tempcuba1.php');"><a href="#inf_tempamb">Tº cuba #1</a></h5>

			<div class="col-md-12" id="grafico_G1" style="width: 100%; height: 230px; float: left;"></div>
			<h6 class="text-center">Fecha última medición: 5 min. atrás</h6>
	 	</div> 		 
	  	<div class="col-md-6">
	 		<h5 class="text-center" onclick="$('#cuerpo').load('pages_informes/tempcuba2.php');"><a href="#inf_tempamb">Tº cuba #2</a></h5>

			<div class="col-md-12" id="grafico_G2" style="width: 100%; height: 230px; float: left"></div>
			<h6 class="text-center">Fecha última medición: 5 min. atrás</h6>
	 	</div>
	  	<div class="col-md-6">
	 		<h5 class="text-center">Tº cuba #3</h5>

			<div class="col-md-12" id="grafico_G3" style="width: 100%; height: 230px; float: left"></div>
			<h6 class="text-center">Fecha última medición: Sin medición</h6>
	 	</div>
	  	<div class="col-md-6">
	 		<h5 class="text-center">Tº cuba #4</h5>

			<div class="col-md-12" id="grafico_G4" style="width: 100%; height: 230px; float: left"></div>
			<h6 class="text-center">Fecha última medición: Sin medición</h6>
	 	</div>	 		 	
	</div>


</div>
<div class="col-md-1"></div>
<!-- col-md -->


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
            data: [0],
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
      //temp 4
    $('#grafico_G4').highcharts(Highcharts.merge(gaugeOptions, {
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
            data: [0],
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

    //agregar otra cuba acá

});
</script>

