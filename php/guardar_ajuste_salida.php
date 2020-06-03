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

$txttotalpagar_modal=utf8_decode($_POST['txttotalpagar_modal']);
$txtreferencia=utf8_decode($_POST['txtreferencia']);
$txttotal_venta=$txttotalpagar_modal;
$txtimporte_recibido=$txttotalpagar_modal;
$txtcambio_ventamodal=0.00;
$id_metodo_pago=1;
$txtcliente="AJUSTE DE SALIDA";
$txtiva=0.00;
$descpor=0;
$txtdescuento_venta=0;
$pagada_totalmente=1;
$txtid_areaventa=utf8_decode($_POST['txtid_areaventa']);

$sql= mysql_query("insert into tventas(fecha_venta,total_venta,pago_venta,cambio_venta,id_usuario,total_pagar,folio_venta,id_tipo_pago,nombre_cliente,iva,descuento,porcentaje_descuento,pagado_totalmente,tipo_operacion,referencia) values(CURDATE(),".$txttotal_venta.",".$txtimporte_recibido.",".$txtcambio_ventamodal.",".$id_usuario.",".$txttotalpagar_modal.",'".$transaccion."',".$id_metodo_pago.",'".$txtcliente."',".$txtiva.",".$descpor.",".$txtdescuento_venta.",".$pagada_totalmente.",2,'".$txtreferencia."')");

$rs = mysql_query("SELECT MAX(id_venta) AS id FROM tventas");
if ($row = mysql_fetch_row($rs)) {
$id = trim($row[0]);
}

$sql2= mysql_query("update tproductos_venta set id_venta=".$id.",id_area_venta=0 where id_venta=0 and id_usuario=$id_usuario and id_area_venta=$txtid_areaventa");

$sql2av= mysql_query("update careasventa set enuso=0 where id_area_venta=$txtid_areaventa");


$cadena="insert into tventas(fecha_venta,total_venta,pago_venta,cambio_venta,id_usuario,total_pagar,folio_venta,id_tipo_pago,nombre_cliente,iva) values(CURDATE(),".$txttotal_venta.",".$txtimporte_recibido.",".$txtcambio_ventamodal.",".$id_usuario.",".$txttotalpagar_modal.",'".$transaccion."',".$id_metodo_pago.",'".$txtnombre_cliente."',".$txtiva.")";
	
//echo $cadena;
echo "Y,".$id;

?>




