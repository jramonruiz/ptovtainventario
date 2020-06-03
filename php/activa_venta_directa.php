<?php
$tipusr="";
$paginterior=0;
include("../php/autentificacion.server.php");
session_name("lgsapplipweb");
session_start();
session_set_cookie_params(0, "/", $HTTP_SERVER_VARS["HTTP_HOST"], 0);

$id_usuario=$_SESSION["iduser"];
$txtid_areaventa=utf8_decode($_POST['txtid_areaventa']);
$txtventa_directa=utf8_decode($_POST['txtventa_directa']);

include("../php/conexion.php");
$connect = mysql_connect($hostname, $username, $password)
or die('Could not connect: ' . mysql_error());
//Select The database
$con = mysql_select_db($database, $connect);

$sql= mysql_query("update careasventa set venta_directa=".$txtventa_directa." where id_area_venta=".$txtid_areaventa." and id_usuario=".$id_usuario."");

$cad="update careasventa set venta_directa=".$txtventa_directa." where id_area_venta=".$txtid_areaventa." and id_usuario=".$id_usuario."";

//echo "1";
echo $cad;

?>




