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
		$this->Cell(0, 10, 'Reporte de articulos', 'T', false, 'C');				
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

$agruparpor=$_GET['agruparpor'];
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


$hoy=date("d/m/Y H:i:s"); 


//$pdf->AddPage('P', 'A4');
		
			$table1.= '<table><thead border="0">
       		<tr>
				<td align="center" border="0" colspan="4">
					<b>BLUSH DISTRIBUIDOR DE</b><br>
					<b>PRODUCTOS DE BELLEZA</b><br>
					<b>'.$descripcion_sucursal.'</b><br>
					<b>Reporte de articulos</b><br>
					<b>FECHA:'.$hoy.'</b><br>
					<b>USUARIO:'.$nombre_usuario.'</b><br>
					<b>CAJA:'.$descripcion_caja.'</b><br>
				</td>
		    </tr>
			<tr align="center" border="0">
				<td colspan="4" style="border-bottom:solid 1px color:#000000;">&nbsp;</td>
			</tr> 
			</thead>
			<tr>
				<td align="left">CODIGO</td><td align="left">DESCRIPCION</td><td align="left">EXISTENCIA</td><td align="left">PRECIO COMPRA</td>
			</tr>
			<tr align="center" border="0">
				<td colspan="4" style="border-bottom:solid 1px color:#000000;">&nbsp;</td>
			</tr>';

			$totalproductos=0;

				if($agruparpor==1)
					{	
						$Resultado2=mysql_query("select codigo_barras,descripcion,cantidad_existencia,precio_compra from cproductos where id_sucursal=$id_sucursal order by id_proveedor");
					}
				else
					{
						$Resultado2=mysql_query("select codigo_barras,descripcion,cantidad_existencia,precio_compra from cproductos where id_sucursal=$id_sucursal order by id_departamento");
					}

				while($MostrarFila2=mysql_fetch_array($Resultado2))
				{
					$codigo_barras=utf8_encode($MostrarFila2['codigo_barras']);
					$descripcion=utf8_encode($MostrarFila2['descripcion']);
					$cantidad_existencia=utf8_encode($MostrarFila2['cantidad_existencia']);
					$precio_compra=utf8_encode($MostrarFila2['precio_compra']);

					$totalproductos=$totalproductos+1;
				
			  		$table1.='<tr><td align="left">'.$codigo_barras.'</td><td align="left">'.$descripcion.'</td>'.'<td align="center">'.$cantidad_existencia.'</td>'.'<td align="center">'.$precio_compra.'</td>';
					  $table1.= '</tr>';
				

				}

				$table1.= '<tr align="center" border="0">
				<td colspan="4">&nbsp;</td>
			</tr>';

				$table1.= '<tr align="left" border="0">
				<td colspan="4">Total de productos: '.$totalproductos.'</td>
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

	

$pdf->Output('reportedearticulos.pdf', 'I');