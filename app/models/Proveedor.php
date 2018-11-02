<?php

class Proveedor extends EntidadBase
{
    private $id;
    private $rif_pro;
    private $nom_pro;
    private $dir_pro;
    private $telf_pro;
    private $table;

    public function __construct()
    {
        $table = 'proveedor';
        $this->table = 'proveedor';
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

    public function getRifPro()
    {
        return $this->rif_pro;
    }

    public function setRifPro($rif_pro)
    {
        $this->rif_pro = $rif_pro;

        return $this;
    }

    public function getNomPro()
    {
        return $this->nom_pro;
    }


    public function setNomPro($nom_pro)
    {
        $this->nom_pro = ucwords(mb_strtolower($nom_pro));

        return $this;
    }

    public function getDirPro()
    {
        return $this->dir_pro;
    }


    public function setDirPro($dir_pro)
    {
        $this->dir_pro = ucwords(mb_strtolower($dir_pro));

        return $this;
    }


    public function getTelfPro()
    {
        return $this->telf_pro;
    }


    public function setTelfPro($telf_pro)
    {
        $this->telf_pro = $telf_pro;

        return $this;
    }

    public function save()
    {
        $query = "INSERT INTO $this->table (id, rif_pro, nom_pro, dir_pro, telf_pro) VALUES
            (null,
             '$this->rif_pro',
             '$this->nom_pro',
             '$this->dir_pro',
             '$this->telf_pro')";
        $save = $this->db->query($query);
        return $save;
    }

    public function update()
    {
        $update = $this->db->query("UPDATE $this->table set
            nom_pro = '$this->nom_pro',
            dir_pro = '$this->dir_pro',
            telf_pro = '$this->telf_pro' WHERE id = $this->id
            ");
        return $update;
    }

    public function verifProv($rif)
    {
        $query=$this->db->query("SELECT * FROM $this->table  WHERE rif_pro='$rif'");
        if($row = $query->fetch_object()) {
           $resultSet[]=$row;
        }
        else {
            $resultSet = '';
        }
        return $resultSet;

    }


}

?>
