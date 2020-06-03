<?php
include("../php/conexion.php");
$connect = mysql_connect($hostname, $username, $password)
or die('Could not connect: ' . mysql_error());
//Select The database
$con = mysql_select_db($database, $connect);

$txtdescripcion_marca=utf8_decode($_POST['txtnombre_marca']);
$txtid_marca=$_POST['txtid_marca'];

$sql= mysql_query("update cmarcas set descripcion_marca=\"$txtdescripcion_marca\" where id_marca=".$txtid_marca."");

echo "Y";
//$cadena="update cmarcas set descripcion_marca=\"$txtdescripcion_marca\" where id_marca=".$txtid_marca."";
//echo $cadena;

?>




