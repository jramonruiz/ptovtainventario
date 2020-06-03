<?php
$tipusr="";
$paginterior=0;
include("../php/autentificacion.server.php");
session_name("lgsapplipweb");
session_start();
session_set_cookie_params(0, "/", $HTTP_SERVER_VARS["HTTP_HOST"], 0);

$id_usuario=$_SESSION["iduser"];
$id_sucursal=$_SESSION["sucursal"];

include("../php/conexion.php");
$connect = mysql_connect($hostname, $username, $password)
or die('Could not connect: ' . mysql_error());
//Select The database
$con = mysql_select_db($database, $connect);

$txtid_productoinventario=$_POST['txtid_productoinventario'];
$txtcantidad_contada=$_POST['txtcantidad_contada'];

$id_productob=0;

$rss = mysql_query("SELECT id_producto FROM tinventariof_productos where id_producto=\"$txtid_productoinventario\" and id_inventario=0");
if ($rows = mysql_fetch_row($rss)) {
$id_productob = trim($rows[0]);
}

$rstp = mysql_query("SELECT id_producto,cantidad_existencia FROM cproductos where id_producto=$txtid_productoinventario");
if ($rowstp = mysql_fetch_row($rstp)) {
$id_producto = trim($rowstp[0]);
$cantidad_existencia = trim($rowstp[1]);
}


if($id_productob==0)
	{
	
	$sql= mysql_query("insert into tinventariof_productos(id_producto,id_usuario,id_sucursal,cantidad_contada,cantidad_existencia) values(".$id_producto.",".$id_usuario.",".$id_sucursal.",".$txtcantidad_contada.",".$cantidad_existencia.")");
	$cad="insert into tinventariof_productos(id_producto,id_usuario,id_sucursal,cantidad_contada,cantidad_existencia) values(".$id_producto.",".$id_usuario.",".$id_sucursal.",".$txtcantidad_contada.",".$cantidad_existencia.")";
	//echo "Y";
	echo $cad;
	}
else
	{
	//echo "E";
	$cad="no se pudo";
	echo $cad;
	}
?>




