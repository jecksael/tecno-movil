<?php
/**
*
*/
class Empresa extends EntidadBase
{
    private $id;
    private $rif_emp;
    private $nom_emp;
    private $dir_emp;
    private $email_emp;
    private $tlf_emp;
    private $propietario;
    private $ced_pro;
    private $iva;
    private $url_logo;
    private $table;

    public function __construct()
    {
        $this->table = 'empresa';
        $table = 'empresa';
        parent::__construct($table);
    }


    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }


    public function setRifEmp($rif_emp)
    {
        $this->rif_emp = $rif_emp;

        return $this;
    }

    public function setNomEmp($nom_emp)
    {
        $this->nom_emp = strtoupper($nom_emp);

        return $this;
    }

    public function setDirEmp($dir_emp)
    {
        $this->dir_emp = ucwords(mb_strtolower($dir_emp));

        return $this;
    }

    public function setEmailEmp($email_emp)
    {
        $this->email_emp = $email_emp;

        return $this;
    }

    public function setTlfEmp($tlf_emp)
    {
        $this->tlf_emp = $tlf_emp;

        return $this;
    }

    public function setPropietario($propietario)
    {
        $this->propietario = ucwords(mb_strtolower($propietario));

        return $this;
    }

    public function setCedPro($ced_pro)
    {
        $this->ced_pro = $ced_pro;

        return $this;
    }

    public function setIva($iva)
    {
        $this->iva = $iva;

        return $this;
    }

    public function setUrlLogo($url_logo)
    {
        $this->url_logo = $url_logo;

        return $this;
    }

    public function save(){
        $query="INSERT INTO $this->table (id, rif_emp, nom_emp, dir_emp, email_emp, tlf_emp, propietario, ced_pro, iva, url_logo)
                VALUES(NULL,
                       '".$this->rif_emp."',
                       '".$this->nom_emp."',
                       '".$this->dir_emp."',
                       '".$this->email_emp."',
                       '".$this->tlf_emp."',
                       '".$this->propietario."',
                       '".$this->ced_pro."',
                       '".$this->iva."',
                       '".$this->url_logo."')";
        $save=$this->db->query($query);
        //$this->db()->error;
        return $save;
    }

    public function update(){
        $query = "UPDATE $this->table SET
            rif_emp = '$this->rif_emp',
            nom_emp = '$this->nom_emp',
            dir_emp =  '$this->dir_emp',
            email_emp =  '$this->email_emp',
            tlf_emp =  '$this->tlf_emp',
            propietario =  '$this->propietario',
            ced_pro =  '$this->ced_pro',
            iva =  '$this->iva',
            url_logo =  '$this->url_logo'
            WHERE id = $this->id";
        $update = $this->db->query($query);
        return $update;

    }


}

?>
