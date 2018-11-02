<?php
defined('BASEPATH') or exit ("NO SE PERMITE EL ACCESO");
/**
*
*/

class ViewPdf
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
            require_once("../app/core/libs/dompdf/dompdf_config.inc.php");
            require_once '../views/'.$this->controller_name.'.php';
            $dompdf = new DOMPDF();
            $dompdf->load_html(ob_get_clean());
            $dompdf->render();
            $pdf = $dompdf->output();
            $filename = $this->controller_name.Date('Y-m-d H:i:s').'.pdf';
            //file_put_contents($filename, $pdf);
            $dompdf->stream($filename, array("Attachment" => false));

        }
        else{
            header('location: /home');
        }
    }


}


?>
