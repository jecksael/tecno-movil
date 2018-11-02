<?php

/**
*
*/
class VentaDetalle extends EntidadBase
{
    private $id;
    private $venta_id;
    private $cod_pro_id;
    private $cant;
    private $sub_total;
    private $table;
    public function __construct()
    {
        $this->table = 'venta_detalle';
        $table = 'venta_detalle';
        parent::__construct($table);
    }

    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    public function setVentaId($venta_id)
    {
        $this->venta_id = $venta_id;

        return $this;
    }

    public function setCodProId($cod_pro_id)
    {
        $this->cod_pro_id = $cod_pro_id;

        return $this;
    }

    public function setCant($cant)
    {
        $this->cant = $cant;

        return $this;
    }

    public function setSubTotal($sub_total)
    {
        $this->sub_total = $sub_total;

        return $this;
    }
    public function save()
    {
        $query = "INSERT INTO $this->table(id, venta_id, cod_pro_id, cant, sub_total)
            VALUES(
            NULL,
            '$this->venta_id',
            '$this->cod_pro_id',
            '$this->cant',
            '$this->sub_total')";

            $save = $this->db->query($query);
            return $save;
    }

    public function get_detalle_idfact($id)
    {
        $query=$this->db->query("SELECT TP.*, TD.* FROM $this->table AS TD  INNER JOIN producto AS TP ON TD.cod_pro_id=TP.cod_pro  WHERE TD.venta_id = $id");
        /*if ($query->num_rows == 0){
            return $resultSet ='';
        }
        else{
*/
            while ($row = $query->fetch_object()) {
               $resultSet[]=$row;
            }

            return $resultSet;
  //     }
    }
}

?>
