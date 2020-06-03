<?php
$tipusr="";
$paginterior=0;
include("autentificacion.server.php");
session_name("lgsapplipweb");
session_start();
session_set_cookie_params(0, "/", $HTTP_SERVER_VARS["HTTP_HOST"], 0);

$id_usuario=$_SESSION["iduser"];
$nombre_usuario=$_SESSION["nombre_usuario"];
$id_sucursal=$_SESSION["sucursal"];

include("conexion.php");
$connect = mysql_connect($hostname, $username, $password)
or die('Could not connect: ' . mysql_error());
//Select The database
$con = mysql_select_db($database, $connect);

$txtnumero_productos_inventaridado=utf8_decode($_POST['txtnumero_productos_inventaridado']);

$sql= mysql_query("insert into tinventario_fisico(id_usuario,fecha_inventario,hora_inventario,id_sucursal,numero_productos_inven) values(".$id_usuario.",CURDATE(),CURTIME(),".$id_sucursal.",".$txtnumero_productos_inventaridado.")");

$rs = mysql_query("SELECT MAX(id_inventario_fisico) AS id FROM tinventario_fisico where id_sucursal=$id_sucursal");
if ($row = mysql_fetch_row($rs)) {
$id = trim($row[0]);
}

$sql2= mysql_query("update tinventariof_productos set id_inventario=".$id." where id_inventario=0 and id_sucursal=$id_sucursal");

echo "Y";

?>




