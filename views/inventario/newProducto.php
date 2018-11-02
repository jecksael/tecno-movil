    <section id="prove-product-cat-config">
        <div class="container">
            <div class="page-header">
              <h1>Panel de administración de Productos <small><?php echo EMPRESA; ?></small></h1>
            </div>
            <?php
                if (!empty($this->msg->hasMessages())) { $this->msg->display(); }
                include VIEWS.'/inventario/partials/navegacion.php';
            ?>
            <!-- Nav tabs -->

            <div class="tab-content">
                <!--REGISTRO DE PRODUCTOS-->
                <div role="tabpanel" class="tab-pane fade <?php if($menu == 1){echo 'in active';}else{echo '';} ?>" id="newProducto">
                <div class="row">
                    <div class="col-xs-12 col-sm-6">
                        <br>
                    <div id="add-producto">
                        <h2 class="text-primary text-center"><small><i class="fa fa-plus"></i></small> Agregar Nuevo Producto</h2>

                        <form enctype="multipart/form-data" action="/inventario/newPro" method="post" >
                            <div class="form-group">
                                <label class="control-label">Codigo</label>
                                    <input type="text" name="cod_pro" class="form-control" maxlength="20" required>
                            </div>

                            <div class="form-group">
                                <label class="control-label">Descripcion</label>
                                    <input type="text" name="des_pro" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label class="control-label">Marca</label>
                                <select name="marca" id="" class="form-control" required>
                                <?php
                                    if (!empty($marcas)){
                                        foreach ($marcas as $key ) {
                                            echo "<option value='".$key->id."' >".$key->marca." </option>";
                                        }
                                    }
                                ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Stock</label>
                                <div class="input-group">
                                    <input type="text" class="number form-control" name="stock" maxlength="4" required="">
                                    <span class="input-group-addon">UND</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Precio de Compra</label>
                                <div class="input-group">
                                    <input type="text" name="pre_com" id="pre_com" class="price form-control" onkeyup="return precioVenta();" required>
                                    <span class="input-group-addon">BF</span>
                                 </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Porcentaje de Ganancia %</label>
                                <div class="input-group">
                                    <input type="text" name="porce" id="porce" class="number form-control" onkeyup="return precioVenta();" maxlength="3" required>
                                    <span class="input-group-addon">%</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Precio de Venta</label>
                                <div class="input-group">
                                    <input type="text" name="pre_ven" id="pre_ven" class="price form-control" readonly required>
                                    <span class="input-group-addon">BF</span>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="control-label">Imagen</label>
                                <input type="file" name="url_img" value="">
                            </div>

                            <div class="form-group">
                                <label  class="control-label">Status</label>
                                <select name="status" id="" class="form-control">
                                    <option value="1">Activo</option>
                                    <option value="0">Desabilitado</option>
                                </select>
                            </div>
                            <p class="text-center">
                                <button class="btn btn-primary" type="submit" name="savePro">Registrar</button>
                            </p>
                        </form>

                    </div>
                    </div>
        <!--- REGISTRO DE MARCA -->
                    <div class="col-sm-6">
                        <br>
                        <div id="add-marca">
                            <h2 class="text-primary text-center"><small><i class="fa fa-plus"></i></small> Agregar Marca</h2>
                            <form action="/inventario/newMarca" method="post">
                                <div class="form-group">
                                    <label class="control-label">Nombre de la marca</label>
                                    <input type="text" name="marca" class="form-control" required>
                                </div>
                                <p class="text-center">
                                    <button class="btn btn-primary" type="submit">Registrar</button>
                                </p>
                            </form>
                        </div>
                    </div>

                </div>
                </div>


            </div>
        </div>
    </section>
</body>
<script>

    function precioVenta()
    {
        var pre_com = $("#pre_com").val();
        pre_com = parseInt(pre_com.replace(/,/gi, ''));
        var porce = $("#porce").val();
        var ganancia = (pre_com * porce)/100;
        var pre_ven = ganancia + pre_com;
        pre_ven = number_format(pre_ven,2);
        $("#pre_ven").val(pre_ven);

    }

</script>
