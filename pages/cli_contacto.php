<div class="col-md-11">
  <h2>Agregar contacto a cliente</h2>
  <h5>Relacione uno o más contactos a un cliente</h5>
  <br>
  <form role="form">
    <div class="row">
      <div class="col-md-6">
        <div class="form-group">
          <label for="cliente" class="control-label">Cliente:</label>
          <input id="cliente" class="form-control" type="text" placeholder="Nombre del cliente"> <!-- agregar typeahead -->
        </div>
        <div class="form-group">
          <label for="cliente" class="control-label">Tipo de relación:</label>
          <select id="tipo" class="form-control">
            <option>Gerente General</option> <!-- llenar dinamicamente -->
            <option>Gerente Comercial</option>
            <option>Tomador de desiciones</option>
            <option>Secretaria</option>
            <option>Influencia</option>
          </select>
        </div>  
      </div>  
      <div class="col-md-6">
        <div class="form-group">
          <label for="contacto" class="control-label">Contacto:</label>
          <input id="contacto" class="form-control" type="text" placeholder="Nombre del contacto">
        </div>  
      </div>
    </div> 
    <div class="row pull-right">
      <div class="col-md-12">
          <p>
            <button class="btn btn-default">Cancelar</button>
            <button class="btn btn-primary">Guardar</button>
          </p>
      </div>
    </div>
  </form>
</div>