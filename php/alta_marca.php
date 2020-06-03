<?php
include("conexion.php");
$connect = mysql_connect($hostname, $username, $password)
or die('Could not connect: ' . mysql_error());
//Select The database
$con = mysql_select_db($database, $connect);
//mysql_query("SET NAMES 'utf8'");

$txtnombre_marca=utf8_decode($_POST['txtnombre_marca']);

$id_marca=0;

$rs = mysql_query("SELECT id_marca FROM cmarcas where descripcion_marca=\"$txtnombre_marca\"");
if ($row = mysql_fetch_row($rs)) {
$id_marca = trim($row[0]);
}

if($id_marca==0)
	{
$sql= mysql_query("insert into cmarcas(descripcion_marca) VALUES (\"$txtnombre_marca\")");
	echo "E";
	}
else
	{
	echo "Y";
	}
?>