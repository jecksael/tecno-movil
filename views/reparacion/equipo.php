
<body>
    <section id="prove-product-cat-config">
        <div class="container">
            <div class="page-header">
                <h1>Panel de Administración de Equipos <small class="tittles-pages-logo"><?php echo EMPRESA ?></small></h1>
            </div>
            <?php if (!empty($this->msg->hasMessages())) { $this->msg->display(); }?>

            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="">
                    <a href="/reparacion" role="tab">Nueva Reparacion</a>
                </li>
                <li class="">
                    <a href="/reparacion/servicios">Servicios</a>
                </li>
                <li class="active">
                    <a href="#">Equipos</a>
                </li>


            </ul>

            <div class="row">
                <br>
            <div class="col-xs-12 ">
                <div id="adm-servicio">
                    <h2 class="text-primary text-center"><i class=" fa fa-cog"></i> Listado de Equipos</h2>
                    <div style="padding-bottom: 3em">
                        <button class="btn-new-usu btn btn-primary pull-right" data-toggle="modal" data-target="#newEquipo">
                            Agregar Equipo <i class="fa fa-plus"></i>
                        </button>
                    </div>
                    <div class="table-responsive tabla-servicios">
                        <table class="table table-hover table-condensed">
                            <th>Id</th>
                            <th>Equipo</th>
                            <th width="10%">Accion</th>
                            <tbody id="detalle-equipo"></tbody>
                        </table>
                    </div>

                </div>
            </div>

            </div>


        </div>
    </section>
</body>
<?php include VIEWS.'/reparacion/modal/newEquipo.php'; ?>
<script>
    $(document).ready(function(){
        var url = '/reparacion/loadEquipo'
        var btnEdit = '<button class="btn btn-edit btn-sm btn-primary" title="editar"><i class="fa fa-edit"></i></button>'
        var btnRemove = '<button class="btn btn-remove btn-sm btn-danger" title="eliminar"><i class="fa fa-remove"></i> </button>'
        $.post(url, '', function(result){
            result = JSON.parse(result)
            $.each(result, function(key, value){
                $("#detalle-equipo").append('<tr data-id="'+value.id+'"><td>'+value.id+'<input type="hidden" name="id_serv" value="'+value.id+'"></td><td><input class="form-control" name="equipo" value="'+value.equipo+'"></td><td>'+btnEdit+' '+btnRemove+'</td></tr>')
            })
        })

        $("#detalle-equipo").on('click', '.btn-remove', function(){
            var row = $(this).parents('tr')
            var id = row.data('id')
            var url = '/equipo/deleteEquipo'
            var data = {'id':id}
            swal({  title:'Estas Seguro ?',
                    text:'No podras recuperar datos que dependan de este Equipo',
                    type:'warning',
                    showCancelButton: true,
                    cancelButtonText: 'Cancelar',
                    confirmButtonClass: "btn-danger",
                    confirmButtonText: "Si, Borrar!",
                    closeOnConfirm: true
            },function(){
                $.post(url, data, function(result){
                    window.location.href='/equipo'
                }).fail(function(){
                    swal('Error', 'Lo sentimos ocurrio un error', 'error')
                })
            })
        })

        $("#detalle-equipo").on('click', '.btn-edit', function(){
            var row = $(this).parents('tr')
            var id = row.data('id')
            var equipo = row.find('td').eq(1).find('input').val()
            var data = {'id':id, 'equipo':equipo}
            var url = '/equipo/editEquipo'
            swal({
                title:'Estas Seguro',
                text:'Se modificaran todos los registros que contengan este Equipo',
                type:'info',
                showCancelButton: true,
                cancelButtonText: 'Cancelar',
                confirmButtonClass: "btn-primary",
                confirmButtonText: "Si, Actualizar!",
                closeOnConfirm: true
            },function(){
                $.post(url, data, function(result){
                    window.location.href='/equipo'
                }).fail(function(){
                    swal('Error', 'Lo sentimos ocurrio un error', 'error')
                })

            })
        })

        $("#form-equipo").submit(function(e){
            e.preventDefault()
            var data = $("#form-equipo").serialize()
            var url = $("#form-equipo").attr('action')
            $.post(url, data, function(){
                $("#newEquipo").modal('hide')
                swal({
                    title:'Ok',
                    text:'Equipo registrado con exito ..!!',
                    type:'success'
                },function(){
                    location.reload()
                })
            }).fail(function(){
                swal('Error', 'Lo sentimos ocurrio un error', 'error')
            })

        })
    })
</script>
