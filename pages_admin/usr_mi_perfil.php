<?php
require_once("../recursos/zhi/auth.php");
require_once("../recursos/zhi/CreaConnv2.php");

$query_datos_usr = "select nombreUsuario as nombre, userUsuario as user, correoUsuario as correo, telefonoUsuario as telefono, celularUsuario as celular, nombrePerfil as Perfil from Usuario U, Perfil P where U.idUsuario = '".$_SESSION['idUsuario']."' and P.idPerfil = '".$_SESSION['Perfil_idPerfil']."'";
if ($debug) {echo "Consulta por los datos del usuario : ".$query_datos_usr."</br>";}
if ($rs_datos_usr = $mysqli->query($query_datos_usr)){
  $datos_usr = $rs_datos_usr->fetch_assoc();
  $rs_datos_usr->close();
}else{
  echo "Falló al ejecutar la consulta: (". $mysqli->errno .") ". $mysqli->error."</br>";
}

?>


<div class="col-md-11">
 <h2>Mi Perfil</h2>
 <h5>Los siguentes son sus datos en el sistema</h5>

	<form role="form" method="POST" action="recursos/zhi/actualizar_usr.php" target="IframeOutput">

    <div class="row"> <!-- fila con 2 columnas -->
      <div class="col-md-6"> <!-- columna izquierda -->
        <div class="form-group"> 
          <label for="nombre_completo">Nombre:</label>
          <input id="nombre_completo" class="form-control" type="text" placeholder="Nombre Apellido" name="nombreUsuario" id="nombreUsuario" value="<?php echo $datos_usr['nombre']; ?>"> 
        </div>

        <div class="form-group">
          <label for="rol">Rol del ususario:</label>
            <select id="rol" class="form-control" disabled>
              <option><?php echo $datos_usr['Perfil']; ?></option>                                   
            </select>          
        </div>

        <div class="form-group"> 
          <label for="fono1">Teléfono:</label>
          <input id="fono1" class="form-control" type="text" placeholder="Teléfono" name="telefonoUsuario" id="telefonoUsuario" value="<?php echo $datos_usr['telefono']; ?>">           
        </div>        

      </div>
      <div class="col-md-6"> <!-- columna derecha -->

        <div class="form-group">
          <label for="usuario">Usuario:</label>
          <input id="usuario" class="form-control" type="text" placeholder="Usuario" name="userUsuario" id="userUsuario" value="<?php echo $datos_usr['user']; ?>" disabled> 
        </div>

        <div class="form-group">
          <label for="correo">Correo electrónico:</label>
          <input id="correo" class="form-control" type="email" placeholder="Correo electrónico" name="correoUsuario" id="correoUsuario" value="<?php echo $datos_usr['correo'];?>"> 
        </div> 

        <div class="form-group"> 
          <label for="fono2">Teléfono móvil:</label>
          <input id="fono2" class="form-control" type="text" placeholder="Teléfono móvil" name="celularUsuario" id="celularUsuario" value="<?php echo $datos_usr['celular'];?>">           
        </div>                   
                    
      </div>  
    </div>
        <div class="row pull-right"> <!-- fila para botones -->
	      <div class="col-md-12">
	        <p>
            <button class="btn btn-default">Cancelar</button>
	          <a class="btn btn-info" data-toggle="modal" data-target="#usr_clave_mod" href="pages_admin/usr_clave_mod.php">Cambiar clave</a>
	          <button class="btn btn-primary">Guardar</button>
	        </p>
	      </div>
	    </div> 

	</form>	
</div><!-- col-md-11 -->


<div id="usr_clave_mod" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="act_deasctLabel" aria-hidden="true">
  <div class="modal-dialog">
      <div class="modal-content">
        <!-- Contenido Modal -->
      </div>
  </div>        
</div>

    <script type="text/javascript">
    $('.modal').on('hidden.bs.modal', function () {
      // alert("cerrado!");
      $(this).removeData();
    });
  </script>
