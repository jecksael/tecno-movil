
<?php
// Cargamos la librería dompdf que hemos instalado en la carpeta dompdf
require_once ('../dompdf_config.inc.php');
include '../../functions.php';


// Introducimos HTML de prueba
$sql = "SELECT * FROM reparaciones INNER JOIN tbl_usuarios on reparaciones.nom_tecnico=tbl_usuarios.id_users INNER JOIN cliente on reparaciones.ced_cli=cliente.ced_cli INNER JOIN marca on reparaciones.cod_mar=marca.cod_mar INNER JOIN servicio on reparaciones.cod_serv=servicio.id_serv  ORDER BY reparaciones.num_ser DESC LIMIT 1";
$query=mysql_query($sql) or die ("<br><Center>Error al Conectar Intente mas tarde </center>");
$nac = array (1 => 'V-', 2 => 'E-');
while ($row = mysql_fetch_array($query)){
$num_ser = $row['num_ser'];
$fecha = $row['fecha'];
$nomTec = $row['usr_nombre'];
$cedCli = $row['ced_cli'];
$nomCli = $row['nom_cli'];
$nacCli = $nac[$row['id_nac']];
$telCli = mask_tel($row['tel_cli']);
$dirCli = $row['dir_cli'];
$marca = $row['marca'];
$modelo = $row['modelo'];
$servicio = $row['servicio'];
$imei = $row['imei'];
$detaServ = $row['detalle_serv'];
$accRec = $row['dato_rec'];
$monto = $row['monto'];
$departamento = 'TECNOMOVIL JV JN';
$f = date('Y-m-d H:i:a');
$h = substr($f, 10);
$total = $row['total'];

}
?>
<style>
table {
    font-size: 11px;
    border-collapse: collapse;
}
#general {
    width:100%;
}
#reparacion1{
width:50%;

float:left;

}
#reparacion2 {
width:50%;

margin-left:24em;}
.text-center {
  text-align:center;
}
.negrita {
  font-weight:bolder;
}

</style>

<div id="general">
  <div id="reparacion1">
    <table border 1>
      <tr>
        <th  colspan="4">TecnoMOvil</th>
      </tr>

      <tr>
        <th  colspan="4">Recibo Tecnico</th>
      </tr>

      <tr>
        <td ><b>N# de Servicio:</b> 37</td>
        <td colspan="3" ><b>Fecha:</b> 03/04/20017  <b>Hora:</b> 21:32pm</td>
      </tr>

      <tr>
        <td><b>Cliente:</b> INES VERA</td>
        <td width=""><b>CI:</b> V-21222105</td>
        <td><b>Telefono:</b> (0414)-(7397902)</td>
      </tr>

      <tr>
        <td colspan="4"><b>Domicilio:</b> NARANJALES</td>
      </tr>

      <th colspan="4">Datos de la Reparacion</th>

      <tr>
        <td><b>Marca:</b> SENDTEL</td>
        <td colspan="4"><b>Modelo:</b> BLISS</td>
      </tr>

      <tr>
        <td colspan="2"><b>Servicio:</b> LIBERACION DE BANDAS</td>
        <td><b>Imei:</b> 3556190902610111</td>
      </tr>

      <tr>
        <td colspan="4"><b>Detalle del Servicio:</b> SIN DETALLES</td>
      </tr>
      <tr>
        <td colspan="2"><b>Accesorios Recibidos:</b> Bateria</td>
        <td><b>Monto del Servicio:</b> 50000.00 BF</td>
      </tr>

      <tr><th colspan="4">Repuestos</th></tr>
      <th>Codigo</th>
      <th>Descripcion</th>
      <th>Precio</th>

      <tr class="text-center">
        <td>ABVADD1</td>
        <td>MICA TACTIL HUAWEI Y500</td>
        <td>4000.00</td>
      </tr>

       <tr>
        <td  colspan="4"> <b>Condiciones: 1-</b> Para retirar el equipo es necesaria la orden de reparacion.<br>

        <b> 2-</b> Los equipos mojados no tienen garantia. <br>  <b>3- </b>
        '.$departamento.' no se hace responsable por la perdida o extravio del equipo pasado los 15 dias de la fecha de ingreso.<br>
         <b> 4- </b> El cliente declara que conoce y acepta los termino y da autorizacion para reparar el equipo, en fe de la cual firma.
          </td></tr>


        <tr> <td align="center"><br> <hr color="black" size="1" width="140"> Firma del Cliente</td>
    <br>
    <td colspan="2">  Total a Pagar:<b>&nbsp;&nbsp; 50000.00 Bf </b>  </td>
    </tr>



    </table>
  </div>
</div>
