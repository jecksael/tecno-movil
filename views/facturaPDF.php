<?php ob_start(); ?>

<table class="table" border="0"  width="100%" style="margin-bottom: -20px">

    <tr>
        <!-- DATOS DE LA EMPRESA -->
        <td width="40%" rowspan="3" >
           <!-- <img src="<?php echo '../public/imagenes/'.LOGO ?>" alt="logo" style="float: left">  -->
            <h1 style="text-align: center"><?php echo EMPRESA ?></h1>
        </td>
        <td>
            <b>Rif:</b> <?php echo RIF ?>
        </td>
    </tr>
    <tr>
        <td>
             <b>Direccion:</b> <?php echo DIR_EMPRESA ?>
        </td>
    </tr>
    <tr>
        <td width="30%">
            <b>Telefono:</b> <?php echo TELF_EMPRESA ?>
        </td>
        
    </tr>
    <tr>
        
        <td colspan="2">
            <br>
            <hr>
        </td>
    </tr>
    <tr>
        <!-- DATOS DEL CLIENTE -->
        <?php $nac = array (1 => 'V-', 2 => 'E-'); ?>
        <td colspan="">
            <b>Cliente</b> <br>
            <b>C.I:</b><?php echo $nac[$venta[0]->nac_id].''.$venta[0]->ced_cli?> <br>
            <b>Nombre:</b> <?php echo $venta[0]->nom_cli.' '.$venta[0]->ape_cli ?><br>
            <b>Dirección:</b> <?php echo $venta[0]->dir_cli ?>
        </td>
        <td>
            <!-- DATOS DE LA FACTURA -->
            <b>Factura</b><br>
            <b>N#:</b> <?php echo $venta[0]->id ?> <br>
            <b>Fecha:</b> <?php echo substr($venta[0]->created_at, 0,10) ?> <br>
            <b>Hora:</b> <?php echo substr($venta[0]->created_at, 11,14) ?>
        </td>
    </tr>
</table>
<br>
<table id="t01"  width="100%" class="table" border="1">
    <tr>
        <th width="5%">Cant</th>
        <th width="10%">Codigo</th>
        <th width="45%">Descripción</th>
        <th width="20%">Precio Unt</th>
        <th width="20%">Sub Total</th>
    </tr>
    <?php foreach ($detalle as $key => $value) {
        echo '
    <tr>
        <td width="5%">'.$value->cant.'</td>
        <td width="10%">'.$value->cod_pro.'</td>
        <td width="45%">'.$value->des_pro.'</td>
        <td width="20%">'.$value->pre_ven.' BF</td>
        <td width="20%">'.$value->sub_total.' BF</td>
    </tr>

        ';
    } ?>

</table>
<table id="t01" width="100%" border="0" >
    <tr >
        <td width="60%" rowspan="4" align="left">
            <b>Tipo de pago: </b><?php echo $venta[0]->pago ?>
        </td>
    </tr>
    <tr>
        <td width="20%"><b>BIG</b></td>
        <td width="20%"><?php echo $venta[0]->big ?> BF</td>
    </tr>
    <tr>
        <td width="20%"><b>IVA</b></td>
        <td width="20%"><?php echo $venta[0]->iva ?> BF</td>
    </tr>
    <tr>
        <td width="20%"><b>TOTAL</b></td>
        <td width="20%"><?php echo $venta[0]->total ?> BF</td>
    </tr>

</table>




<style>
.table, th, td {
    border-collapse: collapse;
}


table#t01 tr:nth-child(even) {
    background-color: #eee;
    text-align: center

}
table#t01 tr:nth-child(odd) {
   background-color:#fff;
   text-align: center
}
table#t01 th {
    background-color: black;
    color: white;
}
table#t01{
    border-collapse: collapse;
}

</style>

