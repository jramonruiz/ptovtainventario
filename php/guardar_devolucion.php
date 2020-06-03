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

//$descuento=$_POST['descuento'];
$txtticket_venta=$_POST['txtticket_venta'];
$txtid_venta=$_POST['txtid_venta'];
$txtdiferencia=utf8_decode($_POST['txtdiferencia']);
$txtpago_venta=utf8_decode($_POST['txtpago_venta']);
$cambio_venta=utf8_decode($_POST['txtcambio_venta']);
$txtnombre_cliente=utf8_decode($_POST['txtnombre_cliente']);
$txtimporte_devolver=utf8_decode($_POST['txtimporte_devolver']);
$iva=0.00;
//$cmbtipo_cobro=$_POST['cmbtipo_cobro'];
//$txtcomision=$_POST['txtcomision'];

/************** SI NO HAY NOMBRE DEL CLIENTE ****************/
if($txtnombre_cliente=="")
	{
		$txtnombre_cliente="PUBLICO EN GENERAL";
	}
	
/*********************************************************/

//$sql= mysql_query("insert into tventas(fecha_venta,total_venta,pago_venta,cambio_venta,id_usuario,descuento,total_pagar,folio_venta,nombre_cliente,id_tipo_pago,comision_banco) values(CURDATE(),".$txttotal_venta.",".$txtpago_venta.",".$cambio_venta.",".$id_usuario.",".$descuento.",".$totalpagar.",'".$transaccion."','".$txtnombre_cliente."',".$cmbtipo_cobro.",".$txtcomision.")");
$sql= mysql_query("insert into tventas(fecha_venta,total_venta,pago_venta,cambio_venta,id_usuario,total_pagar,folio_venta,nombre_cliente,iva,devolucion) values(CURDATE(),".$txtdiferencia.",".$txtpago_venta.",".$cambio_venta.",".$id_usuario.",".$txtdiferencia.",'".$transaccion."','".$txtnombre_cliente."',".$iva.",1)");

$rs = mysql_query("SELECT MAX(id_venta) AS id FROM tventas");
if ($row = mysql_fetch_row($rs)) {
$id = trim($row[0]);
}

$sql2= mysql_query("update tproductos_venta set id_venta=".$id." where id_venta=0 and id_usuario=$id_usuario");

$sql2venta= mysql_query("update tventas set realizo_devolucion=1 where id_venta=".$txtid_venta."");

/******************** GUARDANDO DEVOLUCION ****************************************************/

$sqldev= mysql_query("insert into tdevoluciones(fecha_devolucion,total_pagar,id_usuario,folio_devolucion,ticket_venta_relacion,nombre_cliente) values(CURDATE(),".$txtimporte_devolver.",".$id_usuario.",'".$transaccion."','".$txtticket_venta."','".$txtnombre_cliente."')");

$rsdev = mysql_query("SELECT MAX(id_devolucion) AS id FROM tdevoluciones");
if ($rowdev = mysql_fetch_row($rsdev)) {
$iddev = trim($rowdev[0]);
}

$sql2dev= mysql_query("update tproductos_devolucion set id_devolucion=".$iddev." where id_devolucion=0 and id_usuario=$id_usuario");



$cadena="insert into tventas(fecha_venta,total_venta,pago_venta,cambio_venta,id_usuario,total_pagar,folio_venta,nombre_cliente) values(CURDATE(),".$txttotal_venta.",".$txtpago_venta.",".$cambio_venta.",".$id_usuario.",".$txttotalpagar.",'".$transaccion."','".$txtnombre_cliente."')";
	
//echo $cadena;
echo "Y,".$iddev;

?>




