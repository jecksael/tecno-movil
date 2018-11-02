<?php ob_start(); ?>
<?php
    $nac = array(1 => 'V-', 2 => 'E-');
    $id = $repa[0]->id;
    $fecha = substr($repa[0]->created_at, 0,10);
    $hora = substr($repa[0]->created_at, 11,15);
    $tecnico = $repa[0]->nombre.' '.$repa[0]->apellido;
    $nom_cli = $repa[0]->nom_cli;
    $apellido = $repa[0]->ape_cli;
    $nac_id = $repa[0]->nac_id;
    $dir_cli = $repa[0]->dir_cli;
    $ced_cli = $repa[0]->ced_cli;
    $telf_cli = $repa[0]->telf_cli;
    $marca = $repa[0]->marca;
    $modelo = $repa[0]->modelo;
    $imei = $repa[0]->imei;
    $servicio = $repa[0]->servicio;
    $detalle = $repa[0]->detalle_serv;
    $accesorio = $repa[0]->acce_recb;
    $monto = $repa[0]->monto_serv.' BF';
    $total = $repa[0]->total.' BF';
 ?>
<div id="general">
    <div id="repa1">
        <table class="table">
            <tr>
                <!-- DATOS DE LA EMPRESA -->
                <th colspan="3">
                <img id="img1" src="<?php echo '../public/imagenes/'.LOGO ?>" alt="">
                <img id="img2" src="<?php echo '../public/imagenes/'.LOGO ?>" alt="">
                    <?php echo EMPRESA ?> <br>
                    <?php echo DIR_EMPRESA ?> <br>
                    <?php echo RIF ?> <br>
                  <!--  <?php echo TELF_EMPRESA ?> -->  
                  <br>
                </th>
            </tr>
            <tr>
                <td colspan="3" align="center" > <b>Recibo Tecnico </b></td>
            </tr>
            <!-- DATOS DEL SERVICIO -->
            <tr>
                <td>
                    <b>N# de Servicio:</b> <?php echo $id ?>
                </td>
                <td colspan="2">
                    <b>Fecha:</b> <?php echo $fecha ?> <b>Hora:</b> <?php echo $hora ?>
                </td>
            </tr>

            <!-- DATOS DEL TECNICO -->
             <tr>
                <td colspan="3">
                    <b>Tecnico:</b> <?php echo $tecnico ?>
                </td>
             </tr>

             <!-- DATOS DEL CLIENTE -->
            <tr>
                <td colspan="2">
                    <b>Cliente:</b> <?php echo $nom_cli." ". $apellido ?>
                </td>
                <td>
                    <b>C.I:</b> <?php echo $nac[$nac_id].$ced_cli ?>
                </td>
                 

            
            </tr>
            <tr>
                <td colspan="2">
                    <b>Domicilio:</b> <?php echo $dir_cli ?>
                </td>
                <td>
                    <b>Telefono:</b> <?php echo $telf_cli ?>
                </td>                
            </tr>
            <!-- DATOS DE LA REPARACION -->
            <tr>
                <th colspan="3">Datos de la Reparacion</th>
            </tr>
            <tr>
                <td>
                    <b>Marca:</b> <?php echo $marca ?>
                </td>
                <td>
                    <b>Modelo:</b> <?php echo $modelo ?>
                </td>
                <td>
                    <b>Imei:</b> <?php echo $imei ?>
                </td>
            </tr>

            <tr>
                <td colspan="3">
                    <b>Servicio:</b> <?php echo $servicio ?>
                </td>
            </tr>
            <tr>
                <td colspan="3">
                    <b>Detalle del Servicio:</b> <?php echo $detalle ?>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <b>Accesorios Recibidos:</b> <?php echo $accesorio ?>
                </td>
                <td>
                    <b>Monto del Servicio:</b> <br> <?php echo $monto ?>
                </td>
            </tr>

            <!-- REPUESTOS -->
            <?php if(isset($repu)){
                echo '  <tr>
                            <td colspan="3" align="center"><b>Repuestos</b></td>
                        </tr>
                        <tr align="center">
                            <td>
                                <b>Codigo</b>
                            </td>
                            <td>
                                <b>Descripcion</b>
                            </td>
                            <td>
                                <b>Precio</b>
                            </td>
                        </tr>';
                if(!empty($repu)){
                    foreach ($repu as $key => $value) {
                        echo '<tr align="center">
                        <td>'.$value->cod_pro.'</td>
                        <td>'.$value->des_pro.'</td>
                        <td>'.$value->pre_ven.' BF</td>

                        </tr>';
                    }
                }
            } ?>
            <!-- CONDICIONES -->
            <tr>
                <td colspan="3">
                    <b>Condiciones: 1-</b> Para retirar el equipo es necesario la orden de reparacion. <br>
                    <b>2-</b> Los equipos mojados no tienen garantia. <br>
                    <b>3-</b> <?php echo EMPRESA ?> no se hace responsable por la perdidao extravio del equipo pasado los 15 dias de la fecha de ingreso. <br>
                    <b>4-</b> El cliente declara que conoce y acepta los terminos y da autorizacion para repara el equipo, en fe de la cual firma.
                </td>
            </tr>
            <tr>
                <td colspan="3">
                    <b>Total a Pagar:</b> <?php echo $total ?>
                </td>
            </tr>
            <tr>
                <td colspan="2" align="center">
                    <br>
                    _________________________
                    <br>
                    Firma del Cliente
                </td>
                <td align="center">
                    <br>
                    <br>
                    <br>
                    Pulgar Derecho
                </td>
            </tr>

        </table>
    </div>

    <!-- RECIBO NUMERO 2 -->

    <div id="repa2">
        <table class="table">
            <tr>
                <!-- DATOS DE LA EMPRESA -->
                <th colspan="3">
                <img id="img1" src="<?php echo '../public/imagenes/'.LOGO ?>" alt="">
                <img id="img2" src="<?php echo '../public/imagenes/'.LOGO ?>" alt="">
                    <?php echo EMPRESA ?> <br>
                    <?php echo DIR_EMPRESA ?> <br>
                    <?php echo RIF ?> <br>
                    <!-- <?php echo TELF_EMPRESA ?> -->
                    <br>
                </th>
            </tr>
            <tr>
                <td colspan="3" align="center" > <b>Recibo Cliente </b></td>
            </tr>
            <!-- DATOS DEL SERVICIO -->
            <tr>
                <td>
                    <b>N# de Servicio:</b> <?php echo $id ?>
                </td>
                <td colspan="2">
                    <b>Fecha:</b> <?php echo $fecha ?> <b>Hora:</b> <?php echo $hora ?>
                </td>
            </tr>

            <!-- DATOS DEL TECNICO -->
             <tr>
                <td colspan="3">
                    <b>Tecnico:</b> <?php echo $tecnico ?>
                </td>
             </tr>

             <!-- DATOS DEL CLIENTE -->
            <tr>
                <td colspan="2">
                    <b>Cliente:</b> <?php echo $nom_cli." ".$apellido ?>
                </td>
                <td>
                    <b>C.I:</b> <?php echo $nac[$nac_id].$ced_cli ?>
                </td>

            </tr>
            <tr>
                <td colspan="2">
                    <b>Domicilio:</b> <?php echo $dir_cli ?>
                </td>
                <td>
                    <b>Telefono:</b> <?php echo $telf_cli ?>
                </td>                
            </tr>
            <!-- DATOS DE LA REPARACION -->
            <tr>
                <th colspan="3">Datos de la Reparacion</th>
            </tr>
            <tr>
                <td>
                    <b>Marca:</b> <?php echo $marca ?>
                </td>
                <td>
                    <b>Modelo:</b> <?php echo $modelo ?>
                </td>
                <td>
                    <b>Imei:</b> <?php echo $imei ?>
                </td>
            </tr>

            <tr>
                <td colspan="3">
                    <b>Servicio:</b> <?php echo $servicio ?>
                </td>
            </tr>
            <tr>
                <td colspan="3">
                    <b>Detalle del Servicio:</b> <?php echo $detalle ?>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <b>Accesorios Recibidos:</b> <?php echo $accesorio ?>
                </td>
                <td>
                    <b>Monto del Servicio:</b> <br> <?php echo $monto ?>
                </td>
            </tr>

            <!-- REPUESTOS -->
            <?php if(isset($repu)){
                echo '  <tr>
                            <td colspan="3" align="center"><b>Repuestos</b></td>
                        </tr>
                        <tr align="center">
                            <td>
                                <b>Codigo</b>
                            </td>
                            <td>
                                <b>Descripcion</b>
                            </td>
                            <td>
                                <b>Precio</b>
                            </td>
                        </tr>';
                if(!empty($repu)){
                    foreach ($repu as $key => $value) {
                        echo '<tr align="center">
                        <td>'.$value->cod_pro.'</td>
                        <td>'.$value->des_pro.'</td>
                        <td>'.$value->pre_ven.' BF</td>

                        </tr>';
                    }
                }
            } ?>
            <!-- CONDICIONES -->
            <tr>
                <td colspan="3">
                    <b>Condiciones: 1-</b> Para retirar el equipo es necesario la orden de reparacion. <br>
                    <b>2-</b> Los equipos mojados no tienen garantia. <br>
                    <b>3-</b> <?php echo EMPRESA ?> no se hace responsable por la perdidao extravio del equipo pasado los 15 dias de la fecha de ingreso. <br>
                    <b>4-</b> El cliente declara que conoce y acepta los terminos y da autorizacion para repara el equipo, en fe de la cual firma.
                </td>
            </tr>
            <tr>
                <td colspan="3">
                    <b>Total a Pagar: </b> <?php echo $total; ?>
                </td>
            </tr>
            <tr>
                <td colspan="2" align="center">
                    <br>
                    _________________________
                    <br>
                    Firma del Cliente
                </td>
                <td align="center">
                    <br>
                    <br>
                    <br>
                    Pulgar Derecho
                </td>
            </tr>

        </table>
    </div>
</div>

<style>

/*.table th {
    background-color: black;
    color: white;
}*/
#img1{
    float: left
}
#img2{
    float: right;
}
#cuadro{
    margin-left: 45px;
    border: 1px solid;
    height: 50px;
    width: 50px;
}
#general {
    width: 100%
}
#repa1{
    width: 50%;
    float: left;
    margin-left: 380px
}
#repa2{
    width: 50%;
}
.table, th, td {
    border-collapse: collapse;
    font-size: 11px;
}
.table , tr , td{
    border-collapse: collapse;
    border: 1px solid;
}
</style>
