

<body>
    <section id="prove-product-cat-config">
        <div class="container">
            <div class="page-header">
              <h1>Panel de administración de Compras <small class="tittles-pages-logo"><?php echo EMPRESA; ?></small></h1>
            </div>
            <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="<?php if($menu == 1){echo 'active';}else {echo '';} ?>">
                    <a href="#Productos" role="tab">Reporte de Compras</a>
                </li>
            </ul>
            <div class="tab-content">
                <!--==============================Panel productos===============================-->
                <div role="tabpanel" class="tab-pane fade in active" id="Productos">
                <div class="row">
                    <div class="col-xs-12">
                        <br><br>
                        <div id="bus-factura">
                            <div class="text-center text-primary"><i class="fa fa-5x fa-calendar"></i></div>
                            <form action="/compras/reporte_busca" method="POST" id="form-busca-factura">
                                <div class="form-group col-sm-offset-3 col-sm-3">
                                    <label>Desde:</label>
                                    <input  type="date" id="desde" name="desde" max="<?php echo date('Y-m-d') ?>" class="date-picker form-control"  required="" >
                                </div>


                                <div class="form-group  col-sm-3">
                                    <label class="">Hasta:</label>
                                    <input  type="date" id="hasta" min="<?php echo date('Y-m-d') ?>" name="hasta" class="date-picker form-control"  required="" >
                                </div>
                                <div class="text-center form-group col-sm-12">
                                    <button type="submit" class="btn btn-primary">Buscar</button>
                                </div>

                            </form>

                            <div class="form-group col-sm-12">
                                <?php if (isset($result)){
                                if($result != ''){  ?>
                                <div class="text-primary text-center"><h2>Reporte de Facturas de Compras</h2></div>
                                <div class="table-responsive">
                                    <table class="table">
                                        <th>N#</th>
                                        <th>Proveedor</th>
                                        <th>Fecha</th>
                                        <th>Total</th>
                                        <th>Accion</th>
                                        <tbody>
                                            <?php foreach ($result as  $value) {
                                                $fecha = substr($value->created_at, 0,10);
                                                echo '
                                                    <tr data-id ="'.$value->id.'">
                                                        <td>'.$value->id.'</td>
                                                        <td>'.$value->nom_pro.'</td>
                                                        <td>'.$fecha.'</td>
                                                        <td>'.$value->total.'</td>
                                                        <td>
                                                            <i class="detalle-compra cursor-pointer fa fa-list-alt fa-2x" title="ver factura"></i>
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
<?php include VIEWS.'/compras/modal/reporte_compra_detalle.php'; ?>
<script>

$(document).ready(function() {

    //// BUSCAMOS LOS DETALLE DE LA FACTURA
    $(".detalle-compra").click(function(){
        var row = $(this).parents('tr')
        var id = row.data('id')
        var url = '/compras/busca_compra_id'
        var url2 = '/compras/busca_compra_detalle'
        var data ={'id':id}
            $("#modal_detalle_compra").modal('show')
        $.post(url,data,function(result){
            result = JSON.parse(result)
            $("#num_fact_com").val(result[0].id)
            $("#fecha_com").val(result[0].created_at)
            $("#usu_nom").val(result[0].nombre)
            $("#rif_pro").val(result[0].rif_pro)
            $("#nom_pro").val(result[0].nom_pro)
            $("#dir_pro").val(result[0].dir_pro)
            $("#telf_pro").val(result[0].telf_pro)
            $("#big").text(result[0].big)
            $("#iva").text(result[0].iva)
            $("#total").text(result[0].total)

        })
        //// CARGAMOS LOS DATOS EN LA MODAL
        var detalle =$("#detalle-compra")
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
        $("#detalle-compra").text('')
        $(this).find('form')[0].reset();
    });

})


// ----------------- DEFINICIÓN DE FORMATO ----------------------
// Recurso original:
// http://www.backtheweb.com/jquery/como-dar-formato-a-la-fecha-del-datepicker-de-jquery/

</script>
