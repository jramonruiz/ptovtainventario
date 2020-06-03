<?php
$tipusr="";
$paginterior=0;
include("../php/autentificacion.server.php");
session_name("lgsapplipweb");
session_start();
session_set_cookie_params(0, "/", $HTTP_SERVER_VARS["HTTP_HOST"], 0);

$id_usuario=$_SESSION["iduser"];

include("../php/conexion.php");
$connect = mysql_connect($hostname, $username, $password)
or die('Could not connect: ' . mysql_error());
//Select The database
$con = mysql_select_db($database, $connect);

$txtdescripcion_caja=utf8_decode($_POST['txtdescripcion_caja']);
$txtnombre_sucursal=utf8_decode($_POST['txtnombre_sucursal']);
$txtid_caja=$_POST['txtid_caja'];
$txtefectivo_caja=utf8_decode($_POST['txtefectivo_caja']);

$rss = mysql_query("SELECT id_sucursal FROM csucursales where descripcion_sucursal=\"$txtnombre_sucursal\"");
if ($rows = mysql_fetch_row($rss)) {
$id_sucursal = trim($rows[0]);
}

$sql= mysql_query("update ccajas set descripcion_caja=\"$txtdescripcion_caja\",efectivo_caja=$txtefectivo_caja,fecha_actualizacion=CURDATE(),id_usuario=$id_usuario,id_sucursal=$id_sucursal where id_caja=".$txtid_caja."");

echo "Y";
//$cadena="update cmarcas set descripcion_marca=\"$txtdescripcion_marca\" where id_marca=".$txtid_marca."";
//echo $cadena;

?>




