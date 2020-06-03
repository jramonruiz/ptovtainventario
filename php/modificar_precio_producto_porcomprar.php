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

$txtdescripcion_productomodprecio=utf8_decode($_POST['txtdescripcion_productomodprecio']);
$txtprecio_productomodprec=utf8_decode($_POST['txtprecio_productomodprec']);

$rs = mysql_query("select id_producto_compra,cantidad_comprada,precio_compra,descuento from tproductos_compra where descripcion_producto='$txtdescripcion_productomodprecio' and id_compra=0 and id_usuario=$id_usuario");
if ($row = mysql_fetch_row($rs)) {
$id_producto_compra = trim($row[0]);
$cantidad_comprada = trim($row[1]);
$precio_compra = trim($row[2]);
$descuento = trim($row[3]);
}


if($descuento=="" or $descuento==0)
		{
			$subtotal=$txtprecio_productomodprec;	
			$importe=$subtotal*$cantidad_comprada;
		}
		else
		{
			$porcentaje_descuento=$descuento/100;
			$monto_descuento=$txtprecio_productomodprec*$porcentaje_descuento;
			$subtotal=$txtprecio_productomodprec-$monto_descuento;
			$importe=$subtotal*$nvacantidad;
		}

	//$subtotal=$precio_venta*$nvacantidad;descuento,precio_neto,porcentaje_descuento
	$sql2= mysql_query("update tproductos_compra set precio_compra=".$txtprecio_productomodprec.",subtotal=".$subtotal.",importe=".$importe." where id_producto_compra=".$id_producto_compra."");

	$sql3= mysql_query("update cproductos set precio_compra=".$txtprecio_productomodprec." where id_producto=".$id_producto_inventariom."");

$cad1="update tproductos_compra set precio_compra=".$txtprecio_productomodprec.",subtotal=".$subtotal.",importe=".$importe." where id_producto_venta=".$id_producto_venta."";	


//echo "1";
echo $cad1;

?>




