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


// NUMERO DE VENTAS
$rsnv = mysql_query("select count(tv.id_venta) as numero_ventas,tv.id_venta,tv.fecha_venta,tv.id_usuario,tv.total_pagar,cc.id_caja,cc.efectivo_caja 
from tventas tv inner join cusuarios cu on tv.id_usuario=cu.id_usuario inner join ccajas cc on cu.id_caja=cc.id_caja 
where cu.id_usuario=$id_usuario and tv.pagado_totalmente=1 and tv.venta_cancelada=0 and tv.merma=0 and tv.id_tipo_pago=1 and tv.tipo_operacion=1 and (tv.fecha_venta between '$fecha_inicial' and '$fecha_final')");
if ($rownv = mysql_fetch_row($rsnv)) {
	$numero_ventas= trim($rownv[0]);
}

// TOTAL EN EFECTIVO
$rste = mysql_query("select sum(tv.total_pagar) as totefectivo,tv.id_venta,tv.fecha_venta,tv.id_usuario,tv.total_pagar,cc.id_caja,cc.efectivo_caja,tv.tipo_operacion 
from tventas tv inner join cusuarios cu on tv.id_usuario=cu.id_usuario inner join ccajas cc on cu.id_caja=cc.id_caja 
where cu.id_usuario=$id_usuario and tv.pagado_totalmente=1 and tv.venta_cancelada=0 and tv.merma=0 and tv.id_tipo_pago=1 and tv.tipo_operacion=1 and (tv.fecha_venta between '$fecha_inicial' and '$fecha_final')");
if ($rowte = mysql_fetch_row($rste)) {
	$total_efectivo= trim($rowte[0]);
	$fondo_inicial= trim($rowte[6]);
}

$efectivomascaja=$total_efectivo+$fondo_inicial;

// TOTAL EN RETIROS
$rstr = mysql_query("select sum(monto_retirar) as totretiros from tretiros where id_usuario=$id_usuario and (fecha_retiro between '$fecha_inicial' and '$fecha_final')");
if ($rowtr = mysql_fetch_row($rstr)) {
	$totretiros= trim($rowtr[0]);
}

$totaldinerocaja=$efectivomascaja-$totretiros;

// TOTAL EN TARJETA DE CREDITO
$rsttc = mysql_query("select sum(tv.total_pagar) as tottarjeta_credito,tv.id_venta,tv.fecha_venta,tv.id_usuario,tv.total_pagar,cc.id_caja,cc.efectivo_caja,tv.tipo_operacion 
from tventas tv inner join cusuarios cu on tv.id_usuario=cu.id_usuario inner join ccajas cc on cu.id_caja=cc.id_caja 
where cu.id_usuario=$id_usuario and tv.pagado_totalmente=1 and tv.venta_cancelada=0 and tv.merma=0 and tv.id_tipo_pago=2 and tv.tipo_operacion=1 and (tv.fecha_venta between '$fecha_inicial' and '$fecha_final')");
if ($rowttc = mysql_fetch_row($rsttc)) {
	$total_tarjeta_credito= trim($rowttc[0]);
}

// TOTAL EN TARJETA DE DEBITO
$rsttd = mysql_query("select sum(tv.total_pagar) as tottarjeta_debito,tv.id_venta,tv.fecha_venta,tv.id_usuario,tv.total_pagar,cc.id_caja,cc.efectivo_caja,tv.tipo_operacion 
from tventas tv inner join cusuarios cu on tv.id_usuario=cu.id_usuario inner join ccajas cc on cu.id_caja=cc.id_caja 
where cu.id_usuario=$id_usuario and tv.pagado_totalmente=1 and tv.venta_cancelada=0 and tv.merma=0 and tv.id_tipo_pago=3 and tv.tipo_operacion=1 and (tv.fecha_venta between '$fecha_inicial' and '$fecha_final')");
if ($rowttd = mysql_fetch_row($rsttd)) {
	$total_tarjeta_debito= trim($rowttd[0]);
}


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
				<td>EFECTIVO</td><td>'.$numero_ventas.'</td><td>$ '.$total_efectivo.'</td>
			</tr>
			<tr>
				<td colspan="2"><b>TOTAL VENTAS</b></td><td><b>$ '.$total_efectivo.'</b></td>
			</tr>
			<tr>
				<td colspan="2">FONDO INICIAL</td><td>$ '.$fondo_inicial.'</td>
			</tr>
			<tr>
				<td colspan="2">TOTAL EN RETIROS</td><td>$ '.$totretiros.'</td>
			</tr>
			<tr>
				<td colspan="3">&nbsp;</td>
			</tr>
			<tr>
				<td colspan="3"><b>TOTALES:</b></td>
			</tr>
			<tr>
				<td colspan="2"><b>EFECTIVO:</b></td><td colspan="1">$ '.$totaldinerocaja.'</td>
			</tr>
			<tr>
				<td colspan="2"><b>TARJETA DE CREDITO:</b></td><td colspan="1">$ '.$total_tarjeta_credito.'</td>
			</tr>
			<tr>
				<td colspan="2"><b>TARJETA DE DEBITO:</b></td><td colspan="1">$ '.$total_tarjeta_debito.'</td>
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