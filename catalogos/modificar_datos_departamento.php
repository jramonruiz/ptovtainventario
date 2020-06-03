<?php
include("../php/conexion.php");
$connect = mysql_connect($hostname, $username, $password)
or die('Could not connect: ' . mysql_error());
//Select The database
$con = mysql_select_db($database, $connect);

$txtdesc_departamento=utf8_decode($_POST['txtdesc_departamento']);
$txtid_departamento=$_POST['txtid_departamento'];

$sql= mysql_query("update cdepartamentos set desc_departamento=\"$txtdesc_departamento\",fecha_actualizacion=CURDATE() where id_departamento=".$txtid_departamento."");

echo "Y";
//$cadena="update cmarcas set descripcion_marca=\"$txtdescripcion_marca\" where id_marca=".$txtid_marca."";
//echo $cadena;

?>




