<form action="#" id="form-detalle-reparacion">
    <div class="modal fade" id="modal-detalle-reparacion">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4>DETALLE DE LA REPARACION</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                    <div class="col-xs-12">
                        <div class="form-group col-sm-4">
                            <label for="">Numero del Servicio:</label>
                            <input type="text" class="form-control" id="num_serv" readonly>
                        </div>
                        <div class="form-group col-sm-4">
                            <label for="">Fecha y Hora:</label>
                            <input type="text" class="form-control" id="fecha" readonly>
                        </div>
                        <div class="form-group col-sm-4">
                            <label for="">Tecnico:</label>
                            <input type="text" class="form-control" id="tecnico" readonly>
                        </div>



                    </div>

                    <div class="col-xs-12">
                        <div class="col-sm-12">
                            <p class="text-center bg-primary">Datos del Cliente</p>
                        </div>
                        <div class="form-group col-sm-4">
                            <label for="">Ced. Cliente:</label>
                            <input type="text" class="form-control" id="ced_cli" readonly>
                        </div>
                        <div class="form-group col-sm-4">
                            <label for="">Nombre:</label>
                            <input type="text" class="form-control" id="nom_cli" readonly>
                        </div>
                        <div class="form-group col-sm-4">
                            <label for="">Telefono:</label>
                            <input type="text" class="form-control" id="telf_cli" readonly>
                        </div>
                    </div>

                    <div class="col-xs-12">
                        <div class="form-group col-sm-12">
                            <label for="">Dirección:</label>
                            <input type="text" class="form-control" id="dir_cli" readonly>
                        </div>
                    </div>

                    <div class="col-xs-12">
                        <div class="col-sm-12">
                            <p class="text-center bg-primary">Datos de la Reparacion</p>
                        </div>
                        <div class="form-group col-sm-4">
                            <label for="">Equipo:</label>
                            <input type="text" class="form-control" id="equipo" readonly>
                        </div>
                        <div class="form-group col-sm-4">
                            <label for="">Marca:</label>
                            <input type="text" class="form-control" id="marca" readonly>
                        </div>
                        <div class="form-group col-sm-4">
                            <label for="">Modelo:</label>
                            <input type="text" class="form-control" id="modelo" readonly>
                        </div>

                        <div class="form-group col-sm-5">
                            <label for="">Color:</label>
                            <input type="text" class="form-control" id="color" readonly>
                        </div>
                        <div class="form-group col-sm-5">
                            <label for="">Imei / Serial:</label>
                            <input type="text" class="form-control" id="imei" readonly>
                        </div>
                    </div>

                    <div class="col-xs-12">
                        <div class="form-group col-sm-8">
                            <label for="">Servicio:</label>
                            <input type="text" class="form-control" id="servicio" readonly>
                        </div>

                        <div class="form-group col-sm-4">
                            <label for=""> Precio del Servicio:</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="monto_serv" readonly>
                                <span class="input-group-addon"><b>BF</b></span>
                            </div>
                        </div>
                    </div>


                    <div class="col-xs-12">
                        <div class="form-group col-sm-8">
                            <label for="">Detalle del Servicio:</label>
                            <input type="text" class="form-control" id="detalle_serv" readonly>
                        </div>
                        <div class="form-group col-sm-4">
                            <label for="">Accesorios Recibidos:</label>
                            <input type="text" class="form-control" id="acce_recb" readonly>
                        </div>
                    </div>
                    <div class="detalle-producto col-xs-12">
                        <div class="col-sm-12">
                             <p class="detalle-producto text-center bg-primary">Datos de Repuestos</p>
                            <div class="table-responsive">
                                <table class="table">
                                    <tbody id="detalle-repu-repa"></tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="col-xs-12">
                        <div class="form-group col-sm-3">
                            <label for="">Tipo de Pago:</label>
                            <input type="text" class="form-control" id="pago" readonly>
                        </div>
                        <div class="referencia form-group col-sm-3">
                            <label for="">Numero de Referencia:</label>
                            <input type="text" class="form-control" id="referencia" readonly>
                        </div>
                        <div class="form-group col-sm-3">
                            <label for="">Total Pagado:</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="total" readonly>
                                <span class="input-group-addon"><b>BF</b></span>
                            </div>
                        </div>
                        <div class="form-group col-sm-3">
                            <label for="">Status del Servicio:</label>
                            <input type="button" class="btn" id="status" style="cursor: default;">
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
