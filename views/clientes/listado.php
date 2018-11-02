<link rel="stylesheet" href="/js/data-table/dataTables.bootstrap.css">
<body>
<section id="prove-product-cat-config">
<div class="container">
    <div class="page-header">
        <h1>Panel de administración de Clientes <small><?php echo EMPRESA; ?></small></h1>
    </div>
                <?php if (!empty($this->msg->hasMessages())) { $this->msg->display(); }
                 include VIEWS.'/clientes/partials/navegacion.php'; ?>
                <div role="tabpanel" class="tab-pane fade <?php if($menu == 2){echo 'in active';}else{echo '';} ?> " id="lisCliente">
                    <div class="row">

                    <div class="col-xs-12">
                        <br><br>
                        <div id="adm-reparacion">
                            <div class="text-primary text-center"><i class="fa fa-user fa-2x"></i><h1>Listado de Clientes</h1></div>
                          <div class="table-responsive">

                              <table width="100%" class="table table-bordered" id="tableClientes" style="margin-right: 0; margin-left: 0">
                                  <thead class="text-center">
                                      <tr>
                                        <th>Cedula</th>
                                        <th>Nombres</th>
                                        <th>Apellidos</th>
                                        <th>Direccion</th>
                                        <th>Telefono</th>
                                        <th>Acción</th>

                                      </tr>
                                  </thead>

                                  <tbody>
                                    <?php
                                        if(!empty($cliente)){
                                            foreach ($cliente as $key ) {
                                                echo'
                                                <tr class=""  data-id="'.$key->id.'">
                                                    <td>'.$key->nacionalidad.''.$key->ced_cli.'</td>
                                                    <td>'.$key->nom_cli.'</td>
                                                    <td>'.$key->ape_cli.'</td>
                                                    <td>'.$key->dir_cli.'</td>
                                                    <td>'.$key->telf_cli.'</td>
                                                    <td><div class="btn-action-cliente"><button class="btn-edit-cliente btn btn-sm btn-primary">
                                                        <i class="fa fa-edit"></i> </button>
                                                        <button class="btn-remove-cliente btn btn-sm btn-danger">
                                                        <i class="fa fa-trash"></i> </button></div>
                                                    </td>
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
</section>
</body>
<?php include VIEWS.'/clientes/partials/scripts.php';  ?>
