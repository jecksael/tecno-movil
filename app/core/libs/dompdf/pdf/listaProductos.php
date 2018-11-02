
<?php
/*
// Cargamos la librería dompdf que hemos instalado en la carpeta dompdf
require_once ('../dompdf_config.inc.php');
include '../../functions.php';

session_start();
$id = $_SESSION["id_dep"];
$result =mysql_query("SELECT * FROM departamento WHERE id_dep = $id ");
$res = mysql_fetch_array($result);
$nomDepa = strtolower(limpiar_espacios($res["nom_dep"]));

$html= '
<style>
table{
	text-align :center;
	font-size:10px;
}


</style>
<div id="table">
<table border="1">
<thead>
	<tr align="center">
		<th colspan="5"> LSITADO DE PRODUCTOS ' .$res["nom_dep"]. '</th>
	</tr>
	<tr>
		<td>CODIGO</td>
		<td>DESCRIPCION</td>
		<td>EXISTENCIA</td>
		<td>PRECIO DE COMPRA</td>
		<td>PRECIO DE VENTA</td>
		
	</tr>
</thead>
	<tbody>
';



$cone = mysql_query("SELECT * FROM $nomDepa INNER JOIN producto on $nomDepa.cod_pro=producto.cod_pro INNER JOIN marca on producto.cod_mar=marca.cod_mar WHERE $nomDepa.status=1");

while ($data = mysql_fetch_array($cone)){


$html.= '
	<tr>
		<td>'.$data["cod_pro"].'</td>
		<td>'.$data["des_pro"].'</td>
		<td>'.$data["exi_dep"].'</td>
		<td>'.$data["p_com"].'</td>
		<td>'.$data["p_ven"].'</td>
	</tr>
';

}

$html.= '
	</tbody>
</table>
</div>
';

mysql_close();
// Instanciamos un objeto de la clase DOMPDF.


$dompdf = new DOMPDF();
//establecer el tamaño
ini_set("memory_limit", "128M");
// establecer el tiempo de respuesta
Set_time_limit (500);
$dompdf->load_html($html);

$dompdf->render();
$dompdf->stream("lista".date('Y-m-d').".pdf", array("output " => true));
//exit(0);
*/





