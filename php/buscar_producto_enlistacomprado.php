<?php
include("conexion.php");
$connect = mysql_connect($hostname, $username, $password)
or die('Could not connect: ' . mysql_error());
//Select The database
$con = mysql_select_db($database, $connect);

$txtidproductonavegando=$_POST['txtidproductonavegando'];

/*********** BUSCANDO PRODUCTO A ELIMINAR ******/
$rs = mysql_query("SELECT descripcion_producto,cantidad_comprada FROM tproductos_compra where id_producto_compra=$txtidproductonavegando");
if ($row = mysql_fetch_row($rs)) {
$descripcion_producto = utf8_encode($row[0]);
$cantidad_comprada = trim($row[1]);
}
	
echo "1,".$descripcion_producto.",".$cantidad_comprada;
//echo $cadena;

?>




