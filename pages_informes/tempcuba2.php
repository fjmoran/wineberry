<div class="col-md-1"></div>
<div class="col-md-10">
	<h2>Gráfico temperatura en cuba #2</h2>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                  <label for="ir_a">Ir a:</label>
                    <select id="ir_a" class="form-control">
                        <option></option>
                        <option>Cuba #1</option>
                        <option>Cuba #3</option>
                        <option>Cuba #4</option>
                    </select>          
                </div>
            </div>
            <div class="col-md-8"></div>
        </div> 
	<div class="graph-report" id="grafico_cuba">
	</div>
<div class="col-md-1"></div>    	
</div><!-- col-md -->


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
                to: 12,
                color: 'rgba(68, 170, 213, 0.1)',
                label: {
                    text: 'Banda Inferior',
                    style: {
                        color: '#606060'
                    }
                }
            }, { // Light breeze
                from: 12.1,
                to: 17,
                color: 'rgba(0, 0, 0, 0)',
                label: {
                    text: 'Normal',
                    style: {
                        color: '#606060'
                    }
                }
            }, { // Gentle breeze
                from: 17.1,
                to: 25,
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
            data: [7.2, 7.8, 7.8, 7.8, 7, 6.3, 6.5, 7.9, 6.9, 7.6, 6.6, 8, 9, 8.6, 9.5, 9.2, 9.5, 9.5, 9, 8.1, 7.7, 9, 7.7, 7.3, 7.3, 9.1, 12.7, 12.1, 10.6, 11.1, 10.8, 13.6, 12.2, 14, 15.9, 16.5, 16.6, 16.1, 18, 17.3, 15.7, 14.4, 14.8, 14.6, 14.8, 14.5, 13.5, 12.4, 12.6]

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
</script>