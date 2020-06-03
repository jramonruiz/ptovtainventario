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

$queryp = "select nombre_empresa,nombre_comercial from cproveedores where id_proveedor=$idproveedor";
$resultc = mysql_query($queryp) or die("SQL Error 1: " . mysql_error());
// get data and store in a json array
while ($rowc = mysql_fetch_array($resultc)) 
{
$nombre_empresa=utf8_encode($rowc[0]);
$nombre_comercial=utf8_encode($rowc[1]);
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
	
	<script language="javascript" src="../js/login.js" type="text/javascript"> </script>		

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="hold-transition skin-yellow-light sidebar-mini">
<form id="frm_nueva_cuenta_bancaria_proveedor" name="frm_nueva_cuenta_bancaria_proveedor" action="" method="post"> 
  <input id="sel" type="hidden" value="-1">
  <input id="oper" name="oper" type="hidden" value=""> 
  <input type="hidden" id="txtnum_pag" name="txtnum_pag" value="" /> 
  <input type="hidden" id="txtidproveedor" name="txtidproveedor" value="<?php echo $idproveedor; ?>" /> 
  <input type="hidden" id="txtidcuenta_bancaria_modificarp" name="txtidcuenta_bancaria_modificarp" value="" /> 
  <input id="txtfilepageserver" type="hidden" value=""/>     
    <div class="wrapper">

      <header class="main-header">
		<?php require_once("header_catalogos.php");?>
	 </header>

      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
			<?php require_once("menu_opciones_catalogos.php");?>
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Nueva Cuenta Bancaria Proveedor de: <?php echo $nombre_empresa." o ".$nombre_comercial; ?></h1>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <!-- left column -->
            <div class="col-md-12">
              <!-- general form elements -->
              <div class="box box-primary">
                <!-- form start -->
                <form role="form">
                  <div class="box-body">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Numero de cuenta</label>
                        <input id="txtnumero_cuentabp" name="txtnumero_cuentabp" class="form-control input-lg" type="text" placeholder="escriba el numero de la cuenta bancaria">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Banco</label>
                        <input id="txtbancop" name="txtbancop" class="form-control input-lg" type="text" placeholder="escriba el nomre del banco: BANCOMER, BANAMEX, HSBC">
                    </div>

                    <div class="form-group">
                      <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>Numero de Cuenta</th>
                        <th>Banco</th>
                        <th>Modificar</th>
                      </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $listado=  mysql_query("select id_cuenta_bancariap,numero_cuenta,banco from tcuenta_bancariap where id_proveedor=$idproveedor");
                                           while($reg=  mysql_fetch_array($listado))
                                           {
                                                       $id_cuenta_bancariap=mb_convert_encoding($reg['id_cuenta_bancariap'], "UTF-8");
                                                       $numero_cuenta=utf8_encode($reg['numero_cuenta']);
                                                       $banco=utf8_encode($reg['banco']);
                        ?>        
                                              <tr>
                                                <td><?php echo $numero_cuenta; ?></td>
                                                <td><?php echo $banco; ?></td>
                                    <td><button type="button" class="btn btn-warning btn-fa-pencil-square-o" onClick="javascript:modificar_cuenta_bancaria_proveedor(<?php echo $id_cuenta_bancariap; ?>);"><i class="fa fa-pencil-square-o"></i></button></td>
                                              </tr>
                        <?php
                                }
                        ?>            
                    </tbody>
                    </table>
                    </div>

                  </div><!-- /.box-body -->

                  <div class="box-footer">
					           <button type="button" class="btn btn-primary" onClick="javascript:alta_cuenta_bancaria_proveedor();">Guardar</button>
                  </div>
                </form>
              </div><!-- /.box -->

            </div><!--/.col (left) -->
          </div>   <!-- /.row -->
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
    <!-- FastClick -->
    <script src="../plugins/fastclick/fastclick.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../dist/js/app.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="../dist/js/demo.js"></script>
</form>	
  </body>
</html>