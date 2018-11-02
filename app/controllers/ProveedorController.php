<?php
defined('BASEPATH') or exit ("NO SE PERMITE EL ACCESO");
require '../app/models/Proveedor.php';

class ProveedorController extends BaseController
{

    private $proveedor;

    public function __construct()
    {
        parent::__construct();
        $this->proveedor = new Proveedor();
        if($this->session->getStatus() == 1 || empty($this->session->get('email')))
            header('location: /login');
    }

    public function index()
    {
        $menu = 2;
        $proveedor = $this->proveedor->getAll();
        $this->render('/proveedor/proveedor', compact('menu', 'proveedor'));
    }

    public function save($request)
    {
        if(!empty($request)){
            $this->proveedor->setRifPro($request['rif_pro']);
            $this->proveedor->setNomPro($request['nom_pro']);
            $this->proveedor->setDirPro($request['dir_pro']);
            $this->proveedor->setTelfPro($request['telf_pro']);
            $save = $this->proveedor->save();
            if($save == true){
                $this->msg->success('Proveedor Registrado con Exito ..!!');
                header('location: /proveedor');
            }
            else{
                $this->msg->error('Ocurrio un error intente nuevamente');
                header('location: /proveedor');
            }
        }
        else {
            header('location: /proveedor');
        }
    }

    public function update($request)
    {
        if($this->isAjax()){
            $this->proveedor->setId($request['id']);
            $this->proveedor->setNomPro($request['nom_pro']);
            $this->proveedor->setDirPro($request['dir_pro']);
            $this->proveedor->setTelfPro($request['telf_pro']);
            $update = $this->proveedor->update();
            if($update == true){
                $this->msg->success('Proveedor Modificado con Exito');
            }
            else{
                $this->msg->error('Ocurrio un error intente nuevamente');
            }

        }
        else{
            header('location: /proveedor');
        }

    }

    public function delete($request)
    {
        if($this->isAjax()){
            $this->proveedor->deleteById($request['id']);
        }
        else{
            header('location: /proveedor');
        }
    }

    public function new_proveedor_ajax($request)
    {
        if($this->isAjax()){
            $this->proveedor->setRifPro($request['rif_pro_m']);
            $this->proveedor->setNomPro($request['nom_pro_m']);
            $this->proveedor->setDirPro($request['dir_pro_m']);
            $this->proveedor->setTelfPro($request['telf_pro_m']);
            $validate = $this->proveedor->verifProv($request['rif_pro_m']);
            if(!empty($validate)){
                echo json_encode(true);
            }
            else{
                $this->proveedor->save();
                echo json_encode(false);
            }
        }

    }

    public function buscaAjax($request)
    {
        if($this->isAjax())
        {
            $result = $this->proveedor->verifProv($request['rif_pro']);
            echo json_encode($result);
        }
    }

}
?>
