<?php
$bd_host = "localhost"; 
$bd_usuario = "root"; 
$bd_password = ""; 
$bd_base = "puntoventa";


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

$fecha_inicial=$_GET['fecha_inicial'];
$fecha_final=$_GET['fecha_final'];
$usuario_imprimir=$_GET['usuario_imprimir'];
$id_usuario=$_GET['id_usuario'];
$descripcion_caja=$_GET['descripcion_caja'];
$descripcion_sucursal=$_GET['descripcion_sucursal'];
$id_sucursal=$_GET['id_sucursal'];

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
				<td align="center" border="0" colspan="1">
					<b>BLUSH DISTRIBUIDOR DE</b><br>
					<b>PRODUCTOS DE BELLEZA</b><br>
					<b>'.$descripcion_sucursal.'</b><br>
					<b>Reporte desglose de notas</b><br>
					<b>FECHA:'.$hoy.'</b><br>
					<b>USUARIO:'.$nombre_usuario.'</b><br>
					<b>CAJA:'.$descripcion_caja.'</b><br>
				</td>
		    </tr>
			</thead>';

			//$cadena="select id_venta,fecha_venta,nombre_cliente,total_pagar,iva,total_venta,tipo_operacion,venta_cancelada from tventas where id_sucursal=$id_sucursal and venta_cancelada=0 and merma=0 and (fecha_venta between '$fecha_inicial' and '$fecha_final') order by id_venta DESC";

			//$table1.='<tr><td>'.$cadena.'</td></tr>';

						// TOTAL DE TICKETS EN LA BASE DE DATOS
			              $rstt = mysql_query("select count(id_venta) as total_tickets from tventas where tipo_operacion=1 and id_sucursal=$id_sucursal");
			              if ($rowtt = mysql_fetch_row($rstt)) {
			                $total_tickets= trim($rowtt[0]);
			              }

			              // TOTAL DE TICKETS EN MERMA
			              $rsttm = mysql_query("select count(id_venta) as total_tickets_merma from tventas where tipo_operacion=1 and id_sucursal=$id_sucursal and merma=1");
			              if ($rowttm = mysql_fetch_row($rsttm)) {
			                $total_tickets_merma= trim($rowttm[0]);
			              }

			              // TOTAL DE AJUSTES DE SALIDA EN LA BASE DE DATOS
			              $rsttas = mysql_query("select count(id_venta) as total_ajustes_salida from tventas where tipo_operacion=2 and id_sucursal=$id_sucursal");
			              if ($rowttas = mysql_fetch_row($rsttas)) {
			                $total_ajustes_salida= trim($rowttas[0]);
			              }

						  // TOTAL DE TICKETS EN SIN MERMA DE UN RANGO DE FECHAS
			              $rsttsmf = mysql_query("select count(id_venta) as total_tickets_merma from tventas where tipo_operacion=1 and id_sucursal=$id_sucursal and merma=0 and (fecha_venta between '$fecha_inicial' and '$fecha_final')");
			              if ($rowttsmf = mysql_fetch_row($rsttsmf)) {
			                $total_tickets_smermaf= trim($rowttsmf[0]);
			              }			              

			              // TOTAL DE AJUSTES DE SALIDA EN LA BASE DE DATOS
			              $rsttasf = mysql_query("select count(id_venta) as total_ajustes_salida from tventas where tipo_operacion=2 and id_sucursal=$id_sucursal and (fecha_venta between '$fecha_inicial' and '$fecha_final')");
			              if ($rowttasf = mysql_fetch_row($rsttasf)) {
			                $total_ajustes_salidafecha= trim($rowttasf[0]);
			              }


			              $totalticketsinmerma=$total_tickets-$total_tickets_merma;
			              $folioticketscomienzo=$totalticketsinmerma-$total_tickets_smermaf;

			              $folioajustessalidacomienzo=$total_ajustes_salida-$total_ajustes_salidafecha;


			$desglosenotasgeneral="";
			$facturas="";
			$fecha_comparar="";
			$total_dia=0.00;
			$nota="";
			$subtotals=0;
			$ivas=0;
			$totals=0;
			//$consecutivo=$totreg-$totregfecha;
			$consecutivot=$folioticketscomienzo;
			$consecutivoas=$folioajustessalidacomienzo;

					//$Resultado2=mysql_query("select id_venta,fecha_venta,nombre_cliente,total_pagar,iva,total_venta,tipo_operacion,venta_cancelada,numero_factura,fecha_factura from tventas where id_sucursal=$id_sucursal and venta_cancelada=0 and merma=0 and (fecha_venta between '$fecha_inicial' and '$fecha_final') order by id_venta ASC");
					$Resultado2=mysql_query("select id_venta,fecha_venta,nombre_cliente,total_pagar,iva,total_venta,tipo_operacion,venta_cancelada,numero_factura,fecha_factura from tventas where id_sucursal=$id_sucursal and merma=0 and (fecha_venta between '$fecha_inicial' and '$fecha_final') order by id_venta ASC");

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
					$numero_factura=utf8_encode($MostrarFila2['numero_factura']);
					$fecha_factura=utf8_encode($MostrarFila2['fecha_factura']);

					$subtotals=$subtotals+$total_pagar;
					$ivas=$ivas+$iva;
					$totals=$totals+$total_venta;
					//$consecutivo=$consecutivo+1;
					

					if($tipo_operacion==1)
						{
							$ctipocomprobante="T";
						}
					else
						{
							$ctipocomprobante="AS";
						}

				$fecha_completa=explode("-", $fecha_venta);

				switch ($fecha_completa[1]) {
					case "01":
						$mes="enero";
						break;
					case "02":
						$mes="febrero";
						break;
					case "03":
						$mes="marzo";
						break;				
					case "04":
						$mes="abril";
						break;
					case "05":
						$mes="mayo";
						break;
					case "06":
						$mes="junio";
						break;				
					case "07":
						$mes="julio";
						break;
					case "08":
						$mes="agosto";
						break;
					case "09":
						$mes="septiembre";
						break;				
					case "10":
						$mes="octubre";
						break;
					case "11":
						$mes="noviembre";
						break;
					case "12":
						$mes="diciembre";
						break;	
					}

					if($fecha_comparar=="")
					{
						//$total_dia=$total_dia+$total_pagar;
							if($numero_factura!="")
							{
								$facturas=$facturas.' FACTURA '.$ctipocomprobante.$consecutivo.' por $ '.$total_pagar.',';	
							}

						if($tipo_operacion==1)
							{
								$nota='<br><br>'.$fecha_completa[2].' de '.$mes.' del '.$fecha_completa[0].' : '.$ctipocomprobante.$consecutivot.' por $ '.$total_pagar.', ';
								$desglosenotasgeneral=$desglosenotasgeneral.$nota.$facturas;
								$consecutivot=$consecutivot+1;
							}
						else
							{
								$nota='<br><br>'.$fecha_completa[2].' de '.$mes.' del '.$fecha_completa[0].' : '.$ctipocomprobante.$consecutivoas.' por $ '.$total_pagar.', ';
								$desglosenotasgeneral=$desglosenotasgeneral.$nota.$facturas;	
								$consecutivoas=$consecutivoas+1;
							}
					}

					if(($fecha_comparar!=$fecha_venta) and ($fecha_comparar!=""))
					{
						/// SUMANDO TOTALES DEL DIA
						$rssmvrdn = mysql_query("select SUM(total_pagar) as total_dia from tventas where id_sucursal=$id_sucursal and venta_cancelada=0 and merma=0 and fecha_venta='$fecha_comparar'");
						if ($rowsmvrdn = mysql_fetch_row($rssmvrdn)) {
						$total_dia = trim($rowsmvrdn[0]);
						}

							if($numero_factura!="")
							{
								$facturas=$facturas.' FACTURA '.$ctipocomprobante.$consecutivo.' por $ '.$total_pagar.',';	
							}

						//$total_dia=$total_dia+$total_pagar;
						$nota='<span style="color:red;">$ '.$total_dia.'</span>'.'<br><br>'.$fecha_completa[2].' de '.$mes.' del '.$fecha_completa[0].' : '.$ctipocomprobante.$consecutivo.' por $ '.$total_pagar.', ';
						$desglosenotasgeneral=$desglosenotasgeneral.$nota.$facturas;	
						$total_dia=0.00;
					}

					if($fecha_comparar==$fecha_venta)
					{
						$total_dia=$total_dia+$total_pagar;
						$nota=$ctipocomprobante.$consecutivo.' por $ '.$total_pagar.', ';
						$desglosenotasgeneral=$desglosenotasgeneral.$nota;	
					}

					$fecha_comparar=$fecha_venta;
					
				}

						/// SUMANDO TOTALES DEL DIA
						$rssmvrdn = mysql_query("select SUM(total_pagar) as total_dia from tventas where id_sucursal=$id_sucursal and venta_cancelada=0 and merma=0 and fecha_venta='$fecha_comparar'");
						if ($rowsmvrdn = mysql_fetch_row($rssmvrdn)) {
						$total_dia = trim($rowsmvrdn[0]);
						}

				  		$table1.='<tr><td align="left">'.$desglosenotasgeneral.' '.'<span style="color:red;">$ '.$total_dia.'</span></td>';
						$table1.= '</tr>';


							
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

	

$pdf->Output('reportedesglosenotas.pdf', 'I');