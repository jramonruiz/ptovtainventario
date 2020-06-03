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

$txtdescripcion_productomoddescuento=utf8_decode($_POST['txtdescripcion_productomoddescuento']);
$txtdescuento_productomoddesc=utf8_decode($_POST['txtdescuento_productomoddesc']);
$txtid_areaventa=utf8_decode($_POST['txtid_areaventa']);
$txtid_venta_modificar=utf8_decode($_POST['txtid_venta_modificar']);

//////// VERIFICAMOS SI HAY PRODUCTOS NUEVOS PARA UN NUEVO TICKET

$rstp = mysql_query("select count(id_producto_venta) as total_productos from tproductos_venta where id_venta=0 and id_area_venta=0 and id_usuario=$id_usuario");
        if ($rowtp = mysql_fetch_row($rstp)) 
       	  {
       	  	$total_productos = trim($rowtp[0]);
          }


 if($total_productos==0)
 	{
			// REALIZANDO COPIA DE LOS PRODUCTOS
			$listado=  mysql_query("select tpv.id_producto_venta,tpv.id_venta,tpv.descripcion_producto,tpv.cantidad,tpv.precio_venta,tpv.subtotal,tpv.id_usuario,cp.stock_minimo,cp.cantidad_existencia,cp.codigo_barras,tpv.descuento,tpv.precio_neto,tpv.id_producto,tpv.porcentaje_descuento from tproductos_venta tpv inner join cproductos cp on tpv.id_producto=cp.id_producto where tpv.id_usuario=$id_usuario and tpv.id_venta=$txtid_venta_modificar order by tpv.id_producto_venta");
			    while($reg=  mysql_fetch_array($listado))
			    	{
			        	$id_producto_venta=mb_convert_encoding($reg['id_producto_venta'], "UTF-8");
						$cantidad_existencia=mb_convert_encoding($reg['cantidad_existencia'], "UTF-8");
						$stock_minimo=mb_convert_encoding($reg['stock_minimo'], "UTF-8");					
						$descripcion_producto=utf8_encode($reg['descripcion_producto']);
                        $cantidad=mb_convert_encoding($reg['cantidad'], "UTF-8");
                        $precio_venta=mb_convert_encoding($reg['precio_venta'], "UTF-8");
                        $subtotal=mb_convert_encoding($reg['subtotal'], "UTF-8");
                        $cantida_existencia=mb_convert_encoding($reg['cantidad_existencia'], "UTF-8");
                        $stock_minimo=mb_convert_encoding($reg['stock_minimo'], "UTF-8");
                        $codigo_barras=mb_convert_encoding($reg['codigo_barras'], "UTF-8");
                        $descuento=mb_convert_encoding($reg['descuento'], "UTF-8");
                        $precio_neto=mb_convert_encoding($reg['precio_neto'], "UTF-8");
                        $id_producto=mb_convert_encoding($reg['id_producto'], "UTF-8");
                        $porcentaje_descuento=mb_convert_encoding($reg['porcentaje_descuento'], "UTF-8");


			            
			            $sqlcp= mysql_query("insert into tproductos_venta(id_venta,descripcion_producto,cantidad,precio_venta,subtotal,id_usuario,id_producto,descuento,precio_neto,porcentaje_descuento,id_area_venta) VALUES (0,\"$descripcion_producto\",\"$cantidad\",\"$precio_venta\",\"$subtotal\",\"$id_usuario\",\"$id_producto\",\"$descuento\",\"$precio_neto\",\"$porcentaje_descuento\",0)");
					}


					//// REALIZANDO LA OPERACION DE DESCUENTO DEL PRODUCTO ///////
					
					$rs = mysql_query("select id_producto_venta,cantidad,precio_venta,descuento from tproductos_venta where descripcion_producto='$txtdescripcion_productomoddescuento' and id_venta=0 and id_usuario=$id_usuario");
					if ($row = mysql_fetch_row($rs)) {
					$id_producto_venta = trim($row[0]);
					$cantidad = trim($row[1]);
					$precio_venta = trim($row[2]);
					$descuento = trim($row[3]);
					}

					$cad1="select id_producto_venta,cantidad,precio_venta from tproductos_venta where descripcion_producto='$txtdescripcion_productomode' and id_venta=0 and id_usuario=$id_usuario'";


					$montodescuento=($precio_venta*$txtdescuento_productomoddesc)/100;

					$nuevoprecioneto=$precio_venta-$montodescuento;

					$nuevoimporte=$nuevoprecioneto*$cantidad;

						//$subtotal=$precio_venta*$nvacantidad;descuento,precio_neto,porcentaje_descuento
						$sql2= mysql_query("update tproductos_venta set subtotal=".$nuevoimporte.",descuento=".$montodescuento.",precio_neto=".$nuevoprecioneto.",porcentaje_descuento=".$txtdescuento_productomoddesc." where id_producto_venta=".$id_producto_venta."");


					echo "1";
					//echo $cad1;


 	}
 else
 	{

					$rs = mysql_query("select id_producto_venta,cantidad,precio_venta,descuento from tproductos_venta where descripcion_producto='$txtdescripcion_productomoddescuento' and id_venta=0 and id_usuario=$id_usuario");
					if ($row = mysql_fetch_row($rs)) {
					$id_producto_venta = trim($row[0]);
					$cantidad = trim($row[1]);
					$precio_venta = trim($row[2]);
					$descuento = trim($row[3]);
					}

					$cad1="select id_producto_venta,cantidad,precio_venta from tproductos_venta where descripcion_producto='$txtdescripcion_productomode' and id_venta=0 and id_usuario=$id_usuario'";


					$montodescuento=($precio_venta*$txtdescuento_productomoddesc)/100;

					$nuevoprecioneto=$precio_venta-$montodescuento;

					$nuevoimporte=$nuevoprecioneto*$cantidad;

						//$subtotal=$precio_venta*$nvacantidad;descuento,precio_neto,porcentaje_descuento
						$sql2= mysql_query("update tproductos_venta set subtotal=".$nuevoimporte.",descuento=".$montodescuento.",precio_neto=".$nuevoprecioneto.",porcentaje_descuento=".$txtdescuento_productomoddesc." where id_producto_venta=".$id_producto_venta."");


					echo "1";
					//echo $cad1;
	}

?>




