<?php include VIEWS.'/reparacion/modal/newCliente.php'; ?>
<body>
<section id="prove-product-cat-config">
<div class="container">
    <div class="page-header">
        <h1>Panel de administración de Ventas <small><?php echo EMPRESA; ?></small></h1>
    </div>
        <?php include VIEWS.'/ventas/modal/cobro.php';
         if (!empty($this->msg->hasMessages())) { $this->msg->display(); }
            //include VIEWS.'/clientes/partials/navegacion.php'; ?>
            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="<?php if($menu == 1){echo 'active';}else {echo '';} ?>">
                    <a href="/venta" role="tab">Nueva Venta</a>
                </li>
                <?php if ($_SESSION["id"] == 1) {?>
                <li role="presentation" class="<?php if($menu == 2){echo 'active';}else {echo '';} ?>">
                    <a href="/venta/reporte" role="tab">Reporte de Ventas</a>
                </li>
                <?php } ?>

            </ul>
        <div role="tabpanel" class="tab-pane fade <?php if($menu == 1){echo 'in active';} else {echo '';}?>" id="newCliente">
        <div class="row">
            <div class="col-xs-12 ">
                <br>
            <div id="add-compra">
                <div class="col-xs-12">

                <div class="panel panel-info">
                    <div class="panel-heading text-center"><h3>Punto de Venta</h3></div>
                 </div>
                </div>
                    <div class="col-xs-12 col-sm-8">
                    <div class="panel panel-default">
                        <div class="panel-body">

                            <div class="form-group col-xs-12 col-sm-6">
                                <label>Cedula:</label>
                                <div class="input-group">
                                    <input type="text" class="cedulaEdit form-control"  id="ced_cli" placeholder="V-123456789">
                                    <span class="input-group-addon cursor-pointer" data-toggle="modal" data-target="#newCliente">
                                        <i class="fa fa-plus-circle" ></i>
                                    </span>
                                    <input type="hidden" id="ced_id">
                                </div>
                            </div>

                            <div class="form-group col-sm-6">
                                <label>Nombre:</label>
                                <input type="text" class="form-control" id="nom_cli" readonly="">
                            </div>

                            <div class="form-group col-sm-6">
                                <label>Direccion:</label>
                                <input type="text" class="form-control" id="dir_cli" readonly="">
                            </div>

                            <div class="form-group col-sm-6">
                                <label>Vendedor:</label>
                                <input type="text" class="form-control" name="nom_ven" value="<?php echo $vendedor; ?>" readonly="">
                            </div>
                                <div class="form-group col-sm-3">
                                    <label>Cod. Producto:</label>
                                    <input type="text" class="form-control" id="cod_pro" placeholder="Codigo">
                                </div>

                            <div class="form-group col-sm-4">
                                <label for="">Descripción:</label>
                                <input type="text" class="form-control" name="des_pro" readonly="">
                                <input type="hidden" name="precio" >
                                <input type="hidden" id="stock" name="stock">
                            </div>

                            <div class="form-group col-sm-3">
                                <label>Cantidad:</label>
                                <div class="input-group">
                                    <input type="text" class="number form-control" name="cantidad" placeholder="0">
                                    <span class="input-group-addon">UND</span>
                                </div>

                            </div>

                            <div class=" text-center form-group col-sm-2">
                                <img id="add-car"
                                     class="cursor-pointer"
                                     src="<?php echo  '/img/carro.png'; ?>" alt="carro">
                            </div>


                        </div>
                    </div>
                     </div>
                        <div class="col-sm-4">
                            <div class="panel panel-success datos-pago">
                                <div class="panel-heading ">
                                    <div class="row ">

                                            <h4 class="col-xs-12 col-sm-4 negrita">B.I.G</h4>
                                            <h4 class="col-sm-8 negrita">
                                               <input name="big" class="big form-control text-right" type="text" value="0.00" id="big" readonly="">
                                            </h4>

                                            <h4 class="col-xs-12 col-sm-4 negrita">IVA</h4>
                                            <h4 class="col-sm-8 negrita">
                                               <input name="big" class="big form-control text-right" type="text" value="0.00" id="iva" readonly="">
                                            </h4>

                                            <h4 class="col-xs-12 col-sm-4 negrita">TOTAL</h4>
                                            <h4 class="col-sm-8 negrita">
                                               <input name="big" class="big form-control text-right" type="text" value="0.00" id="total" readonly="">
                                            </h4>
                            </div>
                                </div>

                                <div class="panel-footer">
                                    <button class="btn btn-primary negrita pull-right" type="button" id="cobrar" >
                                        <i class="fa fa-money"></i> Cobrar
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12">
                            <div class="table-responsive">
                                <table class="table table-striped detalle-producto">
                                    <thead>
                                        <th>Cant</th>
                                        <th>Codigo</th>
                                        <th>Descripcion</th>
                                        <th>Precio Und</th>
                                        <th>Sub Total</th>
                                        <th></th>
                                    </thead>
                                    <tbody id="detalle-venta">


                                    </tbody>

                                </table>
                            </div>

                        </div>

                </div>
            </div>
            </div>
        </div>
        </div>
</section>

<?php include VIEWS.'/ventas/helpers/scripts.php'; ?>
