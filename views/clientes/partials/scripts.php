<script src="/js/data-table/dataTables.min.js"></script>
<script src="/js/data-table/dataTables.bootstrap.min.js"></script>
<script>
    $(document).ready(function(){
        var btn_cancel = '<button class="btn-cancel btn btn-sm btn-danger"><i class="fa fa-close"></i></button>';
        var btn_submit_cliente = '<button class="btn-submit-cliente btn btn-sm btn-success"><i class="fa fa-check"></i></button>';
        var btn_edit_cliente = '<button class="btn-edit-cliente btn btn-sm btn-primary"><i class="fa fa-edit"></i></button>';
        var btn_remove_cliente = '<button class="btn-remove-cliente btn btn-sm btn-danger"><i class="fa fa-trash"></i> </button>';

        var table = $("#tableClientes").DataTable({
            language:{url:("/js/data-table/dataTables.spanish.lang")},
            "pagingType": "simple_numbers",
            "sinfo":true,
            "ordering": false,
            "bLengthChange": true,
            "sSearch":true,

        });
        var arreglo = '';
        var indice ='';
        var cedOld = '';
        var nomOld = '';
        var apeOld = '';
        var dirOld = '';
        var telfOld = '';

        // funcion de recorrer y cambiar los botones y activar los inputs ///
        $('.btn-action-cliente').on('click', '.btn-edit-cliente', function(){

            // primero recorremos la tabla buscando inpunts para poder quitarlos
           if(indice !== ''){
            var row2 = $("tr").eq(indice+1).find('td');
                row2.eq(0).html(cedOld);
                row2.eq(1).html(nomOld);
                row2.eq(2).html(apeOld);
                row2.eq(3).html(dirOld);
                row2.eq(4).html(telfOld);
                row2.eq(5).find('.btn-action-cliente').html('');
                row2.eq(5).find('.btn-action-cliente').append().html(btn_edit_cliente+' '+btn_remove_cliente);
            }

            var row = $(this).parents('tr');
            indice = $(this).parents('tr').index();

            arreglo = '';
            // recorre todos los td relacionados con el tr seleccionado //
            row.find('td').each(function(){
                arreglo+=$(this).html()+",";
            });
            //delimitamos el arreglo con una , para acceder al el por medio de vector //
            arreglo = arreglo.split(",");
            cedOld = arreglo[0];
            nomOld = arreglo[1];
            apeOld = arreglo[2];
            dirOld = arreglo[3];
            telfOld = arreglo[4];
            // cambiamos los td a inputs del tr seleccionado ///
            row.find('td').eq(0).html('<input type="text" value="'+arreglo[0]+'" readonly>')
            row.find('td').eq(1).html('<input class="abc" type="text" value="'+arreglo[1]+'">')
            row.find('td').eq(2).html('<input class="abc" type="text" value="'+arreglo[2]+'">')
            row.find('td').eq(3).html('<input type="text" value="'+arreglo[3]+'">')
            row.find('td').eq(4).html('<input class="phone" type="text" value="'+arreglo[4]+'">')
            btn = row.find('td').eq(5);
            btn.find('.btn-action-cliente').html('');
            btn.find('.btn-action-cliente').append().html(btn_submit_cliente+' '+btn_cancel);

        });

            /// function de eviar los datos ///
        $(".btn-action-cliente").on('click', '.btn-submit-cliente' ,function(){
            var row = $(this).parents('tr');
            var id = row.data('id');
            var ced = row.find('td').eq(0).find('input').val();
            var nom = row.find('td').eq(1).find('input').val();
            var ape = row.find('td').eq(2).find('input').val();
            var dir = row.find('td').eq(3).find('input').val();
            var tel = row.find('td').eq(4).find('input').val();
            var data = {'id':id,
                        'ced_cli':ced,
                        'nom_cli':nom,
                        'ape_cli':ape,
                        'dir_cli':dir,
                        'telf_cli':tel
                        };
            var url = '/clientes/updateCliente';
            $.post(url,data, function(result){
                window.location.href = '/clientes/listado';
            }).fail(function(){
                swal ("", 'Ocurrio un Error .. !!' , "danger");
            });
        });

        //funcion para eliminar cliente ////

        $(".btn-action-cliente").on('click', '.btn-remove-cliente', function(){
            var row = $(this).parents('tr');
            var id = row.data('id');
            var url = '/clientes/delete';
            var data = {'id':id};
            swal({
            title: "Estas Seguro?",
            text: "No podras recuperar datos de este cliente!",
            type: "warning",
            showCancelButton: true,
            cancelButtonText: 'Cancelar',
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Si, Borrar!",
            closeOnConfirm: false
          },function(){
            $.post(url,data, function(result){
                row.fadeOut('slow')
                swal("Eliminado!", "El cliente ha sido eliminado", "success" )
            }).fail(function(){
                swal("Error!", "Ocurrio un error intente nuevamente", 'error')
                row.show('slow')
            })
          })

        });

        // funcion de cancelar la edicion vuelve todo como el inicio ///
        $(".btn-action-cliente").on('click', '.btn-cancel',function(){
            var index = $(this).parents('tr').index();
            var row2 = $("tr").eq(indice+1).find('td');
                row2.eq(0).html(cedOld);
                row2.eq(1).html(nomOld);
                row2.eq(2).html(apeOld);
                row2.eq(3).html(dirOld);
                row2.eq(4).html(telfOld);
                row2.eq(5).find('.btn-action-cliente').html('');
                row2.eq(5).find('.btn-action-cliente').append().html(btn_edit_cliente+' '+btn_remove_cliente);
        })

    });
</script>
