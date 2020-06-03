<?php
include("conexion.php");
$connect = mysql_connect($hostname, $username, $password)
or die('Could not connect: ' . mysql_error());
//Select The database
$con = mysql_select_db($database, $connect);
//mysql_query("SET NAMES 'utf8'");

$txtnombre_impuesto=utf8_decode($_POST['txtnombre_impuesto']);
$txtporcentaje=utf8_decode($_POST['txtporcentaje']);

$id_impuesto=0;

$rs = mysql_query("SELECT id_impuesto FROM cimpuestos where nombre_impuesto=\"$txtnombre_impuesto\"");
if ($row = mysql_fetch_row($rs)) {
$id_impuesto = trim($row[0]);
}

if($id_impuesto==0)
	{
$sql= mysql_query("insert into cimpuestos(nombre_impuesto,porcentaje_impuesto,fecha_actualizacion) VALUES (\"$txtnombre_impuesto\",\"$txtporcentaje\",CURDATE())");
	echo "E";
	}
else
	{
	echo "Y";
	}
?>