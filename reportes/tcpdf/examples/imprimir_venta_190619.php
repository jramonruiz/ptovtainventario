<?php
$bd_host = "localhost"; 
$bd_usuario = "root"; 
$bd_password = ""; 
$bd_base = "puntoventa";

$fecha = date(d)."/".date(m)."/".date(Y);
$hora = date(H).":".date(i).":".date(s);

$con = mysql_connect($bd_host, $bd_usuario, $bd_password); 
mysql_select_db($bd_base, $con);
mysql_query("SET NAMES 'utf8'");

$ancho_celda = 1200;

$ancho_celda=$ancho_celda/10; ///120
$ancho_papel = $ancho_celda+20;  ///140
$alto_papel = $ancho_papel*3;    ///420
//$alto_papel = 100;

$pos_x = $ancho_papel/3.6;    /// 38.88
$tamanio = $ancho_papel/23;   /// 6.08



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

	
	/*public function Footer() {
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
		$this->Cell(0, 10, 'Pagina '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 'T', false, 'R');				
		$this->SetY(-15);
		// Set font
		//$this->SetFont('helvetica', 'I', 8);
		// Page number
		//$this->Cell(0, 10, 'TEL. (01 963) 63 2 50 67      E-MAIL: htscoly@hotmail.com', 0, false, 'C', 0, '', 0, false, 'T', 'M');		
	
	}*/
	
	
		/*public function Footer() {
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
		$this->Cell(0, 10, 'Ticket ', 'T', false, 'C');				
		$this->SetY(-15);
		// Set font
		//$this->SetFont('helvetica', 'I', 8);
		// Page number
		//$this->Cell(0, 10, 'TEL. (01 963) 63 2 50 67      E-MAIL: htscoly@hotmail.com', 0, false, 'C', 0, '', 0, false, 'T', 'M');		
	
	}*/

}

//$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$pdf=new MYPDF('P','mm',array(58,$alto_papel));
    $pdf->AliasNbPages();
    $pdf->AddPage();    
	$pdf->SetFont('times','',4);
	
	$pdf->Image('../images/logo_pech.jpg',$pos_x,10,$tamanio);
	$pdf->setY($tamanio);  
	



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

/*$pdf->setLanguageArray($l);
$pdf->SetFont('times', 'B', 10);
$pdf->AddPage('P', 'A4');*/

$id_venta=$_GET['id_venta'];
$folioidventa=$_GET['folioidventa'];
$idultimaventa=$_GET['idultimaventa'];

$rsttd = mysql_query("select tv.id_venta,cu.nombre_usuario,cs.descripcion_sucursal,cc.descripcion_caja,tv.total_venta,tv.nombre_cliente,tv.tipo_operacion,tv.referencia,tv.descuento,tv.total_pagar,cs.calle,cs.numero_exterior,cs.colonia,cs.municipio,cs.estado,cs.telefono,tv.pago_venta,tv.cambio_venta from tventas tv inner join cusuarios cu on tv.id_usuario=cu.id_usuario inner join csucursales cs on cu.id_sucursal=cs.id_sucursal inner join ccajas cc on cu.id_caja=cc.id_caja where tv.id_venta=$idultimaventa");
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
	$calle= utf8_encode($rowttd[10]);
	$numero_exterior= utf8_encode($rowttd[11]);
	$colonia= utf8_encode($rowttd[12]);
	$municipio= utf8_encode($rowttd[13]);
	$estado= utf8_encode($rowttd[14]);
	$telefono= utf8_encode($rowttd[15]);	
	$pago_venta= utf8_encode($rowttd[16]);
	$cambio_venta= utf8_encode($rowttd[17]);
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
					<img src="../images/logo_pech.jpg"><br>
					<b>BLUSH DISTRIBUIDOR DE</b><br>
					<b>PRODUCTOS DE BELLEZA</b><br>
					<b>R.F.C.</b><br>
					<b>'.$calle.' '.$numero_exterior.'<br>'.$colonia.' '.$municipio.'<br>'.$estado.'<br>TELS '.$telefono.'('.$descripcion_sucursal.')</b><br><br>
					<b>FECHA:'.$hoy.'</b><br>
					<b>USUARIO:'.$nombre_usuario.'</b><br>
					<b>FOLIO:'.$folioidventa.'</b>
				</td>
		    </tr>
			</thead></tr>';
			
			$table1.= '</table>';	
			
			
			$table5.= '<table>';
			$table5.= '<tr align="center" border="0">
			<td align="left" border="0"><b>CANT</b></td>
		    <td align="left" border="0"><b>CONCEPTO</b></td>
		    <td align="left" border="0"><b>PRECIO</b></td>
			<td align="left" border="0"><b>IMPORTE</b></td></tr>';	
			
			$Resultado2=mysql_query("select * from tproductos_venta where id_venta=$idultimaventa");	
				while($MostrarFila2=mysql_fetch_array($Resultado2))
				{
				$table5.= '<tr><td align="left" colspan="4">'.utf8_encode($MostrarFila2['descripcion_producto']).'</td></tr>';
	    		$table5.='<tr><td align="left" colspan="2">'.$MostrarFila2['cantidad'].'</td>';
				$table5.= '<td align="left">'.$MostrarFila2['precio_venta'].'</td>';
				$table5.= '<td align="left">'.$MostrarFila2['subtotal'].'</td>';		
				$table5.= '</tr>';			
				}		

			$table5.= '<tr align="center" border="0">
				<td colspan="4">&nbsp;</td>
			</tr>';

			$table5.= '<tr border="0">
				<td colspan="3" align="right">TOTAL</td><td colspan="1"  align="center"> $ '.$total_venta.'</td>
			</tr>';

			$Resultado2pagosventa=mysql_query("select tpv.id_pago_venta,tmp.desc_metodo_pago,tpv.monto,tpv.referencia from tpagos_venta tpv inner join tmetodos_pago tmp on tpv.id_tipo_pago=tmp.id_metodo_pago where tpv.id_venta=$idultimaventa");	
				while($MostrarFila2pagosventa=mysql_fetch_array($Resultado2pagosventa))
				{
				$table5.= '<tr><td align="right" colspan="2">'.$MostrarFila2pagosventa['referencia'].'</td>';
	    		$table5.='<td align="right" colspan="1">'.$MostrarFila2pagosventa['desc_metodo_pago'].'</td>';
				$table5.= '<td align="center" colspan="1"> $ '.utf8_encode($MostrarFila2pagosventa['monto']).'</td>';
				$table5.= '</tr>';			
				} 

				$table5.= '<tr border="0">
				<td colspan="3" align="right">&nbsp;</td>
			</tr>';

				$table5.= '<tr border="0">
				<td colspan="3" align="right">TOTAL PAGADO</td><td colspan="1"  align="center"> $ '.$pago_venta.'</td>
			</tr>';

			$table5.= '<tr border="0">
				<td colspan="3" align="right">CAMBIO</td><td colspan="1"  align="center"> $ '.$cambio_venta.'</td>
			</tr>';

				//$total_venta=1002.50;

				//num2letras($num);

				function num2letras($num, $fem = false, $dec = true) { 
   $matuni[2]  = "dos"; 
   $matuni[3]  = "tres"; 
   $matuni[4]  = "cuatro"; 
   $matuni[5]  = "cinco"; 
   $matuni[6]  = "seis"; 
   $matuni[7]  = "siete"; 
   $matuni[8]  = "ocho"; 
   $matuni[9]  = "nueve"; 
   $matuni[10] = "diez"; 
   $matuni[11] = "once"; 
   $matuni[12] = "doce"; 
   $matuni[13] = "trece"; 
   $matuni[14] = "catorce"; 
   $matuni[15] = "quince"; 
   $matuni[16] = "dieciseis"; 
   $matuni[17] = "diecisiete"; 
   $matuni[18] = "dieciocho"; 
   $matuni[19] = "diecinueve"; 
   $matuni[20] = "veinte"; 
   $matunisub[2] = "dos"; 
   $matunisub[3] = "tres"; 
   $matunisub[4] = "cuatro"; 
   $matunisub[5] = "quin"; 
   $matunisub[6] = "seis"; 
   $matunisub[7] = "sete"; 
   $matunisub[8] = "ocho"; 
   $matunisub[9] = "nove"; 
 
   $matdec[2] = "veint"; 
   $matdec[3] = "treinta"; 
   $matdec[4] = "cuarenta"; 
   $matdec[5] = "cincuenta"; 
   $matdec[6] = "sesenta"; 
   $matdec[7] = "setenta"; 
   $matdec[8] = "ochenta"; 
   $matdec[9] = "noventa"; 
   $matsub[3]  = 'mill'; 
   $matsub[5]  = 'bill'; 
   $matsub[7]  = 'mill'; 
   $matsub[9]  = 'trill'; 
   $matsub[11] = 'mill'; 
   $matsub[13] = 'bill'; 
   $matsub[15] = 'mill'; 
   $matmil[4]  = 'millones'; 
   $matmil[6]  = 'billones'; 
   $matmil[7]  = 'de billones'; 
   $matmil[8]  = 'millones de billones'; 
   $matmil[10] = 'trillones'; 
   $matmil[11] = 'de trillones'; 
   $matmil[12] = 'millones de trillones'; 
   $matmil[13] = 'de trillones'; 
   $matmil[14] = 'billones de trillones'; 
   $matmil[15] = 'de billones de trillones'; 
   $matmil[16] = 'millones de billones de trillones'; 
   
   //Zi hack
   $float=explode('.',$num);
   $num=$float[0];
 
   $num = trim((string)@$num); 
   if ($num[0] == '-') { 
      $neg = 'menos '; 
      $num = substr($num, 1); 
   }else 
      $neg = ''; 
   while ($num[0] == '0') $num = substr($num, 1); 
   if ($num[0] < '1' or $num[0] > 9) $num = '0' . $num; 
   $zeros = true; 
   $punt = false; 
   $ent = ''; 
   $fra = ''; 
   for ($c = 0; $c < strlen($num); $c++) { 
      $n = $num[$c]; 
      if (! (strpos(".,'''", $n) === false)) { 
         if ($punt) break; 
         else{ 
            $punt = true; 
            continue; 
         } 
 
      }elseif (! (strpos('0123456789', $n) === false)) { 
         if ($punt) { 
            if ($n != '0') $zeros = false; 
            $fra .= $n; 
         }else 
 
            $ent .= $n; 
      }else 
 
         break; 
 
   } 
   $ent = '     ' . $ent; 
   if ($dec and $fra and ! $zeros) { 
      $fin = ' coma'; 
      for ($n = 0; $n < strlen($fra); $n++) { 
         if (($s = $fra[$n]) == '0') 
            $fin .= ' cero'; 
         elseif ($s == '1') 
            $fin .= $fem ? ' una' : ' un'; 
         else 
            $fin .= ' ' . $matuni[$s]; 
      } 
   }else 
      $fin = ''; 
   if ((int)$ent === 0) return 'Cero ' . $fin; 
   $tex = ''; 
   $sub = 0; 
   $mils = 0; 
   $neutro = false; 
   while ( ($num = substr($ent, -3)) != '   ') { 
      $ent = substr($ent, 0, -3); 
      if (++$sub < 3 and $fem) { 
         $matuni[1] = 'una'; 
         $subcent = 'as'; 
      }else{ 
         $matuni[1] = $neutro ? 'un' : 'uno'; 
         $subcent = 'os'; 
      } 
      $t = ''; 
      $n2 = substr($num, 1); 
      if ($n2 == '00') { 
      }elseif ($n2 < 21) 
         $t = ' ' . $matuni[(int)$n2]; 
      elseif ($n2 < 30) { 
         $n3 = $num[2]; 
         if ($n3 != 0) $t = 'i' . $matuni[$n3]; 
         $n2 = $num[1]; 
         $t = ' ' . $matdec[$n2] . $t; 
      }else{ 
         $n3 = $num[2]; 
         if ($n3 != 0) $t = ' y ' . $matuni[$n3]; 
         $n2 = $num[1]; 
         $t = ' ' . $matdec[$n2] . $t; 
      } 
      $n = $num[0]; 
      if ($n == 1) { 
         $t = ' ciento' . $t; 
      }elseif ($n == 5){ 
         $t = ' ' . $matunisub[$n] . 'ient' . $subcent . $t; 
      }elseif ($n != 0){ 
         $t = ' ' . $matunisub[$n] . 'cient' . $subcent . $t; 
      } 
      if ($sub == 1) { 
      }elseif (! isset($matsub[$sub])) { 
         if ($num == 1) { 
            $t = ' mil'; 
         }elseif ($num > 1){ 
            $t .= ' mil'; 
         } 
      }elseif ($num == 1) { 
         $t .= ' ' . $matsub[$sub] . '?n'; 
      }elseif ($num > 1){ 
         $t .= ' ' . $matsub[$sub] . 'ones'; 
      }   
      if ($num == '000') $mils ++; 
      elseif ($mils != 0) { 
         if (isset($matmil[$sub])) $t .= ' ' . $matmil[$sub]; 
         $mils = 0; 
      } 
      $neutro = true; 
      $tex = $t . $tex; 
   } 
   $tex = $neg . substr($tex, 1) . $fin; 
   //Zi hack --> return ucfirst($tex);
   $end_num=ucfirst($tex).' pesos '.$float[1].'/100 M.N.';
   return $end_num; 
} 

				$table5.= '<tr border="0">
				<td colspan="4" align="left">('.num2letras($total_venta).')</td>
			</tr>';

				$table5.= '<tr border="0">
				<td colspan="4" align="left">Le atendio: '.$nombre_usuario.'</td>
			</tr>';
			

				$table5.= '</table>';	
			
			
				
$pdf->SetFont('times', '', 4);
$pdf->Ln(6);
$pdf->writeHTML($table1, true, false, false, false, '');
$pdf->Ln(3);
$pdf->writeHTML($table5, true, false, false, false, '');
$table1="";
$table5="";

	

$pdf->Output('ticketventa.pdf', 'I');