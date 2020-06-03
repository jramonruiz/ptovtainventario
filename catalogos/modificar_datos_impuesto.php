<?php
include("../php/conexion.php");
$connect = mysql_connect($hostname, $username, $password)
or die('Could not connect: ' . mysql_error());
//Select The database
$con = mysql_select_db($database, $connect);

$txtnombre_impuesto=utf8_decode($_POST['txtnombre_impuesto']);
$txtporcentaje=utf8_decode($_POST['txtporcentaje']);
$txtid_impuesto=$_POST['txtid_impuesto'];

$sql= mysql_query("update cimpuestos set nombre_impuesto=\"$txtnombre_impuesto\",porcentaje_impuesto=\"$txtporcentaje\",fecha_actualizacion=CURDATE() where id_impuesto=".$txtid_impuesto."");

echo "Y";
//$cadena="update cmarcas set descripcion_marca=\"$txtdescripcion_marca\" where id_marca=".$txtid_marca."";
//echo $cadena;

?>




