<form enctype="multipart/form-data" action="/inventario/updatePro" method="POST">
<div class="modal fade" id="editPro" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h3 class="modal-title" >Editar Producto</h3>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label class="control-label">Codigo:</label>
          <input type="text" class="form-control" name="cod_pro" id="cod_pro">
          <input type="hidden" name="id">
        </div>

        <div class="form-group">
          <label class="control-label">Descripción:</label>
          <input type="text" class="form-control" name="des_pro" required>
        </div>

        <div class="form-group">
          <label class="control-label">Marca:</label>
          <select name="marca" id="mar" class="form-control">
            <?php foreach ($marca as $mar ) {
              echo '<option value="'.$mar->id.'">'.$mar->marca.'</option>';
            } ?>
          </select>
        </div>

        <div class="form-group">
          <label class="control-label">Stock:</label>
          <div class="input-group">
            <input type="text" class="number form-control" name="stock" maxlength="3" required>
            <span class="input-group-addon">UND</span>
          </div>
        </div>

        <div class="form-group">
          <label class="control-label">Precio de Compra:</label>
          <div class="input-group">
            <input type="text" class="price form-control" name="pre_com" id="pre_com" onkeyUp="return precioVenta();" required>
            <span class="input-group-addon">BF</span>
          </div>
        </div>

        <div class="form-group">
          <label class="control-label">Porcentaje de Ganancia:</label>
          <div class="input-group">
            <input type="text" class="number form-control" name="porce" id="porce" maxlength="3" onkeyUp="return precioVenta();" required>
            <span class="input-group-addon">%</span>
          </div>
        </div>

        <div class="form-group">
          <label class="control-label">Precio de Venta:</label>
          <div class="input-group">
            <input type="text" class="form-control" name="pre_ven" id="pre_ven" readonly>
            <span class="input-group-addon">BF</span>
          </div>
        </div>

        <div class="form-group">
          <label for="">Imagen:</label><br>
          <img id="image" src="" alt="imagen" width="100px">
          <input type="hidden" value="" name="url_img_old">
          <input type="file" name="url_img" value="">
        </div>

        <div class="form-group">
          <label class="control-label">Status</label>
            <select name="status" id="status" class="form-control">
              <option value="1">Activo</option>
              <option value="0">Desabilitado</option>
            </select>
        </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
      </div>
    </div>
  </div>
</div>
</form>
