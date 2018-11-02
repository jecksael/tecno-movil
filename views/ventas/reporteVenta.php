
<body>
    <section id="prove-product-cat-config">
        <div class="container">
            <div class="page-header">
              <h1>Panel de administración de Ventas <small class="tittles-pages-logo"><?php echo EMPRESA; ?></small></h1>
            </div>
            <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="<?php if($menu == 1){echo 'active';}else {echo '';} ?>">
                    <a href="/venta" role="tab">Nueva Venta</a>
                </li>
                <li role="presentation" class="<?php if($menu == 2){echo 'active';}else {echo '';} ?>">
                    <a href="/venta/reporte" role="tab">Reporte de Ventas</a>
                </li>
            </ul>
            <div class="tab-content">
                <!--==============================Panel productos===============================-->
                <div role="tabpanel" >
                <div class="row">
                    <div class="col-xs-12">
                        <br><br>
                        <div id="bus-factura">
                            <div class="text-center text-primary"><i class="fa fa-5x fa-calendar"></i></div>
                            <form action="/venta/reporte_busca" method="POST" id="form-busca-factura">
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

                            <div class="form-group col-sm-12">
                                <?php if (isset($result)){
                                if($result != ''){  ?>
                                <div class="text-primary text-center"><h2>Reporte de Facturas de Ventas</h2></div>
                                <div class="table-responsive">
                                    <table class="table">
                                        <th>N#</th>
                                        <th>Cliente</th>
                                        <th>Fecha</th>
                                        <th>Total</th>
                                        <th>Accion</th>
                                        <tbody>
                                            <?php foreach ($result as  $value) {
                                                $fecha = substr($value->created_at, 0,10);
                                                echo '
                                                    <tr data-id ="'.$value->id.'">
                                                        <td>'.$value->id.'</td>
                                                        <td>'.$value->nom_cli.'</td>
                                                        <td>'.$fecha.'</td>
                                                        <td>'.$value->total.'</td>
                                                        <td>
                                                            <i class="detalle-venta cursor-pointer fa fa-list-alt fa-2x" title="ver factura"></i>
                                                        </td>

                                                    </tr>
                                                ';
                                            } ?>

                                        </tbody>
                                    </table>
                                </div>
                                <?php }
                                else {
                                    echo '<div class="text-primary text-center"><h2>No se Encontrarón Resultados</h2></div>';
                                }
                                } ?>
                            </div>
                        </div>
                    </div>


                </div>
                </div>



            </div>
        </div>
</section>
</body>
<?php include VIEWS.'/ventas/modal/reporte_venta_detalle.php'; ?>
<script>

$(document).ready(function() {


    $(".detalle-venta").click(function(){
        var row = $(this).parents('tr')
        var id = row.data('id')
        var url = '/venta/busca_venta_id'
        var url2 = '/venta/busca_venta_detalle'
        var data ={'id':id}
            $("#modal_detalle_venta").modal('show')
        $.post(url,data,function(result){
            result = JSON.parse(result)
            $("#num_fact_com").val(result[0].id)
            $("#fecha_com").val(result[0].created_at)
            $("#usu_nom").val(result[0].nombre)
            if(result[0].nac_id == 1){
                $("#ced_cli").val('V-'+result[0].ced_cli)

            }
            if(result[0].nac_id ==2){
                $("#ced_cli").val('E-'+result[0].ced_cli)

            }
            $("#nom_cli").val(result[0].nom_cli)
            $("#dir_cli").val(result[0].dir_cli)
            $("#telf_cli").val(result[0].telf_cli)
            $("#big").text(result[0].big)
            $("#iva").text(result[0].iva)
            $("#total").text(result[0].total)

        })
        //// CARGAMOS LOS DATOS EN LA MODAL
        var detalle =$("#detalle-venta")
        $.post(url2,data,function(res){
            res = JSON.parse(res)
            $.each(res , function(i,item){
               // alert(item.cant)
                detalle.append('<tr><td>'+item.cant+'</td><td>'+item.cod_pro+'</td><td>'+item.des_pro+'</td><td>'+item.pre_com+'</td><td>'+item.sub_total+'</td></tr>')
            })
        })
    })
    /// LIMPIAMOS LA MODAL AL SALIR
    $('.modal').on('hidden.bs.modal', function() {
        $("#detalle-venta").text('')
        //$(this).find('form')[0].reset();
    });


})


// ----------------- DEFINICIÓN DE FORMATO ----------------------
// Recurso original:
// http://www.backtheweb.com/jquery/como-dar-formato-a-la-fecha-del-datepicker-de-jquery/

</script>
