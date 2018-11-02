
<?php
// Cargamos la librería dompdf que hemos instalado en la carpeta dompdf
require_once ('../dompdf_config.inc.php');
include '../../functions.php';
$num_fact = $_GET['num_fact'];
$sql = mysql_query("SELECT * FROM factura INNER JOIN cliente on factura.ced_cli=cliente.ced_cli WHERE factura.num_fact = $num_fact");
$naci = array (
	1 =>'V-',
	2 =>'E-'
	);
while($row = mysql_fetch_array($sql)){
	$num_fact = $row['num_fact'];
	$fecha = $row['fech_fact'];
	$ced = $row['ced_cli'];
	$nac = $naci[$row['id_nac']];
	$nomCli = $row['nom_cli'];
	$dirCli = $row['dir_cli'];
	$total = $row['total'];
	$iva = $row['iva'];
	$big = $row['big'];
}

// Introducimos HTML de prueba
$html='
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
 .padding-top{
 	padding-top:-3em;
 }

</style>
<body>
<hr></hr>
 	<table width="100%" border="0">
 	<tr>
 		<td class="text-center">
 			<b><h3>TECNOMOVIL JV JN<br>
 		El Piñal Estado Tachira<br>
 		Rif: 16612305-0
 		<br>
 		Telefono: <img src="../../../public/img/telefono.png">
 		0277-2347303
 		</h3>
 		</td>
 		<td class= "padding-top"><h3>Factura: <span class="h4">N# '.$num_fact.'</span><br>
 		Fecha: <span class="h4">'.$fecha.'</span><br>
 		</td></h3>
 	</tr>
 	</table>
 	<hr></hr>
	<table border="0">
	<tr><td><b>Cliente:</b>'.$nomCli.'</td></tr>
	<tr><td><b>Cedula ó Rif:</b>'.$nac.''.$ced.'</td></tr>
	<tr><td><b>Direccion:</b>'.$dirCli.'</td></tr>

	</table>
	<br>
	<table border="0" width="100%">
	<tr class="text-center">
		<th>Codigo</th>
		<th>Cantidad</th>
		<th>Descripcion</th>
		<th>Precio</th>
		<th>Sub Total</th>

';
$result=mysql_query("SELECT * FROM detalle_venta INNER JOIN producto on detalle_venta.cod_pro=producto.cod_pro WHERE num_fact = $num_fact");
while ($row = mysql_fetch_array($result)){	
	$cant=$row['cantidad'];
	$codPro=$row['cod_pro'];
	$des=$row['des_pro'];
	$pre=$row['p_ven'];
	$pre2 = $pre* 10.713 ;
	$pre3 = ($pre2) / (100) ;
	$pre4 = $pre-$pre3;
	$subT=$pre4*$cant;
	$subTo = $total- $iva;
	$html.= '</tr>
	<tr ">
		<td width="10%" class="text-center">'.$codPro.'</td>
		<td width="20%" class="text-center">'.$cant.'</td>
		<td width="40%" class="text-center">'.$des.'</td>
		<td width="20%" class="text-right">'.$pre4.' </td>
		<td width="20%" class="text-right">'.$subT.' </td>
	</tr>
'; }
	$html.='
	<tr><br>
		<td colspan="3"></td>
		<td class="bold text-right"><br>Sub Total:</td>
		<td class="text-right"><br>'.$subTo.' Bf</td>
	</tr>
	<tr>
		<td colspan="3"></td>
		<td class="bold text-right">Iva:</td>
		<td class="text-right">'.$iva.' Bf</td>
	</tr>
	<tr>
		<td colspan="3"></td>
		<td class="bold text-right bg">Total:</td>
		<td class="text-right bg">'.$total.' Bf</td>
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