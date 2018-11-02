<?php
defined('BASEPATH') or exit ("NO SE PERMITE EL ACCESO");
/**
*
*/

class View
{
    protected $template;

    protected $controller_name;

    protected $param;

    private $session;

    function __construct($controller_name, $param = array())
    {

        $this->controller_name = $controller_name;
        $this->param = $param;
        $this->render();


    }

   public function render(){

        extract($this->param);

        if($this->controller_name != 'error'){
            require_once '../views/layout/header.php';
            require_once '../views/layout/menu.php';
            $msg = $this->msg = new \Plasticbrain\FlashMessages\FlashMessages();
            require_once '../views/'.$this->controller_name.'.php';

            require_once '../views/layout/footer.php';
        }
        else{
            require_once '../views/'.$this->controller_name.'.php';
        }
    }


}


?>
