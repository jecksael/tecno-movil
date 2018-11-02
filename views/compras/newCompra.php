<?php
include VIEWS.'/compras/modal/newProveedor.php';
include VIEWS.'/compras/modal/cobro.php';
?>

<body>
<section id="prove-product-cat-config">
<div class="container">
    <div class="page-header">
        <h1>Panel de administración de Compras <small><?php echo EMPRESA; ?></small></h1>
    </div>
        <?php  if (!empty($this->msg->hasMessages())) { $this->msg->display(); }
            //include VIEWS.'/clientes/partials/navegacion.php'; ?>
            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="<?php if($menu == 1){echo 'active';}else {echo '';} ?>">
                    <a href="#" role="tab">Nueva Compra</a>
                </li>
              <li role="presentation"><a href="/proveedor" role="tab">Proveedores</a></li>

            </ul>
        <div role="tabpanel" class="tab-pane fade <?php if($menu == 1){echo 'in active';} else {echo '';}?>" id="newCliente">
        <div class="row">
            <div class="col-xs-12 ">
                <br>
            <div id="add-compra">
            <div class="col-xs-12">
                <div class="panel panel-info">
                    <div class="panel-heading text-center"><h3>Nueva Compra</h3></div>
                </div>
            </div>
                    <div class="col-xs-12 col-sm-8">
                    <div class="panel panel-default">
                        <div class="panel-body">

                            <div class="form-group col-xs-12 col-sm-6">
                                <label>Rif:</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="rif_pro"  name="rif_pro">
                                    <input type="hidden" name="rif_id" id="rif_id">
                                    <span class="input-group-addon cursor-pointer" data-toggle="modal" data-target="#newProveedor">
                                        <i class="fa fa-plus-circle"></i>
                                    </span>
                                </div>
                            </div>


                            <div class="form-group col-sm-6">
                                <label>Nombre del Proveedor:</label>
                                <input type="text" class="form-control" name="nom_pro" readonly="">
                            </div>

                            <div class="form-group col-sm-12">
                                <label>Direccion:</label>
                                <input type="text" class="form-control" name="dir_pro" readonly="">
                            </div>
                                <div class="form-group col-sm-3">
                                    <label>Cod. Producto:</label>
                                    <input type="text" class="form-control" name="cod_pro" placeholder="Codigo">
                                </div>

                            <div class="form-group col-sm-4">
                                <label for="">Descripción:</label>
                                <input type="text" class="form-control" name="des_pro" readonly="">
                                <input type="hidden" name="pre_com">
                            </div>
                            <div class="form-group col-sm-3">
                                <label>Cantidad:</label>
                                <div class="input-group">
                                    <input type="text" name="cantidad" class="number form-control" placeholder="0">
                                    <span class="input-group-addon">UND</span>
                                </div>

                            </div>

                            <div class=" text-center form-group col-sm-2">
                                <img id="add-car"
                                     class="cursor-pointer"
                                     src="<?php echo '/img/carro.png'; ?>" alt="carro">
                            </div>


                        </div>
                    </div>
                     </div>
                        <div class="col-xs-12 col-sm-4">
                            <div class="panel panel-success datos-pago">
                                <div class="panel-heading">
                                    <div class="rows">

                                            <h4 class="col-xs-12 col-sm-4 negrita">B.I.G</h4>
                                            <h4 class="col-sm-8 negrita">
                                               <input name="big" class="form-control text-right" type="text" value="0.00" id="big" readonly="">
                                            </h4>

                                            <h4 class="col-xs-12 col-sm-4 negrita">IVA</h4>
                                            <h4 class="col-sm-8 negrita">
                                               <input name="iva"  class="form-control text-right" type="text" value="0.00" id="iva" readonly="" >
                                            </h4>

                                            <h4 class="col-xs-12 col-sm-4 negrita">TOTAL</h4>
                                            <h4 class="col-sm-8 negrita">
                                               <input class="form-control text-right" type="text" value="0.00" id="total" readonly="" >
                                            </h4>

                                    </div>
                                </div>

                                <div class="panel-footer">
                                    <button class="btn btn-primary negrita pull-right" id="pagar" type="button"  >
                                        <i class="fa fa-money"></i> Pagar
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12">
                            <div class="table-responsive">
                                <table class="table table-striped detalle-producto" id="compra-producto">
                                    <thead>
                                        <th>Cant</th>
                                        <th>Codigo</th>
                                        <th>Descripcion</th>
                                        <th>Precio Und</th>
                                        <th>Sub Total</th>
                                        <th></th>
                                    </thead>
                                    <tbody id="detalle-compra">

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

<?php include VIEWS.'/compras/helpers/scripts.php'; ?>
