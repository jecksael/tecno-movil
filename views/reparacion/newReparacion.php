<link rel="stylesheet" href="/js/data-table/dataTables.bootstrap.css">
<script src="/js/data-table/dataTables.min.js"></script>
<script src="/js/data-table/dataTables.bootstrap.min.js"></script>
<?php
include VIEWS.'/reparacion/modal/newCliente.php';
include VIEWS.'/reparacion/modal/cobro.php';
include VIEWS.'/reparacion/modal/listaPro.php';
 ?>

<body>
    <section id="prove-product-cat-config">
        <div class="container">
            <div class="page-header">
                <h1>Panel de administración de Reparaciones <small class="tittles-pages-logo"><?php echo EMPRESA; ?></small></h1>
            </div>
            <?php if (!empty($this->msg->hasMessages())) { $this->msg->display(); }?>

            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active">
                    <a href="#" role="tab">Nueva Reparacion</a>
                </li>
                <?php if ($_SESSION["id"] == 1){  ?>
                <li class="">
                    <a href="/reparacion/servicios">Servicios</a>
                </li>
                <li class="">
                    <a href="/equipo">Equipos</a>
                </li>
                <?php } ?>

            </ul>
            <div class="col-xs-12">

            <div class="row">
                <br>
                <div id="add-reparacion">
                    <div class="panel panel-info">
                        <div class="panel-heading text-center"><h4>Datos del Cliente</h4></div>
                        <div class="panel-body">
                            <div class="col-sm-4">
                            <form id="form-reparacion" action="/reparacion/save">
                                <div class="form-group">
                                    <label class="control-label"> N# de Cedula</label><br>
                                    <select name="nacionalidad"  class="form-control" style="width: 20%; float: left">
                                        <option value="1">V-</option>
                                        <option value="2">E-</option>
                                    </select>
                                    <div class="input-group">
                                        <input type="text" name="cedula" id="ced_cli" class="cedula form-control"  placeholder="Cedula" maxlength="8" required >
                                        <input type="hidden" name="ced_id" id="ced_id">
                                        <span class="input-group-addon cursor-pointer" title="Registrar Cliente" data-toggle="modal" data-target="#newCliente">
                                            <span class="fa fa-user"></span>
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group col-sm-4">
                                <label for="">Nombre del Cliente:</label>
                                <input type="text" name="nombre" id="nom_cli" class="form-control" readonly="" maxlength="50">
                            </div>

                            <div class="form-group col-sm-4">
                                <label for="">Dirección:</label>
                                <input type="text" name="direccion" class="form-control" readonly="">
                            </div>

                        </div>
                        <!-- DATOS DEL TELEFONO -->
                        <div class="panel-heading text-center"><h4>Datos del Telefono</h4></div>
                        <div class="panel-body col-xs-12">
                            <div class="form-group col-sm-2">
                                <label for="">Equipo:</label>
                                <select name="equipo" id="equipo" class="form-control" required ></select>
                            </div>

                            <div class="form-group col-sm-3">
                                <label for="">Marca:</label>
                                <select name="marca" id="marca" class="form-control" required ></select>
                            </div>

                            <div class="form-group col-sm-2">
                                <label for="">Modelo:</label>
                                <input type="text" class="form-control" name="modelo" placeholder="Modelo" maxlength="20" required >
                            </div>

                            <div class="form-group col-sm-2">
                                <label for="">Color:</label>
                                <input type="text" class="abc form-control" name="color" placeholder="Color" maxlength="20" required >
                            </div>

                            <div class="form-group col-sm-3">
                                <label for="">IMEI / SERIAL:</label>
                                <input type="text" class="form-control" name="imei" placeholder="IMEI" maxlength="20" required="">
                            </div>
                        </div>

                        <div class="panel-heading text-center"><h4>Datos de la Reparación</h4></div>
                        <div class="panel-body col-xs-12">

                            <div class="form-group col-sm-4">
                                    <label>Accesorios Recibidos:</label>
                                    <br>
                                <div class="col-sm-6">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" class="check" name="acce_recb[]" value="Bateria" > Bateria
                                        </label>
                                    </div>

                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" class="check" name="acce_recb[]" value="Memoria SD" > Memoria SD
                                        </label>
                                    </div>

                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" class="check" name="acce_recb[]" value="Sim Card" > Sim Card
                                        </label>
                                    </div>
                                </div>

                                <div class="form-group col-sm-6">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" class="check" name="acce_recb[]" value="Forro" > Forro
                                        </label>
                                    </div>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" class="check" name="acce_recb[]" value="Cargador" > Cargador
                                        </label>
                                    </div>

                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" id="check5" class="check2" name="acce_recb[]" value="Ninguno" checked="" > Ninguno
                                        </label>
                                    </div>
                                </div>

                            </div>

                            <div class="form-group col-sm-4">
                                <label>Servicio:</label>
                                <div class="input-group">
                                    <select  id="servicio_id" multiple name="servicio_id[]" class="form-control"  required style="height: 80px"></select>
                                     <span class="text-red" style="font-size: 10px"> pressiona la tecla <kbd>Ctrl</kbd> para mas de 1 servicio</span>
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <label>Detalle del Servicio:</label>
                                <textarea class="form-control" name="detalle_serv" style="height: 80px" required ></textarea>
                            </div>

                        </div>
                        <div class="col-xs-12">
                            <div class="form-group col-sm-3">
                                <label>Tecnico:</label>
                                <select name="tecnico_id" id="" class="form-control">
                                    <?php if(isset($tecnicos)){
                                        foreach ($tecnicos as $key => $value) {
                                            echo '
                                                <option value="'.$value->id.'">'.$value->nombre.' '.$value->apellido.'</option>

                                            ';
                                        }
                                    } ?>
                                </select>
                            </div>
                            <div class="form-group col-sm-3">
                                <label>Monto de la Reparacion:</label>
                                <div class="input-group">
                                    <input type="text" class="price form-control" name="monto_repa" id="mont_reparacion" placeholder ="000.00" required >
                                    <span class="input-group-addon">BF</span>
                                </div>
                            </div>

                            <div class="form-group col-sm-2">
                                <label for="">Repuestos: </label>
                                <select name="repuesto" id="repuesto" class="form-control">
                                    <option value="0">No</option>
                                    <option value="1">Si</option>
                                </select>
                            </div>
                            <div class="form-group col-sm-4 repuesto-repa">
                                    <label>Codigo del Producto:</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="cod_pro" id="cod_pro" placeholder="Codigo del Producto">
                                    <span class="input-group-addon cursor-pointer" id="add-pro" title="Agregar Producto">
                                        <i class="fa fa-shopping-cart"></i>
                                    </span>
                                      

                                    <span class="input-group-addon cursor-pointer" data-toggle="modal" data-target="#listPro" title="Lista Producto">
                                        <i class="fa fa-search"></i>
                                    </span>
                               
                                </div>
                                    <input type="hidden" name="descripcion">
                                    <input type="hidden" name="precio">
                            </div>

                        </div>
                        <div class="col-xs-12">
                            <div class="table-responsive repuesto-repa">
                                <div class="col-sm-12">
                                    <table class="table table-respuesto-repa" >
                                        <tr>
                                            <th>Codigo</th>
                                            <th>Descripción</th>
                                            <th>Precio</th>
                                            <th></th>
                                        </tr>

                                        <tbody id="detalle_producto">
                                        </tbody>

                                        <tr>
                                            <th colspan="2"> <th>Total: <span id="total">00.00</span></th>
                                            <input type="hidden" name="total" id="tot_repu"></th>

                                        </tr>
                                    </table>
                                </div>
                            </div>

                            <div class="col-sm-12">
                                <p class="text-center">
                                    <button type="submit" id="btn"  class="btn btn-primary">Cobrar</button>
                                </p>
                            </div>
                        </div>


                </form>

                </div>
            </div>
            </div>
        </div>

    </section>
</body>

<?php include VIEWS.'/reparacion/helpers/scriptsNewReparacion.php'; ?>
<script type="text/javascript">
        $(document).ready(function(){
        $("#tableProductos").DataTable({
            language:{url:("/js/data-table/dataTables.spanish.lang")},
            "pagingType": "simple_numbers",
            "sinfo":true,
            "ordering": false,
            "bLengthChange": false,
            "sSearch":true,
        });
    })
</script>