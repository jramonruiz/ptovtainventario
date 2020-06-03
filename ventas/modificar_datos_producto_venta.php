<?php
include("../php/conexion.php");
$connect = mysql_connect($hostname, $username, $password)
or die('Could not connect: ' . mysql_error());
//Select The database
$con = mysql_select_db($database, $connect);

$txtid_producto_venta_modificar=utf8_decode($_POST['txtid_producto_venta_modificar']);
$txtcantidad_actual=utf8_decode($_POST['txtcantidad_actual']);
$txtcantidad_nueva=utf8_decode($_POST['txtcantidad_nueva']);
$txtdescripcion=utf8_decode($_POST['txtdescripcion']);
$precio_venta=utf8_decode($_POST['precio_venta']);

/********* BUSCANDO PRODUCTO INVENTARIO *************/
$rs2 = mysql_query("SELECT id_producto,descripcion,cantidad_existencia FROM cproductos where descripcion='$txtdescripcion'");
if ($row2 = mysql_fetch_row($rs2)) {
$id_producto = trim($row2[0]);
$descripcion = trim($row2[1]);
$cantidad_existencia = trim($row2[2]);
}

/***********************************************/

if($txtcantidad_actual>$txtcantidad_nueva)
	{
		$diferencia=$txtcantidad_actual-$txtcantidad_nueva;
		$nueva_cantidad=$cantidad_existencia+$diferencia;	
		$sql2= mysql_query("update cproductos set cantidad_existencia=".$nueva_cantidad." where id_producto=".$id_producto."");	
	}
else
	{
		$diferencia=$txtcantidad_nueva-$txtcantidad_actual;
		$nueva_cantidad=$cantidad_existencia-$diferencia;	
		$sql2= mysql_query("update cproductos set cantidad_existencia=".$nueva_cantidad." where id_producto=".$id_producto."");			
	}
	
$subtotal_nuevo=$precio_venta*$txtcantidad_nueva;	

$sql= mysql_query("update tproductos_venta set cantidad=".$txtcantidad_nueva.",subtotal=".$subtotal_nuevo." where id_producto_venta=".$txtid_producto_venta_modificar."");


//$cadena="update cmarcas set descripcion_marca='".$txtdescripcion_marca."' where id_marca=".$txtid_marca."";
	
echo "Y";
//echo $cadena;

?>




