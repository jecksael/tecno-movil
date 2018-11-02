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
                            <i class="fa fa-mobile fa-4x"></i>
                            <h1>Reparaciones por Entregar</h1>
                        </div>
                        <div class="col-sm-12">
                        <div class="table-responsive">
                            <table class="table">
                                <th>N#</th>
                                <th>Fecha</th>
                                <th>Cliente</th>
                                <th>Técnico</th>
                                <th>Equipo</th>
                                <th>Servicio</th>
                                <th>Status</th>
                                <th>Monto</th>
                                <th>Acción</th>

                                <tbody>

                                    <?php if(isset($result)){
                                      if(!empty($result)){
                                        foreach ($result as $key => $value) {
                                            $status = array( 2 => 'btn-success btn-xs', 3 => 'btn-danger btn-xs' );
                                            $fecha = substr($value->created_at, 0,10);
                                            echo '<tr data-id="'.$value->id.'">
                                            <td>'.$value->id.'</td>
                                            <td>'.$fecha.'</td>
                                            <td>'.$value->nom_cli.'</td>
                                            <td>'.$value->nombre.'</td>
                                            <td>'.$value->equipo.'</td>
                                            <td>'.$value->servicio.'</td>
                                            <td>
                                                <button class="cursor-none btn '.$status[$value->status_id].'">
                                                    '.$value->status.'
                                                </button>
                                            </td>
                                            <td>'.$value->total.'</td>
                                            <td>
                                                <i class="btn-detalle cursor-pointer fa fa-list-alt fa-2x" title="ver detalles" style="color:#2494bd"></i> &nbsp;
                                                <i class="btn-entrega cursor-pointer fa fa-share-square-o fa-2x" title="entregar" style="color:orange"></i>
                                            </td>
                                            </tr>';
                                        }

                                    }
                                    else{
                                        echo '<tr>
                                        <td class="text-center" colspan="8">No se encontraron reparaciones por entregar</td>
                                        </tr>';
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
<?php
    /*
    INLUIMOS EL HELPER PARA CARGAR LOS DETALLES DE LA REPARACION
     */
 include VIEWS.'/reparacion/helpers/scriptsReporte.php'; ?>

<script>

</script>
