<script>
    $(document).ready(function(){
        /// OCULTAMOS EL CAMPO DE PRODUCTOS ///
        $(".repuesto-repa").hide();
        cargarMarca()
        cargarServicio()
        cargarEquipo()

        // funcion carga equipos
        function cargarEquipo(){
            $.post('/reparacion/loadEquipo', '', function(data){
                var data = JSON.parse(data)
                $.each(data, function(key, value){
                    $("#equipo").append('<option value="'+value.id+'">'+value.equipo+'</option>')
                })
            })
        }
        // funcion de  cargar las marcas ////
        function cargarMarca(){
            $.post('/reparacion/loadMarca', '', function(data){
                var data = JSON.parse(data);
                $.each( data, function( key, value ) {
                    $("#marca").append('<option value="'+value.id+'">'+value.marca+'</option>')
                });
            })
        }
        /// funcion cargar servicios ////
        function cargarServicio(){
            $("#servicio_id").html('')
            $.post('/reparacion/loadServicio', '', function(result){
                var data = JSON.parse(result)
                $.each(data, function(key,value){
                    $("#servicio_id").append('<option value="'+value.servicio+'" >'+value.servicio+'</option>')
                })

            })
        }

        // funcion carga equipos
        // buscar cliente ///
        function buscaCliente(){
           var nac = $("select[name='nacionalidad']").val()
            var ced = $("input[name='cedula']").val()
            var data = {'nac':nac,'ced':ced}
            var url = '/clientes/buscaAjax'
            $.post(url,data,function(result){
                result = JSON.parse(result)
                if(result != ''){
                    $("#ced_id").val(result[0].id)
                    $("input[name='nombre']").val(result[0].nom_cli)
                    $("input[name='direccion']").val(result[0].dir_cli)
                }
                else {
                    $("input[name='nombre']").val('')
                    $("input[name='direccion']").val('')
                }
            })
        }

        ///evento que busca el cliente mediante ajax

        $("#ced_cli").on("keyup focus",function(){
            buscaCliente()
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
                        $("#form-reparacion").find($("#ced_cli")).focus()

                    })
                    $("#form-reparacion").find($("#ced_cli")).val(ced)
                    $("#newCliente").modal('hide');


                }
            }).fail(function(){
                swal("Error", 'Ocurrio un intente nuevamente.. !! ', 'error');
            })
        })


        ///// validamos los checkbox
        ///

        $(".check").click(function(){
            $(".check").each(function(){
                if($(this).is(':checked')){
                    $("#check5").prop('checked', false)

                }
            })
        })

        $(".check2").click(function(){
            if($("#check5").is(':checked')){
                $('.check').each(function(){
                    if($(this).is(':checked')){
                        $(this).prop('checked', false)
                    }
                })
            }
        })

        /// muestra o oculta la seccion para agregar repuestos ///
        $("#repuesto").change(function(){
            var repuesto = $("#repuesto").val()
            var cont = $(".repuesto-repa")
            if(repuesto == 0){
                cont.hide('slow')
                $("#detalle_producto").html('')
                return
            }
            if(repuesto ==1){
                cont.show('slow')
            }

        })

        // funcion buscar roducto//

        function buscaProducto(){
            var cod_pro = $("input[name='cod_pro']").val()
            var data = {'cod_pro':cod_pro}
            var url = '/inventario/busca_producto_ajax'
            $.post(url,data, function(result){
                result = JSON.parse(result)
                if(result != ''){
                    $("input[name='descripcion']").val(result[0].des_pro)
                    $("input[name='precio']").val(result[0].pre_ven)
                }
                else{
                    $("input[name='descripcion']").val('')
                    $("input[name='precio']").val('')
                }

            })

        }

        $("#cod_pro").on("keyup focus",function(){
            buscaProducto()
        })
        //
        //funcion agregar el producto a la tabla
        //
        //

        $("#add-pro").click(function(){
            var cod_pro = $("input[name='cod_pro']").val()
            var des_pro = $("input[name='descripcion']").val()
            var pre_ven = $("input[name='precio']").val()
            var detalle = $("#detalle_producto")
            if (cod_pro == ''){
                swal("", 'Ingrese el Codigo del Producto','info')
                return
            }
            if(des_pro == ''){
                swal('Error', 'Valide el codigo del producto o verifique que esta escrito correctamente ..!', 'error')
                return
            }
            else {
                detalle.append('<tr class=""><td>'+cod_pro+'</td><td>'+des_pro+'</td><td class="sub-total">'+pre_ven+'</td><td><i class="btn-remove cursor-pointer fa fa-remove"></i></td></tr>')
                calcular_total()
            }
        })


        /// function para calcular el precio total de los productos
        ///
        function calcular_total(){
            var total = 0;
            $("#total").text('')
            $(".sub-total").each(function(){
                total += parseFloat($(this).text())
            })
            total = number_format(total,2)
            $("#total").text(total)
            $("input[name='total']").val(total)

        }
        ///function para remover poductos de la tabla
        ///
        $("#detalle_producto").on('click','.btn-remove',function(){
            var row = $(this).parents('tr')
            row.fadeOut(400, function(){
                row.remove(); calcular_total()})

        })

        var ventaModal = $("#calculaPago")
        var pagoTarjeta = $(".tarjeta")
        var pagoTransferencia = $(".referencia")
        var efectivo = $(".pago-efectivo")
        $("#tipo_pago").val(1)
        pagoTarjeta.hide()
        pagoTransferencia.hide()

        // accion al cambiar el tipo de pago
        //
        $("#tipo_pago").change(function(){
            var pago = $("#tipo_pago").val()
            var num_refer = $("#num_referencia")
            num_refer.val('')
            if(pago == 2){
                pagoTarjeta.show('slow')
                pagoTransferencia.hide('slow')
                efectivo.hide('slow')
                return
            }
            if(pago == 3){
                pagoTarjeta.hide('slow')
                pagoTransferencia.show('slow')
                efectivo.hide('slow')
                return
            }
            else {
                pagoTarjeta.hide('slow')
                pagoTransferencia.hide('slow')
                efectivo.show('slow')
                return
            }
        })


        //guarda la reparacion
        $("#form-reparacion").submit(function(e){
            e.preventDefault()
            if($("#nom_cli").val() == ''){
                swal("Por Favor", "Verifique que el Cliente se encuentra registrado ..!", "info")
                $("#ced_cli").focus()
                return
            }
            if($("#repuesto").val() == 1){
                 var ta = $("#detalle_producto")

                if(ta.children().length == 0){
                    swal("Por Favor", "Ingrese Repeustos a la lista ..!!", 'info')
                return
                }
                else{
                    var MR = $("#mont_reparacion").val()
                    var TPR = $("#tot_repu").val()
                    $("#monto_servicio").val(MR)
                    $(".monto_repu").val(TPR)
                    MR = MR.replace(/,/gi,'')
                    TPR = TPR.replace(/,/gi, '')
                    var total_total = (parseFloat(MR)+parseFloat(TPR))
                    total_total = number_format(total_total,2)
                    $(".total_pagar").val(total_total)
                    $("#total-tarjeta").val(total_total)
                    ventaModal.modal('show')
                }
            }
            else {
                var MR = $("#mont_reparacion").val()
                $("#monto_servicio").val(MR)
                $(".monto_repu").val(0.00)
                $(".total_pagar").val(MR)
                $("#total-tarjeta").val(MR)
                ventaModal.modal('show')
            }
        })

        $("#cobrar").click(function(){
            data = $("#form-reparacion").serialize()
            var pago =$("#tipo_pago").val()
            var total_total = $(".total_pagar").val()
            var mont_repu = $(".monto_repu").val()
            var referencia = $("#num_referencia").val()
            valores = new Array()
            $("#detalle_producto tr").each(function(){
                var cod = $(this).find('td').eq(0).text()
                valor = new Array(cod)
                valores.push(valor)
            })

            $.ajax({
                url:'/reparacion/save',
                data:data+"&tipo_pago="+pago+"&total_total="+total_total+"&monto_repu="+mont_repu+"&referencia="+referencia+"&valor="+valores,
                type:'post',
                beforeSend:function(){
                    showLoad()
                },
                success:function(result){
                    removeLoad()
                    $("#calculaPago").hide()
                    swal({
                        title:'Ok',
                        text:'Reparación guardada con exito..!! Desea Imprimir la Factura',
                        type:'success',
                        showCancelButton:true,
                        cancelButtonText:'No',
                        confirmButtonClass:'btn-success',
                        confirmButtonText:'Si!',
                        closeOnConfirm:true,
                    },function(isConfirm){
                        if(isConfirm){
                            window.open('/pdf/reciboReparacion','Recibo','width=1000, height=600 , left=300, top=250');
                            location.reload()
                        }
                        else{
                            window.location.href="/reparacion"
                        }
                    })

                },error:function(){
                    removeLoad()
                    swal({
                        tiitle:'Error',
                        texte:'Ocurrio un erro intente nuevamente',
                        type:'error'
                    },function(){
                        window.location.href='/reparacion'
                    })
                }
            })

        })

    })
</script>
