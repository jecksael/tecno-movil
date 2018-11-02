<form id="form-servicio" action="/reparacion/newServiceAjax">
<div class="modal fade" id="newService" tabindex="-1" role="dialog" >
    <div class="modal-dialog modal-sm" >
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" >Nuevo Servicio </h4>
            </div>
            <div class="modal-body">
            <div class="fomr-group">
                <label class="control-label">Nombre del Servicio:</label>
                <input class="form-control" type="text" name="servicio" required>
            </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-primary">Guardar datos</button>
            </div>

        </div>
    </div>
</div>
</form>
