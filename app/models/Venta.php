<?php

/**
*
*/
class Venta extends EntidadBase
{
    private $id;
    private $ced_id;
    private $usu_id;
    private $pago_id;
    private $referencia;
    private $iva;
    private $big;
    private $total;
    private $created_at;
    private $table;

    public function __construct()
    {
        $this->created_at = date('Y-m-d H:i');
        $this->table = 'venta';
        $table = 'venta';
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

    public function setUsuId($usu_id)
    {
        $this->usu_id = $usu_id;

        return $this;
    }

    public function setPagoId($pago_id)
    {
        $this->pago_id = $pago_id;

        return $this;
    }

    public function setIva($iva)
    {
        $this->iva = str_replace(',', '', $iva);

        return $this;
    }

    public function setBig($big)
    {
        $this->big = str_replace(',', '', $big);

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

    public function get()
    {
        return $this->usu_id;
    }
    public function save()
    {
        $query = "INSERT INTO $this->table (id, ced_id, usu_id, pago_id, referencia, iva, big, total, created_at)
            VALUES(
            NULL,
            '$this->ced_id',
            '$this->usu_id',
            '$this->pago_id',
            '$this->referencia',
            '$this->iva',
            '$this->big',
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

    public function reporte_factura_venta($desde,$hasta)
    {
        $query=$this->db->query("SELECT TP.* ,TCL.nom_cli, TU.nombre , TVE.* FROM $this->table AS TVE  INNER JOIN tipo_pago AS TP ON TVE.pago_id=TP.id INNER JOIN clientes AS TCL ON TVE.ced_id=TCL.id INNER JOIN tbl_usuarios TU ON TVE.usu_id=TU.id WHERE TVE.created_at   BETWEEN '$desde' AND '$hasta' "); //OR trigger_error ($this->db->error);
        if ($query->num_rows == 0){
            return $resultSet ='';
        }
        else{

            while ($row = $query->fetch_object()) {
               $resultSet[]=$row;
            }

            return $resultSet;
       }
    }

    public function reporte_factura_id($id)
    {
        $query=$this->db->query("SELECT TP.* ,TCL.*, TU.nombre , TVE.* FROM $this->table AS TVE  INNER JOIN tipo_pago AS TP ON TVE.pago_id=TP.id INNER JOIN clientes AS TCL ON TVE.ced_id=TCL.id INNER JOIN tbl_usuarios TU ON TVE.usu_id=TU.id WHERE TVE.id= $id ");
        if ($query->num_rows == 0){
            return $resultSet ='';
        }
        else{

            while ($row = $query->fetch_object()) {
               $resultSet[]=$row;
            }

            return $resultSet;
       }
    }

    public function reporte_venta_between($desde,$hasta)
    {
        $query = $this->db->query("SELECT SUM(total) FROM $this->table AS TV WHERE TV.created_at BETWEEN '$desde' AND '$hasta' ");

         $row = $query->fetch_array();
            $resultSet = $row;

        return $resultSet;
    }

    public function factura_imp()
    {
        $query=$this->db->query("SELECT TP.* ,TCL.*, TU.nombre , TVE.* FROM $this->table AS TVE  INNER JOIN tipo_pago AS TP ON TVE.pago_id=TP.id INNER JOIN clientes AS TCL ON TVE.ced_id=TCL.id INNER JOIN tbl_usuarios TU ON TVE.usu_id=TU.id WHERE TVE.usu_id= $this->usu_id ORDER BY TVE.id DESC LIMIT 1");
        if ($query->num_rows == 0){
            return $resultSet ='';
        }
        else{

            while ($row = $query->fetch_object()) {
               $resultSet[]=$row;
            }

            return $resultSet;
       }
    }

}
?>
