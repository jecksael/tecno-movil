<?php
defined('BASEPATH') or exit ("NO SE PERMITE EL ACCESO");
require '../app/models/Cliente.php';

class ClientesController extends BaseController
{

    private $cliente;

    public function __construct()
    {
        parent::__construct();
        $this->cliente = new Cliente();
        if($this->session->getStatus() == 1 || empty($this->session->get('email')))
            header('location: /login');
    }

    public function index()
    {

        //$msg =$this->msg->success('This is a warning message');
        $menu = 1;
        $this->render('clientes/newCliente' ,compact('menu'));

    }

    public function newCliente($request)
    {

        $request = (object) $request;
        $menu = 1;
        $this->cliente->setNacId($request->nac_id);
        $this->cliente->setCedCli($request->ced_cli);
        $this->cliente->setNomCli($request->nom_cli);
        $this->cliente->setApeCli($request->ape_cli);
        $this->cliente->setGenCli($request->sexo);
        $this->cliente->setDirCli($request->dir_cli);
        $this->cliente->setTelfCli($request->telf_cli);
        $this->cliente->setCreatedAt($this->date);
        $this->cliente->setUpdateAt($this->date);
        $result = $this->cliente->verifCli($request->ced_cli, $request->nac_id);
        if(!empty($result)) {
            $this->msg->error('El Cliente que intenta Registrar ya Existe ..!!');

            return header('location: /clientes');
        }
        else{
            $this->cliente->save();
            $this->msg->success('Cliente Registrado Exitosamente .. !!');
            return header('location: /clientes');
        }
    }

    public function buscaAjax($request)
    {
        if($this->isAjax()){
            $result = $this->cliente->verifCli($request['ced'],$request['nac']);
            echo json_encode($result);
        }
        else {
           // header('/clientes');
        }

    }

    public function newClienteAjax($request)
    {
        if($this->isAjax())
        {
            $this->cliente->setNacId($request["nac_id"]);
            $this->cliente->setCedCli($request["ced_cli"]);
            $this->cliente->setNomCli($request["nom_cli"]);
            $this->cliente->setApeCli($request["ape_cli"]);
            $this->cliente->setGenCli($request["gen_cli"]);
            $this->cliente->setDirCli($request["dir_cli"]);
            $this->cliente->setTelfCli($request["telf_cli"]);
            $this->cliente->setCreatedAt($this->date);
            $this->cliente->setUpdateAt($this->date);
            $result = $this->cliente->verifCli($request['ced_cli'], $request['nac_id']);
            if(!empty($result)){
                echo json_encode(true);
            }else {
                $this->cliente->save();
                echo json_encode(false);
            }
        }
        else {
            header('location: /clientes');
        }

    }

    public function verify($request)
    {
        return empty($request['ced_cli']) OR empty($request['nom_cli']);

    }

    public function updateCliente($request)
    {
        if($this->isAjax()){
            $request = (object)$request;
            $this->cliente->setId($request->id);
            $this->cliente->setNomCli($request->nom_cli);
            $this->cliente->setApeCli($request->ape_cli);
            $this->cliente->setDirCli($request->dir_cli);
            $this->cliente->setTelfCli($request->telf_cli);
            $this->cliente->setUpdateAt($this->date);
            $res = $this->cliente->update();
            if($res == true){
                 $this->msg->success('Cliente Modificado con Exito ');
            }
            else {
                 $this->msg->error('Ocurrio un Error intente nuevamente');
            }
        }
        else{
            header('location: /clientes/listado');
        }
    }

    public function listado()
    {
        $menu = 2;
        $cliente = $this->cliente->getAllCliente();
        $this->render('clientes/listado', compact('cliente', 'menu'));
    }

    public function delete($request)
    {
        if($this->isAjax()){
            $this->cliente->deleteById($request['id']);
        }
        else{
            header('location: /clientes/listado');
        }
    }
}

?>
