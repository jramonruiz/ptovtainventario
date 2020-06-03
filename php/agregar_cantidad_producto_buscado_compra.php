<?php
$tipusr="";
$paginterior=0;
include("autentificacion.server.php");
session_name("lgsapplipweb");
session_start();
session_set_cookie_params(0, "/", $HTTP_SERVER_VARS["HTTP_HOST"], 0);

$id_usuario=$_SESSION["iduser"];
$id_sucursal=$_SESSION["sucursal"];

include("conexion.php");
$connect = mysql_connect($hostname, $username, $password)
or die('Could not connect: ' . mysql_error());
//Select The database
$con = mysql_select_db($database, $connect);

$txtid_productomodcom=utf8_decode($_POST['txtid_producto']);
$txtcantidad_productomodcom=utf8_decode($_POST['txtcantidad_productobuslis']);
$txtprecio_compra_modcom=utf8_decode($_POST['txtprecio_compra_modcom']);
//$txtnuevo_precio_compra_modcom=utf8_decode($_POST['txtnuevo_precio_compra_modcom']);
//$txtdescuento_productomodcom=utf8_decode($_POST['txtdescuento_productomodcom']);
$txtdescuento_productomodcom=0;
//$txtprecio_venta_modcom=utf8_decode($_POST['txtprecio_venta_modcom']);

$rs = mysql_query("SELECT * FROM cproductos where id_producto=$txtid_productomodcom");
if ($row = mysql_fetch_row($rs)) {
$txtdescripcion_producto = trim($row[3]);
$txtcantidad_existencia_producto_buscar = trim($row[5]);
$txtprecio_compra_ultimo = trim($row[7]);
$txtprecio_venta_modcom = trim($row[8]);
}

//$subtotal=$txtprecio_producto*$txtcantidad_productomod;
if($txtdescuento_productomodcom=="" or $txtdescuento_productomodcom==0)
{
	$subtotal=$txtprecio_compra_ultimo;	
	$importe=$subtotal*$txtcantidad_productomodcom;
}
else
{
	$porcentaje_descuento=$txtdescuento_productomodcom/100;
	$monto_descuento=$txtprecio_compra_ultimo*$porcentaje_descuento;
	$subtotal=$txtprecio_compra_ultimo-$monto_descuento;
	$importe=$subtotal*$txtcantidad_productomodcom;
}


//$sql= mysql_query("insert into tproductos_venta(descripcion_producto,cantidad,precio_venta,subtotal,id_usuario) values('".$txtdescripcion_producto."',".$txtcantidad_producto.",".$txtprecio_producto.",".$subtotal.",".$id_usuario.")");
$sql= mysql_query("insert into tproductos_compra(descripcion_producto,precio_compra,cantidad_comprada,subtotal,id_usuario,id_producto,ultimo_precio_compra,id_sucursal,descuento,importe) values(\"$txtdescripcion_producto\",$txtprecio_compra_ultimo,$txtcantidad_productomodcom,$subtotal,$id_usuario,$txtid_productomodcom,$txtprecio_compra_ultimo,$id_sucursal,$txtdescuento_productomodcom,$importe)");

/************** ACTUALIZANDO INVENTARIO ********/

$cantidad_existencia_nueva=$txtcantidad_existencia_producto_buscar+$txtcantidad_productomodcom;

$sql2= mysql_query("update cproductos set cantidad_existencia=".$cantidad_existencia_nueva.",precio_compra=".$txtprecio_compra_ultimo.",precio_venta=".$txtprecio_venta_modcom." where id_producto=".$txtid_productomodcom."");


//$cadena="insert into tproductos_venta(descripcion_producto,cantidad,precio_venta,subtotal,id_usuario) values('".$txtdescripcion_producto."',".$txtcantidad_producto.",".$txtprecio_producto.",".$subtotal.",".$id_usuario.")";
	
//echo $cadena;

echo "1";

?>