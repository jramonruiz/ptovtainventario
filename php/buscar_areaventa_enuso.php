<?php
$tipusr="";
$paginterior=0;
include("autentificacion.server.php");
session_name("lgsapplipweb");
session_start();
session_set_cookie_params(0, "/", $HTTP_SERVER_VARS["HTTP_HOST"], 0);

$id_usuario=$_SESSION["iduser"];

include("conexion.php");
$connect = mysql_connect($hostname, $username, $password)
or die('Could not connect: ' . mysql_error());
//Select The database
$con = mysql_select_db($database, $connect);
//mysql_query("SET NAMES 'utf8'");

$txtareaventa=utf8_decode($_POST['txtareaventa']);

$id_area_venta_uso=0;

$rsavu = mysql_query("select * from careasventa WHERE enuso=1 and id_usuario=$id_usuario order by id_area_venta limit 1");
if ($rowavu = mysql_fetch_row($rsavu)) {
$id_area_venta_uso = trim($rowavu[0]);
$nombre_area_venta_uso = trim($rowavu[1]);
}


if($txtareaventa==100 and $id_area_venta_uso==0)
{
	$rsav = mysql_query("select * from careasventa WHERE enuso=0 order by id_area_venta limit 1");
	if ($rowav = mysql_fetch_row($rsav)) {
	$id_area_venta = trim($rowav[0]);
	$nombre_area_venta = trim($rowav[1]);
	}

	$sqlavact= mysql_query("update careasventa set enuso=1,id_usuario=$id_usuario where id_area_venta=$id_area_venta");

	$rsav = mysql_query("select * from careasventa WHERE enuso=1 and id_usuario=$id_usuario order by id_area_venta limit 1");
	if ($rowav = mysql_fetch_row($rsav)) {
	$id_area_venta_usar = trim($rowav[0]);
	$nombre_area_venta = trim($rowav[1]);
	}	

}

else
{
	$rsav = mysql_query("select * from careasventa WHERE enuso=1 and id_usuario=$id_usuario order by id_area_venta limit 1");
	if ($rowav = mysql_fetch_row($rsav)) {
	$id_area_venta_usar = trim($rowav[0]);
	$nombre_area_venta = trim($rowav[1]);	
	}
}

echo "Y,".$id_area_venta_usar.",".$id_area_venta_uso;


?>