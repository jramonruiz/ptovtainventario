<?php
include("../php/conexion.php");
$connect = mysql_connect($hostname, $username, $password)
or die('Could not connect: ' . mysql_error());
//Select The database
$con = mysql_select_db($database, $connect);

$txtnombre_ubicacion=utf8_decode($_POST['txtnombre_ubicacion']);
$txtid_ubicacion=$_POST['txtid_ubicacion'];

$sql= mysql_query("update cubicaciones set nombre_ubicacion=\"$txtnombre_ubicacion\",fecha_actualizacion=CURDATE() where id_ubicacion=".$txtid_ubicacion."");

echo "Y";
//$cadena="update cmarcas set descripcion_marca=\"$txtdescripcion_marca\" where id_marca=".$txtid_marca."";
//echo $cadena;

?>




