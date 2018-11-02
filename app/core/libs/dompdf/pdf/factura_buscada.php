
<?php
// Cargamos la librería dompdf que hemos instalado en la carpeta dompdf
require_once ('../dompdf_config.inc.php');

$num_fact = $_GET['num_fact'];
$mysqli = new mysqli("localhost", "root", "", "iut_fotos");
if ($mysqli->connect_errno) {
echo "Fallo al conectar con la base de datos MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}
$result=$mysqli->query("SELECT * FROM factura inner join clientes on factura.ced_cli=clientes.ced_cli inner join tipo_pago on factura.tipo_pago=tipo_pago.id_pago  where id_fact=".$num_fact);
while ($row = $result->fetch_array())
{
$num_fact=$row["id_fact"];
$fecha=substr($row["fech_fact"], 0 ,10);
$hora=substr($row["fech_fact"],10,6);
$tPago=$row['pago'];
$ced_cli=$row['ced_cli'];
$nom_c=$row['nom_cli'];
$ape_c=$row['ape_cli'];
$dir_cli=$row['dir_cli'];
$nom_cli = $nom_c.' '.$ape_c;
$total1=$row['total'];
$total2 = $total1* 10.713 ;
$total3 = ($total2) / (100) ;
$total = $total1-$total3;
$iva = $total1-$total;

}
// Introducimos HTML de prueba

 	 $html= '
 <style>
 body{font-family:courier;
}
 hr {background-color:#D9D9D9;
 	height:5px;
 	border:none;}
 .text-center{
 text-align: center;
 }
 .text-center{
 	text-align:center
 }
  .text-justify{
 	text-align:justify
 }
 .text-right{
 	text-align:right;
 }
 .h4{
 	font-size:18px;
 	font-weight:normal;
 	}
 th {
 	background-color:#D9D9D9;
 }
 .bg {
 	background-color:#D9D9D9;
 }
 .bold{ font-weight:bold;}
 }
 </style>
 <body>
 	<hr></hr>
 	<table width="100%" border="0">
 	<tr>
 		<td class="text-center"><b><h3>Fotos Para Ti Digital Plus<br>
 		El Piñal Estado Tachira<br>
 		Rif: 123456789
 		<br>
 		<img src="../../img/telefono.png">
 		0277-2340468
 		</h3>
 		</td>
 		<td><h3>Factura: <span class="h4">N# '.$num_fact.'</span><br>
 		Fecha: <span class="h4">'.$fecha.'</span><br>
 		Hora: <span class="h4">'.$hora.'</span><br>
 		Tipo de Pago: <span class="h4">'.$tPago.'</span>
 		</td></h3>
 	</tr>
 	</table>
 	<hr></hr>
	<table border="0">
	<tr><td><b>Cliente:</b>'.$nom_cli.'</td></tr>
	<tr><td><b>Cedula Rif:</b>'.$ced_cli.'</td></tr>
	<tr><td><b>Direccion:</b>'.$dir_cli.'</td></tr>

	</table>
	<br>
	<table border="0" width="100%">
	<tr class="text-center">
		<th>Cantidad</th>
		<th>Servicio</th>
		<th>Descripcion</th>
		<th>Precio</th>
		<th>Sub Total</th>

';
$result=$mysqli->query("SELECT * FROM detalle_factura inner join servicios on detalle_factura.id_serv=servicios.id where detalle_factura.id_fact=".$num_fact);
while ($row = $result->fetch_array())
{	$cant=$row['cantidad'];
	$serv=$row['nom_serv'];
	$des=$row['des_serv'];
	$pre=$row['pre_serv'];
	$pre2 = $pre* 10.713 ;
	$pre3 = ($pre2) / (100) ;
	$pre4 = $pre-$pre3;
	$subT=$pre4*$cant;
	$html.= '</tr>
	<tr ">
		<td width="10%" class="text-center">'.$cant.'</td>
		<td width="20%" class="text-center">'.$serv.'</td>
		<td width="40%" class="text-center">'.$des.'</td>
		<td width="20%" class="text-right">'.$pre4.' Bf</td>
		<td width="20%" class="text-right">'.$subT.' Bf</td>
	</tr>
'; }
	$html.='
	<tr><br>
		<td colspan="3"></td>
		<td class="bold text-right"><br>Sub Total:</td>
		<td class="text-right"><br>'.$total.' Bf</td>
	</tr>
	<tr>
		<td colspan="3"></td>
		<td class="bold text-right">Iva:</td>
		<td class="text-right">'.$iva.' Bf</td>
	</tr>
	<tr>
		<td colspan="3"></td>
		<td class="bold text-right bg">Total:</td>
		<td class="text-right bg">'.$total1.' Bf</td>
	</tr>
	</table>

 </body>
 ';

// Instanciamos un objeto de la clase DOMPDF.
$dompdf = new DOMPDF();

$dompdf->load_html(($html));

$dompdf->render();
$dompdf->stream("factura".date('Y-m-d').".pdf", array("Attachment" => false));
exit(0);