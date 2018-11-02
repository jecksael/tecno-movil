<?php
/**
*
*/
class TipoPago extends EntidadBase
{
    private $id;
    private $pago;
    private $table;
    public function __construct()
    {
        $table = 'tipo_pago';
        parent::__construct($table);
    }
}

?>
