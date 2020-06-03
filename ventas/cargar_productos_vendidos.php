<!-- right column -->
            <div class="col-md-12">
              <!-- Horizontal Form -->
              <div class="box box-info">
                <div class="box-header with-border">
                  <h3 class="box-title">Productos Vendidos</h3>
                </div><!-- /.box-header -->
<?php
$listado=  mysql_query("select tpv.id_producto_venta,tpv.id_venta,tpv.descripcion_producto,tpv.cantidad,tpv.precio_venta,tpv.subtotal,tpv.id_usuario,cp.stock_minimo,cp.cantidad_existencia,cp.codigo_barras,tpv.descuento,tpv.precio_neto from tproductos_venta tpv inner join cproductos cp on tpv.descripcion_producto=cp.descripcion where tpv.id_usuario=$id_usuario and tpv.id_venta=0 order by tpv.id_producto_venta");
?>				
                  <div class="table-responsive mailbox-messages">
                    <table class="table table-hover table-striped">
                      <tbody>
                        <tr>
                          <td class="mailbox-star">Eliminar</td>
                          <td class="mailbox-subject">Producto</td>
                          <td class="mailbox-subject">Cantidad</td>
                          <td class="mailbox-subject">Precio<br>unitario</td>
                          <td class="mailbox-subject">Descuento</td>
                          <td class="mailbox-subject">Precio<br>neto</td>
                          <td class="mailbox-subject">Importe</td>
                        </tr>                      
					<?php
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
					?>					  
                        <tr>
                          <td class="mailbox-star"><a onClick="javascript:eliminar_producto_venta(<?php echo $id_producto_venta; ?>);" style="cursor:pointer;"><i class="fa fa-remove text-red"></i></a></td>
                          <td class="mailbox-subject"><b><?php echo $descripcion_producto; ?></b></td>
                          <td class="mailbox-subject"><b><?php echo $cantidad; ?></b></td>
                          <td class="mailbox-subject"><b><?php echo $precio_venta; ?></b></td>
                          <td class="mailbox-subject"><b><?php echo $descuento; ?></b></td>
                          <td class="mailbox-subject"><b><?php echo $precio_neto; ?></b></td>
                          <td class="mailbox-subject"><b><?php echo $subtotal; ?></b></td>
                        </tr>
					<?php
						}
					?>
                      </tbody>
                    </table><!-- /.table -->
                  </div><!-- /.mail-box-messages -->
                <div class="box-header with-border">
                  <h3 class="box-title">&nbsp;</h3>
                </div><!-- /.box-header -->

          <?php
          
          $iva=0;
                    
          $query = "select * from tproductos_venta where id_usuario=$id_usuario and id_venta=0";
        $result = mysql_query($query) or die("SQL Error 1: " . mysql_error());
          $total_pagar=0;
          while ($row = mysql_fetch_array($result)) 
          {
          $subtotal=utf8_encode($row[5]);
          $total_pagar=$total_pagar+$subtotal;
          }
          
          $total_venta_sin_iva=$total_pagar/1.16;
          $total_venta_sin_iva_redondeado=round($total_venta_sin_iva, 2);
          
          $iva=$total_pagar-$total_venta_sin_iva_redondeado;
                    
          ?>
				
				  <div class="box-header with-border" align="left">
                  &nbsp;&nbsp;&nbsp;<h1>Total a pagar: $&nbsp;<?php echo $total_pagar; ?><input id="txttotalpagar" name="txttotalpagar" type="hidden" value="<?php echo $total_pagar; ?>">&nbsp;&nbsp;&nbsp;<h3 class="box-title">Pago: </h3><input id="txtpago_venta" name="txtpago_venta" type="text" value="" onKeyPress="calcular_cambio_venta(event)">&nbsp;&nbsp;&nbsp; <h3 class="box-title">Cambio: </h3><input id="txtcambio_venta" name="txtcambio_venta" type="hidden" value="">&nbsp;&nbsp;&nbsp;<input type="text" id="cambio_venta2" name="cambio_venta2" disabled="disabled" value=""></h1>
          </div><!-- /.box-header -->
              </div><!-- /.box -->
            </div><!--/.col (right) -->