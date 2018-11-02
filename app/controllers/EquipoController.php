<?php
defined('BASEPATH') or exit ("NO SE PERMITE EL ACCESO");
require '../app/models/Equipo.php';
/**
*
*/
class EquipoController extends BaseController
{
    private $equipo;
    public function __construct()
    {
        $this->equipo = new Equipo();
        parent::__construct();
        if($this->session->getStatus() == 1 || empty($this->session->get('email')))
            header('location: /login');
    }

    public function index()
    {
        $equipo = $this->equipo->getById(1);
        $this->render('/reparacion/equipo');
    }

        public function newEquipoAjax($request)
    {
        if($this->isAjax()){
            $this->equipo->setEquipo($request['equipo']);
            $result = $this->equipo->save();
            echo ($result);

        }
        else {

        }
    }

    public function editEquipo($request)
    {
        if($this->isAjax()){
            $this->equipo->setId($request['id']);
            $this->equipo->setEquipo($request['equipo']);
            $update = $this->equipo->update();
            if($update){
                $this->msg->success('Equipo Modificado con Exito ...!');
            }
            else{
                $this->msg->error('Ocurrio un erro intenta nuevamente .. !');
            }
        }
    }
    public function deleteEquipo($request)
    {
        if($this->isAjax()){
            $delete = $this->equipo->deleteById($request['id']);
            if($delete){
                $this->msg->success('Equipo eliminado con exito ..!!');
            }
            else{
                $this->msg->error('Ocurrio un error intenta nuevamente ..!!');
            }

        }

    }




}

?>
