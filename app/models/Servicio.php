<?php
/**
*
*/
class Servicio extends EntidadBase
{
    private $table;
    private $id;
    private $servicio;

    public function __construct()
    {
        $table = 'servicio';
        $this->table = 'servicio';
        parent::__construct($table);
    }


    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    public function setServicio($servicio)
    {
        $this->servicio = strtoupper($servicio);

        return $this;
    }

    public function save()
    {
        $query = "INSERT INTO $this->table (id,servicio) VALUES(NULL, '$this->servicio')";
        $save = $this->db->query($query);
        return $save;
    }

    public function update()
    {
        $query = "UPDATE $this->table SET servicio ='$this->servicio' WHERE id = $this->id";
        $update = $this->db->query($query);
        return $update;
    }
}

?>
