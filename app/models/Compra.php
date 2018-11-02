<?php

class Compra extends EntidadBase
{
    private $id;
    private $rif_id;
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
        $this->table = 'compra';
        $table = 'compra';
        parent::__construct($table);
    }


    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getPru()
    {
        return $this->created_at;
    }

    public function setRifId($rif_id)
    {
        $this->rif_id = $rif_id;

        return $this;
    }

    public function setUsuId($usu_id)
    {
        $this->usu_id = $usu_id;

        return $this;
    }

    public function setIva($iva)
    {
        $this->iva = str_replace(',', '',$iva);

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

    public function setCreatedAt()
    {
        $this->created_at = date('Y-m-d H:i');

        return $this;
    }


    public function setPagoId($pago_id)
    {
        $this->pago_id = $pago_id;

        return $this;
    }

    public function setReferencia($referencia)
    {
        $this->referencia = $referencia;

        return $this;
    }

    public function save()
    {
        $query = "INSERT INTO $this->table (id, rif_id, usu_id, pago_id, referencia, iva, big, total, created_at)
            VALUES ( NULL,
                    '$this->rif_id',
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

    public function reporte_factura_compra($desde, $hasta)
    {
        $query=$this->db->query("SELECT TP.* ,TPR.*, TU.nombre , TC.* FROM $this->table AS TC  INNER JOIN tipo_pago AS TP ON TC.pago_id=TP.id INNER JOIN proveedor AS TPR ON TC.rif_id=TPR.id INNER JOIN tbl_usuarios TU ON TC.usu_id=TU.id WHERE TC.created_at   BETWEEN '$desde' AND '$hasta' "); //OR trigger_error ($this->db->error);
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
        $query=$this->db->query("SELECT TP.* ,TPR.*, TU.nombre , TC.* FROM $this->table AS TC  INNER JOIN tipo_pago AS TP ON TC.pago_id=TP.id INNER JOIN proveedor AS TPR ON TC.rif_id=TPR.id INNER JOIN tbl_usuarios AS TU ON TC.usu_id=TU.id WHERE TC.id = $id");
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
