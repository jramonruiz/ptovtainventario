<?php
require_once('class.ezpdf.php');
require_once('class.pdf.php');


$pdf =& new Cezpdf('a4', 'landscape'); //'letter','landscape'
$pdf->selectFont('../fonts/courier.afm');
$pdf->ezSetCmMargins(4,2,1.5,1.5);

$id = $pdf->openObject();
$pdf->AddText(30, 800, $h1, "<b>Header</b>");
//$pdf->ezImage("ros.jpg", 0, 80, 'none', 'left'); 
$pdf->addJpegFromFile('ros.jpg',50,490, 100,50);
$pdf->closeObject();
$pdf->addObject($id, 'all'); 



$conexion = mysql_connect("localhost", "root", "");
mysql_select_db("demo", $conexion);
$queEmp = "SELECT nombre, direccion, telefono FROM empresa ORDER BY nombre ASC";
$resEmp = mysql_query($queEmp, $conexion) or die(mysql_error());
$totEmp = mysql_num_rows($resEmp);

$ixx = 0;
while($datatmp = mysql_fetch_assoc($resEmp)) { 
	$ixx = $ixx+1;
	$data[] = array_merge($datatmp, array('num'=>$ixx));
}
$titles = array(
				
				'num'=>'<b>Num</b>',
				'nombre'=>'<b>Empresa</b>',
				'direccion'=>'<b>Direccion</b>',
				'telefono'=>'<b>Telefono</b>'
				
			);
$options = array(
				'shadeCol'=>array(0.9,0.9,0.9),
				'xOrientation'=>'center',
				'width'=>500
			);

 



$pdf->ezTable($data, $titles, '', $options);
$pdf->ezText("\n\n\n", 10);
$pdf->ezText("<b>Fecha:</b> ".date("d/m/Y"), 10);
$pdf->ezText("<b>Hora:</b> ".date("H:i:s")."\n\n", 10);

$pdf->ezStream();
?>