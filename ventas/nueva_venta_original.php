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
    <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="../dist/css/skins/_all-skins.min.css">
	
<script type="text/javascript" src="../js/operaciones.js"></script>
<script type="text/javascript" src="../js/login.js"></script>

<script>
  $(function(){
    var autocompletar = new Array();
    <?php //Esto es un poco de php para obtener lo que necesitamos
     for($p = 0;$p < count($arreglo_php2); $p++){ //usamos count para saber cuantos elementos hay ?>
       autocompletar.push('<?php echo $arreglo_php2[$p]; ?>');
     <?php } ?>
     $("#txtnombre_cliente").autocomplete({ //Usamos el ID de la caja de texto donde lo queremos
       source: autocompletar //Le decimos que nuestra fuente es el arreglo
     });
  });
  
</script>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="hold-transition skin-yellow-light sidebar-mini" onkeydown="tecla(event);">
<form id="frm_nueva_venta" name="frm_nueva_venta" action="" method="post"> 
  <input id="sel" type="hidden" value="-1">
  <input id="oper" name="oper" type="hidden" value=""> 
  <input type="hidden" id="txtnum_pag" name="txtnum_pag" value="" /> 
  <input id="txtfilepageserver" type="hidden" value=""/>   
<input type="hidden" id="txtid_producto_buscar" name="txtid_producto_buscar" value="" /> 
<input type="hidden" id="txtcantidad_existencia_producto_buscar" name="txtcantidad_existencia_producto_buscar" value="" />
<input type="hidden" id="cambio_venta" name="cambio_venta" value="" />
  <input type="hidden" id="txtid_producto" name="txtid_producto" value="" /> 
  <input type="hidden" id="txtcantidad_producto" name="txtcantidad_producto" value="" />   
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
            Ventas al mostrador
          </h1>
        </section>
        <!-- Main content -->
        <section class="content">

<div class="row">
            <!-- right column -->
            <div class="col-md-12">
              <!-- general form elements disabled -->
              <div class="box box-warning">
                <div class="box-body">
                    <!-- text input -->
                    <div class="form-group">
                      <div class="col-xs-4">
                        <input type="text" name="txtcodigobp" id="txtcodigobp" class="form-control" placeholder="codigo de barras" onchange="buscar_producto_venta_cb();">
                      </div>
                      <div class="col-xs-8">
                        <input type="text" name="txtbuscarproducto_venta" id="txtbuscarproducto_venta" class="form-control" placeholder="PRESIONE LA TECLA ENTER PARA BUSQUEDA DE PRODUCTO" onKeyPress="buscar_producto_venta_formulario(event)">
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
$listado=  mysql_query("select tpv.id_producto_venta,tpv.id_venta,tpv.descripcion_producto,tpv.cantidad,tpv.precio_venta,tpv.subtotal,tpv.id_usuario,cp.stock_minimo,cp.cantidad_existencia,cp.codigo_barras from tproductos_venta tpv inner join cproductos cp on tpv.descripcion_producto=cp.descripcion where tpv.id_usuario=$id_usuario and tpv.id_venta=0 order by tpv.id_producto_venta");
?>				
                  <div class="table-responsive mailbox-messages">
                    <table class="table table-hover table-striped">
                      <tbody>
                        <tr>
                          <td class="mailbox-star">Eliminar</td>
                          <td class="mailbox-subject">Codigo de barras</td>
                          <td class="mailbox-subject">Cantidad</td>
                          <td class="mailbox-subject">Producto</td>
                          <td class="mailbox-subject">Total</td>
                        </tr>                      
					<?php
	                   while($reg=  mysql_fetch_array($listado))
		                  {
   								$id_producto_venta=mb_convert_encoding($reg['id_producto_venta'], "UTF-8");
								$cantidad_existencia=mb_convert_encoding($reg['cantidad_existencia'], "UTF-8");
								$stock_minimo=mb_convert_encoding($reg['stock_minimo'], "UTF-8");					
								$descripcion_producto=mb_convert_encoding($reg['descripcion_producto'], "UTF-8");
                                $cantidad=mb_convert_encoding($reg['cantidad'], "UTF-8");
                                $precio_venta=mb_convert_encoding($reg['precio_venta'], "UTF-8");
                                $subtotal=mb_convert_encoding($reg['subtotal'], "UTF-8");
                                $cantida_existencia=mb_convert_encoding($reg['cantidad_existencia'], "UTF-8");
                                $stock_minimo=mb_convert_encoding($reg['stock_minimo'], "UTF-8");
                                $codigo_barras=mb_convert_encoding($reg['codigo_barras'], "UTF-8");
					?>					  
                        <tr>
                          <td class="mailbox-star"><a onClick="javascript:eliminar_producto_venta(<?php echo $id_producto_venta; ?>);" style="cursor:pointer;"><i class="fa fa-remove text-red"></i></a></td>
                          <td class="mailbox-subject"><b><?php echo $codigo_barras; ?></b></td>
                          <td class="mailbox-subject"><b><?php echo $cantidad; ?></b></td>
                          <td class="mailbox-subject"><b><?php echo $descripcion_producto; ?></b></td>
                          <td class="mailbox-subject"><b>$ <?php echo $subtotal; ?></b></td>
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
                  <input id="txttotal_venta" name="txttotal_venta" type="hidden" value="<?php echo $total_venta_sin_iva_redondeado; ?>"><input id="txtiva" name="txtiva" type="hidden" value="<?php echo $iva; ?>">&nbsp;&nbsp;&nbsp;<h1>Total a pagar: $&nbsp;<?php echo $total_pagar; ?><input id="txttotalpagar" name="txttotalpagar" type="hidden" value="<?php echo $total_pagar; ?>">&nbsp;&nbsp;&nbsp;<h3 class="box-title">Pago: </h3><input id="txtpago_venta" name="txtpago_venta" type="text" value="" onKeyPress="calcular_cambio_venta(event)">&nbsp;&nbsp;&nbsp; <h3 class="box-title">Cambio: </h3><input id="txtcambio_venta" name="txtcambio_venta" type="hidden" value="">&nbsp;&nbsp;&nbsp;<input type="text" id="cambio_venta2" name="cambio_venta2" disabled="disabled" value=""></h1>
          </div><!-- /.box-header -->
              </div><!-- /.box -->
            </div><!--/.col (right) -->
          </div><!-- /.row -->

          <div class="row">
            <!-- right column -->
            <div class="col-md-12">
              <!-- general form elements disabled -->
              <div class="box box-warning">
                <div class="box-header with-border">
                  <h3 class="box-title">Datos del cliente</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <!-- text input -->
                    <div class="form-group">
                      <input list="clientes" name="txtnombre_cliente" id="txtnombre_cliente" autocomplete="off" class="form-control" placeholder="nombre del cliente" onKeyPress="buscar_cliente_venta(event)">
                  <datalist id="clientes">
         <?php
                $consulta_catalogo=mysql_query("select * from cclientes");
        while($resultado_catalogo=mysql_fetch_array($consulta_catalogo))
        {
        ?> 
          <option value="<?php echo utf8_encode($resultado_catalogo[nombre_cliente]); ?>">        
                <?php 
        } 
        ?> 
     </datalist>
            <!--<br>
            R.F.C.: <b>RFC DEL CLIENTE</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Domicilio: <b>DOMICILIO DEL CLIENTE</b>-->
                    </div>
                </div><!-- /.box-body -->
        <div class="box-header with-border" align="right">
        <button type="button" class="btn btn-primary" onClick="javascript:guardar_venta();">Guardar Venta</button>
        </div><!-- /.box-header -->   

              </div><!-- /.box -->
            </div><!--/.col (right) -->
      
          </div><!-- /.row -->          

            <div class="row modal fade" id="myModal" align="center">
            <div class="col-md-8">
              <div class="box">
                <div class="box-header with-border">
                  <h3 class="box-title">Lista de Productos</h3>
                </div><!-- /.box-header -->
                <div class="box-header">
                  <h3 class="box-title"><font color="red" style="font-weight:bolder;">Producto por agotarse</font></h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>Codigo de barras</th>
                        <th>Descripcion</th>
                        <th>Precio</th>
                        <th>Existencia</th>
                        <th>Stock Minimo</th>
            <th>Cantidad</th>
                      </tr>
                    </thead>
                    <tbody>
<?php 
$listado=  mysql_query("select id_producto,codigo_barras,descripcion,cantidad_existencia,precio_compra,precio_venta,stock_minimo,caducidad,dias_caducar from cproductos order by descripcion");
                   while($reg=  mysql_fetch_array($listado))
                   {
            $id_producto=mb_convert_encoding($reg['id_producto'], "UTF-8");
            $codigo_barras=mb_convert_encoding($reg['codigo_barras'], "UTF-8");
          $cantidad_existencia=mb_convert_encoding($reg['cantidad_existencia'], "UTF-8");
          $stock_minimo=mb_convert_encoding($reg['stock_minimo'], "UTF-8"); 
          $descripcion=mb_convert_encoding($reg['descripcion'], "UTF-8");
                    $precio_compra=mb_convert_encoding($reg['precio_compra'], "UTF-8");
                    $precio_venta=mb_convert_encoding($reg['precio_venta'], "UTF-8");
                    $cantidad_existencia=mb_convert_encoding($reg['cantidad_existencia'], "UTF-8");                
                    $stock_minimo=mb_convert_encoding($reg['stock_minimo'], "UTF-8");
          if($cantidad_existencia<$stock_minimo)
            {
          ?>
                      <tr>
                        <td><font color="red" style="font-weight:bolder;"><?php echo $codigo_barras; ?></font></td>
                        <td><font color="red" style="font-weight:bolder;"><?php echo $descripcion; ?></font></td>
                        <td><font color="red" style="font-weight:bolder;"><?php echo $precio_venta; ?></font></td>
                        <td><font color="red" style="font-weight:bolder;"><?php echo $cantidad_existencia; ?></font></td>
                        <td><font color="red" style="font-weight:bolder;"><?php echo $stock_minimo; ?></font></td>
            <td><font color="red" style="font-weight:bolder;">Producto agotado</font></td>
                      </tr>
          <?php
            }
          else
            {
          ?>
                      <tr>
                        <td><?php echo $codigo_barras; ?></td>
                        <td><?php echo $descripcion; ?></td>
                        <td><?php echo $precio_venta; ?></td>
                        <td><?php echo $cantidad_existencia; ?></td>
                        <td><?php echo $stock_minimo; ?></td>
            <td><input type="text" id="txtcantidad" name="txtcantidad" value="1" onKeyPress="javascript:guardar_producto_venta_buscado(event,this.value,<?php echo $id_producto; ?>);"></td>
                      </tr>
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
                        <th>Precio</th>
                        <th>Existencia</th>
                        <th>Stock Minimo</th>
            <th>Cantidad</th>
                      </tr>
                    </tfoot>
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
      <footer class="main-footer">
        <div class="pull-right hidden-xs">
          <b>Version</b> 2.3.0
        </div>
        <strong>Copyright &copy; 2014-2015 <a href="http://almsaeedstudio.com">Almsaeed Studio</a>.</strong> All rights reserved.
      </footer>

      <!-- Control Sidebar -->
      <aside class="control-sidebar control-sidebar-dark">
        <!-- Create the tabs -->
        <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
          <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
          <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
        </ul>
        <!-- Tab panes -->
        <div class="tab-content">
          <!-- Home tab content -->
          <div class="tab-pane" id="control-sidebar-home-tab">
            <h3 class="control-sidebar-heading">Recent Activity</h3>
            <ul class="control-sidebar-menu">
              <li>
                <a href="javascript::;">
                  <i class="menu-icon fa fa-birthday-cake bg-red"></i>
                  <div class="menu-info">
                    <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>
                    <p>Will be 23 on April 24th</p>
                  </div>
                </a>
              </li>
              <li>
                <a href="javascript::;">
                  <i class="menu-icon fa fa-user bg-yellow"></i>
                  <div class="menu-info">
                    <h4 class="control-sidebar-subheading">Frodo Updated His Profile</h4>
                    <p>New phone +1(800)555-1234</p>
                  </div>
                </a>
              </li>
              <li>
                <a href="javascript::;">
                  <i class="menu-icon fa fa-envelope-o bg-light-blue"></i>
                  <div class="menu-info">
                    <h4 class="control-sidebar-subheading">Nora Joined Mailing List</h4>
                    <p>nora@example.com</p>
                  </div>
                </a>
              </li>
              <li>
                <a href="javascript::;">
                  <i class="menu-icon fa fa-file-code-o bg-green"></i>
                  <div class="menu-info">
                    <h4 class="control-sidebar-subheading">Cron Job 254 Executed</h4>
                    <p>Execution time 5 seconds</p>
                  </div>
                </a>
              </li>
            </ul><!-- /.control-sidebar-menu -->

            <h3 class="control-sidebar-heading">Tasks Progress</h3>
            <ul class="control-sidebar-menu">
              <li>
                <a href="javascript::;">
                  <h4 class="control-sidebar-subheading">
                    Custom Template Design
                    <span class="label label-danger pull-right">70%</span>
                  </h4>
                  <div class="progress progress-xxs">
                    <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
                  </div>
                </a>
              </li>
              <li>
                <a href="javascript::;">
                  <h4 class="control-sidebar-subheading">
                    Update Resume
                    <span class="label label-success pull-right">95%</span>
                  </h4>
                  <div class="progress progress-xxs">
                    <div class="progress-bar progress-bar-success" style="width: 95%"></div>
                  </div>
                </a>
              </li>
              <li>
                <a href="javascript::;">
                  <h4 class="control-sidebar-subheading">
                    Laravel Integration
                    <span class="label label-warning pull-right">50%</span>
                  </h4>
                  <div class="progress progress-xxs">
                    <div class="progress-bar progress-bar-warning" style="width: 50%"></div>
                  </div>
                </a>
              </li>
              <li>
                <a href="javascript::;">
                  <h4 class="control-sidebar-subheading">
                    Back End Framework
                    <span class="label label-primary pull-right">68%</span>
                  </h4>
                  <div class="progress progress-xxs">
                    <div class="progress-bar progress-bar-primary" style="width: 68%"></div>
                  </div>
                </a>
              </li>
            </ul><!-- /.control-sidebar-menu -->

          </div><!-- /.tab-pane -->
          <!-- Stats tab content -->
          <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div><!-- /.tab-pane -->
          <!-- Settings tab content -->
          <div class="tab-pane" id="control-sidebar-settings-tab">
              <h3 class="control-sidebar-heading">General Settings</h3>
              <div class="form-group">
                <label class="control-sidebar-subheading">
                  Report panel usage
                  <input type="checkbox" class="pull-right" checked>
                </label>
                <p>
                  Some information about this general settings option
                </p>
              </div><!-- /.form-group -->

              <div class="form-group">
                <label class="control-sidebar-subheading">
                  Allow mail redirect
                  <input type="checkbox" class="pull-right" checked>
                </label>
                <p>
                  Other sets of options are available
                </p>
              </div><!-- /.form-group -->

              <div class="form-group">
                <label class="control-sidebar-subheading">
                  Expose author name in posts
                  <input type="checkbox" class="pull-right" checked>
                </label>
                <p>
                  Allow the user to show his name in blog posts
                </p>
              </div><!-- /.form-group -->

              <h3 class="control-sidebar-heading">Chat Settings</h3>

              <div class="form-group">
                <label class="control-sidebar-subheading">
                  Show me as online
                  <input type="checkbox" class="pull-right" checked>
                </label>
              </div><!-- /.form-group -->

              <div class="form-group">
                <label class="control-sidebar-subheading">
                  Turn off notifications
                  <input type="checkbox" class="pull-right">
                </label>
              </div><!-- /.form-group -->

              <div class="form-group">
                <label class="control-sidebar-subheading">
                  Delete chat history
                  <a href="javascript::;" class="text-red pull-right"><i class="fa fa-trash-o"></i></a>
                </label>
              </div><!-- /.form-group -->
          </div><!-- /.tab-pane -->
        </div>
      </aside><!-- /.control-sidebar -->
      <!-- Add the sidebar's background. This div must be placed
           immediately after the control sidebar -->
      <div class="control-sidebar-bg"></div>
    </div><!-- ./wrapper -->

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
    <!-- page script -->
    <script>

function disableFunctionKeys(e) {
    var functionKeys = new Array(112, 113, 114, 115, 116, 117, 118, 119, 120, 121, 123);
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

    $(document).ready(function(){
    $("#txtcodigobp").focus();
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

function tecla(e)
{
    var evt = e ? e : event;
    var key = window.Event ? evt.which : evt.keyCode;
    //alert (key);
    if(key==118) //F7 CANTIDAD
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
    else if(key==123) // F12 RETIRAR
    {
      mostrarmodal_retirar();
    }
    else if(key==114) // F3 PRECIO
    {
      mostrarmodal_precio();
    }
    else if(key==119) // F8 DESCUENTO
    {
      mostrarmodal_descuento();
    }
}
    </script>


</form>	
  </body>
</html>
