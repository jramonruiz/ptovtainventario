<?php
header("Content-type: text/xml");
  
$host = "localhost"; 
$user = "root"; 
$pass = ""; 
$database = "puntoventa";

$id_venta=$_GET['txtidventa'];

$enlace = mysql_connect($host, $user, $pass) or die("Error MySQL."); 
mysql_select_db($database, $enlace) or die("Error base de datos.");
  
/*$query = "SELECT * FROM municipios ORDER BY id_municipio ASC"; 
$resultado = mysql_query($query, $enlace) or die("Sin resultados.");*/

$rs = mysql_query("SELECT * FROM tventas where id_venta=$id_venta");
if ($row = mysql_fetch_row($rs)) {
$id_venta = trim($row[0]);
$fecha_venta = trim($row[1]);
$total_venta = trim($row[2]);
$pago_venta = trim($row[3]);
$cambio_venta = trim($row[4]);
$id_usuario = trim($row[5]);
$descuento = trim($row[6]);
$total_pagar = trim($row[7]);
$folio_venta = trim($row[8]);
$vales_devolucion = trim($row[9]);
$id_cliente = trim($row[10]);
$nombre_cliente = trim($row[11]);
$id_tipo_pago = trim($row[12]);
$estatus = trim($row[13]);
$comision_banco = trim($row[14]);
$iva = trim($row[15]);
}

/************************************** OBTENIENDO DATOS DEL RECEPTOR (CLIENTE )****************/
$cadena_receptor="";
$rs2 = mysql_query("SELECT * FROM cclientes where nombre_cliente='$nombre_cliente'");
if ($row2 = mysql_fetch_row($rs2)) {
$id_cliente = trim($row2[0]);
$nombre_cliente_imprimir = trim($row2[1]);
$direccion_cliente = trim($row2[2]);
$rfc_cliente = trim($row2[3]);
$telefono_cliente = trim($row2[4]);
$email_cliente = trim($row2[5]);
$numero_exterior_cliente = trim($row2[6]);
$numero_interior_cliente = trim($row2[7]);
$colonia_cliente = trim($row2[8]);
$localidad_cliente = trim($row2[9]);
$municipio_cliente = trim($row2[10]);
$estado_cliente = trim($row2[11]);
$pais_cliente = trim($row2[12]);
$codigo_postal_cliente = trim($row2[13]);
}

		/*********************** FORMANDO CADENA RECEPTOR ********************/
		//$cadena_receptor=$rfc_cliente."|".$nombre_cliente_imprimir."|".$direccion_cliente."|".$numero_exterior."|".$colonia_cliente."|".$localidad_cliente."|".$municipio_cliente."|".$estado_cliente."|".$pais_cliente."|".$codigo_postal_cliente;	
		
		$cadena_receptor=$rfc_cliente."|".$nombre_cliente_imprimir."|".$direccion_cliente."|".$numero_exterior_cliente."|";	

		if($numero_interior_cliente!="" or $numero_interior_cliente!=NULL)
			{
			$cadena_receptor=$cadena_receptor.$numero_interior_cliente."|";	
			}					
			
		$cadena_receptor=$cadena_receptor.$colonia_cliente."|";	
		
		if($localidad_cliente!="" or $localidad_cliente!=NULL)
			{
			$cadena_receptor=$cadena_receptor.$localidad_cliente."|";	
			}					
			
		$cadena_receptor=$cadena_receptor.$municipio_cliente."|".$estado_cliente."|".$pais_cliente."|".$codigo_postal_cliente;	
		
								
						
		/********************************************************************/

/****************************************************************************************************************************/



/************************************** OBTENIENDO DATOS DE LA EMPRESA (EMISOR) ********************************************/
$cadena_emisor="";
$rs3 = mysql_query("SELECT * FROM cempresas where id_empresa=1");
if ($row3 = mysql_fetch_row($rs3)) {
$id_empresa = trim($row3[0]);
$rfc_empresa = trim($row3[1]);
$nombre_empresa = trim($row3[2]);
$domicilio_empresa = trim($row3[3]);
$numero_exterior_empresa = trim($row3[4]);
$numero_interior_empresa = trim($row3[5]);
$colonia_empresa = trim($row3[6]);
$ciudad_empresa = trim($row3[7]);
$estado_empresa = trim($row3[8]);
$pais_empresa = trim($row3[9]);
$codigo_postal_empresa = trim($row3[10]);
$regimen_empresa = trim($row3[11]);
$certificado = trim($row3[12]);
$num_certificado = trim($row3[13]);
$clave_key = trim($row3[14]);
$archivo_cer = trim($row3[15]);
$archivo_key = trim($row3[16]);
}


		/*********************** FORMANDO CADENA EMISOR ********************/
		$cadena_emisor=$rfc_empresa."|".$nombre_empresa."|".$domicilio_empresa."|".$numero_exterior_empresa."|".$colonia_empresa."|".$ciudad_empresa."|".$estado_empresa."|".$pais_empresa."|".$codigo_postal_empresa."|".$regimen_empresa;						
								
						
		/********************************************************************/
		

/*********************** FORMANDO CADENA INICIAL PARA SELLO ********************/
  $fecha=date(d).date(m).date(Y);  
  $fecha_factura=date(Y)."-".date(m)."-".date(d);  
  $hora_factura=date(H).":".date(i).":".date(s);
  $fecha_hora_factura=$fecha_factura."T".$hora_factura;

$cadena_inicial="";

$lugar_expedicion=$domicilio_empresa." ".$numero_exterior_empresa." , ".$colonia_empresa.", ".$codigo_postal_empresa.", ".$ciudad_empresa.", ".$estado_empresa.", ".$pais_empresa;

//$cadena_inicial="||3.2|".$fecha_hora_factura."|ingreso|PAGO EN UNA SOLA EXHIBICION|CONTADO|".$total_venta."|1.00|Peso Mexicano|".$total_pagar."|CHEQUE|".$lugar_expedicion."|NO IDENTIFICADO|";						
$cadena_inicial="||3.2|2015-08-31T12:10:06|ingreso|PAGO EN UNA SOLA EXHIBICION|CONTADO|".$total_venta."|1.00|Peso Mexicano|".$total_pagar."|CHEQUE|".$lugar_expedicion."|NO IDENTIFICADO|";						
								
						
/********************************************************************/

/********************** FORMANDO CADENA DE PRODUCTOS *******************************************************/

$cadena_productos="";

$listado2p=  mysql_query("select * from tproductos_venta where id_venta=$id_venta");

while($reg2p=  mysql_fetch_array($listado2p))
{
$id_producto_venta=mb_convert_encoding($reg2p['id_producto_venta'], "UTF-8");
$id_venta=mb_convert_encoding($reg2p['id_venta'], "UTF-8");
$descripcion_producto=mb_convert_encoding($reg2p['descripcion_producto'], "UTF-8");
$cantidad=mb_convert_encoding($reg2p['cantidad'], "UTF-8");
$precio_venta=mb_convert_encoding($reg2p['precio_venta'], "UTF-8");
$subtotal=mb_convert_encoding($reg2p['subtotal'], "UTF-8");
$id_usuario=mb_convert_encoding($reg2p['id_usuario'], "UTF-8");
$id_producto=mb_convert_encoding($reg2p['id_producto'], "UTF-8");
$vales_devolucion=mb_convert_encoding($reg2p['vales_devolucion'], "UTF-8");
$fecha_devolucion=mb_convert_encoding($reg2p['fecha_devolucion'], "UTF-8");

//$cadena_productos=$cadena_productos."|".$cantidad."|"."PIEZA"."|".$descripcion_producto."|".$precio_venta."|".$subtotal;
$cadena_productos=$cadena_productos."|1.00|"."PIEZA"."|TONERCANON119|".$descripcion_producto."|".$precio_venta."|".$subtotal;
}

$cadena_productos=$cadena_productos."|IVA|16.00|".$iva."|".$iva;

/*********************** FORMANDO CADENA ORIGINAL PARA SELLO ********************/
$cadena_original="";
$cadena_original=$cadena_inicial.$cadena_emisor."|".$cadena_receptor.$cadena_productos."||";						
								
						
/********************************************************************/

/********************************************* CREANDO ARCHIVO TXT PARA LA CADENA ORIGINAL *****************************************/
  
  $fnombre_archivo=$fecha.$id_venta;


  $nombre_archivo=$fnombre_archivo.".txt";
  $file=fopen($nombre_archivo,"a") or die("Problemas");
  //vamos añadiendo el contenido
  fputs($file,$cadena_original);
  fclose($file);
  
  $nombre_archivo_pem=$fnombre_archivo.".pem";
  $nombre_archivo_bin=$fnombre_archivo.".bin";
  
  $armb64=$fnombre_archivo."64";
  $nombre_archivo_b64=$armb64.".txt";
  
  
/*****************************************  OBTENIENDO EL SELLO DEL EMISOR ******************************************************/

$salida=shell_exec("bin\openssl pkcs8 -inform DET -in ".$archivo_key." -passin pass:".$clave_key." -out ".$nombre_archivo_pem."");
$salida=shell_exec("bin\openssl dgst -sha1 -out ".$nombre_archivo_bin." -sign ".$nombre_archivo_pem." ".$nombre_archivo."");
$salida=shell_exec("bin\openssl enc -in ".$nombre_archivo_bin." -a -A -out ".$nombre_archivo_b64."");

/********************************************************************************************************************************/	

/****************************************   LEYENDO EL TXT QUE TIENE EL ARCHIVO *************************************************/

$archivo_sello = fopen($nombre_archivo_b64, "r");
    while(!feof($archivo_sello)){
        $contenido_sello = fgets($archivo_sello);
    }
    fclose($archivo_sello);

/*********************************************************************************************************************************/	


/***********************************************************************************************************/


/*$salida_xml = '<?xml version="1.0" encoding="UTF-8"?>';
$salida_xml .= '<cfdi:Comprobante xmlns:cfdi="http://www.sat.gob.mx/cfd/3" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sat.gob.mx/cfd/3 http://www.sat.gob.mx/sitio_internet/cfd/3/cfdv32.xsd" version="3.2" serie="B" folio="359" fecha="';
$salida_xml .=$fecha_hora_factura;
$salida_xml .='" sello="';
$salida_xml .='zr2PgtZaIoK9Pue8NgCm6duHQsJ/0Y89pc5ljZGFrDob/Ezr7kouoDYqZLQehl++hiK6BxpA/AhToQ3cBUhBVelgx3lz4VwqkamdQagPpBY/0Cp6HOWdzdW2ToEizGuAOZcb8o+cg7JW1JRMIBRbFYLeseCkXk21PcvqK/qn8dg="';
$salida_xml .=' formaDePago="PAGO EN UNA SOLA EXHIBICION" noCertificado="';
$salida_xml .=$num_certificado;
$salida_xml .='" certificado="';
$salida_xml .=$certificado;
$salida_xml .='" condicionesDePago="CONTADO" subTotal="';
$salida_xml .=$total_venta;
$salida_xml .='" TipoCambio="1.00" Moneda="Peso Mexicano" total="';
$salida_xml .=$total_pagar;
$salida_xml .='" tipoDeComprobante="ingreso" metodoDePago="CHEQUE" LugarExpedicion="';
$salida_xml .=$lugar_expedicion;
$salida_xml .='" NumCtaPago="NO IDENTIFICADO">';
$salida_xml .='<cfdi:Emisor rfc="';
$salida_xml .=$rfc_empresa;
$salida_xml .='" nombre="';
$salida_xml .=$nombre_empresa;
$salida_xml .='">';
$salida_xml .='<cfdi:DomicilioFiscal calle="';
$salida_xml .=$domicilio_empresa;
$salida_xml .='" noExterior="';
$salida_xml .=$numero_exterior_empresa;
$salida_xml .='" colonia="';
$salida_xml .=$colonia_empresa;
$salida_xml .='" municipio="';
$salida_xml .=$ciudad_empresa;
$salida_xml .='" estado="';
$salida_xml .=$estado_empresa;
$salida_xml .='" pais="';
$salida_xml .=$pais_empresa;
$salida_xml .='" codigoPostal="';
$salida_xml .=$codigo_postal_empresa;
$salida_xml .='"/><cfdi:RegimenFiscal Regimen="';
$salida_xml .=$regimen_empresa;
$salida_xml .='"/>';
$salida_xml .='</cfdi:Emisor>';
$salida_xml .='<cfdi:Receptor rfc="';
$salida_xml .=$rfc_cliente;
$salida_xml .='" nombre="';
$salida_xml .=$nombre_cliente_imprimir;
$salida_xml .='">';
$salida_xml .='<cfdi:Domicilio calle="';
$salida_xml .=$direccion_cliente;
$salida_xml .='" noExterior="';
$salida_xml .=$numero_exterior_cliente;
$salida_xml .='" noInterior="';
$salida_xml .=$numero_interior_cliente;
$salida_xml .='" colonia="';
$salida_xml .=$colonia_cliente;
$salida_xml .='" localidad="';
$salida_xml .=$localidad_cliente;
$salida_xml .='" municipio="';
$salida_xml .=$municipio_cliente;
$salida_xml .='" estado="';
$salida_xml .=$estado_cliente;
$salida_xml .='" pais="';
$salida_xml .=$pais_cliente;
$salida_xml .='" codigoPostal="';
$salida_xml .=$codigo_postal_cliente;
$salida_xml .='"/>';
$salida_xml .='</cfdi:Receptor>';
$salida_xml .='<cfdi:Conceptos>';
$listado=  mysql_query("select * from tproductos_venta where id_venta=$id_venta");

while($reg=  mysql_fetch_array($listado))
{
$id_producto_venta=mb_convert_encoding($reg['id_producto_venta'], "UTF-8");
$id_venta=mb_convert_encoding($reg['id_venta'], "UTF-8");
$descripcion_producto=mb_convert_encoding($reg['descripcion_producto'], "UTF-8");
$cantidad=mb_convert_encoding($reg['cantidad'], "UTF-8");
$precio_venta=mb_convert_encoding($reg['precio_venta'], "UTF-8");
$subtotal=mb_convert_encoding($reg['subtotal'], "UTF-8");
$id_usuario=mb_convert_encoding($reg['id_usuario'], "UTF-8");
$id_producto=mb_convert_encoding($reg['id_producto'], "UTF-8");
$vales_devolucion=mb_convert_encoding($reg['vales_devolucion'], "UTF-8");
$fecha_devolucion=mb_convert_encoding($reg['fecha_devolucion'], "UTF-8");

$salida_xml .='<cfdi:Concepto cantidad="';
$salida_xml .='1.00';
$salida_xml .='" unidad="PIEZA" noIdentificacion="TONERCANON119" descripcion="';
$salida_xml  .=$descripcion_producto;
$salida_xml .='" valorUnitario="';
$salida_xml .=$precio_venta;
$salida_xml .='" importe="';
$salida_xml .=$subtotal;
$salida_xml .='"/>';
}

$salida_xml .='</cfdi:Conceptos>';
$salida_xml .='<cfdi:Impuestos totalImpuestosTrasladados="';
$salida_xml .=$iva;
$salida_xml .='">';
$salida_xml .='<cfdi:Traslados>';
$salida_xml .='<cfdi:Traslado impuesto="IVA" tasa="16.00" importe="';
$salida_xml .=$iva;
$salida_xml .='"/>';
$salida_xml .='</cfdi:Traslados>';
$salida_xml .='</cfdi:Impuestos>';
$salida_xml .='</cfdi:Comprobante>';*/


/*$salida_xml .=' version="3.2" folio="ESTE FOLIO ES EL NUMERO DEL TIMBRADO (O QUE ES)_ 288" fecha="';
$salida_xml .=$fecha_hora_factura;
$salida_xml .='" sello="';
$salida_xml .=$contenido_sello;
$salida_xml .='" formaDePago="PAGO EN UNA SOLA EXHIBICION" noCertificado="';
$salida_xml .=$num_certificado;
$salida_xml .='" certificado="';
$salida_xml .=$certificado;
$salida_xml .='" subTotal="';
$salida_xml .=$total_pagar;
$salida_xml .='" TipoCambio="1.00" Moneda="Peso Mexicano" total="AQUI VA EL TOTAL + IVA" tipoDeComprobante="ingreso" metodoDePago="TRANSFERENCIA ELECTRONICA DE FONDOS" LugarExpedicion="';
$salida_xml .=$lugar_expedicion;

$salida_xml .='<cfdi:Emisor rfc="';
$salida_xml .=$rfc_empresa;
$salida_xml .='" nombre="';
$salida_xml .=$nombre_empresa;
$salida_xml .='">
		<cfdi:DomicilioFiscal calle="';
$salida_xml .=$domicilio_empresa;
$salida_xml .='" noExterior="';
$salida_xml .=$numero_exterior_empresa;
$salida_xml .='" colonia="';
$salida_xml .=$colonia_empresa;
$salida_xml .='" municipio="';
$salida_xml .=$municipio_empresa;
$salida_xml .='" estado="';
$salida_xml .=$estado_empresa;
$salida_xml .='" pais="';
$salida_xml .=$pais_empresa;
$salida_xml .='" codigoPostal="';
$salida_xml .=$codigo_postal_empresa;
$salida_xml .='"/><cfdi:ExpedidoEn calle="DIRECCION DE LA EMPRESA DONDE SE EXPEDIO LA FACTURA O SERA LA SUCURSAL" noExterior="NUMERO EXTERIOR DE LA EMPRESA O SUCURSAL" noInterior="NUMERO INTERIOR DE LA EMPRESA O SUCURSAL" colonia="COLONIA DE LA EMPRESA O SUCURSAL" municipio="MUNICIPIO DE LA EMPRESA O LA SUCURSAL" estado="ESTADO DE LA EMPRESA O SUCURSAL" pais="PAIS DE LA EMPRESA O SUCURSAL" codigoPostal="CODIGO POSTAL DE LA EMPRESA O SUCURSAL"/><cfdi:RegimenFiscal Regimen="REGIMEN GENERAL DE LEY PERSONAS MORALES"/></cfdi:Emisor>';
$salida_xml .='<cfdi:Receptor rfc="';
$salida_xml .=$rfc_cliente;
$salida_xml .='" nombre="';
$salida_xml .=$nombre_cliente_imprimir;
$salida_xml .='">
		<cfdi:Domicilio calle="';
$salida_xml .=$direccion_cliente;
$salida_xml .='" noExterior="';
$salida_xml .=$numero_exterior_cliente;
$salida_xml .='" colonia="';
$salida_xml .=$colonia_cliente;
$salida_xml .='" localidad="';
$salida_xml .=$localidad_cliente;
$salida_xml .='" municipio="';
$salida_xml .=$municipio_cliente;
$salida_xml .='" estado="';
$salida_xml .=$estado_cliente;
$salida_xml .='" pais="';
$salida_xml .=$pais_cliente;
$salida_xml .='" codigoPostal="';
$salida_xml .=$codigo_postal_cliente;
$salida_xml .='"/></cfdi:Receptor>
	<cfdi:Conceptos>';
	
$listado=  mysql_query("select * from tproductos_venta where id_venta=$id_venta");

while($reg=  mysql_fetch_array($listado))
{
$id_producto_venta=mb_convert_encoding($reg['id_producto_venta'], "UTF-8");
$id_venta=mb_convert_encoding($reg['id_venta'], "UTF-8");
$descripcion_producto=mb_convert_encoding($reg['descripcion_producto'], "UTF-8");
$cantidad=mb_convert_encoding($reg['cantidad'], "UTF-8");
$precio_venta=mb_convert_encoding($reg['precio_venta'], "UTF-8");
$subtotal=mb_convert_encoding($reg['subtotal'], "UTF-8");
$id_usuario=mb_convert_encoding($reg['id_usuario'], "UTF-8");
$id_producto=mb_convert_encoding($reg['id_producto'], "UTF-8");
$vales_devolucion=mb_convert_encoding($reg['vales_devolucion'], "UTF-8");
$fecha_devolucion=mb_convert_encoding($reg['fecha_devolucion'], "UTF-8");

$salida_xml .='<cfdi:Concepto cantidad="';
$salida_xml .=$cantidad;
$salida_xml .='" unidad="TIENE QUE IR A FUERZA ESTO__  N/A" noIdentificacion="TIENE QUE IR A FUERZA ESTO__ PAGO CORRESPONDIENTE" descripcion="';
$salida_xml  .=$descripcion_producto;
$salida_xml .='" valorUnitario="';
$salida_xml .=$precio_venta;
$salida_xml .='" importe="';
$salida_xml .=$subtotal;
$salida_xml .='"/>';
}

$salida_xml .='</cfdi:Conceptos><cfdi:Impuestos totalImpuestosTrasladados="AQUI VA EL TOTAL DEL IVA__ 965.52">
		<cfdi:Traslados><cfdi:Traslado impuesto="IVA" tasa="TAZA DEL IVA___ 16.00" importe="AQUI VA EL TOTAL DEL IVA___ 965.52"/></cfdi:Traslados></cfdi:Impuestos>
		<cfdi:Complemento><tfd:TimbreFiscalDigital xmlns:tfd="http://www.sat.gob.mx/TimbreFiscalDigital" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sat.gob.mx/TimbreFiscalDigital http://www.sat.gob.mx/TimbreFiscalDigital/TimbreFiscalDigital.xsd" selloCFD="SELLO DIGITAL DEL CFDI__  iPJilrkii6kQXXCe8xIqvQ2/kAXM2hMRwqPHoj38rRbAGXcU3HIfw2ZkiijC1oGjWeuEmR7dm4K6YNO94FHNr+O2k6g96eS2EEKSmpBr6LHG0r0PWQJqYyLbgYwuoyYXANNP549CR5u+oLyn+9dsraF2d0tMaT4qYzBT6O8kvTg=" FechaTimbrado="FECHA Y HORA DEL TIMBRADO__  2015-09-07T11:00:16" UUID="FOLIO FISCAL__  876A3F41-7E22-4DAE-9170-B9E556286BCE" noCertificadoSAT="No SERIE DEL CERTIFICADO DEL SAT__  00001000000202864883" version="QUIEN DA ESTA VERSION__  1.0" selloSAT="SELLO DEL SAT__  M+HLBK8eQGS06mo+bPb6FarpE17Ymeu24gj52ANsrSGM9Ar6mIi0ffthP36n2zeoy84OFfH4tXxDfk8z0scCCSrISrabCeGpJt2goXRbPU4VEN/ofjGWYFfB2QKbrPFLobPsxpJYe0gHNHbqzD5QzyMeZ+RqD/MtqKX852Ylx4Y=" cadenaOriginal="AQUI VA EL PEDO DE TODA LA CADENA ORIGINAL"/>
		</cfdi:Complemento>';
  
$salida_xml .= '</cfdi:Comprobante>';*/
  
//echo $salida_xml;


$cadena_conceptos_xml="";
$listado2pxml=  mysql_query("select * from tproductos_venta where id_venta=$id_venta");

while($reg2pxml=  mysql_fetch_array($listado2pxml))
{
$id_producto_venta=mb_convert_encoding($reg2pxml['id_producto_venta'], "UTF-8");
$id_venta=mb_convert_encoding($reg2pxml['id_venta'], "UTF-8");
$descripcion_producto=mb_convert_encoding($reg2pxml['descripcion_producto'], "UTF-8");
$cantidad=mb_convert_encoding($reg2pxml['cantidad'], "UTF-8");
$precio_venta=mb_convert_encoding($reg2pxml['precio_venta'], "UTF-8");
$subtotal=mb_convert_encoding($reg2pxml['subtotal'], "UTF-8");
$id_usuario=mb_convert_encoding($reg2pxml['id_usuario'], "UTF-8");
$id_producto=mb_convert_encoding($reg2pxml['id_producto'], "UTF-8");
$vales_devolucion=mb_convert_encoding($reg2pxml['vales_devolucion'], "UTF-8");
$fecha_devolucion=mb_convert_encoding($reg2pxml['fecha_devolucion'], "UTF-8");

//$cadena_productos=$cadena_productos."|".$cantidad."|"."PIEZA"."|".$descripcion_producto."|".$precio_venta."|".$subtotal;
//$cadena_productos=$cadena_productos."|1.00|"."PIEZA"."|TONERCANON119|".$descripcion_producto."|".$precio_venta."|".$subtotal;

$cadena_conceptos_xml=$cadena_conceptos_xml.'<cfdi:Concepto cantidad="1.00" unidad="PIEZA" noIdentificacion="TONERCANON119" descripcion="'.$descripcion_producto.'" valorUnitario="'.$precio_venta.'" importe="'.$subtotal.'"/>';

}



$salida_xml='<?xml version="1.0" encoding="UTF-8"?>
<cfdi:Comprobante xmlns:cfdi="http://www.sat.gob.mx/cfd/3" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sat.gob.mx/cfd/3 http://www.sat.gob.mx/sitio_internet/cfd/3/cfdv32.xsd" version="3.2" serie="B" folio="359" fecha="2015-08-31T12:10:06" sello="'.$contenido_sello.'" formaDePago="PAGO EN UNA SOLA EXHIBICION" noCertificado="'.$num_certificado.'" certificado="'.$certificado.'" condicionesDePago="CONTADO" subTotal="'.$total_venta.'" TipoCambio="1.00" Moneda="Peso Mexicano" total="'.$total_pagar.'" tipoDeComprobante="ingreso" metodoDePago="CHEQUE" LugarExpedicion="'.$lugar_expedicion.'" NumCtaPago="NO IDENTIFICADO">
	<cfdi:Emisor rfc="'.$rfc_empresa.'" nombre="'.$nombre_empresa.'">
		<cfdi:DomicilioFiscal calle="'.$domicilio_empresa.'" noExterior="'.$numero_exterior_empresa.'" colonia="'.$colonia_empresa.'" municipio="'.$ciudad_empresa.'" estado="'.$estado_empresa.'" pais="'.$pais_empresa.'" codigoPostal="'.$codigo_postal_empresa.'"/><cfdi:RegimenFiscal Regimen="'.$regimen_empresa.'"/></cfdi:Emisor>
	<cfdi:Receptor rfc="'.$rfc_cliente.'" nombre="'.$nombre_cliente_imprimir.'">
		<cfdi:Domicilio calle="'.$direccion_cliente.'" noExterior="'.$numero_exterior_cliente.'" noInterior="'.$numero_interior_cliente.'" colonia="'.$colonia_cliente.'" localidad="'.$localidad_cliente.'" municipio="'.$municipio_cliente.'" estado="'.$estado_cliente.'" pais="'.$pais_cliente.'" codigoPostal="'.$codigo_postal_cliente.'"/></cfdi:Receptor>
	<cfdi:Conceptos>
	'.$cadena_conceptos_xml.'</cfdi:Conceptos><cfdi:Impuestos totalImpuestosTrasladados="211.20">
		<cfdi:Traslados><cfdi:Traslado impuesto="IVA" tasa="16.00" importe="'.$iva.'"/></cfdi:Traslados></cfdi:Impuestos></cfdi:Comprobante>';


/************************* FALTA LA PARTE DE LOS ARTICULOS LO DEMAS YA ESTA BIEN ***********************************/


$nombre = "prueba2.xml";
$archivo = fopen($nombre, 'w+');
fwrite($archivo,$salida_xml);
fclose($archivo);





?>
