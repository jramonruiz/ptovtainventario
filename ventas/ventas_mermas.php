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

$hoy = date("Y-m-d");

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

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="hold-transition skin-yellow-light sidebar-mini">
<form id="frm_listado_ventas" name="frm_listado_ventas" action="" method="post"> 
  <input id="sel" type="hidden" value="-1">
  <input id="oper" name="oper" type="hidden" value=""> 
  <input type="hidden" id="txtnum_pag" name="txtnum_pag" value="" /> 
  <input id="txtfilepageserver" type="hidden" value=""/>   
  <input id="txtidventa" type="hidden" name="txtidventa" value=""/>  
  <input id="txtareaventa" type="hidden" name="txtareaventa" value="100"/>  
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
            Lista de ventas en merma&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          </h1>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title"><font color="blue" style="font-weight:bolder;">&nbsp;</font></h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>Folio venta</th>
                        <th>Fecha Venta</th>
                        <th>Cliente</th>
                        <th>Total de la venta</th>
                        <th>Tipo</th>
                        <th>Imprimir</th>
                        <th>Pasar a</th>
                        <th>Quitar de<br>Merma</th>
						            <th>Observacion</th>
                      </tr>
                    </thead>
                    <tbody>
<?php 

// TOTAL DE TICKETS
              $rstt = mysql_query("select count(id_venta) as total_tickets from tventas where tipo_operacion=1 and id_sucursal=$id_sucursal");
              if ($rowtt = mysql_fetch_row($rstt)) {
                $total_tickets= trim($rowtt[0]);
              }

              // TOTAL DE TICKETS EN MERMA
              $rsttm = mysql_query("select count(id_venta) as total_tickets_merma from tventas where tipo_operacion=1 and id_sucursal=$id_sucursal and merma=1");
              if ($rowttm = mysql_fetch_row($rsttm)) {
                $total_tickets_merma= trim($rowttm[0]);
              }

              // TOTAL DE AJUSTES DE SALIDA
              $rsttas = mysql_query("select count(id_venta) as total_ajustes_salida from tventas where tipo_operacion=2 and id_sucursal=$id_sucursal");
              if ($rowttas = mysql_fetch_row($rsttas)) {
                $total_ajustes_salida= trim($rowttas[0]);
              }

              $folioticketscomienzo=$total_tickets-$total_tickets_merma;


$listado=  mysql_query("select tv.id_venta,tv.folio_venta,tv.fecha_venta,tv.total_venta,tv.nombre_cliente,tv.total_pagar,tv.devolucion,tv.tipo_operacion,tv.venta_cancelada,tv.merma from tventas tv inner join cusuarios cu on tv.id_usuario=cu.id_usuario where cu.id_sucursal=$id_sucursal and tv.tipo_operacion>0 and tv.merma=1 order by tv.id_venta DESC");
                   while($reg=  mysql_fetch_array($listado))
                   {
   					$id_venta=utf8_encode($reg['id_venta']);
					$folio_venta=utf8_encode($reg['folio_venta']);
					$fecha_venta=utf8_encode($reg['fecha_venta']);	
                    $nombre_cliente=utf8_encode($reg['nombre_cliente']);
                    $total_venta=utf8_encode($reg['total_venta']);
					$total_pagar=utf8_encode($reg['total_pagar']);
					$devolucion=utf8_encode($reg['devolucion']);
          $tipo_operacion=utf8_encode($reg['tipo_operacion']);
          $venta_cancelada=utf8_encode($reg['venta_cancelada']);
          $merma=utf8_encode($reg['merma']);

          $fecha_completa=explode("-", $fecha_venta);

          if($venta_cancelada==1)
            {
              $cadcancelada="CANCELADA";
            }
          else
          {
            $cadcancelada="";
          }

          if($merma==1)
            {
              $cadmerma="EN MERMA";
            }
          else
          {
            $cadmerma="";
          }

          if($tipo_operacion==1)
          {
            $ctipo_operacion="TICKET";
            $prefijocomp="T";
            //$indicetickets=$folioticketscomienzo;
          }
          else
          {
            $ctipo_operacion="AJUSTE DE SALIDA";
            $prefijocomp="AS";
            //$indiceajustesalida=$total_ajustes_salida;
          }

?>
                      <tr>
                        <?php
                          if($tipo_operacion==1)
                          {
                        ?>
                          <td><?php echo $prefijocomp.$folioticketscomienzo; ?></td>
                        <?php
                          $folioid_venta=$prefijocomp.$folioticketscomienzo;
                          //$folioid_ventax=$folioid_venta;
                          $folioticketscomienzo=$folioticketscomienzo-1;
                          }
                        else
                          {
                        ?>
                          <td><?php echo $prefijocomp.$total_ajustes_salida; ?></td>
                        <?php
                          $folioid_venta=$prefijocomp.$total_ajustes_salida;
                          //$folioid_ventax=$folioid_venta;
                          $total_ajustes_salida=$total_ajustes_salida-1;
                          }
                        ?>
                        <td><?php echo $fecha_completa[2].'-'.$fecha_completa[1].'-'.$fecha_completa[0]; ?></td>
                        <td><?php echo $nombre_cliente; ?></td>
                        <td><?php echo $total_pagar; ?></td>
                        <td><?php echo $ctipo_operacion; ?></td>
						            <td><button type="button" class="btn btn-warning btn-fa-print" onClick="javascript:imprimir_vent_listado_merma(<?php echo $id_venta.','."'$folioid_venta'" ?>);"><i class="fa fa-print"></i></button></td>
                        <td>
                          <?php
                                if($venta_cancelada==0)
                                {
                            ?>
                              <button type="button" class="btn btn-warning btn-fa-print" onClick="javascript:pasar_venta_a(<?php echo $id_venta; ?>);"><i class="fa fa-print"></i></button>
                          <?php
                                }
                              else
                              {
                          ?>
                              &nbsp;
                          <?php
                              }
                          ?>
                        </td>
                         <td>
                          <?php
                                if($venta_cancelada==0)
                                {
                            ?>
                              <button type="button" class="btn btn-warning btn-fa-print" onClick="javascript:quitar_merma(<?php echo $id_venta; ?>);"><i class="fa fa-print"></i></button>
                          <?php
                                }
                              else
                              {
                          ?>
                              &nbsp;
                          <?php
                              }
                          ?>
                        </td>                        
						            <td><?php echo $cadcancelada.'<br>'.$cadmerma; ?></td>																		
<!--						<td><button type="button" class="btn btn-warning btn-fa-clone" onClick="javascript:generar_xml();"><i class="fa fa-clone"></i></button></td>																		
-->                      </tr>
<?php
				}
?>					  
                    </tbody>
                    <tfoot>
                      <tr>
                        <th>Folio venta</th>
                        <th>Fecha Venta</th>
                        <th>Cliente</th>
                        <th>Total de la venta</th>
                        <th>Tipo</th>
                        <th>Imprimir</th>
                        <th>Pasar a</th>
                        <th>Quitar de<br>Merma</th>
						<th>Observacion</th>
                      </tr>
                    </tfoot>
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->

          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-body">
                  <?php
                        $monto_acumulado_merma=0.00;

                          $rsmam = mysql_query("select SUM(total_pagar) as monto_acumulado_merma from tventas where venta_cancelada=0 and tipo_operacion=1 and merma=1");
                              if ($rowmam = mysql_fetch_row($rsmam)) 
                                {
                                  $monto_acumulado_merma = trim($rowmam[0]);
                                }

                          $rssvm = mysql_query("select COUNT(id_venta) as total_ventas_mermas from tventas where venta_cancelada=0 and tipo_operacion=1 and merma=1");
                              if ($rowsvm = mysql_fetch_row($rssvm)) 
                                {
                                  $total_ventas_mermas = trim($rowsvm[0]);
                                }
                  ?>

                  <a href="ventas_mermas.php"><h1>(<?php echo $total_ventas_mermas; ?>)Merma Ventas acumulado: $ <?php echo $monto_acumulado_merma; ?></h1></a>  
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
            <form method="post">
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
            </form>
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
</form>	
  </body>
</html>
