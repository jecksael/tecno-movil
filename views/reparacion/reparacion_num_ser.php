<body>
    <section id="prove-product-cat-config">
        <div class="container">
            <div class="page-header">
                <h1>Panel de administración de Reparaciones <small class="tittles-pages-logo"><?php echo EMPRESA ?></small></h1>
            </div>
            <?php if (!empty($this->msg->hasMessages())) { $this->msg->display(); }
            include VIEWS.'/reparacion/helpers/navegacion.php';
            ?>

            <div class="row">
                <br>
                <div class="col-xs-12">
                    <div id="adm-reparacion">
                        <div class="text-primary text-center">
                            <i class="fa fa-list-alt fa-4x"></i>
                        </div>
                        <div class="form-group col-sm-offset-4 col-sm-4">
                            <form action="/reparacion/busca_reparacion_num_ser" method="post">
                                <input type="text" class="number form-control" name="id" placeholder ="Numero de servicio" maxlength="10" required="">
                                <br>
                                <p class="text-center">
                                    <button type="submit" class="btn btn-primary">Buscar</button>
                                </p>
                            </form>
                        </div>
                        <div class="text-center col-xs-12 col-sm-8">
                        <div class="table-responsive ">
                            <?php if(isset($result)){ foreach ($result as $key => $value) {

                            }
                            $statusClass = array (1 => 'btn btn-warning btn-xs', 2 => 'btn btn-success btn-xs' ,3 => 'btn btn-danger btn-xs');
                            $ced = array(1=> 'V-', 2 => 'E-');
                            $genero = array('M' => 'Masculino', 'F' => 'Femenino');

                            ?>
                            <table class="table table-bordered table-condensed table-striped " style="font-size: 12px; ">
                                <thead class="bg-primary">
                                    <th colspan="2">Datos de la Reparación</th>
                                </thead>
                                <tr>
                                    <th>Numero de Servicio</th>
                                    <td><?php echo $value->id ?></td>
                                </tr>
                                <tr>
                                    <th>Fecha y Hora</th>
                                    <td><?php echo $value->created_at ?></td>
                                </tr>

                                <tr>
                                    <th>Técnico</th>
                                    <td><?php echo $value->nombre ?></td>
                                </tr>

                                <tr>
                                    <th>Equipo</th>
                                    <td><?php echo $value->equipo ?></td>
                                </tr>

                                <tr>
                                    <th>Servicio</th>
                                    <td><?php echo $value->servicio ?></td>
                                </tr>

                                <tr>
                                    <th>Detalle del Servicio</th>
                                    <td><?php echo $value->detalle_serv ?></td>
                                </tr>

                                <tr>
                                    <th>Marca del Telefono</th>
                                    <td><?php echo $value->marca ?></td>
                                </tr>

                                <tr>
                                    <th>Modelo</th>
                                    <td><?php echo $value->modelo ?></td>
                                </tr>
                                <tr>
                                    <th>Color</th>
                                    <td><?php echo $value->color ?></td>
                                </tr>
                                <tr>
                                    <th>Imei</th>
                                    <td><?php echo $value->imei ?></td>
                                </tr>
                                <tr>
                                    <th>Accesorios Recibidos</th>
                                    <td><?php echo $value->acce_recb ?></td>
                                </tr>
                                <tr>
                                    <th>Monto del Servicio</th>
                                    <td><?php echo $value->monto_serv ?></td>
                                </tr>
                                <tr>
                                    <th>Tipo de Pago</th>
                                    <td><?php echo $value->pago ?></td>
                                </tr>
                                <?php if($value->pago_id == 3){
                                    echo '<tr>
                                    <th>Numero de Referencia</th>
                                    <td>'.$value->referencia.'</td>
                                    </tr>';
                                } ?>
                                <tr>
                                    <th>Monto Total</th>
                                    <td><?php echo $value->total ?></td>
                                </tr>
                                <tr>
                                    <th>Status del Telefono</th>
                                    <td>
                                        <button class="<?php echo $statusClass[$value->status_id] ?> cursor-none"><?php echo $value->status ?></button>
                                    </td>
                                </tr>
                                <?php if($value->entrega_id == 2){

                                    echo '<tr> <th>Fecha de Entrega</th> <td>'.$value->update_at.'</td> </tr>';
                                } ?>
                                <?php if(isset($result2)){ ?>
                                <tr>
                                    <th colspan="2" class="bg-primary">
                                        Repuestos Utilizados
                                    </th>
                                </tr>
                                <?php foreach ($result2 as $key => $value2) {
                                    echo '
                                    <tr>
                                        <td>'.$value2->cod_pro.'</td>
                                        <td>'.$value2->des_pro.' <span class="pull-right">'.$value2->pre_ven.'</span></td>

                                    </tr>
                                    ';
                                } ?>

                                <?php } ?>
                            </table>
                        </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="table-responsive ">
                                <table class="table  table-bordered table-condensed table-striped" style="font-size: 12px;">
                                    <thead class="btn-primary">
                                        <th colspan="2">Datos del Cliente</th>
                                    </thead>

                                    <tr>
                                        <th>Cedula</th>
                                        <td><?php echo $ced[$value->nac_id].''.$value->ced_cli ?></td>
                                    </tr>
                                    <tr>
                                        <th>Nombres</th>
                                        <td><?php echo $value->nom_cli ?></td>
                                    </tr>
                                    <tr>
                                        <th>Apellidos</th>
                                        <td><?php echo $value->ape_cli ?></td>
                                    </tr>

                                    <tr>
                                        <th>Genero</th>
                                        <td><?php echo $genero[$value->gen_cli] ?></td>
                                    </tr>
                                    <tr>
                                        <th>Dirección</th>
                                        <td><?php echo $value->dir_cli ?></td>
                                    </tr>
                                    <tr>
                                        <th>Telefono</th>
                                        <td><?php echo $value->telf_cli ?></td>
                                    </tr>
                                </table>
                            <p class="text-center">
                                <?php if ($_SESSION['cargo']!=3){
                                 if($value->status_id == 1 AND $value->entrega_id==1){
                                    echo '<button data-id="'.$value->id.'" id="btn-change-status" class="btn btn-success">
                                    <i class="fa fa-exchange"></i> Cambiar Status</button>';
                                }}
                                if($value->status_id != 1 AND $value->entrega_id == 1){
                                    echo '<button data-id="'.$value->id.'" id="btn-entrega" class="btn btn-success">
                                    <i class="fa fa-share-square-o"></i> Entregar</button>';
                                }
                                if($value->entrega_id == 2){
                                    echo '<button class="cursor-none btn btn-success">
                                    <i class="fa fa-check-square-o"></i> Entregado</button>';
                                }
                                if($value->entrega_id == 3){
                                   echo '<button class="btn btn-danger">
                                    <i class="fa fa-clock-o"></i> Caducado</button>';
                                }
                                 ?>

                            </p>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div>

        </div>

    </section>
</body>
<!--/////// MODAL DE CAMBIO DE STATUS //////////-->
<div class="modal fade" id="modal-status-reparacion">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Status de Reparación</h4>
            </div>
            <div class="modal-body">
                <input type="hidden" id="id_reparacion">
                <select class="form-control" id="status_reparacion">
                    <option value="2">Reparado</option>
                    <option value="3">Sin Arreglo</option>
                </select>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"> Cancelar</button>
                <button type="button" id="submit-change-status" class="btn btn-primary">Cambiar Status</button>
            </div>
        </div>
    </div>
    <!-- FIN DE MODAL -->
</div>
<script>
    $(document).ready(function(){

        /// ENTREGAR EL EQUIPO
    $("#btn-entrega").click(function(){
        var id = $("#btn-entrega").data('id')
        var data = {'id':id, 'status_id':2}
        var url = '/reparacion/update_status_entrega'
        swal({
            title:'Estas Seguro?',
            text:'Desea Entregar el Equipo',
            type:'info',
            showCancelButton: true,
            cancelButtonText:'No, Gracias',
            confirmButtonClass: "btn-success",
            confirmButtonText: "Si!",
            closeOnConfirm: false
        },function(isConfirm){
            if(isConfirm){
                $.post(url,data, function(result){
                    if(result == true){
                        swal({
                            title:'Ok',
                            text:'Equipo Entregado ..!',
                            type:'success'
                        },function(){
                            location.reload()
                        })
                    }
                    else{
                        swal('Error', 'Lo sentimos ha ocurrido un error..!!', 'error')
                    }
                }).fail(function(){
                    swal('Error', 'Lo sentimos ha ocurrido un error..!!', 'error')
                })
            }
        })
    })
    /// ABRIR MODAL DE CAMBIO DE STATUS
    $("#btn-change-status").click(function(){
        var id = $("#btn-change-status").data('id')
        $("#id_reparacion").val(id)
        $("#modal-status-reparacion").modal('show')

    })
    /// CAMBIAR EL STATUS //
    $("#submit-change-status").click(function(){
        var id = $("#id_reparacion").val()
        var status = $("#status_reparacion").val()
        var url = '/reparacion/update_status_reparacion'
        var data = {'id':id, 'status':status}
        $("#modal-status-reparacion").modal('hide')
        swal({
            title:'Estas Seguro?',
            text:'Desea Cambiar el Status del Servicio',
            type:'info',
            showCancelButton: true,
            cancelButtonText:'No, Gracias',
            confirmButtonClass: "btn-success",
            confirmButtonText: "Si!",
            closeOnConfirm: false
        },function(isConfirm){
            if(isConfirm){
                $.post(url,data,function(result){

                    if(result ==  true){
                        swal({
                            title:'Ok',
                            text:'Status Modificado ..!',
                            type:'success'
                        },function(){
                           location.reload()
                        })
                    }
                    else{swal('Error', 'Lo sentimos ha ocurrido un error..!!', 'error')
                    }
                }).fail(function(){
                    swal({
                        title:'Error',
                        text:'Lo sentimos ha ocurrido un error..!!',
                        type:'error'
                    },function(){
                        location.reload()
                    })
                })
            }

        })
    })


    })
</script>
