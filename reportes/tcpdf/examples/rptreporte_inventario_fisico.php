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
		$this->Cell(0, 10, 'Reporte ultimo inventario fisico (conteo)', 'T', false, 'C');				
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

$id_inventario=$_GET['id_inventario'];
$id_sucursal=$_GET['id_sucursal'];
$id_usuario=$_GET['id_usuario'];

$rsttd = mysql_query("select cu.nombre_usuario,cs.id_sucursal,cs.descripcion_sucursal,cc.descripcion_caja from cusuarios cu 
inner join csucursales cs on cu.id_sucursal=cs.id_sucursal inner join ccajas cc on cu.id_caja=cc.id_caja where cu.id_sucursal=$id_sucursal");
if ($rowttd = mysql_fetch_row($rsttd)) {
	$nombre_usuario= utf8_encode($rowttd[0]);
	$id_sucursal= utf8_encode($rowttd[1]);
	$descripcion_sucursal= utf8_encode($rowttd[2]);
	$descripcion_caja= utf8_encode($rowttd[3]);
}

$rsif = mysql_query("select fecha_inventario,numero_productos_inven from tinventario_fisico where id_sucursal=$id_sucursal and id_inventario_fisico=$id_inventario");
if ($rowif = mysql_fetch_row($rsif)) {
	$fecha_inventario= utf8_encode($rowif[0]);
	$numero_productos_inven= utf8_encode($rowif[1]);
}

$hoy=date("d/m/Y H:i:s"); 


//$pdf->AddPage('P', 'A4');
		
			$table1.= '<table><thead border="0">
       		<tr>
				<td align="center" border="0" colspan="4">
					<b>NOMBRE DE LA EMPRESA</b><br>
					<b>DATO 1 DE LA EMPRESA</b><br>
					<b>Reporte ultimo inventario fisico (conteo)</b><br>
					<b>FECHA:'.$hoy.'</b><br>
					<b>USUARIO:'.$nombre_usuario.'</b><br>
				</td>
		    </tr>
			<tr align="center" border="0">
				<td colspan="4" style="border-bottom:solid 1px color:#000000;">&nbsp;</td>
			</tr> 
			</thead>
			<tr>
				<td align="center" border="1">CODIGO</td><td align="center" border="1">DESCRIPCION</td><td align="center" border="1">EXISTENCIA</td><td align="center" border="1">CONTADO</td>
			</tr>';

			$Resultado2=mysql_query("select tifp.id_inventario_producto,tifp.id_inventario,tifp.cantidad_contada,tifp.cantidad_existencia,cp.codigo_barras,cp.descripcion from tinventariof_productos tifp inner join cproductos cp on tifp.id_producto=cp.id_producto where tifp.id_inventario=$id_inventario");	
				while($MostrarFila2=mysql_fetch_array($Resultado2))
				{
					$codigo_barras=utf8_encode($MostrarFila2['codigo_barras']);
					$descripcion=utf8_encode($MostrarFila2['descripcion']);
					$cantidad_contada=utf8_encode($MostrarFila2['cantidad_contada']);
					$cantidad_existencia=utf8_encode($MostrarFila2['cantidad_existencia']);
				
			  		$table1.='<tr><td align="left" border="1">'.$codigo_barras.'</td><td align="left" border="1">'.$descripcion.'</td>'.'<td align="center" border="1">'.$cantidad_existencia.'</td>'.'<td align="center" border="1">'.$cantidad_contada.'</td>';
					  $table1.= '</tr>';
				

				}

				$table1.= '<tr align="center" border="0">
				<td colspan="4">&nbsp;</td>
			</tr>';

				$table1.= '<tr align="left" border="0">
				<td colspan="4">Fecha del Inventario: '.$fecha_inventario.', numero de productos inventariados: '.$numero_productos_inven.'</td>
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

	

$pdf->Output('reporteultimoinventariofisico.pdf', 'I');