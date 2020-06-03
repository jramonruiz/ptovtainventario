<?php
$tipusr="";
$paginterior=0;
include("../php/autentificacion.server.php");
session_name("lgsapplipweb");
session_start();
session_set_cookie_params(0, "/", $HTTP_SERVER_VARS["HTTP_HOST"], 0);

$id_usuario=$_SESSION["iduser"];

include("../php/conexion.php");
$connect = mysql_connect($hostname, $username, $password)
or die('Could not connect: ' . mysql_error());
//Select The database
$con = mysql_select_db($database, $connect);

$txtcodigo_barras=utf8_decode($_POST['txtcodigo_barras']);
$txtdescripcion_producto=utf8_decode($_POST['txtdescripcion_producto']);
//$cmbtipo=utf8_decode($_POST['cmbtipo']);
$cmbcategoria=utf8_decode($_POST['cmbcategoria']);
$cmbdepartamento=utf8_decode($_POST['cmbdepartamento']);
$cmbubicacion=utf8_decode($_POST['cmbubicacion']);
$cmbunidadmedida=utf8_decode($_POST['cmbunidadmedida']);
$cmbunidadcompra=utf8_decode($_POST['cmbunidadcompra']);
$cmbproveedor=utf8_decode($_POST['cmbproveedor']);
$cmbmarca=utf8_decode($_POST['cmbmarca']);
$txtcantidad_existencia=utf8_decode($_POST['txtcantidad_existencia']);
$txtstock_minimo=utf8_decode($_POST['txtstock_minimo']);
$txtstock_maximo=utf8_decode($_POST['txtstock_maximo']);
$txtprecio_compra=utf8_decode($_POST['txtprecio_compra']);
//$cmbimpuesto=utf8_decode($_POST['cmbimpuesto']);
//$txtprecio_neto=utf8_decode($_POST['txtprecio_neto']);
$txtprecio_venta=utf8_decode($_POST['txtprecio_venta']);
$txtlote=utf8_decode($_POST['txtlote']);
$txtnumero_serie=utf8_decode($_POST['txtnumero_serie']);
$txtfechacaducidad=utf8_decode($_POST['datepicker1']);
$txtobservaciones=utf8_decode($_POST['txtobservaciones']);
$txtporcentaje_ganancia=utf8_decode($_POST['txtporcentaje_ganancia']);
//$cmbsucursal=utf8_decode($_POST['cmbsucursal']);
//$txtdescuento_salon=utf8_decode($_POST['txtdescuento_salon']);
//$txtdescuento_mayorista=utf8_decode($_POST['txtdescuento_mayorista']);

$id_producto=0;

$rs = mysql_query("SELECT id_producto FROM cproductos where descripcion=\"$txtdescripcion_producto\" and codigo_barras=\"$txtcodigo_barras\" and id_sucursal=1");
if ($row = mysql_fetch_row($rs)) {
$id_producto = trim($row[0]);
}

if($id_producto==0)
	{

//IMPUESTO_DINERO IVA
		$rsimp = mysql_query("SELECT porcentaje_impuesto FROM cimpuestos where id_impuesto=1");
					if ($rowimp = mysql_fetch_row($rsimp)) 
					{
					$porcentaje_impuesto = trim($rowimp[0]);
					}
					
		$porimp=$porcentaje_impuesto/100;
		$impuesto_dinero=$txtprecio_compra*$porimp;

		// COSTO_NETO
		$costo_neto=$txtprecio_compra+$impuesto_dinero;



$sql= mysql_query("insert into cproductos(id_proveedor,codigo_barras,descripcion,id_marca,cantidad_existencia,caducidad,precio_compra,precio_venta,stock_minimo,stock_maximo,unidad,fecha_actualizacion,id_categoria,id_departamento,id_ubicacion,id_unidad_compra,costo_neto,lote,numero_serie,observaciones,impuesto_dinero,porcentaje_ganancia) values($cmbproveedor,\"$txtcodigo_barras\",\"$txtdescripcion_producto\",$cmbmarca,$txtcantidad_existencia,\"$txtfechacaducidad\",$txtprecio_compra,$txtprecio_venta,$txtstock_minimo,$txtstock_maximo,$cmbunidadmedida,CURDATE(),$cmbcategoria,$cmbdepartamento,$cmbubicacion,$cmbunidadcompra,$costo_neto,\"$txtlote\",\"$txtnumero_serie\",\"$txtobservaciones\",$impuesto_dinero,$txtporcentaje_ganancia)");

$cadena="insert into cproductos(id_proveedor,codigo_barras,descripcion,id_marca,cantidad_existencia,caducidad,precio_compra,precio_venta,stock_minimo,stock_maximo,unidad,fecha_actualizacion,id_categoria,id_departamento,id_ubicacion,id_unidad_compra,costo_neto,lote,numero_serie,observaciones,impuesto_dinero,porcentaje_ganancia) values($cmbproveedor,\"$txtcodigo_barras\",\"$txtdescripcion_producto\",$cmbmarca,$txtcantidad_existencia,\"$txtfechacaducidad\",$txtprecio_compra,$txtprecio_venta,$txtstock_minimo,$txtstock_maximo,$cmbunidadmedida,CURDATE(),$cmbcategoria,$cmbdepartamento,$cmbubicacion,$cmbunidadcompra,$costo_neto,\"$txtlote\",\"$txtnumero_serie\",\"$txtobservaciones\",$impuesto_dinero,$txtporcentaje_ganancia)";

	echo "Y";

	}
else
	{
	echo "E";
	}

	//echo $cadena;

?>




