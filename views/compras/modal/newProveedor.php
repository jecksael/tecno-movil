<form action="/proveedor/new_proveedor_ajax" method="post" id="form-proveedor">
    <div class="modal fade" id="newProveedor">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4>Agregar Proveedor</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="Rif">Rif:</label>
                        <input type="text" class="form-control" name="rif_pro_m" placeholder="Rif" maxlength="15" required>
                    </div>
                    <div class="form-group">
                        <label for="nombre">Nombre:</label>
                        <input type="text" class="form-control" name="nom_pro_m" placeholder="Nombre del proveedor" maxlength="60" required>
                    </div>

                    <div class="form-group">
                        <label for="">Direccion:</label>
                        <input type="text" class="form-control" name="dir_pro_m" maxlength="100" placeholder="Direccion" required>
                    </div>
                    <div class="form-group">
                        <label for="">Telefono:</label>
                        <input type="text" class="phone form-control" name="telf_pro_m" placeholder="0424-1234567">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Guardar Datos</button>
                </div>
            </div>
        </div>
    </div>
</form>
