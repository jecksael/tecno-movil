<?php
/**
*
*/
class Reparaciones extends EntidadBase
{
    private $id;
    private $ced_id;
    private $usu_id;
    private $equipo_id;
    private $marca_id;
    private $modelo;
    private $color;
    private $servicio;
    private $detalle_serv;
    private $imei;
    private $acce_recb;
    private $pago_id;
    private $referencia;
    private $status_id;
    private $entrega_id;
    private $tecnico_id;
    private $monto_serv;
    private $monto_repu;
    private $total;
    private $created_at;
    private $update_at;
    private $table;
    public function __construct()
    {
        $table = 'reparaciones';
        $this->created_at = date('Y-m-d H:i');
        $this->update_at = date('Y-m-d H:i');
        $this->table = 'reparaciones';
        parent::__construct($table);
    }


    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }


    public function setCedId($ced_id)
    {
        $this->ced_id = $ced_id;

        return $this;
    }
    public function setEquipoId($equipo_id)
    {
        $this->equipo_id = $equipo_id;
    }

    public function setMarcaId($marca_id)
    {
        $this->marca_id = $marca_id;

        return $this;
    }

    public function setModelo($modelo)
    {
        $this->modelo = ucwords((mb_strtolower($modelo)));
        return $this;
    }

    public function setColor($color)
    {
        $this->color = ucwords(mb_strtolower($color));

        return $this;
    }

    public function setServicio($servicio)
    {
        $this->servicio =  implode(',',$servicio);

        return $this;
    }

    public function setDetalleServ($detalle_serv)
    {
        $this->detalle_serv = ucwords(mb_strtolower($detalle_serv));

        return $this;
    }

    public function setImei($imei)
    {
        $this->imei = $imei;

        return $this;
    }

    public function setAcceRecb($acce_recb)
    {
        $this->acce_recb = implode(',', $acce_recb);

        return $this;
    }

    public function setPagoId($pago_id)
    {
        $this->pago_id = $pago_id;

        return $this;
    }

    public function setStatusId($status_id)
    {
        $this->status_id = $status_id;

        return $this;
    }

    public function setEntregaId($entrega_id)
    {
        $this->entrega_id = $entrega_id;

        return $this;
    }

    public function setTecnicoId($tecnico_id)
    {
        $this->tecnico_id = $tecnico_id;

        return $this;
    }

    public function setMontoServ($monto_serv)
    {
        $this->monto_serv = str_replace(',', '', $monto_serv);

        return $this;
    }

    public function setMontoRepu($monto_repu)
    {
        $this->monto_repu = str_replace(',', '', $monto_repu);

        return $this;
    }

    public function setTotal($total)
    {
        $this->total = str_replace(',', '', $total);

        return $this;
    }

    public function setReferencia($referencia)
    {
        $this->referencia = $referencia;

        return $this;
    }
    public function setUsuId($usu_id)
    {
        $this->usu_id = $usu_id;

        return $this;
    }

    public function reparaciones_caduca()
    {

        $hoy =date ('Y-m-d 00:59');
        $antes = strtotime('-16 day', strtotime($hoy));
        $caduca =date('Y-m-d', $antes);
        $sql = "UPDATE $this->table SET entrega_id = 3 WHERE created_at <= '$caduca' AND entrega_id !=2";
        $res = $this->db->query($sql);

        
    }

    public function save()
    {
        $query = "INSERT INTO $this->table (id, ced_id, usu_id, equipo_id, marca_id, modelo, color, servicio, detalle_serv, imei, acce_recb, pago_id, referencia, status_id, entrega_id, tecnico_id, monto_serv, monto_repu, total, created_at)
        VALUES(
        NULL,
        '$this->ced_id',
        '$this->usu_id',
        '$this->equipo_id',
        '$this->marca_id',
        '$this->modelo',
        '$this->color',
        '$this->servicio',
        '$this->detalle_serv',
        '$this->imei',
        '$this->acce_recb',
        '$this->pago_id',
        '$this->referencia',
        '$this->status_id',
        '$this->entrega_id',
        '$this->tecnico_id',
        '$this->monto_serv',
        '$this->monto_repu',
        '$this->total',
        '$this->created_at')";
        $save = $this->db->query($query);
        return $save;
    }

    public function select_id()
    {
        $query =$this->db->query("SELECT id FROM $this->table ORDER BY id DESC LIMIT 1");
        $res = $query->fetch_object();
        return $res;
    }

    public function reparaciones_espera()
    {

        $query = $this->db->query("SELECT TCL.nom_cli, TU.nombre, TU.apellido, TEQI.equipo, TRP.id, TRP.servicio, TRP.total, TRP.created_at FROM $this->table AS TRP INNER JOIN clientes AS TCL ON TRP.ced_id=TCL.id INNER JOIN equipo AS TEQI ON TRP.equipo_id=TEQI.id INNER JOIN tbl_usuarios AS TU ON TRP.tecnico_id=TU.id WHERE TRP.status_id =1 AND TRP.entrega_id=1");
        if($query->num_rows == 0){
            return $result = '';
        }
        else{
            while($row = $query->fetch_object()){
                $result[]=$row;
            }
            return $result;
        }
    }
    public function reparaciones_espera_tecn($id)
    {

        $query = $this->db->query("SELECT TCL.nom_cli, TU.nombre, TEQI.equipo, TRP.id, TRP.servicio, TRP.total, TRP.created_at FROM $this->table AS TRP INNER JOIN clientes AS TCL ON TRP.ced_id=TCL.id INNER JOIN equipo AS TEQI ON TRP.equipo_id=TEQI.id INNER JOIN tbl_usuarios AS TU ON TRP.tecnico_id=TU.id WHERE TRP.status_id =1 AND TRP.entrega_id=1 AND TRP.tecnico_id = $id");
        if($query->num_rows == 0){
            return $result = '';
        }
        else{
            while($row = $query->fetch_object()){
                $result[]=$row;
            }
            return $result;
        }
    }    

    public function reparaciones_id($id)
    {
        $query = $this->db->query("SELECT TCL.*, TEQI.equipo, TMA.marca, TP.pago, TU.nombre, TSRP.status, TSENT.entrega, TRP.* FROM $this->table AS TRP INNER JOIN clientes AS  TCL ON TRP.ced_id=TCL.id INNER JOIN marca AS TMA ON TRP.marca_id=TMA.id INNER JOIN tipo_pago AS TP ON TRP.pago_id=TP.id INNER JOIN equipo as TEQI ON TRP.equipo_id=TEQI.id INNER JOIN tbl_usuarios AS TU ON TRP.tecnico_id=TU.id INNER JOIN status AS TSRP ON TRP.status_id=TSRP.id INNER JOIN entrega AS TSENT ON TRP.entrega_id=TSENT.id WHERE TRP.id=$id");
        $row = $query->fetch_object();
        $result[]=$row;
        return $result;
    }

    public function update_status_reparacion($id)
    {
        $query = "UPDATE $this->table SET status_id = $this->status_id WHERE id = $id ";
        $update = $this->db->query($query);
        return $update;
    }

    public function update_status_entrega($id)
    {
        $query = "UPDATE $this->table SET entrega_id = $this->entrega_id, update_at = '$this->update_at' WHERE id = $id ";
        $update = $this->db->query($query);
        return $update;
    }

    public function reparaciones_realizada()
    {

        $query = $this->db->query("SELECT TCL.nom_cli, TU.nombre, TEQI.equipo, TSTA.status, TRP.id, TRP.status_id, TRP.servicio, TRP.total, TRP.created_at FROM $this->table AS TRP INNER JOIN clientes AS TCL ON TRP.ced_id=TCL.id INNER JOIN equipo AS TEQI ON TRP.equipo_id=TEQI.id INNER JOIN tbl_usuarios AS TU ON TRP.tecnico_id=TU.id INNER JOIN status AS TSTA ON TRP.status_id=TSTA.id WHERE TRP.status_id !=1 AND TRP.entrega_id=1");
        if($query->num_rows == 0){
            return $result = '';
        }
        else{
            while($row = $query->fetch_object()){
                $result[]=$row;
            }
            return $result;
        }
    }

    public function reparaciones_realizada_tecn($id)
    {

        $query = $this->db->query("SELECT TCL.nom_cli, TU.nombre, TEQI.equipo, TSTA.status, TRP.id, TRP.status_id, TRP.servicio, TRP.total, TRP.created_at FROM $this->table AS TRP INNER JOIN clientes AS TCL ON TRP.ced_id=TCL.id INNER JOIN equipo AS TEQI ON TRP.equipo_id=TEQI.id INNER JOIN tbl_usuarios AS TU ON TRP.tecnico_id=TU.id INNER JOIN status AS TSTA ON TRP.status_id=TSTA.id WHERE TRP.status_id !=1 AND TRP.entrega_id=1 AND tecnico_id = $id");
        if($query->num_rows == 0){
            return $result = '';
        }
        else{
            while($row = $query->fetch_object()){
                $result[]=$row;
            }
            return $result;
        }
    }    

    public function reparaciones_caducadas()
    {

        $query = $this->db->query("SELECT TCL.nom_cli, TU.nombre, TSTA.status, TRP.id, TRP.status_id, TRP.servicio, TRP.total, TRP.created_at FROM $this->table AS TRP INNER JOIN clientes AS TCL ON TRP.ced_id=TCL.id INNER JOIN tbl_usuarios AS TU ON TRP.tecnico_id=TU.id INNER JOIN status AS TSTA ON TRP.status_id=TSTA.id WHERE TRP.entrega_id=3");
        if($query->num_rows == 0){
            return $result = '';
        }
        else{
            while($row = $query->fetch_object()){
                $result[]=$row;
            }
            return $result;
        }
    }

    public function reparaciones_ced($ced_cli)
    {
        $query = $this->db->query("SELECT TC.*, TU.nombre, TST.status, TEQI.equipo, TRP.id, TRP.created_at, TRP.update_at, TRP.status_id, TRP.entrega_id, TRP.servicio, TRP.total FROM $this->table AS TRP INNER JOIN clientes AS TC ON TRP.ced_id=TC.id INNER JOIN status AS TST ON TRP.status_id=TST.id INNER JOIN equipo as TEQI ON TRP.equipo_id=TEQI.id INNER JOIN tbl_usuarios AS TU ON TRP.tecnico_id=TU.id   WHERE TRP.ced_id = $ced_cli ORDER BY TRP.created_at DESC ");
        if($query->num_rows == 0){
            return $result = '';
        }
        else{
            while($row = $query->fetch_object()){
                $result[] = $row;
            }
            return $result;
        }
    }

    public function reporte_reparaciones_tecnico($desde,$hasta)
    {
        $query = $this->db->query("SELECT TC.nom_cli, TEQI.equipo, TSTA.status, TM.marca, TRP.id, TRP.servicio, TRP.modelo, TRP.update_at, TRP.monto_serv, TRP.status_id FROM $this->table AS TRP INNER JOIN clientes AS TC ON TRP.ced_id=TC.id INNER JOIN equipo as TEQI ON TRP.equipo_id=TEQI.id INNER JOIN marca AS TM ON TRP.marca_id = TM.id INNER JOIN status AS TSTA ON TRP.status_id=TSTA.id WHERE TRP.tecnico_id = $this->tecnico_id AND TRP.update_at BETWEEN '$desde' AND '$hasta' ");
        if($query->num_rows ==0 ){
            return $result ='';
        }
        else{
            while($row = $query->fetch_object()){
                $result[]=$row;
            }
            return $result;
        }
    }

    public function reporte_reparaciones_all($desde,$hasta)
    {
        $query = $this->db->query("SELECT TC.nom_cli, TEQI.equipo, TU.nombre, TSTA.status, TM.marca, TRP.id, TRP.servicio, TRP.modelo, TRP.update_at, TRP.monto_serv, TRP.status_id FROM $this->table AS TRP INNER JOIN clientes AS TC ON TRP.ced_id=TC.id INNER JOIN equipo as TEQI ON TRP.equipo_id=TEQI.id INNER JOIN marca AS TM ON TRP.marca_id = TM.id INNER JOIN tbl_usuarios AS TU ON TRP.tecnico_id=TU.id INNER JOIN status AS TSTA ON TRP.status_id=TSTA.id WHERE  TRP.update_at BETWEEN '$desde' AND '$hasta' ");
        if($query->num_rows == 0){
            return $result='';
        }
        else {
            while($row = $query->fetch_object()){
                $result[]=$row;
            }
            return $result;

        }
    }

    public function reparaciones_imp($usu)
    {
        $query = $this->db->query("SELECT TCL.*, TMA.marca, TP.pago, TU.nombre,TU.apellido, TSRP.status, TSENT.entrega, TRP.* FROM $this->table AS TRP INNER JOIN clientes AS  TCL ON TRP.ced_id=TCL.id INNER JOIN marca AS TMA ON TRP.marca_id=TMA.id INNER JOIN tipo_pago AS TP ON TRP.pago_id=TP.id INNER JOIN tbl_usuarios AS TU ON TRP.tecnico_id=TU.id INNER JOIN status AS TSRP ON TRP.status_id=TSRP.id INNER JOIN entrega AS TSENT ON TRP.entrega_id=TSENT.id  WHERE TRP.usu_id=$usu ORDER BY TRP.id DESC LIMIT 1"  );
        $row = $query->fetch_object();
        $result[]=$row;
        return $result;
    }



}


?>
