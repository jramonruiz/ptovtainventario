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

$id_producto_eliminar=$_POST['txtid_producto_buscar'];
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
			$listado=  mysql_query("select tpv.id_producto_venta,tpv.id_venta,tpv.descripcion_producto,tpv.cantidad,tpv.precio_venta,tpv.subtotal,tpv.id_usuario,cp.stock_minimo,cp.cantidad_existencia,cp.codigo_barras,tpv.descuento,tpv.precio_neto,tpv.id_producto,tpv.porcentaje_descuento from tproductos_venta tpv inner join cproductos cp on tpv.descripcion_producto=cp.descripcion where tpv.id_usuario=$id_usuario and tpv.id_venta=$txtid_venta_modificar order by tpv.id_producto_venta");
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


					//// REALIZANDO LA OPERACION DE ELIMINAR PRODUCTO BOTON X ROJA DE LA IZQUIERDA ///////
					
					/*********** BUSCANDO PRODUCTO A ELIMINAR ******/
					$rs = mysql_query("SELECT descripcion_producto,cantidad FROM tproductos_venta where id_producto_venta=$id_producto_eliminar");
					if ($row = mysql_fetch_row($rs)) {
					$descripcion_producto = trim($row[0]);
					$cantidad = trim($row[1]);
					}
					/*************************************************/


					/********* MODIFICANDO INVENTARIO *************/
					$rs2 = mysql_query("SELECT id_producto,descripcion,cantidad_existencia FROM cproductos where descripcion='$descripcion_producto'");
					if ($row2 = mysql_fetch_row($rs2)) {
					$id_producto = trim($row2[0]);
					$descripcion = trim($row2[1]);
					$cantidad_existencia = trim($row2[2]);
					}

					$nueva_existencia=$cantidad_existencia+$cantidad;

					$sql2= mysql_query("update cproductos set cantidad_existencia=".$nueva_existencia." where id_producto=".$id_producto."");


					/**********************************************/

					$sql= mysql_query("delete from tproductos_venta where id_producto=$id_producto and id_venta=0 and id_usuario=$id_usuario and id_area_venta=0");

					//$cadena="delete from cmarcas where id_marca=$id_marca";
						
					echo "Y";
					//echo $cadena;

 	}
 else
 	{
					/*********** BUSCANDO PRODUCTO A ELIMINAR ******/
					$rs = mysql_query("SELECT descripcion_producto,cantidad FROM tproductos_venta where id_producto_venta=$id_producto_eliminar");
					if ($row = mysql_fetch_row($rs)) {
					$descripcion_producto = trim($row[0]);
					$cantidad = trim($row[1]);
					}
					/*************************************************/


					/********* MODIFICANDO INVENTARIO *************/
					$rs2 = mysql_query("SELECT id_producto,descripcion,cantidad_existencia FROM cproductos where descripcion='$descripcion_producto'");
					if ($row2 = mysql_fetch_row($rs2)) {
					$id_producto = trim($row2[0]);
					$descripcion = trim($row2[1]);
					$cantidad_existencia = trim($row2[2]);
					}

					$nueva_existencia=$cantidad_existencia+$cantidad;

					$sql2= mysql_query("update cproductos set cantidad_existencia=".$nueva_existencia." where id_producto=".$id_producto."");


					/**********************************************/

					$sql= mysql_query("delete from tproductos_venta where id_producto=$id_producto and id_venta=0 and id_usuario=$id_usuario and id_area_venta=0");

					//$cadena="delete from cmarcas where id_marca=$id_marca";
						
					echo "Y";
					//echo $cadena;
	}

?>




