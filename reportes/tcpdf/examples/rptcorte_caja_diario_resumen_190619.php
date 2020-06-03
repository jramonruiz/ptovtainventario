<?php
$bd_host = "localhost"; 
$bd_usuario = "root"; 
$bd_password = ""; 
$bd_base = "puntoventa";

$con = mysql_connect($bd_host, $bd_usuario, $bd_password); 
mysql_select_db($bd_base, $con);
mysql_query("SET NAMES 'utf8'");

$ancho_celda = 1200;

$ancho_celda=$ancho_celda/10;
$ancho_papel = $ancho_celda+20;
$alto_papel = $ancho_papel*3;

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
		$this->Cell(0, 10, 'Corte de caja (resumen) ', 'T', false, 'C');				
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

$hoy=date("d/m/Y"); 


// NUMERO DE VENTAS EN EFECTIVO
$rsnvefe = mysql_query("select count(tpv.id_pago_venta) as numero_ventas,tv.id_venta,tv.fecha_venta from tventas tv 
inner join tpagos_venta tpv on tv.id_venta=tpv.id_venta inner join cusuarios cu on tv.id_usuario=cu.id_usuario inner join ccajas cc on cu.id_caja=cc.id_caja where cu.id_usuario=$id_usuario and tv.pagado_totalmente=1 and tv.tipo_operacion=1 and tpv.id_tipo_pago=1 and tv.venta_cancelada=0 and tv.merma=0 and (tv.fecha_venta between '$fecha_inicial' and '$fecha_final')");
if ($rownvefe = mysql_fetch_row($rsnvefe)) {
	$numero_ventasefe= trim($rownvefe[0]);
}

// TOTAL EN EFECTIVO
$rste = mysql_query("select SUM(tpv.monto) as totefectivo,tv.id_venta,tv.fecha_venta from tventas tv inner join tpagos_venta tpv on tv.id_venta=tpv.id_venta inner join cusuarios cu on tv.id_usuario=cu.id_usuario inner join ccajas cc on cu.id_caja=cc.id_caja where cu.id_usuario=$id_usuario and tv.pagado_totalmente=1 and tv.tipo_operacion=1 and tpv.id_tipo_pago=1 and tv.venta_cancelada=0 and tv.merma=0 and (tv.fecha_venta between '$fecha_inicial' and '$fecha_final')");
if ($rowte = mysql_fetch_row($rste)) {
	$total_efectivo= trim($rowte[0]);
}

// EFECTIVO APERTURA DE CAJA
$rseac = mysql_query("select efectivo_caja from ccajas where id_usuario=$id_usuario");
if ($roweac = mysql_fetch_row($rseac)) {
	$fondo_inicial= trim($roweac[0]);
}

$efectivomascaja=$total_efectivo+$fondo_inicial;

// NUMERO DE RETIROS
$rsnret = mysql_query("select count(id_retiro) as numero_retiros from tretiros where (fecha_retiro between '$fecha_inicial' and '$fecha_final')");
if ($rownret = mysql_fetch_row($rsnret)) {
	$numero_retiros= trim($rownret[0]);
}

// TOTAL EN RETIROS
$rstr = mysql_query("select sum(monto_retirar) as totretiros from tretiros where id_usuario=$id_usuario and (fecha_retiro between '$fecha_inicial' and '$fecha_final')");
if ($rowtr = mysql_fetch_row($rstr)) {
	$totretiros= trim($rowtr[0]);
}

$totaldinerocaja=$efectivomascaja-$totretiros;

// NUMERO DE VENTAS EN TARJETA DE CREDITO
$rsnvtc = mysql_query("select count(tpv.id_pago_venta) as numero_ventas,tv.id_venta,tv.fecha_venta from tventas tv 
inner join tpagos_venta tpv on tv.id_venta=tpv.id_venta inner join cusuarios cu on tv.id_usuario=cu.id_usuario 
inner join ccajas cc on cu.id_caja=cc.id_caja where cu.id_usuario=$id_usuario and tv.pagado_totalmente=1 and tv.tipo_operacion=1 
and tpv.id_tipo_pago=2 and tv.venta_cancelada=0 and tv.merma=0 and (tv.fecha_venta between '$fecha_inicial' and '$fecha_final')");
if ($rownvtc = mysql_fetch_row($rsnvtc)) {
	$numero_ventastc= trim($rownvtc[0]);
}

// TOTAL EN TARJETA DE CREDITO
$rsttc = mysql_query("select SUM(tpv.monto) as totefectivo,tv.id_venta,tv.fecha_venta from tventas tv inner join tpagos_venta tpv on tv.id_venta=tpv.id_venta inner join cusuarios cu on tv.id_usuario=cu.id_usuario inner join ccajas cc on cu.id_caja=cc.id_caja where cu.id_usuario=$id_usuario and tv.pagado_totalmente=1 and tv.tipo_operacion=1 and tpv.id_tipo_pago=2 and tv.venta_cancelada=0 and tv.merma=0 and (tv.fecha_venta between '$fecha_inicial' and '$fecha_final')");
if ($rowttc = mysql_fetch_row($rsttc)) {
	$total_tarjeta_credito= trim($rowttc[0]);
}

// NUMERO DE VENTAS EN TARJETA DE DEBITO
$rsnvtd = mysql_query("select count(tpv.id_pago_venta) as numero_ventas,tv.id_venta,tv.fecha_venta from tventas tv inner join tpagos_venta tpv on tv.id_venta=tpv.id_venta inner join cusuarios cu on tv.id_usuario=cu.id_usuario inner join ccajas cc on cu.id_caja=cc.id_caja where cu.id_usuario=$id_usuario and tv.pagado_totalmente=1 and tv.tipo_operacion=1 and tpv.id_tipo_pago=3 and tv.venta_cancelada=0 and tv.merma=0 and (tv.fecha_venta between '$fecha_inicial' and '$fecha_final')");
if ($rownvtd = mysql_fetch_row($rsnvtd)) {
	$numero_ventastd= trim($rownvtd[0]);
}

// TOTAL EN TARJETA DE DEBITO
$rsttd = mysql_query("select SUM(tpv.monto) as totefectivo,tv.id_venta,tv.fecha_venta from tventas tv inner join tpagos_venta tpv on tv.id_venta=tpv.id_venta inner join cusuarios cu on tv.id_usuario=cu.id_usuario inner join ccajas cc on cu.id_caja=cc.id_caja where cu.id_usuario=$id_usuario and tv.pagado_totalmente=1 and tv.tipo_operacion=1 and tpv.id_tipo_pago=3 and tv.venta_cancelada=0 and tv.merma=0 and (tv.fecha_venta between '$fecha_inicial' and '$fecha_final')");
if ($rowttd = mysql_fetch_row($rsttd)) {
	$total_tarjeta_debito= trim($rowttd[0]);
}

// NUMERO DE VENTAS A CREDITO
$rsnvcred = mysql_query("select COUNT(tv.id_venta) as numero_ventas,tv.id_venta,tv.fecha_venta from tventas tv inner join cusuarios cu on tv.id_usuario=cu.id_usuario inner join ccajas cc on cu.id_caja=cc.id_caja where cu.id_usuario=$id_usuario and tv.tipo_operacion=1 and tv.id_tipo_pago=4 and tv.venta_cancelada=0 and tv.merma=0 and (tv.fecha_venta between '$fecha_inicial' and '$fecha_final')");
if ($rownvcred = mysql_fetch_row($rsnvcred)) {
	$numero_ventascred= trim($rownvcred[0]);
}

// TOTAL EN VENTAS A CREDITO
$rstcred = mysql_query("select SUM(tv.total_pagar) as totefectivo,tv.id_venta,tv.fecha_venta from tventas tv inner join cusuarios cu on tv.id_usuario=cu.id_usuario inner join ccajas cc on cu.id_caja=cc.id_caja where cu.id_usuario=$id_usuario and tv.tipo_operacion=1 and tv.id_tipo_pago=4 and tv.venta_cancelada=0 and tv.merma=0 and (tv.fecha_venta between '$fecha_inicial' and '$fecha_final')");
if ($rowtcred = mysql_fetch_row($rstcred)) {
	$total_credito= trim($rowtcred[0]);
}

// NUMERO DE ABONOS A CUENTA
$rsnaac = mysql_query("select count(id_abono_ccobrar) as numero_abonos from tabonos_ccobrar where (fecha between '$fecha_inicial' and '$fecha_final') and id_usuario=$id_usuario");
if ($rownaac = mysql_fetch_row($rsnaac)) {
	$numero_abonos= trim($rownaac[0]);
}

// TOTAL MONTO DE ABONOS
$rstaac = mysql_query("select SUM(importe) as totabonoscuenta from tabonos_ccobrar where (fecha between '$fecha_inicial' and '$fecha_final') and id_usuario=$id_usuario");
if ($rowtaac = mysql_fetch_row($rstaac)) {
	$totabonoscuenta= trim($rowtaac[0]);
}

// TOTAL ABONOS EN EFECTIVO
$rstaace = mysql_query("select SUM(importe) as totabonoscuenta from tabonos_ccobrar where (fecha between '$fecha_inicial' and '$fecha_final') and id_tipo_pago=1 and id_usuario=$id_usuario");
if ($rowtaace = mysql_fetch_row($rstaace)) {
	$totabonoscuentae= trim($rowtaace[0]);
}

// TOTAL ABONOS EN TARJETA DE CREDITO
$rstaactc = mysql_query("select SUM(importe) as totabonoscuenta from tabonos_ccobrar where (fecha between '$fecha_inicial' and '$fecha_final') and id_tipo_pago=2 and id_usuario=$id_usuario");
if ($rowtaactc = mysql_fetch_row($rstaactc)) {
	$totabonoscuentatc= trim($rowtaactc[0]);
}

// TOTAL ABONOS EN TARJETA DE DEBITO
$rstaactd = mysql_query("select SUM(importe) as totabonoscuenta from tabonos_ccobrar where (fecha between '$fecha_inicial' and '$fecha_final') and id_tipo_pago=3 and id_usuario=$id_usuario");
if ($rowtaactd = mysql_fetch_row($rstaactd)) {
	$totabonoscuentatd= trim($rowtaactd[0]);
}

$efectivototal=$totaldinerocaja+$totabonoscuentae;
$tarjetacreditototal=$total_tarjeta_credito+$totabonoscuentatc;
$tarjetadebitototal=$total_tarjeta_debito+$totabonoscuentatd;
$totalenventas=$total_efectivo+$total_tarjeta_credito+$total_tarjeta_debito+$total_credito;

//$pdf->AddPage('P', 'A4');
		
			$table1.= '<table><thead border="0">
       		<tr>
				<td align="center" border="0" colspan="3">
					<b>BLUSH DISTRIBUIDOR DE</b><br>
					<b>PRODUCTOS DE BELLEZA</b><br>
					<b>'.$descripcion_sucursal.'</b><br>
					<b>CORTE DEL DIA</b><br><br>
					<b>FECHA:'.$hoy.'</b><br>
					<b>CAJA:'.$descripcion_caja.'</b><br>
					<b>USUARIO:'.$usuario_imprimir.'</b><br>
				</td>
		    </tr>
			<tr align="center" border="0">
				<td colspan="3" style="border-bottom:solid 1px color:#000000;">&nbsp;</td>
			</tr> 
			</thead>
			<tr>
				<td><b>TIPO DE PAGO</b></td><td><b>OPER</b></td><td><b>IMPORTE</b></td>
			</tr>
			<tr>
				<td>CREDITO</td><td>'.$numero_ventascred.'</td><td>$ '.$total_credito.'</td>
			</tr>';

			$Resultado4=mysql_query("select nombre_cliente,total_pagar from tventas where id_tipo_pago=4 and venta_cancelada=0 and merma=0 and id_usuario=$id_usuario and (fecha_venta between '$fecha_inicial' and '$fecha_final')");

				while($MostrarFila4=mysql_fetch_array($Resultado4))
				{
					$nombre_cliente=utf8_encode($MostrarFila4['nombre_cliente']);
					$total_pagar=utf8_encode($MostrarFila4['total_pagar']);

			$table1.='<tr>
				<td align="left" colspan="2">'.$nombre_cliente.' - '.'</td><td align="left">'.$total_pagar.'</td>
			</tr>';
				}

			$table1.='<tr>
				<td colspan="3">&nbsp;</td>
			</tr>';

			$table1.='<tr>
				<td>EFECTIVO</td><td>'.$numero_ventasefe.'</td><td>$ '.$total_efectivo.'</td>
			</tr>
			<tr>
				<td>TARJETA CREDITO</td><td>'.$numero_ventastc.'</td><td>$ '.$total_tarjeta_credito.'</td>
			</tr>
			<tr>
				<td>TARJETA DEBITO</td><td>'.$numero_ventastd.'</td><td>$ '.$total_tarjeta_debito.'</td>
			</tr>
			<tr>
				<td colspan="2"><b>TOTAL VENTAS</b></td><td><b>$ '.$totalenventas.'</b><br></td>
			</tr>
			<tr>
				<td>ABONOS A CTA</td><td>'.$numero_abonos.'</td><td>$ '.$totabonoscuenta.'</td>
			</tr>';

			$Resultado3=mysql_query("select tac.id_abono_ccobrar,tac.importe,tmp.desc_metodo_pago,tv.nombre_cliente from tabonos_ccobrar tac inner join tmetodos_pago tmp on tac.id_tipo_pago=tmp.id_metodo_pago inner join tventas tv on tac.id_venta=tv.id_venta where (tac.fecha between '$fecha_inicial' and '$fecha_final') and tac.id_usuario=$id_usuario");

				while($MostrarFila3=mysql_fetch_array($Resultado3))
				{
					$desc_metodo_pago=utf8_encode($MostrarFila3['desc_metodo_pago']);
					$nombre_cliente=utf8_encode($MostrarFila3['nombre_cliente']);
					$importe=utf8_encode($MostrarFila3['importe']);

			$table1.='<tr>
				<td align="left" colspan="2">'.$desc_metodo_pago.' - '.$nombre_cliente.'</td><td align="left">'.$importe.'</td>
			</tr>';
				}

			$table1.='<tr>
				<td colspan="3">&nbsp;</td>
			</tr>';

			$table1.='<tr>
				<td>RETIROS</td><td>'.$numero_retiros.'</td><td> - $ '.$totretiros.'</td>
			</tr>';
			
			$Resultado2=mysql_query("select motivo_retirar,monto_retirar,hora_retiro from tretiros where (fecha_retiro between '$fecha_inicial' and '$fecha_final') and id_usuario=$id_usuario");

				while($MostrarFila2=mysql_fetch_array($Resultado2))
				{
					$motivo_retirar=utf8_encode($MostrarFila2['motivo_retirar']);
					$monto_retirar=utf8_encode($MostrarFila2['monto_retirar']);
					$hora_retiro=utf8_encode($MostrarFila2['hora_retiro']);

			$table1.='<tr>
				<td align="center" colspan="2">'.$hora_retiro.' - '.$motivo_retirar.'</td><td>$ '.$monto_retirar.'</td>
			</tr>';
				}

			$table1.='<tr>
				<td colspan="3">&nbsp;</td>
			</tr>
			<tr>
				<td colspan="2">FONDO INICIAL</td><td>$ '.$fondo_inicial.'</td>
			</tr>
			<tr>
				<td colspan="3">&nbsp;</td>
			</tr>
			<tr>
				<td colspan="3"><b>TOTALES:</b></td>
			</tr>
			<tr>
				<td colspan="2"><b>EFECTIVO:</b></td><td colspan="1">$ '.$efectivototal.'</td>
			</tr>
			<tr>
				<td colspan="2"><b>TARJETA DE CREDITO:</b></td><td colspan="1">$ '.$tarjetacreditototal.'</td>
			</tr>
			<tr>
				<td colspan="2"><b>TARJETA DE DEBITO:</b></td><td colspan="1">$ '.$tarjetadebitototal.'</td>
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

	

$pdf->Output('cortecajaresumen.pdf', 'I');