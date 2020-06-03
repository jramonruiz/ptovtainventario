<?php
include("conexion.php");
$connect = mysql_connect($hostname, $username, $password)
or die('Could not connect: ' . mysql_error());
//Select The database
$con = mysql_select_db($database, $connect);
//mysql_query("SET NAMES 'utf8'");

$txtidproveedor=utf8_decode($_POST['txtidproveedor']);
$txtnumero_cuentabp=utf8_decode($_POST['txtnumero_cuentabp']);
$txtbancop=utf8_decode($_POST['txtbancop']);

$rscbp = mysql_query("SELECT id_cuenta_bancariap FROM tcuenta_bancariap where numero_cuenta=\"$txtnumero_cuentabp\" and banco=\"$txtbancop\" and id_proveedor=\"$txtidproveedor\"");
if ($rowcbp = mysql_fetch_row($rscbp)) {
$id_cuenta_bancariap = trim($rowcbp[0]);
}

$id_cuenta_bancariap=0;

if($id_cuenta_bancariap==0)
	{
$sql= mysql_query("insert into tcuenta_bancariap(id_proveedor,numero_cuenta,banco) VALUES (\"$txtidproveedor\",\"$txtnumero_cuentabp\",\"$txtbancop\")");
	echo "E";
	}
else
	{
	echo "Y";
	}
?>