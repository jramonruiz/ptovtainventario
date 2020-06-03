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
$id_tipo_movimiento=$_GET["id_tipo_movimiento"];
$nombre_cliente=$_GET["nombre_cliente"];

/// OBTENIENDO DESCUENTO DEL CLIENTE
/*$rsdc = mysql_query("SELECT descuento FROM cclientes where nombre_cliente='$nombre_cliente'");
if ($rowdc = mysql_fetch_row($rsdc)) {
$descuento_cliente = trim($rowdc[0]);
}*/

//// SUMANDO NUMERO DE PAGOS DE LA VENTA
$rsspv = mysql_query("SELECT COUNT(id_pago_venta) AS numeropagosventa FROM tpagos_venta where id_usuario=$id_usuario and id_area_venta=$id_area_venta and id_venta=0");
if ($rowspv = mysql_fetch_row($rsspv)) {
$numeropagosventa = trim($rowspv[0]);
}

/// SUMANDO MONTO DEL PAGO DE LA VENTA
$rssmpv = mysql_query("SELECT SUM(monto) AS total_pago_capturado FROM tpagos_venta where id_usuario=$id_usuario and id_area_venta=$id_area_venta and id_venta=0");
if ($rowsmpv = mysql_fetch_row($rssmpv)) {
$total_pago_capturado = trim($rowsmpv[0]);
}

///////// AGREGANDO TIPO DE OPERACION TICKET O AJUSTE DE SALIDA EN LA TABLA CAREASVENTA
$sqltov= mysql_query("update careasventa set tipo_operacion=$id_tipo_movimiento where id_area_venta=".$id_area_venta." and id_usuario=$id_usuario");

/// SUMANDO MONTO DEL PAGO DE LA VENTA
$rssumtotventa = mysql_query("SELECT SUM(subtotal) AS total_venta FROM tproductos_venta where id_usuario=$id_usuario and id_area_venta=$id_area_venta and id_venta=0");
if ($rowsumtotventa = mysql_fetch_row($rssumtotventa)) {
$totventa_areaventa = trim($rowsumtotventa[0]);
if($totventa_areaventa==NULL)
  {
    $totventa_areaventa=0.00;
  }
}

///////// AGREGANDO TOTAL DE LA VENTA EN EL AREA DE VENTA
$sqltotvav= mysql_query("update careasventa set total_venta=$totventa_areaventa where id_area_venta=".$id_area_venta." and id_usuario=$id_usuario");

/// SUMANDO MONTO DEL PAGO DE LA VENTA
$rsdatarevta = mysql_query("SELECT tipo_operacion,nombre_cliente,venta_directa,tipo_cliente FROM careasventa where id_usuario=$id_usuario and id_area_venta=$id_area_venta");
if ($rowdatarevta = mysql_fetch_row($rsdatarevta)) {
$id_tipo_movimiento = trim($rowdatarevta[0]);
$nombre_cliente = utf8_encode($rowdatarevta[1]);
$venta_directa = trim($rowdatarevta[2]);
$tipo_cliente = trim($rowdatarevta[3]);
}

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
    <link rel="stylesheet" href="../css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="../css/ionicons.min.css">
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
<script type="text/javascript" src="../js/login.js"></script>

<script>


  
  $(document).ready(function(){
    $("#txtproductodesc").focus();
});

  $(document).keydown(
    function(e)
    {    
        if (e.keyCode == 39) {      
            $(".move:focus").next().focus();
   
        }
        if (e.keyCode == 37) {      
            $(".move:focus").prev().focus();
   
        }
    }
);
  
</script>

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
  document.frm_nueva_venta.txtidfila.value=fila;

  /*$("table tbody tr").keyup(function() {
  var importe = $(this).find("td:last-child").text();
  alert(importe);
});*/

}
</script>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="hold-transition skin-yellow-light sidebar-mini" onload="cargar_pagos_venta(<?php echo $numeropagosventa.','.$total_pago_capturado; ?>);" onkeydown="tecla(event);"  onkeyup = "pulsar_tabla(event)">
<form id="frm_nueva_venta" name="frm_nueva_venta" action="" method="post"> 
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
  <input type="hidden" id="cmbtipo_operacionsel" name="cmbtipo_operacionsel" value="<?php echo $id_tipo_movimiento; ?>" />     
  <input type="hidden" id="txtnombrecliente" name="txtnombrecliente" value="<?php echo $nombre_cliente; ?>" />
  <input type="hidden" id="txtventa_directa" name="txtventa_directa" value="<?php echo $venta_directa; ?>" />
  <input type="hidden" id="txtnumeropagosventa" name="txtnumeropagosventa" value="<?php echo $numeropagosventa; ?>" />
  <input type="hidden" id="txttipo_cliente" name="txttipo_cliente" value="<?php echo $tipo_cliente; ?>" />     
  <input type="hidden" id="txtcantidad_productobuslis" name="txtcantidad_productobuslis" value="" />
  
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
            <?php "id_tipo_cliente: "+$tipo_cliente; ?>Ventas al mostrador &nbsp;<input type="hidden" id="txtid_areaventa" name="txtid_areaventa" value="<?php echo $id_area_venta; ?>" /> 
            <?php
              $queryavs = "select * from careasventa where enuso=1 and id_usuario=$id_usuario";
              $resultavs = mysql_query($queryavs) or die("SQL Error 1: " . mysql_error());
              while ($rowavs = mysql_fetch_array($resultavs)) 
                {
                  $id_area_vental=utf8_encode($rowavs[0]);
                  $nombre_area_venta=utf8_encode($rowavs[1]);
                  $total_venta_areaventa=utf8_encode($rowavs[8]);                  
                }
          ?>
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
                      // BUSCANDO TIPO DE MOVIMIENTO (TICKET O AJUSTE DE SALIDA) Y NOMBRE DEL CLIENTE
                      /*$rstmv = mysql_query("SELECT cav.nombre_cliente,cav.tipo_operacion,cc.descuento FROM careasventa cav inner join cclientes cc on cav.nombre_cliente=cc.nombre_cliente where cav.id_area_venta=$id_area_venta and cav.id_usuario=$id_usuario");
                      if ($rowdc = mysql_fetch_row($rstmv)) {
                      $nombre_cliente = utf8_encode($rowdc[0]);
                      $id_tipo_movimiento = utf8_encode($rowdc[1]);
                      $descuento_cliente_porcentaje = utf8_encode($rowdc[2]);
                      }*/

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
                            $tipomovimiento="TICKET";   
                        }

                        ?>
                      <td colspan="4" align="left"><h4>Cliente: <?php echo $nombre_cliente; ?></h4>
                      <td colspan="4" align="left"><h4>Operacion: <?php echo $tipomovimiento; ?></h4></td>
                      <td colspan="4" align="left"><h4>
                        <?php
                        if($venta_directa==0)
                        {
                        ?>
                        <input type="checkbox" id="chkvtadirecta" name="chkvtadirecta" style="width: 20px; height: 20px;" onclick="javascript:activar_venta_directa(1);">&nbsp;&nbsp;VENTA DIRECTA</h4>
                        <?php
                        }
                        else
                        {
                        ?>
                        <input type="checkbox" id="chkvtadirecta" name="chkvtadirecta" checked="checked" style="width: 20px; height: 20px;" onclick="javascript:activar_venta_directa(0);">&nbsp;&nbsp;VENTA DIRECTA</h4>
                        <?php
                        }
                        ?>
                      </td>
                    </tr>

                  </table>
                  

                  <table class="table table-bordered text-center" cellspacing="1" cellpadding="1">
                    <tr>
                      <td bgcolor="#E1E7E3"><h2>F2</h2><h5>Cobrar</h5></td>
                      <td bgcolor="#E1E7E3"><h2>F3</h2><h5>Buscar producto</h5></td>
                      <td bgcolor="#E1E7E3"><h2>F6</h2><h5>Clientes</h5></td>
                      <td>
                          <?php
                          $iva=0;     
                          $query = "select * from tproductos_venta where id_usuario=$id_usuario and id_venta=0 and id_area_venta=$id_area_venta";
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
                      <div class="col-xs-12">
                        <input list="productosauto" name="txtproductodesc" id="txtproductodesc" class="form-control" placeholder="nombre del producto o codigo de barras" onchange="buscar_producto_venta_cb2(this.value);" autocomplete="off">
                        <datalist id="productosauto" style="width: 100px;">
                             <?php
                            $consulta_catalogopa=mysql_query("select * from cproductos where id_sucursal=$id_sucursal");
                            while($resultado_catalogopa=mysql_fetch_array($consulta_catalogopa))
                            {
                            ?> 
                              <option value="<?php echo utf8_encode($resultado_catalogopa[descripcion].', $ '.$resultado_catalogopa[precio_venta].'<br>'); ?>" style="width: 1000px; font-size: 9px;"></option>        
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
$listado=  mysql_query("select tpv.id_producto_venta,tpv.id_venta,tpv.descripcion_producto,tpv.cantidad,tpv.precio_venta,tpv.subtotal,tpv.id_usuario,cp.stock_minimo,cp.cantidad_existencia,cp.codigo_barras,tpv.descuento,tpv.precio_neto,tpv.porcentaje_descuento from tproductos_venta tpv inner join cproductos cp on tpv.descripcion_producto=cp.descripcion where tpv.id_usuario=$id_usuario and tpv.id_venta=0 and tpv.id_area_venta=$id_area_venta order by tpv.id_producto_venta");
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
                                $precio_neto=mb_convert_encoding($reg['precio_neto'], "UTF-8");
                                $porcentaje_descuento=mb_convert_encoding($reg['porcentaje_descuento'], "UTF-8");
                                $pdescuento=$porcentaje_descuento/100;
                                $nomidpp="idpp".$considpp;
					?>					  
                        <tr onmouseover='this.style.background="yellow"' onmouseout='this.style.background="white"'>
                          <input class='move' type="hidden" name="<?php echo $nomidpp; ?>" id="<?php echo $nomidpp; ?>" value="<?php echo $id_producto_venta; ?>" onkeydown="tecla_idproducto(event,<?php echo $id_producto_venta; ?>); autofocus">
                          <td class="mailbox-star"><a onClick="javascript:eliminar_producto_venta(<?php echo $id_producto_venta; ?>);" style="cursor:pointer;"><i class="fa fa-remove text-red"></i></a>&nbsp;&nbsp;<input class='move' type="text" name="idpp" id="idpp" value="<?php echo $considpp; ?>" onkeydown="tecla_idproducto(event,<?php echo $considpp; ?>);" style="width: 50px;" autocomplete="off"></td>
                          <td class="mailbox-subject" id="list_descp"><b><?php echo $descripcion_producto; ?></b></td>
                          <td class="mailbox-subject" id="list_cant" style="cursor: pointer;" onclick="javascript:modificar_cantidad_click(<?php echo $id_producto_venta; ?>,<?php echo $cantidad; ?>);"><b><?php echo $cantidad; ?></b></td>
                          <td class="mailbox-subject" id="list_precio"><b><?php echo '$ '.$precio_venta; ?></b></td>
                          <td class="mailbox-subject" id="list_desc" style="cursor: pointer;" onclick="javascript:modificar_descuento_click(<?php echo $id_producto_venta; ?>,<?php echo $porcentaje_descuento; ?>);"><b><?php echo $porcentaje_descuento.' %'; ?></b></td>
                          <td class="mailbox-subject" id="list_neto"><b><?php echo '$ '.$precio_neto; ?></b></td>
                          <td class="mailbox-subject" id="list_subt"><b><?php echo '$ '.$subtotal; ?></b></td>
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

          <div class="box-header with-border" align="left">
        <button type="button" class="btn btn-primary" onClick="javascript:cancelar_venta_areaventa();">Cancelar Venta y Area de Venta</button>
        </div><!-- /.box-header -->         

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
                Producto:<input type="text" id="txtdescripcion_productomod" class="form-control" name="txtdescripcion_productomod" value="">
                </div>
                <div class="modal-body">
                Existencia:<input type="text" id="txtexistencia_productomod" class="form-control" name="txtexistencia_productomod" value="">
                </div>
                <div class="modal-body">
                Precio de venta:<input type="text" id="txtprecio_venta_mod" class="form-control" name="txtprecio_venta_mod" value="">
                </div>
                <div class="modal-body">
                <input type="hidden" id="txtdescuento_productomod" name="txtdescuento_productomod" value="0">
                Cantidad:<input type="number" id="txtcantidad_productomod" name="txtcantidad_productomod" class="form-control" value="1" onKeyPress="javascript:guardar_producto_venta_buscado_mod(event,this.value);">
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
                </div>
                <div class="modal-body">
                Producto<input list="productosavendere" name="txtdescripcion_productomode" id="txtdescripcion_productomode" autocomplete="off" class="form-control" placeholder="escribe el nombre del producto a eliminar" onKeyPress="javascript:eliminar_cantidad_producto_porvender(event,this.value);">
                <datalist id="productosavendere">
                       <?php
                              $consulta_catalogo_prodve=mysql_query("select * from tproductos_venta where id_venta=0 and id_usuario=$id_usuario and id_area_venta=$id_area_venta");
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
                Cantidad:<input type="number" id="txtcantidad_productomode" name="txtcantidad_productomode" onKeyPress="javascript:eliminar_cantidad_producto_porvender(event,this.value);" value="1">
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
                </div>
                <div class="modal-body">
                Producto<input list="productosavenderm" name="txtdescripcion_productomodm" id="txtdescripcion_productomodm" autocomplete="off" class="form-control" placeholder="escribe el nombre del producto a modificar" onKeyPress="cantidad_producto_buscadomod(event)">
                <datalist id="productosavenderm">
                       <?php
                              $consulta_catalogo_prodvm=mysql_query("select * from tproductos_venta where id_venta=0 and id_usuario=$id_usuario and id_area_venta=$id_area_venta");
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
                Cantidad:<input type="number" id="txtcantidad_productomodm" name="txtcantidad_productomodm" onKeyPress="javascript:modificar_cantidad_producto_porvender(event,this.value);" value="1">
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
                <input type="hidden" id="txttotalpagar_modal_sindesc" name="txttotalpagar_modal_sindesc" value="<?php echo $total_pagar; ?>">
                <?php
                    $rsdescli = mysql_query("SELECT descuento FROM cclientes where nombre_cliente='$nombre_cliente'");
                      if ($rowdescli = mysql_fetch_row($rsdescli)) {
                      $descuento_cliente_porcentaje = utf8_encode($rowdescli[0]);
                      }
                  $descuentoalcliente=($total_pagar*$descuento_cliente_porcentaje)/100;
                  $total_pagar=$total_pagar-$descuentoalcliente;
                ?>
                <input type="hidden" id="txtdescuento_venta" name="txtdescuento_venta" value="<?php echo $descuentoalcliente; ?>">
                <input type="hidden" id="txtdescuento_porcentaje" name="txtdescuento_porcentaje" value="<?php echo $descuento_cliente_porcentaje; ?>">
                <h3>Total a pagar: $ <?php echo $total_pagar; ?><input type="hidden" id="txttotalpagar_modal" name="txttotalpagar_modal" value="<?php echo $total_pagar; ?>"  onKeyPress="javascript:guardar_ajuste_salida(event);"></h3>
                </div>
                <div class="modal-body">
                Importe Recibido:<input type="number" id="txtimporte_recibido" name="txtimporte_recibido" class="form-control" placeholder="capture el importe recibido" onKeyPress="javascript:calcular_cambio_venta_modal(event,this.value);" value="<?php echo $total_pagar; ?>">
                </div>
                <div class="modal-body">
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
                <h1>CAMBIO:<input type="text" id="txtcambio_ventamodal" name="txtcambio_ventamodal" value="" onKeyPress="javascript:guardar_venta_modal(event);"></h1>
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
                Motivo del retiro:<input type="text" id="txtmotivo_retiro" name="txtmotivo_retiro" class="form-control" placeholder="Escriba el motivo del retiro">
                </div>
                <div class="modal-body">
                Importe a retirar:<input type="number" id="txtimporte_retirar" name="txtimporte_retirar" class="form-control" placeholder="capture el importe a retirar" onKeyPress="javascript:guardar_retiro(event,this.value);" value="1">
                </div>
              </div>
            </div>
          </div> 

<!-- Modal para CAMBIAR PRECIO F4 -->
          <div class="modal fade" id="exampleModalLongprecio" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLongTitle">PRECIO</h5>
                </div>
                <div class="modal-body">
                <input type="hidden" id="txtid_productomodprecio" name="txtid_productomodprecio">
                </div>
                <div class="modal-body">
                Producto<input list="productosavenderprecio" name="txtdescripcion_productomodprecio" id="txtdescripcion_productomodprecio" autocomplete="off" class="form-control" placeholder="escribe el nombre del producto a modificar el precio" onKeyPress="javascript:eliminar_cantidad_producto_porvender(event,this.value);">
                <datalist id="productosavenderprecio">
                       <?php
                              $consulta_catalogo_prodve=mysql_query("select * from tproductos_venta where id_venta=0 and id_usuario=$id_usuario and id_area_venta=$id_area_venta");
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
                Precio:<input type="number" id="txtprecio_productomodprec" name="txtprecio_productomodprec" onKeyPress="javascript:cambiar_precio_producto_porvender(event,this.value);">
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
                </div>
                <div class="modal-body">
                Producto<input list="productosavenderdescuento" name="txtdescripcion_productomoddescuento" id="txtdescripcion_productomoddescuento" autocomplete="off" class="form-control" placeholder="escribe el nombre del producto a modificar el descuento" onKeyPress="javascript:modificar_descuento_producto_porvender(event,this.value);">
                <datalist id="productosavenderdescuento">
                       <?php
                              $consulta_catalogo_prodve=mysql_query("select * from tproductos_venta where id_venta=0 and id_usuario=$id_usuario and id_area_venta=$id_area_venta");
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
                Descuento en %:<input type="number" id="txtdescuento_productomoddesc" name="txtdescuento_productomoddesc" onKeyPress="javascript:modificar_descuento_producto_porvender(event,this.value);" value="0">
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
                Descuento en %:<input type="number" id="txtdescuento_todo" name="txtdescuento_todo" onKeyPress="javascript:modificar_descuento_todo(event,this.value);" value="0">
                </div>
              </div>
            </div>
          </div>       


<!-- Modal para OPERACION F3 EL id_tipo_operacion=1 es VENTA, id_tipo_operacion=2 es AJUSTE -->
          <div class="modal fade" id="exampleModalLongoperacion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLongTitle">OPERACION</h5>
                </div>
               <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>Descripcion</th>
                        <th>Precio de Venta</th>
                        <th>Existencia</th>
                        <th>Cantidad vender</th>
                      </tr>
                    </thead>
                    <tbody>
<?php 
$listado=  mysql_query("select id_producto,descripcion,precio_venta,cantidad_existencia,stock_minimo,descto_salon,descto_mayorista from cproductos  where id_sucursal=$id_sucursal order by descripcion");

$fecha_hoy= date("Y-m-d");

                   while($reg=  mysql_fetch_array($listado))
                   {
                    $id_producto=mb_convert_encoding($reg['id_producto'], "UTF-8");
                    $descripcion=utf8_encode($reg['descripcion']);
                    $precio_venta=mb_convert_encoding($reg['precio_venta'], "UTF-8");
                    $cantidad_existencia=mb_convert_encoding($reg['cantidad_existencia'], "UTF-8");
                    $stock_minimo=mb_convert_encoding($reg['stock_minimo'], "UTF-8");


          if($cantidad_existencia<$stock_minimo)
            {
          ?>
                      <tr>
                        <td><font color="red" style="font-weight:bolder;"><?php echo $descripcion; ?></font></td>
                        <td><font color="red" style="font-weight:bolder;"><?php echo $precio_venta; ?></font></td>
                        <td><font color="red" style="font-weight:bolder;"><?php echo $cantidad_existencia; ?></font></td>
                        <th><input type="text" name="txtcantidadproductobuslis" id="txtcantidadproductobuslis" value="1" style="width: 50px;" onKeyPress='javascript:agregar_cantidad_producto_buscado(event,this.value,<?php echo $id_producto; ?>);'></th>
             </tr>
          <?php
            }
          else
            {
          ?>
                      <tr>
                        <td><?php echo $descripcion; ?></td>
                        <td><?php echo $precio_venta; ?></td>
                        <td><?php echo $cantidad_existencia; ?></td>
                        <th><input type="text" name="txtcantidadproductobuslis" id="txtcantidadproductobuslis" value="1" style="width: 50px;" onKeyPress='javascript:agregar_cantidad_producto_buscado(event,this.value,<?php echo $id_producto; ?>);'></th>
            
<!--            <td><button type="button" class="btn btn-warning btn-fa-times"><i class="fa fa-times"></i></button></td>                                    
-->                      </tr>
          <?php
            } 
?>        
<?php
        }
?>            
                    </tbody>
                    <tfoot>
                      <tr>
                        <th>Descripcion</th>
                        <th>Precio de Venta</th>
                        <th>Existencia</th>
                        <th>Cantidad vender</th>
                      </tr>
                    </tfoot>
                  </table>
              </div>
            </div>
          </div>          


<!-- Modal para CLIENTES F6 -->
          <div class="modal fade" id="exampleModalLongclientes" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLongTitle">CLIENTES</h5>
                </div>
                <div class="modal-body">
                Cliente<input list="clientes" name="txtcliente" id="txtcliente" autocomplete="off" class="form-control" placeholder="escribe el nombre del cliente" onKeyPress="javascript:buscar_cliente_descuento(event);">
                <datalist id="clientes">
                       <?php
                              $consulta_catalogo_cliente=mysql_query("select * from cclientes");
                              while($resultado_catalogocliente=mysql_fetch_array($consulta_catalogo_cliente))
                              {
                              ?> 
                                <option value="<?php echo utf8_encode($resultado_catalogocliente[nombre_cliente]); ?>">        
                                      <?php 
                              } 
                      ?> 
                </datalist>
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
  $('#exampleModalLongcobrar').modal()
  $('#exampleModalLongcobrar').on('shown.bs.modal', function () {
             $("#txtimporte_recibido").focus();
          });
  document.frm_nueva_venta.txtimporte_recibido.select();
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
  document.frm_nueva_venta.txtdescripcion_productomoddescuento.select();
}

function mostrarmodal_operacion()
{
  $('#exampleModalLongoperacion').modal()
  $('#exampleModalLongoperacion').on('shown.bs.modal', function () {
             $("#txtoperacion").focus();
             $('div.dataTables_filter input').focus();
          });
}

function mostrarmodal_clientes()
{
  $('#exampleModalLongclientes').modal()
  $('#exampleModalLongclientes').on('shown.bs.modal', function () {
             $("#txtcliente").focus();
          });
}

function mostrarmodal_descuento_atodo()
{
  $('#exampleModalLongdescuentotodo').modal()
  $('#exampleModalLongdescuentotodo').on('shown.bs.modal', function () {
             $("#txtdescuento_todo").focus();
          });
  document.frm_nueva_venta.txtdescuento_todo.select();
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
    else if(key==117) // F6 CLIENTES
    {
      mostrarmodal_clientes();
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
    else if(key==117) // F6 CLIENTES
    {
      mostrarmodal_clientes();
    }
    else if(key==114) // F3 OPERACION
    {
      mostrarmodal_operacion();
    }

}

$(document).keyup(function(e){
    if(e.which==27) {
        var txtid_areaventa=document.frm_nueva_venta.txtid_areaventa.value;
        document.location.href = "nueva_venta.php?id_area_venta="+txtid_areaventa; 
        $("#txtproductodesc").focus();
    }
});


    </script>


</form>	
  </body>
</html>