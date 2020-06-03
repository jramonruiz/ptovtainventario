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

$id_producto_eliminar=$_POST['txtid_producto_buscar'];
$txtid_venta=$_POST['txtid_venta'];

/*********** BUSCANDO PRODUCTO A ELIMINAR ******/
$rs = mysql_query("SELECT descripcion_producto,cantidad FROM tproductos_venta where id_producto_venta=$id_producto_eliminar and id_venta=$txtid_venta");
if ($row = mysql_fetch_row($rs)) {
$descripcion_producto = trim($row[0]);
}
/*************************************************/


/********* MODIFICANDO INVENTARIO *************/
$rs2 = mysql_query("SELECT id_producto,descripcion,cantidad_existencia,precio_venta FROM cproductos where descripcion='$descripcion_producto'");
if ($row2 = mysql_fetch_row($rs2)) {
$id_producto = trim($row2[0]);
$descripcion = trim($row2[1]);
$cantidad_existencia = trim($row2[2]);
$precio_venta = trim($row2[3]);
}

$nueva_existencia=$cantidad_existencia+1;

$sql2= mysql_query("update cproductos set cantidad_existencia=".$nueva_existencia." where id_producto=".$id_producto."");


/**********************************************/

$sqlpd= mysql_query("insert into tproductos_devolucion(id_venta,descripcion_producto,cantidad,precio_venta,subtotal,id_usuario) values($txtid_venta,\"$descripcion\",1,$precio_venta,$precio_venta,$id_usuario)");


//$cadena="delete from cmarcas where id_marca=$id_marca";
	
echo "Y";
//echo $cadena;

?>




