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

$numero_de_factura=$_GET['numero_factura'];
//$numero_de_factura=9999;


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
				$Resultado=mysql_query("select * from tablefacturas where numerofactura='$numero_de_factura'",$con);
				while($MostrarFila=mysql_fetch_array($Resultado))
				{

$pdf->AddPage('P', 'A4');
		
$table.= '<table border="0" cellspacing="0" cellpadding="10" >';
			$table.= '<tr><td align="left">NUMERO DE FACTURA:'.$MostrarFila['numerofactura'].'</td></tr>';
			$table.= '<tr><td align="left">CLIENTE: '.$MostrarFila['cliente'].'</td></tr>';
			$table.= '<tr><td align="left">RFC DEL CLIENTE:'.$MostrarFila['rfccliente'].'</td></tr>';
			$table.= '<tr><td align="left">DIRECCION: '.$MostrarFila['direccionfactura'].'</td></tr>';			
			$table.= '<tr><td align="left">FECHA DE LA FACTURA:'.$MostrarFila['fechafactura'].'</td></tr>';
			
$table.= '</table>';
					$idventa=$MostrarFila['idventa'];
					$table2.= '<table><tr>'.
		    '<td align="center" border="1"><b>CODIGO</b></td>
			<td align="center" border="1"><b>DECRIPCION</b> </td>
			<td align="center" border="1"><b>CANTIDAD</b> </td>
			<td align="center" border="1"><b>PRECIO</b> </td>
			<td align="center" border="1"><b>IMPORTE</b> </td></tr>';
					
				$Resultado2=mysql_query("select * from productosventa where idventa=$idventa");	
				while($MostrarFila2=mysql_fetch_array($Resultado2))
				{
					
	
    $table2.='<tr><td align="center" border="1">'.$MostrarFila2['codigoproducto'].'</td>
			                  <td align="center" border="1">'.$MostrarFila2['descripcionproducto'].'</td>';
			$table2.= '<td align="center" border="1">'.$MostrarFila2['cantidadproducto'].'</td>';
			$table2.= '<td align="center" border="1">'.$MostrarFila2['preciounitarioproducto'].'</td>';
			$table2.= '<td align="center" border="1">'.$MostrarFila2['importeproducto'].'</td>';		
			$table2.= '</tr>';
	
				
				
				}
				
			$table2.= '</table>';	
			
$table3.= '<table border="0" cellspacing="0" cellpadding="10" >';


				
			$table3.= '<tr><td align="right">SUBTOTAL: '.$MostrarFila['subtotal'].'</td></tr>';	
			$table3.= '<tr><td align="right">IVA: '.$MostrarFila['iva'].'</td></tr>';		
			$table3.= '<tr><td align="right">TOTAL DE LA FACTURA: '.$MostrarFila['totalfactura'].'</td></tr>';		
			$table3.= '<tr><td align="right">CANTIDAD EN LETRA: '.$MostrarFila['cantidadletra'].'</td></tr>';					
				
			
$table3.= '</table>';
			

$pdf->SetFont('courier', 'B', 8);
$pdf->Ln(6);
$pdf->Cell(0, 5,'FACTURA', 0, 1, 'C', 0, '', 0);
$pdf->Ln(6);
$pdf->writeHTML($table, true, false, false, false, '');
$pdf->writeHTML($table2, true, false, false, false, '');
$pdf->writeHTML($table3, true, false, false, false, '');
$table="";
$table2="";
$table3="";
	
			}

$pdf->Output('imprimir_factura.pdf', 'I');