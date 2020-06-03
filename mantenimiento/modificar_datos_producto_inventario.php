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

$txtid_producto_inventario_modificar=utf8_decode($_POST['txtid_producto_inventario_modificar']);
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
$txtprecio_neto=utf8_decode($_POST['txtprecio_neto']);
$txtprecio_venta=utf8_decode($_POST['txtprecio_venta']);
$txtlote=utf8_decode($_POST['txtlote']);
$txtnumero_serie=utf8_decode($_POST['txtnumero_serie']);
$txtfechacaducidad=utf8_decode($_POST['datepicker1']);
$txtobservaciones=utf8_decode($_POST['txtobservaciones']);
$txtporcentaje_ganancia=utf8_decode($_POST['txtporcentaje_ganancia']);

$hoy = date("Y-m-d"); 

if($txtfechacaducidad=="")
	{
		$txtfechacaducidad=$hoy;
	}
//$cmbsucursal=utf8_decode($_POST['cmbsucursal']);
//$txtdescuento_salon=utf8_decode($_POST['txtdescuento_salon']);
//$txtdescuento_mayorista=utf8_decode($_POST['txtdescuento_mayorista']);


//id_producto,id_proveedor,codigo_barras,descripcion,id_marca,cantidad_existencia,caducidad,precio_compra,precio_venta,stock_minimo,stock_maximo,fecha_actualizacion,estatus,id_tipo,id_categoria,id_departamento,id_ubicacion,id_unidad_compra,id_impuesto,costo_neto,lote,numero_serie,observaciones,impuesto_dinero,id_sucursal

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


$sql= mysql_query("update cproductos set id_proveedor=$cmbproveedor,codigo_barras=\"$txtcodigo_barras\",descripcion=\"$txtdescripcion_producto\",id_marca=$cmbmarca,cantidad_existencia=$txtcantidad_existencia,precio_compra=$txtprecio_compra,precio_venta=$txtprecio_venta,stock_minimo=$txtstock_minimo,stock_maximo=$txtstock_maximo,unidad=$cmbunidadmedida,caducidad=\"$txtfechacaducidad\",fecha_actualizacion=CURDATE(),id_categoria=$cmbcategoria,id_departamento=$cmbdepartamento,id_ubicacion=$cmbubicacion,id_unidad_compra=$cmbunidadcompra,costo_neto=$costo_neto,lote=\"$txtlote\",numero_serie=\"$txtnumero_serie\",observaciones=\"$txtobservaciones\",impuesto_dinero=$impuesto_dinero,porcentaje_ganancia=$txtporcentaje_ganancia where id_producto=".$txtid_producto_inventario_modificar."");

//$sql2= mysql_query("delete from tfotos_producto where id_usuario=$id_usuario");

//$cadena="update cmarcas set descripcion_marca='".$txtdescripcion_marca."' where id_marca=".$txtid_marca."";
	
//echo "Y";

$cadena="update cproductos set id_proveedor=$cmbproveedor,codigo_barras=\"$txtcodigo_barras\",descripcion=\"$txtdescripcion_producto\",id_marca=$cmbmarca,cantidad_existencia=$txtcantidad_existencia,precio_compra=$txtprecio_compra,precio_venta=$txtprecio_venta,stock_minimo=$txtstock_minimo,stock_maximo=$txtstock_maximo,unidad=$cmbunidadmedida,caducidad=\"$txtfechacaducidad\",fecha_actualizacion=CURDATE(),id_categoria=$cmbcategoria,id_departamento=$cmbdepartamento,id_ubicacion=$cmbubicacion,id_unidad_compra=$cmbunidadcompra,costo_neto=$costo_neto,lote=\"$txtlote\",numero_serie=\"$txtnumero_serie\",observaciones=\"$txtobservaciones\",impuesto_dinero=$impuesto_dinero,porcentaje_ganancia=$txtporcentaje_ganancia where id_producto=".$txtid_producto_inventario_modificar."";

echo $cadena;

?>




