<?php
defined('BASEPATH') or exit ("NO SE PERMITE EL ACCESO");
require '../app/models/Compra.php';
require '../app/models/CompraDetalle.php';
require '../app/models/TipoPago.php';
require '../app/models/Producto.php';
class ComprasController extends BaseController
{
    private $compra;
    private $detalle_compra;
    private $tipoPago;
    private $producto;
    public function __construct()
    {
        parent::__construct();
        $this->tipoPago = new TipoPago();
        $this->compra = new Compra();
        $this->producto = new Producto();
        $this->detalle_compra = new CompraDetalle();
        if($this->session->getStatus() == 1 || empty($this->session->get('email')))
            header('location: /login');
    }

    public function index()
    {
        $menu = 1 ;
        $pago = $this->tipoPago->getAll();
        $this->render('/compras/newCompra', compact('menu', 'pago'));
    }

    public function reporte(){
        $menu=1;
        $this->render('/compras/reporteCompra', compact('menu'));
    }

    public function reporte_busca($request)
    {
        $menu=1;
        $desde = $request['desde'].' 00:00:00';
        $hasta = $request['hasta'].' 23:59:59';
        $result = $this->compra->reporte_factura_compra($desde,$hasta);
        $this->render('/compras/reporteCompra', compact('menu','result'));
    }

    public function guarda_compra($request)
    {
        if($this->isAjax()){
            $this->compra->setRifId($request['rif_id']);
            $this->compra->setUsuId($this->session->get('id'));
            $this->compra->setPagoId($request['tipo_pago']);
            $this->compra->setIva($request['iva']);
            $this->compra->setBig($request['big']);
            $this->compra->setTotal($request['total']);
            $this->compra->setReferencia($request['referencia']);
            $this->compra->setCreatedAt();
            $save = $this->compra->save();
            $res = $this->compra->select_id();
            $id = $res->id;
            foreach ($request['valores'] as $key => $value ) {
                $this->detalle_compra->setCompraId($id);
                $this->detalle_compra->setCant($value[0]);
                $this->detalle_compra->setCodProId($value[1]);
                $this->producto->update_precio_compra($value[2],$value[1],$value[0]);
                $this->detalle_compra->setSubTotal($value[3]);
                $this->detalle_compra->save();
            }


        }
    }

    public function busca_compra_id($request)
    {
        if ($this->isAjax()){
            $res = $this->compra->reporte_factura_id($request['id']);
            echo json_encode($res);
        }
    }

    public function busca_compra_detalle($request)
    {
        if($this->isAjax()){
            $datos = $this->detalle_compra->get_detalle_idfact($request['id']);
            echo json_encode($datos);
        }
    }
}
?>
