<div class="modal fade" id="listPro" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg ">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h1 class="text-primary"> Lista de Productos</h1>
            </div>

            <div class="modal-body">
            <div class="row">
                <div role="tabpanel" class="tab-pane fade in active" id="lisProductos">
                    <div class="col-xs-12">
                          <div class="table-responsive">
                            <form action="/inventario/editMarca" method="POST" id="form-update-marca"></form>

                              <table width="100%" class="table table-bordered" id="tableProductos" style="margin-right: 0; margin-left: 0">
                                  <thead class="text-center">
                                      <tr>
                                        <th>Codigo</th>
                                        <th>Descripción</th>
                                        <th>Marca</th>
                                        <th>Stock</th>
                                        <th>P. Venta</th>
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
                                                    <td>'.$key->des_pro.'</td>
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
                                                        data-pre1="'.$key->pre_com.'"
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

            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>
