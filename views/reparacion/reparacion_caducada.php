<?php include VIEWS.'/reparacion/modal/detalle_reparacion.php'; ?>
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
                            <i class="fa fa-calendar-times-o fa-4x"></i>
                            <h1>Reparaciones caducadas</h1>
                        </div>

                        <div class="text-center col-xs-12 ">
                        <div class="table-responsive">
                            <?php if(isset($result)){ ?>
                            <table class="table">
                                <th>N#</th>
                                <th>Fecha</th>
                                <th>Cliente</th>
                                <th>Técnico</th>
                                <th>Servicio</th>
                                <th>Status</th>
                                <th>Monto</th>
                                <th>Acción</th>

                                <tbody>

                                    <?php $statusClass = array (1 => 'btn-warning', 2 => 'btn-success', 3 => 'btn-danger');
                                    if(!empty($result)){
                                     foreach ($result as $key => $value) {
                                        $fecha = substr($value->created_at, 0,10);
                                        echo '
                                        <tr data-id ="'.$value->id.'">
                                            <td>'.$value->id.'</td>
                                            <td>'.$fecha.'</td>
                                            <td>'.$value->nom_cli.'</td>
                                            <td>'.$value->nombre.'</td>
                                            <td>'.$value->servicio.'</td>
                                            <td>
                                            <button class="cursor-none btn btn-xs '.$statusClass[$value->status_id].'">'.$value->status.'</button></td>
                                            <td>'.$value->total.'</td>
                                            <td>
                                            <i class="btn-detalle cursor-pointer fa fa-list-alt fa-2x" title="ver detalles" style="color:#2494bd"></i> &nbsp;
                                            <i class="btn-entrega cursor-pointer fa fa-share-square-o fa-2x" title="entregar" style="color:orange"></i>
                                            </td>

                                        </tr>

                                        ';
                                    }
                                }else {
                                    echo '<tr>
                                        <td class="text-center" colspan="8">No se encontraron reparaciones caducadas</td>
                                        </tr>';
                                }
                                     ?>


                                </tbody>
                            </table>
                            <?php } ?>
                        </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>

    </section>
</body>

<?php  include VIEWS.'/reparacion/helpers/scriptsReporte.php'; ?>
