<body>
<section id="prove-product-cat-config">
<div class="container">
    <div class="page-header">
        <h1>Panel de administración de Clientes <small><?php echo EMPRESA; ?></small></h1>
    </div>
        <?php include VIEWS.'/inventario/partials/navegacion.php'; ?>
                <div role="tabpanel" class="tab-pane fade <?php if($menu == 2){echo 'in active';}else{echo '';} ?> " id="lisCliente">
                    <div class="row">

                    <div class="col-xs-12">
                        <br><br>

                        <div id="adm-reparacion">
                            <div class="text-primary text-center"><h1>Listado de Marcas</h1></div>
                          <div class="table-responsive">
                            <form action="/inventario/editMarca" method="POST" id="form-update-marca"></form>
                              <table class="table table-bordered" id="tableProductos">
                                  <thead class="text-center">
                                      <tr>
                                        <th>Id</th>
                                        <th>Marca</th>
                                        <th width="10%"></th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                    <?php if(!empty($marcas)){
                                        foreach ($marcas as $key ) {
                                            echo "<tr class='readonly-table' data-id='".$key->id."'>
                                            <td> ".$key->id." </td>
                                            <td> <input type='text' class='nomMarca ' name='marca' value='".$key->marca."' > </td>
                                            <td><div class='btn-action-marca'>
                                                <button type='button' class='btn-edit btn btn-sm btn-primary'>
                                                    <i class='fa fa-edit'> </i> Editar </button>
                                                </div>
                                            </td>
                                            </tr>";
                                        }
                                    } ?>

                                  </tbody>
                              </table>
                          </div>
                        </div>
                    </div>

                    </div>
                </div>
</div>
</section>
</body>

<script>
    $(document).ready(function(){

        // accion al precionar editar ///
        $('.btn-action-marca').on('click', '.btn-edit', function(){
            var row = $(this).parents('tr');
             $('tr').each(function(){
                $('tr').addClass('readonly-table');
            });
            $('.btn-action-marca').html('');
            $('.btn-action-marca').append().html('<button class="btn-edit btn btn-sm btn-primary"><i class="fa fa-edit"></i> Editar</button>  ');
            row.removeClass('readonly-table');
            btn = row.find('td').eq(2);
            btn.find('.btn-action-marca').html('');
            btn.find('.btn-action-marca').append().html('<button class="btn-submit-marca btn btn-sm btn-success"><i class="fa fa-check"></i></button> <button class="btn-cancel btn btn-sm btn-danger"><i class="fa fa-close"></i></button> ');

        });

        $('.btn-action-marca').on('click', '.btn-submit-marca', function(){

            var row = $(this).parents('tr');
            var id = row.data('id');
            var url = '/inventario/editMarca';
            var name = row.find('td').eq(1).find('input').val();
            var name = name.toUpperCase()
            var data = {'id':id , 'marca': name};

            $.post(url, data, function(result){
                var datos = JSON.parse(result);
                swal("", datos, "success");
                row.addClass('readonly-table');
                row.find('td').eq(1).find('input').val(name);
                btn = row.find('td').eq(2);
                btn.find('.btn-action-marca').html('');
                btn.find('.btn-action-marca').append().html('<button class="btn-edit btn btn-sm btn-primary"><i class="fa fa-edit"></i> Editar</button>');
            }).fail(function(error){
                var e = JSON.parse(error)
                swal ("", e , "danger");
            });

        });

        // funcion de cancelar la edicion vuelve todo como el inicio ///

        $(".btn-action-marca").on('click', '.btn-cancel',function(){
            $('tr').addClass('readonly-table');
            $('.btn-action-marca').html('');
            $('.btn-action-marca').append().html('<button class="btn-edit btn btn-sm btn-primary"><i class="fa fa-edit"></i> Editar</button> ');
        })

    });
</script>
