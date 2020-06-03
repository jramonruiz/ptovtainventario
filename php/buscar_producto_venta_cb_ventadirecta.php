<?php
include("conexion.php");
session_name("lgsapplipweb");
session_start();
session_set_cookie_params(0, "/", $HTTP_SERVER_VARS["HTTP_HOST"], 0);

$id_usuario=$_SESSION["iduser"];
$id_sucursal=$_SESSION["sucursal"];

$connect = mysql_connect($hostname, $username, $password)
or die('Could not connect: ' . mysql_error());
//Select The database
$con = mysql_select_db($database, $connect);
mysql_query("SET NAMES 'utf8'");

$txtcodigobp=utf8_decode($_POST['txtproductodesc']);
$txtid_areaventa=utf8_decode($_POST['txtid_areaventa']);
$txttipo_cliente=utf8_decode($_POST['txttipo_cliente']);


$id_producto_buscar=0;
$id_producto_vendido_buscado=0;

$rs = mysql_query("SELECT id_producto FROM cproductos where codigo_barras='$txtcodigobp' and id_sucursal=$id_sucursal");
if ($row = mysql_fetch_row($rs)) {
$id_producto_buscar = trim($row[0]);
}

$rspvb = mysql_query("SELECT id_producto,cantidad FROM tproductos_venta where id_producto=$id_producto_buscar and id_venta=0 and id_usuario=$id_usuario and id_area_venta=$txtid_areaventa");
if ($rowpvb = mysql_fetch_row($rspvb)) {
$id_producto_vendido_buscado = trim($rowpvb[0]);
$cantidad_producto_vendido_buscado = trim($rowpvb[1]);
}


if($id_producto_buscar!=0)
	{
		if($id_producto_vendido_buscado==0)
		{
				$rs11 = mysql_query("SELECT id_producto,descripcion,cantidad_existencia,precio_venta,descto_salon,descto_mayorista FROM cproductos where id_producto=$id_producto_buscar and id_sucursal=$id_sucursal");
				if ($row11 = mysql_fetch_row($rs11)) {
				$id_producto_vendido_buscado = trim($row11[0]);
				$descripcion_producto = utf8_decode($row11[1]);
				$cantidad_existencia_producto_buscar = trim($row11[2]);
				$precio_venta = trim($row11[3]);
				$descto_salon = trim($row11[4]);
				$descto_mayorista = trim($row11[5]);
				}

				if($txttipo_cliente==1)
					{
						$txtdescuento_productomod=$descto_salon;
					}
				else if($txttipo_cliente==2)
					{
						$txtdescuento_productomod=$descto_mayorista;
					}
				else
					{
						$txtdescuento_productomod=0;
					}


				//$subtotal=$txtprecio_producto*$txtcantidad_productomod;
				$subtotal_sindescuento=$precio_venta*1;
				$desctotal=($subtotal_sindescuento*$txtdescuento_productomod)/100;
				$precio_neto=$precio_venta-$desctotal;

				$importe=$precio_neto*1;

				$sql= mysql_query("insert into tproductos_venta(descripcion_producto,cantidad,precio_venta,subtotal,id_usuario,id_producto,descuento,precio_neto,porcentaje_descuento,id_area_venta) values(\"$descripcion_producto\",1,$precio_venta,$importe,$id_usuario,$id_producto_vendido_buscado,$desctotal,$precio_neto,$txtdescuento_productomod,$txtid_areaventa)");

				/************** ACTUALIZANDO INVENTARIO ********/
				$cantidad_existencia_nueva=$cantidad_existencia_producto_buscar-1;

				$sql2= mysql_query("update cproductos set cantidad_existencia=".$cantidad_existencia_nueva." where id_producto=".$id_producto_vendido_buscado."");

				$cq="SELECT id_producto,descripcion,cantidad_existencia,precio_venta FROM cproductos where id_producto=$id_producto_buscar and id_sucursal=$id_sucursal";

				echo "1,".$txtid_areaventa;
				//echo "1,".$descripcion_producto;
		}
		else
		{
			/********************************** FALTA POR HACER ESTO **************************/
			$rs = mysql_query("select id_producto_venta,cantidad,precio_venta,descuento from tproductos_venta where id_producto=$id_producto_vendido_buscado and id_venta=0 and id_usuario=$id_usuario and id_area_venta=$txtid_areaventa");
			if ($row = mysql_fetch_row($rs)) 
				{
					$id_producto_venta = trim($row[0]);
					$cantidad = trim($row[1]);
					$precio_venta = trim($row[2]);
					$descuento = trim($row[3]);
				}

			/********* MODIFICANDO INVENTARIO *************/
			$rs2 = mysql_query("SELECT id_producto,descripcion,cantidad_existencia FROM cproductos where id_producto=$id_producto_vendido_buscado");
				if ($row2 = mysql_fetch_row($rs2)) 
					{
						$id_producto_inventariom = trim($row2[0]);
						$descripcion_inventario = trim($row2[1]);
						$cantidad_existencia_inventario = trim($row2[2]);
					}

			$nci=$cantidad+1;
			$nvacantidad_inventario=$cantidad_existencia_inventario-1;

			$sumavtasindesc=$precio_venta*$nci;
			$sumadesctos=$descuento*$nci;
			$subtotal=$sumavtasindesc-$sumadesctos;
			
			$sql2= mysql_query("update tproductos_venta set cantidad=".$nci.",subtotal=".$subtotal." where id_producto_venta=".$id_producto_venta."");
			$sql3= mysql_query("update cproductos set cantidad_existencia=".$nvacantidad_inventario." where id_producto=".$id_producto_vendido_buscado."");

			echo "1,".$txtid_areaventa;
			//echo "2,".$id_producto_vendido_buscado;

		}


		/*$subtotal=$precio_venta*1;
		$sql= mysql_query("insert into tproductos_venta(descripcion_producto,cantidad,precio_venta,subtotal,id_usuario) values(\"$descripcion\",1,$precio_venta,$subtotal,$id_usuario)");*/
		/************** ACTUALIZANDO INVENTARIO ********/
		/*$cantidad_existencia_nueva=$cantidad_existencia-1;
		$sql2= mysql_query("update cproductos set cantidad_existencia=".$cantidad_existencia_nueva." where id_producto=".$id_producto_buscar."");
		echo "1";	*/	
	}
else
	{
		echo "0";
	}		
?>




