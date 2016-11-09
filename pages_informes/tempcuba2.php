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
    $(document).ready(function () {
        Highcharts.setOptions({
            global: {
                useUTC: false
            }
        });

        $('#grafico_cuba').highcharts({
            chart: {
                type: 'spline',
                animation: Highcharts.svg, // don't animate in old IE
                marginRight: 10,
                events: {
                    load: function () {

                        // set up the updating of the chart each second
                        var series = this.series[0];
                        setInterval(function () {
                            var x = (new Date()).getTime(), // current time
                                y = Math.random();
                            series.addPoint([x, y], true, true);
                        }, 1000);
                    }
                }
            },
            title: {
                text: 'Live random data'
            },
            xAxis: {
                type: 'datetime',
                tickPixelInterval: 150
            },
            yAxis: {
                title: {
                    text: 'Value'
                },
                plotLines: [{
                    value: 0,
                    width: 1,
                    color: '#808080'
                }]
            },
            tooltip: {
                formatter: function () {
                    return '<b>' + this.series.name + '</b><br/>' +
                        Highcharts.dateFormat('%Y-%m-%d %H:%M:%S', this.x) + '<br/>' +
                        Highcharts.numberFormat(this.y, 2);
                }
            },
            legend: {
                enabled: false
            },
            exporting: {
                enabled: false
            },
            series: [{
                name: 'Random data',
                data: (function () {
                    // generate an array of random data
                    var data = [],
                        time = (new Date()).getTime(),
                        i;

                    for (i = -19; i <= 0; i += 1) {
                        data.push({
                            x: time + i * 1000,
                            y: Math.random()
                        });
                    }
                    return data;
                }())
            }]
        });
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
