<?php
$tipusr="";
$paginterior=0;
include("autentificacion.server.php");
session_name("lgsapplipweb");
session_start();
session_set_cookie_params(0, "/", $HTTP_SERVER_VARS["HTTP_HOST"], 0);

$id_usuario=$_SESSION["iduser"];
$id_sucursal=$_SESSION["sucursal"];

include("conexion.php");
$connect = mysql_connect($hostname, $username, $password)
or die('Could not connect: ' . mysql_error());
//Select The database
$con = mysql_select_db($database, $connect);

$txtmotivo_retiro=utf8_decode($_POST['txtmotivo_retiro']);
$txtimporte_retirar=utf8_decode($_POST['txtimporte_retirar']);


$sql= mysql_query("insert into tretiros(motivo_retirar,monto_retirar,id_usuario,fecha_retiro,hora_retiro,id_sucursal) values(\"$txtmotivo_retiro\",$txtimporte_retirar,$id_usuario,CURDATE(),CURTIME(),$id_sucursal)");

$rs = mysql_query("SELECT MAX(id_retiro) AS id FROM tretiros");
if ($row = mysql_fetch_row($rs)) {
$id = trim($row[0]);
}

echo "1,".$id;

?>




