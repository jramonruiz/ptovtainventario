<?php
include("conexion.php");
$connect = mysql_connect($hostname, $username, $password)
or die('Could not connect: ' . mysql_error());
//Select The database
$con = mysql_select_db($database, $connect);

$txtidproductonavegando=$_POST['txtidproductonavegando'];

/*********** BUSCANDO PRODUCTO A ELIMINAR ******/
$rs = mysql_query("SELECT descripcion_producto,cantidad FROM tproductos_venta where id_producto_venta=$txtidproductonavegando");
if ($row = mysql_fetch_row($rs)) {
$descripcion_producto = trim($row[0]);
$cantidad = trim($row[1]);
}
	
echo "1,".$descripcion_producto.",".$cantidad;
//echo $cadena;

?>




