<form action="/clientes/newClienteAjax" id="form-cliente">
<div class="modal fade" id="newCliente" tabindex="-1" role="dialog" >
    <div class="modal-dialog" >
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" >Agregar Cliente </h4>
            </div>
            <div class="modal-body">
            <label class="control-label">Cedula:</label>
            <div class="form-group">
                <select class="form-control" name="nac_id" style="width: 20%; float: left">
                    <option value="1">V-</option>
                    <option value="2">E-</option>
                </select>
                    <input class="cedula form-control" type="text" name="ced_cli" style="width: 80%;" placeholder="Cedula" maxlength="8" required>
            </div>

            <div class="form-group">
                <label class="control-label">Nombres:</label>
                    <input class="abc form-control" type="text" name="nom_cli" maxlength="100" placeholder="Nombres" required  >
            </div>

            <div class="form-group">
                <label for="">Apellidos:</label>
                    <input type="text" class="abc form-control" name="ape_cli" maxlength="100" placeholder="Apellidos" required >
            </div>

            <div class="form-group">
                <label for="">Genero:</label>
                    <select name="gen_cli" class="form-control">
                        <option value="M">Masculino</option>
                        <option value="F">Femenino</option>
                    </select>
            </div>

            <div class="form-group">
                <label class="control-label">Direccion:</label>
                    <textarea class="form-control" name="dir_cli" cols="30" rows="2" placeholder="Dirección" required ></textarea>
            </div>

            <div class="form-group">
                <label class="control-label">Telefono:</label>
                    <input class="phone form-control" type="text" name="telf_cli" placeholder="0412-12345678">
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
