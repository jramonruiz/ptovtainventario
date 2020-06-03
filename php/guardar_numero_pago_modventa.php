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

$txttotalpagar_modal=utf8_decode($_POST['txttotalpagar_modal']);
$txtimporte_recibido=utf8_decode($_POST['txtimporte_recibido']);
$txtmetodo_pago=utf8_decode($_POST['txtmetodo_pago']);
$txtreferencia=utf8_decode($_POST['txtreferencia']);
$txtdiferencia_pagar=utf8_decode($_POST['txtdiferencia_pagar']);
$txtid_areaventa=99;

/******** METODO DE PAGO ******/

$rsmp = mysql_query("SELECT id_metodo_pago from tmetodos_pago where desc_metodo_pago='$txtmetodo_pago'");
if ($rowmp = mysql_fetch_row($rsmp)) {
$id_metodo_pago = trim($rowmp[0]);
}


$sql= mysql_query("insert into tpagos_venta(id_tipo_pago,monto,id_area_venta,id_usuario,id_venta,referencia) values($id_metodo_pago,$txtimporte_recibido,$txtid_areaventa,$id_usuario,0,'".$txtreferencia."')");

$rs = mysql_query("SELECT SUM(monto) AS total_pago_capturado FROM tpagos_venta where id_usuario=$id_usuario and id_area_venta=$txtid_areaventa and id_venta=0");
if ($row = mysql_fetch_row($rs)) {
$total_pago_capturado = trim($row[0]);
}

/* ESTO ES EN UN DADO CASO SI HABRIA QUE CALCULAR LA DIFERENCIA
$cambioventa=$total_pago_capturado-$txtdiferencia_pagar;
*/

$cambioventa=$total_pago_capturado-$txttotalpagar_modal;

if($cambioventa<0)
	{
		$pp=1;
	}
else
	{
		$pp=0;
	}

echo "Y,".$pp.",".$cambioventa;

?>




