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
$bd_usuario = "appsclu1_bdUser"; 
$bd_password = "2018SqlUser2018"; 
$bd_base = "appsclu1_puntoventa"; 


/********************************************* fecha y hora *****************************************/
$fecha_impresion = date(d)."/".date(m)."/".date(Y);
$hora_impresion = date(H).":".date(i).":".date(s);

/****************************************************************************************************/

$fecha_inicial=$_GET['fecha_inicial'];
$fecha_final=$_GET['fecha_final'];
$usuario_imprimir=$_GET['usuario_imprimir'];

$total_corte_caja=0;

$con = mysql_connect($bd_host, $bd_usuario, $bd_password); 
mysql_select_db($bd_base, $con);

$pdf->AddPage('L', 'A4');

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
       $table1.= '<tr align="center" border="0"> 
			<th align="center" border="0"><b>USUARIO QUE IMPRIMIO: </b>'.$usuario_imprimir.' </th></tr></thead>';
       $table1.= '<tr align="center" border="0"> 
			<th align="center" border="0"><b>FECHA DE IMPRESION Y HORA DE IMPRESION: </b>'.$fecha_impresion.','.$hora_impresion.' </th></tr></thead>';
			
			
			$table1.= '</table>';	
			
				$Resultado2=mysql_query("select tv.id_venta,tv.fecha_venta,tv.id_usuario,tv.total_pagar,tv.folio_venta,
tv.nombre_cliente,cu.nombre_usuario,tv.devolucion from tventas tv inner join cusuarios cu on tv.id_usuario=cu.id_usuario where (tv.fecha_venta between '$fecha_inicial' and '$fecha_final') order by tv.id_usuario");	
				$cadena="select tv.id_venta,tv.fecha_venta,tv.id_usuario,tv.total_pagar,tv.folio_venta,
tv.nombre_cliente,cu.nombre_usuario from tventas tv inner join cusuarios cu on tv.id_usuario=cu.id_usuario where (tv.fecha_venta between '$fecha_inicial' and '$fecha_final') order by tv.id_usuario";

			$table2.= '<table>';

				while($MostrarFila2=mysql_fetch_array($Resultado2))
				{
				
				$id_venta=mb_convert_encoding($MostrarFila2['id_venta'], "UTF-8");
				$fecha_venta=mb_convert_encoding($MostrarFila2['fecha_venta'], "UTF-8");
				$total_pagar=mb_convert_encoding($MostrarFila2['total_pagar'], "UTF-8");
				$folio_venta=mb_convert_encoding($MostrarFila2['folio_venta'], "UTF-8");
				$nombre_cliente=mb_convert_encoding($MostrarFila2['nombre_cliente'], "UTF-8");
				$nombre_usuario=mb_convert_encoding($MostrarFila2['nombre_usuario'], "UTF-8");
				$devolucion=mb_convert_encoding($MostrarFila2['devolucion'], "UTF-8");
				if($devolucion==0)
					{
					  $cadena_devolucion="";
					}
				else
					{
					  $cadena_devolucion="venta por devolucion";
					}
		
				$table2.='<tr><td align="left" style="border-top:#000000 solid 1px; border-left:#000000 solid 1px; background:#CCCCCC;" colspan="5">Folio: '.$folio_venta.' - '.$cadena_devolucion.'</td>';   
				$table2.= '</tr>';
				$table2.='<tr><td align="left" style="border-top:#000000 solid 1px; border-left:#000000 solid 1px; background:#CCCCCC;" colspan="2">&nbsp;</td><td align="left" style="border-top:#000000 solid 1px; background:#CCCCCC;" colspan="1">Total: '.$total_pagar.'</td>'.'<td align="left" style="border-top:#000000 solid 1px; border-right:#000000 solid 1px; background:#CCCCCC;" colspan="2">Realizo: '.$nombre_usuario.'</td>';   
				$table2.= '</tr>';
				$table2.='<tr><td align="left" style="border-left:#000000 solid 1px; background:#CCCCCC;" colspan="2">Fecha: '.$fecha_venta.'</td><td align="left" style="border-right:#000000 solid 1px; background:#CCCCCC;" colspan="3">Cliente: '.$nombre_cliente.'</td>';   
				$table2.= '</tr>';
				$table2.='<tr><td align="left" style="border-bottom:#000000 solid 1px; border-left:#000000 solid 1px; border-right:#000000 solid 1px; background:#CCCCCC;" colspan="5">&nbsp;</td>';   
				$table2.= '</tr>';			
			
				$Resultado4=mysql_query("select id_venta,descripcion_producto,cantidad,precio_venta,subtotal from tproductos_venta where id_venta=$id_venta");	
				$cadena="select id_venta,descripcion_producto,cantidad,precio_venta,subtotal from tproductos_venta where id_venta=$id_venta";
				
				$table2.='<tr><td align="center" border="1">Cantidad</td><td align="center" border="1" colspan="2">Descripcion</td>'.'<td align="center" border="1">Precio</td>'.'<td align="center" border="1">Subtotal</td>';
				$table2.= '</tr>';				
						while($MostrarFila4=mysql_fetch_array($Resultado4))
						{
						$id_venta=mb_convert_encoding($MostrarFila4['id_venta'], "UTF-8");
						$descripcion_producto=mb_convert_encoding($MostrarFila4['descripcion_producto'], "UTF-8");
						$cantidad=mb_convert_encoding($MostrarFila4['cantidad'], "UTF-8");
						$precio_venta=mb_convert_encoding($MostrarFila4['precio_venta'], "UTF-8");
						$subtotal=mb_convert_encoding($MostrarFila4['subtotal'], "UTF-8");
						
		////////////////////////////// descripcion de la venta ////////////////////////////////////////////////////////////
		
					$table2.='<tr><td align="center" border="1">'.$cantidad.'</td><td align="center" border="1" colspan="2">'.$descripcion_producto.'</td>'.'<td align="center" border="1">'.$precio_venta.'</td>'.'<td align="center" border="1">'.$subtotal.'</td>';
					$table2.= '</tr>';
						
						}
				
    		$table2.='<tr><td>&nbsp;</td></tr>';
    		$table2.='<tr><td>&nbsp;</td></tr>';			
			
				$total_corte_caja=$total_corte_caja+$total_pagar;

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