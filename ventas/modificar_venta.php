<?php
error_reporting(0);
$tipusr="";
$paginterior=0;
include("../php/autentificacion.server.php");
session_name("lgsapplipweb");
session_start();
session_set_cookie_params(0, "/", $HTTP_SERVER_VARS["HTTP_HOST"], 0);

include("../php/conexion.php");
$connect = mysql_connect($hostname, $username, $password)
or die('Could not connect: ' . mysql_error());
//Select The database
$con = mysql_select_db($database, $connect);


$id_usuario=$_SESSION["iduser"];
$id_sucursal=$_SESSION["sucursal"];

//$areaventa=$_GET["areaventa"];

$id_area_venta=$_GET["id_area_venta"];
$id_venta_modificar=$_GET["id_venta_modificar"];
$id_venta=$_GET["id_venta"];

include("../php/conexion.php");
$connect = mysql_connect($hostname, $username, $password)
or die('Could not connect: ' . mysql_error());
//Select The database
$con = mysql_select_db($database, $connect);

//// OBTENCION DEL NOMBRE DEL CLIENTE Y DEL DESCUENTO

$rscd = mysql_query("SELECT tv.id_venta,tv.folio_venta,tv.nombre_cliente,tv.porcentaje_descuento,tv.tipo_operacion,tv.total_pagar,cc.id_tipo_cliente FROM tventas tv inner join cclientes cc on tv.nombre_cliente=cc.nombre_cliente where tv.id_venta=$id_venta_modificar");
if ($rowcd = mysql_fetch_row($rscd)) {
  $id_venta_bus=utf8_encode($rowcd[0]);
  $folio_venta_bus=utf8_encode($rowcd[1]);
  $nombre_cliente=utf8_encode($rowcd[2]);
  $porcentaje_descuento=utf8_encode($rowcd[3]);
  $id_tipo_movimiento=utf8_encode($rowcd[4]);
  $total_pagar_venta_modificada=utf8_encode($rowcd[5]);
  $tipo_cliente=utf8_encode($rowcd[6]);
}

$rsmtomod = mysql_query("SELECT total_pagar FROM tventas where id_venta=$id_venta_modificar");
if ($rowmtomod = mysql_fetch_row($rsmtomod)) {
$total_pagar_venta_modificada = trim($rowmtomod[0]);
}

/*$rstp = mysql_query("SELECT id_tipo_cliente FROM cclientes where nombre_cliente='$nombre_cliente'");
if ($rowtp = mysql_fetch_row($rstp)) {
  $tipo_cliente=$rowtp[0];
}

$cadtp="SELECT id_tipo_cliente FROM cclientes where nombre_cliente='$nombre_cliente'";*/


//// SUMANDO NUMERO DE PAGOS DE LA VENTA
$rsspv = mysql_query("SELECT COUNT(id_pago_venta) AS numeropagosventa FROM tpagos_venta where id_usuario=$id_usuario and id_area_venta=99 and id_venta=0");
if ($rowspv = mysql_fetch_row($rsspv)) {
$numeropagosventa = trim($rowspv[0]);
}

/// SUMANDO MONTO DEL PAGO DE LA VENTA
$rssmpv = mysql_query("SELECT SUM(monto) AS total_pago_capturado FROM tpagos_venta where id_usuario=$id_usuario and id_area_venta=99 and id_venta=0");
if ($rowsmpv = mysql_fetch_row($rssmpv)) {
$total_pago_capturado = trim($rowsmpv[0]);
}

/// ACTIVANDO EL PROCESO DE CANCELACION DE LA VENTA
$sqlcv= mysql_query("update tventas set proceso_cancelacion=1 where id_venta=$id_venta_modificar");

?>        
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Sistema de Inventario y Punto de Venta</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.css">
    <!--link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css"-->
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="../plugins/datatables/dataTables.bootstrap.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../dist/css/AdminLTE.css">
    <!--link rel="stylesheet" href="../dist/css/AdminLTE.min.css"-->
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="../dist/css/skins/_all-skins.min.css">

<!-- jQuery 2.1.4 -->
    <script src="../plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="../bootstrap/js/bootstrap.min.js"></script>
    <!-- DataTables -->
    <script src="../plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="../plugins/datatables/dataTables.bootstrap.min.js"></script>
    <!-- SlimScroll -->
    <script src="../plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <!-- FastClick -->
    <script src="../plugins/fastclick/fastclick.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../dist/js/app.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="../dist/js/demo.js"></script>    
	
<script type="text/javascript" src="../js/operaciones.js"></script>
<script type="text/javascript" src="../js/reportes.js"></script>
<script type="text/javascript" src="../js/login.js"></script>

<script type="text/javascript"> /*para moverme entre la tabla*/
var fila = 0;
function pulsar_tabla(e) {
  tab = document.getElementById('listProd');
  filas = tab.getElementsByTagName('tr');
  if (e.keyCode==38 && fila>0) 
    {
      num=-1;  
      //$(".move:focus").next().focus();
      //document.frm_nueva_venta.idpp2.focus();
      /*$("#idpp2").focus();
      var valor= $("#idpp2").val();
      alert(valor);*/
      $(".move:focus").prev().focus();
      //alert(this.value);
      /*var valor22 ="#idpp2";
      var valor2 = $(valor22).val();
      alert(valor2);*/
    }
   else if(e.keyCode==40 && fila<filas.length-1) 
     {
        num=1;
         //$(".move:focus").prev().focus();
         //document.frm_nueva_venta.idpp3.focus();
         /*$("#idpp3").focus();
         var valor = $("#idpp2").val();
         alert(valor);*/
         $(".move:focus").next().focus();
         //alert(this.value);
         /*var valor33 ="#idpp3";
         var valor3 = $(valor33).val();
      alert(valor3);*/
     }
   else return;
  filas[fila].style.background = 'white';
  fila+=num;
  filas[fila].style.background = 'yellow';
  /*var importe = tr.children[6];
  alert(importe);*/
  //alert(fila);
  //document.getElemenById('txtidproductonavegando').value=fila;
  document.frmmodificar_venta.txtidfila.value=fila;

  /*$("table tbody tr").keyup(function() {
  var importe = $(this).find("td:last-child").text();
  alert(importe);
});*/

}
</script>


<script>
  
  $(document).ready(function(){
    $("#txtproductodesc").focus();
});
  
</script>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="hold-transition skin-yellow-light sidebar-mini" onload="cargar_pagos_venta_modificar(<?php echo $numeropagosventa.','.$total_pago_capturado; ?>);" onkeydown="tecla(event);"  onkeyup = "pulsar_tabla(event)">
<form id="frmmodificar_venta" name="frmmodificar_venta" action="" method="post"> 
  <input id="sel" type="hidden" value="-1">
  <input id="txtidfila" name="txtidfila" type="hidden" value=""> 
  <input id="txtidproductonavegando" name="txtidproductonavegando" type="hidden" value=""> 
  <input type="hidden" id="txtnum_pag" name="txtnum_pag" value="" /> 
  <input id="txtfilepageserver" type="hidden" value=""/>   
<input type="hidden" id="txtid_producto_buscar" name="txtid_producto_buscar" value="" /> 
<input type="hidden" id="txtcantidad_existencia_producto_buscar" name="txtcantidad_existencia_producto_buscar" value="" />
<input type="hidden" id="cambio_venta" name="cambio_venta" value="" />
  <input type="hidden" id="txtid_producto" name="txtid_producto" value="" /> 
  <input type="hidden" id="txtcantidad_producto" name="txtcantidad_producto" value="" />
  <input type="hidden" id="txtid_venta_modificar" name="txtid_venta_modificar" value="<?php echo $id_venta_modificar; ?>" />     
  <input type="hidden" id="txtid_venta" name="txtid_venta" value="<?php echo $id_venta; ?>" />  
  <input type="hidden" id="txttipo_cliente" name="txttipo_cliente" value="<?php echo $tipo_cliente; ?>" />   
    <div class="wrapper">

      <header class="main-header">
		<?php require_once("header_ventas.php");?>
      </header>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
			<?php require_once("menu_opciones_ventas.php");?>
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            MODIFICAR VENTA &nbsp;<?php echo 'Id de la venta: '.$id_venta_bus.', Folio de la venta: '.$folio_venta_bus; ?>
          </h1>
        </section>
        <!-- Main content -->
        <section class="content"> 

        <div class="row">
            <div class="col-md-12">
              <div class="box box-primary">
                <div class="box-body pad table-responsive">
                  <table class="table table-bordered text-center" cellspacing="1" cellpadding="1">
                    <tr>
                      <?php
                      if($id_tipo_movimiento==2)
                        {
                            $tipomovimiento="AJUSTE DE SALIDA";
                        }
                      else if($id_tipo_movimiento==1)
                        {
                            $tipomovimiento="TICKET";
                        }
                      else
                        {
                            $tipomovimiento="";   
                        }

                        ?>
                      <td colspan="5" align="left"><h4>Cliente: <?php echo $nombre_cliente; ?></h4>
                      <td colspan="4" align="left"><h4>Operacion: <?php echo $tipomovimiento; ?></h4></td>
                    </tr>

                  </table>

                  <table class="table table-bordered text-center" cellspacing="1" cellpadding="1">
                    <tr>
                      <td bgcolor="#E1E7E3"><h2>F2</h2><h5>Cobrar</h5></td>
                      <td bgcolor="#E1E7E3"><h2>F4</h2><h5>Precio</h5></td>
                      <!--td bgcolor="#E1E7E3"><h2>F4</h2><h5>Operacion</h5></td>
                      <td bgcolor="#E1E7E3"><h2>F5</h2><h5>Areas</h5></td>
                      <td bgcolor="#E1E7E3"><h2>F6</h2><h5>Clientes</h5></td-->
                      <td bgcolor="#E1E7E3"><h2>F7</h2><h5>Cantidad</h5></td>
                      <td bgcolor="#E1E7E3"><h2>F8</h2><h5>Descuento</h5></td>
                      <!--td bgcolor="#E1E7E3"><h2>F9</h2><h5>Productos</h5></td-->
                      <td bgcolor="#E1E7E3"><h2>F10</h2><h5>Eliminar</h5></td>
                      <!--<td bgcolor="#E1E7E3"><h2>F9</h2><h5>Retirar</h5></td>-->
                      <td>
                          <?php
                          $iva=0;  
                          if($id_venta==0)
                          {   
                          $query = "select * from tproductos_venta where id_usuario=$id_usuario and id_venta=0 and id_area_venta=0";
                          }
                          else
                          {
                           $query = "select * from tproductos_venta where id_usuario=$id_usuario and id_venta=$id_venta_modificar";
                          }
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
                          <h1>$ <?php echo $total_pagar; ?></h1><h5>TOTAL DE LA VENTA</h5>
                          <input id="txttotal_venta" name="txttotal_venta" type="hidden" value="<?php echo $total_venta_sin_iva_redondeado; ?>"><input id="txtiva" name="txtiva" type="hidden" value="<?php echo $iva; ?>">
                      </td>
                      <td>
                          <h1 style="color: red;">$ <?php echo $total_pagar_venta_modificada; ?></h1><h5 style="color: red;">MONTO VENTA MODIFICADA</h5>
                          <input id="txtmonto_venta_modificada2" name="txtmonto_venta_modificada2" type="hidden" value="<?php echo $total_pagar_venta_modificada; ?>">
                      </td>
                    </tr>

                  </table>
                </div><!-- /.box -->
              </div>
            </div><!-- /.col -->
          </div><!-- ./row -->    

        <div class="row">
            <!-- right column -->
            <div class="col-md-12">
              <!-- general form elements disabled -->
              <div class="box box-warning">
                <div class="box-body">
                    <!-- text input -->
                    <div class="form-group">
                      <div class="col-xs-8">
                        <input list="productosauto" name="txtproductodesc" id="txtproductodesc" autocomplete="off" class="form-control" placeholder="nombre del producto o codigo de barras" onchange="buscar_producto_venta_cb2_modventa(this.value);">
                        <datalist id="productosauto">
                             <?php
                            $consulta_catalogopa=mysql_query("select * from cproductos where id_sucursal=$id_sucursal");
                            while($resultado_catalogopa=mysql_fetch_array($consulta_catalogopa))
                            {
                            ?> 
                              <option value="<?php echo utf8_encode($resultado_catalogopa[descripcion].',                     $ '.$resultado_catalogopa[precio_venta]); ?>"></option>        
                                    <?php 
                            } 
                            ?> 
                         </datalist>
                      </div>                      
                    </div>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!--/.col (right) -->
          </div><!-- /.row -->     

          
          <div class="row">
            <!-- right column -->
            <div class="col-md-12">
              <!-- Horizontal Form -->
              <div class="box box-info">
                <div class="box-header with-border">
                  <h3 class="box-title">Productos Vendidos</h3>
                </div><!-- /.box-header -->
<?php
//// SUMANDO NUMERO DE PRODUCTOS
$rsspvvm = mysql_query("SELECT COUNT(id_producto_venta) AS numeroproductos FROM tproductos_venta where id_usuario=$id_usuario and id_area_venta=0 and id_venta=0");
if ($rowspvvm = mysql_fetch_row($rsspvvm)) {
$numeroproductos = trim($rowspvvm[0]);
}

if($id_venta==0)
{
$listado=  mysql_query("select tpv.id_producto_venta,tpv.id_venta,tpv.descripcion_producto,tpv.cantidad,tpv.precio_venta,tpv.subtotal,tpv.id_usuario,cp.stock_minimo,cp.cantidad_existencia,cp.codigo_barras,tpv.descuento,tpv.precio_neto,tpv.porcentaje_descuento from tproductos_venta tpv inner join cproductos cp on tpv.id_producto=cp.id_producto where tpv.id_usuario=$id_usuario and tpv.id_venta=0 and tpv.id_area_venta=0 order by tpv.id_producto_venta");
}
else
{
$listado=  mysql_query("select tpv.id_producto_venta,tpv.id_venta,tpv.descripcion_producto,tpv.cantidad,tpv.precio_venta,tpv.subtotal,tpv.id_usuario,cp.stock_minimo,cp.cantidad_existencia,cp.codigo_barras,tpv.descuento,tpv.precio_neto,tpv.porcentaje_descuento from tproductos_venta tpv inner join cproductos cp on tpv.id_producto=cp.id_producto where tpv.id_usuario=$id_usuario and tpv.id_venta=$id_venta_modificar order by tpv.id_producto_venta");
}
$considpp=1;
?>				
                  <div class="table-responsive mailbox-messages">
                    <table class="table table-hover table-striped" id="listProd">
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
                                $porcentaje_descuento=mb_convert_encoding($reg['porcentaje_descuento'], "UTF-8");
                                $pdescuento=$porcentaje_descuento/100;
                                $precio_neto=mb_convert_encoding($reg['precio_neto'], "UTF-8");
                                $nomidpp="idpp".$considpp;
					?>					  
                        <tr onmouseover='this.style.background="yellow"' onmouseout='this.style.background="white"'>
                          <input class='move' type="hidden" name="<?php echo $nomidpp; ?>" id="<?php echo $nomidpp; ?>" value="<?php echo $id_producto_venta; ?>" onkeydown="tecla_idproducto(event,<?php echo $id_producto_venta; ?>); autofocus">
                          <td class="mailbox-star"><a onClick="javascript:eliminar_producto_venta_modventa(<?php echo $id_producto_venta; ?>);" style="cursor:pointer;"><i class="fa fa-remove text-red"></i></a>&nbsp;&nbsp;<input class='move' type="text" name="idpp" id="idpp" value="<?php echo $considpp; ?>" onkeydown="tecla_idproducto_modificacion_venta(event,<?php echo $considpp; ?>);" style="width: 50px;" autocomplete="off"></td>
                          <td class="mailbox-subject" id="list_descp"><b><?php echo $descripcion_producto; ?></b></td>
                          <td class="mailbox-subject" id="list_cant" style="cursor: pointer;" onclick="javascript:modificar_cantidad_click_modificacion_venta(<?php echo $id_producto_venta; ?>,<?php echo $cantidad; ?>);"><b><?php echo $cantidad; ?></b></td>
                          <td class="mailbox-subject" id="list_precio" style="cursor: pointer;" onclick="javascript:modificar_precio_click_modificacion_venta(<?php echo $id_producto_venta; ?>,<?php echo $precio_venta; ?>);"><b><?php echo $precio_venta; ?></b></td>
                          <td class="mailbox-subject" id="list_desc" style="cursor: pointer;" onclick="javascript:modificar_descuento_click_modificacion_venta(<?php echo $id_producto_venta; ?>,<?php echo $porcentaje_descuento; ?>);"><b><?php echo $porcentaje_descuento; ?></b></td>
                          <td class="mailbox-subject" id="list_neto"><b><?php echo $precio_neto; ?></b></td>
                          <td class="mailbox-subject" id="list_subt"><b><?php echo $subtotal; ?></b></td>
                        </tr>
					<?php
          $considpp=$considpp+1;
						}
					?>
                      </tbody>
                    </table><!-- /.table -->
                  </div><!-- /.mail-box-messages -->
                <div class="box-header with-border">
                  <h3 class="box-title">&nbsp;</h3>
                </div><!-- /.box-header -->

          <?php
          
          /*$iva=0;
                    
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
          
          $iva=$total_pagar-$total_venta_sin_iva_redondeado;*/
                    
          ?>
				
				  
              </div><!-- /.box -->
            </div><!--/.col (right) -->
          </div><!-- /.row --> 

          <!--div class="box-header with-border" align="left">
        <button type="button" class="btn btn-primary" onClick="javascript:cancelar_venta_areaventa();">Cancelar Venta y Area de Venta</button>
        </div--><!-- /.box-header -->   

         <div class="box-header with-border" align="left">
        <button type="button" class="btn btn-primary" onClick="javascript:no_cancelar_venta();">NO CANCELAR VENTA</button>
        </div>      

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
      <footer class="main-footer">
        <div class="pull-right hidden-xs">
          <b>Version</b> 2.3.0
        </div>
        <strong>Copyright &copy; 2014-2015 <a href="http://almsaeedstudio.com">Almsaeed Studio</a>.</strong> All rights reserved.
      </footer>
      <!-- Add the sidebar's background. This div must be placed
           immediately after the control sidebar -->
      <div class="control-sidebar-bg"></div>
    </div><!-- ./wrapper -->


   
    <!-- Modal para CANTIDAD DEL PRODUCTO A AGREGAR-->
          <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLongTitle">CANTIDAD DEL PRODUCTO</h5>
                </div>
                <div class="modal-body">
                <input type="hidden" id="txtid_productomod" name="txtid_productomod" value="">
                <input type="hidden" id="txtdescto_salon" name="txtdescto_salon" value="">
                <input type="hidden" id="txtdescto_mayorista" name="txtdescto_mayorista" value="">
                Producto:<input type="text" id="txtdescripcion_productomod" name="txtdescripcion_productomod" value="">
                </div>
                <div class="modal-body">
                Existencia:<input type="text" id="txtexistencia_productomod" name="txtexistencia_productomod" value="">
                </div>
                <div class="modal-body">
                Precio de venta:<input type="text" id="txtprecio_venta_mod" name="txtprecio_venta_mod" value="">
                </div>
                <div class="modal-body">
                <input type="hidden" id="txtdescuento_productomod" name="txtdescuento_productomod" value="0">
                Cantidad:<input type="number" id="txtcantidad_productomod" name="txtcantidad_productomod" onKeyPress="javascript:guardar_producto_venta_buscado_modventa(event,this.value);" value="1">
                </div>
              </div>
            </div>
          </div>

 <!-- Modal para PRODUCTO A ELIMINAR F10 -->
          <div class="modal fade" id="exampleModalLongeli" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLongTitle">ELIMINAR PRODUCTO</h5>
                </div>
                <div class="modal-body">
                <input type="hidden" id="txtid_productomode" name="txtid_productomode">
                Producto<input list="productosavendere" name="txtdescripcion_productomode" id="txtdescripcion_productomode" autocomplete="off" class="form-control" placeholder="escribe el nombre del producto a eliminar" onKeyPress="javascript:eliminar_cantidad_producto_porvender(event,this.value);">
                <datalist id="productosavendere">
                       <?php
                              $consulta_catalogo_prodve=mysql_query("select * from tproductos_venta where id_venta=$id_venta_bus and id_usuario=$id_usuario");
                              while($resultado_catalogo_prodve=mysql_fetch_array($consulta_catalogo_prodve))
                              {
                              ?> 
                                <option value="<?php echo utf8_encode($resultado_catalogo_prodve[descripcion_producto]); ?>">        
                                      <?php 
                              } 
                      ?> 
                </datalist>
                </div>
                <div class="modal-body">
                Cantidad:<input type="number" id="txtcantidad_productomode" name="txtcantidad_productomode" onKeyPress="javascript:eliminar_cantidad_producto_porvender_modventa(event,this.value);" value="1">
                </div>
              </div>
            </div>
          </div>

        <!-- Modal para CAMBIAR LA CANTIDAD DEL PRODUCTO F7 -->
          <div class="modal fade" id="exampleModalLongmod" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLongTitle">MODIFICAR CANTIDAD DEL PRODUCTO</h5>
                </div>
                <div class="modal-body">
                <input type="hidden" id="txtid_productomodm" name="txtid_productomodm">
                Producto<input list="productosavenderm" name="txtdescripcion_productomodm" id="txtdescripcion_productomodm" autocomplete="off" class="form-control" placeholder="escribe el nombre del producto a modificar" onKeyPress="cantidad_producto_buscadomod(event)">
                <datalist id="productosavenderm">
                       <?php
                              $consulta_catalogo_prodvm=mysql_query("select * from tproductos_venta where id_venta=$id_venta_bus and id_usuario=$id_usuario");
                              while($resultado_catalogo_prodvm=mysql_fetch_array($consulta_catalogo_prodvm))
                              {
                              ?> 
                                <option value="<?php echo utf8_encode($resultado_catalogo_prodvm[descripcion_producto]); ?>">        
                                      <?php 
                              } 
                      ?> 
                </datalist>
                </div>
                <div class="modal-body">
                Cantidad:<input type="number" id="txtcantidad_productomodm" name="txtcantidad_productomodm" onKeyPress="javascript:modificar_cantidad_producto_porvender_modventa(event,this.value);" value="1">
                </div>
              </div>
            </div>
          </div>

<!-- Modal para COBRAR LA VENTA F2 -->
          <div class="modal fade" id="exampleModalLongcobrar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLongTitle">COBRAR</h5>
                </div>

                <div class="modal-body">
                <h3>Total a pagar:<?php echo " $ ".$total_pagar; ?>
                  <input type="hidden" id="txttotalpagar_modal" name="txttotalpagar_modal" value="<?php echo $total_pagar; ?>"  onKeyPress="javascript:guardar_ajuste_salida(event);"></h3>
                </div>

                <div class="modal-body">
                <input type="hidden" id="txtmonto_venta_modificada" name="txtmonto_venta_modificada" value="<?php echo $total_pagar_venta_modificada; ?>">
                <input type="hidden" id="txttotalpagar_modal_sindesc" name="txttotalpagar_modal_sindesc" value="<?php echo $total_pagar; ?>">
                <input type="hidden" id="cmbtipo_operacion" name="cmbtipo_operacion" value="<?php echo $id_tipo_movimiento; ?>">
                <?php
                /*$montodescuento=($total_pagar*$porcentaje_descuento)/100;
                $total_pagar=$total_pagar-$montodescuento;*/
                ?>
                <input type="hidden" id="txtdescuento_venta" name="txtdescuento_venta" value="<?php echo $montodescuento; ?>">
                <input type="hidden" id="txtdescuento_porcentaje" name="txtdescuento_porcentaje" value="<?php echo $porcentaje_descuento; ?>">  
                Importe Recibido:<input type="number" id="txtimporte_recibido" name="txtimporte_recibido" class="form-control" placeholder="capture el importe recibido" onKeyPress="javascript:calcular_cambio_venta_modal_modventa(event,this.value);" value="<?php echo $total_pagar; ?>">
                </div>

                <div class="modal-body">
                <input type="hidden" name="txtcliente" id="txtcliente" value="<?php echo $nombre_cliente; ?>">
                Metodo de Pago<input list="metodospago" name="txtmetodo_pago" id="txtmetodo_pago" class="form-control" autocomplete="off" placeholder="escribe el metodo de pago" value="Efectivo">
                <datalist id="metodospago">
                       <?php
                              $consulta_catalogo_metpago=mysql_query("select * from tmetodos_pago");
                              while($resultado_catalogometpago=mysql_fetch_array($consulta_catalogo_metpago))
                              {
                              ?> 
                                <option value="<?php echo utf8_encode($resultado_catalogometpago[desc_metodo_pago]); ?>">        
                                      <?php 
                              } 
                      ?> 
                </datalist>
                </div>
                <div class="modal-body">
                Referencia:<input type="text" id="txtreferencia" name="txtreferencia" class="form-control" placeholder="Escriba la referencia">
                </div>

                <div class="modal-body">
                  <?php
                    $diferenciapagar=$total_pagar-$total_pagar_venta_modificada;
                  ?>
                <h3>Diferencia a pagar:<?php echo " $ ".$diferenciapagar; ?>
                <input type="hidden" id="txtdiferencia_pagar" name="txtdiferencia_pagar" value="<?php echo $diferenciapagar; ?>"></h3>
                </div>
                
                
                <div align="center">
                  <table width="80%" border="1">
                    <tr>
                        <td align="center">Tipo de Pago</td><td align="center">Importe</td><td align="center">Referencia</td>
                    </tr>
                    <?php 
                        $pagadonpv=0.00;
                        $faltantepagar=0.00;
                        $listadonp=  mysql_query("select tpv.id_pago_venta,tmp.desc_metodo_pago,tpv.monto,tpv.referencia from tpagos_venta tpv inner join tmetodos_pago tmp on tpv.id_tipo_pago=tmp.id_metodo_pago where tpv.id_usuario=$id_usuario and tpv.id_area_venta=99 and tpv.id_venta=0");
                                           while($regnpv=  mysql_fetch_array($listadonp))
                                           {
                                    $id_pago_venta=utf8_encode($regnpv['id_pago_venta']);
                                  $desc_metodo_pagonp=utf8_encode($regnpv['desc_metodo_pago']);
                                  $montonpv=utf8_encode($regnpv['monto']);  
                                  $referenciapv=utf8_encode($regnpv['referencia']);

                                  $pagadonpv=$pagadonpv+$montonpv;
                                  $faltantepagar=$diferenciapagar-$pagadonpv;

                    ?>
                    <tr>
                        <td><?php echo $desc_metodo_pagonp; ?></td><td><?php echo $montonpv; ?></td><td><?php echo $referenciapv; ?></td>
                    </tr> 
                    <?php
                    }
                    ?>
                    <tr>
                        <td colspan="3" align="right">Pagado: <?php echo $pagadonpv; ?>&nbsp;&nbsp;&nbsp;</td>
                    </tr>                  
                    <tr>
                        <td colspan="3" align="right">Faltante: <?php echo $faltantepagar; ?>&nbsp;&nbsp;&nbsp;
                          <input type="hidden" id="txtfaltanteventa" name="txtfaltanteventa" value="<?php echo $faltantepagar; ?>">
                        </td>
                    </tr>                  
                  </table><br>
                </div>                
                
              </div>
            </div>
          </div>          

<!-- Modal para CAMBIO -->
          <div class="modal fade" id="exampleModalLongcambio" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLongTitle">CAMBIOS</h5>
                </div>
                <div class="modal-body">
                <h1>CAMBIO:<input type="text" id="txtcambio_ventamodal" name="txtcambio_ventamodal" onKeyPress="javascript:guardar_venta_modal_modventa(event);" value=""></h1>
                </div>
              </div>
            </div>
          </div>          


<!-- Modal para RETIRAR F12 -->
          <div class="modal fade" id="exampleModalLongretirar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLongTitle">RETIRAR EFECTIVO</h5>
                </div>
                <div class="modal-body">
                Motivo del retiro:<input type="text" id="txtmotivo_retiro" name="txtmotivo_retiro" placeholder="Escriba el motivo del retiro">
                </div>
                <div class="modal-body">
                Importe a retirar:<input type="number" id="txtimporte_retirar" name="txtimporte_retirar" placeholder="capture el importe a retirar" onKeyPress="javascript:guardar_retiro(event,this.value);">
                </div>
              </div>
            </div>
          </div> 

<!-- Modal para CAMBIAR PRECIO F3 -->
          <div class="modal fade" id="exampleModalLongprecio" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLongTitle">PRECIO</h5>
                </div>
                <div class="modal-body">
                <input type="hidden" id="txtid_productomodprecio" name="txtid_productomodprecio">
                Producto<input list="productosavenderprecio" name="txtdescripcion_productomodprecio" id="txtdescripcion_productomodprecio" autocomplete="off" class="form-control" placeholder="escribe el nombre del producto a modificar el precio" onKeyPress="javascript:eliminar_cantidad_producto_porvender(event,this.value);">
                <datalist id="productosavenderprecio">
                       <?php
                              $consulta_catalogo_prodve=mysql_query("select * from tproductos_venta where id_venta=$id_venta_bus and id_usuario=$id_usuario");
                              while($resultado_catalogo_prodve=mysql_fetch_array($consulta_catalogo_prodve))
                              {
                              ?> 
                                <option value="<?php echo utf8_encode($resultado_catalogo_prodve[descripcion_producto]); ?>">        
                                      <?php 
                              } 
                      ?> 
                </datalist>
                </div>
                <div class="modal-body">
                Precio:<input type="number" id="txtprecio_productomodprec" name="txtprecio_productomodprec" onKeyPress="javascript:cambiar_precio_producto_porvender_modventa(event,this.value);" value="0">
                </div>
              </div>
            </div>
          </div>

<!-- Modal para CANTIDAD DEL PRODUCTO A DESCUENTO F8 -->
          <div class="modal fade" id="exampleModalLongdescuento" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLongTitle">DESCUENTO</h5>
                </div>
                <div class="modal-body">
                <input type="hidden" id="txtid_productomoddescuento" name="txtid_productomoddescuento">
                Producto<input list="productosavenderdescuento" name="txtdescripcion_productomoddescuento" id="txtdescripcion_productomoddescuento" autocomplete="off" class="form-control" placeholder="escribe el nombre del producto a modificar el descuento" onKeyPress="javascript:modificar_descuento_producto_porvender(event,this.value);">
                <datalist id="productosavenderdescuento">
                       <?php
                              $consulta_catalogo_prodve=mysql_query("select * from tproductos_venta where id_venta=$id_venta_bus and id_usuario=$id_usuario");
                              while($resultado_catalogo_prodve=mysql_fetch_array($consulta_catalogo_prodve))
                              {
                              ?> 
                                <option value="<?php echo utf8_encode($resultado_catalogo_prodve[descripcion_producto]); ?>">        
                                      <?php 
                              } 
                      ?> 
                </datalist>
                </div>
                <div class="modal-body">
                Descuento en %:<input type="number" id="txtdescuento_productomoddesc" name="txtdescuento_productomoddesc" onKeyPress="javascript:modificar_descuento_producto_porvender_modventa(event,this.value);" value="0">
                </div>
              </div>
            </div>
          </div>      

           <!-- Modal para APLICAR DESCUENTO A TODO CTRL -->
          <div class="modal fade" id="exampleModalLongdescuentotodo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLongTitle">APLICAR DESCUENTO A TODO</h5>
                </div>
                <div class="modal-body">
                <input type="hidden" id="txtid_productomoddescuento" name="txtid_productomoddescuento">
                </div>
                <div class="modal-body">
                Descuento en %:<input type="number" id="txtdescuento_todo" name="txtdescuento_todo" onKeyPress="javascript:modificar_descuento_todo_modificacion(event,this.value);" value="0">
                </div>
              </div>
            </div>
          </div>

<!-- Modal para CANTIDAD DEL PRODUCTO A OPERACION F4 EL id_tipo_operacion=1 es VENTA, id_tipo_operacion=2 es AJUSTE -->
          <div class="modal fade" id="exampleModalLongoperacion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLongTitle">OPERACION</h5>
                </div>
                <div class="modal-body">
                <input type="hidden" id="txtid_tipo_operacion" name="txtid_tipo_operacion" value="2">
                </div>
                <div class="modal-body">
                OPERACION:<input type="text" id="txtoperacion" name="txtoperacion" value="AJUSTE" onKeyPress="javascript:modificar_descuento_producto_porvender(event,this.value);">
                </div>
              </div>
            </div>
          </div>          


          

    <!-- page script -->
    <script>

    function disableFunctionKeys(e) {
    var functionKeys = new Array(112, 113, 114, 115, 116, 117, 118, 119, 120, 121, 123, 9);
    if (functionKeys.indexOf(e.keyCode) > -1 || functionKeys.indexOf(e.which) > -1) {
        e.preventDefault();
    }
};

$(document).ready(function() {
    $(document).on('keydown', disableFunctionKeys);
});

      $(function () {
        $("#example1").DataTable();
        $('#example2').DataTable({
          "paging": true,
          "lengthChange": false,
          "searching": false,
          "ordering": true,
          "info": true,
          "autoWidth": false
        });
      });
    </script>
    <script type="text/javascript">

function buscar_producto_venta_formulario(e)
{
  tecla = (document.all) ? e.keyCode : e.which;
  if (tecla==13)
    { 
      $('#myModal').modal()
    } 
    else
      {
        alert("presione enter para buscar el producto");
      }
}

function mostrarmodal_eliminar()
{
  $('#exampleModalLongeli').modal()
  $('#exampleModalLongeli').on('shown.bs.modal', function () {
             $("#txtdescripcion_productomode").focus();
          });
}

function mostrarmodal_modificar()
{
  $('#exampleModalLongmod').modal()
  $('#exampleModalLongmod').on('shown.bs.modal', function () {
             $("#txtdescripcion_productomodm").focus();
          });
}

function mostrarmodal_cobrar()
{
  /*var montoventamodificada=document.frmmodificar_venta.txtmonto_venta_modificada2.value;
  var montoventaactual=document.frmmodificar_venta.txttotalpagar_modal.value;
  
  if(parseInt(montoventaactual)>=parseInt(montoventamodificada))
    {
      $('#exampleModalLongcobrar').modal()
      $('#exampleModalLongcobrar').on('shown.bs.modal', function () {
             $("#txtcliente").focus();
          });
    }
  else
    {
      alert("EL MONTO TOTAL DE LA VENTA DEBE SER MAYOR O IGUAL AL MONTO DE VENTA MODIFICADA");
      $(document).ready(function(){
      $("#txtproductodesc").focus();
        });
    }*/
    $('#exampleModalLongcobrar').modal()
  $('#exampleModalLongcobrar').on('shown.bs.modal', function () {
             $("#txtimporte_recibido").focus();
          });
  document.frmmodificar_venta.txtimporte_recibido.select();
    
}

function mostrarmodal_retirar()
{
  $('#exampleModalLongretirar').modal()
  $('#exampleModalLongretirar').on('shown.bs.modal', function () {
             $("#txtmotivo_retiro").focus();
          });
}

function mostrarmodal_precio()
{
  $('#exampleModalLongprecio').modal()
  $('#exampleModalLongprecio').on('shown.bs.modal', function () {
             $("#txtdescripcion_productomodprecio").focus();
          });
}

function mostrarmodal_descuento()
{
  $('#exampleModalLongdescuento').modal()
  $('#exampleModalLongdescuento').on('shown.bs.modal', function () {
             $("#txtdescripcion_productomoddescuento").focus();
          });
}

function mostrarmodal_operacion()
{
  $('#exampleModalLongoperacion').modal()
}

function presionar_tecla_escape()
{
  //alert("ESCAPE");
  $(document).ready(function(){
      $("#txtproductodesc").focus();
        });
}

function mostrarmodal_descuento_atodo()
{
  $('#exampleModalLongdescuentotodo').modal()
  $('#exampleModalLongdescuentotodo').on('shown.bs.modal', function () {
             $("#txtdescuento_todo").focus();
          });
  document.frmmodificar_venta.txtdescuento_todo.select();
}


/*f1  112 f2  113
f3  114 f4  115 f5  116
f6  117 f7  118 f8  119
f9  120 f10 121 f11 122*/

function tecla(e)
{
    var evt = e ? e : event;
    var key = window.Event ? evt.which : evt.keyCode;
    //alert (key);
    
    /*if(key==118) //F7 CANTIDAD
      {
        mostrarmodal_modificar();
      }
    else if(key==121) // F10 ELIMINAR
    {
      mostrarmodal_eliminar();
    }
    else if(key==113) // F2 COBRAR
    {
      mostrarmodal_cobrar();
    }
    else if(key==120) // F9 RETIRAR
    {
      mostrarmodal_retirar();
    }
    else if(key==115) // F4 PRECIO
    {
      mostrarmodal_precio();
    }
    else if(key==119) // F8 DESCUENTO
    {
      mostrarmodal_descuento();
    }
    else if(key==114) // F3 OPERACION
    {
      mostrarmodal_operacion();
    }
    else if(key==27) // ESCAPE
    {
      presionar_tecla_escape();
    }
    else if(key==39) // FLECHA A LA DERECHA
    {
      //alert("focus en idpp");
      $("#idpp").focus();

    }
    else if(key==17) // TECLA CONTROL CTRL
    {
      //alert("Descuento total");
      mostrarmodal_descuento_atodo();
    }*/

    if(key==113) // F2 COBRAR
    {
      mostrarmodal_cobrar();
    }
    else if(key==27) // ESCAPE
    {
      presionar_tecla_escape();
    }
    else if(key==39) // FLECHA A LA DERECHA
    {
      //alert("focus en idpp");
      $("#idpp").focus();

    }
    else if(key==17) // TECLA CONTROL CTRL
    {
      //alert("Descuento total");
      mostrarmodal_descuento_atodo();
    }

}

$(document).keyup(function(e){
    if(e.which==27) {
        var txtid_venta_modificar=document.frmmodificar_venta.txtid_venta_modificar.value;
        var txtid_venta=document.frmmodificar_venta.txtid_venta.value;
        document.location.href = "modificar_venta.php?id_venta_modificar="+txtid_venta_modificar+"&id_venta="+txtid_venta; 
        $("#txtproductodesc").focus();
    }
});

    </script>


</form>	
  </body>
</html>
