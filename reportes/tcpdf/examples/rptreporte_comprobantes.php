<?php
$bd_host = "localhost"; 
$bd_usuario = "pcinclou_pech"; 
$bd_password = "2019pech2019"; 
$bd_base = "pcinclou_puntoventa";


$con = mysql_connect($bd_host, $bd_usuario, $bd_password); 
mysql_select_db($bd_base, $con);
mysql_query("SET NAMES 'utf8'");

/* MEDIDAS TAMAÑO TICKET
$ancho_celda = 1200;
$ancho_celda=$ancho_celda/10;
$ancho_papel = $ancho_celda+20;
$alto_papel = $ancho_papel23;

$pos_x = $ancho_papel/3.6;
$tamaño = $ancho_papel/2.3;
*/

/** MEDIDAS TAMAÑO CARTA **/
$ancho_celda = 1960;

$ancho_celda=$ancho_celda/10;
$ancho_papel = $ancho_celda+20;
$ancho_papel2=93;
$alto_papel = $ancho_papel2*3;

$pos_x = $ancho_papel/3.6;
$tamaño = $ancho_papel/2.3;



header("Content-Type: text/html;charset=iso-8859-1");
require_once('../config/lang/eng.php');
require_once('../tcpdf.php');
class MYPDF extends TCPDF {

	
	public function Header() {
		/*$image_file = K_PATH_IMAGES.'../images/isi.jpg';
		//                               ANCHO DE LA IMAGEN,            ANCHO DE LA IMAGEN
		$this->Image($image_file, 15, 10, 180, 25, 'JPG', '', 'T', false, 300, '', false, false, 0, false, false, false);
		$this->SetFont('courier', 'B', 20);*/
		
	
	}

	
	public function Footer() {
		// Position at 15 mm from bottom
		$this->SetY(-25);
		// Set font
		//$this->SetFont('helvetica', 'I', 8);
		// Page number
		//$this->Cell(0, 10, '_________________________________________________________________________________________________________', 0, false, 'C', 0, '', 0, false, 'T', 'M');	
		$this->SetY(-20);
		// Set font
		//$this->SetFont('helvetica', 'I', 8);
		// Page number
		//$this->Cell(0, 10, '1a. CALLE NTE. OTE. No. 13 CENTRO HISTORICO, COMITAN DE DOMINGUEZ, CHIAPAS.  C.P. 30000', 0, false, 'C', 0, '', 0, false, 'T', 'M');		
		$this->Cell(0, 10, 'Reporte de comprobantes', 'T', false, 'C');				
		$this->SetY(-15);
		// Set font
		//$this->SetFont('helvetica', 'I', 8);
		// Page number
		//$this->Cell(0, 10, 'TEL. (01 963) 63 2 50 67      E-MAIL: htscoly@hotmail.com', 0, false, 'C', 0, '', 0, false, 'T', 'M');		
	
	}
}

//$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
	$pdf=new MYPDF('P','mm',array($ancho_papel,$alto_papel));
    $pdf->AliasNbPages();
    $pdf->AddPage();    
	$pdf->SetFont('times','',6);
	
	//$pdf->Image('logo_pech.jpg',$pos_x,10,$tamaño);
	//$pdf->setY($tamaño);  


/*$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Nicola Asuni');
$pdf->SetTitle('TCPDF Example 003');
$pdf->SetSubject('TCPDF Tutorial');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));*/
//$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
/*$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
$pdf->SetMargins(PDF_MARGIN_LEFT, 42, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);*/
//$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
//$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
//$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
//$pdf->setLanguageArray($l);
//$pdf->SetFont('times', 'B', 10);

$comprobante=$_GET['comprobante'];
$id_sucursal=$_GET['id_sucursal'];
$id_usuario=$_GET['id_usuario'];
$fecha_inicial=$_GET['fecha_inicial'];
$fecha_final=$_GET['fecha_final'];

$rsttd = mysql_query("select cu.nombre_usuario,cs.id_sucursal,cs.descripcion_sucursal,cc.descripcion_caja from cusuarios cu 
inner join csucursales cs on cu.id_sucursal=cs.id_sucursal inner join ccajas cc on cu.id_caja=cc.id_caja where cu.id_sucursal=$id_sucursal");
if ($rowttd = mysql_fetch_row($rsttd)) {
	$nombre_usuario= utf8_encode($rowttd[0]);
	$id_sucursal= utf8_encode($rowttd[1]);
	$descripcion_sucursal= utf8_encode($rowttd[2]);
	$descripcion_caja= utf8_encode($rowttd[3]);
}


$hoy=date("d/m/Y H:i:s"); 


//$pdf->AddPage('P', 'A4');
		
			$table1.= '<table><thead border="0">
       		<tr>
				<td align="center" border="0" colspan="8">
					<b>NOMBRE DEL NEGOCIO</b><br>
					<b>DATO 1 DE LA EMPRESA</b><br>
					<b>Reporte de comprobantes</b><br>
					<b>FECHA:'.$hoy.'</b><br>
					<b>USUARIO:'.$nombre_usuario.'</b><br>
					<b>CAJA:'.$descripcion_caja.'</b><br>
				</td>
		    </tr>
			<tr align="center" border="0">
				<td colspan="8" style="border-bottom:solid 1px color:#000000;">&nbsp;</td>
			</tr> 
			</thead>
			<tr>
				<td align="left">NUMERO</td><td align="left">FECHA</td><td align="left" colspan="4">CLIENTE</td><td align="left">TOTAL</td>
			</tr>
			<tr align="center" border="0">
				<td colspan="8" style="border-bottom:solid 1px color:#000000;">&nbsp;</td>
			</tr>';

					/// TOTAL DE REGISTROS
						$rstotreg = mysql_query("select COUNT(id_venta) as totreg from tventas where id_sucursal=$id_sucursal and venta_cancelada=0 and merma=0 and tipo_operacion=$comprobante");
						if ($rowtotreg = mysql_fetch_row($rstotreg)) {
						$totreg = trim($rowtotreg[0]);
						}

						/// TOTAL DE REGISTROS ENTRE FECHAS
						$rstotregf = mysql_query("select COUNT(id_venta) as totregfecha from tventas where id_sucursal=$id_sucursal and venta_cancelada=0 and merma=0 and tipo_operacion=$comprobante and (fecha_venta between '$fecha_inicial' and '$fecha_final')");
						if ($rowtotregf = mysql_fetch_row($rstotregf)) {
						$totregfecha = trim($rowtotregf[0]);
						}

						

			$subtotals=0;
			$ivas=0;
			$totals=0;
			$consecutivo=$totreg-$totregfecha;



				/*if($comprobante==1)
					{	
						$Resultado2=mysql_query("select id_venta,fecha_venta,nombre_cliente,total_pagar,iva,total_venta,tipo_operacion,venta_cancelada from tventas where id_sucursal=$id_sucursal and tipo_operacion=1 and merma=0 and (fecha_venta between '$fecha_inicial' and '$fecha_final') order by id_venta DESC");
					}
				else
					{
						$Resultado2=mysql_query("select id_venta,fecha_venta,nombre_cliente,total_pagar,iva,total_venta,tipo_operacion,venta_cancelada from tventas where id_sucursal=$id_sucursal and tipo_operacion=2 and merma=0 and (fecha_venta between '$fecha_inicial' and '$fecha_final') order by id_venta DESC");
					}*/

					$Resultado2=mysql_query("select id_venta,fecha_venta,nombre_cliente,total_pagar,iva,total_venta,tipo_operacion,venta_cancelada,folioempresa from tventas where id_sucursal=$id_sucursal and merma=0 and (fecha_venta between '$fecha_inicial' and '$fecha_final') order by id_venta ASC");

				while($MostrarFila2=mysql_fetch_array($Resultado2))
				{
					$id_venta=utf8_encode($MostrarFila2['id_venta']);
					$fecha_venta=utf8_encode($MostrarFila2['fecha_venta']);
					$nombre_cliente=utf8_encode($MostrarFila2['nombre_cliente']);
					$total_pagar=utf8_encode($MostrarFila2['total_pagar']);
					$iva=utf8_encode($MostrarFila2['iva']);
					$total_venta=utf8_encode($MostrarFila2['total_venta']);
					$tipo_operacion=utf8_encode($MostrarFila2['tipo_operacion']);
					$venta_cancelada=utf8_encode($MostrarFila2['venta_cancelada']);
					$folioempresa=utf8_encode($MostrarFila2['folioempresa']);

					$fecha_completa=explode("-", $fecha_venta);

					/*$subtotals=$subtotals+$total_pagar;
					$ivas=$ivas+$iva;
					$totals=$totals+$total_venta;*/
					
					

					if($tipo_operacion==1)
						{
							$ctipocomprobante="TICKET";
							$prefijocomp="T";
							//$consecutivo=$consecutivo+1;
						}
					else
						{
							$ctipocomprobante="AJUSTE DE SALIDA";
							$prefijocomp="AS";
							//$consecutivo=$consecutivo+1;
						}

					if($venta_cancelada==1)
						{
							$observacioncad="CANCELADA";
						}
					else
						{
							$observacioncad="";
						}	

					if($comprobante==$tipo_operacion)
					{	
					$consecutivo=$consecutivo+1;	
					$subtotals=$subtotals+$total_pagar;
					$ivas=$ivas+$iva;
					$totals=$totals+$total_venta;

			  		$table1.='<tr><td align="left">T'.$folioempresa.'</td><td align="left">'.$fecha_completa[2].'-'.$fecha_completa[1].'-'.$fecha_completa[0].'</td>'.'<td align="left" colspan="4">'.$nombre_cliente.'</td><td align="left">'.$total_venta.'</td>';
					  $table1.= '</tr>';
					}
				

				}

				$table1.= '<tr align="center" border="0">
				<td colspan="8">&nbsp;</td>
			</tr>';

			$table1.= '<tr align="left" border="0">
				<td colspan="8">Total: $ '.$totals.'</td>
			</tr>';

			$table1.= '<tr align="center" border="0">
				<td colspan="8">&nbsp;</td>
			</tr>';

				

			
			
			$table1.= '</table>';	
			
$pdf->SetFont('times', '', 10);
$pdf->Ln(6);
$table1 = utf8_decode($table1); 
$pdf->writeHTML($table1, true, false, false, false, '');
/*$pdf->Ln(3);
$pdf->writeHTML($table2, true, false, false, false, '');
$pdf->Ln(1);
$pdf->writeHTML($table5, true, false, false, false, '');
$pdf->Ln(1);
$pdf->writeHTML($table6, true, false, false, false, '');*/
$table1="";
/*$table2="";
$table5="";
$table6="";*/

	

$pdf->Output('reportedecomprobantes.pdf', 'I');