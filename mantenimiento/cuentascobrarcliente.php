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

$idcliente=$_GET["id_cliente"];



if($idcliente>0)
{
$query = "select * from cclientes where id_cliente=$idcliente";
$result = mysql_query($query) or die("SQL Error 1: " . mysql_error());
// get data and store in a json array
while ($row = mysql_fetch_array($result)) 
{
//id_proveedor,nombre_contacto,nombre_empresa,telefono1_contacto,correo_contacto,rfc_empresa,fecha_captura,nombre_comercial,calle,colonia,codigo_postal,pais,estado,municipio,telefono2_contacto,telefono3_contacto,fax_contacto,pagina_web,observaciones
$nombre_cliente=utf8_encode($row[1]);
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
<form id="frm_lista_cuentasporcobrar_cliente" name="frm_lista_cuentasporcobrar_cliente" action="" method="post"> 
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
            Lista de Cuentas por cobrar del cliente: <?php echo $nombre_cliente; ?>
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
                        <th>TICKET</th>
                        <th>Total a pagar</th>
                        <th>Total de abonos</th>
                        <th>Faltante por pagar</th>
                        <th>Estatus de la cuenta</th>
                        <th>Numero de Abonos</th>
                        <th>Proximo Pago</th>
                        <th>Dias faltantes</th>
                        <th>Abonar</th>
                      </tr>
                    </thead>
                    <tbody>
<?php 
$listado=  mysql_query("select id_venta,fecha_venta,total_pagar,folio_venta,id_cliente,pagado_totalmente from tventas where id_tipo_pago=4 and nombre_cliente='$nombre_cliente'");
                   while($reg=  mysql_fetch_array($listado))
                   {
                               $id_venta=utf8_encode($reg['id_venta']);
                               $fecha_venta=utf8_encode($reg['fecha_venta']);
                               $total_pagar=utf8_encode($reg['total_pagar']);
                               $folio_venta=utf8_encode($reg['folio_venta']);
                               $id_cliente=utf8_encode($reg['id_cliente']);
                               $pagado_totalmente=utf8_encode($reg['pagado_totalmente']);
                               
                                if($pagado_totalmente==0)
                                  {
                                    $epagada="<span style='color:red;'>PENDIENTE A PAGAR";
                                  }
                                else
                                  {
                                    $epagada="<span style='color:green;'>PAGADA - CERRADA";
                                  }  

                            $rsta = mysql_query("select count(id_abono_ccobrar) as numero_abonos from tabonos_ccobrar where id_venta=$id_venta");
                            if ($rowta = mysql_fetch_row($rsta)) {
                            $numero_abonos = trim($rowta[0]);
                            }

                            $rssumabon = mysql_query("select SUM(importe) as importetotabon from tabonos_ccobrar where id_venta=$id_venta");
                            if ($rowsumabon = mysql_fetch_row($rssumabon)) {
                            $importetotabon = trim($rowsumabon[0]);
                            }

                            $rsproxpag = mysql_query("select proximo_pago from tabonos_ccobrar where id_venta=$id_venta");
                            if ($rowproxpag = mysql_fetch_row($rsproxpag)) {
                            $proximo_pago = trim($rowproxpag[0]);
                            }

                            $fecha_hoy=date("Y-m-d");
                            $segundos  = strtotime($proximo_pago)-strtotime($fecha_hoy);
                            $dias      = intval($segundos/86400);
                            $segundos -= $dias*86400;
                            $horas     = intval($segundos/3600);
                            $segundos -= $horas*3600;
                            $minutos   = intval($segundos/60);
                            $segundos -= $minutos*60;
                            $dias_vencimiento =$dias;

                            $faltante_pagar=$total_pagar-$importetotabon;
?>				
                      <tr>
                        <td><?php echo $id_venta; ?></td>
                        <td><?php echo $total_pagar; ?></td>
                        <td><?php echo $importetotabon; ?></td>
                        <td><?php echo $faltante_pagar; ?></td>
                        <td><?php echo $epagada; ?></td>
                        <td><?php echo $numero_abonos; ?></td>
                        <td><?php echo $proximo_pago; ?></td>
                        <td><?php echo $dias_vencimiento; ?></td>
                        <td><button type="button" class="btn btn-warning btn-fa-pencil-square-o" onClick="javascript:nuevo_abono_cobrar(<?php echo $id_venta.','.$idcliente; ?>);"><i class="fa fa-pencil-square-o"></i></button></td>
                      </tr>
<?php
				}
?>					  
                    </tbody>
                    <tfoot>
                      <tr>
                        <th>Ticket</th>
                        <th>Total a pagar</th>
                        <th>Total de abonos</th>
                        <th>Faltante por pagar</th>
                        <th>Estatus de la cuenta</th>
                        <th>Numero de Abonos</th>
                        <th>Proximo Pago</th>
                        <th>Dias faltantes</th>
                        <th>Abonar</th>
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
