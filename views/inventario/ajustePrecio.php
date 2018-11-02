<body>
    <section id="prove-product-cat-config">
        <div class="container">
            <div class="page-header">
                <h1>Panel de administración de Productos <small><?php echo EMPRESA; ?></small></h1>
            </div>
            <?php

                if (!empty($this->msg->hasMessages())) { $this->msg->display(); }
                /*
                $msg = $this->msg->error('El Codigo del Producto ya Existe');
                $msg->display();*/
            ?>

            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active">
                    <a href="#lisProductos" role="tab" data-toggle="tab">Ajuste de Precio</a>
                </li>
            </ul>

            <div class="tab-content">
                <!--AJUSTE POR DESCRIPCION -->
                <div role="tabpanel" class="tab-pane fade <?php if($menu == 1){echo 'in active';}else{echo '';} ?>" id="newProducto">
                <div class="row">
                    <div class="col-xs-12 col-sm-6" id="table-producto">
                        <br>
                        <div id="add-producto">
                            <h2 class="text-primary text-center">Buscar por Descripción</h2>
                            <form action="/inventario/busDescripcion" method="post" id="busqueda_pro">
                                <div class="form-group">
                                    <label class="control-label">Descripción del Producto</label>
                                        <input type="text" name="des_pro" class="form-control" required>
                                </div>
                                <p class="text-center">
                                    <button class="btn btn-primary" id="busDescripcion" type="submit">Buscar</button>
                                </p>
                            </form>
                        </div>
                    </div>
        <!--- AJUSTE DE TODOS LOS PRECIOS -->
                    <div class="col-sm-6">
                        <br>
                        <div id="add-marca">
                            <h2 class="text-primary text-center">Todos los Productos</h2>
                            <form action="/inventario/ajusteAll" id="form-ajusteAll" method="post">
                                <div class="form-group">
                                    <label class="control-label">Porcentaje a Aumentar</label>
                                    <div class="input-group">
                                        <input type="text" name="porcAll" class="number form-control" required>
                                        <div class="input-group-addon">
                                            <span>%</span>
                                        </div>
                                    </div>
                                </div>
                                <p class="text-center">
                                    <button class="btn btn-primary" type="submit">Ajustar</button>
                                </p>
                            </form>
                        </div>
                    </div>

                </div>
                </div>

            </div>

            <div class="tab-content" id="busqueda-producto">
                <div class="row"><br>
                    <div class="col-xs-12">
                        <br><br>
                        <div class="panel panel-info">
                            <div class="panel-heading text-center"></i><h3>Productos</h3></div>
                              <div class="table-responsive">
                                <form action="/inventario/ajusteEsp" method="POST" id="form-ajusteEsp">
                                  <table width="100%" class="table table-bordered" id="tableClientes" style="margin-right: 0; margin-left: 0">
                                      <thead class="text-center">
                                          <tr>
                                            <th></th>
                                            <th>Codigo</th>
                                            <th>Descripción</th>
                                            <th>P. Compra</th>
                                            <th>P. Venta</th>
                                          </tr>
                                      </thead>
                                      <tbody id="detalle">

                                      </tbody>
                                  </table>
                              </div>
                        </div>
                        <div class="col-xs-offset-4 col-xs-4">
                              <div class="form-group">
                                  <label class="control-label">Porcentaje a Aumentar</label>
                                  <div class="input-group">
                                    <input type="text" name="porc_esp" class="number form-control" required>
                                    <span class="input-group-addon">%</span>
                                  </div>
                              </div>
                        </div>
                        <div class="col-xs-12">
                            <div class="text-center">
                                <button class="btn btn-primary" type="submit">Ajustar</button>
                            </div>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
<script>
    $(document).ready(function(){
        $('div.alert').not('.alert-important').delay(3000).fadeOut(350);
        $('#busqueda-producto').hide();

        $("#busqueda_pro").submit(function(e){
            e.preventDefault();
            var url = $("#busqueda_pro").attr('action');
            var des = $("#busqueda_pro").find('input').val();
            var data = {'des_pro':des};
            $.post(url, data, function(result){
                var data = JSON.parse(result);
                if(data == ''){
                    swal("", "No se encontraron resultados", "error");
                    $("#detalle").html('');
                    $("#busqueda-producto").hide('slow');
                }
                else {
                    $("#detalle").html('');
                    $("#busqueda-producto").show('slow');
                    $.each(data, function(index, val){
                        $("#detalle").append('<tr><td><input type="checkbox" name="id['+val.cod_pro+']"></td><td>'+val.cod_pro+'</td><td>'+val.des_pro+'</td><td>'+val.pre_com+'</td><td>'+val.pre_ven+'</td></tr>');
                    });
                }
            }).fail(function(){
                swal("", "Ocurrio un Error", "error");
            })
        });

        $("#form-ajusteAll").submit(function(e){
            e.preventDefault();
            var porce = $("input[name='porcAll']").val()
            var url = $("#form-ajusteAll").attr('action')
            var data = {'porcAll':porce};
            $.ajax({
                url:url,
                data:data,
                type:'post',
                beforeSend:function(){
                    showLoad();
                },
                success:function(data){
                    swal('', 'Los precios han sido ajustado', 'success')
                    removeLoad()
                },
                error:function(){
                    swal('', 'Los precios han sido ajustado', 'success')
                    removeLoad()
                }
            })

        });

    })
</script>
