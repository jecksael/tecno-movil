
<?php
include '../views/usuarios/newUsuario.php'
 ?>
<section id="prove-product-cat-config">
    <div class="container">
        <div class="page-header">
            <h1>Administración de Usuarios <small class="tittles-pages-logo"><?php echo EMPRESA; ?></small></h1>
        </div>
        <?php if (!empty($this->msg->hasMessages())) { $this->msg->display(); }?>

        <div class="row">
            <br>
            <div class="col-xs-12">
                <div id="adm-reparacion">
                    <div class="text-primary text-center">
                        <i class="fa fa-users fa-4x"></i>
                        <h1>Usuarios</h1>
                    </div>
                    <div style="padding-bottom: 3em">
                        <button class="btn-new-usu btn btn-primary pull-right">
                            Agregar Usuario <i class="fa fa-plus"></i>
                        </button>
                    </div>
                    <div class="table responsive">
                        <table class="tbl-usuario table table-striped table-bordered table-condensed ">
                            <thead class="bg-primary">
                                <th>NOMBRE</th>
                                <th>APELLIDO</th>
                                <th>EMAIL</th>
                                <th>CARGO</th>
                                <th>DIRECCION</th>
                                <th>TELEFONO</th>
                                <th>STATUS</th>
                                <th>OPCIÓN</th>
                            </thead>
                            <?php
                            if(isset($result)){
                                $statusText = array( 1 => 'Activo', 2 => 'Inactivo');
                                $statusClass = array (1 => 'btn-success', 2 => 'btn-warning');
                                if(!empty($result)){
                                    foreach ($result as $key => $value) {
                                        echo '
                                        <tr ">
                                            <td>'.$value->nombre.'</td>
                                            <td>'.$value->apellido.'</td>
                                            <td>'.$value->email.'</td>
                                            <td>'.$value->cargo.'</td>
                                            <td>'.$value->direccion.'</td>
                                            <td>'.$value->telefono.'</td>
                                            <td><button class="cursor-none btn btn-xs '.$statusClass[$value->status].'">'.$statusText[$value->status].'</button></td>
                                            <td>
                                                <button class="btn-edit-usu btn btn-xs btn-primary" title="editar"
                                                data-id="'.$value->id.'"
                                                data-nom="'.$value->nombre.'"
                                                data-ape="'.$value->apellido.'"
                                                data-email="'.$value->email.'"
                                                data-cargo="'.$value->cargo_id.'"
                                                data-dir="'.$value->direccion.'"
                                                data-telf="'.$value->telefono.'"
                                                data-status="'.$value->status.'">
                                                    <i class="fa fa-edit"></i></button>
                                                <button class="btn-remove-usu btn btn-xs btn-danger" title="eliminar"
                                                data-id="'.$value->id.'">
                                                    <i class="fa fa-trash"></i></button>
                                            </td>
                                        </tr>';

                                    }
                                }
                                else{
                                    echo '<tr><td colspan="8">No se encontraron resultados</td></tr>';
                                }
                            }

                             ?>
                        </table>
                    </div>

                </div>
            </div>
        </div>

</section>

<script>
    $(document).ready(function(){
        // ABRIR MODAL EDITAR USUARIO //
        $(".btn-edit-usu").click(function(){
            var modal = $("#newUsuario")
            var id = $(this).data('id')
            var nom = $(this).data('nom')
            var ape = $(this).data('ape')
            var email = $(this).data('email')
            var cargo = $(this).data('cargo')
            var dir = $(this).data('dir')
            var telf = $(this).data('telf')
            var status = $(this).data('status')
            var title = modal.find('.modal-header .modal-title').text('Editar Usuario')

            modal.find('#form-usuario').attr('action', '/usuario/update')
            modal.find('.modal-body input[name="id"]').val(id)
            modal.find('.modal-body input[name="name"]').val(nom)
            modal.find('.modal-body input[name="apellido"]').val(ape)
            modal.find('.modal-body input[name="email"]').val(email)
            modal.find('.modal-body input[name="direccion"]').val(dir)
            modal.find('.modal-body input[name="telUsu"]').val(telf)
            modal.find('.modal-body select[name="carUsu"]').val(cargo).prop('selected', 'selected')
            modal.find('.modal-body select[name="status"]').val(status).attr('selected', 'selected')
            modal.find('.molda-body input[name="password"]').attr('required', false)
            modal.find('.modal-body .password').hide()
            modal.modal('show')
        })

        //// LIMPIAMOS LOS CAMPOS DEL FORMULARIO
        $('body').on('hidden.bs.modal', '.modal', function () {
            $("#form-usuario")[0].reset();
        });

        //ABRIR MODAL NEW USU
        $(".btn-new-usu").click(function(){
            var modal = $("#newUsuario")
            modal.find('.modal-header .modal-title').text('Nuevo Usuario')
            modal.find('.modal-body .password').show()
            modal.find('#form-usuario').attr('action', 'usuario/create')
            modal.modal('show')
        })

        /// ELIMINAR USUARIO ///
        $('.btn-remove-usu').click(function(){
            var id = $(this).data('id')
            var data = {'id':id}
            var url = '/usuario/delete'
            swal({
                title:'Estas Seguro ?',
                text:'Se eleminara todos las ventas u otro registros que se hayan realizado bajo este usuario',
                type:'info',
                showCancelButton: true,
                confirmButtonColor: 'btn-primary',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si,!',
                cancelButtonText: 'Cancelar'
                },function(){
                    $.post(url,data,function(result){
                        if (result == true){
                            swal({
                                title:"Ok",
                                text:"El usuario se elimino de los registros ..!!",
                                type:'success'},function(){
                            location.reload()
                            })
                        }
                        else{
                            swal({
                                title:"Error",
                                text:"Ocurrio un error intente nuevamene",
                                type:"error"},function(){
                            location.reload()
                                })
                        }
                    }).fail(function(){
                        swal({
                            title:"Error",
                            text:"Ocurrio un error intente nuevamene",
                            type:"error"},function(){
                        location.reload()
                            })
                    })

                })
        })

    })
</script>
