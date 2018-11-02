<form action="#" method="post" id="form-detalle-compra">
    <div class="modal fade" id="modal_detalle_compra">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4>DETALLE DE FACTURA COMPRA</h4>
                </div>
                <div class="modal-body">
                    <div class="row">

                    <div class="col-xs-12">
                        <div class="form-group col-sm-4">
                            <label for="">N# Factura Compra:</label>
                            <input type="text" id="num_fact_com" class="form-control" readonly>
                        </div>
                        <div class="form-group col-sm-4">
                            <label for="">Fecha:</label>
                            <input type="text" id="fecha_com" class="form-control" readonly>
                        </div>
                        <div class="form-group col-sm-4">
                            <label for="">Responsable de la Compra:</label>
                            <input type="text" id="usu_nom" class="form-control" readonly>
                        </div>
                    </div>
                    <div class="col-xs-12">
                        <div class="form-group col-sm-4">
                            <label for="">Rif:</label>
                            <input type="text" id="rif_pro" class="form-control" readonly>
                        </div>
                        <div class="form-group col-sm-4">
                            <label for="">Nombre</label>
                            <input type="text" id="nom_pro" class="form-control" readonly>
                        </div>
                        <div class="form-group col-sm-4">
                            <label for="">Telefono:</label>
                            <input type="text" id="telf_pro" class="form-control" readonly>
                        </div>
                    </div>
                    <div class="col-xs-12">
                        <div class="formm-group col-sm-12">
                            <label for="">Direccion:</label>
                            <input type="text" id="dir_pro" class="form-control" readonly>
                        </div>
                    </div>
                    <div class="col-xs-12">
                        <br>
                        <div class="table-responsive">
                            <table class="table table-striped table-condensed" style="font-size: 11px" >
                                <th>Cantidad</th>
                                <th>Codigo</th>
                                <th>Descripcion</th>
                                <th>Precio Unt</th>
                                <th>Sub Total</th>

                                <tbody id="detalle-compra">

                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="3"></td>
                                        <th>BIG</th>
                                        <th><span id="big"></span></th>
                                    </tr>
                                    <tr>
                                        <td colspan="3"></td>
                                        <th>IVA</th>
                                        <th><span id="iva"></span></th>
                                    </tr>
                                    <tr>
                                        <td colspan="3"></td>
                                        <th>TOTAL</th>
                                        <th><span id="total"></span></th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn-close btn btn-default" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
</form>
