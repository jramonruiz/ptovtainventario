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

$txttotal_venta=utf8_decode($_POST['txttotal_venta']);
//$descuento=$_POST['descuento'];
$txttotalpagar=utf8_decode($_POST['txttotalpagar']);
$txtpago_venta=utf8_decode($_POST['txtpago_venta']);
$cambio_venta=utf8_decode($_POST['txtcambio_venta']);
$txtnombre_cliente=utf8_decode($_POST['txtnombre_cliente']);
$txtiva=utf8_decode($_POST['txtiva']);
//$cmbtipo_cobro=$_POST['cmbtipo_cobro'];
//$txtcomision=$_POST['txtcomision'];

/************** SI NO HAY NOMBRE DEL CLIENTE ****************/
if($txtnombre_cliente=="")
	{
		$txtnombre_cliente="PUBLICO EN GENERAL";
	}
	
/*********************************************************/

//$sql= mysql_query("insert into tventas(fecha_venta,total_venta,pago_venta,cambio_venta,id_usuario,descuento,total_pagar,folio_venta,nombre_cliente,id_tipo_pago,comision_banco) values(CURDATE(),".$txttotal_venta.",".$txtpago_venta.",".$cambio_venta.",".$id_usuario.",".$descuento.",".$totalpagar.",'".$transaccion."','".$txtnombre_cliente."',".$cmbtipo_cobro.",".$txtcomision.")");
$sql= mysql_query("insert into tventas(fecha_venta,total_venta,pago_venta,cambio_venta,id_usuario,total_pagar,folio_venta,nombre_cliente,iva) values(CURDATE(),".$txttotal_venta.",".$txtpago_venta.",".$cambio_venta.",".$id_usuario.",".$txttotalpagar.",'".$transaccion."','".$txtnombre_cliente."',".$txtiva.")");

$rs = mysql_query("SELECT MAX(id_venta) AS id FROM tventas");
if ($row = mysql_fetch_row($rs)) {
$id = trim($row[0]);
}

$sql2= mysql_query("update tproductos_venta set id_venta=".$id." where id_venta=0 and id_usuario=$id_usuario");


$cadena="insert into tventas(fecha_venta,total_venta,pago_venta,cambio_venta,id_usuario,total_pagar,folio_venta,nombre_cliente,iva) values(CURDATE(),".$txttotal_venta.",".$txtpago_venta.",".$cambio_venta.",".$id_usuario.",".$txttotalpagar.",'".$transaccion."','".$txtnombre_cliente."',".$txtiva.")";
	
//echo $cadena;
echo "Y,".$id;

?>




