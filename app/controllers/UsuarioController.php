<?php
defined('BASEPATH') or exit ("NO SE PERMITE EL ACCESO");

//require_once FOLDER . '/public/app/models/Home.php';
require '../app/models/Usuarios.php';
require '../app/models/Cargo.php';
class UsuarioController extends BaseController
{

    private $usuarios;
    private $cago;
    public function __construct()
    {
        parent::__construct();
        $this->usuarios = new Usuarios();
        $this->cargo = new Cargo();
        if($this->session->getStatus() == 1 || empty($this->session->get('email')))
            header('location: /login');

    }
    public function index()
    {
        $cargo = $this->cargo->getAllCargo();
        $result = $this->usuarios->getAllUser();
        $this->render('/usuarios/listaUsuario', compact('result', 'cargo'));
    }

    public function create($request)
    {
        $this->usuarios->setNombre($request['name']);
        $this->usuarios->setApellido($request['apellido']);
        $this->usuarios->setEmail($request['email']);
        $this->usuarios->setPassword($request['passUsu']);
        $this->usuarios->setDireccion($request['direccion']);
        $this->usuarios->setTelefono($request['telUsu']);
        $this->usuarios->setCargo($request['carUsu']);
        $this->usuarios->setStatus($request['status']);
        $save = $this->usuarios->create();
        if($save){
            $this->msg->success('Usuario registrado con exito ..!!');
        }
        else {
            $this->msg->error('Ocurrio un error ..!');
        }
        header('location: /usuario');
    }

    public function update($request)
    {
        $this->usuarios->setId($request['id']);
        $this->usuarios->setNombre($request['name']);
        $this->usuarios->setApellido($request['apellido']);
        $this->usuarios->setEmail($request['email']);
        $this->usuarios->setDireccion($request['direccion']);
        $this->usuarios->setTelefono($request['telUsu']);
        $this->usuarios->setCargo($request['carUsu']);
        $this->usuarios->setStatus($request['status']);
        $update = $this->usuarios->update();

       if($update){
            $this->msg->success('Usuario modificado con exito ..!!');
        }
        else{
            $this->msg->error('El email esta siendo usado por otro usuario ..!!');
        }
        header('location: /usuario');

    }

    public function delete($request)
    {
        if($this->isAjax()){
            $result = $this->usuarios->deleteById($request['id']);
            echo $result;
        }
    }

    public function perfil()
    {
        $usuario = $this->usuarios->getByIdUsuario($this->session->get('id'));
        $this->render('/usuarios/perfil',compact('usuario'));
    }

    public function change_pass($request)
    {
        $this->usuarios->setId($request['id']);
        $usu = $this->usuarios->getById($request['id']);
        $this->usuarios->setPassword($request['pass']);
        $oldPass= md5($request['oldPass']);

        if ($usu[0]->password == $oldPass){
            $update = $this->usuarios->update_pass($oldPass);
            if($update){
                $this->session->close();
                header('location: /login');
            }
        }
        else{
            $this->msg->error('La contraseña introduccida como constraseña actual no coincide');
            header('location: /usuario/perfil');
        }
    }
}
 ?>
