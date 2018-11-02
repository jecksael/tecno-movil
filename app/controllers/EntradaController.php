<?php
defined('BASEPATH') or exit ("NO SE PERMITE EL ACCESO");
require '../app/models/Producto.php';

class EntradaController extends BaseController
{

    private $producto;

    public function __construct()
    {
        $this->producto = new Producto();
        parent::__construct();
        if($this->session->getStatus() == 1 || empty($this->session->get('email')))
            header('location: /login');
    }

    public function index()
    {
        $producto = $this->producto->get_pro_home();
        $this->render('home' , compact('producto'));
    }

    public function logout()
    {
    $this->session->close();
    header('location: /login');
    }
}

?>
