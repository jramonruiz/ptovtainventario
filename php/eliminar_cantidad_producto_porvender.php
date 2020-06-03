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
$txtid_areaventa=utf8_decode($_POST['txtid_areaventa']);

$rs = mysql_query("select id_producto_venta,cantidad,precio_venta,descuento from tproductos_venta where descripcion_producto='$txtdescripcion_productomode' and id_venta=0 and id_usuario=$id_usuario and id_area_venta=$txtid_areaventa");
if ($row = mysql_fetch_row($rs)) {
$id_producto_venta = trim($row[0]);
$cantidad = trim($row[1]);
$precio_venta = trim($row[2]);
$descuento = trim($row[3]);
}

$cad1="select id_producto_venta,cantidad,precio_venta from tproductos_venta where descripcion_producto='$txtdescripcion_productomode' and id_venta=0 and id_usuario=$id_usuario'";

if($txtcantidad_productomode>$cantidad)
	{
		$error=1;
	}
else
	{
		$error=0;
	}

if($error==0)
	{
		/********* MODIFICANDO INVENTARIO *************/
		$rs2 = mysql_query("SELECT id_producto,descripcion,cantidad_existencia FROM cproductos where descripcion='$txtdescripcion_productomode'");
		if ($row2 = mysql_fetch_row($rs2)) {
		$id_producto_inventariom = trim($row2[0]);
		$descripcion_inventario = trim($row2[1]);
		$cantidad_existencia_inventario = trim($row2[2]);
		}

		/*$nvacantidad_inventario=$cantidad_existencia_inventario+1;
		$nvacantidad=$cantidad-1;*/

		$nvacantidad_inventario=$cantidad_existencia_inventario+$txtcantidad_productomode;
		$nvacantidad=$cantidad-$txtcantidad_productomode;

		if($nvacantidad<1)
		{
		  $sql= mysql_query("delete from tproductos_venta where id_producto_venta=$id_producto_venta");
		}
		else
		{
			$sumavtasindesc=$precio_venta*$nvacantidad;
			$sumadesctos=$descuento*$nvacantidad;
			$subtotal=$sumavtasindesc-$sumadesctos;
			//$subtotal=$precio_venta*$nvacantidad;
			$sql2= mysql_query("update tproductos_venta set cantidad=".$nvacantidad.",subtotal=".$subtotal." where id_producto_venta=".$id_producto_venta."");
			$sql3= mysql_query("update cproductos set cantidad_existencia=".$nvacantidad_inventario." where id_producto=".$id_producto_inventariom."");
		}

		echo "1";
		//echo $cad1;
	}
else
	{
		echo "0";
	}

?>




