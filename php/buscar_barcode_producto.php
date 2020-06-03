<?php
include("conexion.php");
session_name("lgsapplipweb");
session_start();
session_set_cookie_params(0, "/", $HTTP_SERVER_VARS["HTTP_HOST"], 0);

$id_usuario=$_SESSION["iduser"];
$id_sucursal=$_SESSION["sucursal"];

$connect = mysql_connect($hostname, $username, $password)
or die('Could not connect: ' . mysql_error());
//Select The database
$con = mysql_select_db($database, $connect);
mysql_query("SET NAMES 'utf8'");

$txtproductodesc=$_POST['txtproductodesc'];

$id_producto_buscar=0;

$rs = mysql_query("SELECT id_producto,codigo_barras FROM cproductos where descripcion='$txtproductodesc' and id_sucursal=$id_sucursal");
if ($row = mysql_fetch_row($rs)) {
$id_producto_buscar = trim($row[0]);
$codigo_barras = trim($row[1]);
}

if($id_producto_buscar!=0)
	{
		/*$subtotal=$precio_venta*1;
		$sql= mysql_query("insert into tproductos_venta(descripcion_producto,cantidad,precio_venta,subtotal,id_usuario) values(\"$descripcion\",1,$precio_venta,$subtotal,$id_usuario)");
		/************** ACTUALIZANDO INVENTARIO ********/
		/*$cantidad_existencia_nueva=$cantidad_existencia-1;
		$sql2= mysql_query("update cproductos set cantidad_existencia=".$cantidad_existencia_nueva." where id_producto=".$id_producto_buscar."");*/
		//echo "Y,".$id_producto_buscar.",".$codigo_barras;
		echo "1,".$codigo_barras;		
	}
else
	{
		echo "0";
	}		
?>




