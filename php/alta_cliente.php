<?php
include("conexion.php");
$connect = mysql_connect($hostname, $username, $password)
or die('Could not connect: ' . mysql_error());
//Select The database
$con = mysql_select_db($database, $connect);

//cclientes= id_cliente,nombre_cliente,direccion,rfc,telefono,email,numero_exterior,numero_interior,colonia,localidad,municipio,estado,pais,codigo_postal,nombre_comercial,fecha_captura,celular,referencias_observaciones,nombre_contacto,calle_contacto,colonia_contacto,localidad_contacto,estado_contacto,codigo_postal_contacto,telefono_contacto,fax_contacto,celular_contacto,email_contacto

$txtnombre_cliente=utf8_decode($_POST['txtnombre_cliente']);
$txtdireccion=utf8_decode($_POST['txtdireccion']);
$txtrfc=utf8_decode($_POST['txtrfc']);
$txttelefono=utf8_decode($_POST['txttelefono']);
$txtcorreo=utf8_decode($_POST['txtcorreo']);
$txtnumero_exterior=utf8_decode($_POST['txtnumero_exterior']);
$txtnumero_interior=utf8_decode($_POST['txtnumero_interior']);
$txtcolonia=utf8_decode($_POST['txtcolonia']);
$txtcodigo_postal=utf8_decode($_POST['txtcodigo_postal']);
$txtcelular=utf8_decode($_POST['txtcelular']);
$txtreferencias_observaciones=utf8_decode($_POST['txtreferencias_observaciones']);



$id_cliente=0;

$rss = mysql_query("SELECT id_cliente FROM cclientes where nombre_cliente=\"$txtnombre_cliente\"");
if ($rows = mysql_fetch_row($rss)) {
$id_cliente = trim($rows[0]);
}

if($id_cliente==0)
	{
$sql= mysql_query("insert into cclientes(nombre_cliente,direccion,rfc,telefono,email,numero_exterior,numero_interior,colonia,codigo_postal,fecha_captura,celular,referencias_observaciones) values(\"$txtnombre_cliente\",\"$txtdireccion\",\"$txtrfc\",\"$txttelefono\",\"$txtcorreo\",\"$txtnumero_exterior\",\"$txtnumero_interior\",\"$txtcolonia\",\"$txtcodigo_postal\",CURDATE(),\"$txtcelular\",\"$txtreferencias_observaciones\")");

		/*$rs = mysql_query("SELECT MAX(id_cliente) AS id_cliente FROM cclientes");
		if ($row = mysql_fetch_row($rs)) {
		$id_cliente_ultimo = trim($row[0]);
		}


		$sql2= mysql_query("insert into tcliente_credencial(id_cliente,fecha_vencimiento,descuento_porcentaje,limite_credito,saldo,credito_disponible,forma_pago,numero_cuenta,numero_credencial) values(\"$id_cliente_ultimo\",\"$txtfecha_vencimiento\",\"$txtdescuento_porcentaje\",\"$txtlimite_credito\",\"$txtsaldo\",\"$txtcredito_disponible\",\"$txtforma_pago\",\"$txtnumero_cuenta\",\"$txtcredencial_tarjeta\")");*/


		echo "Y";
	}
else
	{

		echo "N";
	}

$cadena="insert into tcliente_credencial(id_cliente,fecha_vencimiento,descuento_porcentaje,limite_credito,saldo,credito_disponible,forma_pago,numero_cuenta,numero_credencial) values(\"$id_cliente_ultimo\",\"$txtfecha_vencimiento\",\"$txtdescuento_porcentaje\",\"$txtlimite_credito\",\"$txtsaldo\",\"$txtcredito_disponible\",\"$txtforma_pago\",\"$txtnumero_cuenta\",\"$txtcredencial_tarjeta\")";
	
	//echo $cadena;

?>




