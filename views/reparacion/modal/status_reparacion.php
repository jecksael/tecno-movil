<div class="modal fade" id="modal-status-reparacion">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Status de Reparación</h4>
            </div>
            <div class="modal-body">
                <input type="hidden" id="id_reparacion">
                <select class="form-control" id="status_reparacion">
                    <option value="2">Reparado</option>
                    <option value="3">Sin Arreglo</option>
                </select>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"> Cancelar</button>
                <button type="button" id="submit-change-status" class="btn btn-primary">Cambiar Status</button>
            </div>
        </div>
    </div>
</div>
