
<form action="{{ asset('provincias') }}" method="POST" role="form">
  <input type="hidden" name="_token" value="{{ csrf_token() }}">
  <div class="modal fade" id="create">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h3 class="modal-title">Nueva Provincia</h3>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label for="descripcion">Descripición</label>
            <input type="text" name="descripcion" class="form-control">
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-sm btn-primary" id="delete-btn">Guardar</button>
           <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>
  </div>
</form>
