<?php
error_reporting(0);
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

$idproveedor=$_GET["idproveedor"];

if($idproveedor>0)
{
$query = "select * from cproveedores where id_proveedor=$idproveedor";
$result = mysql_query($query) or die("SQL Error 1: " . mysql_error());
// get data and store in a json array
while ($row = mysql_fetch_array($result)) 
{
//id_proveedor,nombre_contacto,nombre_empresa,telefono1_contacto,correo_contacto,rfc_empresa,fecha_captura,nombre_comercial,calle,colonia,codigo_postal,pais,estado,municipio,telefono2_contacto,telefono3_contacto,fax_contacto,pagina_web,observaciones
$id_proveedor=utf8_encode($row[0]);
$nombre_contacto=utf8_encode($row[1]);
$nombre_empresa=utf8_encode($row[2]);
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
	

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="hold-transition skin-yellow-light sidebar-mini">
<form id="frm_lista_cuentasporpargar_proveedor" name="frm_lista_cuentasporpargar_proveedor" action="" method="post"> 
  <input id="sel" type="hidden" value="-1">
  <input id="oper" name="oper" type="hidden" value=""> 
  <input type="hidden" id="txtnum_pag" name="txtnum_pag" value="" /> 
  <input id="txtfilepageserver" type="hidden" value=""/>     
  <input type="hidden" id="txtid_proveedor_eliminar" name="txtid_proveedor_eliminar" value="" />
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
            Lista de Cuentas por pagar del proveedor: <?php echo $nombre_empresa; ?>
          </h1>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>Cuenta por pagar</th>
                        <th>Total a pagar</th>
                        <th>Faltante por pagar</th>
                        <th>Fecha del proximo pago</th>
                        <th>Estatus de la cuenta</th>
                        <th>Numero de Abonos</th>
                        <th>Abonar</th>
                        <th>Modificar cuenta</th>
                      </tr>
                    </thead>
                    <tbody>
<?php 
$listado=  mysql_query("select id_cuenta_pagar,id_proveedor,documento,total_pagar,fecha_pago,faltante_pagar,pagada from tcuentas_pagar where id_proveedor=$id_proveedor");
                   while($reg=  mysql_fetch_array($listado))
                   {
                               $id_cuenta_pagar=utf8_encode($reg['id_cuenta_pagar']);
							                 $id_proveedor=utf8_encode($reg['id_proveedor']);
                               $documento=utf8_encode($reg['documento']);
                               $total_pagar=utf8_encode($reg['total_pagar']);
                               $fecha_pago=utf8_encode($reg['fecha_pago']);
                               $faltante_pagar=utf8_encode($reg['faltante_pagar']);
                               $pagada=utf8_encode($reg['pagada']);
                               
                                if($pagada==0)
                                  {
                                    $epagada="<span style='color:red;'>PENDIENTE A PAGAR";
                                  }
                                else
                                  {
                                    $epagada="<span style='color:green;'>PAGADA - CERRADA";
                                  }  

                            $rsta = mysql_query("select count(id_abono_cpagar) as numero_abonos from tabonos_cpagar where id_cuenta_pagar=$id_cuenta_pagar");
                            if ($rowta = mysql_fetch_row($rsta)) {
                            $numero_abonos = trim($rowta[0]);
                            }
?>				
                      <tr>
                        <td><?php echo $documento; ?></td>
                        <td><?php echo $total_pagar; ?></td>
                        <td><?php echo $faltante_pagar; ?></td>
                        <td><?php echo $fecha_pago; ?></td>
                        <td><?php echo $epagada; ?></td>
                        <td><?php echo $numero_abonos; ?></td>
                        <td><button type="button" class="btn btn-warning btn-fa-pencil-square-o" onClick="javascript:nuevo_abono(<?php echo $id_cuenta_pagar.",".$id_proveedor; ?>);"><i class="fa fa-pencil-square-o"></i></button></td>
                        <td>
                          <?php
                            if($numero_abonos>0)
                            {
                        ?>
                              &nbsp;&nbsp;&nbsp;
                        <?php
                            }
                          else
                            {
                        ?>
                          <button type="button" class="btn btn-warning btn-fa-pencil-square-o" onClick="javascript:modificar_cuenta_pagar(<?php echo $id_cuenta_pagar; ?>);"><i class="fa fa-pencil-square-o"></i></button></td>
                      <?php
                            }
                      ?>
                      </tr>
<?php
				}
?>					  
                    </tbody>
                    <tfoot>
                      <tr>
                        <th>Cuenta por pagar</th>
                        <th>Total a pagar</th>
                        <th>Faltante por pagar</th>
                        <th>Fecha del proximo pago</th>
                        <th>Estatus de la cuenta</th>
                        <th>Numero de Abonos</th>
                        <th>Abonar</th>
                        <th>Modificar cuenta</th>
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
