<?php
include("conexion.php");
$connect = mysql_connect($hostname, $username, $password)
or die('Could not connect: ' . mysql_error());
//Select The database
$con = mysql_select_db($database, $connect);
//mysql_query("SET NAMES 'utf8'");

$txtnombre_ubicacion=utf8_decode($_POST['txtnombre_ubicacion']);

$id_ubicacion=0;

$rs = mysql_query("SELECT id_ubicacion FROM cubicaciones where nombre_ubicacion=\"$txtnombre_ubicacion\"");
if ($row = mysql_fetch_row($rs)) {
$id_ubicacion = trim($row[0]);
}

if($id_ubicacion==0)
	{
$sql= mysql_query("insert into cubicaciones(nombre_ubicacion,fecha_actualizacion) VALUES (\"$txtnombre_ubicacion\",CURDATE())");
	echo "E";
	}
else
	{
	echo "Y";
	}
?>