<body>
<section id="prove-product-cat-config">
<div class="container">
    <div class="page-header">
        <h1>Panel de administración de Proveedores <small><?php echo EMPRESA; ?></small></h1>
    </div>
        <?php if (!empty($this->msg->hasMessages())) { $this->msg->display(); }
            //include VIEWS.'/clientes/partials/navegacion.php'; ?>
            <ul class="nav nav-tabs" role="tablist">
              <li role="presentation"><a href="/compras" role="tab" >Nueva Compra</a></li>
                <li role="presentation" class="<?php if($menu == 2){echo 'active';}else {echo '';} ?>">
                    <a href="/proveedor" role="tab">Proveedores</a>
                </li>

            </ul>
        <div role="tabpanel" class="tab-pane fade <?php if($menu == 2){echo 'in active';} else {echo '';}?>" id="newCliente">
        <div class="row">
                <br>
            <div class="col-xs-12 col-sm-6">
                <div id="add-proveedor">
                    <h2 class="text-primary text-center">Agregar Proveedor</h2>
                    <form action="/proveedor/save" method="POST">
                        <div class="form-group">
                            <label for="">Rif:</label>
                            <input type="text" name="rif_pro" class="form-control" maxlength="14" placeholder="Rif de la empresa" required="">
                        </div>

                        <div class="form-group">
                            <label for="">Nombre de la Empresa:</label>
                            <input type="text" name="nom_pro" class="form-control" maxlength="50" placeholder="Nombre de la empresa" required="">
                        </div>

                        <div class="form-group">
                            <label for="">Direccion:</label>
                            <input type="text" name="dir_pro" class="form-control" maxlength="50" placeholder="Direccion" required="">
                        </div>

                        <div class="form-group">
                            <label for="">Telefono:</label>
                            <input type="text" name="telf_pro" class="phone form-control" placeholder="Telefono" required="">
                        </div>

                        <p class="text-center">
                            <button type="submit" class="btn btn-primary">Registrar</button>
                        </p>
                    </form>
                </div>
            </div>

            <div class="col-sm-6">
                <div class="table-responsive">
                    <div class="panel panel-info table-proveedor">
                        <div class="panel-heading"><h3 class="text-primary text-center">Listado De Proveedores</h3></div>
                        <table class="table table-bordered ">
                            <thead>
                                <th>RIF</th>
                                <th>NOMBRE</th>
                                <th>DIRECCIÓN</th>
                                <th>TELEFONO</th>
                                <th>ACCIÓN</th>
                            </thead>
                              <tbody>
                                <?php
                                    if(!empty($proveedor)){
                                        foreach ($proveedor as $key ) {
                                            echo'
                                            <tr data-id="'.$key->id.'">
                                                <td>'.$key->rif_pro.'</td>
                                                <td>'.$key->nom_pro.'</td>
                                                <td>'.$key->dir_pro.'</td>
                                                <td>'.$key->telf_pro.'</td>
                                                <td><div class="btn-action-prove"><button class="btn-edit-prove btn btn-xs btn-primary">
                                                    <i class="fa fa-edit"></i> </button>
                                                    <button class="btn-remove-prove btn btn-xs btn-danger">
                                                    <i class="fa fa-trash"></i> </button></div>
                                                </td>
                                            </tr>

                                            ';
                                        }
                                    }
                                    else{
                                        echo '
                                            <tr><td colspan="5">Ningún dato disponible en esta tabla</td></tr>';
                                    }

                                ?>

                              </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>
        </div>
</div>
</section>

<script>
    $(document).ready(function(){
        /*
         Variabless
         */
        var btn_cancel = '<button class="btn-cancel btn btn-xs btn-danger"><i class="fa fa-close"></i></button>';
        var btn_submit_prove = '<button class="btn-submit-prove btn btn-xs btn-success"><i class="fa fa-check"></i></button>';
        var btn_edit_prove = '<button class="btn-edit-prove btn btn-xs btn-primary"><i class="fa fa-edit"></i></button>';
        var btn_remove_prove = '<button class="btn-remove-prove btn btn-xs btn-danger"><i class="fa fa-trash"></i> </button>';
        var arreglo = '';
        var indice ='';
        var rifOld = '';
        var nomOld = '';
        var dirOld = '';
        var telfOld = '';

        $('.btn-action-prove').on('click', '.btn-edit-prove', function(){

            // primero recorremos la tabla buscando inpunts para poder quitarlos
           if(indice !== ''){
            var row2 = $("tr").eq(indice+1).find('td');
                row2.eq(0).html(rifOld);
                row2.eq(1).html(nomOld);
                row2.eq(2).html(dirOld);
                row2.eq(3).html(telfOld);
                row2.eq(4).find('.btn-action-prove').html('');
                row2.eq(4).find('.btn-action-prove').append().html(btn_edit_prove+' '+btn_remove_prove);
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
            rifOld = arreglo[0];
            nomOld = arreglo[1];
            dirOld = arreglo[2];
            telfOld = arreglo[3];
            // cambiamos los td a inputs del tr seleccionado ///
            row.find('td').eq(0).html('<input type="text" value="'+arreglo[0]+'" readonly>')
            row.find('td').eq(1).html('<input type="text" value="'+arreglo[1]+'">')
            row.find('td').eq(2).html('<input type="text" value="'+arreglo[2]+'">')
            row.find('td').eq(3).html('<input class="phone" type="text" value="'+arreglo[3]+'">')
            btn = row.find('td').eq(4);
            btn.find('.btn-action-prove').html('');
            btn.find('.btn-action-prove').append().html(btn_submit_prove+' '+btn_cancel);

        });

            /// function de eviar los datos ///
        $(".btn-action-prove").on('click', '.btn-submit-prove' ,function(){
            var row = $(this).parents('tr');
            var id = row.data('id');
            var rif = row.find('td').eq(0).find('input').val();
            var nom = row.find('td').eq(1).find('input').val();
            var dir = row.find('td').eq(2).find('input').val();
            var tel = row.find('td').eq(3).find('input').val();
            var data = {'id':id,
                        'rif_pro':rif,
                        'nom_pro':nom,
                        'dir_pro':dir,
                        'telf_pro':tel
                        };
            var url = '/proveedor/update';
            $.post(url, data, function(result){
               window.location.href = '/proveedor';
            }).fail(function(){
                swal ("", 'Ocurrio un Error .. !!' , "danger");
            });
        });
        //funcion para eliminar Proveedor ////

        $(".btn-action-prove").on('click', '.btn-remove-prove', function(){
            var row = $(this).parents('tr');
            var id = row.data('id');
            var url = '/proveedor/delete';
            var data = {'id':id};
            swal({
            title: "Estas Seguro?",
            text: "No podras recuperar datos de este provedor!",
            type: "warning",
            showCancelButton: true,
            cancelButtonText: 'Cancelar',
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Si, Borrar!",
            closeOnConfirm: false
          },function(){
            $.post(url,data, function(result){
                row.fadeOut('slow')
                swal("Eliminado!", "El provedor ha sido eliminado", "success" )
            }).fail(function(){
                swal("Error!", "Ocurrio un error intente nuevamente", 'error')
                row.show('slow')
            })
          })

        });

        $(".btn-action-prove").on('click', '.btn-cancel',function(){
            var indice = $(this).parents('tr').index();
            var row2 = $("tr").eq(indice+1).find('td');
                row2.eq(0).html(rifOld);
                row2.eq(1).html(nomOld);
                row2.eq(2).html(dirOld);
                row2.eq(3).html(telfOld);
                row2.eq(4).find('.btn-action-prove').html('');
                row2.eq(4).find('.btn-action-prove').append().html(btn_edit_prove+' '+btn_remove_prove);
        })
    })
</script>
