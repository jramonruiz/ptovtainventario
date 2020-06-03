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

$txtid_productomod=utf8_decode($_POST['txtid_productomod']);
$txtcantidad_productomod=utf8_decode($_POST['txtcantidad_productomod']);
$txtprecio_venta_mod=utf8_decode($_POST['txtprecio_venta_mod']);
//$txtdescuento_productomod=utf8_decode($_POST['txtdescuento_productomod']);
$txtid_venta_modificar=utf8_decode($_POST['txtid_venta_modificar']);
$txtid_venta=utf8_decode($_POST['txtid_venta']);
$txttipo_cliente=utf8_decode($_POST['txttipo_cliente']);
$txtdescto_salon=utf8_decode($_POST['txtdescto_salon']);
$txtdescto_mayorista=utf8_decode($_POST['txtdescto_mayorista']);

if($txttipo_cliente==1)
	{
		$txtdescuento_productomod=$txtdescto_salon;
	}
else if($txttipo_cliente==2)
	{
		$txtdescuento_productomod=$txtdescto_mayorista;
	}
else
	{
		$txtdescuento_productomod=0;
	}


//////// VERIFICAMOS SI HAY PRODUCTOS NUEVOS PARA UN NUEVO TICKET

$rstp = mysql_query("select count(id_producto_venta) as total_productos from tproductos_venta where id_venta=0 and id_area_venta=0 and id_usuario=$id_usuario");
        if ($rowtp = mysql_fetch_row($rstp)) 
       	  {
       	  	$total_productos = trim($rowtp[0]);
          }


if($total_productos==0 and $txtid_venta==-1)
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


					//// REALIZANDO LA OPERACION DE AGREGAR PRODUCTO ///////
						
					$id_producto_vendido_buscado=0;

					$rspvb = mysql_query("SELECT id_producto,cantidad FROM tproductos_venta where id_producto=$txtid_productomod and id_venta=0 and id_usuario=$id_usuario");
					if ($rowpvb = mysql_fetch_row($rspvb)) {
					$id_producto_vendido_buscado = trim($rowpvb[0]);
					$cantidad_producto_vendido_buscado = trim($rowpvb[1]);
					}

					if($id_producto_vendido_buscado==0)
					{
							$rs = mysql_query("SELECT * FROM cproductos where id_producto=$txtid_productomod");
							if ($row = mysql_fetch_row($rs)) {
							$txtdescripcion_producto = trim($row[3]);
							$txtcantidad_existencia_producto_buscar = trim($row[5]);
							$txtprecio_producto = trim($row[8]);
							}

							//$subtotal=$txtprecio_producto*$txtcantidad_productomod;
							$subtotal_sindescuento=$txtprecio_venta_mod*1;
							$desctotal=($subtotal_sindescuento*$txtdescuento_productomod)/100;
							$precio_neto=$txtprecio_venta_mod-$desctotal;

							$importe=$precio_neto*$txtcantidad_productomod;

							$sql= mysql_query("insert into tproductos_venta(id_venta,descripcion_producto,cantidad,precio_venta,subtotal,id_usuario,id_producto,descuento,precio_neto,porcentaje_descuento,id_area_venta) values(0,\"$txtdescripcion_producto\",$txtcantidad_productomod,$txtprecio_venta_mod,$importe,$id_usuario,$txtid_productomod,$desctotal,$precio_neto,$txtdescuento_productomod,0)");

							/************** ACTUALIZANDO INVENTARIO ********/
							$cantidad_existencia_nueva=$txtcantidad_existencia_producto_buscar-$txtcantidad_productomod;

							$sql2= mysql_query("update cproductos set cantidad_existencia=".$cantidad_existencia_nueva." where id_producto=".$txtid_productomod."");


							//$cadena="insert into tproductos_venta(descripcion_producto,cantidad,precio_venta,subtotal,id_usuario) values('".$txtdescripcion_producto."',".$txtcantidad_producto.",".$txtprecio_producto.",".$subtotal.",".$id_usuario.")";
								
							//echo $cadena;

							echo "1,".$txtid_venta_modificar;
					}
					else
					{
						$rs = mysql_query("select id_producto_venta,cantidad,precio_venta,descuento from tproductos_venta where id_producto=$txtid_productomod and id_venta=0 and id_usuario=$id_usuario");
						if ($row = mysql_fetch_row($rs)) 
							{
								$id_producto_venta = trim($row[0]);
								$cantidad = trim($row[1]);
								$precio_venta = trim($row[2]);
								$descuento = trim($row[3]);
							}

						/********* MODIFICANDO INVENTARIO *************/
						$rs2 = mysql_query("SELECT id_producto,descripcion,cantidad_existencia FROM cproductos where id_producto=$txtid_productomod");
							if ($row2 = mysql_fetch_row($rs2)) 
								{
									$id_producto_inventariom = trim($row2[0]);
									$descripcion_inventario = trim($row2[1]);
									$cantidad_existencia_inventario = trim($row2[2]);
								}

						$nci=$txtcantidad_productomod+$cantidad;
						$nvacantidad_inventario=$cantidad_existencia_inventario-$txtcantidad_productomod;

						$sumavtasindesc=$precio_venta*$nci;
						$sumadesctos=$descuento*$nvacantidad;
						$subtotal=$sumavtasindesc-$sumadesctos;
						
						$sql2= mysql_query("update tproductos_venta set cantidad=".$nci.",subtotal=".$subtotal." where id_producto_venta=".$id_producto_venta."");
						$sql3= mysql_query("update cproductos set cantidad_existencia=".$nvacantidad_inventario." where id_producto=".$id_producto_inventariom."");

						echo "1,".$txtid_venta_modificar;

					}					


 	}
else
	{
					$id_producto_vendido_buscado=0;

					$rspvb = mysql_query("SELECT id_producto,cantidad FROM tproductos_venta where id_producto=$txtid_productomod and id_venta=0 and id_usuario=$id_usuario");
					if ($rowpvb = mysql_fetch_row($rspvb)) {
					$id_producto_vendido_buscado = trim($rowpvb[0]);
					$cantidad_producto_vendido_buscado = trim($rowpvb[1]);
					}

					if($id_producto_vendido_buscado==0)
					{
							$rs = mysql_query("SELECT * FROM cproductos where id_producto=$txtid_productomod");
							if ($row = mysql_fetch_row($rs)) {
							$txtdescripcion_producto = trim($row[3]);
							$txtcantidad_existencia_producto_buscar = trim($row[5]);
							$txtprecio_producto = trim($row[8]);
							}

							//$subtotal=$txtprecio_producto*$txtcantidad_productomod;
							$subtotal_sindescuento=$txtprecio_venta_mod*1;
							$desctotal=($subtotal_sindescuento*$txtdescuento_productomod)/100;
							$precio_neto=$txtprecio_venta_mod-$desctotal;

							$importe=$precio_neto*$txtcantidad_productomod;

							$sql= mysql_query("insert into tproductos_venta(id_venta,descripcion_producto,cantidad,precio_venta,subtotal,id_usuario,id_producto,descuento,precio_neto,porcentaje_descuento,id_area_venta) values(0,\"$txtdescripcion_producto\",$txtcantidad_productomod,$txtprecio_venta_mod,$importe,$id_usuario,$txtid_productomod,$desctotal,$precio_neto,$txtdescuento_productomod,0)");

							/************** ACTUALIZANDO INVENTARIO ********/
							$cantidad_existencia_nueva=$txtcantidad_existencia_producto_buscar-$txtcantidad_productomod;

							$sql2= mysql_query("update cproductos set cantidad_existencia=".$cantidad_existencia_nueva." where id_producto=".$txtid_productomod."");


							//$cadena="insert into tproductos_venta(descripcion_producto,cantidad,precio_venta,subtotal,id_usuario) values('".$txtdescripcion_producto."',".$txtcantidad_producto.",".$txtprecio_producto.",".$subtotal.",".$id_usuario.")";
								
							//echo $cadena;

							echo "1,".$txtid_venta_modificar;
					}
					else
					{
						$rs = mysql_query("select id_producto_venta,cantidad,precio_venta,descuento from tproductos_venta where id_producto=$txtid_productomod and id_venta=0 and id_usuario=$id_usuario");
						if ($row = mysql_fetch_row($rs)) 
							{
								$id_producto_venta = trim($row[0]);
								$cantidad = trim($row[1]);
								$precio_venta = trim($row[2]);
								$descuento = trim($row[3]);
							}

						/********* MODIFICANDO INVENTARIO *************/
						$rs2 = mysql_query("SELECT id_producto,descripcion,cantidad_existencia FROM cproductos where id_producto=$txtid_productomod");
							if ($row2 = mysql_fetch_row($rs2)) 
								{
									$id_producto_inventariom = trim($row2[0]);
									$descripcion_inventario = trim($row2[1]);
									$cantidad_existencia_inventario = trim($row2[2]);
								}

						$nci=$txtcantidad_productomod+$cantidad;
						$nvacantidad_inventario=$cantidad_existencia_inventario-$txtcantidad_productomod;

						$sumavtasindesc=$precio_venta*$nci;
						$sumadesctos=$descuento*$nvacantidad;
						$subtotal=$sumavtasindesc-$sumadesctos;
						
						$sql2= mysql_query("update tproductos_venta set cantidad=".$nci.",subtotal=".$subtotal." where id_producto_venta=".$id_producto_venta."");
						$sql3= mysql_query("update cproductos set cantidad_existencia=".$nvacantidad_inventario." where id_producto=".$id_producto_inventariom."");

						echo "1,".$txtid_venta_modificar;

					}
	}

?>




