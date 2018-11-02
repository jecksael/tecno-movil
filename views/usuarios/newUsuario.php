<div class="modal fade" id="newUsuario" tabindex="-1" role="dialog" >
<form action="/usuario/create" method="POST" id="form-usuario">
    <div class="modal-dialog" >
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" ></h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Nombre:</label>
                    <input type="hidden" name="id">
                    <input class="abc form-control" type="text" name="name" maxlength="100" placeholder="Nombres" >
                </div>

                <div class="form-group">
                    <label>Apellido:</label>
                    <input class="abc form-control" type="text" name="apellido" maxlength="100" placeholder="Apellidos" >
                </div>

                <div class="form-group">
                    <label>Email:</label>
                    <input class="form-control" type="email" name="email" maxlength="100" placeholder="Email" >
                </div>

                <div class="password form-group">
                    <label>Contraseña:</label>
                    <input class="form-control" type="password" name="passUsu" maxlength="20" placeholder="Contraseña"  >
                </div>

                <div class="form-group">
                    <label>Direccion:</label>
                    <input class="abc form-control" type="text" maxlength="80" name="direccion" placeholder="Direccion" " >
                </div>


                <div class="form-group">
                    <label>Telefono:</label>
                    <input class="phone form-control" type="text" maxlength="80" name="telUsu" placeholder="Telefono" >
                </div>

                <div class="form-group">
                    <label>Cargo:</label>
                    <select name="carUsu" class="form-control">
                        <?php foreach ($cargo as $key ) {
                            echo "<option value='".$key->id."'>".$key->cargo."</option>";
                        } ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="">Status:</label>
                    <select name="status" class="form-control">
                        <option value="1">Activo</option>
                        <option value="2">Inactivo</option>
                    </select>
                </div>


            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-primary">Guardar datos</button>
            </div>

        </div>
    </div>
</form>
</div>
