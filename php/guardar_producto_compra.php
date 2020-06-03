<?php
$tipusr="";
$paginterior=0;
include("../php/autentificacion.server.php");
session_name("lgsapplipweb");
session_start();
session_set_cookie_params(0, "/", $HTTP_SERVER_VARS["HTTP_HOST"], 0);

$id_usuario=$_SESSION["iduser"];

include("conexion.php");
$connect = mysql_connect($hostname, $username, $password)
or die('Could not connect: ' . mysql_error());
//Select The database
$con = mysql_select_db($database, $connect);

$txtid_producto=utf8_decode($_POST['txtid_producto']);
$txtcantidad_comprar=utf8_decode($_POST['txtcantidad_comprar']);
$txtprecio_compra=utf8_decode($_POST['txtprecio_compra']);

$rs = mysql_query("SELECT * FROM cproductos where id_producto=$txtid_producto");
if ($row = mysql_fetch_row($rs)) {
$txtdescripcion_producto_buscar = trim($row[3]);
$txtcantidad_existencia_producto_buscar = trim($row[5]);
}

$subtotal=$txtprecio_compra*$txtcantidad_comprar;

//$sql= mysql_query("insert into tproductos_venta(descripcion_producto,cantidad,precio_venta,subtotal,id_usuario) values('".$txtdescripcion_producto."',".$txtcantidad_producto.",".$txtprecio_producto.",".$subtotal.",".$id_usuario.")");
$sql= mysql_query("insert into tproductos_compra(id_compra,descripcion_producto,precio_compra,cantidad_comprada,subtotal,id_usuario) values(0,\"$txtdescripcion_producto_buscar\",$txtprecio_compra,$txtcantidad_comprar,$subtotal,$id_usuario)");

/************** ACTUALIZANDO INVENTARIO ********/
$cantidad_existencia_nueva=$txtcantidad_existencia_producto_buscar+$txtcantidad_comprar;

$sql2= mysql_query("update cproductos set cantidad_existencia=".$cantidad_existencia_nueva.",precio_compra=".$txtprecio_compra." where id_producto=".$txtid_producto."");


//$cadena="insert into tproductos_venta(descripcion_producto,cantidad,precio_venta,subtotal,id_usuario) values('".$txtdescripcion_producto."',".$txtcantidad_producto.",".$txtprecio_producto.",".$subtotal.",".$id_usuario.")";
	
//echo $cadena;

echo "Y";

?>




