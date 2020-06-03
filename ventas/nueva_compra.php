<?php
error_reporting(0);
$tipusr="";
$paginterior=0;
include("../php/autentificacion.server.php");
session_name("lgsapplipweb");
session_start();
session_set_cookie_params(0, "/", $HTTP_SERVER_VARS["HTTP_HOST"], 0);

$id_usuario=$_SESSION["iduser"];
$id_sucursal=$_SESSION["sucursal"];

include("../php/conexion.php");
$connect = mysql_connect($hostname, $username, $password)
or die('Could not connect: ' . mysql_error());
//Select The database
$con = mysql_select_db($database, $connect);

$sq2 = "select nombre_cliente from cclientes order by nombre_cliente";
$res2 = mysql_query($sq2);
$arreglo_php2 = array();
if(mysql_num_rows($res2)==0)
   array_push($arreglo_php2, "No hay datos");
else{
  while($palabras2 = mysql_fetch_array($res2)){
    array_push($arreglo_php2, $palabras["nombre_cliente"]);
  }
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
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
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
  
<script type="text/javascript" src="../js/operaciones.js"></script>
  
<link rel="stylesheet" href="../css/ui-lightness/jquery-ui-1.10.3.custom.css" />
<!--scripts de HOJAS DE ESTILO CSS para el calendario------------->
<link rel="stylesheet" href="jquery-ui.css" />
<!---------------Aqui termina------------------------------>


<!--scripts de JAVASCRIPT para el calendario------------->
<script src="../js/jquery-1.9.0.js"></script>
<script src="../js/jquery-ui.js"></script>
<script>
$(function() {
$( "#datepicker1" ).datepicker();
});
</script>
<script>
$(function() {
$( "#datepicker2" ).datepicker();
});
</script>
<!---------------Aqui termina------------------------------> 

<script>
  
  $(document).ready(function(){
    $("#txtproductodesc").focus();
});

</script>
  
<script src="../js/jquery-1.9.1.js" type="text/javascript"></script>
<script src="../js/jquery-ui-1.10.3.custom.js" type="text/javascript"></script> 
  
    
  </head>
  <body class="hold-transition skin-yellow-light sidebar-mini" onkeydown="tecla(event);">
<form id="frm_nueva_compra" name="frm_nueva_compra" action="" method="post"> 
  <input id="sel" type="hidden" value="-1">
  <input id="oper" name="oper" type="hidden" value=""> 
  <input type="hidden" id="txtnum_pag" name="txtnum_pag" value="" /> 
  <input id="txtfilepageserver" type="hidden" value=""/>   
<input type="hidden" id="txtid_producto_buscar" name="txtid_producto_buscar" value="" /> 
<input type="hidden" id="txtcantidad_existencia_producto_buscar" name="txtcantidad_existencia_producto_buscar" value="" />
<input type="hidden" id="cambio_venta" name="cambio_venta" value="" />
  <input type="hidden" id="txtid_producto" name="txtid_producto" value="" /> 
  <input type="hidden" id="txtcantidad_producto" name="txtcantidad_producto" value="" /> 
  <input type="hidden" id="txtidproductonavegando" name="txtidproductonavegando" value="" />   
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
            Nueva compra&nbsp;&nbsp;&nbsp;<button type="button" class="btn btn-primary" onClick="javascript:mostrarmodal_operacion();">Buscar producto</button>
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
                      <td bgcolor="#E1E7E3"><h2>F2</h2><h5>Guardar</h5></td>
                      <!--td bgcolor="#E1E7E3"><h2>F4</h2><h5>Precio</h5></td>
                      <td bgcolor="#E1E7E3"><h2>F6</h2><h5>Descuento</h5></td>
                      <td bgcolor="#E1E7E3"><h2>F7</h2><h5>Eliminar</h5></td>
                      <td bgcolor="#E1E7E3"><h2>F8</h2><h5>Cantidad</h5></td-->
                      <td>
                          <?php
                          $iva=0;     
                          $query = "select * from tproductos_compra where id_usuario=$id_usuario and id_compra=0";
                          $result = mysql_query($query) or die("SQL Error 1: " . mysql_error());
                          $total_pagar=0;
                          while ($row = mysql_fetch_array($result)) 
                          {
                          $importe=utf8_encode($row[11]);
                          $total_pagar=$total_pagar+$importe;
                          }
                          ?>
                          <h1>$ <?php echo $total_pagar; ?></h1><h5>TOTAL</h5>
                          <input id="txttotal_venta" name="txttotal_venta" type="hidden" value="<?php echo $total_pagar; ?>"><input id="txtiva" name="txtiva" type="hidden" value="<?php echo $iva; ?>">
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
                        <input list="productosauto" name="txtproductodesc" id="txtproductodesc" class="form-control" placeholder="nombre del producto o codigo de barras" onchange="buscar_producto_comprar_desc_codbarras(this.value);" autocomplete="off">
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
                  <h3 class="box-title">Productos Comprados</h3>
                </div><!-- /.box-header -->
<?php
$listado=  mysql_query("select tpc.id_producto_compra,tpc.descripcion_producto,tpc.cantidad_comprada,cp.precio_compra as ultimo_precio,tpc.precio_compra,tpc.descuento,tpc.importe from tproductos_compra tpc inner join cproductos cp on tpc.id_producto=cp.id_producto where tpc.id_usuario=$id_usuario and tpc.id_compra=0 order by tpc.id_producto_compra");
?>        
                  <div class="table-responsive mailbox-messages">
                    <table class="table table-hover table-striped">
                      <tbody>
                        <tr>
                          <td class="mailbox-star">Eliminar</td>
                          <td class="mailbox-subject">Producto</td>
                          <td class="mailbox-subject">Cantidad</td>
                          <td class="mailbox-subject">Precio</td>
                          <td class="mailbox-subject">Descuento</td>
                          <td class="mailbox-subject">Importe</td>
                        </tr>                      
          <?php
                     while($reg=  mysql_fetch_array($listado))
                      {
                  $id_producto_compra=mb_convert_encoding($reg['id_producto_compra'], "UTF-8");
                $cantidad_comprada=mb_convert_encoding($reg['cantidad_comprada'], "UTF-8");
                $ultimo_precio=mb_convert_encoding($reg['ultimo_precio'], "UTF-8");         
                $descripcion_producto=utf8_encode($reg['descripcion_producto']);
                                $precio_compra=mb_convert_encoding($reg['precio_compra'], "UTF-8");
                                $descuento=mb_convert_encoding($reg['descuento'], "UTF-8");
                                $importe=mb_convert_encoding($reg['importe'], "UTF-8");
          ?>            
                        <tr onmouseover='this.style.background="yellow"' onmouseout='this.style.background="white"'>
                          <td class="mailbox-star"><a onClick="javascript:eliminar_producto_compra(<?php echo $id_producto_compra; ?>);" style="cursor:pointer;"><i class="fa fa-remove text-red"></i></a></td>
                          <td class="mailbox-subject"><b><?php echo $descripcion_producto; ?></b></td>
                          <td onmouseover='this.style.background="#3EEE5B"' onmouseout='this.style.background="white"' class="mailbox-subject" style="cursor: pointer;" onclick="javascript:modificar_cantidad_comprada_click(<?php echo $id_producto_compra; ?>,<?php echo $cantidad_comprada; ?>);"><b><?php echo $cantidad_comprada; ?></b></td>
                          <td onmouseover='this.style.background="#3EEE5B"' onmouseout='this.style.background="white"' class="mailbox-subject" style="cursor: pointer;" onclick="javascript:modificar_precio_compra_click(<?php echo $id_producto_compra; ?>,<?php echo $precio_compra; ?>);"><b><?php echo $precio_compra; ?></b></td>
                          <td class="mailbox-subject"><b><?php echo $descuento; ?></b></td>
                          <td class="mailbox-subject"><b><?php echo $importe; ?></b></td>
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

          
        
          <!-- /.box-header -->
              </div><!-- /.box -->
            </div><!--/.col (right) -->
          </div><!-- /.row -->

          <div class="row">
            <!-- right column -->
            <div class="col-md-12">
              <!-- general form elements disabled -->
              <div class="box box-warning">
                <div class="box-header with-border">
                  <h3 class="box-title">Datos del documento</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <!-- text input -->
                    <div class="form-group">
                      <input list="proveedores" name="txtnombre_proveedor" id="txtnombre_proveedor" autocomplete="off" class="form-control" placeholder="nombre del proveedor" onKeyPress="buscar_proveedor_compra(event)">
                  <datalist id="proveedores">
         <?php
                $consulta_catalogo=mysql_query("select * from cproveedores");
        while($resultado_catalogo=mysql_fetch_array($consulta_catalogo))
        {
        ?> 
          <option value="<?php echo utf8_encode($resultado_catalogo[nombre_empresa]); ?>">        
                <?php 
        } 
        ?> 
     </datalist>
            <!--<br>
            R.F.C.: <b>RFC DEL CLIENTE</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Domicilio: <b>DOMICILIO DEL CLIENTE</b>-->
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Numero del documento</label>
                        <input id="txtnumero_documento" name="txtnumero_documento" class="form-control input-lg" type="text" placeholder="escriba el numero de la factura o documento">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Fecha del documento</label>
                      <input type="text" id="datepicker1" name="datepicker1" />
                      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    </div>
                    <div class="form-group">
                      <label>Tipo de movimiento</label>
                      <select id="cmbtipo_movimiento" name="cmbtipo_movimiento" class="form-control">
                              <option value="1">[compra directa]</option>
                      </select>
                    </div>
                </div><!-- /.box-body -->
        <!-- /.box-header -->   

              </div><!-- /.box -->
            </div><!--/.col (right) -->
      
          </div><!-- /.row -->          

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
          <div class="modal fade" id="exampleModalLong_compra" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLongTitle">CANTIDAD DEL PRODUCTO</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                <input type="hidden" id="txtid_productomodcom" name="txtid_productomodcom" value="">
                Producto:<input type="text" id="txtdescripcion_productomodcom" name="txtdescripcion_productomodcom" value="" style="width: 550px;">
                </div>
                <div class="modal-body">
                Existencia:<input type="text" id="txtexistencia_productomodcom" name="txtexistencia_productomodcom" value="">
                </div>
                <div class="modal-body">
                Ultimo precio de compra:<input type="text" id="txtprecio_compra_modcom" name="txtprecio_compra_modcom" value="">
                </div>
                <div class="modal-body">
                Nuevo precio de compra:<input type="text" id="txtnuevo_precio_compra_modcom" name="txtnuevo_precio_compra_modcom" value="">
                </div>
                <div class="modal-body">
                Precio de venta:<input type="text" id="txtprecio_venta_modcom" name="txtprecio_venta_modcom" value="">
                </div>
                <div class="modal-body">
                <input type="hidden" id="txtdescuento_productomodcom" name="txtdescuento_productomodcom" value="0">
                Cantidad:<input type="text" id="txtcantidad_productomodcom" name="txtcantidad_productomodcom" value="1" onKeyPress="javascript:guardar_producto_compra_buscado_mod(event,this.value);">
                </div>
              </div>
            </div>
          </div>

 <!-- Modal para CANTIDAD DEL PRODUCTO A ELIMINAR F7 -->
          <div class="modal fade" id="exampleModalLongeli" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLongTitle">ELIMINAR PRODUCTO</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                <input type="hidden" id="txtid_productomode" name="txtid_productomode">
                </div>
                <div class="modal-body">
                Producto<input list="productosavendere" name="txtdescripcion_productomode" id="txtdescripcion_productomode" autocomplete="off" class="form-control" placeholder="escribe el nombre del producto a eliminar" onKeyPress="javascript:eliminar_cantidad_producto_porvender(event,this.value);">
                <datalist id="productosavendere">
                       <?php
                              $consulta_catalogo_prodve=mysql_query("select * from tproductos_compra where id_compra=0 and id_usuario=$id_usuario");
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
                Cantidad:<input type="text" id="txtcantidad_productomode" name="txtcantidad_productomode" onKeyPress="javascript:eliminar_cantidad_producto_porcomprar(event,this.value);">
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-primary" data-dismiss="modal" onClick="javascript:aceptar_terminos_contrato();">ACEPTO</button>
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
                        <th>Precio de Compra</th>
                        <th>Existencia</th>
                        <th>Cantidad a comprar</th>
                      </tr>
                    </thead>
                    <tbody>
<?php 
$listado=  mysql_query("select id_producto,descripcion,precio_compra,precio_venta,cantidad_existencia,stock_minimo,descto_salon,descto_mayorista from cproductos  where id_sucursal=$id_sucursal order by descripcion");

$fecha_hoy= date("Y-m-d");

                   while($reg=  mysql_fetch_array($listado))
                   {
                    $id_producto=mb_convert_encoding($reg['id_producto'], "UTF-8");
                    $descripcion=utf8_encode($reg['descripcion']);
                    $precio_compra=mb_convert_encoding($reg['precio_compra'], "UTF-8");
                    $precio_venta=mb_convert_encoding($reg['precio_venta'], "UTF-8");
                    $cantidad_existencia=mb_convert_encoding($reg['cantidad_existencia'], "UTF-8");
                    $stock_minimo=mb_convert_encoding($reg['stock_minimo'], "UTF-8");


          if($cantidad_existencia<$stock_minimo)
            {
          ?>
                      <tr>
                        <td><font color="red" style="font-weight:bolder;"><?php echo $descripcion; ?></font></td>
                        <td><font color="red" style="font-weight:bolder;"><?php echo $precio_compra; ?></font></td>
                        <td><font color="red" style="font-weight:bolder;"><?php echo $cantidad_existencia; ?></font></td>
                        <th><input type="text" name="txtcantidadproductobuslis" id="txtcantidadproductobuslis" value="1" style="width: 50px;" onKeyPress='javascript:agregar_cantidad_producto_buscado_compra(event,this.value,<?php echo $id_producto; ?>);'></th>
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
                        <th><input type="text" name="txtcantidadproductobuslis" id="txtcantidadproductobuslis" value="1" style="width: 50px;" onKeyPress='javascript:agregar_cantidad_producto_buscado_compra(event,this.value,<?php echo $id_producto; ?>);'></th>
            
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
                        <th>Precio de Compra</th>
                        <th>Existencia</th>
                        <th>Cantidad a comprar</th>
                      </tr>
                    </tfoot>
                  </table>
              </div>
            </div>
          </div>          

          <!-- Modal para EL PRECIO DEL PRODUCTO F4 -->
          <div class="modal fade" id="exampleModalLongprecio" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLongTitle">PRECIO</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                <input type="hidden" id="txtid_productomodprecio" name="txtid_productomodprecio">
                </div>
                <div class="modal-body">
                Producto:<input type="text" id="txtdescripcion_productomodprecio" name="txtdescripcion_productomodprecio">
                </div>
                <div class="modal-body">
                Precio:<input type="text" id="txtprecio_productomodprec" name="txtprecio_productomodprec" onKeyPress="javascript:cambiar_precio_producto_porcomprar(event,this.value);" value="0">
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-primary" data-dismiss="modal" onClick="javascript:aceptar_terminos_contrato();">ACEPTO</button>
                </div>
              </div>
            </div>
          </div>


        <!-- Modal para CANTIDAD DEL PRODUCTO A MODIFICAR F8 -->
          <div class="modal fade" id="exampleModalLongmod" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLongTitle">MODIFICAR CANTIDAD PRODUCTO</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                <input type="hidden" id="txtid_productomodm" name="txtid_productomodm">
                </div>
                <div class="modal-body">
                  Descripcion:<input type="text" id="txtdescripcion_productomodm" name="txtdescripcion_productomodm">
                </div>
                <div class="modal-body">
                Cantidad:<input type="text" id="txtcantidad_productomodm" name="txtcantidad_productomodm" onKeyPress="javascript:modificar_cantidad_producto_porcomprar(event,this.value);" value="1">
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-primary" data-dismiss="modal" onClick="javascript:aceptar_terminos_contrato();">ACEPTO</button>
                </div>
              </div>
            </div>
          </div>

<!-- Modal para GUARDAR COMPRA F2 -->
          <div class="modal fade" id="exampleModalLongcobrar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLongTitle">GUARDAR COMPRA</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                <h3>TOTAL DE LA COMPRA: $<input type="text" id="txttotal_compra" name="txttotal_compra" value="<?php echo $total_pagar; ?>" onKeyPress="javascript:guardar_compra_modal(event);"></h3>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-primary" data-dismiss="modal" onClick="javascript:aceptar_terminos_contrato();">ACEPTO</button>
                </div>
              </div>
            </div>
          </div>  



     <!-- Bootstrap 3.3.5 -->
    <script src="../bootstrap/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="../plugins/fastclick/fastclick.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../dist/js/app.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="../dist/js/demo.js"></script>    
    <script src="../plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="../plugins/datatables/dataTables.bootstrap.min.js"></script>   

    <!-- page script -->
    <script>
      $(function () {
        $("#example1").DataTable();
        $('#example2').DataTable({
          "paging": true,
          "lengthChange": false,
          "searching": true,
          "ordering": true,
          "info": true,
          "autoWidth": false
        });
      });
    </script>

    <script>

    function disableFunctionKeys(e) {
    var functionKeys = new Array(112, 113, 115, 116, 117, 118, 119, 120, 121, 123);
    if (functionKeys.indexOf(e.keyCode) > -1 || functionKeys.indexOf(e.which) > -1) {
        e.preventDefault();
    }
};

$(document).ready(function() {
    $(document).on('keydown', disableFunctionKeys);
});

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
             $("#txttotal_compra").focus();
          });
}

function mostrarmodal_retirar()
{
  $('#exampleModalLongretirar').modal()
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
}

function mostrarmodal_operacion()
{
  $('#exampleModalLongoperacion').modal()
  $('#exampleModalLongoperacion').on('shown.bs.modal', function () {
          
          });
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
    if(key==118) //F7 ELIMINAR
      {
        mostrarmodal_eliminar();
      }
    else if(key==113) // F2 COBRAR
    {
      mostrarmodal_cobrar();
    }
    else if(key==123) // F12 RETIRAR
    {
      mostrarmodal_retirar();
    }
    else if(key==119) // F8 CANTIDAD
    {
      mostrarmodal_modificar();
    }
    else if(key==115) // F4 PRECIO
    {
     //mostrarmodal_operacion();
     mostrarmodal_precio();
    }
    /*else if(key==114) // F3 MOSTRAR LISTADO DE PRODUCTOS
    {
      mostrarmodal_operacion();
    }*/
}

$(document).keyup(function(e){
    if(e.which==27) {
        document.location.href = "nueva_compra.php"; 
        $("#txtproductodesc").focus();
    }
});


    </script>
<!--Aqui termina--> 

</form> 
  </body>
</html>