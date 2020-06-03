<?php
include("../php/conexion.php");
$connect = mysql_connect($hostname, $username, $password)
or die('Could not connect: ' . mysql_error());
//Select The database
$con = mysql_select_db($database, $connect);

$txtnombre_metodo_pago=utf8_decode($_POST['txtnombre_metodo_pago']);
$txtid_metodo_pago=$_POST['txtid_metodo_pago'];

$sql= mysql_query("update tmetodos_pago set desc_metodo_pago=\"$txtnombre_metodo_pago\" where id_metodo_pago=".$txtid_metodo_pago."");

echo "Y";
//$cadena="update cmarcas set descripcion_marca=\"$txtdescripcion_marca\" where id_marca=".$txtid_marca."";
//echo $cadena;

?>




