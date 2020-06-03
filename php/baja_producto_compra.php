<?php
include("conexion.php");
$connect = mysql_connect($hostname, $username, $password)
or die('Could not connect: ' . mysql_error());
//Select The database
$con = mysql_select_db($database, $connect);

$id_producto_eliminar=$_POST['txtid_producto_buscar'];

/*********** BUSCANDO PRODUCTO A ELIMINAR ******/
$rs = mysql_query("SELECT descripcion_producto,cantidad_comprada FROM tproductos_compra where id_producto_compra=$id_producto_eliminar");
if ($row = mysql_fetch_row($rs)) {
$descripcion_producto = trim($row[0]);
$cantidad_comprada = trim($row[1]);
}
/*************************************************/


/********* MODIFICANDO INVENTARIO *************/
$rs2 = mysql_query("SELECT id_producto,descripcion,cantidad_existencia FROM cproductos where descripcion='$descripcion_producto'");
if ($row2 = mysql_fetch_row($rs2)) {
$id_producto = trim($row2[0]);
$descripcion = trim($row2[1]);
$cantidad_existencia = trim($row2[2]);
}

$nueva_existencia=$cantidad_existencia-$cantidad_comprada;

$sql2= mysql_query("update cproductos set cantidad_existencia=".$nueva_existencia." where id_producto=".$id_producto."");


/**********************************************/

$sql= mysql_query("delete from tproductos_compra where id_producto_compra=$id_producto_eliminar");

//$cadena="delete from cmarcas where id_marca=$id_marca";
	
echo "Y";
//echo $cadena;

?>




