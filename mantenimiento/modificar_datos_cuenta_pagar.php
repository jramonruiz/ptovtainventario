<?php
include("../php/conexion.php");
$connect = mysql_connect($hostname, $username, $password)
or die('Could not connect: ' . mysql_error());
//Select The database
$con = mysql_select_db($database, $connect);
//mysql_query("SET NAMES 'utf8'");

$txtnombre_proveedor=utf8_decode($_POST['txtnombre_proveedor']);
$txtdocumento_pagar=utf8_decode($_POST['txtdocumento_pagar']);
$txtpago_dinero=utf8_decode($_POST['txttotal_pagar']);
$fecha_proximo_pago=utf8_decode($_POST['datepicker1']);
$txtdescuento_pronto_pago=utf8_decode($_POST['txtdescuento_pronto_pago']);
$txtid_cuenta_pagar_modificar=utf8_decode($_POST['txtid_cuenta_pagar_modificar']);

$total_pagar_descuento=$txtpago_dinero-$txtdescuento_pronto_pago;

$faltante_pagar=$total_pagar_descuento;

 $rspro = mysql_query("SELECT id_proveedor,nombre_empresa FROM cproveedores where nombre_empresa=\"$txtnombre_proveedor\"");
if ($rowpro = mysql_fetch_row($rspro)) {
$id_proveedor = trim($rowpro[0]);
}

$rscp = mysql_query("SELECT id_cuenta_pagar FROM tcuentas_pagar where documento=\"$txtdocumento_pagar\" and id_proveedor=\"$id_proveedor\"");
if ($rowcp = mysql_fetch_row($rscp)) {
$id_cuenta_pagar = trim($rowcp[0]);
}

$sql= mysql_query("update tcuentas_pagar set id_proveedor=$id_proveedor,nombre_proveedor=\"$txtnombre_proveedor\",documento=\"$txtdocumento_pagar\",fecha=CURDATE(),pagado_dinero=$txtpago_dinero,total_pagar=$total_pagar_descuento,fecha_pago=\"$fecha_proximo_pago\",descuento_pronto_pago=$txtdescuento_pronto_pago,faltante_pagar=$faltante_pagar where id_cuenta_pagar=".$txtid_cuenta_pagar_modificar."");

$cad="update tcuentas_pagar set id_proveedor=$id_proveedor,nombre_proveedor=\"$txtnombre_proveedor\",documento=\"$txtdocumento_pagar\",fecha=CURDATE(),pagado_dinero=$txtpago_dinero,total_pagar=$total_pagar_descuento,fecha_pago=$fecha_proximo_pago,descuento_pronto_pago=$txtdescuento_pronto_pago,faltante_pagar=$faltante_pagar where id_cuenta_pagar=".$txtid_cuenta_pagar_modificar."";

	//echo "Y";
		echo $cad;
?>