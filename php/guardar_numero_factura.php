<?php
include("../php/conexion.php");
$connect = mysql_connect($hostname, $username, $password)
or die('Could not connect: ' . mysql_error());
//Select The database
$con = mysql_select_db($database, $connect);

$txtid_venta=utf8_decode($_POST['txtid_venta']);
$txtnumero_factura=utf8_decode($_POST['txtnumero_factura']);
$fecha_factura=$_POST['datepicker1'];

$sql= mysql_query("update tventas set numero_factura=\"$txtnumero_factura\",fecha_factura=\"$fecha_factura\" where id_venta=".$txtid_venta."");

echo "Y";
//$cadena="update cmarcas set descripcion_marca=\"$txtdescripcion_marca\" where id_marca=".$txtid_marca."";
//echo $cadena;

?>




