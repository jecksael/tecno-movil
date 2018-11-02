<?php

class Equipo extends EntidadBase
{
    private $id;
    private $equipo;
    private $table;


    public function __construct()
    {
        $this->table = 'equipo';
        $table = 'equipo';
        parent::__construct($table);
    }




    public function setEquipo($equipo)
    {
        $this->equipo = ucwords(mb_strtolower($equipo));

        return $this;
    }

    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }
    public function save()
    {
        $query = "INSERT INTO $this->table (id, equipo) VALUES (NULL, '".$this->equipo."')";
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
        $query = "UPDATE $this->table SET equipo = '".$this->equipo."'  WHERE id = $this->id";
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
