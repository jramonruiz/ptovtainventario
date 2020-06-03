<?php
include("../php/conexion.php");
$connect = mysql_connect($hostname, $username, $password)
or die('Could not connect: ' . mysql_error());
//Select The database
$con = mysql_select_db($database, $connect);

$txtnombre_unidad_medida=utf8_decode($_POST['txtnombre_unidad_medida']);
$txtid_unidad_medida=$_POST['txtid_unidad_medida'];

$sql= mysql_query("update cunidadesmedida set nombre_unidad_medida=\"$txtnombre_unidad_medida\",fecha_actualizacion=CURDATE() where id_unidad_medida=".$txtid_unidad_medida."");

echo "Y";
//$cadena="update cmarcas set descripcion_marca=\"$txtdescripcion_marca\" where id_marca=".$txtid_marca."";
//echo $cadena;

?>




