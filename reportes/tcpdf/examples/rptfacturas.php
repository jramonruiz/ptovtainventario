<?php
require_once('../config/lang/eng.php');
require_once('../tcpdf.php');
class MYPDF extends TCPDF {

	
	public function Header() {
		$image_file = K_PATH_IMAGES.'../images/isi.jpg';
		//                               ANCHO DE LA IMAGEN,            ANCHO DE LA IMAGEN
		$this->Image($image_file, 15, 10, 180, 25, 'JPG', '', 'T', false, 300, '', false, false, 0, false, false, false);
		$this->SetFont('courier', 'B', 20);
		
	
	}

	
	public function Footer() {
		$this->SetY(-15);
     	$this->SetFont('courier', 'I', 8);
		$this->Cell(0, 10, 'SISTEMA INTEGRAL (SIAISI)			                                                                                                                                                                             COMITAN, CHIAPAS', 0, false, 'C', 0, '', 0, false, 'T', 'M');
	}
}

$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);


$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Nicola Asuni');
$pdf->SetTitle('TCPDF Example 003');
$pdf->SetSubject('TCPDF Tutorial');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
$pdf->SetMargins(PDF_MARGIN_LEFT, 42, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
//$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
$pdf->setLanguageArray($l);
$pdf->SetFont('courier', 'B', 20);

$pdf->SetFont('courier', '', 8);


$bd_host = "localhost"; 
$bd_usuario = "appsclu1_apwpv16"; 
$bd_password = "apwpv1616123"; 
$bd_base = "appsclu1_puntoventa"; 

$fecha_inicial=$_GET['fecha_inicial'];
$fecha_final=$_GET['fecha_final'];

$con = mysql_connect($bd_host, $bd_usuario, $bd_password); 
mysql_select_db($bd_base, $con);

$pdf->AddPage('P', 'A4');
		
			$table1.= '<table><thead border="0">
       <tr align="center" border="0"> 
			<th align="center" border="0"><b>PERIODO: </b>'.$fecha_inicial.' A '.$fecha_final.' </th></tr></thead>';
			$table1.= '</table>';	
			
			
			
			$table2.= '<table><thead border="1">
       <tr align="center" border="1"> 
		    <th align="center" border="1"><b>NUMERO DE FACTURA</b></th>
		    <th align="center" border="1"><b>FECHA DE LA FACTURA</b></th>			
			<th align="center" border="1"><b>NOMBRE DEL CLIENTE</b></th>
			<th align="center" border="1"><b>R.F.C. DEL CLIENTE</b></th>
			<th align="center" border="1"><b>SUBTOTAL</b></th>						
			<th align="center" border="1"><b>IVA</b></th>									
			<th align="center" border="1"><b>TOTAL DE LA FACTURA</b></th>									
			<th align="center" border="1"><b>DIRECCION DE LA FACTURA</b> </th></tr></thead>';
					
				$Resultado2=mysql_query("select * from tablefacturas where (fechafactura between '$fecha_inicial' and '$fecha_final')");	
				while($MostrarFila2=mysql_fetch_array($Resultado2))
				{
				
    $table2.='<tr><td align="center" border="1">'.$MostrarFila2['numerofactura'].'</td>
			                  <td align="center" border="1">'.$MostrarFila2['fechafactura'].'</td>'.'<td align="center" border="1">'.$MostrarFila2['cliente'].'</td>'.'<td align="center" border="1">'.$MostrarFila2['rfccliente'].'</td>'.'<td align="center" border="1">'.$MostrarFila2['subtotal'].'</td>'.'<td align="center" border="1">'.$MostrarFila2['iva'].'</td>'.'<td align="center" border="1">'.$MostrarFila2['totalfactura'].'</td>'.'<td align="center" border="1">'.$MostrarFila2['direccionfactura'].'</td>';
			$table2.= '</tr>';
				
				}
			$table2.= '</table>';	
			
						
$pdf->SetFont('courier', 'B', 8);
$pdf->Ln(6);
$pdf->writeHTML($table1, true, false, false, false, '');
$pdf->Ln(6);
$pdf->Cell(0, 5,'REPORTE DE FACTURAS', 0, 1, 'C', 0, '', 0);
$pdf->Ln(6);
$pdf->writeHTML($table2, true, false, false, false, '');
$pdf->Ln(6);
$pdf->writeHTML($table3, true, false, false, false, '');
$table1="";
$table2="";
	

$pdf->Output('rptfacturas.pdf', 'I');