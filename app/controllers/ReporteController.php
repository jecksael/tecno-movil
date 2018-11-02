<?php
defined('BASEPATH') or exit ("NO SE PERMITE EL ACCESO");

require '../app/models/Usuarios.php';
require '../app/models/Reparaciones.php';
require '../app/models/Venta.php';
class ReporteController extends BaseController
{
    private $tecnicos;
    private $reparacion;
    private $venta;
    public function __construct()
    {
        $this->tecnicos = new Usuarios();
        $this->reparacion = new Reparaciones();
        $this->venta = new Venta();
        parent::__construct();
        if($this->session->getStatus() == 1 || empty($this->session->get('email')))
            header('location: /login');
    }

    public function index()
    {
        $tecnicos = $this->tecnicos->getTecnicos();
        $menu = 1;
        $this->render('/reportes/reparacion',compact('menu','tecnicos'));
    }

    public function reporte_tecn()
    {
        $this->render('/reportes/reparacion_tecn');
    }

    public function ganancia()
    {
        $menu = 2;
        /*
        BUSCA VENTAS DEL DIA DE HOY
         */
        $desde = date('Y-m-d').' 00:00';
        $hasta = date('Y-m-d').' 23:59';
        $repo_dia = $this->venta->reporte_venta_between($desde,$hasta);

        /*
        BUSCA LAS VENTAS DE LA ULTIMA SSEMANA
         */
        ///DIA 7
        $dia1 = date('Y-m-d');
        $dia1 = strtotime('-7 days', strtotime($dia1));
        $dia1 = date('Y-m-d', $dia1);
        $findia1 =  $dia1.' 23:59';
        $reporte_dia7 = $this->venta->reporte_venta_between($dia1.' 00:00',$findia1);

        ////DIA 6
        $dia2 = date('Y-m-d');
        $dia2 = strtotime('-6 days', strtotime($dia2));
        $dia2 = date('Y-m-d', $dia2);
        $findia2 =  $dia2.' 23:59';
        $reporte_dia6 = $this->venta->reporte_venta_between($dia2.' 00:00',$findia2);

        //DIA 5
        $dia3 = date('Y-m-d');
        $dia3 = strtotime('-5 days', strtotime($dia3));
        $dia3 = date('Y-m-d', $dia3);
        $findia3 =  $dia3.' 23:59';
        $reporte_dia5 = $this->venta->reporte_venta_between($dia3.' 00:00',$findia3);

        //DIA 4
        $dia4 = date('Y-m-d');
        $dia4 = strtotime('-4 days', strtotime($dia4));
        $dia4 = date('Y-m-d', $dia4);
        $findia4 =  $dia4.' 23:59';
        $reporte_dia4 = $this->venta->reporte_venta_between($dia4.' 00:00',$findia4);

        //DIA 3
        $dia5 = date('Y-m-d');
        $dia5 = strtotime('-3 days', strtotime($dia5));
        $dia5 = date('Y-m-d', $dia5);
        $findia5 =  $dia5.' 23:59';
        $reporte_dia3 = $this->venta->reporte_venta_between($dia5.' 00:00',$findia5);

        //DIA 2
        $dia6 = date('Y-m-d');
        $dia6 = strtotime('-2 days', strtotime($dia6));
        $dia6 = date('Y-m-d', $dia6);
        $findia6 =  $dia6.' 23:59';
        $reporte_dia2 = $this->venta->reporte_venta_between($dia6.' 00:00',$findia6);

        //DIA 1
        $dia7 = date('Y-m-d');
        $dia7 = strtotime('-1 days', strtotime($dia7));
        $dia7 = date('Y-m-d', $dia7);
        $findia7 =  $dia7.' 23:59';
        $reporte_dia1 = $this->venta->reporte_venta_between($dia7.' 00:00',$findia7);

        /*
        BUSCA LAS VENTAS DEL LOS ULTIMOS 3 MESES
         */
        //mes 1
        $mes1 = date('Y-m');
        $mes1 = strtotime('-1 month', strtotime($mes1));
        $mes1 = date('Y-m', $mes1);
        $finmes1 = $mes1.'-31 23:59';
        $mes1 = $mes1.'-01 00:00';
        $reporte_mes1 = $this->venta->reporte_venta_between($mes1,$finmes1);

        // MES 2
        $mes2 = date('Y-m');
        $mes2 = strtotime('-2 month', strtotime($mes2));
        $mes2 = date('Y-m', $mes2);
        $finmes2 = $mes2.'-31 23:59';
        $mes2 = $mes2.'-01 00:00';
        $reporte_mes2 = $this->venta->reporte_venta_between($mes2,$finmes2);

        //MES 3
        $mes3 = date('Y-m');
        $mes3 = strtotime('-3 month', strtotime($mes3));
        $mes3 = date('Y-m', $mes3);
        $finmes3 = $mes3.'-31 23:59';
        $mesIni = substr($mes3, 5,2);
        $mes3 = $mes3.'-01 00:00';
        $reporte_mes3 = $this->venta->reporte_venta_between($mes3,$finmes3);

        /*
        BUSCAR VENTAS DEL ULTIMO MES
         */

        $mes = date('Y-m');
        $mes = strtotime('-1 month', strtotime($mes));
        $mes = date('Y-m', $mes);
        /// SEMANA 1
        $semana1 = $mes.'-01 00:00';
        $semana1fin= $mes.'-07 23:59';
        $reporte_semana1 = $this->venta->reporte_venta_between($semana1,$semana1fin);

        //SEMANA 2
        $semana2 = $mes.'-08 00:00';
        $semana2fin= $mes.'-14 23:59';
        $reporte_semana2 = $this->venta->reporte_venta_between($semana2,$semana2fin);

        //SEMANA 3
        $semana3 = $mes.'-15 00:00';
        $semana3fin= $mes.'-21 23:59';
        $reporte_semana3 = $this->venta->reporte_venta_between($semana3,$semana3fin);

        // SEMANA 4
        $semana4 = $mes.'-22 00:00';
        $semana4fin= $mes.'-31 23:59';
        $reporte_semana4 = $this->venta->reporte_venta_between($semana4,$semana4fin);
        $this->render('/reportes/ganancia',compact('menu','repo_dia','reporte_dia1','reporte_dia2','reporte_dia3','reporte_dia4','reporte_dia5','reporte_dia6','reporte_dia7','reporte_mes1', 'reporte_mes2', 'reporte_mes3', 'mesIni' ,'reporte_semana1', 'reporte_semana2', 'reporte_semana3', 'reporte_semana4'));

    }

    public function reporte_reparacion($request)
    {
        $tecnicos = $this->tecnicos->getTecnicos();
        $menu = 1;
        $desde = $request['desde'].' 00:00';
        $hasta = $request['hasta'].' 23:59';
        if($request['tecnico'] == 'all'){
            $result2 = $this->reparacion->reporte_reparaciones_all($desde,$hasta);
            $this->render('/reportes/reparacion', compact('menu','result2', 'tecnicos'));

        }
        else{
            $this->reparacion->setTecnicoId($request['tecnico']);
            $result = $this->reparacion->reporte_reparaciones_tecnico($desde,$hasta);
            $this->render('/reportes/reparacion',compact('menu','result', 'tecnicos'));

        }
    }

    public function reporte_reparacion_tecn($request)
    {
        $tecnicos = $this->tecnicos->getTecnicos();

        $desde = $request['desde'].' 00:00';
        $hasta = $request['hasta'].' 23:59';


            $this->reparacion->setTecnicoId($this->session->get('id'));
            $result = $this->reparacion->reporte_reparaciones_tecnico($desde,$hasta);
            $this->render('/reportes/reparacion_tecn',compact('result', 'tecnicos'));

        
    }    
}
?>
