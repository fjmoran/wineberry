<div class="col-md-11">
<h2>Creación de Contacto</h2>
<h5>Ingrese los datos del contacto a registrar.</h5><br>
  
  <form role="form">
    <ul class="nav nav-tabs" id="tabs_crear">
      <li class="active"><a href="#datos_basicos" data-toggle="tab">Datos Básicos</a></li>
      <li><a href="#direccion" data-toggle="tab">Dirección</a></li>
    </ul>

<div class="tab-content">
  <div class="tab-pane active" id="datos_basicos">
    <!-- datos basicos -->
    <div class="row"> <!-- fila para sub titulo opcional -->
      <div class="col-md-12">
        <h4></h4>
      </div>
    </div>    
    <div class="row"> <!-- fila con 2 columnas -->
      <div class="col-md-6"> <!-- columna izquierda -->

        <div class="form-group">
          <label for="nombres">Nombres:</label>
          <input id="nombres" class="form-control" type="text" placeholder="Nombres">
        </div> 
        <div class="form-group">
          <label for="apellido2">Apellido materno:</label>
          <input id="apellido2" class="form-control" type="text" placeholder="Apellido materno"> 
        </div>

        <div class="form-group">
          <label for="telefono">Teléfono:</label>
          <input id="telefono" class="form-control" type="text" placeholder="Teléfono">          
        </div>
        <div class="form-group">
          <label for="email">Correo Electrónico:</label>
          <input id="email" class="form-control" type="email" placeholder="nombre@dominio.com">      
        </div>  
        <div class="form-group">
          <label for="twitter">Twitter:</label>
          <input id="twitter" class="form-control" type="text" placeholder="Twitter">       
        </div>                                                 
      </div>
      <div class="col-md-6"> <!-- columna derecha -->

        <div class="form-group">
          <label for="apellido1">Apellido paterno:</label>
          <input id="apellido1" class="form-control" type="text" placeholder="Apellido paterno"> 
        </div>  

        <div class="form-group">
          <label for="rut">RUT:</label>
          <input id="rut" class="form-control" type="text" placeholder="xx.xxx.xxx-x">        
        </div>
        <div class="form-group">
          <label for="movil">Teléfono móvil:</label>
          <input id="movil" class="form-control" type="text" placeholder="Teléfono móvil">       
        </div>  
        <div class="form-group">
          <label for="linkedin">LinkedIn:</label>
          <input id="linkedin" class="form-control" type="text" placeholder="LinkedIn">       
        </div>
        <div class="form-group">
          <label for="facebook">Facebook:</label>
          <input id="facebook" class="form-control" type="text" placeholder="Facebook">       
        </div>                                                       
      </div>  
    </div>
    <!-- fin datos basicos -->
  </div>
  <div class="tab-pane" id="direccion">    
    <!-- direccion -->
    <div class="row"> <!-- fila para sub titulo opcional -->
      <div class="col-md-12">
        <h4></h4>
      </div>
    </div> 
    <div class="row"> 
      <div class="col-md-6"> <!-- columna derecha dirección -->
        <div class="form-group">
          <label for="pais">País:</label>
            <select id="pais" class="form-control">
              <option>Chile</option>              
              <option>Argentina</option>
              <option>Perú</option>  
              <option>U.S.A.</option>  
              <option>Otro</option>                                                                         
            </select>          
        </div> 
        <div class="form-group">
          <label for="comuna">Comuna:</label>
            <select id="Comuna" class="form-control">
              <option>Las Condes</option>              
              <option>Santiago</option>
              <option>Ñuñoa</option>  
              <option>Providencia</option>  
              <option>No aplica</option>                                                                         
            </select>          
        </div>
        <div class="form-group">
          <label for="depto">Oficina o Departamento:</label>
          <input id="depto" class="form-control" type="text" placeholder="Oficina o Departamento">       
        </div>                     
      </div>
      <div class="col-md-6"> <!-- columna izquerda dirección -->
        <div class="form-group">
          <label for="region">Región:</label>
            <select id="region" class="form-control">
            <option>Región Metropolitana</option>              
            <option>Región Arica y Parinacota</option>
            <option>Región Tarapacá</option>  
            <option>Región Antofagasta</option>  
            <option>No aplica</option>                                                                         
            </select>          
        </div>
        <div class="form-group">
          <label for="calle">Calle o Avenida:</label>
          <input id="calle" class="form-control" type="text" placeholder="Calle o Avenida">       
        </div>         
      </div>
    </div>
    <!-- fin direccion -->
  </div>
</div>    
    <div class="row pull-right"> <!-- fila para botones -->
      <div class="col-md-12">
        <p>
          <button class="btn btn-default">Cancelar</button>
          <button class="btn btn-primary">Guardar</button>
        </p>
      </div>
    </div>       

  </form>
</div>


