<?php
$tipusr="";
$paginterior=0;
include("autentificacion.server.php");
session_name("lgsapplipweb");
session_start();
session_set_cookie_params(0, "/", $HTTP_SERVER_VARS["HTTP_HOST"], 0);

$id_usuario=$_SESSION["iduser"];
$nombre_usuario=$_SESSION["nombre_usuario"];

include("conexion.php");
$connect = mysql_connect($hostname, $username, $password)
or die('Could not connect: ' . mysql_error());
//Select The database
$con = mysql_select_db($database, $connect);

$txtnumero_productos_inventaridado=utf8_decode($_POST['txtnumero_productos_inventaridado']);

/********************************************* TRANSACCION *****************************************/
$fecha_captura = date(d)."/".date(m)."/".date(Y);
$hora_captura = date(H).":".date(i).":".date(s);

$fecha=date(d)."/".date(m)."/".date(Y);  
$hora = date(H).":".date(i).":".date(s);
$aleatorio = rand(1,100);
$transaccion = $fecha.$hora.$aleatorio;
/****************************************************************************************************/

$sql= mysql_query("insert into tinventario_fecha(fecha_actualizacion,id_usuario_actualizo,nombre_usuario_actualizo,inventariados,folio_inventario) values(CURDATE(),".$id_usuario.",'".$nombre_usuario."',".$txtnumero_productos_inventaridado.",'".$transaccion."')");

$rs = mysql_query("SELECT MAX(id_inventario) AS id FROM tinventario_fecha");
if ($row = mysql_fetch_row($rs)) {
$id = trim($row[0]);
}

$sql2= mysql_query("update tinventario_producto set id_inventario=".$id." where id_inventario=0 and id_usuario_actualizo=$id_usuario");

$sql3= mysql_query("update cproductos set cantidad_contada=0");


$cadena="insert into tventas(fecha_venta,total_venta,pago_venta,cambio_venta,id_usuario,total_pagar,folio_venta,nombre_cliente) values(CURDATE(),".$txttotal_venta.",".$txtpago_venta.",".$cambio_venta.",".$id_usuario.",".$txttotalpagar.",'".$transaccion."','".$txtnombre_cliente."')";
	
//echo $cadena;
echo "Y,".$id;

?>




