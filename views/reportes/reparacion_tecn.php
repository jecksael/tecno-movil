
<body>
<section id="prove-product-cat-config">
<div class="container">
    <div class="page-header">
        <h1>Panel de Reportes <small><?php echo EMPRESA; ?></small></h1>
    </div>
    <?php if (!empty($this->msg->hasMessages())) { $this->msg->display(); }
    ?>


    <div class="row">
        <div class="col-xs-12">
            <br>
            <div id="reportes">
                <div class="col-sm-12">
                     <div class="text-center text-primary"><i class="fa fa-5x fa-calendar"></i></div>
                        <form action="/reporte/reporte_reparacion_tecn" method="POST" >
                            <div class="form-group col-sm-offset-3 col-sm-3">
                                <label>Desde:</label>
                                <input  type="date" name="desde" id="desde" max="<?php echo date('Y-m-d') ?>" class="date-picker form-control"  required="">
                            </div>

                            <div class="form-group  col-sm-3">
                                <label class="">Hasta:</label>
                                <input  type="date" name="hasta" id="hasta" min="<?php echo date('Y-m-d') ?>" class="date-picker form-control"  required="">
                            </div>

                            <div class="text-center form-group col-sm-12">
                                <button type="submit" class="btn btn-primary">Buscar</button>
                            </div>

                        </form>
                </div>
            <!-- REPORTE X TECNICOS -->
                    <div class="col-xs-12">
                <?php if(isset($result)){
                    if(!empty($result)){?>
                        <div class="table-responsive">
                            <table class="table">
                                <th>N#</th>
                                <th>Entregado</th>
                                <th>Cliente</th>
                                <th>Equipo</th>
                                <th>Marca</th>
                                <th>Modelo</th>
                                <th>Servicio</th>
                                <th>Status</th>
                                <th>Monto</th>
                                <tbody>
                                <?php
                                $statusClass = array (1 => 'btn-warning', 2 => 'btn-success', 3 => 'btn-danger');
                                foreach ($result as $key => $value) {
                                    $fecha = substr($value->update_at, 0,10);
                                    echo '
                                    <tr>
                                        <td>'.$value->id.'</td>
                                        <td>'.$fecha.'</td>
                                        <td>'.$value->nom_cli.'</td>
                                        <td>'.$value->equipo.'</td>
                                        <td>'.$value->marca.'</td>
                                        <td>'.$value->modelo.'</td>
                                        <td>'.$value->servicio.'</td>
                                        <td>
                                            <button class="btn '.$statusClass[$value->status_id].' btn-xs">'.$value->status.'</button>
                                        </td>';?>
                                    <?php if($value->status_id == 2){
                                        echo '<td class="monto">'.$value->monto_serv.'</td>';
                                    }
                                    if($value->status_id == 3){
                                        echo '<td class="monto">0.00</td>';
                                    }?>
                                    <?php echo '</tr> ';
                                }

                                ?>
                                </tbody>
                                <tr>
                                    <th colspan="7"><b class="pull-right">TOTAL:</b></th>
                                    <th><b class="total"></b></th>
                                </tr>
                                <tr>
                                    <th colspan="7"><b class="pull-right">DEDUCCIÓN:</b></th>
                                    <th><select class="deduccion form-control">
                                        <?php for ($i=10; $i<=100 ; $i+=5) {
                                        echo '<option value="'.$i.'">'.$i.'%</option>';
                                    } ?></select></th>
                                </tr>
                                <tr>
                                    <th colspan="7"><b class="pull-right">PAGO A TECNICO:</b></th>
                                    <th><b class="pago"></b></th>
                                </tr>

                            </table>
                        </div>

                    </div>

                   <?php }
                   else {

                   echo '<div class="page-header text-center"><h1>No se encontraron resultados </h1></div>';
                   }
                }

/*
        Reporte ALL
 */
            if(isset($result2)){
                if(!empty($result2)){?>
                    <div class="col-xs-12">
                        <div class="table-responsive">
                            <table class="table">
                                <th>N#</th>
                                <th>Entregado</th>
                                <th>Cliente</th>
                                <th>Tecnico</th>
                                <th>Equipo</th>
                                <th>Marca</th>
                                <th>Modelo</th>
                                <th>Servicio</th>
                                <th>Status</th>
                                <th>Monto</th>
                                <?php
                                $statusClass = array (1 => 'btn-warning', 2 => 'btn-success', 3 => 'btn-danger');
                                foreach ($result2 as $key => $value) {
                                    $fecha = substr($value->update_at, 0,10);
                                    echo '
                                    <tr>
                                        <td>'.$value->id.'</td>
                                        <td>'.$fecha.'</td>
                                        <td>'.$value->nom_cli.'</td>
                                        <td>'.$value->nombre.'</td>
                                        <td>'.$value->equipo.'</td>
                                        <td>'.$value->marca.'</td>
                                        <td>'.$value->modelo.'</td>
                                        <td>'.$value->servicio.'</td>
                                        <td>
                                            <button class="btn '.$statusClass[$value->status_id].' btn-xs">'.$value->status.'</button>
                                        </td>'?>
                                        <?php if($value->status_id == 2){
                                        echo '<td class="monto">'.$value->monto_serv.'</td>';
                                        }
                                        if($value->status_id == 3){
                                        echo '<td class="monto">0.00</td>';
                                    }?>
                                        <?php echo '</tr>';
                                }
                                echo '<tr>
                                            <th colspan="8"><b class="pull-right">TOTAL:</b></th>
                                            <th><b class="total"></b></th>
                                        </tr>
                                        <tr>
                                            <th colspan="8"><b class="pull-right">DEDUCCIÓN:</b></th>
                                            <th><select class="deduccion form-control" >';
                                            for($i=10; $i<=100; $i+=10){
                                                echo '<option value="'.$i.'">'.$i.'</option>';

                                            }
                                            echo '</select>
                                        </tr>
                                        <tr>
                                            <th colspan="8"><b class="pull-right">GANANCIA:</th>
                                            <th><b class="pago" ></b></th>
                                        </tr>';

                                 ?>
                            </table>
                        </div>
                    </div>
               <?php }
               else {
                echo '<div class="page-header text-center"><h1>No se encontraron resultados </h1></div>';
               }
            }
                ?>
            </div>
        </div>
    </div>
</div>
</section>
</body>
<script>
    $(document).ready(function(){

        var total=0;
        $(".monto").each(function() {
        total+=parseFloat($(this).text());
        });
        total = number_format(total,2)
        $(".total").text(total);

        $(".deduccion").change(function(){
            var ded = 0;
            ded = $(".deduccion").val()
            var total = $(".total").text()
            total = total.replace(/,/gi,"")
            var pago = total - (total*ded)/100
            pago = number_format(pago,2)
            $(".pago").text(pago)


        })
    })
</script>
