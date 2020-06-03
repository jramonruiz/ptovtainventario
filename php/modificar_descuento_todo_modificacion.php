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

$txtdescuento_todo=utf8_decode($_POST['txtdescuento_todo']);
//$txtid_areaventa=utf8_decode($_POST['txtid_areaventa']);


$listado=  mysql_query("select id_producto_venta,cantidad,precio_venta,descuento from tproductos_venta where id_usuario=".$id_usuario." and id_venta=0 and id_area_venta=0");
		while($reg=  mysql_fetch_array($listado))
			{
   				$id_producto_venta=mb_convert_encoding($reg['id_producto_venta'], "UTF-8");
				$cantidad=mb_convert_encoding($reg['cantidad'], "UTF-8");
				$precio_venta=mb_convert_encoding($reg['precio_venta'], "UTF-8");	
				$descuento=mb_convert_encoding($reg['descuento'], "UTF-8");	

				$montodescuento=($precio_venta*$txtdescuento_todo)/100;
				$nuevoprecioneto=$precio_venta-$montodescuento;
				$nuevoimporte=$nuevoprecioneto*$cantidad;

				//$subtotal=$precio_venta*$nvacantidad;descuento,precio_neto,porcentaje_descuento
				/*$sql2= mysql_query("update tproductos_venta set subtotal=".$nuevoimporte.",descuento=".$montodescuento.",precio_neto=".$nuevoprecioneto.",porcentaje_descuento=".$txtdescuento_productomoddesc." where id_producto_venta=".$id_producto_venta."");*/


				$sql2= mysql_query("update tproductos_venta set subtotal=".$nuevoimporte.",descuento=".$montodescuento.",precio_neto=".$nuevoprecioneto.",porcentaje_descuento=".$txtdescuento_todo." where id_producto_venta=".$id_producto_venta);

			}

			//$cad1="update tproductos_venta set subtotal=".$nuevoimporte.",descuento=".$montodescuento.",precio_neto=".$nuevoprecioneto.",porcentaje_descuento=".$txtdescuento_todo." where id_producto_venta=".$id_producto_venta;

echo "1";
//echo $cad1;

?>




