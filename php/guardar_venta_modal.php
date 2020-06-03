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

/********************************************* TRANSACCION *****************************************/
$fecha_captura = date(d)."/".date(m)."/".date(Y);
$hora_captura = date(H).":".date(i).":".date(s);

$fecha=date(d)."/".date(m)."/".date(Y);  
$hora = date(H).":".date(i).":".date(s);
$aleatorio = rand(1,100);
$transaccion = $fecha.$hora.$aleatorio;
/****************************************************************************************************/

$txttotal_venta=utf8_decode($_POST['txttotal_venta']);
$txtmetodo_pago=utf8_decode($_POST['txtmetodo_pago']);
$txtreferencia=utf8_decode($_POST['txtreferencia']);
//$descuento=$_POST['descuento'];
$txttotalpagar_modal=utf8_decode($_POST['txttotalpagar_modal']);
$txtimporte_recibido=utf8_decode($_POST['txtimporte_recibido']);
$txtcambio_ventamodal=utf8_decode($_POST['txtcambio_ventamodal']);
//////////////////////////////////////////////////////////////////$txtcliente=utf8_decode($_POST['txtcliente']);
$txtiva=utf8_decode($_POST['txtiva']);
$txtdescuento_venta=utf8_decode($_POST['txtdescuento_porcentaje']);
//////////////////////////////////////////////////////////////////$cmbtipo_operacion=utf8_decode($_POST['cmbtipo_operacion']);
$txtid_areaventa=utf8_decode($_POST['txtid_areaventa']);
//$cmbtipo_cobro=$_POST['cmbtipo_cobro'];
//$txtcomision=$_POST['txtcomision'];
$cmbtipo_operacionsel=utf8_decode($_POST['cmbtipo_operacionsel']);

/******** NUMERO FOLIO A INICIAR Y ESTADO SI YA INICIO ******/

$rsfi = mysql_query("SELECT numero_folio_iniciar,inicio_ejercicio from ccajas where id_caja=1");
if ($rowfi = mysql_fetch_row($rsfi)) {
$numero_folio_iniciar = trim($rowfi[0]);
$inicio_ejercicio = trim($rowfi[1]);
}



/******** METODO DE PAGO ******/

$rsmp = mysql_query("SELECT id_metodo_pago from tmetodos_pago where desc_metodo_pago='$txtmetodo_pago'");
if ($rowmp = mysql_fetch_row($rsmp)) {
$id_metodo_pago = trim($rowmp[0]);
}

/******************************/

/************** OBTENIENDO TIPO OPERACION Y NOMBRE DEL CLIENTE EN careasventa ****************/
$rstoc = mysql_query("SELECT cav.nombre_cliente,cav.tipo_operacion,cc.descuento from careasventa cav inner join cclientes cc on cav.nombre_cliente=cc.nombre_cliente where cav.id_area_venta=$txtid_areaventa and cav.id_usuario=$id_usuario");
if ($rowtoc = mysql_fetch_row($rstoc)) {
$txtcliente = trim($rowtoc[0]);
$cmbtipo_operacion = trim($rowtoc[1]);
$descpor = trim($rowtoc[2]);
$txtcliente2=$txtcliente;
}


if($txtcliente=="")
	{
		$txtcliente="PUBLICO EN GENERAL";
		//$txtimporte_recibido=0.00;
		$rsavtp = mysql_query("SELECT tipo_operacion from careasventa where id_area_venta=$txtid_areaventa and id_usuario=$id_usuario");
		if ($rowavtp = mysql_fetch_row($rsavtp)) {
		$cmbtipo_operacion = trim($rowavtp[0]);
		$txtdescuento_venta=0;
		}
	}
	
/*********************************************************/

/************** VER SI ES UNA VENTA CONCLUIDA ****************/
if(($txtcambio_ventamodal==0 or $txtcambio_ventamodal>0) and $id_metodo_pago!=4)
	{
		$pagada_totalmente=1;
	}
else
	{
		$pagada_totalmente=0;
		$txtcambio_ventamodal=0.00;
		$txtimporte_recibido=0.00;
	}
	
/*********************************************************/


$txttotal_venta=$txttotal_venta+$txtiva;

$descpor=($txttotal_venta*$txtdescuento_venta)/100;
$totvtadescto=$txttotalpagar_modal-$descpor;


$descpor=0;
$txtdescuento_venta=0;

if($inicio_ejercicio==1)
	{
		$folioempresa=$numero_folio_iniciar;
		$sqlfe= mysql_query("update ccajas set inicio_ejercicio=0 where id_caja=1");
	}
else
	{	
		$rsumf = mysql_query("SELECT MAX(id_venta) AS id FROM tventas");
		if ($rowuvf = mysql_fetch_row($rsumf)) {
		$iduvf = trim($rowuvf[0]);
		}

		$rsobtuf = mysql_query("SELECT folioempresa FROM tventas where id_venta=$iduvf");
		if ($rowobtuf = mysql_fetch_row($rsobtuf)) {
		$folioempresa = trim($rowobtuf[0]);
		}		

		$folioempresa=$folioempresa+1;

		$sqlfe= mysql_query("update ccajas set inicio_ejercicio=0 where id_caja=1");
	}


$sql= mysql_query("insert into tventas(fecha_venta,total_venta,pago_venta,cambio_venta,id_usuario,total_pagar,folio_venta,id_tipo_pago,nombre_cliente,iva,descuento,porcentaje_descuento,pagado_totalmente,tipo_operacion,referencia,id_sucursal,folioempresa) values(CURDATE(),".$txttotal_venta.",".$txtimporte_recibido.",".$txtcambio_ventamodal.",".$id_usuario.",".$txttotalpagar_modal.",'".$transaccion."',".$id_metodo_pago.",'".$txtcliente."',".$txtiva.",".$descpor.",".$txtdescuento_venta.",".$pagada_totalmente.",".$cmbtipo_operacionsel.",'".$txtreferencia."',".$id_sucursal.",".$folioempresa.")");

$rs = mysql_query("SELECT MAX(id_venta) AS id FROM tventas");
if ($row = mysql_fetch_row($rs)) {
$iduv = trim($row[0]);
}

$sql2= mysql_query("update tproductos_venta set id_venta=".$iduv.",id_area_venta=0 where id_venta=0 and id_usuario=$id_usuario and id_area_venta=$txtid_areaventa");

$sql3avpv= mysql_query("update tpagos_venta set id_venta=$iduv where id_area_venta=$txtid_areaventa and id_usuario=$id_usuario and id_venta=0");

$sql2av= mysql_query("update careasventa set enuso=0,tipo_operacion=1,nombre_cliente='',total_venta=0.00,venta_directa=0,tipo_cliente=0 where id_area_venta=$txtid_areaventa");

// OBTENIENDO EL ULTIMO ID QUE Y TIPO DE OPERACION QUE NO ESTE EN MERMA
$rstotreg = mysql_query("select COUNT(id_venta) as totreg from tventas where id_sucursal=$id_sucursal and merma=0 and tipo_operacion=$cmbtipo_operacion");
if ($rowtotreg = mysql_fetch_row($rstotreg)) {
	$totreg = trim($rowtotreg[0]);
	$id=$totreg+1;
}


$cadena="insert into tventas(fecha_venta,total_venta,pago_venta,cambio_venta,id_usuario,total_pagar,folio_venta,id_tipo_pago,nombre_cliente,iva,descuento,porcentaje_descuento,pagado_totalmente,tipo_operacion,referencia,id_sucursal,folioempresa) values(CURDATE(),".$txttotal_venta.",".$txtimporte_recibido.",".$txtcambio_ventamodal.",".$id_usuario.",".$txttotalpagar_modal.",'".$transaccion."',".$id_metodo_pago.",'".$txtcliente."',".$txtiva.",".$descpor.",".$txtdescuento_venta.",".$pagada_totalmente.",".$cmbtipo_operacionsel.",'".$txtreferencia."',".$id_sucursal.",".$folioempresa.")";
	
//echo $cadena;
echo "Y,".$id.",".$cmbtipo_operacion.",".$iduv;

?>