<?php

require_once '../app/core/libs/dompdf/dompdf_config.inc.php';
require_once '../app/models/Venta.php';
require_once '../app/models/VentaDetalle.php';
require_once '../app/models/Reparaciones.php';
require_once '../app/models/Repuesto.php';


class PdfController extends BaseController
{
    private $venta;
    private $detalle;
    private $repa;
    private $repuesto;

    public function __construct()
    {
        $this->venta = new Venta();
        $this->detalle = new VentaDetalle();
        $this->repa = new Reparaciones();
        $this->repuesto = new Repuesto();
        parent::__construct();

    }

    public function index()
    {
        header('location: /home');

    }

    public function facturaVenta()
    {
        $this->venta->setUsuId($this->session->get('id'));
        $venta = $this->venta->factura_imp();
        $detalle = $this->detalle->get_detalle_idfact($venta[0]->id);;
        $this->renderPdf('facturaPDF', compact('venta', 'detalle'));
    }

    public function reciboReparacion()
    {
        $repa = $this->repa->reparaciones_imp($this->session->get('id'));
        $id = $repa[0]->id;
        $monto_repu = $repa[0]->monto_repu;
        if($monto_repu != 0){
            $repu = $this->repuesto->getByRepa($id);
        }

        $this->renderPdf('reparacionPDF' ,compact('repa','repu'));
    }
}
?>
