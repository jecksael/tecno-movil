<?php
defined('BASEPATH') or exit ("NO SE PERMITE EL ACCESO");
class Conectar
{
    protected $db;

    public function __construct()
    {
        $this->db = new Mysqli(HOST, USER, PASS, DB_NAME) ;
        $this->db->query("SET NAMES '".CHARSET."'");

        if (mysqli_connect_errno()) {
            printf("Conexion fallida: %s\n", mysqli_connect_error());
        exit();
        }

    }

    public function __destruct()
    {
        $this->db->close();
    }


}
?>
