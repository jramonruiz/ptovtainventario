<?php
include("conexion.php");
$connect = mysql_connect($hostname, $username, $password)
or die('Could not connect: ' . mysql_error());
//Select The database
$con = mysql_select_db($database, $connect);

$id_producto_eliminar=$_POST['txtid_producto_buscar'];

$sql= mysql_query("delete from tinventariof_productos where id_inventario_producto=$id_producto_eliminar and id_inventario=0 and id_sucursal=1");

$cadena="delete from tinventariof_productos where id_inventario_producto=$id_producto_eliminar and id_inventario=0 and id_sucursal=1";
	
//echo "Y";
echo $cadena;

?>




