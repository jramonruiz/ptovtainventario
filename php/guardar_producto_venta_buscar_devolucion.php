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

$txtid_venta=$_POST['txtid_venta'];
$txtid_producto=utf8_decode($_POST['txtid_producto']);
$txtcantidad_producto=utf8_decode($_POST['txtcantidad_producto']);

$rs = mysql_query("SELECT * FROM cproductos where id_producto=$txtid_producto");
if ($row = mysql_fetch_row($rs)) {
$txtdescripcion_producto = trim($row[3]);
$txtcantidad_existencia_producto_buscar = trim($row[5]);
$txtprecio_producto = trim($row[9]);
}

$subtotal=$txtprecio_producto*$txtcantidad_producto;

//$sql= mysql_query("insert into tproductos_venta(descripcion_producto,cantidad,precio_venta,subtotal,id_usuario) values('".$txtdescripcion_producto."',".$txtcantidad_producto.",".$txtprecio_producto.",".$subtotal.",".$id_usuario.")");
$sql= mysql_query("insert into tproductos_venta(descripcion_producto,cantidad,precio_venta,subtotal,id_usuario) values(\"$txtdescripcion_producto\",$txtcantidad_producto,$txtprecio_producto,$subtotal,$id_usuario)");

/************** ACTUALIZANDO INVENTARIO ********/
$cantidad_existencia_nueva=$txtcantidad_existencia_producto_buscar-$txtcantidad_producto;

$sql2= mysql_query("update cproductos set cantidad_existencia=".$cantidad_existencia_nueva." where id_producto=".$txtid_producto."");


//$cadena="insert into tproductos_venta(descripcion_producto,cantidad,precio_venta,subtotal,id_usuario) values('".$txtdescripcion_producto."',".$txtcantidad_producto.",".$txtprecio_producto.",".$subtotal.",".$id_usuario.")";
	
//echo $cadena;

echo "Y,".$txtid_venta;

?>




