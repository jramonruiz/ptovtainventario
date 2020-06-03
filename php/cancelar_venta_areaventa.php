<?php
$tipusr="";
$paginterior=0;
include("autentificacion.server.php");
session_name("lgsapplipweb");
session_start();
session_set_cookie_params(0, "/", $HTTP_SERVER_VARS["HTTP_HOST"], 0);

$id_usuario=$_SESSION["iduser"];

include("conexion.php");
$connect = mysql_connect($hostname, $username, $password)
or die('Could not connect: ' . mysql_error());
//Select The database
$con = mysql_select_db($database, $connect);
//mysql_query("SET NAMES 'utf8'");

$txtid_areaventa=utf8_decode($_POST['txtid_areaventa']);

$rspv = mysql_query("select id_producto,cantidad from tproductos_venta where id_area_venta=$txtid_areaventa and id_venta=0 and id_usuario=$id_usuario");
if ($rowpv = mysql_fetch_row($rspv)) {
$id_producto = trim($rowpv[0]);
$cantidad = trim($rowpv[1]);
}

/********* MODIFICANDO INVENTARIO *************/
	$rs2 = mysql_query("SELECT id_producto,cantidad_existencia FROM cproductos where id_producto=$id_producto");
		if ($row2 = mysql_fetch_row($rs2)) 
			{
				$id_producto_inventariom = trim($row2[0]);
				$cantidad_existencia_inventario = trim($row2[1]);
			}

	$nvacantidad_inventario=$cantidad_existencia_inventario+$cantidad;

	$sql3= mysql_query("update cproductos set cantidad_existencia=".$nvacantidad_inventario." where id_producto=".$id_producto_inventariom."");

$sql= mysql_query("delete from tproductos_venta where id_area_venta=$txtid_areaventa and id_venta=0 and id_usuario=$id_usuario");

$sqlavact= mysql_query("update careasventa set enuso=0,id_usuario=0,tipo_operacion=1,nombre_cliente='',total_venta=0.00,venta_directa=0,tipo_cliente=0 where id_area_venta=$txtid_areaventa and enuso=1");

$rsav = mysql_query("select * from careasventa WHERE enuso=1 and id_usuario=$id_usuario order by id_area_venta limit 1");
if ($rowav = mysql_fetch_row($rsav)) {
$id_area_venta_uso = trim($rowav[0]);
$nombre_area_venta = trim($rowav[1]);
}


if($id_area_venta_uso=="" or $id_area_venta_uso==NULL)
	{
		//$id_area_venta_uso=0;

		$rsav2 = mysql_query("select * from careasventa WHERE enuso=0 order by id_area_venta limit 1");
		if ($rowav2 = mysql_fetch_row($rsav2)) {
		$id_area_venta_uso = trim($rowav2[0]);
		$nombre_area_venta = trim($rowav2[1]);
		}

		$sqlavact= mysql_query("update careasventa set enuso=1,id_usuario=$id_usuario where id_area_venta=$id_area_venta_uso");

	}


	echo "Y,".$id_area_venta_uso;
	
?>