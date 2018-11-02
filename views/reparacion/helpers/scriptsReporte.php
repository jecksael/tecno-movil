<script>
    $(document).ready(function(){
        /// ver el detalle de la reparacion //
        $(".btn-detalle").click(function(){
            var row = $(this).parents('tr')
            var id = row.data('id')
            var url = '/reparacion/busca_reparacion_id'
            var url2 = '/reparacion/busca_producto_reparacion'
            var data = {'id':id}
            $.post(url,data, function(result){
                result = JSON.parse(result)
                $("#num_serv").val(result[0].id)
                $("#fecha").val(result[0].created_at)
                $("#tecnico").val(result[0].nombre)
                if(result[0].nac_id == 1){
                    $("#ced_cli").val('V-'+result[0].ced_cli)
                }
                if(result[0].nac_id == 2){
                    $("#ced_cli").val('E-'+result[0].ced_cli)
                }
                $("#nom_cli").val(result[0].nom_cli)
                $("#telf_cli").val(result[0].telf_cli)
                $("#telf_cli").val(result[0].telf_cli)
                $("#dir_cli").val(result[0].dir_cli)
                $("#equipo").val(result[0].equipo)
                $("#marca").val(result[0].marca)
                $("#modelo").val(result[0].modelo)
                $("#color").val(result[0].color)
                $("#imei").val(result[0].imei)
                $("#servicio").val(result[0].servicio)
                $("#monto_serv").val(result[0].monto_serv)
                $("#detalle_serv").val(result[0].detalle_serv)
                $("#acce_recb").val(result[0].acce_recb)
                $("#pago").val(result[0].pago)
                $("#total").val(result[0].total)
                $("#status").val(result[0].status)
                $("#detalle-repu-repa").text('')
                $(".detalle-producto").addClass('hide')
                if(result[0].status_id == 1){
                    $("#status").removeClass('btn-danger')
                    $("#status").removeClass('btn-success')
                    $("#status").addClass('btn-warning')
                }
                if(result[0].status_id ==2){
                    $("#status").removeClass('btn-danger')
                    $("#status").removeClass('btn-warning')
                    $("#status").addClass('btn-success')
                }
                if(result[0].status_id ==3){
                    $("#status").removeClass('btn-success')
                    $("#status").removeClass('btn-warning')
                    $("#status").addClass('btn-danger')
                }

                if(result[0].pago_id == 3){
                    $(".referencia").show()
                    $("#referencia").val(result[0].referencia)
                }
                if(result[0].pago_id != 3){
                    $(".referencia").hide()
                }
                if(result[0].monto_repu != 0){
                    var data = {'id':result[0].id}
                    var td = $("#detalle-repu-repa")
                    $(".detalle-producto").removeClass('hide')
                    $.post(url2,data,function(result){
                        result = JSON.parse(result)
                        $.each(result, function(i,v){
                            td.append('<tr><td>'+v.cod_pro+'</td><td>'+v.des_pro+'</td><td>'+v.pre_ven+'</td></tr>')
                        })
                    })
                    $("#detalle-producto").show()

                }

            })
            $("#modal-detalle-reparacion").modal('show')
        })

        $(".btn-change-status").click(function(){
            var row = $(this).parents('tr')
            var id = row.data('id')
            $("#id_reparacion").val(id)
            $("#modal-status-reparacion").modal('show')
        })

        $("#submit-change-status").click(function(){
            var id = $("#id_reparacion").val()
            var status = $("#status_reparacion").val()
            var url = '/reparacion/update_status_reparacion'
            var data = {'id':id, 'status':status}
            $("#modal-status-reparacion").modal('hide')
            swal({
                title:'Estas Seguro?',
                text:'Desea Cambiar el Status del Servicio',
                type:'info',
                showCancelButton: true,
                cancelButtonText:'No, Gracias',
                confirmButtonClass: "btn-success",
                confirmButtonText: "Si!",
                closeOnConfirm: false
            },function(isConfirm){
                if(isConfirm){
                    $.post(url,data,function(result){

                        if(result ==  true){
                            swal({
                                title:'Ok',
                                text:'Status Modificado ..!',
                                type:'success'
                            },function(){
                               location.reload()
                            })
                        }
                        else{swal('Error', 'Lo sentimos ha ocurrido un error..!!', 'error')
                        }
                    }).fail(function(){
                        swal({
                            title:'Error',
                            text:'Lo sentimos ha ocurrido un error..!!',
                            type:'error'
                        },function(){
                            location.reload()
                        })
                    })
                }

            })
        })

    $(".btn-entrega").click(function(){
        var row = $(this).parents('tr')
        var id = row.data('id')
        var data = {'id':id, 'status_id':2}
        var url = '/reparacion/update_status_entrega'
        swal({
            title:'Estas Seguro?',
            text:'Desea Entregar el Equipo',
            type:'info',
            showCancelButton: true,
            cancelButtonText:'No, Gracias',
            confirmButtonClass: "btn-success",
            confirmButtonText: "Si!",
            closeOnConfirm: false
        },function(isConfirm){
            if(isConfirm){
                $.post(url,data, function(result){
                    if(result == true){
                        swal({
                            title:'Ok',
                            text:'Equipo Entregado ..!',
                            type:'success'
                        },function(){
                            location.reload()
                        })
                    }
                    else{
                        swal('Error', 'Lo sentimos ha ocurrido un error..!!', 'error')
                    }
                }).fail(function(){
                    swal('Error', 'Lo sentimos ha ocurrido un error..!!', 'error')
                })
            }
        })
    })
    })
</script>
