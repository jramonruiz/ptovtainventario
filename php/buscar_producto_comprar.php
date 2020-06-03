<?php
include("conexion.php");
$connect = mysql_connect($hostname, $username, $password)
or die('Could not connect: ' . mysql_error());
//Select The database
$con = mysql_select_db($database, $connect);

$txtdescripcion_producto=utf8_decode($_POST['txtdescripcion_producto']);

$id_producto_buscar=0;

$rs = mysql_query("SELECT id_producto,codigo_barras,descripcion FROM cproductos where descripcion='$txtdescripcion_producto'");
if ($row = mysql_fetch_row($rs)) {
$id_producto_buscar = trim($row[0]);
$codigo_barras = trim($row[1]);
$descripcion = trim($row[2]);
}

if($id_producto_buscar!=0)
	{
		echo "Y,".$id_producto_buscar.",".$codigo_barras;	
	}
else
	{
		echo "E";
	}		
?>




