<?php
require_once("../recursos/zhi/auth.php");
require_once("../recursos/zhi/CreaConnv2.php");
require_once("../recursos/zhi/funciones.php");
?>

<div class="col-md-11">

 	<h2>Relaciones entre Páginas</h2>
 	<h5>Seleccione la pagina que desea configurar y arrastre las paginas de la columna izquierda a la derecha para indicar que dichas paginas estan relacionadas.</h5><br>
 	<form role="form"  name="selpagina" id="selpagina" action="pages_admin/paginas_paginas_mod.php" method="POST">

	<div class="row">
		<div class="col-md-12">
			<div id="alert-insert" class="alert alert-success alert-dismissable hide">
		  		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		  		<span id="text-alert">Se ha realizado con exito la actualización de la tabla.</span>
			</div>
		<div>	
	</div>

	 	<div class="row">
	 		<div class="col-md-5">
			 	<div class="form-group">
		          <label for="rol">Página:</label>
		            <select id="pagina" class="form-control" name="pagina">
		            	<option value="">&nbsp</option>
		            	<?php
		            		echo option_select("Pagina","nombrePagina","idPagina",$mysqli,$_POST['pagina']);
		            	?>
		            </select>          
		        </div>
	 		</div>
	 		<div class="col-md-7"> <!-- columna vacia -->
	 		</div>
		</div>
	</form>
	 	<? 
			if ((isset($_POST['pagina'])) && (!empty($_POST['pagina'])))
			{
		?>
	<form role="form"  name="paginasenpagina" id="paginasenpagina" method="POST">	
	 	<div class="row">		
	 		<div class="col-md-5">
	 			<h5>Páginas disponibles</h5>
	 			<ul id="sortable1" class="droptrue">
	 				<?php
	 					echo listado("ui-state-default","Pagina","nombrePagina","idPagina",$mysqli,"Pagina.idPagina NOT IN (select Pagina_idPagina1 from PaginaenPagina where Pagina_idPagina ='".$_POST['pagina']."')");
	 				?>
				</ul>
			</div>
	 		<div class="col-md-5">
	 			<h5>Páginas relacionadas</h5>		
				<ul id="sortable2" class="droptrue">
					<?php
						echo listado("ui-state-default","Pagina","nombrePagina","idPagina",$mysqli,"Pagina.idPagina IN (select Pagina_idPagina1 from PaginaenPagina where Pagina_idPagina ='".$_POST['pagina']."')");
					?>
				</ul>
	 		</div>
	 		<div class="col-md-2"> <!-- columna vacia -->
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
 	<?php
 	}
 	?>
</div><!-- col-md-11 -->

<!-- Modal progress bar -->
<div class="modal fade" id="p_bar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
      <h4>Guardando...</h4>
		<div class="progress progress-striped active">
		  <div class="progress-bar"  role="progressbar" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
		  </div>
		</div>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script>
	$(function(){
		$("ul.droptrue").sortable({connectWith:"ul"});
		$("ul.dropfalse").sortable({connectWith:"ul",dropOnEmpty:false});
		$("#sortable1,#sortable2").disableSelection();
	});

	$(document).ready(function(){
		$('#sortable1,#sortable2').tooltip({
			selector:"[rel=tooltip]"})
	});

	$( '#pagina' ).change(function() {
		var $form = $(this).parents('form'),
		term = $form.serialize(),
		url = $form.attr( "action" );
		var posting = $.post(url, term );
		posting.done(function( data ) {
		$( '#cuerpo' ).empty().html( data );
		});
	});

	$('#paginasenpagina').submit(function(event) {
		var pagina_padre = $('#selpagina').serialize();
		var neworder = $('#sortable2').sortable('serialize');
		$('#p_bar').modal('show');
  		//alert( "Handler for .submit() called." + neworder + pagina_padre);
  		event.preventDefault();
  		$.post('recursos/zhi/update_paginas_paginas.php',neworder + "&" + pagina_padre,function(data){
  		//alert("@" + data + "@");
  		switch (data){
  			case "1": 
  				$('#alert-insert').removeClass('hide').addClass('alert-success').removeClass('alert-danger').removeClass('alert-warning');
  				$('#text-alert').html('Se ha realizado con exito la actualización de la tabla.'); 
  			break;
  			case "0": 
  				$('#alert-insert').removeClass('hide').removeClass('alert-success').addClass('alert-danger').removeClass('alert-warning'); 
  				$('#text-alert').html('Ha fallado la actualización.');
  			break;
  			case "2":
					$('#alert-insert').removeClass('hide').removeClass('alert-success').removeClass('alert-danger').addClass('alert-warning'); 
  				$('#text-alert').html('No ha realizados cambios.');
  			break;
  		}
  		$('#p_bar').modal('hide');
  		$('#alert-insert').show();
  		$('#frmboton').blur();
  		$('#alert-insert').delay(3000).fadeOut('slow');
  		//$('#cuerpo').html(data);
  		});
  	});	
</script>