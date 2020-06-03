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
		$this->Cell(0, 10, 'Ticket de venta (DEVOLUCION)', 0, false, 'C', 0, '', 0, false, 'T', 'M');
	}
}

$id_devolucion=$_GET['id_devolucion'];
//$id_venta=1;


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
$bd_usuario = "appsclu1_bdUser"; 
$bd_password = "2018SqlUser2018"; 
$bd_base = "appsclu1_puntoventa"; 

$con = mysql_connect($bd_host, $bd_usuario, $bd_password); 
mysql_select_db($bd_base, $con);
				$Resultado=mysql_query("select * from tdevoluciones where id_devolucion=$id_devolucion",$con);
				while($MostrarFila=mysql_fetch_array($Resultado))
				{

$pdf->AddPage('P', 'A4');
		
$table.= '<table border="0" cellspacing="0" cellpadding="10" >';
			$table.= '<tr><td align="left">Ticket de venta de la devolucion:'.mb_convert_encoding($MostrarFila['ticket_venta_relacion'], "UTF-8").'</td></tr>';
			$table.= '<tr><td align="left">Folio Devolucion:'.mb_convert_encoding($MostrarFila['folio_devolucion'], "UTF-8").'</td></tr>';
			$table.= '<tr><td align="left">Fecha de la devolucion:'.mb_convert_encoding($MostrarFila['fecha_devolucion'], "UTF-8").'</td></tr>';
			$table.= '</table>';
			
					$id_devolucion=$MostrarFila['id_devolucion'];
					$total_pagar=$MostrarFila['total_pagar'];			
					
			$table2.= '<table><tr>'.
		    '<td align="center" border="1"><b>DESCRIPCION</b> </td>
			<td align="center" border="1"><b>CANTIDAD</b> </td>
			<td align="center" border="1"><b>PRECIO</b> </td>
			<td align="center" border="1"><b>IMPORTE</b> </td></tr>';
					
				$Resultado2=mysql_query("select * from tproductos_devolucion where id_devolucion=$id_devolucion");	
				while($MostrarFila2=mysql_fetch_array($Resultado2))
				{
					
	
    $table2.='<tr><td align="center" border="1">'.mb_convert_encoding($MostrarFila2['descripcion_producto'], "UTF-8").'</td>';
			$table2.= '<td align="center" border="1">'.$MostrarFila2['cantidad'].'</td>';
			$table2.= '<td align="center" border="1">'.$MostrarFila2['precio_venta'].'</td>';
			$table2.= '<td align="center" border="1">'.$MostrarFila2['subtotal'].'</td>';		
			$table2.= '</tr>';
	
				
				
				}
				
			$table2.= '</table>';	
			
$table3.= '<table border="0" cellspacing="0" cellpadding="10" >';


				
			$table3.= '<tr><td align="right">TOTAL DE LA DEVOLUCION: $ '.$MostrarFila['total_pagar'].'</td></tr>';	
				
			
$table3.= '</table>';
			

$pdf->SetFont('courier', 'B', 8);
$pdf->Ln(6);
$pdf->Cell(0, 5,'COMPROBANTE DE VENTA (DEVOLUCION)', 0, 1, 'C', 0, '', 0);
$pdf->Ln(16);
$pdf->writeHTML($table, true, false, false, false, '');
$pdf->writeHTML($table2, true, false, false, false, '');
$pdf->writeHTML($table3, true, false, false, false, '');
$table="";
$table2="";
$table3="";
	
			}

$pdf->Output('imprimir_devolucion.pdf', 'I');