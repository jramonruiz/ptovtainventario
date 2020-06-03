<?php
$bd_host = "localhost"; 
$bd_usuario = "root"; 
$bd_password = ""; 
$bd_base = "puntoventa";

$con = mysql_connect($bd_host, $bd_usuario, $bd_password); 
mysql_select_db($bd_base, $con);
mysql_query("SET NAMES 'utf8'");

/* DIMENSIONES PECH 

$ancho_celda = 1200;

$ancho_celda=$ancho_celda/10;
$ancho_papel = $ancho_celda+20;
$alto_papel = $ancho_papel*3;

$pos_x = $ancho_papel/3.6;
$tamaño = $ancho_papel/23;

*/


/* DIMENSIONES BLUSH

$ancho_celda = 1200;

$ancho_celda=$ancho_celda/10;
$ancho_papel = $ancho_celda+50;
$alto_papel = $ancho_papel*1;

$pos_x = $ancho_papel/3.6;
$tamaño = $ancho_papel/2.3;

*/

//// USANDO DIMENSIONES DE PECH

$ancho_celda = 1200;

$ancho_celda=$ancho_celda/10;
$ancho_papel = $ancho_celda+20;
$alto_papel = $ancho_papel*3;

$pos_x = $ancho_papel/3.6;
$tamaño = $ancho_papel/23;



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
		$this->Cell(0, 10, 'Ticket', 'T', false, 'C');				
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

$id_venta=$_GET['id_venta'];
$folioidventa=$_GET['folioidventa'];
$idultimaventa=$_GET['idultimaventa'];

$rsttd = mysql_query("select tv.id_venta,cu.nombre_usuario,cs.descripcion_sucursal,cc.descripcion_caja,tv.total_venta,tv.nombre_cliente,tv.tipo_operacion,tv.referencia,tv.descuento,tv.total_pagar from tventas tv inner join cusuarios cu on tv.id_usuario=cu.id_usuario inner join csucursales cs on cu.id_sucursal=cs.id_sucursal inner join ccajas cc on cu.id_caja=cc.id_caja where tv.id_venta=$idultimaventa");
if ($rowttd = mysql_fetch_row($rsttd)) {
	$id_venta= utf8_encode($rowttd[0]);
	$nombre_usuario= utf8_encode($rowttd[1]);
	$descripcion_sucursal= utf8_encode($rowttd[2]);
	$descripcion_caja= utf8_encode($rowttd[3]);
	$total_venta= utf8_encode($rowttd[4]);
	$tipo_operacion= utf8_encode($rowttd[6]);
	$referencia= utf8_encode($rowttd[7]);
	$descuento= utf8_encode($rowttd[8]);
	$total_pagar= utf8_encode($rowttd[9]);
}

if($tipo_operacion==1)
{
	$operaciontipo="TICKET";
}
else if($tipo_operacion==2)
{
	$operaciontipo="AJUSTE DE SALIDA";
}

$hoy=date("d/m/Y H:i:s"); 


//$pdf->AddPage('P', 'A4');
		
			$table1.= '<table><thead border="0">
       		<tr>
				<td align="center" border="0" colspan="4">
					<b>BLUSH DISTRIBUIDOR DE</b><br>
					<b>PRODUCTOS DE BELLEZA</b><br>
					<b>'.$descripcion_sucursal.'</b><br>
					<b>'.$operaciontipo.'</b><br><br>
					<b>FECHA:'.$hoy.'</b><br>
					<b>USUARIO:'.$nombre_usuario.'</b><br>
					<b>CAJA:'.$descripcion_caja.'</b><br>
					<b>FOLIO:'.$folioidventa.'</b><br>
				</td>
		    </tr>
			<tr align="center" border="0">
				<td colspan="4" style="border-bottom:solid 1px color:#000000;">&nbsp;</td>
			</tr> 
			</thead>
			<tr>
				<td>CANT</td><td>CONCEPTO</td><td>PRECIO</td><td>IMPORTE</td>
			</tr>';

			$Resultado2=mysql_query("select * from tproductos_venta where id_venta=$idultimaventa");	
				while($MostrarFila2=mysql_fetch_array($Resultado2))
				{
				$table1.= '<tr><td align="left">'.$MostrarFila2['cantidad'].'</td>';
	    		$table1.='<td align="left">'.utf8_encode($MostrarFila2['descripcion_producto']).'</td>';
				$table1.= '<td align="left">'.$MostrarFila2['precio_venta'].'</td>';
				$table1.= '<td align="left">'.$MostrarFila2['subtotal'].'</td>';		
				$table1.= '</tr>';			
				}

			$table1.= '<tr align="center" border="0">
				<td colspan="4" style="border-bottom:solid 1px color:#000000;">&nbsp;</td>
			</tr>';
			$table1.= '<tr align="center" border="0">
				<td colspan="4">&nbsp;</td>
			</tr>';

			$table1.= '<tr align="left" border="0">
				<td colspan="4">Total de la venta: $ '.$total_venta.'</td>
			</tr>'; 

			$table1.= '<tr align="left" border="0">
				<td colspan="4">Descuento: $ '.$descuento.'</td>
			</tr>'; 

			$table1.= '<tr align="left" border="0">
				<td colspan="4">Total a pagar: $ '.$total_pagar.'<br><br></td>
			</tr>'; 


			$Resultado2pagosventa=mysql_query("select tpv.id_pago_venta,tmp.desc_metodo_pago,tpv.monto,tpv.referencia from tpagos_venta tpv inner join tmetodos_pago tmp on tpv.id_tipo_pago=tmp.id_metodo_pago where tpv.id_venta=$idultimaventa");	
				while($MostrarFila2pagosventa=mysql_fetch_array($Resultado2pagosventa))
				{
				$table1.= '<tr><td align="left">'.$MostrarFila2pagosventa['desc_metodo_pago'].':</td>';
	    		$table1.='<td align="left"> $ '.utf8_encode($MostrarFila2pagosventa['monto']).'</td>';
				$table1.= '<td align="left">'.$MostrarFila2pagosventa['referencia'].'</td>';
				$table1.= '</tr>';			
				}

			
			$table1.= '</table>';	
			
$pdf->SetFont('times', '', 8);
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

// force print dialog
$js = 'print(true);';

// set javascript
$pdf->IncludeJS($js);

// ---------------------------------------------------------

	

$pdf->Output('ticketventa.pdf', 'I');