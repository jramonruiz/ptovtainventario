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
<form id="frm_lista_productos" name="frm_lista_productos" action="" method="post"> 
  <input id="sel" type="hidden" value="-1">
  <input id="oper" name="oper" type="hidden" value=""> 
  <input type="hidden" id="txtnum_pag" name="txtnum_pag" value="" /> 
  <input id="txtfilepageserver" type="hidden" value=""/>    
  <input type="hidden" id="txtid_producto_inventario_eliminar" name="txtid_producto_inventario_eliminar" value="" /> 
    <div class="wrapper">

      <header class="main-header">
		<?php require_once("header_mantenimiento.php");?>
      </header>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
			<?php require_once("menu_opciones_mantenimiento.php");?>
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Lista de Productos&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="nuevo_producto.php"><i class="fa fa-th"></i><span>     Nuevo producto</span></a>
          </h1>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title"><font color="red" style="font-weight:bolder;">Producto por agotarse</font></h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>Descripcion</th>
                        <th>Precio de Venta</th>
                        <th>Existencia</th>
						<th>Modificar</th>
						<th>Observacion</th>
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
                    $descto_salon=mb_convert_encoding($reg['descto_salon'], "UTF-8");
                    $descto_mayorista=mb_convert_encoding($reg['descto_mayorista'], "UTF-8");
                    $observaciones=utf8_encode($reg['observaciones']);


					if($cantidad_existencia<$stock_minimo)
						{
					?>
                      <tr>
                        <td><font color="red" style="font-weight:bolder;"><?php echo $descripcion; ?></font></td>
                        <td><font color="red" style="font-weight:bolder;"><?php echo $precio_venta; ?></font></td>
                        <td><font color="red" style="font-weight:bolder;"><?php echo $cantidad_existencia; ?></font></td>
						<td><button type="button" class="btn btn-warning btn-fa-pencil-square-o" onClick="javascript:modificar_producto_inventaro(<?php echo $id_producto; ?>);"><i class="fa fa-pencil-square-o"></i></button></td>
           <td><font color="red" style="font-weight:bolder;"><?php echo $observaciones; ?></font></td>
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
						<td><button type="button" class="btn btn-warning btn-fa-pencil-square-o" onClick="javascript:modificar_producto_inventaro(<?php echo $id_producto; ?>);"><i class="fa fa-pencil-square-o"></i></button></td>
							<td><?php echo $observaciones; ?></td>													
						
<!--						<td><button type="button" class="btn btn-warning btn-fa-times"><i class="fa fa-times"></i></button></td>																		
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
                        <th>Modificar</th>
                        <th>Observacion</th>
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
