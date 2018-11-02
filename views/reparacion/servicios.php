<?php include VIEWS.'/reparacion/modal/newServicio.php'; ?>
<body>
    <section id="prove-product-cat-config">
        <div class="container">
            <div class="page-header">
                <h1>Panel de Administración de Servicios <small class="tittles-pages-logo"><?php echo EMPRESA ?></small></h1>
            </div>
            <?php if (!empty($this->msg->hasMessages())) { $this->msg->display(); }?>

            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="">
                    <a href="/reparacion" role="tab">Nueva Reparacion</a>
                </li>
                <li class="active">
                    <a href="#">Servicios</a>
                </li>
                <li class="">
                    <a href="/equipo">Equipos</a>
                </li>

            </ul>

            <div class="row">
                <br>
            <div class="col-xs-12 ">
                <div id="adm-servicio">
                    <h2 class="text-primary text-center"><i class=" fa fa-cog"></i> Listado de  Servicios</h2>
                    <div style="padding-bottom: 3em">
                        <button class="btn-new-usu btn btn-primary pull-right" data-toggle="modal" data-target="#newService">
                            Agregar Servicio <i class="fa fa-plus"></i>
                        </button>
                    </div>
                    <div class="table-responsive tabla-servicios">
                        <table class="table table-hover table-condensed">
                            <th>Id</th>
                            <th>Servicio</th>
                            <th width="10%">Accion</th>
                            <tbody id="detalle-servicio"></tbody>
                        </table>
                    </div>

                </div>
            </div>

            </div>


        </div>
    </section>
</body>
<script>
    $(document).ready(function(){
        var url = '/reparacion/loadServicio'
        var btnEdit = '<button class="btn btn-edit btn-sm btn-primary" title="editar"><i class="fa fa-edit"></i></button>'
        var btnRemove = '<button class="btn btn-remove btn-sm btn-danger" title="eliminar"><i class="fa fa-remove"></i> </button>'
        $.post(url, '', function(result){
            result = JSON.parse(result)
            $.each(result, function(key, value){
                $("#detalle-servicio").append('<tr data-id="'+value.id+'"><td>'+value.id+'<input type="hidden" name="id_serv" value="'+value.id+'"></td><td><input class="form-control" name="servicio" value="'+value.servicio+'"></td><td>'+btnEdit+' '+btnRemove+'</td></tr>')
            })
        })

        $("#detalle-servicio").on('click', '.btn-remove', function(){
            var row = $(this).parents('tr')
            var id = row.data('id')
            var url = '/reparacion/deleteServicio'
            var data = {'id':id}
            swal({  title:'Estas Seguro ?',
                    text:'No podras recuperar datos que dependan de este servicio',
                    type:'warning',
                    showCancelButton: true,
                    cancelButtonText: 'Cancelar',
                    confirmButtonClass: "btn-danger",
                    confirmButtonText: "Si, Borrar!",
                    closeOnConfirm: true
            },function(){
                $.post(url, data, function(result){
                    window.location.href='/reparacion/servicios'
                }).fail(function(){
                    swal('Error', 'Lo sentimos ocurrio un error', 'error')
                })
            })
        })

        $("#detalle-servicio").on('click', '.btn-edit', function(){
            var row = $(this).parents('tr')
            var id = row.data('id')
            var servicio = row.find('td').eq(1).find('input').val()
            var data = {'id':id, 'servicio':servicio}
            var url = '/reparacion/editServicio'
            swal({
                title:'Estas Seguro',
                text:'Se modificaran todos los registros que contengan este servicio',
                type:'info',
                showCancelButton: true,
                cancelButtonText: 'Cancelar',
                confirmButtonClass: "btn-primary",
                confirmButtonText: "Si, Actualizar!",
                closeOnConfirm: true
            },function(){
                $.post(url, data, function(result){
                    window.location.href='/reparacion/servicios'
                }).fail(function(){
                    swal('Error', 'Lo sentimos ocurrio un error', 'error')
                })

            })
        })

        $("#form-servicio").submit(function(e){
            e.preventDefault()
            var data = $("#form-servicio").serialize()
            var url = $("#form-servicio").attr('action')
            $.post(url, data, function(){
                $("#newService").modal('hide')
                swal({
                    title:'Ok',
                    text:'Servicio registrado con exito ..!!',
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
