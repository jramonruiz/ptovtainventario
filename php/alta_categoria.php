<?php
include("conexion.php");
$connect = mysql_connect($hostname, $username, $password)
or die('Could not connect: ' . mysql_error());
//Select The database
$con = mysql_select_db($database, $connect);
//mysql_query("SET NAMES 'utf8'");

$txtdesc_categoria=utf8_decode($_POST['txtdesc_categoria']);

$id_categoria=0;

$rs = mysql_query("SELECT id_categoria FROM ccategorias where desc_categoria=\"$txtdesc_categoria\"");
if ($row = mysql_fetch_row($rs)) {
$id_categoria = trim($row[0]);
}

if($id_categoria==0)
	{
$sql= mysql_query("insert into ccategorias(desc_categoria,fecha_actualizacion) VALUES (\"$txtdesc_categoria\",CURDATE())");
	echo "E";
	}
else
	{
	echo "Y";
	}
?>