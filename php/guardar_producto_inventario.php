<?php
$tipusr="";
$paginterior=0;
include("../php/autentificacion.server.php");
session_name("lgsapplipweb");
session_start();
session_set_cookie_params(0, "/", $HTTP_SERVER_VARS["HTTP_HOST"], 0);

$id_usuario=$_SESSION["iduser"];

include("conexion.php");
$connect = mysql_connect($hostname, $username, $password)
or die('Could not connect: ' . mysql_error());
//Select The database
$con = mysql_select_db($database, $connect);

$txtid_producto=utf8_decode($_POST['txtid_producto']);
$txtcantidad_producto=utf8_decode($_POST['txtcantidad_producto']);
$txtnombre_usuario=utf8_decode($_POST['txtnombre_usuario']);
$txtfecha_captura=utf8_decode($_POST['txtfecha_captura']);

$rs = mysql_query("SELECT * FROM cproductos where id_producto=$txtid_producto");
if ($row = mysql_fetch_row($rs)) {
$codigo_barras = trim($row[2]);
$descripcion_producto = trim($row[3]);
$cantidad_existencia = trim($row[5]);
}

$id_producto_buscar=0;

$rs2 = mysql_query("SELECT id_producto_inventario FROM tinventario_producto where codigo_barras='$codigo_barras' and fecha_actualizacion='$txtfecha_captura'");
if ($row2 = mysql_fetch_row($rs2)) {
$id_producto_buscar = trim($row2[0]);
}

if($id_producto_buscar==0)
{
	$sql= mysql_query("insert into tinventario_producto(codigo_barras,descripcion,fecha_actualizacion,id_usuario_actualizo,cantidad_contada,cantidad_existencia) values(\"$codigo_barras\",\"$descripcion_producto\",\"$txtfecha_captura\",$id_usuario,$txtcantidad_producto,$cantidad_existencia)");
}
else
{
	$sql= mysql_query("update tinventario_producto set cantidad_contada=".$txtcantidad_producto." where id_producto_inventario=".$id_producto_buscar."");
}


$sql2= mysql_query("update cproductos set cantidad_contada=".$txtcantidad_producto.",fecha_actualizacion='".$txtfecha_captura."',id_usuario_actualizo=".$id_usuario." where id_producto=".$txtid_producto."");


//$cadena="SELECT id_producto_inventario FROM tinventario_producto where codigo_barras='$codigo_barras' and fecha_actualizacion='$txtfecha_captura'";
	
//echo $cadena;

echo "Y";

?>




