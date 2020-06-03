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
		$this->Cell(0, 10, 'CORTE DE CAJA DIARIO		                                                                                                                                                                             CORTE CAJA, DIARIO', 0, false, 'C', 0, '', 0, false, 'T', 'M');
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
$bd_usuario = "appsclu1_bdUser"; 
$bd_password = "2018SqlUser2018"; 
$bd_base = "appsclu1_puntoventa"; 
		
/*$bd_host = "localhost"; 
$bd_usuario = "root"; 
$bd_password = ""; 
$bd_base = "puntoventa";*/

/********************************************* fecha y hora *****************************************/
$fecha_impresion = date(d)."/".date(m)."/".date(Y);
$hora_impresion = date(H).":".date(i).":".date(s);

/****************************************************************************************************/

$fecha_inicial=$_GET['fecha_inicial'];
$fecha_final=$_GET['fecha_final'];
$usuario_imprimir=$_GET['usuario_imprimir'];

$total_cobrado=0;


$con = mysql_connect($bd_host, $bd_usuario, $bd_password); 
mysql_select_db($bd_base, $con);

$pdf->AddPage('P', 'A4');

			$table1.= '<table><thead border="0">
       <tr align="center" border="0"> 
			<th align="center" border="0"><b>CORTE DE CAJA DIARIO </b></th></tr></thead>';
       $table1.= '<tr align="center" border="0"> 
			<th align="center" border="0"><b>USUARIO QUE IMPRIMIO: </b>'.$usuario_imprimir.' </th></tr></thead>';
       $table1.= '<tr align="center" border="0"> 
			<th align="center" border="0"><b>FECHA DE IMPRESION Y HORA DE IMPRESION: </b>'.$fecha_impresion.','.$hora_impresion.' </th></tr></thead>';
			
			
			$table1.= '</table>';	
		
			$table2.= '<table><thead border="1">
       <tr align="center" border="1"> 
		    <th align="center" border="1"><b>TICKET</b></th>
			<th align="center" border="1"><b>FECHA</b></th>
			<th align="center" border="1"><b>TOTAL VENTA</b></th>
			<th align="center" border="1"><b>OBSERVACIONES</b></th></tr></thead>';
					
				$Resultado2=mysql_query("select tv.id_venta,tv.fecha_venta,tv.id_usuario,tv.total_pagar,tv.folio_venta,
tv.nombre_cliente,cu.nombre_usuario,tv.devolucion,cc.id_caja,cc.efectivo_caja from tventas tv inner join cusuarios cu on tv.id_usuario=cu.id_usuario inner join ccajas cc on cu.id_caja=cc.id_caja where (tv.fecha_venta between '$fecha_inicial' and '$fecha_final') order by tv.id_usuario");	
				while($MostrarFila2=mysql_fetch_array($Resultado2))
				{
				
				$fecha_venta=mb_convert_encoding($MostrarFila2['fecha_venta'], "UTF-8");
				$total_pagar=mb_convert_encoding($MostrarFila2['total_pagar'], "UTF-8");
				$folio_venta=mb_convert_encoding($MostrarFila2['folio_venta'], "UTF-8");
				$devolucion=mb_convert_encoding($MostrarFila2['devolucion'], "UTF-8");
				$efectivo_caja=mb_convert_encoding($MostrarFila2['efectivo_caja'], "UTF-8");				
				
				$total_cobrado=$total_cobrado+$total_pagar;
				
				if($devolucion==0)
					{
					  $cadena_devolucion="";
					}
				else
					{
					  $cadena_devolucion="venta por devolucion";
					}
////////////////////////////// descripcion de la venta ////////////////////////////////////////////////////////////
		  
			  $table2.='<tr><td align="center" border="1">'.$folio_venta.'</td><td align="center" border="1">'.$fecha_venta.'</td>'.'<td align="center" border="1">'.$total_pagar.'</td>'.'<td align="center" border="1">'.$cadena_devolucion.'</td>';
					  $table2.= '</tr>';
				
				}
				
				
			$total_corte_caja=0;
			$efectivo_ganado=0;
			$total_corte_caja=$total_cobrado+$efectivo_caja;	
			
			$efectivo_ganado=$total_corte_caja-$efectivo_caja;
				
			$table2.= '</table>';	
			
			$table3.= '<table><thead border="0">
       <tr align="center" border="0"> 
			<th align="center" border="0"><b>IMPORTE DE APERTURA DE CAJA: </b>'.$efectivo_caja.' </th></tr></thead>';
       		$table3.='<tr align="center" border="0"> 
			<th align="center" border="0"><b>TOTAL COBRADO: </b>'.$total_cobrado.' </th></tr></thead>';			
       		$table3.='<tr align="center" border="0"> 
			<th align="center" border="0"><b>TOTAL CORTE DE CAJA: </b>'.$total_corte_caja.' </th></tr></thead>';			
       		$table3.='<tr align="center" border="0"> 
			<th align="center" border="0"><b>EFECTIVO GANADO: </b>'.$efectivo_ganado.' </th></tr></thead>';			
			$table3.= '</table>';
			
$pdf->SetFont('courier', 'B', 12);
$pdf->Ln(6);
$pdf->writeHTML($table1, true, false, false, false, '');
$pdf->Ln(6);
$pdf->writeHTML($table2, true, false, false, false, '');
$pdf->Ln(6);
$pdf->writeHTML($table3, true, false, false, false, '');
$table1="";
$table2="";
$table3="";



$pdf->Output('cortecajadiario.pdf', 'I');