<?php

class Cargo extends EntidadBase
{
    private $id;
    private $cargo;
    private $table;

    public function __construct()
    {
        $this->table = 'cargo';
        $table = 'cargo';
        parent::__construct($table);
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getCargo()
    {
        return $this->cargo;
    }

    public function setCargo($cargo)
    {
        $this->cargo = ucwords(mb_strtolower($cargo));
    }

    public function getAllCargo()
    {
        $query=$this->db->query("SELECT * FROM $this->table WHERE id != 1 ORDER BY id DESC");

        while ($row = $query->fetch_object()) {
           $resultSet[]=$row;
        }

        return $resultSet;
    }

}

?>
