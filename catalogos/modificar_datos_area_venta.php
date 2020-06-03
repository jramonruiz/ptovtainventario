<?php
include("../php/conexion.php");
$connect = mysql_connect($hostname, $username, $password)
or die('Could not connect: ' . mysql_error());
//Select The database
$con = mysql_select_db($database, $connect);

$txtnombre_areaventa=utf8_decode($_POST['txtnombre_areaventa']);
$txtnombre_caja=$_POST['txtnombre_caja'];
$txtid_areaventa=utf8_decode($_POST['txtid_areaventa']);

$rsc = mysql_query("SELECT id_caja FROM ccajas where descripcion_caja=\"$txtnombre_caja\"");
if ($rowc = mysql_fetch_row($rsc)) {
$id_caja = trim($rowc[0]);
}

$sql= mysql_query("update careasventa set nombre_area=\"$txtnombre_areaventa\",id_caja=\"$id_caja\",fecha_actualizacion=CURDATE() where id_area_venta=".$txtid_areaventa."");

echo "Y";
//$cadena="update cmarcas set descripcion_marca=\"$txtdescripcion_marca\" where id_marca=".$txtid_marca."";
//echo $cadena;

?>




