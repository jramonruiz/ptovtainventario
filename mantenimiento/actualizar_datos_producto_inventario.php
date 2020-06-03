<?php
include("../php/conexion.php");
$connect = mysql_connect($hostname, $username, $password)
or die('Could not connect: ' . mysql_error());
//Select The database
$con = mysql_select_db($database, $connect);

$txtid_producto_inventario_actualizar=$_POST['txtid_producto_inventario_actualizar'];
$cantidad_existencia=$_POST['cantidad_existencia'];
$txtcantidad_comprada=$_POST['txtcantidad_comprada'];

//$sql= mysql_query("update cmarcas set descripcion_marca='".$txtdescripcion_marca."' where id_marca=".$txtid_marca."");

$nueva_cantidad_existencia=$cantidad_existencia+$txtcantidad_comprada;

$sql= mysql_query("update cproductos set cantidad_existencia=".$nueva_cantidad_existencia.",cantidad_comprada=".$txtcantidad_comprada." where id_producto=".$txtid_producto_inventario_actualizar."");


//$cadena="update cmarcas set descripcion_marca='".$txtdescripcion_marca."' where id_marca=".$txtid_marca."";
	
echo "Y";
//echo $cadena;

?>




