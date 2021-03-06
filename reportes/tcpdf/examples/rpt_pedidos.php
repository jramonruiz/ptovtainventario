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
$con = mysql_connect($bd_host, $bd_usuario, $bd_password); 
mysql_select_db($bd_base, $con);

$pdf->AddPage('P', 'A4');
		
			$table2.= '<table><thead border="1">
       <tr align="center" border="1"> 
		    <th align="center" border="1"><b>CODIGO</b></th>
			<th align="center" border="1"><b>DESCRIPCION</b> </th>
			<th align="center" border="1"><b>PRECIO DE COMPRA</b> </th>
			<th align="center" border="1"><b>PRECIO DE VENTA</b> </th>
			<th align="center" border="1"><b>CANTIDAD EN EXISTENCIA</b> </th>			
			<th align="center" border="1"><b>SOTCK MINIMO</b> </th></tr></thead>';
					
				$Resultado2=mysql_query("select codigoarticulo,descripcion,preciocompra,precioventa,cantidadexistencia,stockminimo from tableinventario");	
				while($MostrarFila2=mysql_fetch_array($Resultado2))
				{
					
	
    $table2.='<tr><td align="center" border="1">'.$MostrarFila2['codigoarticulo'].'</td>
			                  <td align="center" border="1">'.$MostrarFila2['descripcion'].'</td>';
			$table2.= '<td align="center" border="1">'.$MostrarFila2['preciocompra'].'</td>';
			$table2.= '<td align="center" border="1">'.$MostrarFila2['precioventa'].'</td>';
			$table2.= '<td align="center" border="1">'.$MostrarFila2['cantidadexistencia'].'</td>';		
			$table2.= '<td align="center" border="1">'.$MostrarFila2['stockminimo'].'</td>';					
			$table2.= '</tr>';
	
				
				
				}
				
			$table2.= '</table>';	
			

$pdf->SetFont('courier', 'B', 8);
$pdf->Ln(6);
$pdf->Cell(0, 5,'FORMATO DE PEDIDOS', 0, 1, 'C', 0, '', 0);
$pdf->Ln(16);
$pdf->writeHTML($table2, true, false, false, false, '');
$table2="";
	

$pdf->Output('rpt_pedidos.pdf', 'I');