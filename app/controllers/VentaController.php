<?php
defined('BASEPATH') or exit ("NO SE PERMITE EL ACCESO");
require '../app/models/TipoPago.php';
require '../app/models/Venta.php';
require '../app/models/Producto.php';
require '../app/models/VentaDetalle.php';
class VentaController extends BaseController
{
    private $venta;
    private $detalle_venta;
    private $tipoPago;
    private $producto;

    public function __construct()
    {
        parent::__construct();
        $this->tipoPago = new TipoPago();
        $this->venta = new Venta();
        $this->producto = new Producto();
        $this->detalle_venta = new VentaDetalle();

        if($this->session->getStatus() == 1 || empty($this->session->get('email')))
            header('location: /login');
    }

    public function index()
    {
        $pago = $this->tipoPago->getAll();
        $menu = 1 ;
        $vendedor = $this->session->get('nombre');
        $this->render('/ventas/newVenta', compact('menu', 'pago', 'vendedor'));
    }

    public function reporte()
    {
        $menu=2;
        $this->render('/ventas/reporteVenta', compact('menu'));
    }

    public function reporte_busca($request)
    {
        $menu =2;
        $desde = $request['desde'].' 00:00:00';
        $hasta = $request['hasta'].' 23:59:59';
        $result = $this->venta->reporte_factura_venta($desde,$hasta);
        $this->render('/ventas/reporteVenta', compact('menu','result'));
    }

    public function save($request)
    {
        if($this->isAjax()){
            $this->venta->setCedId($request['ced_id']);
            $this->venta->setUsuId($this->session->get('id'));
            $this->venta->setPagoId($request['tipo_pago']);
            $this->venta->setIva($request['iva']);
            $this->venta->setBig($request['big']);
            $this->venta->setTotal($request['total']);
            $this->venta->setReferencia($request['referencia']);
            $save = $this->venta->save();
            $res = $this->venta->select_id();
            $id = $res->id;
            foreach ($request['valores'] as $key => $value) {
                $this->detalle_venta->setVentaId($id);
                $this->detalle_venta->setCodProId($value[1]);
                $this->detalle_venta->setCant($value[0]);
                $this->detalle_venta->setSubTotal($value[3]);
                $this->producto->update_stock_venta($value[1],$value[0]);
                $this->detalle_venta->save();

            }

        }
    }

    public function busca_venta_id($request)
    {
        if ($this->isAjax()){
            $res = $this->venta->reporte_factura_id($request['id']);
            echo json_encode($res);
        }
    }

    public function busca_venta_detalle($request)
    {
        if($this->isAjax()){
            $datos = $this->detalle_venta->get_detalle_idfact($request['id']);
            echo json_encode($datos);
        }
    }


}
?>
