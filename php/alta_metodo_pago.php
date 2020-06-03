<?php
include("conexion.php");
$connect = mysql_connect($hostname, $username, $password)
or die('Could not connect: ' . mysql_error());
//Select The database
$con = mysql_select_db($database, $connect);
//mysql_query("SET NAMES 'utf8'");

$txtnombre_metodo_pago=utf8_decode($_POST['txtnombre_metodo_pago']);

$id_metodo_pago=0;

$rs = mysql_query("SELECT id_metodo_pago FROM tmetodos_pago where desc_metodo_pago=\"$txtnombre_metodo_pago\"");
if ($row = mysql_fetch_row($rs)) {
$id_metodo_pago = trim($row[0]);
}

if($id_metodo_pago==0)
	{
$sql= mysql_query("insert into tmetodos_pago(desc_metodo_pago) VALUES (\"$txtnombre_metodo_pago\")");
	echo "E";
	}
else
	{
	echo "Y";
	}
?>