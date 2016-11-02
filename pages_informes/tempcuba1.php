<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once "../recursos/zhi/CreaConnv2.php";
?>
<div class="col-md-1"></div>
<div class="col-md-10">
	<h2>Gráfico temperatura en cuba #1</h2>
        <div class="row">
            <div class="col-md-8">

            </div>
            <div class="col-md-4">
                <a class="btn btn-default btn-select">
                    <input type="hidden" class="btn-select-input" id="" name="" value="" />
                    <span class="btn-select-value">Seleccione un item</span>
                    <span class='btn-select-arrow glyphicon glyphicon-chevron-down'></span>
                    <ul>
                        <li class="selected">Cuba 1</li>
                        <li>Cuba 2</li>
                        <li>Cuba 3</li>
                        <li>Cuba 4</li>
                    </ul>
                </a>
            </div>
        </div>
	<div class="graph-report" id="grafico_cuba">
	</div>
<div class="col-md-1"></div> </br>
<div class="col-md-12">
    <div class="row bs-sidenav">
        <div class="col-md-4">
            <div class="info-box">
                <span class="info-box-icon bg-aqua"><i class="fa fa-minus"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Control de frio</span>
                    <span class="info-box-number"></span></br></span>
                    <label>
                        <input type="checkbox" name="rf-switch-frio" id="rf-switch-frio" class="boton_x">
                    </label>
                </div><!-- /.info-box-content -->
            </div>
        </div>
        <div class="col-md-4" >
             <div class="info-box">
                <span class="info-box-icon bg-red"><i class="fa fa-plus"></i></span>
                <div class="info-box-content" id="switch-calor">
                    <span class="info-box-text">Control de calor</span>
                    <span class="info-box-number"></span></br></span>
                    <label>
                        <input type="checkbox" name="rf-switch-calor" id="rf-switch-calor" class="boton_x">
                    </label>
                </div><!-- /.info-box-content -->
            </div>
        </div>
        <div class="col-md-4">
            <h4>Parámetros:</h4>
            <form>
              <div class="form-group">
                <label for="obj_temp">Temperatura objetivo (Cº)</label>
                <input type="text" class="form-control" id="obj_temp" placeholder="" value="15" disabled>
              </div>
              <div class="form-group">
                <label for="tolerancia_temp">Tolerancia (Cº)</label>
                <input type="text" class="form-control" id="tolerancia_temp" placeholder="" value="5" disabled>
              </div>
              <button type="button" class="btn btn-primary pull-right"  data-toggle="modal" data-target="#editarTemp">Editar</button>
            </form>
        </div>
    </div>
</div>
</div><!-- col-md -->
<!-- Modal -->
<div class="modal fade" id="editarTemp" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Editar temperatura objetivo de la cuba</h4>
      </div>
      <div class="modal-body">
            <form>
              <div class="form-group">
                <label for="obj_temp_edit">Temperatura objetivo (Cº)</label>
                <input type="text" class="form-control" id="obj_temp_edit" placeholder="" value="15">
              </div>
              <div class="form-group">
                <label for="tolerancia_temp_edit">Tolerancia (Cº)</label>
                <input type="text" class="form-control" id="tolerancia_temp_edit" placeholder="" value="5">
              </div>
            </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary">Guardar</button>
      </div>
    </div>
  </div>
</div>
<!-- Fin Modal -->



<script type="text/javascript">
$(function () {
    $('#grafico_cuba').highcharts({
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
            text: ''
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
            gridLineWidth: 0,
            alternateGridColor: null,
            plotBands: [{
                from: 0.0,
                to: 10,
                color: 'rgba(68, 170, 213, 0.1)',
                label: {
                    text: 'Banda Inferior',
                    style: {
                        color: '#606060'
                    }
                }
            }, { // Light breeze
                from: 10.1,
                to: 20,
                color: 'rgba(0, 0, 0, 0)',
                label: {
                    text: 'Normal',
                    style: {
                        color: '#606060'
                    }
                }
            }, { // Gentle breeze
                from: 20.1,
                to: 80,
                color: 'rgba(255, 17, 17, 0.1)',
                label: {
                    text: 'Banda Superior',
                    style: {
                        color: '#606060'
                    }
                }
            }]
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
              //  pointInterval: 3600000, // one hour
              //  pointStart: Date.UTC(2015, 4, 31, 0, 0, 0)
            }
        },
        series: [{
            name: 'tº Interna',
            data: [
<?php 
            
$query = "SELECT concat_ws(',',date_format(DatosDateTime,'[Date.UTC(%Y,%m,%e,%I,%i)'), CONCAT(FORMAT(AVG(DatosTemp_c),2),']'))
FROM Data_WineBerry.Datos 
WHERE DatosDateTime > (select max(DatosDateTime) from Data_WineBerry.Datos) - interval 1 hour
GROUP BY unix_timestamp(DatosDateTime) DIV 60";

$results = $data_mysqli->query($query);
$serie = "";

if ($results) {
	$contador = $results->num_rows;
	while ($row = $results->fetch_row()){	
		if ($contador != 1)
		echo $row[0].",";
		else 
		echo $row[0];
		$contador --;
	}
	$serie = substr($serie,0,-1)."";
	$results->free();
}

echo $serie;
?>
            ]

        }, {
            name: 'tº Externa',
            data: [
<?php 
            
$query = "SELECT concat_ws(',',date_format(DatosDateTime,\"[Date.UTC(%Y,%m,%e,%I,%i)\"), CONCAT(FORMAT(AVG(DatosTemp_c + 1),2),\"]\"))
FROM Data_WineBerry.Datos 
WHERE DatosDateTime > (select max(DatosDateTime) from Data_WineBerry.Datos) - interval 1 hour
GROUP BY unix_timestamp(DatosDateTime) DIV 60";


$results = $data_mysqli->query($query);
$serie = "";

if ($results) {
	$contador = $results->num_rows;
	while ($row = $results->fetch_row()){	
		if ($contador != 1)
		echo $row[0].",";
		else 
		echo $row[0];
		$contador --;
	}
	$serie = substr($serie,0,-1)."";
	$results->free();
}

echo $serie;

?>
/*
                [Date.UTC(1970, 9, 21), 0],
                [Date.UTC(1970, 10, 4), 0.38],
                [Date.UTC(1970, 10, 9), 0.35],
                [Date.UTC(1970, 10, 27), 0.3],
                [Date.UTC(1970, 11, 2), 0.38],
                [Date.UTC(1970, 11, 26), 0.38],
                [Date.UTC(1970, 11, 29), 0.57],
                [Date.UTC(1971, 0, 11), 0.89],
                [Date.UTC(1971, 0, 26), 0.82],
                [Date.UTC(1971, 1, 3), 1.12],
                [Date.UTC(1971, 1, 11), 1.22],
                [Date.UTC(1971, 1, 25), 1.3],
                [Date.UTC(1971, 2, 11), 1.28],
                [Date.UTC(1971, 3, 11), 1.29],
                [Date.UTC(1971, 4, 1), 1.95],
                [Date.UTC(1971, 4, 5), 2.32],
                [Date.UTC(1971, 4, 19), 1.25],
                [Date.UTC(1971, 5, 3), 0] */
            ]
        }],
        navigation: {
            menuItemStyle: {
                fontSize: '10px'
            }
        }
    });
});

$("input[class=boton_x]").switchButton({
 })
</script>

<script type="text/javascript">
	$("#rf-switch-frio").change( function() {
		myUrl = "https://7a7b65777e.dataplicity.io/cgi-bin/Change_Status_Pin?pin=27";
if ($("#rf-switch-frio").is(":checked")) {
	//alert("checked");	
	$.get(myUrl);


    // checkbox is checked 
} else {
	//alert("unchecked");
	$.get(myUrl);
    // checkbox is not checked 
}
});

</script>

<script type="text/javascript">
	$("#rf-switch-calor").change( function() {
		myUrl = "https://7a7b65777e.dataplicity.io/cgi-bin/Change_Status_Pin?pin=28";
if ($("#rf-switch-calor").is(":checked")) {
	alert("checked");	
	$.get(myUrl);

    // checkbox is checked 
} else {
	alert("unchecked");
	$.get(myUrl);
    // checkbox is not checked 
}
});

</script>