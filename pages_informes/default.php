<?php

//include "auth.php";
include_once "../recursos/zhi/CreaConnv2.php";

?>
<div class="col-md-1"></div>
<div class="col-md-10">
 	<h2>Dashboard</h2>
 	</br>
    <div class="row bs-sidenav">
        <div class="col-md-12">
            <h4>Condiciones Ambientales</h4>
        </div>
        <div class="col-md-1"></div>
        <div class="col-md-4">
        <div class="small-box bg-aqua">
            <div class="inner" id="humedad_ambiente">
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
        <div class="col-md-4" id="TemperaturaAmbiente">
        <div class="small-box bg-yellow">
            <div class="inner" id="Temperatura">
                <h3>Local</h3>
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
            <div class="info-box bg-green" id="CUBA1">
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
            <div class="info-box bg-green" id="CUBA2">
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
            <div class="info-box bg-gray">
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
            <div class="info-box bg-gray">
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
	</div>


</div>
<div class="col-md-1"></div>
<!-- col-md -->
<script type="text/javascript">
var auto_refresh = setInterval(
function ()
{
$('#TemperaturaAmbiente').load('pages_informes/lectura_temp.php?POSICION=AMBIENTE&DEVICE=27').fadeIn("slow");
$('#CUBA1').load('pages_informes/lectura_temp.php?POSICION=CUBA&DEVICE=28-011564b535ff').fadeIn("slow");
$('#CUBA2').load('pages_informes/lectura_temp.php?POSICION=CUBA&DEVICE=28-0115649829ff').fadeIn("slow");
}, 10000);

$(document).ready(function(){
$('#TemperaturaAmbiente').load('pages_informes/lectura_temp.php?POSICION=AMBIENTE&DEVICE=27');
$('#CUBA1').load('pages_informes/lectura_temp.php?POSICION=CUBA&DEVICE=28-011564b535ff');
$('#CUBA2').load('pages_informes/lectura_temp.php?POSICION=CUBA&DEVICE=28-0115649829ff');
});
</script>
