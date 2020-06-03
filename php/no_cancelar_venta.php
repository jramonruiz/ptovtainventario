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

$txtid_venta_modificar=utf8_decode($_POST['txtid_venta_modificar']);

$sqlncv= mysql_query("update tventas set proceso_cancelacion=0 where id_venta=$txtid_venta_modificar");

$sql= mysql_query("delete from tproductos_venta where id_venta=0 and id_area_venta=0");


	echo "Y,".$txtid_venta_modificar;
	
?>