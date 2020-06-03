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

/********************************************* TRANSACCION *****************************************/
$fecha_captura = date(d)."/".date(m)."/".date(Y);
$hora_captura = date(H).":".date(i).":".date(s);

$fecha=date(d)."/".date(m)."/".date(Y);  
$hora = date(H).":".date(i).":".date(s);
$aleatorio = rand(1,100);
$transaccion = $fecha.$hora.$aleatorio;
/****************************************************************************************************/

$txtnombre_proveedor=utf8_decode($_POST['txtnombre_proveedor']);
$txttotal_compra=utf8_decode($_POST['txttotal_compra']);
$txttipo_documento=utf8_decode($_POST['txttipo_documento']);
$txtfolio_documento=utf8_decode($_POST['txtfolio_documento']);


//$sql= mysql_query("insert into tventas(fecha_venta,total_venta,pago_venta,cambio_venta,id_usuario,descuento,total_pagar,folio_venta,nombre_cliente,id_tipo_pago,comision_banco) values(CURDATE(),".$txttotal_venta.",".$txtpago_venta.",".$cambio_venta.",".$id_usuario.",".$descuento.",".$totalpagar.",'".$transaccion."','".$txtnombre_cliente."',".$cmbtipo_cobro.",".$txtcomision.")");
$sql= mysql_query("insert into tcompras(fecha_compra,total_compra,id_usuario,folio_compra,nombre_proveedor,tipo_documento,folio_documento) values(CURDATE(),".$txttotal_compra.",".$id_usuario.",'".$transaccion."','".$txtnombre_proveedor."','".$txttipo_documento."','".$txtfolio_documento."')");

$rs = mysql_query("SELECT MAX(id_compra) AS id FROM tcompras");
if ($row = mysql_fetch_row($rs)) {
$id = trim($row[0]);
}

$sql2= mysql_query("update tproductos_compra set id_compra=".$id." where id_compra=0 and id_usuario=$id_usuario");


$cadena="insert into tcompras(fecha_compra,total_compra,id_usuario,folio_compra,nombre_proveedor) values(CURDATE(),".$txttotal_compra.",".$id_usuario.",'".$transaccion."','".$txtnombre_proveedor."')";
	
//echo $cadena;
echo "Y,".$id;

?>




