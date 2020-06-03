<?php
$bd_host = "localhost"; 
$bd_usuario = "pcinclou_pech"; 
$bd_password = "2019pech2019"; 
$bd_base = "pcinclou_puntoventa";

$con = mysql_connect($bd_host, $bd_usuario, $bd_password); 
mysql_select_db($bd_base, $con);
mysql_query("SET NAMES 'utf8'");

$ancho_celda = 1200;

$ancho_celda=$ancho_celda/10;
$ancho_papel = $ancho_celda+20;
$alto_papel = $ancho_papel*1;

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
		//$this->Cell(0, 10, '', 0, false, 'C', 0, '', 0, false, 'T', 'M');	
		$this->SetY(-20);
		// Set font
		//$this->SetFont('helvetica', 'I', 8);
		// Page number
		//$this->Cell(0, 10, '1a. CALLE NTE. OTE. No. 13 CENTRO HISTORICO, COMITAN DE DOMINGUEZ, CHIAPAS.  C.P. 30000', 0, false, 'C', 0, '', 0, false, 'T', 'M');		
		//$this->Cell(0, 10, 'Ticket', 'T', false, 'C');				
		$this->SetY(-15);
		// Set font
		//$this->SetFont('helvetica', 'I', 8);
		// Page number
		//$this->Cell(0, 10, 'TEL. (01 963) 63 2 50 67      E-MAIL: htscoly@hotmail.com', 0, false, 'C', 0, '', 0, false, 'T', 'M');		
	
	}
}

//$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$medidas = array(58, 600);
//$pdf=new MYPDF('P','mm',array($ancho_papel,$alto_papel));
$pdf=new MYPDF('P','mm',$medidas, true, 'UTF-8', false);
    $pdf->AliasNbPages();
    $pdf->AddPage();    
	$pdf->SetFont('times','',5);

   $pdf->SetMargins(2, 42, PDF_MARGIN_RIGHT);
	
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

$hoy=date("d/m/Y H:i:s"); 


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
   if($total_efectivo=="")
    {
      $total_efectivo=0.00;
    }
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
   if($totretiros=="")
    {
      $totretiros=0.00;
    }
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
   if($total_tarjeta_credito=="")
    {
      $total_tarjeta_credito=0.00;
    }
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
   if($total_tarjeta_debito=="")
    {
      $total_tarjeta_debito=0.00;
    }
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
   if($total_credito=="")
    {
      $total_credito=0.00;
    }
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
   if($totabonoscuenta=="")
    {
      $totabonoscuenta=0.00;
    }
}

// TOTAL ABONOS EN EFECTIVO
$rstaace = mysql_query("select SUM(importe) as totabonoscuenta from tabonos_ccobrar where (fecha between '$fecha_inicial' and '$fecha_final') and id_tipo_pago=1 and id_usuario=$id_usuario");
if ($rowtaace = mysql_fetch_row($rstaace)) {
   $totabonoscuentae= trim($rowtaace[0]);
   if($totabonoscuentae=="")
    {
      $totabonoscuentae=0.00;
    }
}

// TOTAL ABONOS EN TARJETA DE CREDITO
$rstaactc = mysql_query("select SUM(importe) as totabonoscuenta from tabonos_ccobrar where (fecha between '$fecha_inicial' and '$fecha_final') and id_tipo_pago=2 and id_usuario=$id_usuario");
if ($rowtaactc = mysql_fetch_row($rstaactc)) {
   $totabonoscuentatc= trim($rowtaactc[0]);
   if($totabonoscuentatc=="")
    {
      $totabonoscuentatc=0.00;
    }
}

// TOTAL ABONOS EN TARJETA DE DEBITO
$rstaactd = mysql_query("select SUM(importe) as totabonoscuenta from tabonos_ccobrar where (fecha between '$fecha_inicial' and '$fecha_final') and id_tipo_pago=3 and id_usuario=$id_usuario");
if ($rowtaactd = mysql_fetch_row($rstaactd)) {
   $totabonoscuentatd= trim($rowtaactd[0]);
   if($totabonoscuentatd=="")
    {
      $totabonoscuentatd=0.00;
    }
}

$efectivototal=$totaldinerocaja+$totabonoscuentae;
$tarjetacreditototal=$total_tarjeta_credito+$totabonoscuentatc;
$tarjetadebitototal=$total_tarjeta_debito+$totabonoscuentatd;
$totalenventas=$total_efectivo+$total_tarjeta_credito+$total_tarjeta_debito+$total_credito;

//$pdf->AddPage('P', 'A4');

		
			$table1.= '<table align="left" border="0">
       		<tr>
				<td align="center" border="0">&nbsp;
				</td>
          </tr>';
         
         $table1.= '</table>';

			         $table5.= '<table border="0">';
         $table5.= '
         <tr>
            <td align="center" border="0" colspan="4"><b>NOMBRE DE LA EMPRESA</b></td>
         </tr>
         <tr>
            <td align="center" border="0" colspan="4"><b>'.$descripcion_sucursal.'</b></td>
         </tr>
         <tr>
            <td align="center" border="0" colspan="4"><b>CORTE DEL DIA</b></td>
          </tr>
          <tr>
            <td align="left" border="0" colspan="4"><b>FECHA: '.$hoy.'</b></td>
          </tr>
          <tr>
            <td align="left" border="0" colspan="4"><b>CAJA:'.$descripcion_caja.'</b></td>
          </tr>
          <tr>
            <td align="left" border="0" colspan="4"><b>USUARIO:'.$usuario_imprimir.'</b></td>
          </tr>
          
         <tr>
         <td align="left" colspan="2"><b>PAGO</b></td>
          <td align="left" colspan="1"><b>OPER</b></td>
          <td align="left" colspan="1"><b>IMPORTE</b></td></tr>';   
         

         $table5.= '<tr>
            <td colspan="2">CREDITO</td><td colspan="1" align="center">'.$numero_ventascred.'</td><td align="right" colspan="1">$ '.$total_credito.'</td>
         </tr>';

         $Resultado4=mysql_query("select nombre_cliente,total_pagar from tventas where id_tipo_pago=4 and venta_cancelada=0 and merma=0 and id_usuario=$id_usuario and (fecha_venta between '$fecha_inicial' and '$fecha_final')");

            while($MostrarFila4=mysql_fetch_array($Resultado4))
            {
               $nombre_cliente=utf8_encode($MostrarFila4['nombre_cliente']);
               $total_pagar=utf8_encode($MostrarFila4['total_pagar']);

         $table5.='<tr>
            <td align="left" colspan="2">'.$nombre_cliente.' - '.'</td><td align="right" colspan="2">'.$total_pagar.'</td>
         </tr>';
            }

         $table5.='<tr>
            <td colspan="3">&nbsp;</td>
         </tr>';

         $table5.='<tr>
            <td colspan="2">EFECTIVO</td><td colspan="1" align="center">'.$numero_ventasefe.'</td><td colspan="1" align="right">$ '.$total_efectivo.'</td>
         </tr>
         <tr>
            <td colspan="2">TARJETA CREDITO</td><td align="center" colspan="1">'.$numero_ventastc.'</td><td align="right" colspan="1">$ '.$total_tarjeta_credito.'</td>
         </tr>
         <tr>
            <td colspan="2">TARJETA DEBITO</td><td align="center" colspan="1">'.$numero_ventastd.'</td><td align="right" colspan="1">$ '.$total_tarjeta_debito.'</td>
         </tr>
         <tr>
            <td colspan="2"><b>TOTAL VENTAS</b></td><td align="right" colspan="2"><b>$ '.$totalenventas.'</b><br></td>
         </tr>';

         $table5.='<tr>
            <td colspan="3">&nbsp;</td>
         </tr>';

         $table5.='<tr>
            <td colspan="3">&nbsp;</td>
         </tr>
         <tr>
            <td colspan="2" align="left">FONDO INICIAL</td><td colspan="2" align="right">$ '.$fondo_inicial.'</td>
         </tr>
         <tr>
            <td colspan="3">&nbsp;</td>
         </tr>
         <tr>
            <td colspan="3"><b>TOTALES:</b></td>
         </tr>
         <tr>
            <td colspan="2" align="left"><b>EFECTIVO:</b></td><td colspan="2" align="right">$ '.$efectivototal.'</td>
         </tr>
         <tr>
            <td colspan="2" align="left"><b>TARJETA DE CREDITO:</b></td><td colspan="2" align="right">$ '.$tarjetacreditototal.'</td>
         </tr>
         <tr>
            <td colspan="2" align="left"><b>TARJETA DE DEBITO:</b></td><td colspan="2" align="rig">$ '.$tarjetadebitototal.'</td>
         </tr>';

         $table5.= '</table>';   
         
         
            
$pdf->SetFont('helvetica', '', 5);
$pdf->writeHTML($table1, true, false, false, false, '');
//$pdf->Ln(3);
//$pdf->SetMargins(0, 0, 0);
$pdf->writeHTML($table5, true, false, false, false, '');
$table1="";
$table5="";

   

$pdf->Output('reportecortecaja.pdf', 'I');