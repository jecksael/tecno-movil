<?php
defined('BASEPATH') or exit ("NO SE PERMITE EL ACCESO");
//require '../app/models/Cliente.php';
require '../app/models/Marca.php';
require '../app/models/Servicio.php';
require '../app/models/TipoPago.php';
require '../app/models/Usuarios.php';
require '../app/models/Reparaciones.php';
require '../app/models/Repuesto.php';
require '../app/models/Cliente.php';
require '../app/models/Equipo.php';
/**
*
*/
class ReparacionvendeController extends BaseController
{
    private $marca;
    private $servicio;
    private $tipo_pago;
    private $usuarios;
    private $reparacion;
    private $repueseto;
    private $cliente;
    private $equipo;
    public function __construct()
    {
        parent::__construct();
        $this->marca = new Marca();
        $this->equipo = new Equipo();
        $this->tipoPago = new TipoPago();
        $this->servicio = new Servicio();
        $this->usuarios = new Usuarios();
        $this->reparacion = new Reparaciones();
        $this->repuesto = new Repuesto();
        $this->cliente = new Cliente();
        if($this->session->getStatus() == 1 || empty($this->session->get('email')))
            header('location: /login');
    }


    public function index()
    {
       $menu = 4;
       $this->render ('/reparacion/reparacion_num_ser', compact('menu'));
    }
    /*
    REPARACIONES EN ESPERA
     */
    public function reparacion_espera()
    {
        $menu =1;
        $result = $this->reparacion->reparaciones_espera();
        $this->render('/reparacion/reparacion_espera',compact('menu','result'));
    }

    public function reparacion_espera_tecn()
    {
        $menu =1;
        $result = $this->reparacion->reparaciones_espera_tecn($this->session->get('id'));
        $this->render('/reparacion/reparacion_espera_tecn',compact('menu','result'));
    }    

    public function busca_reparacion_id($request)
    {
        if($this->isAjax()){
            $id = $request['id'];
            $result = $this->reparacion->reparaciones_id($id);
            echo json_encode($result);
        }
    }

    public function update_status_reparacion($request)
    {
        if($this->isAjax()){
            $id = $request['id'];
            $this->reparacion->setStatusId($request['status']);
            $update = $this->reparacion->update_status_reparacion($id);
            echo ($update);

        }
    }
    /*
    BUSCAR LOS REPUESTOS UTILIZADOS EN LA REPARACION
     */
    public function busca_producto_reparacion($request)
    {
        if($this->isAjax()){
            $id = $request['id'];
            $result = $this->repuesto->getByRepa($id);
            echo json_encode($result);
        }
    }
    /*
    REPARACIONES POR ENTREGAR
     */
    public function reparacion_realizada()
    {
        $menu = 2;
        $result = $this->reparacion->reparaciones_realizada();
        $this->render('/reparacion/reparacion_realizada',compact('menu','result'));
    }

    public function reparacion_realizada_tecn()
    {
        
        $result = $this->reparacion->reparaciones_realizada_tecn($this->session->get('id'));
        $this->render('/reparacion/reparacion_realizada_tecn',compact('result'));
    }    

    public function update_status_entrega($request)
    {
        if($this->isAjax()){
            $id = $request['id'];
            $this->reparacion->setEntregaId($request['status_id']);
            $update = $this->reparacion->update_status_entrega($id);
            echo($update);
        }
    }
    /*
    REPARACIONES POR CEDULA
     */
    public function reparacion_ced($request)
    {

        $menu = 3;
        $this->render('/reparacion/reparacion_ced',compact('menu'));

    }

    public function busca_reparacion_ced($request)
    {
        $menu = 3;
        $ced = $request['ced_cli'];
        $nac = $request['nac_id'];
        $result = $this->cliente->getCliente($nac,$ced);
        if($result == null){
            $this->msg->error('El numero de cedula no existe..!!');
            header('location: /reparacion/reparacion_ced');
        }
        else{
            $ced_id = $result->id;
            $result = $this->reparacion->reparaciones_ced($ced_id);
            if(empty($result)){
                $this->msg->error("El cliente, no posee reparaciones registradas..!!");
                header('location: /reparacion/reparacion_ced');
            }
            else{
                $this->render('/reparacion/reparacion_ced',compact('menu','result'));
            }

        }
    }

    /*
    REPARACION NUMERO DE SEVICIO
     */
    public function reparacion_num_ser()
    {
        $menu = 4;
        $this->render ('/reparacion/reparacion_num_ser', compact('menu'));
    }

    public function busca_reparacion_num_ser($request)
    {
        $menu = 4;
        $id = $request['id'];
        $result = $this->reparacion->reparaciones_id($id);
        if(empty($result[0])){
            $this->msg->error('El numero de servicio no existe en los registros ...!!');
            header('location: /reparacion/reparacion_num_ser');
        }
        else {
            if($result[0]->monto_repu == 0){

                $this->render('/reparacion/reparacion_num_ser', compact('menu','result'));

            }
            else{
                $id = $result[0]->id;
                $result2 =  $this->repuesto->getByRepa($id);
                $this->render('/reparacion/reparacion_num_ser', compact('menu','result','result2'));

            }

        }
    }
    /*
    REPARACIONES CADUCADAS
     */
    public function reparacion_caducada()
    {
        $menu = 5;
        $result = $this->reparacion->reparaciones_caducadas();
        $this->render ('/reparacion/reparacion_caducada', compact('menu', 'result'));
    }


}
?>
