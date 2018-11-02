<?php

class Cliente extends EntidadBase
{
    private $id;
    private $nac_id;
    private $ced_cli;
    private $nom_cli;
    private $ape_cli;
    private $gen_cli;
    private $dir_cli;
    private $telf_cli;
    private $created_at;
    private $update_at;
    private $table;

    public function __construct()
    {
        $this->table = 'clientes';
        $table = 'clientes';
        parent::__construct($table);
    }


    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;

        return $this->id;
    }


    public function getNacId()
    {
        return $this->nac_id;
    }


    public function setNacId($nac_id)
    {
        $this->nac_id = $nac_id;

        return $this->nac_id;
    }

    public function getCedCli()
    {
        return $this->ced_cli;
    }


    public function setCedCli($ced_cli)
    {
        $this->ced_cli = $ced_cli;

        return $this;
    }


    public function getNomCli()
    {
        return $this->nom_cli;
    }


    public function setNomCli($nom_cli)
    {
        $this->nom_cli = ucwords(mb_strtolower($nom_cli));

        return $this;
    }


    public function getApeCli()
    {
        return $this->ape_cli;
    }


    public function setApeCli($ape_cli)
    {
        $this->ape_cli = ucwords(mb_strtolower($ape_cli));

        return $this;
    }


    public function getGenCli()
    {
        return $this->gen_cli;
    }

    public function setGenCli($gen_cli)
    {
        $this->gen_cli = $gen_cli;

        return $this;
    }


    public function getDirCli()
    {
        return $this->dir_cli;
    }


    public function setDirCli($dir_cli)
    {
        $this->dir_cli = ucwords(mb_strtolower($dir_cli));

        return $this;
    }

    public function getTelfCli()
    {
        return $this->telf_cli;
    }


    public function setTelfCli($telf_cli)
    {
        $this->telf_cli = $telf_cli;

        return $this;
    }


    public function getCreatedAt()
    {
        return $this->created_at;
    }


    public function setCreatedAt($created_at)
    {
        $this->created_at = $created_at;

        return $this;
    }


    public function getUpdateAt()
    {
        return $this->update_at;
    }


    public function setUpdateAt($update_at)
    {
        $this->update_at = $update_at;

        return $this;
    }

    public function verifCli($ced_cli, $nac)
    {
        $query=$this->db->query("SELECT * FROM $this->table  WHERE nac_id=$nac AND ced_cli = $ced_cli ");
        if($row = $query->fetch_object()) {
           $resultSet[]=$row;
        }
        else {
            $resultSet = '';
        }
        return $resultSet;

    }

    public function save()
    {
        $query = "INSERT INTO $this->table (
            id, nac_id, ced_cli, nom_cli, ape_cli, gen_cli, dir_cli, telf_cli, created_at, update_at)
            VALUES ( NULL,
                    '".$this->nac_id."',
                    '".$this->ced_cli."',
                    '".$this->nom_cli."',
                    '".$this->ape_cli."',
                    '".$this->gen_cli."',
                    '".$this->dir_cli."',
                    '".$this->telf_cli."',
                    '".$this->created_at."',
                    '".$this->update_at."')";
        $save = $this->db->query($query);
        return $save;
    }

    public function getAllCliente()
    {
        $query = $this->db->query("SELECT * FROM nacionalidad INNER JOIN $this->table ON  $this->table.nac_id = nacionalidad.id ORDER BY $this->table.nom_cli ASC");
        if($query->num_rows == 0){
            return $resultSet = '';
        }
        else {
            while($row = $query->fetch_object()){
                $resultSet[]= $row;
            }

            return $resultSet;
        }

    }

    public function update()
    {
        $query = "UPDATE $this->table
            SET nom_cli = '".$this->nom_cli."',
                ape_cli = '".$this->ape_cli."',
                dir_cli = '".$this->dir_cli."',
                telf_cli = '".$this->telf_cli."',
                update_at = '".$this->update_at."'
                WHERE id = $this->id
            ";
        $update = $this->db->query($query);
        if($update){
            return true;
        }
        else{
            return false;
        }
    }
    public function getCliente($nac_id,$ced_cli)
    {
        $query = $this->db->query("SELECT id FROM $this->table WHERE nac_id=$nac_id AND ced_cli=$ced_cli");
        $result = $query->fetch_object();
        return $result;
    }

}

?>
