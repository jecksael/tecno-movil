<?php

/**
*
*/
class DetallePago extends EntidadBase
{
    private $id;
    private $banco_id;
    private $venta_id;
    private $referencia;
    private $num_tar;
    private $table;

    public function __construct()
    {
        $this->table = 'detalle_pago';
        $table = 'detalle_pago';
        parent::__construct($table);
    }

    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    public function setBancoId($banco_id)
    {
        $this->banco_id = $banco_id;

        return $this;
    }

    public function setVentaId($venta_id)
    {
        $this->venta_id = $venta_id;

        return $this;
    }


    public function setReferencia($referencia)
    {
        $this->referencia = $referencia;

        return $this;
    }


    public function setNumTar($num_tar)
    {
        $this->num_tar = $num_tar;

        return $this;
    }
}

?>
