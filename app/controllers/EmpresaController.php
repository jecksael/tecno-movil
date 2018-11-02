<?php
defined('BASEPATH') or exit ("NO SE PERMITE EL ACCESO");
require '../app/models/Empresa.php';
/**
*
*/
class EmpresaController extends BaseController
{
    private $empresa;
    public function __construct()
    {
        $this->empresa = new Empresa();
        parent::__construct();
        if($this->session->getStatus() == 1 || empty($this->session->get('email')))
            header('location: /login');
    }

    public function index()
    {
        $empresa = $this->empresa->getById(1);
        $this->render('empresa/empresa', compact('empresa'));
    }

    public function create($request)
    {


        //$logo = $request['url_logo'];
        $type = $_FILES['url_logo']["type"];
        if($type == 'image/png' || $type == 'image/jpg' || $type == 'image/jpeg' ){
            $name = $_FILES['url_logo']["name"];
            $ruta_temp = $_FILES['url_logo']['tmp_name'];
            $ruta = '../public/imagenes/'.$name;
            $imagen =  getimagesize($ruta_temp);
            $ancho = $imagen[0];
            $alto = $imagen[1];

            if ($ancho > 51 && $alto >45){
                $this->msg->error('Error en el tamaño del archivo del logo ..!!');
                header ("location: /empresa");
            }
            else{
                $this->empresa->setRifEmp($request['rif_emp']);
                $this->empresa->setNomEmp($request['nom_emp']);
                $this->empresa->setDirEmp($request['dir_emp']);
                $this->empresa->setEmailEmp($request['email_emp']);
                $this->empresa->setTlfEmp($request['tlf_emp']);
                $this->empresa->setPropietario($request['nom_pro']);
                $this->empresa->setCedPro($request['ced_pro']);
                $this->empresa->setIva($request['iva']);
                $this->empresa->setUrlLogo($name);
                $save = $this->empresa->save();
                if($save == true){
                    header ("location: /empresa");
                    move_uploaded_file($ruta_temp, $ruta);
                    $this->msg->success('La Empresa se Registro Correctamente ..!!');

                }
                else{
                    header ("location: /empresa");
                    $this->msg->error('Ocurrio un Error intente nuevamente ..!!');
                }

            }

        }
        else {
            $this->msg->error('Error en el tipo del archivo del logo ..!!');
            header ("location: /empresa");
        }
    }

    public function update($request)
    {
        $this->empresa->setId(1);
        $this->empresa->setRifEmp($request['rif_emp']);
        $this->empresa->setNomEmp($request['nom_emp']);
        $this->empresa->setDirEmp($request['dir_emp']);
        $this->empresa->setEmailEmp($request['email_emp']);
        $this->empresa->setTlfEmp($request['tlf_emp']);
        $this->empresa->setPropietario($request['nom_pro']);
        $this->empresa->setCedPro($request['ced_pro']);
        $this->empresa->setIva($request['iva']);
        $name = $_FILES['url_logo']['name'];
        $type = $_FILES['url_logo']['type'];
        if(!empty($name)){
            if($type == 'image/png' || $type == 'image/jpg' || $type == 'image/jpeg' ){
            $ruta_temp = $_FILES['url_logo']['tmp_name'];
            $ruta = '../public/imagenes/'.$name;
            $imagen =  getimagesize($ruta_temp);
            $ancho = $imagen[0];
            $alto = $imagen[1];
            if ($ancho > 51 && $alto >45){
                $this->msg->error('Error en el tamaño del archivo del logo ..!!');
                header ("location: /empresa");
            }
            else{
                $this->empresa->setUrlLogo($name);
                $save = $this->empresa->update();
                if($save == true){
                    header ("location: /empresa");
                    move_uploaded_file($ruta_temp, $ruta);
                    $this->msg->success('La Empresa se Registro Correctamente ..!!');

                }
                else{
                    header ("location: /empresa");
                    $this->msg->error('Ocurrio un Error intente nuevamente ..!!');
                }

            }
            }
        }
        else {
            $this->empresa->setUrlLogo($request['url_logo_old']);
            $update = $this->empresa->update();
            if($update == true){
                header("location: /empresa");
                $this->msg->success('Los datos se han actualizado');
            }
            else{
                header("location: /empresa");
                $this->msg->error('Ocurrio un Error intente nuevamente ..!!');
            }
        }
    }


}

?>
