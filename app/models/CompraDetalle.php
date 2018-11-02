<?php

class CompraDetalle extends Entidadbase
{
    private $id;
    private $compra_id;
    private $cod_pro_id;
    private $cant;
    private $sub_total;
    private $table;
    public function __construct()
    {
        $this->table='compra_detalle';
        $table='compra_detalle';
        parent::__construct($table);
    }


    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }



    public function setCompraId($compra_id)
    {
        $this->compra_id = $compra_id;

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
        $query = "INSERT INTO $this->table (id, compra_id, cod_pro_id, cant, sub_total)
            VALUES(
                NULL,
                '$this->compra_id',
                '$this->cod_pro_id',
                '$this->cant',
                '$this->sub_total')";

            $save = $this->db->query($query);
            return $save;
    }

    public function get_detalle_idfact($id)
    {
        $query=$this->db->query("SELECT TP.*, TD.* FROM $this->table AS TD  INNER JOIN producto AS TP ON TD.cod_pro_id=TP.cod_pro  WHERE TD.compra_id = $id");
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
