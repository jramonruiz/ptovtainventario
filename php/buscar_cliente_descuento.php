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

$txtcliente=utf8_decode($_POST['txtcliente']);
$txtid_areaventa=utf8_decode($_POST['txtid_areaventa']);

$rs = mysql_query("SELECT id_cliente,nombre_cliente,descuento,id_tipo_cliente FROM cclientes where nombre_cliente='$txtcliente'");
if ($row = mysql_fetch_row($rs)) {
$id_cliente = trim($row[0]);
$nombre_cliente = $row[1];
$descuento = trim($row[2]);
$id_tipo_cliente = trim($row[3]);
}

$sql= mysql_query("update careasventa set nombre_cliente=\"$nombre_cliente\",tipo_cliente=\"$id_tipo_cliente\" where id_area_venta=".$txtid_areaventa." and id_usuario=$id_usuario");

/************************** APLICAR DESCUENTOS A PRODUCTOS SEGUN EL TIPO DE CLIENTE *******************/

$listado=  mysql_query("select id_producto_venta,id_producto,cantidad,precio_venta from tproductos_venta where id_usuario=$id_usuario and id_venta=0 and id_area_venta=$txtid_areaventa");
	while($reg=  mysql_fetch_array($listado))
	    {
   			$id_producto_venta=mb_convert_encoding($reg['id_producto_venta'], "UTF-8");
   			$id_productotpv=mb_convert_encoding($reg['id_producto'], "UTF-8");
			$cantidadtpv=mb_convert_encoding($reg['cantidad'], "UTF-8");
			$precio_ventatpv=mb_convert_encoding($reg['precio_venta'], "UTF-8");	


			//// OBTENIENDO DESCUENTOS DE SALON Y MAYORISTA
			$rsspv = mysql_query("SELECT descto_salon,descto_mayorista FROM cproductos where id_producto=$id_productotpv");
			if ($rowspv = mysql_fetch_row($rsspv)) {
			$descto_salon = trim($rowspv[0]);
			$descto_mayorista = trim($rowspv[1]);
			}	

			if($id_tipo_cliente==1)
				{
					$txtdescuento_productomod=$descto_salon;
				}
			else if($id_tipo_cliente==2)
				{
					$txtdescuento_productomod=$descto_mayorista;
				}
			else
				{
					$txtdescuento_productomod=0;
				}

			/// ACTUALIZANDO LOS PRODUCTOS VENTA CON SUS TIPOS DE DESCUENTOS

			/*

			//$subtotal=$txtprecio_producto*$txtcantidad_productomod;
		$subtotal_sindescuento=$txtprecio_venta_mod*1;
		$desctotal=($subtotal_sindescuento*$txtdescuento_productomod)/100;
		$precio_neto=$txtprecio_venta_mod-$desctotal;

		$importe=$precio_neto*$txtcantidad_productomod;

			$sql= mysql_query("insert into tproductos_venta(subtotal,descuento,precio_neto,porcentaje_descuento) values($importe,$desctotal,$precio_neto,$txtdescuento_productomod)");*/

			//$subtotal=$txtprecio_producto*$txtcantidad_productomod;
			$subtotal_sindescuento=$precio_ventatpv*$cantidadtpv;
			$desctotal=($subtotal_sindescuento*$txtdescuento_productomod)/100;
			$precio_neto=$precio_ventatpv-$desctotal;

			$importe=$precio_neto*$cantidadtpv;

			$sql= mysql_query("update tproductos_venta set subtotal=\"$importe\",descuento=\"$desctotal\",precio_neto=\"$precio_neto\",porcentaje_descuento=\"$txtdescuento_productomod\" where id_producto_venta=".$id_producto_venta);



         }
/******************************************************************************************************/

echo "Y,".$id_cliente.",".$nombre_cliente.",".$descuento;	

?>




