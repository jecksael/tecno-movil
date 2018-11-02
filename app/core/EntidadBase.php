<?php

class EntidadBase extends Conectar
{
    private $table;
    public function __construct($table)
    {
        $this->table=(string) $table;
        parent::__construct();
    }

    public function getAll()
    {
        $query=$this->db->query("SELECT * FROM $this->table ORDER BY id DESC");
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
    public function getAllMarcas()
    {
        $query=$this->db->query("SELECT * FROM $this->table ORDER BY marca asc");
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


    public function getById($id){
        $query=$this->db->query("SELECT * FROM $this->table WHERE id=$id");

        if($query->num_rows >0) {
            $row = $query->fetch_object();
            $resultSet[]=$row;
        }
        else {
            $resultSet = '';
        }

        return $resultSet;
    }

    public function getBy($column,$value){
        $query=$this->db->query("SELECT * FROM $this->table WHERE $column='$value'");
        if($query->num_rows == 0){
            return $resultSet = '';
        }
        else{
            while($row = $query->fetch_object()) {
               $resultSet[]=$row;
            }

            return $resultSet;
        }
    }

    public function deleteById($id){
        $query=$this->db->query("DELETE FROM $this->table WHERE id=$id");
        return $query;
    }

    public function deleteBy($column,$value){
        $query=$this->db->query("DELETE FROM $this->table WHERE $column='$value'");
        return $query;
    }
}

?>
