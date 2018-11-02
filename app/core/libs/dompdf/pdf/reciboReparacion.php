
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
$html= '
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
<table  border="1" width="100%">
	<tr><th colspan="3">	'.$departamento.' </th></tr>
	<tr><th colspan="3"> Recibo Tecnico </th></tr>
	<tr>
		<td ><b>N# de Servicio:</b> '.$num_ser.'</td>
 		<td colspan="2"><b> Fecha:</b> '.fecha($fecha).' <b>Hora:</b> '.$h.' </td>
   	</tr>

   	<tr><td colspan="3"><b> Tecnico:</b>  '.$nomTec.'   </td> </tr>

    <tr> <td> <b>Cliente: </b>  '.$nomCli.'  </td>
    	<td> <b> CI:</b> '.$nacCli.''.$cedCli.'  </td>
    	<td> <b> Telefono:</b>  '.$telCli.'</td>
    </tr>

    <tr> <td colspan="3"> <b> Domicilio:</b>  '.$dirCli.' </td> </tr>
    <tr><th colspan="3"> Datos de la Reparacion </th> </tr>

    <tr>
    	<td > <b> Marca:</b> '.$marca.' </td>
    	<td colspan="2"> <b> Modelo: </b> '.$modelo.' </td>
    </tr>

     <tr> <td colspan="2"> <b> Servicio: </b>  '.$servicio.' </td> <td><b>Imei: </b> '.$imei.' </td></tr>
     <tr > <td colspan="3" width=""> <b>Detalle del Servicio: </b> '.$detaServ.' <br></td> </tr>
     <tr><td colspan="2"> <b>Accesorios Recibidos:  </b> '.$accRec.' </td> <td> <b>Monto del Servicio: </b> '.$monto.' B.F</td>   </tr>';
     $sql= "SELECT * FROM repuestos INNER JOIN producto on repuestos.cod_pro=producto.cod_pro WHERE servicio_id=$num_ser";
     $res=mysql_query($sql);
     if(mysql_num_rows($res)>0){
      $html.='
      <tr> <th colspan="3"><b>Repuestos</b></th></tr>
     <tr class="text-center negrita">
      <td>Codigo</td> <td>Descripcion</td><td>Precio </td>
      </tr>';
      while($row = mysql_fetch_array($res)){
        $html.='<tr class="text-center">
        <td>'.$row["cod_pro"].'</td>
        <td >'.$row["des_pro"].'</td>
        <td>'.$row["p_ven"].' BF</td>
        </tr>';
      }

     }

     $html.='

       <tr></td>
      	<td colspan="3"> <b>Condiciones: 1-</b> Para retirar el equipo es necesaria la orden de reparacion.<br>

      	<b> 2-</b> Los equipos mojados no tienen garantia. <br>  <b>3- </b>
      	'.$departamento.' no se hace responsable por la perdida o extravio del equipo pasado los 15 dias de la fecha de ingreso.<br>
         <b> 4- </b> El cliente declara que conoce y acepta los termino y da autorizacion para reparar el equipo, en fe de la cual firma.
          </td></tr>


      	<tr> <td align="center"><br> <hr color="black" size="1" width="140"> Firma del Cliente</td>
    <br>
    <td colspan="2">  Total a Pagar:<b>&nbsp;&nbsp; '.$total.' Bf </b>  </td>
    </tr>

</table>
</div>';

$html.='
<div id="reparacion2">
<table id="table2" border="1" width="100%">
	<tr><th colspan="3">	'.$departamento.' </th></tr>
	<tr><th colspan="3"> Recibo Cliente </th></tr>
	<tr>
		<td ><b>N# de Servicio:</b> '.$num_ser.'</td>
 		<td colspan="2"><b> Fecha:</b> '.fecha($fecha).' <b>Hora:</b> '.$h.' </td>
   	</tr>

   	<tr><td colspan="3"><b> Tecnico:</b>  '.$nomTec.'   </td> </tr>

    <tr> <td> <b>Cliente: </b>  '.$nomCli.'  </td>
    	<td> <b> CI:</b> '.$cedCli.'  </td>
    	<td> <b> Telefono:</b>  '.$telCli.'</td>
    </tr>

    <tr> <td colspan="3"> <b> Domicilio:</b>  '.$dirCli.' </td> </tr>
    <tr><th colspan="3"> Datos de la Reparacion </th> </tr>

    <tr>
    	<td > <b> Marca:</b> '.$marca.' </td>
    	<td colspan="2"> <b> Modelo: </b> '.$modelo.' </td>
    </tr>

     <tr> <td colspan="2"> <b> Servicio: </b>  '.$servicio.' </td> <td><b>Imei: </b> '.$imei.' </td></tr>
     <tr > <td colspan="3" width=""> <b>Detalle del Servicio: </b> '.$detaServ.' <br></td> </tr>
     <tr> <td colspan="2"> <b>Accesorios Recibidos:  </b> '.$accRec.' </td> <td> <b>Monto del Servicio: </b> '.$monto.' B.F</td> </tr>';

 $sql= "SELECT * FROM repuestos INNER JOIN producto on repuestos.cod_pro=producto.cod_pro WHERE servicio_id=$num_ser";
     $res=mysql_query($sql);
     if(mysql_num_rows($res)>0){
      $html.='
      <tr> <th colspan="3"><b>Repuestos</b></th></tr>
     <tr class="text-center negrita">
      <td>Codigo</td> <td>Descripcion</td><td>Precio </td>
      </tr>';
      while($row = mysql_fetch_array($res)){
        $html.='<tr class="text-center">
        <td>'.$row["cod_pro"].'</td>
        <td >'.$row["des_pro"].'</td>
        <td>'.$row["p_ven"].' BF</td>
        </tr>';
      }

     }
     $html.='
       <tr></td>
      	<td colspan="3"><b>Condiciones: 1-</b> Para retirar el equipo es necesaria la orden de reparacion.<br>

      	<b> 2-</b> Los equipos mojados no tienen garantia. <br>  <b>3- </b>
      	'.$departamento.' no se hace responsable por la perdida o extravio del equipo pasado los 15 dias de la fecha de ingreso. <br>
         <b> 4- </b> El cliente declara que conoce y acepta los termino y da autorizacion para reparar el equipo, en fe de la cual firma.</td></tr>


      	<tr> <td align="center"><br> <hr color="black" size="1" width="140"> Firma del Cliente</td>
    <br>
    <td colspan="2">  Total a Pagar:<b>&nbsp;&nbsp; '.$total.' Bf </b> </td> </tr>

</table>
</div>
</div>';


// Instanciamos un objeto de la clase DOMPDF.
$dompdf = new DOMPDF();

$dompdf->load_html(($html));

$dompdf->render();
$dompdf->stream("factura".date('Y-m-d').".pdf", array("Attachment" => false));
exit(0);


