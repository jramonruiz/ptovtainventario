<?php
# Creamos una variable para guardar el XML del CFD que queremos timbrar, por facilidad
# en este caso lo tenemos de manera estatica
$cfd = <<<EOF
<?xml version="1.0" encoding="UTF-8"?>
<cfdi:Comprobante xmlns:cfdi="http://www.sat.gob.mx/cfd/3" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sat.gob.mx/cfd/3 http://www.sat.gob.mx/sitio_internet/cfd/3/cfdv32.xsd" version="3.2" serie="B" folio="359" fecha="2015-08-31T12:10:06" sello="zr2PgtZaIoK9Pue8NgCm6duHQsJ/0Y89pc5ljZGFrDob/Ezr7kouoDYqZLQehl++hiK6BxpA/AhToQ3cBUhBVelgx3lz4VwqkamdQagPpBY/0Cp6HOWdzdW2ToEizGuAOZcb8o+cg7JW1JRMIBRbFYLeseCkXk21PcvqK/qn8dg=" formaDePago="PAGO EN UNA SOLA EXHIBICION" noCertificado="00001000000301642453" certificado="MIIEYDCCA0igAwIBAgIUMDAwMDEwMDAwMDAzMDE2NDI0NTMwDQYJKoZIhvcNAQEFBQAwggGKMTgwNgYDVQQDDC9BLkMuIGRlbCBTZXJ2aWNpbyBkZSBBZG1pbmlzdHJhY2nDs24gVHJpYnV0YXJpYTEvMC0GA1UECgwmU2VydmljaW8gZGUgQWRtaW5pc3RyYWNpw7NuIFRyaWJ1dGFyaWExODA2BgNVBAsML0FkbWluaXN0cmFjacOzbiBkZSBTZWd1cmlkYWQgZGUgbGEgSW5mb3JtYWNpw7NuMR8wHQYJKoZIhvcNAQkBFhBhY29kc0BzYXQuZ29iLm14MSYwJAYDVQQJDB1Bdi4gSGlkYWxnbyA3NywgQ29sLiBHdWVycmVybzEOMAwGA1UEEQwFMDYzMDAxCzAJBgNVBAYTAk1YMRkwFwYDVQQIDBBEaXN0cml0byBGZWRlcmFsMRQwEgYDVQQHDAtDdWF1aHTDqW1vYzEVMBMGA1UELRMMU0FUOTcwNzAxTk4zMTUwMwYJKoZIhvcNAQkCDCZSZXNwb25zYWJsZTogQ2xhdWRpYSBDb3ZhcnJ1YmlhcyBPY2hvYTAeFw0xMzEyMDkyMTA5MzhaFw0xNzEyMDkyMTA5MzhaMIGsMRowGAYDVQQDExFJTiBDTE9VRCBTQSBERSBDVjEaMBgGA1UEKRMRSU4gQ0xPVUQgU0EgREUgQ1YxGjAYBgNVBAoTEUlOIENMT1VEIFNBIERFIENWMSUwIwYDVQQtExxJQ0wxMzAxMTg5UTMgLyBMT1NENzMwNDIzTEIzMR4wHAYDVQQFExUgLyBMT1NENzMwNDIzSENTUE1SMDQxDzANBgNVBAsTBk1BVFJJWjCBnzANBgkqhkiG9w0BAQEFAAOBjQAwgYkCgYEA0/R/5y9uTk4dev+YETTmthFYjH+aWK1UsBWusXYYQRuuVPLB7y1gPn957Oje3DhtC7BxQSdOP2JuAvw0bgcZwmFx8+zJ2edp6bi+GOzO8A7rs4ts42usWI62bTQDWCZPCzGlF490pIi6DBKtPHyHkEPA9oWgm5N8hQGaJozS3AMCAwEAAaMdMBswDAYDVR0TAQH/BAIwADALBgNVHQ8EBAMCBsAwDQYJKoZIhvcNAQEFBQADggEBAD84aNGSN04EQWZ00YnTG8zAfr72yFE6A4iC9i3BdoE1i26tCmaG1wWR9CBfT+UgiplV00WlpgZww9pn52ppf8jcdbakLWiHXBoSLzNPBEnzMcwQ7/qaljbXI/ihXTT6FWtlysw3yNTbKoziR+tJU+jaEQ6IwZjrz6xBieTThHUl6P9JUXdFxtnnvE7SGIFeFLPr9kXPO7h+uMSQmU5BMv7DAaCBvz6TPkBOJ6gU7y+TvnMQDAdLx52ds/C/BUE6A5KEuU9mn+FU1NGvgawpE99QDcLpQSqojJ1MbVc1iinMo+d7MMqJnuFz5GHCzKVY7RHHcGkllNO2Pi7krgHO0jg=" condicionesDePago="CONTADO" subTotal="1320.00" TipoCambio="1.00" Moneda="Peso Mexicano" total="1531.20" tipoDeComprobante="ingreso" metodoDePago="CHEQUE" LugarExpedicion="CALLE 12 PONIENTE NORTE 408-A , EL MAGUEYITO, 29000, TUXTLA GUTIERREZ, CHIAPAS, MEXICO" NumCtaPago="NO IDENTIFICADO">
	<cfdi:Emisor rfc="ICL1301189Q3" nombre="IN CLOUD S.A. DE C.V.">
		<cfdi:DomicilioFiscal calle="CALLE 12 PONIENTE NORTE" noExterior="408-A" colonia="EL MAGUEYITO" municipio="TUXTLA GUTIERREZ" estado="CHIAPAS" pais="MEXICO" codigoPostal="29000"/><cfdi:RegimenFiscal Regimen="REGIMEN GENERAL DE LEY PERSONAS MORALES"/></cfdi:Emisor>
	<cfdi:Receptor rfc="CON140707TN9" nombre="CREA OPORTUNIDADES DE NEGOCIO S.A. DE C.V. SOFOM ENR">
		<cfdi:Domicilio calle="3A SUR PONIENTE" noExterior="1141" noInterior="7" colonia="COL. CENTRO" localidad="TUXTLA GUTIERREZ" municipio="TUXTLA GUTIERREZ" estado="CHIAPAS" pais="MEXICO" codigoPostal="29000"/></cfdi:Receptor>
	<cfdi:Conceptos>
		<cfdi:Concepto cantidad="1.00" unidad="PIEZA" noIdentificacion="TONERCANON119" descripcion="TONER CANON 119" valorUnitario="1320.00" importe="1320.00"/></cfdi:Conceptos><cfdi:Impuestos totalImpuestosTrasladados="211.20">
		<cfdi:Traslados><cfdi:Traslado impuesto="IVA" tasa="16.00" importe="211.20"/></cfdi:Traslados></cfdi:Impuestos><cfdi:Complemento><tfd:TimbreFiscalDigital xmlns:tfd="http://www.sat.gob.mx/TimbreFiscalDigital" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sat.gob.mx/TimbreFiscalDigital http://www.sat.gob.mx/TimbreFiscalDigital/TimbreFiscalDigital.xsd" selloCFD="zr2PgtZaIoK9Pue8NgCm6duHQsJ/0Y89pc5ljZGFrDob/Ezr7kouoDYqZLQehl++hiK6BxpA/AhToQ3cBUhBVelgx3lz4VwqkamdQagPpBY/0Cp6HOWdzdW2ToEizGuAOZcb8o+cg7JW1JRMIBRbFYLeseCkXk21PcvqK/qn8dg=" FechaTimbrado="2015-08-31T12:10:18" UUID="3C9D306A-D337-4D8F-9084-478504FEAAD8" noCertificadoSAT="00001000000202864883" version="1.0" selloSAT="iyPjx/l7UvPu/mJrKuwleOD3uYmR4lICSdNz7KCmDlTiJOY+HgyOwV6o+b0hNOGDUpJN6sGjGsvijVNtHdaBHRTLZAOTdw/BllK4YKM3o0x0W8Oha2xmgj/lQxJu6S0c7plL9cAzlWgRbScxSmdRr9X6qY+su1dYECYS0OfCDOk="/></cfdi:Complemento></cfdi:Comprobante>
EOF;
# Recuerda que:
# La URL de prueba es: http://staging.diverza.com/stamp
# El token de seguridad de prueba es: ABCD1234
# El RFC emisor de prueba es: AAA010101AAA
# Creamos un arreglo para almacenar las opciones para la petición
# HTTP:
# - Se requiere utilizar el metodo HTTP POST
# - Agregamos el header 'x-auth-token' con el valor del token de seguridad que utilizaremos
#   en este caso 'ABCD1234'
# - Como contenido agregamos el CFD a timbrar.
$request_options = array(
  'http' => array(
    'method' => "POST",
    'header' => "x-auth-token: ABCD1234\r\n",
    'content' => $cfd,
    'ignore_errors' => true
));
# Creamos un stream context utilizando las opciones para la peticion HTTP
$stream_context = stream_context_create($request_options);
# Ejecutamos el request a la URL del servidor de timbrado
$response = file_get_contents('http://staging.diverza.com/stamp', false, $stream_context);
# Obtenemos el codigo de respuesta del servidor y el mensaje de respuesta
$response_code = $http_response_header[0];
$response_message = $response;
echo "Codigo HTTP: $response_code\r\n";
echo "Timbre: $response_message\r\n";
?>
