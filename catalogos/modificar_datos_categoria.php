<?php
include("../php/conexion.php");
$connect = mysql_connect($hostname, $username, $password)
or die('Could not connect: ' . mysql_error());
//Select The database
$con = mysql_select_db($database, $connect);

$txtdesc_categoria=utf8_decode($_POST['txtdesc_categoria']);
$txtid_categoria=$_POST['txtid_categoria'];

$sql= mysql_query("update ccategorias set desc_categoria=\"$txtdesc_categoria\",fecha_actualizacion=CURDATE() where id_categoria=".$txtid_categoria."");

echo "Y";
//$cadena="update cmarcas set descripcion_marca=\"$txtdescripcion_marca\" where id_marca=".$txtid_marca."";
//echo $cadena;

?>




