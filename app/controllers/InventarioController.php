<?php
defined('BASEPATH') or exit ("NO SE PERMITE EL ACCESO");
require '../app/models/Marca.php';
require '../app/models/Producto.php';

class InventarioController extends BaseController
{
    private $marca;
    private $producto;

    public function __construct()
    {
        parent::__construct();
        $this->marca = new Marca();
        $this->producto = new Producto();
        if($this->session->getStatus() == 1 || empty($this->session->get('email')))
            header('location: /login');
    }

    public function index()
    {
        $marcas = $this->marca->getAllMarcas();
        $menu = 1;
        $this->render('inventario/newProducto', compact('marcas','menu'));

    }

    public function producto_detalle($id)
    {
        $producto = $this->producto->setId($id);
        $producto = $this->producto->getIdPro();
        if($producto){
            $this->render('/inventario/producto-detalle', compact('producto'));
        }
        else {
            header('location:/entrada');
        }
    }
    //// PRODUCTOS ////////
    public function newPro($request)
    {

        if(!empty($request)){
            $request = (object) $request;
        $ruta_temp = $_FILES['url_img']['tmp_name'];
        $type = $_FILES['url_img']['type'];
        $name1 = $_FILES['url_img']["name"];
        $name = time().'_'.$name1;
        $ruta = '../public/imagenes/'.$name;
        $type = $_FILES['url_img']["type"];


            $this->producto->setCodPro($request->cod_pro);
            $this->producto->setDesPro($request->des_pro);
            $this->producto->setMarcaId($request->marca);
            $this->producto->setStock($request->stock);
            $this->producto->setPreCom($request->pre_com);
            $this->producto->setPorcPro($request->porce);
            $this->producto->setPreVen($request->pre_ven);
            $this->producto->setStatus($request->status);
            $con =$this->producto->getBy('cod_pro', $this->producto->getCodPro());
            if(!empty($con)){
                $this->msg->error('El Codigo del Producto ya Existe');
                header('location:/inventario');
            }
            if(!empty($name1)){
                if($type == 'image/png' || $type == 'image/jpg' || $type == 'image/jpeg'){
                    $this->producto->setUrl($name);
                    $res = $this->producto->save();
                    if($res == true){
                        move_uploaded_file($ruta_temp, $ruta);
                        $this->msg->success('El Producto se Registro Correctamente');
                        header('location:/inventario');
                    }
                    else{
                        $this->msg->error('Ocurrio un Error Intente Nuevamente');
                        header('location:/inventario');
                    }
                }
                else{
                    $this->msg->error('La imagen debe ser en formato jpg o png');
                        header('location: /inventario');
                }
            }
            else {
                $this->producto->setUrl($name1);
                $res = $this->producto->save();
                if($res == true){
                    $this->msg->success('El Producto se Registro Correctamente');
                    header('location:/inventario');
                }
                else{
                    $this->msg->error('Ocurrio un Error Intente Nuevamente');
                    header('location:/inventario');
                }
            }

        }else{
             header('location: /inventario');
        }
    }

    public function delete($request)
    {
        if($this->isAjax()){
            $id = $request['id'];
            $del = $this->producto->deleteById($id);
            echo json_encode('El Producto se Elimino Correctamente');
        }
        else{
            header('location:/inventario/listPro ');
        }
    }

    public function updatePro($request)
    {

        if(!empty($request)){
            $this->producto->setId($request['id']);
            $this->producto->setCodPro($request['cod_pro']);
            $this->producto->setDesPro($request['des_pro']);
            $this->producto->setMarcaId($request['marca']);
            $this->producto->setStock($request['stock']);
            $this->producto->setPreCom($request['pre_com']);
            $this->producto->setPorcPro($request['porce']);
            $this->producto->setPreVen($request['pre_ven']);
            $this->producto->setStatus($request['status']);
            $ruta_temp = $_FILES['url_img']['tmp_name'];
            $type = $_FILES['url_img']['type'];
            $name1 = $_FILES['url_img']["name"];
            $name = time().'_'.$name1;
            $ruta = '../public/imagenes/'.$name;
            $type = $_FILES['url_img']["type"];
            if(!empty($name1)){
                if($type == 'image/png' || $type == 'image/jpg' || $type == 'image/jpeg'){
                    $this->producto->setUrl($name);
                    $update = $this->producto->update();
                    if($update == true){
                        move_uploaded_file($ruta_temp, $ruta);
                        $this->msg->success('Producto Modificado Correctamente');
                        header('location: /inventario/listPro');
                    }
                    else{
                        $this->msg->error('Ocurrio un error intente nuevamente');
                        header('location: /inventario/listPro');
                    }

                }
                else{
                    $this->msg->error('La imagen debe ser en formato jpg o png');
                    header('location: /inventario/listPro');
                }
            }
            else {
                $this->producto->setUrl($request['url_img_old']);
                $update = $this->producto->update();
                if($update == true){
                    $this->msg->success('Producto Modificado Correctamente');
                    header('location: /inventario/listPro');
                }
                else{
                    $this->msg->error('Ocurrio un error intente nuevamente');
                    header('location: /inventario/listPro');
                }
            }
        }
        else{
            header('location: /inventario/listPro');
        }
       /* if(!empty($request)){

            $update = $this->producto->update();
            if($update == true){
                $this->msg->success('Producto Modificado Correctamente');
                header('location: /inventario/listPro');
            }
            else {
                $this->msg->error('Ocurrio un error intente nuevamente');
                header('location: /inventario/listPro');
            }
        }
        else{
            $this->listPro();
        }*/
    }

    public function listPro()
    {
        $producto = $this->producto->getAllPro();
        $marca = $this->marca->getAll();
        $this->render('inventario/listaProductos', compact('producto', 'marca'));
    }


    ///////////////// MARCAS VISTAS ///////////////////
    public function newMarca($request)
    {   $menu = 1;
        $request = (object)$request;
        $this->marca->setMarca($request->marca);
        $res = $this->marca->save();
        if($res == 1){
            $msg = $this->msg->success('La marcar se registro correctamente ..!');
            header ('location: /inventario/newPro');
        }
        else {
            $msg = $this->msg->error('Ocurrio un Error ..!');
            header ('location: /inventario/newPro');
        }
    }
    public function editMarca($request)
    {
        $request = (object)$request;
        $marca = $this->marca->setMarca($request->marca);
        $id = $this->marca->setId($request->id);
        $res = $this->marca->update();
        if ($res == true) {
            echo json_encode("Marca Modificada con Exito ..!!");
        }
        else {
            echo json_encode("Ocurrio Un Error");
        }


    }

    public function listmarca()
    {
        $menu = 2;
        $marcas = $this->marca->getAll();
        $this->render('inventario/listaMarca',compact('menu', 'marcas'));
    }

    ///// AJUSTE DE PRECIOS ///////


    public function ajuPre()
    {
        $menu = 1;
        $this->render('inventario/ajustePrecio', compact('menu'));
    }

    public function busDescripcion($request)
    {
        if(!empty($request)){
            $producto = $this->producto->getLinkPro('des_pro',$request['des_pro']);
            if(!empty($producto)){
                echo json_encode($producto);
            }
            else {
                echo json_encode('');
            }
        }

    }

    public function ajusteEsp($request)
    {
        if(!empty($request['id'])){
            foreach ($request['id'] as $key => $value) {
                $pro =(object) $this->producto->getBy('cod_pro', $key);
                foreach ($pro as $key ) {
                    $pre_ven = ($key->pre_ven * $request['porc_esp']) /100 + $key->pre_ven;
                    $porcentaje = $request['porc_esp'];
                    $update = $this->producto->updatePrecio($pre_ven,$porcentaje,$key->id);

                }
            }

            if(!$update){

                $this->msg->success('Ajuste de precios realizado correctamente');
                header ('location: /inventario/ajuPre');
            }
            else{
                $msg = $this->msg->error('Ocurrio un Error intenta nuevamente ');
                header ('location: /inventario/ajuPre');
            }
        }
        else {
            $this->msg->error('Seleccione al menos un producto');
            header('location: /inventario/ajuPre');
        }
    }

    public function ajusteAll($request)
    {
        if(!empty($request)){
            $porcentaje = $request['porcAll'];
            $pro = (object) $this->producto->getAll();
            foreach ($pro as $key ) {
                $pre_ven = ($key->pre_ven * $porcentaje)/100 + $key->pre_ven;
                $update = $this->producto->updatePrecio($pre_ven,$porcentaje,$key->id);
            }
            if(!$update){
                 echo json_encode('Ajueste de precios realizado correctamente');
            }
            else{
                echo json_encode('Ocurrio un Error intenta nuevamente ');
            }
        }

    }

    public function busca_producto_ajax($request)
    {
        if($this->isAjax()){
            $res = $this->producto->getBy('cod_pro', $request['cod_pro']);
            echo json_encode($res);
        }
        else{

        }
    }

}



?>
