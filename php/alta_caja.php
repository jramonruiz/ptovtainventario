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

$txtdescripcion_caja=utf8_decode($_POST['txtdescripcion_caja']);
$txtnombre_sucursal=utf8_decode($_POST['txtnombre_sucursal']);
$txtefectivo_caja=utf8_decode($_POST['txtefectivo_caja']);

$rss = mysql_query("SELECT id_sucursal FROM csucursales where descripcion_sucursal=\"$txtnombre_sucursal\"");
if ($rows = mysql_fetch_row($rss)) {
$id_sucursal = trim($rows[0]);
}

$id_caja=0;

$rs = mysql_query("SELECT id_caja FROM ccajas where descripcion_caja=\"$txtdescripcion_caja\"");
if ($row = mysql_fetch_row($rs)) {
$id_caja = trim($row[0]);
}

if($id_caja==0)
	{
	
	$sql= mysql_query("insert into ccajas(descripcion_caja,efectivo_caja,fecha_actualizacion,id_usuario,id_sucursal) values('".$txtdescripcion_caja."',".$txtefectivo_caja.",CURDATE(),".$id_usuario.",".$id_sucursal.")");
	echo "E";
	}
else
	{
	echo "Y";
	}
?>