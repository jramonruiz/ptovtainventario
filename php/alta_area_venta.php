<?php
include("conexion.php");
$connect = mysql_connect($hostname, $username, $password)
or die('Could not connect: ' . mysql_error());
//Select The database
$con = mysql_select_db($database, $connect);
//mysql_query("SET NAMES 'utf8'");

$txtnombre_areaventa=utf8_decode($_POST['txtnombre_areaventa']);
$txtnombre_caja=utf8_decode($_POST['txtnombre_caja']);

$rsc = mysql_query("SELECT id_caja FROM ccajas where descripcion_caja=\"$txtnombre_caja\"");
if ($rowc = mysql_fetch_row($rsc)) {
$id_caja = trim($rowc[0]);
}

$id_area_venta=0;

$rs = mysql_query("SELECT id_area_venta FROM careasventa where nombre_area=\"$txtnombre_areaventa\"");
if ($row = mysql_fetch_row($rs)) {
$id_area_venta = trim($row[0]);
}

if($id_area_venta==0)
	{
$sql= mysql_query("insert into careasventa(nombre_area,id_caja,fecha_actualizacion) VALUES (\"$txtnombre_areaventa\",\"$id_caja\",CURDATE())");
	echo "E";
	}
else
	{
	echo "Y";
	}
?>