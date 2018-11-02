<div class="modal fade" id="calculaPago" tabindex="-1" role="dialog">
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

                <h4 class="modal-title">Cobro</h4>
            </div>

            <div class="modal-body">
            <div class="row">
                <div class="form-group">
                    <div class="col-md-12">
                        <div class="col-md-3">
                            <label for="">MONTO DEL SERVICIO</label>
                        </div>
                        <div class="col-md-8">
                            <div class="input-group">
                                <input type="text" class="big form-control" name="" id="monto_servicio" readonly>
                                <span class="input-group-addon">B.F</span>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="col-md-3">
                            <label for="">MONTO DE REPUESTOS</label>
                        </div>
                        <div class="col-md-8">
                            <div class="input-group">
                                <input type="text" class="monto_repu form-control" id="" readonly>
                                <span class="input-group-addon">B.F</span>
                            </div>
                        </div>
                    </div>


                    <div class="col-md-12 ">
                        <div class="col-md-3">
                            <label for="">TOTAL A PAGAR</label>
                        </div>
                        <div class="col-md-8">
                            <div class="input-group">
                                <input type="text" class="total_pagar form-control"  id="" readonly>
                                <span class="input-group-addon">B.F</span>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="col-sm-3">
                            <label for="">TIPO DE PAGO</label>
                        </div>
                        <div class="col-sm-8">
                            <select name="tipo_pago" id="tipo_pago" class="form-control">
                                <?php
                                foreach ($pago as $key ) {
                                    echo '<option value="'.$key->id.'">'.$key->pago.'</option>';
                                }

                                 ?>

                            </select>
                        </div>
                    </div>


                    <div class="col-md-12 tarjeta">
                        <div class="col-sm-3">
                            <label for="">TOTAL A DEBITAR</label>
                        </div>
                        <div class="col-sm-8">
                            <div class="input-group">
                                <input type="text" class="form-control" id="total-tarjeta" readonly>
                                <span class="input-group-addon"><i class="fa fa-credit-card"></i></span>
                            </div>
                        </div>
                    </div>


                    <div class="col-md-12 referencia">
                        <div class="col-sm-3">
                            <label for="">NÚMERO DE REFERENCIA</label>
                        </div>
                        <div class="col-sm-8">
                            <input type="text" class="number form-control" id="num_referencia" >
                        </div>
                    </div>


                </div>
            </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                <button type="button" id="cobrar" class="btn btn-primary"  >Cobrar</button>
            </div>
        </div>
    </div>
</div>
