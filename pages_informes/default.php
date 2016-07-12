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
