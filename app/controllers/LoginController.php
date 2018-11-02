<?php
defined('BASEPATH') or exit ("NO SE PERMITE EL ACCESO");

//require_once FOLDER . '/public/app/models/Home.php';
require '../app/models/Usuarios.php';
require '../app/models/Reparaciones.php';


class LoginController extends BaseController
{
    private $model;
    private $reparaciones;

    public function __construct()
    {
        parent::__construct();
        if(!empty($this->session->get('email')))
            header('location: /entrada');

        $this->reparaciones = new Reparaciones();
        $this->model = new Usuarios();

    }

    public function index()
    {
        if(!empty($this->session->get('email'))){
            header('location: /entrada');
        }
        else{

            $this->session->close();
            $this->render('/login/login');
        }
    }

    public function login($request)
    {
        if($this->verify($request))
            return $this->renderErrorMessage('El Email y Password Obligatorios !!');
        $this->model->setEmail($request['email']);
        $this->model->setPassword($request['password']);
        $result = $this->model->signIn();

        if(!$result != ''){
            return $this->renderErrorMessage('Usuario o Contraseña Incorrectos');
        }
        else {
            $this->session->init();
            $repa = $this->reparaciones->reparaciones_caduca();
            $this->session->add('id', $result[0]->id);
            $this->session->add('email', $result[0]->email);
            $this->session->add('cargo', $result[0]->cargo_id);
            $this->session->add('nombre', $result[0]->nombre);
            header('location: /entrada');
        }

    }

    public function verify($request)
    {
        return empty($request['email']) OR empty($request['password']);
    }

    public function renderErrorMessage($message)
    {
        $param = array('error_message' => $message);
        $this->session->close();
        $this->render('/login/login', $param);
    }

    public function ver()
    {
        //$res = $this->model->getAll();
        $this->render('login/lista');
    }

    public function logout()
    {
        $this->session->close();
        header ('location: /login');
    }

}

?>
