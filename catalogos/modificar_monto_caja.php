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

$txtid_caja=$_POST['txtid_caja'];
$txtefectivo_caja=utf8_decode($_POST['txtefectivo_caja']);

$sql= mysql_query("update ccajas set efectivo_caja=$txtefectivo_caja,fecha_actualizacion=CURDATE() where id_caja=".$txtid_caja."");

//echo "Y";
$cadena="update ccajas set efectivo_caja=$txtefectivo_caja,fecha_actualizacion=CURDATE() where id_caja=".$txtid_caja."";
echo $cadena;

?>




