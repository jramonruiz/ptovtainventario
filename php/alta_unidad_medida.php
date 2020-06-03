<?php
include("conexion.php");
$connect = mysql_connect($hostname, $username, $password)
or die('Could not connect: ' . mysql_error());
//Select The database
$con = mysql_select_db($database, $connect);
//mysql_query("SET NAMES 'utf8'");

$txtnombre_unidad_medida=utf8_decode($_POST['txtnombre_unidad_medida']);

$id_unidad_medida=0;

$rs = mysql_query("SELECT id_unidad_medida FROM cunidadesmedida where nombre_unidad_medida=\"$txtnombre_unidad_medida\"");
if ($row = mysql_fetch_row($rs)) {
$id_unidad_medida = trim($row[0]);
}

if($id_unidad_medida==0)
	{
$sql= mysql_query("insert into cunidadesmedida(nombre_unidad_medida,fecha_actualizacion) VALUES (\"$txtnombre_unidad_medida\",CURDATE())");
	echo "E";
	}
else
	{
	echo "Y";
	}
?>