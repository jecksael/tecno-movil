<script>
    $(document).ready(function(){

        // REGISTRA EL PROVEEDOR ///
        $("#form-proveedor").submit(function(e){
            e.preventDefault()
            var form = $("#form-proveedor")
            var url = form.attr('action')
            var rif = $("input[name='rif_pro_m']").val()
            var data = form.serialize()
            $.post(url, data, function(result){
                result = JSON.parse(result)
                if(result == true){
                    swal("Error", "El Rif que intenta registrar ya existe ..!!", 'error')
                    return
                }
                else{
                    swal({
                        title:"Ok",
                        text:"Proveedor registrado con exito ..!!",
                        type:'success'
                    },function(){
                        $("input[name='rif_pro']").focus()
                    })
                        $("input[name='rif_pro']").val('')
                        $("input[name='rif_pro']").val(rif)
                        $("#newProveedor").modal('hide')

                }
            }).fail(function(){

            })

        })
        /// BUSCA EL PROVEEDOR //
        ///
        $("input[name='rif_pro']").on('keyup focus', function(){
            var rif = $("input[name='rif_pro']").val()
            var rif_id = $("#rif_id")
            var nom_pro = $("input[name='nom_pro']")
            var dir_pro = $("input[name='dir_pro']")
            var url = '/proveedor/buscaAjax'
            var data = {'rif_pro':rif}
            $.post(url, data, function(result){
                result = JSON.parse(result)
                if(result != ''){
                    rif_id.val(result[0].id)
                    nom_pro.val(result[0].nom_pro)
                    dir_pro.val(result[0].dir_pro)
                }
                else{
                    rif_id.val('')
                    nom_pro.val('')
                    dir_pro.val('')
                }
            })

        })
        // BUSCA EL PRODUCTO ///
        $("input[name='cod_pro']").on('keyup focus click', function(){
            var cod_pro = $("input[name='cod_pro']").val()
            var des_pro = $("input[name='des_pro']")
            var cantidad = $("input[name='cantidad']").val()
            var pre_com = $("input[name='pre_com']")
            var url = '/inventario/busca_producto_ajax'
            var data = {'cod_pro':cod_pro}
            $.post(url, data, function(result){
                result = JSON.parse(result)
                if(result != ''){
                    des_pro.val(result[0].des_pro)
                    pre_com.val(result[0].pre_com)
                }
                else{
                    des_pro.val('')
                    pre_com.val('')
                }
            })
        })

        /// CALCULA EL TOTAL //
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
        // AGREGAR PRODUCTO AL CARRO DE COMPRAS
        $("#add-car").click(function(){


            var cod_pro = $("input[name='cod_pro']").val()
            var cantidad = $("input[name='cantidad']").val()
            var pre_com = $("input[name='pre_com']").val()
            var cod = ''
            var cant = ''
            var pc = ''
            var st = ''
            var t = document.getElementById("detalle-compra")
            for (var linea=0;linea<t.rows.length;linea++){

                cant=t.rows[linea].cells[0].innerHTML;
                cod=t.rows[linea].cells[1].innerHTML;
                pc = t.rows[linea].cells[3].childNodes[0].value;
                ct = parseInt(cant)+ parseInt(cantidad);
                cod = cod.trim();
                if (cod == cod_pro){
                    var x =t.rows[linea].cells[0].innerHTML=ct;
                    st = (pc * x).toFixed(2);
                    var cellsPrice =t.rows[linea].cells[4].innerHTML=st;
                    calcular_total();
                    return
                }

            }
            // agregamos el producto //
            add_car()

        })

        function add_car(){
            var rif_pro = $("input[name='rif_pro']").val()
            var nom_pro = $("input[name='nom_pro']").val()
            var cod_pro = $("input[name='cod_pro']").val()
            var des_pro = $("input[name='des_pro']").val()
            var cantidad = $("input[name='cantidad']").val()
            var pre_com = $("input[name='pre_com']").val()
            var detalle = $("#detalle-compra")
            var sub_total = (pre_com * cantidad).toFixed(2)
            if(rif_pro == ''){
                swal("Por Favor", 'Inserte el rif del provedor', 'info' )
                return
            }
            if(nom_pro == ''){
                swal('Por Favor', 'Verifique que el proveedor existe', 'info')
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

            else{
                detalle.append('<tr><td>'+cantidad+'</td><td>'+cod_pro+'</td><td>'+des_pro+'</td><td><input type="number" value="'+pre_com+'" class="price pre_com" name="price_com" style="width:30%"></td><td class="sub-total">'+sub_total+'</td><td><i class="btn-remove cursor-pointer fa fa-2x fa-trash"></i></td></tr>')
                calcular_total()
            }
        }

        // ELIMINA EL PRODUCTO DEL CARRITO //
        $("#detalle-compra").on('click', '.btn-remove',function(){
            var row = $(this).parents('tr')
            row.fadeOut(400, function(){
                row.remove()
                calcular_total()
            })
        })

        //calcula el subtotal de acuero al precio de compra introducido//
        $("#detalle-compra").on('keyup', '.pre_com', function(){
            var row = $(this).parents('tr')
            var pre_com = row.find('td').eq(3).find('input').val()
            var cant = row.find('td').eq(0).text()
            var sub_total = row.find('td').eq(4).text()
            sub_total = (pre_com * cant).toFixed(2)
            row.find('td').eq(4).text(sub_total)
            calcular_total()

        })
//// ABRIMOS LA VENTANA DE COBRO////
        $("#pagar").click(function(){
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

        // CAMBIMOS DE ACUERDO AL TIPO DE PAGO //7
        $("#tipo_pago").change(function(){
            var tipo_pago = $("#tipo_pago").val()
            var referencia = $("#num_refere")
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

        /// GUARDAMOS LA COMPRA //

        $("#form-pago").submit(function(e){
            e.preventDefault()
            var rif = $("#rif_id").val()
            var big = $("#big").val()
            var iva = $("#iva").val()
            var total = $("#total").val()
            var tipo_pago = $("#tipo_pago").val()
            var referencia = $("#num_refere").val()

            valores = new Array()
            $("#detalle-compra tr").each(function(){
                var cant = $(this).find('td').eq(0).text()
                var cod = $(this).find('td').eq(1).text()
                var pre_com = $(this).find('td').eq(3).find('input').val()
                var sub_total = $(this).find('td').eq(4).text()
                valor = new Array(cant, cod, pre_com, sub_total)
                valores.push(valor)
            })
                data = {
                    'rif_id':rif,
                    'big':big,
                    'iva':iva,
                    'total':total,
                    'tipo_pago':tipo_pago,
                    'referencia':referencia,
                    'valores':valores
                }
                var url = '/compras/guarda_compra'
                $.ajax({
                    url:url,
                    data:data,
                    type:'post',
                    beforeSend:function(){
                        showLoad();
                    },
                    success:function(data){
                        removeLoad()
                        $("#calculaPago").hide()
                        swal({title:'OK',
                            text:'Compra realizada con exito',
                            type:'success'},function(){
                                window.location.href='/compras'
                            })
                    },
                    error:function(){
                        removeLoad()
                        swal({title:'Error',
                            text:'Ocurrio un erro intente nuevamente',
                            type:'error'},function(){
                                window.location.href='/compras'
                            })
                    }
                })


        })


    })
</script>
