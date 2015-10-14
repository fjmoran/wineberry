<?php
require_once("../recursos/zhi/auth.php");
require_once("../recursos/zhi/CreaConnv2.php");
require_once("../recursos/zhi/funciones.php");
?>
<div class="col-md-11">
 	<h2>Permisos por Rol</h2>
 	<h5>Seleccione el rol que desea configurar y arrastre los permisos de la columna izquierda a la derecha.</h5><br>
 	<form role="form">
	 	<div class="row">
	 		<div class="col-md-4">
			 	<div class="form-group">
		          <label for="rol">Rol:</label>
		            <select id="rol" class="form-control">
		            	<?php
		            		echo option_select("Perfil","nombrePerfil","idPerfil",$mysqli);
		            	?>
		            </select>          
		        </div>
	 		</div>
	 		<div class="col-md-8"> <!-- columna vacia -->
	 		</div>
	 	</div>




		<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
		  <div class="panel panel-default">
		    <div class="panel-heading" role="tab" id="headingOne">
		      <h4 class="panel-title">
		      	<input type="checkbox" name="vehicle" value="nombre_pagina1">
		        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
		          Página Nº1
		        </a>
		      </h4>
		    </div>
		    <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
		      <div class="panel-body">
	
<div class="row">
			      	<div class="col-md-6">
			      		<h4>Nombre item</h4>
			      	</div>
			      	<div class="col-md-2">
			      		<h4>Normal</h4>
			      	</div>	
			      	<div class="col-md-2">
			      		<h4>Bloquedo</h4>
			      	</div>	
			      	<div class="col-md-2">
			      		<h4>Oculto</h4>
			      	</div>	
			    </div> 	
			    <div class="row">
			      	<div class="col-md-6">
			      		<h5>Item nombre 1</h5>
			      	</div>
			      	<div class="col-md-2">
			      		<input type="radio" name="p1_item1" value="0">
			      	</div>	
			      	<div class="col-md-2">
			      		<input type="radio" name="p1_item1" value="1">
			      	</div>	
			      	<div class="col-md-2">
			      		<input type="radio" name="p1_item1" value="2">
			      	</div>	
		      	</div>
		      	<div class="row">
			      	<div class="col-md-6">
			      		<h5>Item nombre 2</h5>
			      	</div>
			      	<div class="col-md-2">
			      		<input type="radio" name="p1_item2" value="0">
			      	</div>	
			      	<div class="col-md-2">
			      		<input type="radio" name="p1_item2" value="1">
			      	</div>	
			      	<div class="col-md-2">
			      		<input type="radio" name="p1_item2" value="2">
			      	</div>	
		      	</div>



		      </div>
		    </div>
		  </div>
		  <div class="panel panel-default">
		    <div class="panel-heading" role="tab" id="headingTwo">
		      <h4 class="panel-title">
		      	<input type="checkbox" name="vehicle" value="nombre_pagina2">
		        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
		         Página Nº2
		        </a>
		      </h4>
		    </div>
		    <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
		      <div class="panel-body">
		      	<div class="row">
			      	<div class="col-md-6">
			      		<h4>Nombre item</h4>
			      	</div>
			      	<div class="col-md-2">
			      		<h4>Normal</h4>
			      	</div>	
			      	<div class="col-md-2">
			      		<h4>Bloquedo</h4>
			      	</div>	
			      	<div class="col-md-2">
			      		<h4>Oculto</h4>
			      	</div>	
			    </div> 	
			    <div class="row">
			      	<div class="col-md-6">
			      		<h5>Item nombre 1</h5>
			      	</div>
			      	<div class="col-md-2">
			      		<input type="radio" name="p2_item1" value="0">
			      	</div>	
			      	<div class="col-md-2">
			      		<input type="radio" name="p2_item1" value="1">
			      	</div>	
			      	<div class="col-md-2">
			      		<input type="radio" name="p2_item1" value="2">
			      	</div>	
		      	</div>
		      	<div class="row">
			      	<div class="col-md-6">
			      		<h5>Item nombre 2</h5>
			      	</div>
			      	<div class="col-md-2">
			      		<input type="radio" name="p2_item2" value="0">
			      	</div>	
			      	<div class="col-md-2">
			      		<input type="radio" name="p2_item2" value="1">
			      	</div>	
			      	<div class="col-md-2">
			      		<input type="radio" name="p2_item2" value="2">
			      	</div>	
		      	</div>


		      </div>
		    </div>
		  </div>
		  <div class="panel panel-default">
		    <div class="panel-heading" role="tab" id="headingThree">
		      <h4 class="panel-title">
		      	<input type="checkbox" name="vehicle" value="nombre_pagina3">
		        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
		          Página Nº3
		        </a>
		      </h4>
		    </div>
		    <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
		      <div class="panel-body">


		      	<div class="row">
			      	<div class="col-md-6">
			      		<h4>Nombre item</h4>
			      	</div>
			      	<div class="col-md-2">
			      		<h4>Normal</h4>
			      	</div>	
			      	<div class="col-md-2">
			      		<h4>Bloquedo</h4>
			      	</div>	
			      	<div class="col-md-2">
			      		<h4>Oculto</h4>
			      	</div>	
			    </div> 	
			    <div class="row">
			      	<div class="col-md-6">
			      		<h5>Item nombre 1</h5>
			      	</div>
			      	<div class="col-md-2">
			      		<input type="radio" name="p3_item1" value="0">
			      	</div>	
			      	<div class="col-md-2">
			      		<input type="radio" name="p3_item1" value="1">
			      	</div>	
			      	<div class="col-md-2">
			      		<input type="radio" name="p3_item1" value="2">
			      	</div>	
		      	</div>
		      	<div class="row">
			      	<div class="col-md-6">
			      		<h5>Item nombre 2</h5>
			      	</div>
			      	<div class="col-md-2">
			      		<input type="radio" name="p3_item2" value="0">
			      	</div>	
			      	<div class="col-md-2">
			      		<input type="radio" name="p3_item2" value="1">
			      	</div>	
			      	<div class="col-md-2">
			      		<input type="radio" name="p3_item2" value="2">
			      	</div>	
		      	</div>


		      </div>
		    </div>
		  </div>
		</div>












		<div class="row">
			<div class="row pull-right"> <!-- fila para botones -->
			    <div class="col-md-12">
			    	<p>
			  	  <input class="btn btn-primary" type="submit" value="Guardar" id="frmboton">
				    </p>
			    </div>
		    </div>  
		<div>	 	
 	</form>	
</div><!-- col-md-11 -->

<script>$(function(){$("ul.droptrue").sortable({connectWith:"ul"});$("ul.dropfalse").sortable({connectWith:"ul",dropOnEmpty:false});$("#sortable1,#sortable2").disableSelection();});$(document).ready(function(){$('#sortable1,#sortable2').tooltip({selector:"[rel=tooltip]"})});</script>
<script>
$('#send_all').bind({
    'click': function(){ 
        $('#sortable1 li').each(function(){
            $(this).appendTo('#sortable2');
        });
        $tabs.tabs('select', 1 );
    }
});
</script>