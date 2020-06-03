<?php
include("conexion.php");
$connect = mysql_connect($hostname, $username, $password)
or die('Could not connect: ' . mysql_error());
//Select The database
$con = mysql_select_db($database, $connect);
//mysql_query("SET NAMES 'utf8'");

$txtid_cuenta_pagar=utf8_decode($_POST['txtid_cuenta_pagar']);
$txttipo_pago=utf8_decode($_POST['txttipo_pago']);
$txtimporte_abono=utf8_decode($_POST['txtimporte_abono']);
$txtfaltante_pagar=utf8_decode($_POST['txtfaltante_pagar']);
$txtcomentario=utf8_decode($_POST['txtcomentario']);
$txtfecha_proximo_pago=utf8_decode($_POST['datepicker1']);

$pagado=$txtfaltante_pagar-$txtimporte_abono;

//ttabonos_cpagar = id_cuenta_pagar,fecha,id_tipo_pago,importe,comentario,pagado

$rspro = mysql_query("SELECT id_metodo_pago FROM tmetodos_pago where desc_metodo_pago=\"$txttipo_pago\"");
if ($rowpro = mysql_fetch_row($rspro)) {
$id_metodo_pago = trim($rowpro[0]);
}

$sql= mysql_query("insert into tabonos_cpagar(id_cuenta_pagar,fecha,id_tipo_pago,importe,comentario,pagado) VALUES (\"$txtid_cuenta_pagar\",CURDATE(),\"$id_metodo_pago\",\"$txtimporte_abono\",\"$txtcomentario\",\"$pagado\")");


if($pagado<1)
{
$sql2= mysql_query("update tcuentas_pagar set faltante_pagar=0.00,fecha_pago=\"$txtfecha_proximo_pago\",pagada=1 where id_cuenta_pagar=".$txtid_cuenta_pagar."");
}
else
{
$sql2= mysql_query("update tcuentas_pagar set faltante_pagar=\"$pagado\",fecha_pago=\"$txtfecha_proximo_pago\" where id_cuenta_pagar=".$txtid_cuenta_pagar."");
}

	echo "Y";
?>