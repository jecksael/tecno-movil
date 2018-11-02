<?php

class Producto extends EntidadBase
{
    private $id;
    private $cod_pro;
    private $des_pro;
    private $marca_id;
    private $stock;
    private $pre_com;
    private $porc_pro;
    private $pre_ven;
    private $status;
    private $url;
    private $table;
    private $created_at;
    private $update_at;

    public function __construct()
    {
        $this->created_at = date('Y-m-d H:i');
        $this->update_at = date('Y-m-d H:i');
        $this->table = 'producto';
        $table = 'producto';
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


    public function getCodPro()
    {
        return $this->cod_pro;
    }


    public function setCodPro($cod_pro)
    {
        $this->cod_pro = strtoupper($cod_pro);

        return $this;
    }


    public function getDesPro()
    {
        return $this->des_pro;
    }


    public function setDesPro($des_pro)
    {
        $this->des_pro = ucwords(mb_strtolower($des_pro));

        return $this;
    }


    public function getMarcaId()
    {
        return $this->marca_id;
    }


    public function setMarcaId($marca_id)
    {
        $this->marca_id = $marca_id;

        return $this;
    }

    public function getStock()
    {
        return $this->stock;
    }


    public function setStock($stock)
    {
        $this->stock = $stock;

        return $this;
    }


    public function getPreCom()
    {
        return $this->pre_com;
    }


    public function setPreCom($pre_com)
    {
        $this->pre_com = str_replace(",", "", $pre_com);

        return $this;
    }

    public function getPorcPro($porc_pro)
    {
        return $this;
    }

    public function setPorcPro($porc_pro)
    {
        $this->porc_pro = $porc_pro;
    }


    public function getPreVen()
    {
        return $this->pre_ven;
    }


    public function setPreVen($pre_ven)
    {
        $this->pre_ven = str_replace(",", "", $pre_ven);

        return $this;
    }


    public function getStatus()
    {
        return $this->status;
    }

    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }


    public function getUrl()
    {
        return $this->url;
    }

    public function save()
    {
        $query = "INSERT INTO $this->table (id, cod_pro, des_pro, marca_id, stock, pre_com, porc_pro, pre_ven, status, url_imagen, created_at, update_at ) VALUES ( NULL ,
                        '".$this->cod_pro."',
                        '".$this->des_pro."',
                        '".$this->marca_id."',
                        '".$this->stock."',
                        '".$this->pre_com."',
                        '".$this->porc_pro."',
                        '".$this->pre_ven."',
                        '".$this->status."',
                        '".$this->url."',
                        '".$this->created_at."',
                        '".$this->update_at."')";
        $save = $this->db->query($query);
        if($save){
            return true;
        }
        else {
            return false;
        }
    }
    public function getAllPro(){
        $query=$this->db->query("SELECT * FROM marca INNER JOIN $this->table ON $this->table.marca_id=marca.id ORDER BY des_pro ASC");
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
    public function getIdPro()
    {
        $query = $this->db->query("SELECT * FROM marca INNER JOIN $this->table ON $this->table.marca_id=marca.id where $this->table.id =$this->id");
        while($row = $query->fetch_object()){
            $result = $row;
        }
        return $result;
    }

    public function getLinkPro($key,$val)
    {
        $query = $this->db->query("SELECT * FROM $this->table WHERE $key LIKE '%$val%' ");
        if($query->num_rows == 0){
            return $resultSet = '';
        }
        else {
            while($row = $query->fetch_object()){
                $resultSet[]=$row;
            }
            return $resultSet;
        }
    }



    public function updatePrecio($precio,$porcentaje,$id)
    {
        $query = $this->db->query ("UPDATE $this->table SET pre_ven = $precio, update_at = '$this->update_at', porc_pro=porc_pro+$porcentaje WHERE id = $id");
    }

    public function update_precio_compra($precio,$cod_pro,$cant)
    {
        $query = $this->db->query ("UPDATE $this->table SET
            pre_com = $precio,
             stock = stock+$cant,
             pre_ven = pre_com*porc_pro/100+pre_com,
             update_at = '$this->update_at' WHERE cod_pro = '$cod_pro'");
    }

    public function update_stock_venta($cod_pro,$cant)
    {
        $query = $this->db->query("UPDATE $this->table SET stock = stock-$cant WHERE cod_pro = '$cod_pro'");
    }
    public function update()
    {
        $query = $this->db->query("UPDATE $this->table SET
                des_pro = '$this->des_pro',
                marca_id = '$this->marca_id',
                stock = '$this->stock',
                pre_com = '$this->pre_com',
                porc_pro = '$this->porc_pro',
                pre_ven = '$this->pre_ven',
                status = '$this->status',
                url_imagen = '$this->url',
                update_at = '$this->update_at'
                WHERE id = $this->id ");
        if($query){
            return true;
        }
        else {
            return false;
        }
    }

    public function get_pro_home()
    {
        $query = $this->db->query("SELECT TM.marca, TP.* FROM $this->table AS TP INNER JOIN marca AS TM ON TP.marca_id=TM.id WHERE url_imagen != '' ORDER BY TP.id DESC LIMIT 12");
        if($query->num_rows == 0){
            return $resultSet = '';
        }
        else {
            while($row = $query->fetch_object()){
                $resultSet[]=$row;
            }
            return $resultSet;
        }
    }


}

?>
