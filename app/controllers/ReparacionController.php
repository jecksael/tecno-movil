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
require '../app/models/Producto.php';
/**
*
*/
class ReparacionController extends BaseController
{
    private $marca;
    private $servicio;
    private $tipo_pago;
    private $usuarios;
    private $reparacion;
    private $repueseto;
    private $cliente;
    private $equipo;
    private $producto;
    public function __construct()
    {
        parent::__construct();
        $this->producto = new Producto();
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

        $menu = 1;
        $producto = $this->producto->getAllPro();
        $tecnicos = $this->usuarios->getTecnicos();
        $pago = $this->tipoPago->getAll();
        $this->render('/reparacion/newReparacion', compact('menu', 'pago','tecnicos', 'producto'));
    }
    public function loadMarca()
    {
        if($this->isAjax()){
            $marca = $this->marca->getAllMarcas();
            echo json_encode($marca);
        }
        else{
            header('location: /reparacion');
        }
    }

    public function loadServicio()
    {
        if($this->isAjax()){
            $servicio = $this->servicio->getAll();
            echo json_encode($servicio);
        }
        else{
            header('location: /reparacion');
        }
    }

    public function loadEquipo()
    {
        if($this->isAjax()){
            $equipo = $this->equipo->getAll();
            echo json_encode($equipo);
        }
        else{
            header('location:/reparacion');
        }
    }

    public function newServiceAjax($request)
    {
        if($this->isAjax()){
            $this->servicio->setServicio($request['servicio']);
            $result = $this->servicio->save();
            echo ($result);

        }
        else {

        }
    }
    public function deleteServicio($request)
    {
        if($this->isAjax()){
            $delete = $this->servicio->deleteById($request['id']);
            if($delete){
                $this->msg->success('Servicio eliminado con exito ..!!');
            }
            else{
                $this->msg->error('Ocurrio un error intenta nuevamente ..!!');
            }

        }

    }

    public function editServicio($request)
    {
        if($this->isAjax()){
            $this->servicio->setId($request['id']);
            $this->servicio->setServicio($request['servicio']);
            $update = $this->servicio->update();
            if($update){
                $this->msg->success('Servicio Modificado con Exito ...!');
            }
            else{
                $this->msg->error('Ocurrio un erro intenta nuevamente .. !');
            }
        }
    }

    public function servicios()
    {
        $menu = 2;
        $this->render('/reparacion/servicios',compact('menu'));
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
        $id = $this->session->get('id');
        $result = $this->reparacion->reparaciones_espera_tecn($id);
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



    public function save($request)
    {
        if($this->isAjax()){
            $this->reparacion->setUsuId($this->session->get('id'));
            $this->reparacion->setCedId($request['ced_id']);
            $this->reparacion->setMarcaId($request['marca']);
            $this->reparacion->setModelo($request['modelo']);
            $this->reparacion->setColor($request['color']);
            $this->reparacion->setServicio($request['servicio_id']);
            $this->reparacion->setDetalleServ($request['detalle_serv']);
            $this->reparacion->setImei($request['imei']);
            $this->reparacion->setAcceRecb($request['acce_recb']);
            $this->reparacion->setPagoId($request['tipo_pago']);
            $this->reparacion->setStatusId(1);
            $this->reparacion->setEntregaId(1);
            $this->reparacion->setTecnicoId($request['tecnico_id']);
            $this->reparacion->setMontoServ($request['monto_repa']);
            $this->reparacion->setMontoRepu($request['monto_repu']);
            $this->reparacion->setReferencia($request['referencia']);
            $this->reparacion->setTotal($request['total_total']);
            $this->reparacion->setEquipoId($request['equipo']);
            $save = $this->reparacion->save();

            if(!empty($request['valor'])){
                $res = $this->reparacion->select_id();
                $id = $res->id;
                $cod_pro = explode(',', $request['valor']);
                foreach ($cod_pro as  $value) {
                    $this->repuesto->setCodProId($value);
                    $this->repuesto->setReparacionId($id);
                    $this->repuesto->save();

                }
            }



        }
    }

}
?>
