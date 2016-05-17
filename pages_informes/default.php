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
            <h4>Condiciones Ambientales</h4>
        </div>
        <div class="col-md-1"></div>
        <div class="col-md-4">
        <div class="small-box bg-aqua">
            <div class="inner">
                <h3>74%</h3>
                <p>Humedad</p>
            </div>
            <div class="icon">
                <i class="ion ion-waterdrop"></i>
            </div>
            <a href="#" class="small-box-footer" onclick="$('#cuerpo').load('pages_informes/tempamb.php');">Ver más <i class="fa fa-arrow-circle-right"></i></a>
        </div>
        <h6 class="text-center">Fecha última medición: Hace 3 minutos</h6>
        </div>
        <div class="col-md-2"></div>
        <div class="col-md-4">
        <div class="small-box bg-yellow">
            <div class="inner">
                <h3>24ºC</h3>
                <p>Temperatura</p>
            </div>
            <div class="icon">
                <i class="ion ion-thermometer"></i>
            </div>
            <a href="#" class="small-box-footer" onclick="$('#cuerpo').load('pages_informes/tempamb.php');">Ver más <i class="fa fa-arrow-circle-right"></i></a>
        </div>
        <h6 class="text-center">Fecha última medición: Hace 4 minutos</h6>
        </div>
        <div class="col-md-1"></div>
     </div>
 	<div class="row bs-sidenav">
 		<div class="col-md-12">
 			<h4>Temperatura Cubas</h4>
 		</div>
        <div class="col-md-3">
            <div class="info-box bg-green">
                <span class="info-box-icon"><i class="fa fa-check"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text" onclick="$('#cuerpo').load('pages_informes/tempcuba1.php');"><a href="#inf_tempamb"><i class="fa fa-info-circle"></i> Cuba Nº1</a></span>
                    <span class="info-box-number">15ºC</span>
                    <div class="progress">
                        <div class="progress-bar" style="width: 30%"></div>
                    </div>
                    <span class="progress-description">
                        Hace 3 minutos
                    </span>
                </div><!-- /.info-box-content -->
            </div>
        </div>
        <div class="col-md-3">
            <div class="info-box bg-green">
                <span class="info-box-icon"><i class="fa fa-check"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text" onclick="$('#cuerpo').load('pages_informes/tempcuba2.php');"><a href="#inf_tempamb"><i class="fa fa-info-circle"></i> Cuba Nº2</a></span>
                    <span class="info-box-number">20ºC</span>
                    <div class="progress">
                        <div class="progress-bar" style="width: 40%"></div>
                    </div>
                    <span class="progress-description">
                        Hace 3 minutos
                    </span>
                </div><!-- /.info-box-content -->
            </div>
        </div>
        <div class="col-md-3">
            <div class="info-box bg-green">
                <span class="info-box-icon"><i class="fa fa-times"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text"><i class="fa fa-info-circle"></i> Cuba Nº3</span>
                    <span class="info-box-number">N/A</span>
                    <div class="progress">
                        <div class="progress-bar" style="width: 0%"></div>
                    </div>
                    <span class="progress-description">
                        Sin Información
                    </span>
                </div><!-- /.info-box-content -->
            </div>
        </div>
        <div class="col-md-3">
            <div class="info-box bg-green">
                <span class="info-box-icon"><i class="fa fa-times"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text"><i class="fa fa-info-circle"></i> Cuba Nº4</span>
                    <span class="info-box-number">N/A</span>
                    <div class="progress">
                        <div class="progress-bar" style="width: 0%"></div>
                    </div>
                    <span class="progress-description">
                        Sin Información
                    </span>
                </div><!-- /.info-box-content -->
            </div>
        </div>
        <!--
	 	<div class="col-md-6">
	 		<h4 class="text-center" onclick="$('#cuerpo').load('pages_informes/tempcuba1.php');"><a href="#inf_tempamb">Tº cuba #1</a></h4>

			<div class="col-md-12" id="grafico_G1" style="width: 100%; height: 230px; float: left;"></div>
			<h6 class="text-center">Fecha última medición: 5 min. atrás</h6>
	 	</div> 		 
	  	<div class="col-md-6">
	 		<h4 class="text-center" onclick="$('#cuerpo').load('pages_informes/tempcuba2.php');"><a href="#inf_tempamb">Tº cuba #2</a></h4>

			<div class="col-md-12" id="grafico_G2" style="width: 100%; height: 230px; float: left"></div>
			<h6 class="text-center">Fecha última medición: 5 min. atrás</h6>
	 	</div>
	  	<div class="col-md-6">
	 		<h4 class="text-center">Tº cuba #3</h4>

			<div class="col-md-12" id="grafico_G3" style="width: 100%; height: 230px; float: left"></div>
			<h6 class="text-center">Fecha última medición: Sin medición</h6>
	 	</div>
	  	<div class="col-md-6">
	 		<h4 class="text-center">Tº cuba #4</h4>

			<div class="col-md-12" id="grafico_G4" style="width: 100%; height: 230px; float: left"></div>
			<h6 class="text-center">Fecha última medición: Sin medición</h6>
	 	</div>	--> 		 	
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

