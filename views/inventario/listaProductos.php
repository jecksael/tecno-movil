<?php include VIEWS.'/inventario/field/modalProductoEdit.php'; ?>
<link rel="stylesheet" href="/js/data-table/dataTables.bootstrap.css">
<script src="/js/data-table/dataTables.min.js"></script>
<script src="/js/data-table/dataTables.bootstrap.min.js"></script>
<body>

    <section id="prove-product-cat-config">
        <div class="container">
            <div class="page-header">
              <h1>Panel de administración de Productos <small><?php echo EMPRESA; ?></small></h1>
            </div>
            <?php
                if (!empty($msg)) { $msg->display(); }
            ?>
            <!-- Nav tabs -->


            <div class="tab-content">

                <!--LISTA DE PRODUCTOS-->
                <div role="tabpanel" class="tab-pane fade in active" id="lisProductos">
                    <div class="row">

                    <div class="col-xs-12">
                        <br><br>

                        <div id="adm-reparacion">
                            <div class="text-primary text-center"><h1>Listado de Productos</h1></div>
                          <div class="table-responsive">
                            <form action="/inventario/editMarca" method="POST" id="form-update-marca"></form>

                              <table width="100%" class="table table-bordered" id="tableProductos" style="margin-right: 0; margin-left: 0">
                                  <thead class="text-center">
                                      <tr>
                                        <th>Codigo</th>
                                        <th>Descripción</th>
                                        <th>Marca</th>
                                        <th>Stock</th>
                                        <?php if ($_SESSION["id"] == 1) {?><th>P. Compra</th> 
                                        <th>% de Ganancia</th><?php }?>
                                        <th>P. Venta</th>
                                        <?php if ($_SESSION['id'] == 1) {?>
                                        <th>Status</th>
                                        <th>Acción</th>
                                        <?php } ?>

                                      </tr>
                                  </thead>

                                  <tbody>
                                    <?php
                                        if(!empty($producto)){
                                            $status = array (1 => 'Activo', 0 => 'Desabilitado');
                                            $class = array(1 => 'btn-success', 0 => 'btn-danger');
                                            foreach ($producto as $key ) {
                                                echo'
                                                <tr  data-id="'.$key->id.'">
                                                    <td>'.$key->cod_pro.'</td>
                                                    <td class="descripcion">'.$key->des_pro.'</td>
                                                    <td>'.$key->marca.'</td>
                                                    <td>'.$key->stock.'</td>';
                                                    if ($_SESSION['id'] == 1){ echo '
                                                    
                                                    <td>'.$key->pre_com.'</td>
                                                    <td>'.$key->porc_pro.'</td> '; } echo '
                                                   
                                                    <td>'.$key->pre_ven.'</td>';
                                                    if ($_SESSION['id'] == 1){ echo '
                                                    <td> <button class="cursor-none btn btn-xs '.$class[$key->status].'"> '.$status[$key->status].'</button></td>
                                                    <td><button type="button" data-toggle="modal" data-target="#editPro" class="btn-edit-producto btn btn-sm btn-primary"
                                                        data-id="'.$key->id.'"
                                                        data-cod="'.$key->cod_pro.'"
                                                        data-des="'.$key->des_pro.'"
                                                        data-mar="'.$key->marca_id.'"
                                                        data-stock="'.$key->stock.'"
                                                       
                                                        data-porc="'.$key->porc_pro.'"
                                                        data-precio2="'.$key->pre_ven.'"
                                                        data-stat="'.$key->status.'"
                                                        data-img ="'.$key->url_imagen.'">
                                                        <i class="fa fa-edit"></i> </button>
                                                        <button class="btn-remove-producto btn btn-sm btn-danger">
                                                        <i class="fa fa-trash"></i> </button>
                                                    </td>
                                                    ';} echo '

                                                </tr>

                                                ';
                                            }
                                        }

                                    ?>

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
</body>
<style type="text/css">
    .descripcion{
        text-transform: uppercase;
    }
</style>
<?php include VIEWS.'/inventario/partials/scripts.php';  ?>
