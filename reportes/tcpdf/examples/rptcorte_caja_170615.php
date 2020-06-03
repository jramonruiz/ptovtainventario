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
		$this->Cell(0, 10, 'CORTE DE CAJA			                                                                                                                                                                             CORTE, CAJA', 0, false, 'C', 0, '', 0, false, 'T', 'M');
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
$bd_usuario = "root"; 
$bd_password = ""; 
$bd_base = "puntoventa";

/*$bd_host = "localhost"; 
$bd_usuario = "senticco_hotel"; 
$bd_password = "hotsis"; 
$bd_base = "senticco_sinve"; */



$fecha_inicial=$_GET['fecha_inicial'];
$fecha_final=$_GET['fecha_final'];

$total_corte_caja=0;

$con = mysql_connect($bd_host, $bd_usuario, $bd_password); 
mysql_select_db($bd_base, $con);

$pdf->AddPage('P', 'A4');

				$fecha_completa_inicial=explode("-", $fecha_inicial);

				switch ($fecha_completa_inicial[1]) {
					case "01":
						$mes="ENERO";
						break;
					case "02":
						$mes="FEBRERO";
						break;
					case "03":
						$mes="MARZO";
						break;				
					case "04":
						$mes="ABRIL";
						break;
					case "05":
						$mes="MAYO";
						break;
					case "06":
						$mes="JUNIO";
						break;				
					case "07":
						$mes="JULIO";
						break;
					case "08":
						$mes="AGOSTO";
						break;
					case "09":
						$mes="SEPTIEMBRE";
						break;				
					case "10":
						$mes="OCTUBRE";
						break;
					case "11":
						$mes="NOVIEMBRE";
						break;
					case "12":
						$mes="DICIEMBRE";
						break;	
					}		
					
				$fecha_completa_final=explode("-", $fecha_final);

				switch ($fecha_completa_final[1]) {
					case "01":
						$mes2="ENERO";
						break;
					case "02":
						$mes2="FEBRERO";
						break;
					case "03":
						$mes2="MARZO";
						break;				
					case "04":
						$mes2="ABRIL";
						break;
					case "05":
						$mes2="MAYO";
						break;
					case "06":
						$mes2="JUNIO";
						break;				
					case "07":
						$mes2="JULIO";
						break;
					case "08":
						$mes2="AGOSTO";
						break;
					case "09":
						$mes2="SEPTIEMBRE";
						break;				
					case "10":
						$mes2="OCTUBRE";
						break;
					case "11":
						$mes2="NOVIEMBRE";
						break;
					case "12":
						$mes2="DICIEMBRE";
						break;	
					}			
					
			$fecha_final_corte_caja=$fecha_completa_final[2]." DE ".$mes2." DE ".$fecha_completa_final[0];
			$fecha_inicial_corte_caja=$fecha_completa_inicial[2]." DE ".$mes." DE ".$fecha_completa_inicial[0];
					
		
			$table1.= '<table><thead border="0">
       <tr align="center" border="0"> 
			<th align="center" border="0"><b>PERIODO: </b>'.$fecha_inicial_corte_caja.' A '.$fecha_final_corte_caja.' </th></tr></thead>';
			$table1.= '</table>';	
			
			
			
			$table2.= '<table><thead border="1">
       <tr align="center" border="1"> 
		    <th align="center" border="1"><b>FECHA DE LA VENTA</b></th>
			<th align="center" border="1"><b>TOTAL DE LA VENTA</b></th>
			<th align="center" border="1"><b>PAGO DE LA VENTA</b></th>			
			<th align="center" border="1"><b>CAMBIO DE LA VENTA</b></th>						
			<th align="center" border="1"><b>NOMBRE DEL RESPONSABLE</b> </th></tr></thead>';
					
				$Resultado2=mysql_query("select * from vcorte_caja_usuario where (fecha_venta between '$fecha_inicial' and '$fecha_final')");	
				$cadena="select * from vcorte_caja_usuario where (fecha_venta between '$fecha_inicial' and '$fecha_final')";
				while($MostrarFila2=mysql_fetch_array($Resultado2))
				{
				
				$id_venta=$MostrarFila2['id_venta'];
				$fecha_venta=$MostrarFila2['fecha_venta'];
				$total_venta=$MostrarFila2['total_venta'];
				$pago_venta=$MostrarFila2['pago_venta'];
				$cambio_venta=$MostrarFila2['cambio_venta'];
				$id_usuario=$MostrarFila2['id_usuario'];					 				
				$nombre_usuario=$MostrarFila2['nombre_usuario'];

////////////////////////////// descripcion de la venta ////////////////////////////////////////////////////////////

    $table2.='<tr><td align="center" border="1">'.$fecha_venta.'</td><td align="center" border="1">'.$total_venta.'</td>'.'<td align="center" border="1">'.$pago_venta.'</td>'.'<td align="center" border="1">'.$cambio_venta.'</td>'.'<td align="center" border="1">'.$nombre_usuario.'</td>';
			$table2.= '</tr>';
				
	
				$total_corte_caja=$total_corte_caja+$total_venta;
				}
			$table2.= '</table>';	
			
			
			$table3.= '<table><thead border="0">
       <tr align="center" border="0"> 
			<th align="center" border="0"><b>TOTAL DEL CORTE DE CAJA: </b>'.$total_corte_caja.' </th></tr></thead>';
			$table3.= '</table>';
			
$pdf->SetFont('courier', 'B', 12);
$pdf->Ln(6);
$pdf->writeHTML($table1, true, false, false, false, '');
$pdf->Ln(6);
$pdf->Cell(0, 5,'CORTE DE CAJA', 0, 1, 'C', 0, '', 0);
$pdf->Ln(6);
$pdf->writeHTML($table2, true, false, false, false, '');
$pdf->Ln(6);
$pdf->writeHTML($table3, true, false, false, false, '');
$table1="";
$table2="";
$table3="";
	

$pdf->Output('rptcorte_caja.pdf', 'I');