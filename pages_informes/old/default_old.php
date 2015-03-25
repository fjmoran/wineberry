<div class="col-md-11">
 	<h2>Cuadro de Mando</h2>
 	<h5>Esto es un texto de demo.</h5>
 	<div class="row">
	 	<div class="col-md-6">
	 		<h5>Titulo 1<a href="#chart_01_full"><span class="glyphicon glyphicon-resize-full pull-right" style="color: black;" onclick="$('#cuerpo').load('pages_informes/chart_01_full.php');"></span></a></h5>
	 		<div class="graph-report" id="container1">
	 			<?php include "pages_informes/chart_01.php"; ?>	
	 		</div>
	 	</div>
	 	<div class="col-md-6">
	 		<h5>Titulo 2<a href="#chart_02_full"><span class="glyphicon glyphicon-resize-full pull-right" style="color: black;" onclick="$('#cuerpo').load('pages_informes/chart_02_full.php');"></span></a></h5>
	 		<div class="graph-report" id="container2">
	 			<?php include "pages_informes/chart_02.php"; ?>	
	 		</div>
	 	</div>
	 </div>
 	<div class="row">
	 	<div class="col-md-6">
	 		<h5>Titulo 3<a href="#chart_03_full"><span class="glyphicon glyphicon-resize-full pull-right" style="color: black;" onclick="$('#cuerpo').load('pages_informes/chart_03_full.php');"></span></a></h5>
	 		<div class="graph-report" id="container3">
	 			<?php include "pages_informes/chart_03.php"; ?>		
	 		</div>
	 	</div>
	 	<div class="col-md-6">
	 		<h5>Titulo 4<a href="#chart_04_full"><span class="glyphicon glyphicon-resize-full pull-right" style="color: black;" onclick="$('#cuerpo').load('pages_informes/chart_04_full.php');"></span></a></h5>
	 		<div class="graph-report" id="container4">
	 			<?php include "pages_informes/chart_04.php"; ?>			
	 		</div>
	 	</div>
	 </div>	
	 <br> 	
</div><!-- col-md-11 -->