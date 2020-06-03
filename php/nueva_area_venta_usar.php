<?php
$tipusr="";
$paginterior=0;
include("autentificacion.server.php");
session_name("lgsapplipweb");
session_start();
session_set_cookie_params(0, "/", $HTTP_SERVER_VARS["HTTP_HOST"], 0);

$id_usuario=$_SESSION["iduser"];
$id_area_venta_anterior=utf8_decode($_POST['txtid_areaventa']);

include("conexion.php");
$connect = mysql_connect($hostname, $username, $password)
or die('Could not connect: ' . mysql_error());
//Select The database
$con = mysql_select_db($database, $connect);
//mysql_query("SET NAMES 'utf8'");

$rsav = mysql_query("select * from careasventa WHERE enuso=0 order by id_area_venta limit 1");
if ($rowav = mysql_fetch_row($rsav)) {
$id_area_venta = trim($rowav[0]);
$nombre_area_venta = trim($rowav[1]);
}

//// SUMANDO NUMERO DE AREAS DE VENTA EXISTENTES
$rsavex = mysql_query("SELECT COUNT(id_area_venta) AS numav_existencia FROM careasventa");
if ($rowavex = mysql_fetch_row($rsavex)) {
$numav_existencia = trim($rowavex[0]);
}

//// SUMANDO NUMERO DE AREAS DE VENTA EN USO
$rsavus = mysql_query("SELECT COUNT(id_area_venta) AS numav_uso FROM careasventa where enuso=1");
if ($rowavus = mysql_fetch_row($rsavus)) {
$numav_uso = trim($rowavus[0]);
}

if($numav_uso<$numav_existencia)
	{
		$sqlavact= mysql_query("update careasventa set enuso=1,id_usuario=$id_usuario where id_area_venta=$id_area_venta");
		echo "Y,".$id_area_venta;
	}
else
	{
		echo "N,".$id_area_venta_anterior;	
	}

	
?>