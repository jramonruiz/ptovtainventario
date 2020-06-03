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

$txtdescripcion_productomode=utf8_decode($_POST['txtdescripcion_productomode']);
$txtcantidad_productomode=utf8_decode($_POST['txtcantidad_productomode']);

$rs = mysql_query("select id_producto_compra,cantidad_comprada,precio_compra,descuento from tproductos_compra where descripcion_producto='$txtdescripcion_productomode' and id_compra=0 and id_usuario=$id_usuario");
if ($row = mysql_fetch_row($rs)) {
$id_producto_compra = trim($row[0]);
$cantidad_comprada = trim($row[1]);
$precio_compra = trim($row[2]);
$descuento = trim($row[3]);
}

$cad1="select id_producto_venta,cantidad,precio_venta from tproductos_venta where descripcion_producto='$txtdescripcion_productomode' and id_venta=0 and id_usuario=$id_usuario'";

/********* MODIFICANDO INVENTARIO *************/
$rs2 = mysql_query("SELECT id_producto,descripcion,cantidad_existencia FROM cproductos where descripcion='$txtdescripcion_productomode'");
if ($row2 = mysql_fetch_row($rs2)) {
$id_producto_inventariom = trim($row2[0]);
$descripcion_inventario = trim($row2[1]);
$cantidad_existencia_inventario = trim($row2[2]);
}

$nvacantidad_inventario=$cantidad_existencia_inventario-1;

$nvacantidad=$cantidad_comprada-1;

if($nvacantidad<2)
{
  $sql= mysql_query("delete from tproductos_compra where id_producto_venta=$id_producto_compra");
}
else
{
	/*$sumavtasindesc=$precio_compra*$nvacantidad;
	$sumadesctos=$descuento*$nvacantidad;
	$subtotal=$sumavtasindesc-$sumadesctos;*/
	if($descuento=="" or $descuento==0)
		{
			$subtotal=$precio_compra;	
			$importe=$subtotal*$nvacantidad;
		}
		else
		{
			$porcentaje_descuento=$descuento/100;
			$monto_descuento=$precio_compra*$porcentaje_descuento;
			$subtotal=$precio_compra-$monto_descuento;
			$importe=$subtotal*$nvacantidad;
		}

	/*$porcentaje_descuento=$descuento/100;
	$monto_descuento=$precio_compra*$porcentaje_descuento;
	$subtotal=$precio_compra-$monto_descuento;
	$importe=$subtotal*$txtcantidad_productomodcom;*/
	//$subtotal=$precio_venta*$nvacantidad;
	$sql2= mysql_query("update tproductos_compra set cantidad_comprada=".$nvacantidad.",subtotal=".$subtotal.",importe=".$importe." where id_producto_compra=".$id_producto_compra."");
	$sql3= mysql_query("update cproductos set cantidad_existencia=".$nvacantidad_inventario." where id_producto=".$id_producto_inventariom."");
}

echo "1";
//echo $cad1;

?>




