<?php
error_reporting(0);
$tipusr="";
$paginterior=0;
include("php/autentificacion.server.php");
session_name("lgsapplipweb");
session_start();
session_set_cookie_params(0, "/", $HTTP_SERVER_VARS["HTTP_HOST"], 0);

$id_usuario=$_SESSION["iduser"];
$id_sucursal=$_SESSION["sucursal"];
$id_tipo_usuario=$_SESSION["tipo_usuario"];

include("php/conexion.php");
$connect = mysql_connect($hostname, $username, $password)
or die('Could not connect: ' . mysql_error());
//Select The database
$con = mysql_select_db($database, $connect);

// COMPROBAR SI YA ACTUALIZO EL MONTO INICIAL DE LA CAJA
$hoy=date("Y-m-d");

$querycaja = "select cu.id_usuario,cc.id_caja,cc.descripcion_caja,cc.efectivo_caja,cc.fecha_actualizacion from cusuarios cu inner join ccajas cc on cu.id_caja=cc.id_caja where cu.id_usuario=$id_usuario";
$resultcaja = mysql_query($querycaja) or die("SQL Error 1: " . mysql_error());
// get data and store in a json array
while ($rowcaja = mysql_fetch_array($resultcaja)) 
{
$id_usuario=utf8_encode($rowcaja[0]);
$id_caja=utf8_encode($rowcaja[1]);
$descripcion_caja=utf8_encode($rowcaja[2]);
$efectivo_caja=utf8_encode($rowcaja[3]);
$fecha_actualizacion=utf8_encode($rowcaja[4]);
}

$rsfolioini = mysql_query("SELECT numero_folio_iniciar FROM ccajas where id_caja=1");
if ($rowfolioini = mysql_fetch_row($rsfolioini)) {
$numero_folio_iniciar = trim($rowfolioini[0]);
}

unlink('error_log');
unlink('ventas/error_log');
unlink('seguridad/error_log');
unlink('reportes/error_log');
unlink('mantenimiento/error_log');
unlink('catalogos/error_log');
unlink('php/error_log');
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Sistema Punto de Venta e Inventario</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="plugins/iCheck/flat/blue.css">
    <!-- Morris chart -->
    <link rel="stylesheet" href="plugins/morris/morris.css">
    <!-- jvectormap -->
    <link rel="stylesheet" href="plugins/jvectormap/jquery-jvectormap-1.2.2.css">
    <!-- Date Picker -->
    <link rel="stylesheet" href="plugins/datepicker/datepicker3.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker-bs3.css">
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
	

	<script language="javascript" src="js/operaciones.js" type="text/javascript"> </script>	
  <script language="javascript" src="js/reportes.js" type="text/javascript"> </script> 

	<script language="javascript" src="js/login.js" type="text/javascript"> </script>
		

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="hold-transition skin-yellow-light sidebar-mini">
    <form id="frm_principal" name="frm_principal" action="" method="post"> 
    <div class="wrapper">

      <header class="main-header">
		<?php require_once("header.php");?>
      </header>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
			<?php require_once("menu_opciones.php");?>
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
           Menu Principal
          </h1>
        </section>

        <!-- Main content -->
        <section class="content">          
          <div class="row">
            <!-- right column -->
            <div class="col-md-12">
              <!-- general form elements disabled -->
              <div class="box box-warning">
                <div class="box-header with-border">
                  <h3 class="box-title">Avisos: Inventario</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <!-- text input -->
                    <div class="form-group">
					
<?php 
$art_faltante=0;
$listado=  mysql_query("select id_producto,descripcion,cantidad_existencia,precio_compra,precio_venta,stock_minimo,caducidad,dias_caducar from cproductos order by descripcion");
                   while($reg=  mysql_fetch_array($listado))
                   {
   					$id_producto=mb_convert_encoding($reg['id_producto'], "UTF-8");
					$cantidad_existencia=mb_convert_encoding($reg['cantidad_existencia'], "UTF-8");
					$stock_minimo=mb_convert_encoding($reg['stock_minimo'], "UTF-8");	
					$descripcion=mb_convert_encoding($reg['descripcion'], "UTF-8");
                    $precio_compra=mb_convert_encoding($reg['precio_compra'], "UTF-8");
                    $precio_venta=mb_convert_encoding($reg['precio_venta'], "UTF-8");
                    $cantidad_existencia=mb_convert_encoding($reg['cantidad_existencia'], "UTF-8");							   
                    $stock_minimo=mb_convert_encoding($reg['stock_minimo'], "UTF-8");
					if($cantidad_existencia<$stock_minimo)
						{
							$art_faltante=$art_faltante+1;
						}
				  }
?>					
							<div class="col-lg-3 col-xs-6">
							  <!-- small box -->
							  <div class="small-box bg-aqua">
								<div class="inner">
								  <h3><?php echo $art_faltante; ?></h3>
								  <p>Productos Faltantes</p>
								</div>
								<div class="icon">
								  <i class="ion ion-bag"></i>
								</div>
								<a class="small-box-footer" onClick="javascript:reporte_productos_faltantes(<?php echo $id_sucursal.','.$id_usuario; ?>);" style="cursor:pointer;">Ver Reporte<i class="fa fa-arrow-circle-right"></i></a>
							  </div>
							</div><!-- ./col -->
							
							<?php
$rs = mysql_query("SELECT MAX(id_inventario_fisico) AS id FROM tinventario_fisico");
if ($row = mysql_fetch_row($rs)) {
$idif = trim($row[0]);
}

$rsif = mysql_query("SELECT fecha_inventario FROM tinventario_fisico where id_inventario_fisico=$idif");
if ($rowif = mysql_fetch_row($rsif)) {
$fecha_inventario = trim($rowif[0]);
}

							?>
							
							<div class="col-lg-3 col-xs-6">
							  <!-- small box -->
							  <div class="small-box bg-green">
								<div class="inner">
								  <h3><?php echo $fecha_inventario; ?></h3>
								  <p>Inventario mas reciente</p>
								</div>
								<div class="icon">
								  <i class="ion ion-bag"></i>
								</div>
								<a class="small-box-footer" onClick="javascript:imprimir_inventario_fisico(<?php echo $idif.','.$id_sucursal.','.$id_usuario; ?>);" style="cursor:pointer;">Ver Reporte<i class="fa fa-arrow-circle-right"></i></a>
							  </div>
							</div><!-- ./col -->


							
<?php
$rspf = mysql_query("select count(id_producto) from cproductos where cantidad_contada<>0");
if ($rowpf = mysql_fetch_row($rspf)) {
$inventario_pendiente = trim($rowpf[0]);
}

?>							

							<?php
								if($inventario_pendiente>0)
								{
							?>
							<div class="col-lg-3 col-xs-6">
							  <!-- small box -->
							  <div class="small-box bg-yellow">
								<div class="inner">
								  <h3>1</h3>
								  <p>Inventario pendiente sin concluir</p>
								</div>
								<div class="icon">
								  <i class="ion ion-bag"></i>
								</div>
								<a class="small-box-footer" href="mantenimiento/actualizar_inventario.php" style="cursor:pointer;">Ir a inventario<i class="fa fa-arrow-circle-right"></i></a>
							  </div>
							</div><!-- ./col -->
							
							<?php
								}
							?>
							
                    </div>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!--/.col (right) -->
          </div><!-- /.row -->

        <?php
        if($id_tipo_usuario==1)
        {
        ?>
         <div class="row">
            <!-- left column -->
            <div class="col-md-12">
              <!-- general form elements -->
              <div class="box box-primary">
              <div class="box-header with-border">
                  <h3 class="box-title">Inicio de folio</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <!--form role="form"-->
                  <div class="box-body">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Numero de folio a iniciar</label>
                        <input id="txtnumero_folioiniciar" name="txtnumero_folioiniciar" class="form-control input-lg" type="number" value="<?php echo $numero_folio_iniciar; ?>"> <button type="button" class="btn btn-primary" onClick="javascript:guardar_numero_folio_iniciar();">Guardar</button> 
                    </div>
                  </div><!-- /.box-body -->
          <!--/form-->  


              </div><!-- /.box -->
            </div><!--/.col (left) -->
          </div>   <!-- /.row -->
          <?php
            }
          ?>
		  
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
      <footer class="main-footer">
        <div class="pull-right hidden-xs">
          <b>Version</b> 2.3.0
        </div>
      </footer>

      <!-- Add the sidebar's background. This div must be placed
           immediately after the control sidebar -->
      <div class="control-sidebar-bg"></div>
    </div><!-- ./wrapper -->

    <!-- jQuery 2.1.4 -->
    <script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
      $.widget.bridge('uibutton', $.ui.button);
    </script>
    <!-- Bootstrap 3.3.5 -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <!-- Morris.js charts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="plugins/morris/morris.min.js"></script>
    <!-- Sparkline -->
    <script src="plugins/sparkline/jquery.sparkline.min.js"></script>
    <!-- jvectormap -->
    <script src="plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
    <script src="plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
    <!-- jQuery Knob Chart -->
    <script src="plugins/knob/jquery.knob.js"></script>
    <!-- daterangepicker -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>
    <script src="plugins/daterangepicker/daterangepicker.js"></script>
    <!-- datepicker -->
    <script src="plugins/datepicker/bootstrap-datepicker.js"></script>
    <!-- Bootstrap WYSIHTML5 -->
    <script src="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
    <!-- Slimscroll -->
    <script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <!-- FastClick -->
    <script src="plugins/fastclick/fastclick.min.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/app.min.js"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="dist/js/pages/dashboard.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="dist/js/demo.js"></script>
    </form> 
  </body>
</html>
