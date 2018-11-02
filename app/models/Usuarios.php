<?php

class Usuarios extends EntidadBase

{
    private $id;
    private $nombre;
    private $apellido;
    private $email;
    private $password;
    private $direccion;
    private $telefono;
    private $cargoId;
    private $status;
    private $created_at;
    private $update_at;
    private $table;
    public function __construct()
    {
        $this->created_at = date('Y-m-d H:i');
        $this->update_at = date('Y-m-d H:i');
        $this->table='tbl_usuarios';
        $table = 'tbl_usuarios';
        parent:: __construct($table);
    }

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function setNombre($nombre) {
        $this->nombre = ucwords(mb_strtolower($nombre));
    }

    public function getApellido() {
        return $this->apellido;
    }

    public function setApellido($apellido) {
        $this->apellido = ucwords(mb_strtolower($apellido));
    }

    public function getEmail() {
        return $this->email;
    }

    public function setEmail($email) {
        $this->email = ucfirst($this->db->real_escape_string($email));
    }

    public function getPassword() {
        return $this->password;
    }

    public function setPassword($password) {
        $this->password = md5($this->db->real_escape_string($password));
    }

    public function getDireccion() {
        return $this->direccion;
    }

    public function setDireccion($direccion) {
        $this->direccion = ucwords(mb_strtolower($direccion));
    }

    public function getTelefono() {
        return $this->telefono;
    }

    public function setTelefono($telefono) {
        $this->telefono = $telefono;
    }

    public function getCargo() {
        return $this->cargo;
    }

    public function setCargo($cargo) {
        $this->cargo = $cargo;
    }


    public function getStatus() {
        return $this->status;
    }

    public function setStatus($status) {
        $this->status = $status;
    }


    public function create(){
        $query="INSERT INTO $this->table (id,nombre,apellido,email,password,direccion,telefono,cargo_id,status,created_at,update_at)
                VALUES(NULL,
                       '".$this->nombre."',
                       '".$this->apellido."',
                       '".$this->email."',
                       '".$this->password."',
                       '".$this->direccion."',
                       '".$this->telefono."',
                       '".$this->cargo."',
                       '".$this->status."',
                       '".$this->created_at."',
                       '".$this->update_at."')";
        $save = $this->db->query($query);

        return $save;
    }

    public function update()
    {
        $update = "UPDATE $this->table SET
            nombre = '$this->nombre',
            apellido = '$this->apellido',
            email = '$this->email',
            direccion = '$this->direccion',
            telefono = '$this->telefono',
            cargo_id = '$this->cargo',
            status = '$this->status',
            update_at = '$this->update_at' WHERE id = $this->id";
            $result = $this->db->query($update);
            return $result;
    }

    public function signIn()
    {

        $query=$this->db->query("SELECT * FROM $this->table  WHERE email='$this->email' AND password = '$this->password' ");
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

    public function getTecnicos()
    {
        $query = $this->db->query("SELECT CA.*, TU.* FROM $this->table AS TU INNER JOIN cargo AS CA ON TU.cargo_id=CA.id WHERE TU.cargo_id = 2");
        if($query->num_rows == 0){
            return $resultSet ='';
        }
        else{
            while($row = $query->fetch_object()){
                $resultSet[]= $row;
            }
            return $resultSet;
        }
    }

    public function getAllUser(){
        $query=$this->db->query("SELECT CA.*, TU.* FROM $this->table AS TU INNER JOIN cargo AS CA ON TU.cargo_id=CA.id where TU.id != 1 ORDER BY TU.id DESC");
        if($query->num_rows == 0){
            $resultSet = '';
        }
        else{
            while ($row = $query->fetch_object()) {
               $resultSet[]=$row;
            }

        }

        return $resultSet;
    }

    public function getByIdUsuario($id)
    {
        $query=$this->db->query("SELECT CA.*, TU.* FROM $this->table AS TU INNER JOIN cargo AS CA ON TU.cargo_id=CA.id WHERE TU.id = $id");
        $result = $query->fetch_object();

        return $result;
    }

    public function update_pass($oldPass)
    {
        $query = $this->db->query("UPDATE $this->table SET password='$this->password'  WHERE id = $this->id AND password='$oldPass'");
        return $query;
    }

}

?>
