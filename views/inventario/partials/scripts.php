
<script>
    $(document).ready(function(){
        $("#tableProductos").DataTable({
            language:{url:("/js/data-table/dataTables.spanish.lang")},
            "pagingType": "simple_numbers",
            "sinfo":true,
            "ordering": false,
            "bLengthChange": true,
            "sSearch":true,
        });
        //// ELIMINAR PRODUCTO /////////

        $(".btn-remove-producto").click(function(){
            var row = $(this).parents('tr');
            var id = row.data('id');
            var url = '/inventario/delete';
            var data = {'id':id};
            swal({
            title: "Estas Seguro?",
            text: "No podras recuperar datos de este producto!",
            type: "warning",
            showCancelButton: true,
            cancelButtonText: 'Cancelar',
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Si, Borrar!",
            closeOnConfirm: false
          },
          function(){
            swal("Eliminado!", "El Producto ha sido eliminado.", "success");
            $.post(url,data, function(result){
                var result = JSON.parse(result);
                swal("",result, "success");
                row.fadeOut('slow');
            }).fail(function(){
                swal("Error", 'Ocurrio un Error.. !! ', 'error');
                row.show('slow');
            })

          });

        })

        ///// cargar datos a la ventana modal ///////

        $('#editPro').on('show.bs.modal', function (event) {

          var btn = $(event.relatedTarget)
          var id = btn.data('id')
          var cod = btn.data('cod')
          var modal = $(this)
          var des = btn.data('des')
          var marca = btn.data('mar')
          var stock = btn.data('stock')
          var porc = btn.data('porc')
          var precio1 = btn.data('pre1')
          var precio1Form = number_format(precio1,2);
          var precio2 = btn.data('precio2')
          var precio2Form = number_format(precio2,2);
          var status = btn.data('stat')
          var img = btn.data('img')

          modal.find('.modal-body input[name="id"]').val(id)
          modal.find('.modal-body input[name="cod_pro"]').val(cod).attr('readonly',true)
          modal.find('.modal-body input[name="des_pro"]').val(des)
          modal.find('.modal-body #mar').val(marca).attr('selected' , 'selected')
          modal.find('.modal-body input[name="stock"]').val(stock)
          modal.find('.modal-body input[name="porce"]').val(porc)
          modal.find('.modal-body input[name="pre_com"]').val(precio1Form)
          modal.find('.modal-body input[name="pre_ven"]').val(precio2Form)
          modal.find('.modal-body #status').val(status).attr('selected' , 'selected')
          if (img != ''){
            modal.find('.modal-body #image').attr('src', '<?php echo FOLDER.'/public/imagenes/'?>'+img)
          }
          else{
            modal.find('.modal-body #image').attr('src', '<?php echo FOLDER.'/public/imagenes/img_vacia.png'?>')
          }
          modal.find('.modal-body input[name="url_img_old"]').val(img)
        });
     })

    function precioVenta()
    {
        var pre_com = $("#pre_com").val();
        pre_com = parseInt(pre_com.replace(/,/gi, ''));
        var porce = $("#porce").val();
        var ganancia = (pre_com * porce)/100;
        var pre_ven = ganancia + pre_com;
        pre_ven = number_format(pre_ven,2);
        $("#pre_ven").val(pre_ven);

    }


</script>

