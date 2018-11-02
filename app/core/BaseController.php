<?php
defined('BASEPATH') or exit ("NO SE PERMITE EL ACCESO");

require '../app/core/libs/Session.php';
abstract class BaseController
{
    //public $session;
    private $view;
    public $date;
    protected $session;
    public $msg;
    public function __construct()
    {
       // echo __CLASS__ . 'instanciada';
        $this->date = date('Y-m-d H:i');
        $this->session = new Session();
        $this->session->init();
        $this->msg = new \Plasticbrain\FlashMessages\FlashMessages();

    }

    protected function render($controller_name = '', $param = array())
    {
        $this->view = new View($controller_name, $param);

    }


    abstract public function index();

    protected function renderPdf($controller_name = '', $param = array())
    {
        $this->view = new ViewPdf($controller_name, $param);
    }

    public function isAjax(){

       if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {

            return true;
        }else{

            return false;
        }

    }

}

?>
