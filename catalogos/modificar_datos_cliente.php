<?php
include("../php/conexion.php");
$connect = mysql_connect($hostname, $username, $password)
or die('Could not connect: ' . mysql_error());
//Select The database
$con = mysql_select_db($database, $connect);

$txtid_cliente_modificar=utf8_decode($_POST['txtid_cliente_modificar']);
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
//cclientes= id_cliente,nombre_cliente,direccion,rfc,telefono,email,numero_exterior,numero_interior,colonia,localidad,municipio,estado,pais,codigo_postal,nombre_comercial,fecha_captura,celular,referencias_observaciones,nombre_contacto,calle_contacto,colonia_contacto,localidad_contacto,estado_contacto,codigo_postal_contacto,telefono_contacto,fax_contacto,celular_contacto,email_contacto

$sql= mysql_query("update cclientes set nombre_cliente=\"$txtnombre_cliente\",direccion=\"$txtdireccion\",rfc=\"$txtrfc\",telefono=\"$txttelefono\",email=\"$txtcorreo\",numero_exterior=\"$txtnumero_exterior\",numero_interior=\"$txtnumero_interior\",colonia=\"$txtcolonia\",codigo_postal=\"$txtcodigo_postal\",fecha_captura=CURDATE(),celular=\"$txtcelular\",referencias_observaciones=\"$txtreferencias_observaciones\" where id_cliente=".$txtid_cliente_modificar."");

// tcliente_credencial= id_credencial,id_cliente,fecha_vencimiento,descuento_porcentaje,precio_predeterminado,precio_minimo,limite_credito,saldo,credito_disponible,forma_pago,numero_cuenta,numero_credencial

$cadena="update cclientes set nombre_cliente=\"$txtnombre_cliente\",direccion=\"$txtdireccion\",rfc=\"$txtrfc\",telefono=\"$txttelefono\",email=\"$txtcorreo\" where id_cliente=".$txtid_cliente_modificar."";
	
echo "Y";
//echo $cadena;

?>




