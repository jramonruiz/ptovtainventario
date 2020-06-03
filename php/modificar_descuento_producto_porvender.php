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

$txtdescripcion_productomoddescuento=utf8_decode($_POST['txtdescripcion_productomoddescuento']);
$txtdescuento_productomoddesc=utf8_decode($_POST['txtdescuento_productomoddesc']);
$txtid_areaventa=utf8_decode($_POST['txtid_areaventa']);

$rs = mysql_query("select id_producto_venta,cantidad,precio_venta,descuento from tproductos_venta where descripcion_producto='$txtdescripcion_productomoddescuento' and id_venta=0 and id_usuario=$id_usuario and id_area_venta=$txtid_areaventa");
if ($row = mysql_fetch_row($rs)) {
$id_producto_venta = trim($row[0]);
$cantidad = trim($row[1]);
$precio_venta = trim($row[2]);
$descuento = trim($row[3]);
}

$cad1="select id_producto_venta,cantidad,precio_venta from tproductos_venta where descripcion_producto='$txtdescripcion_productomode' and id_venta=0 and id_usuario=$id_usuario'";


$montodescuento=($precio_venta*$txtdescuento_productomoddesc)/100;

$nuevoprecioneto=$precio_venta-$montodescuento;

$nuevoimporte=$nuevoprecioneto*$cantidad;

	//$subtotal=$precio_venta*$nvacantidad;descuento,precio_neto,porcentaje_descuento
	$sql2= mysql_query("update tproductos_venta set subtotal=".$nuevoimporte.",descuento=".$montodescuento.",precio_neto=".$nuevoprecioneto.",porcentaje_descuento=".$txtdescuento_productomoddesc." where id_producto_venta=".$id_producto_venta."");


echo "1";
//echo $cad1;

?>




