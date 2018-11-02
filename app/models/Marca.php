<?php

class Marca extends EntidadBase
{
    private $id;
    private $marca;
    private $table;


    public function __construct()
    {
        $this->table = 'marca';
        $table = 'marca';
        parent::__construct($table);
    }


    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    public function getMarca()
    {
        return $this->marca;
    }


    public function setMarca($marca)
    {
        $this->marca = strtoupper($marca);

        return $this;
    }

    public function save()
    {
        $query = "INSERT INTO $this->table (id, marca) VALUES (NULL, '".$this->marca."')";
        $save = $this->db->query($query);
        if($save) {
            return true;
        }
        else{
            return false;
        }
    }

    public function update()
    {
        $query = "UPDATE $this->table SET marca = '".$this->marca."'  WHERE id = $this->id";
        $update = $this->db->query($query);
        if($update){
            return true;
        }
        else{
            return false;
        }
    }

}

?>
