<?php

/**
*
*/
class Repuesto extends EntidadBase
{
    private $table;
    private $id;
    private $cod_pro_id;
    private $reparacion_id;
    public function __construct()
    {
        $this->table = 'repuesto';
        $table = 'repuesto';
        parent::__construct($table);
    }

    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    public function setCodProId($cod_pro_id)
    {
        $this->cod_pro_id = $cod_pro_id;

        return $this;
    }

    public function setReparacionId($reparacion_id)
    {
        $this->reparacion_id = $reparacion_id;

        return $this;
    }

    public function save()
    {
        $query = "INSERT INTO $this->table (id, cod_pro_id, reparacion_id)
            VALUES(
            NULL,
            '$this->cod_pro_id',
            '$this->reparacion_id')";

            $save = $this->db->query($query);
            return $save;
    }

    public function getByRepa($id)
    {
        $query = $this->db->query("SELECT TP.cod_pro, TP.des_pro, TP.pre_ven, TDP.* FROM $this->table AS TDP INNER JOIN producto AS TP ON TDP.cod_pro_id=TP.cod_pro WHERE TDP.reparacion_id = $id ");
        while($row = $query->fetch_object()){
            $result[] = $row;
        }
        return $result;
    }

}

?>
