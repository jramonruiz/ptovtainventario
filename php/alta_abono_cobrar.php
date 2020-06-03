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

$txtid_venta=utf8_decode($_POST['txtid_venta']);
$txttipo_pago=utf8_decode($_POST['txttipo_pago']);
$txtimporte_abono=utf8_decode($_POST['txtimporte_abono']);
$txtcomentario=utf8_decode($_POST['txtcomentario']);

//$pagado=$txtfaltante_pagar-$txtimporte_abono;

//ttabonos_cpagar = id_cuenta_pagar,fecha,id_tipo_pago,importe,comentario,pagado

$rspro = mysql_query("SELECT id_metodo_pago FROM tmetodos_pago where desc_metodo_pago=\"$txttipo_pago\"");
if ($rowpro = mysql_fetch_row($rspro)) {
$id_metodo_pago = trim($rowpro[0]);
}

$rsvta = mysql_query("SELECT total_pagar FROM tventas where id_venta=\"$txtid_venta\"");
if ($rowvta = mysql_fetch_row($rsvta)) {
$total_pagar = trim($rowvta[0]);
}

$fecha_hoy = date('Y-m-d');
$proximo_pago = strtotime ( '+30 day' , strtotime ( $fecha_hoy ) ) ;
$proximo_pago = date ( 'Y-m-d' , $proximo_pago );

$sql= mysql_query("insert into tabonos_ccobrar(id_venta,fecha,id_tipo_pago,importe,comentario,proximo_pago) VALUES (\"$txtid_venta\",CURDATE(),\"$id_metodo_pago\",\"$txtimporte_abono\",\"$txtcomentario\",\"$proximo_pago\",\"$id_usuario\")");

							$rssumabon = mysql_query("select SUM(importe) as importetotabon from tabonos_ccobrar where id_venta=$txtid_venta");
                            if ($rowsumabon = mysql_fetch_row($rssumabon)) {
                            $importetotabon = trim($rowsumabon[0]);
                            }

                            $faltante_pagar=$total_pagar-$importetotabon;

                        /* if($faltante_pagar==$total_pagar)
                         	{
                         		$faltante_pagar=$total_pagar-$txtimporte_abono;
                         	}
                         else
                         	{
                         		$faltante_pagar=$total_pagar-$importetotabon;
                         	}*/

      $cadena="insert into tabonos_ccobrar(id_venta,fecha,id_tipo_pago,importe,comentario,proximo_pago) VALUES (\"$txtid_venta\",CURDATE(),\"$id_metodo_pago\",\"$txtimporte_abono\",\"$txtcomentario\",\"$proximo_pago\")";                      


if($faltante_pagar<1)
{
$sql2= mysql_query("update tventas set pagado_totalmente=1 where id_venta=".$txtid_venta."");
//$sql3= mysql_query("update tabonos_ccobrar set pagado=$faltante_pagar where id_venta=".$txtid_venta."");
}
else
{
//$sql2= mysql_query("update tcuentas_pagar set faltante_pagar=\"$pagado\",fecha_pago=\"$txtfecha_proximo_pago\" where id_cuenta_pagar=".$txtid_cuenta_pagar."");
//$sql3= mysql_query("update tabonos_ccobrar set pagado=$faltante_pagar where id_venta=".$txtid_venta."");
	$otracondicion="";
}

	echo "Y";
    //echo $cadena;
?>