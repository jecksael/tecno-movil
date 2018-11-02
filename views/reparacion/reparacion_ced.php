<?php
include VIEWS.'/reparacion/modal/detalle_reparacion.php';
include VIEWS.'/reparacion/modal/status_reparacion.php';
?>
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
                            <i class="fa fa-drivers-license-o fa-4x"></i>
                        </div>

                        <div class="form-group col-sm-offset-4 col-sm-4">
                            <form action="/reparacion/busca_reparacion_ced" method="post">
                                <select name="nac_id" id="" class="form-control" style="width: 20%;float: left">
                                    <option value="1">V-</option>
                                    <option value="2">E-</option>
                                </select>
                                <input type="text" class="number form-control" name="ced_cli" placeholder ="cedula del cliente" maxlength="10" style="width: 80%" required="">
                                <br>
                                <p class="text-center">
                                    <button type="submit" class="btn btn-primary">Buscar</button>
                                </p>
                            </form>
                        </div>
                        <div class="col-sm-12">
                        <div class="table-responsive">
                        <?php
                        if(isset($result)){ ?>
                            <table class="table" ">
                                <tr class="bg-primary">
                                    <td><b>Cliente:</b> <?php echo $result[0]->nom_cli; ?></td>
                                    <td><b>Direccion:</b> <?php echo $result[0]->dir_cli; ?></td>
                                    <td><b>Telefono:</b> <?php echo $result[0]->telf_cli; ?></td>

                                </tr>
                            </table>

                            <table class="table ">
                                <th>N#</th>
                                <th>Fecha</th>
                                <th>Técnico</th>
                                <th>Equipo</th>
                                <th>Servicio</th>
                                <th>Status</th>
                                <th>Monto</th>
                                <th>Acción</th>

                                <tbody>
                                       <?php if(!empty($result)){
                                        $statusClass = array(1 => 'btn-warning btn-xs', 2 => 'btn-success btn-xs', 3 => 'btn-danger btn-xs');
                                        foreach ($result as $key => $value) {
                                            $fecha = substr($value->created_at, 0,10);
                                            $entrega = substr($value->update_at, 0,10);
                                            echo '
                                            <tr data-id="'.$value->id.'">
                                                <td>'.$value->id.'</td>
                                                <td>'.$fecha.'</td>
                                                <td>'.$value->nombre.'</td>
                                                <td>'.$value->equipo.'</td>
                                                <td>'.$value->servicio.'</td>
                                                <td>
                                                    <button class="cursor-none btn '.$statusClass[$value->status_id].'">
                                                        '.$value->status.'
                                                    </button>

                                                </td>
                                                <td>'.$value->total.'</td> ';
                                                //botones para los equipos q estan en reparacion

                                            if($value->status_id == 1){
                                                echo '<td>
                                                <i class="btn-detalle cursor-pointer fa fa-list-alt fa-2x" title="ver detalles" style="color:#2494bd"></i>&nbsp;';
                                                if($_SESSION['cargo'] !=3){ echo '
                                                <i class="btn-change-status cursor-pointer fa fa-exchange fa-2x" title="cambiar status" style="color:orange"></i>

                                                </td>';}
                                            }
                                            //// botonos para los equipos q fueron reparados pero no entregados
                                            if($value->status_id != 1 AND $value->entrega_id ==1){
                                                echo '<td>
                                                <i class="btn-detalle cursor-pointer fa fa-list-alt fa-2x" title="ver detalles" style="color:#2494bd"></i> &nbsp;
                                                <i class="btn-entrega cursor-pointer fa fa-share-square-o fa-2x" title="entregar" style="color:orange"></i>

                                                </td>';
                                            }
                                            /// botones para equipos reparado y entregados
                                            if($value->status_id != 1 AND $value->entrega_id == 2){
                                                echo '<td>
                                                <i class="btn-detalle cursor-pointer fa fa-list-alt fa-2x" title="ver detalles" style="color:#2494bd"></i> &nbsp;
                                                <i class=" fa fa-check-square-o fa-2x" title="equipo entregado el '.$entrega.'" style="color:green"></i>

                                                </td>';
                                            }

                                            /// botones para equipos
                                            if ($value->entrega_id == 3){
                                                echo '<td>
                                                <i class="btn-detalle cursor-pointer fa fa-list-alt fa-2x" title="ver detalles" style="color:#2494bd"></i> &nbsp;
                                                <i class=" fa fa-clock-o fa-2x" title="equipo caducado" style="color:red"></i>

                                                </td>';
                                            }
                                            echo'
                                            </tr>';

                                        }


                                       }
                                       else{
                                        echo '<tr>
                                        <td class="text-center" colspan="7">No se encontraron reparaciones por realizar</td>
                                        </tr>';
                                       }?>

                                </tbody>
                            </table>

                                    <?php }
                                     ?>
                        </div>
                      </div>

                    </div>
                </div>
            </div>

        </div>

    </section>
</body>

<script>
    $(document).ready(function(){


    })
</script>
<?php include VIEWS.'/reparacion/helpers/scriptsReporte.php'; ?>
