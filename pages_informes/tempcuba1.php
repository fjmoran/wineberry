<div class="col-md-1"></div>
<div class="col-md-10">
	<h2>Gráfico temperatura en cuba #1</h2>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                  <label for="ir_a">Ir a:</label>
                    <select id="ir_a" class="form-control">
                        <option>--- Seleccione una cuba ---</option>
                        <option>Cuba #2</option>
                        <option>Cuba #3</option>
                        <option>Cuba #4</option>
                    </select>          
                </div>
            </div>
            <div class="col-md-8"></div>
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
                        <input type="checkbox" name="rf-switch-1" class="boton_x">
                    </label>           
                </div><!-- /.info-box-content -->
            </div>
        </div>
        <div class="col-md-4">  
             <div class="info-box">
                <span class="info-box-icon bg-red"><i class="fa fa-plus"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Control de calor</span>
                    <span class="info-box-number"></span></br></span>
                    <label>
                        <input type="checkbox" name="rf-switch-1" class="boton_x">
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
                pointInterval: 3600000, // one hour
                pointStart: Date.UTC(2015, 4, 31, 0, 0, 0)
            }
        },
        series: [{
            name: 'tº Interna',
            data: [7.2, 7.8, 7.8, 7.8, 7, 6.3, 6.5, 7.9, 6.9, 7.6, 6.6, 8, 9, 8.6, 9.5, 9.2, 9.5, 9.5, 9, 8.1, 7.7, 9, 7.7, 7.3, 7.3, 9.1, 12.7, 12.1, 10.6, 11.1, 10.8, 13.6, 12.2, 14, 15.9, 16.5, 16.6, 16.1, 18, 25.3, 15.7, 14.4, 14.8, 14.6, 14.8, 14.5, 13.5, 12.4, 12.6]

        }, {
            name: 'tº Externa',
            data: [4, 4, 4.6, 4.9, 4.8, 4.2, 5, 5, 5, 5.1, 5.6, 5.7, 5.8, 5.6, 5.2, 5, 5.1, 5.3, 5.3, 5, 5.1, 5, 5, 5, 5.2, 5.1, 5, 5.3, 5, 5.1, 5.2, 5.1, 5.3, 5.3, 5, 8.1, 8.1, 7.5, 6.5, 6.9, 8.1, 6, 7.3, 6.9, 6.2, 5.7, 6.3, 5.4, 5.3]
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
