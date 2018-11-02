<script>
    $(document).ready(function(){
        var ventaModal = $("#calculaPago")
        var pagoTarjeta = $(".tarjeta")
        var pagoTransferencia = $(".referencia")
        var efectivo = $(".pago-efectivo")
        $("#tipo_pago").val(1)
        pagoTarjeta.hide()
        pagoTransferencia.hide()


        $("#cobrar").click(function(){
            var big = $("#big").val()
            var iva = $("#iva").val()
            var total = $("#total").val()
            if(total != 0){
                $("#calculaPago").modal('show')
                $("#big2").val(big)
                $("#iva2").val(iva)
                $("#total2").val(total)
                $("#total-tarjeta").val(total)
                $("#tipo_pago").val(1)
                $(".tarjeta").hide()
                $(".referencia").hide()
            }
            else{
                swal('Por Favor', 'Inserte productos a la compra', 'info')
            }
        })
        // accion al cambiar el tipo de pago
        //
        $("#tipo_pago").change(function(){
            var pago = $("#tipo_pago").val()
            var referencia = $("#referencia")
            var tipo_pago = $("#tipo_pago").val()
            if(tipo_pago == 1){
                referencia.val('')
                $(".tarjeta").hide()
                $(".referencia").hide()
                referencia.attr('required', false)
            }
            if(tipo_pago == 2){
                referencia.val('')
                $(".referencia").hide()
                $(".tarjeta").show('slow')
                referencia.attr('required', false)
            }
            if(tipo_pago == 3){
                $(".tarjeta").hide()
                $(".referencia").show('slow')
                referencia.attr('required', true)
            }
        })


        /// funcion de registrar cliente /////
        $("#form-cliente").submit(function(e){
            e.preventDefault()
            ced = $("input[name='ced_cli']").val()
            var url = $("#form-cliente").attr('action');
            var  data = $("#form-cliente").serializeArray();
            $.post(url,data, function(result){
                result = JSON.parse(result)
                if(result == true){
                    swal("Error", 'El numero de cedula que intenta registrar ya existe.. !! ', 'error');
                }
                else{
                    swal({
                        title:'Ok',
                        text:'Cliente registrado con exito ..!!',
                        type:'success'
                    },function(){
                       $("#ced_cli").focus()

                    })
                    $("#ced_cli").val('V-'+ced)
                    $("#newCliente").modal('hide');


                }
            }).fail(function(){
                swal("Error", 'Ocurrio un intente nuevamente.. !! ', 'error');
            })
        })

        /// funcion buscar cliente
        $("#ced_cli").on('keyup focus', function(){
            var nac = '1'
            var ced = $("#ced_cli").val()
            ced = ced.replace('V-','')
            var data = {'nac':nac,'ced':ced}
            var url = '/clientes/buscaAjax'
            $.post(url,data,function(result){
                result = JSON.parse(result)
                if(result != ''){
                    $("#ced_id").val(result[0].id)
                    $("#nom_cli").val(result[0].nom_cli)
                    $("#dir_cli").val(result[0].dir_cli)
                }
                else {
                    $("#ced_id").val('')
                    $("#nom_cli").val('')
                    $("#dir_cli").val('')
                }
            })
        })
        ///buscar el producto
        $("#cod_pro").on("keyup blur",function(){
            var cod_pro = $("#cod_pro").val()
            var data = {'cod_pro':cod_pro}
            var url = '/inventario/busca_producto_ajax'
            $.post(url,data, function(result){
                result = JSON.parse(result)
                if(result != ''){
                    $("input[name='des_pro']").val(result[0].des_pro)
                    $("input[name='precio']").val(result[0].pre_ven)
                    $("input[name='stock']").val(result[0].stock)
                }
                else{
                    $("input[name='des_pro']").val('')
                    $("input[name='precio']").val('')
                    $("input[name='stock']").val(result[0].stock)
                }

            })
        })

        function add_car(){
            var ced_cli = $("#ced_cli").val()
            var nom_cli = $("#nom_cli").val()
            var cod_pro = $("#cod_pro").val()
            var des_pro = $("input[name='des_pro']").val()
            var cantidad = $("input[name='cantidad']").val()
            var pre_ven = $("input[name='precio']").val()
            var detalle = $("#detalle-venta")
            var sub_total = (pre_ven * cantidad).toFixed(2)
            var stock = $("#stock").val()

            if(ced_cli == ''){
                swal("Por Favor", 'Inserte la cedula del cliente', 'info' )
                return
            }
            if(nom_cli == ''){
                swal('Por Favor', 'Verifique que el cliente existe', 'info')
                return
            }
            if(cod_pro == ''){
                swal('Por Favor', 'Inserte el codigo del producto', 'info')
                return
            }
            if(des_pro == ''){
                swal('Por Favor', 'Verifique que el codigo del producto existe', 'info')
                return
            }
            if(cantidad == ''){
                swal('Por Favor', 'Inserte la cantidad', 'info')
                return
            }
            if(parseInt(cantidad) > parseInt(stock)){
                swal('Error', ' La cantidad que intenta ingresar supera a la existencia ..!!', 'error')
                return
            }
            else {
                detalle.append('<tr><td>'+cantidad+'</td><td>'+cod_pro+'</td><td>'+des_pro+'</td><td>'+pre_ven+'</td><td class="sub-total">'+sub_total+'</td><td><i class="btn-remove cursor-pointer fa fa-2x fa-trash"></i></td></tr>')
                calcular_total()
            }
        }
        // VALIDAMOS EL PRODUCTO A AGREGAR CON LOS  PRODUCTOS DEL CARRO DE COMPRAS
        $("#add-car").click(function(){

            var cod_pro = $("#cod_pro").val()
            var cantidad = $("input[name='cantidad']").val()
            var pre_ven = $("input[name='precio']").val()
            var stock = $("#stock").val()
            var cod = ''
            var cant = ''
            var pv = ''
            var st = ''
            var t = document.getElementById("detalle-venta")
            for (var linea=0;linea<t.rows.length;linea++){

                cant=t.rows[linea].cells[0].innerHTML;
                cod=t.rows[linea].cells[1].innerHTML;
                pv = t.rows[linea].cells[3].innerHTML;
                ct = parseInt(cant)+ parseInt(cantidad);
                cod = cod.trim();
                if (cod == cod_pro){
                    if (ct>parseInt(stock)){
                        alert ("Existencia del Producto Agotada");
                        return
                    }
                else{

                      var x =t.rows[linea].cells[0].innerHTML=ct;
                }
                  st = (pv * x).toFixed(2);
                  var cellsPrice =t.rows[linea].cells[4].innerHTML=st;
                  calcular_total();
                  return
                }

            }
            // agregamos el producto //
            add_car()

        })

        //ELIMNA PRODUCTO DEL CARRITO
        $("#detalle-venta").on('click', '.btn-remove',function(){
            var row = $(this).parents('tr')
            row.fadeOut(400, function(){
                row.remove()
                calcular_total()
            })
        })


        function calcular_total(){
            var total = 0
            var iva = 0
            var big = 0
            $(".sub-total").each(function(){
                total += parseFloat($(this).text())
            })

            big = total/'<?php echo '1.'.IVA; ?>'
            iva = big * '<?php echo IVA; ?>'/100
            iva = number_format(iva,2)
            big = number_format(big,2)
            total = number_format(total,2)
            $("#total").val(total)
            $("#big").val(big)
            $("#iva").val(iva)
        }

        /// GUARDA VENTA ///
        ///
        $("#form-cobra-venta").submit(function(e){
            e.preventDefault()
            var ced_id = $("#ced_id").val()
            var big = $("#big").val()
            var iva = $("#iva").val()
            var total = $("#total").val()
            var tipo_pago = $("#tipo_pago").val()
            var referencia = $("#referencia").val()
            valores = new Array()
            $("#detalle-venta tr").each(function(){
                var cant = $(this).find('td').eq(0).text()
                var cod = $(this).find('td').eq(1).text()
                var pre_ven = $(this).find('td').eq(3).text()
                var sub_total = $(this).find('td').eq(4).text()
                valor = new Array(cant, cod, pre_ven, sub_total)
                valores.push(valor)
            })
            var data = {
                'ced_id':ced_id,
                'big':big,
                'iva':iva,
                'total':total,
                'tipo_pago':tipo_pago,
                'referencia':referencia,
                'valores':valores
            }
            var url = $("#form-cobra-venta").attr('action')
            $.ajax({
                url:url,
                data:data,
                type:'post',
                beforeSend: function(){
                    showLoad()
                },
                success:function(){
                    removeLoad()
                    $("#calculaPago").hide()
                    swal({
                        title:'Ok',
                        text:'Venta realizada con exito..!! Desea Imprimir la Factura',
                        type:'success',
                        showCancelButton:true,
                        cancelButtonText:'No',
                        confirmButtonClass:'btn-success',
                        confirmButtonText:'Si!',
                        closeOnConfirm:true,
                    },function(isConfirm){
                        if(isConfirm){
                             window.open('/pdf/facturaVenta','Factura','width=800, height=400 , left=300, top=250');
                             location.reload()
                        }
                        else{
                            window.location.href="/venta"
                        }
                    })

                },
                error:function(){
                    removeLoad()
                    swal({
                        tiitle:'Error',
                        texte:'Ocurrio un erro intente nuevamente',
                        type:'error'
                    },function(){
                        window.location.href='/venta'
                    })
                }
            })


        })
    })
</script>
