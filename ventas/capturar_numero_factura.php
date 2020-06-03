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

$id_venta=$_GET["id_venta"];

include("../php/conexion.php");
$connect = mysql_connect($hostname, $username, $password)
or die('Could not connect: ' . mysql_error());
//Select The database
$con = mysql_select_db($database, $connect);

//// OBTENCION DEL NOMBRE DEL CLIENTE Y DEL DESCUENTO

$rscd = mysql_query("SELECT id_venta,folio_venta,nombre_cliente,porcentaje_descuento,tipo_operacion,total_pagar,numero_factura,fecha_factura FROM tventas where id_venta=$id_venta");
if ($rowcd = mysql_fetch_row($rscd)) {
  $id_venta_bus=utf8_encode($rowcd[0]);
  $folio_venta_bus=utf8_encode($rowcd[1]);
  $nombre_cliente=utf8_encode($rowcd[2]);
  $porcentaje_descuento=utf8_encode($rowcd[3]);
  $id_tipo_movimiento=utf8_encode($rowcd[4]);
  $total_pagar=utf8_encode($rowcd[5]);
  $numero_factura=utf8_encode($rowcd[6]);
  $fecha_factura=utf8_encode($rowcd[7]);
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
    <!-- Theme style -->
    <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
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
  
<script src="../js/jquery-1.9.1.js" type="text/javascript"></script>
<script src="../js/jquery-ui-1.10.3.custom.js" type="text/javascript"></script> 
  
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="hold-transition skin-yellow-light sidebar-mini">
<form id="frmcapturar_numero_factura" name="frmcapturar_numero_factura" action="" method="post"> 
  <input id="sel" type="hidden" value="-1">
  <input id="oper" name="oper" type="hidden" value=""> 
  <input type="hidden" id="txtnum_pag" name="txtnum_pag" value="" /> 
  <input id="txtfilepageserver" type="hidden" value=""/>   
<input type="hidden" id="txtid_producto_buscar" name="txtid_producto_buscar" value="" /> 
<input type="hidden" id="txtcantidad_existencia_producto_buscar" name="txtcantidad_existencia_producto_buscar" value="" />
<input type="hidden" id="cambio_venta" name="cambio_venta" value="" />
  <input type="hidden" id="txtid_producto" name="txtid_producto" value="" /> 
  <input type="hidden" id="txtcantidad_producto" name="txtcantidad_producto" value="" />
  <input type="hidden" id="txtid_venta" name="txtid_venta" value="<?php echo $id_venta; ?>" />     
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
            CAPTURAR NUMERO DE FACTURA &nbsp;<?php echo 'Id de la venta: '.$id_venta_bus.', Folio de la venta: '.$folio_venta_bus; ?>
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
                      <td colspan="3" align="left"><h4>Cliente: <?php echo $nombre_cliente; ?></h4>
                      <td colspan="3" align="left"><h4>Operacion: <?php echo $tipomovimiento; ?></h4></td>
                      <td colspan="3">                         
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
              <!-- Horizontal Form -->
              <div class="box box-info">
                <div class="box-header with-border">
                  <h3 class="box-title">Productos Vendidos</h3>
                </div><!-- /.box-header -->
<?php
$listado=  mysql_query("select tpv.id_producto_venta,tpv.id_venta,tpv.descripcion_producto,tpv.cantidad,tpv.precio_venta,tpv.subtotal,tpv.id_usuario,cp.stock_minimo,cp.cantidad_existencia,cp.codigo_barras,tpv.descuento,tpv.precio_neto from tproductos_venta tpv inner join cproductos cp on tpv.descripcion_producto=cp.descripcion where tpv.id_venta=$id_venta order by tpv.id_producto_venta");
?>				
                  <div class="table-responsive mailbox-messages">
                    <table class="table table-hover table-striped" id="listProd">
                      <tbody>
                        <tr>
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
                          <td class="mailbox-subject" id="list_descp"><b><?php echo $descripcion_producto; ?></b></td>
                          <td class="mailbox-subject" id="list_cant"><b><?php echo $cantidad; ?></b></td>
                          <td class="mailbox-subject" id="list_precio"><b><?php echo $precio_venta; ?></b></td>
                          <td class="mailbox-subject" id="list_desc"><b><?php echo $descuento; ?></b></td>
                          <td class="mailbox-subject" id="list_neto"><b><?php echo $precio_neto; ?></b></td>
                          <td class="mailbox-subject" id="list_subt"><b><?php echo $subtotal; ?></b></td>
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

          <div class="row">
            <!-- right column -->
            <div class="col-md-12">
              <!-- general form elements disabled -->
              <div class="box box-warning">
                <div class="box-header with-border">
                  <h3 class="box-title">Datos de la factura</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <!-- text input -->
                    <div class="form-group">
                      <label for="exampleInputEmail1">Numero de la factura</label>
                        <input id="txtnumero_factura" name="txtnumero_factura" class="form-control input-lg" type="text" placeholder="escriba el numero de la factura" value="<?php echo $numero_factura; ?>">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Fecha de la factura</label>
                      <input type="text" id="datepicker1" name="datepicker1" value="<?php echo $fecha_factura; ?>" />
                      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    </div>
                </div><!-- /.box-body -->
        <!-- /.box-header -->   
              </div><!-- /.box -->
            </div><!--/.col (right) -->
          </div><!-- /.row -->        

          <!--div class="box-header with-border" align="left">
        <button type="button" class="btn btn-primary" onClick="javascript:cancelar_venta_areaventa();">Cancelar Venta y Area de Venta</button>
        </div--><!-- /.box-header -->   

         <div class="box-header with-border" align="left">
        <button type="button" class="btn btn-primary" onClick="javascript:guardar_numero_factura();">GUARDAR NUMERO DE FACTURA</button>
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

/*f1  112 f2  113
f3  114 f4  115 f5  116
f6  117 f7  118 f8  119
f9  120 f10 121 f11 122*/


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
