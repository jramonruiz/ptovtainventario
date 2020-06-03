<?php
error_reporting(0);
include("php/autentificacion.server.php");
session_name("lgsapplipweb");
session_start();
session_set_cookie_params(0, "/", $HTTP_SERVER_VARS["HTTP_HOST"], 0);

$id_usuario=$_SESSION["iduser"];
$id_sucursal=$_SESSION["sucursal"];

$barcode=$_GET["barcode"];

include("php/conexion.php");
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
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="plugins/datatables/dataTables.bootstrap.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
  
<script type="text/javascript" src="js/operaciones.js"></script>

<script type="text/javascript" src="js/reportes.js"></script>

<script type="text/javascript" src="js/login.js"></script>


    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="hold-transition skin-yellow-light sidebar-mini">
<form id="frmgenerador_codigo_barras" name="frmgenerador_codigo_barras" action="" method="post"> 
  <input id="sel" type="hidden" value="-1">
  <input id="oper" name="oper" type="hidden" value=""> 
  <input type="hidden" id="txtnum_pag" name="txtnum_pag" value="" /> 
  <input id="txtfilepageserver" type="hidden" value=""/>     
  <input type="hidden" id="txtid_usuario_buscar" name="txtid_usuario_buscar" value="" />
    <div class="wrapper">

      <header class="main-header">
    <?php require_once("seguridad/header_seguridad.php");?>
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
            Generar Codigo de Barras
          </h1>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-body">
                  <form>
                    <div class="form-group">
                      <label class="form-control-label" for="backup_file">Ingrese un codigo de barras </label>
                        <div class="col-10">
                          <input type="text" name="barcode" id="codigo" class="form-control" value="123456789" />
                        </div>
                    </div>
                    <div class="form-group">
                      <label class="form-control-label" for="backup_file">Producto a buscar</label>
                        <div class="col-10">
                          <input list="productosauto" name="txtproductodesc" id="txtproductodesc" autocomplete="off" class="form-control" placeholder="Escriba el nombre del producto a buscar" onKeyPress="buscar_barcode_producto(event)">
                        <datalist id="productosauto">
                             <?php
                            $consulta_catalogopa=mysql_query("select * from cproductos where id_sucursal=$id_sucursal");
                            while($resultado_catalogopa=mysql_fetch_array($consulta_catalogopa))
                            {
                            ?> 
                              <option value="<?php echo utf8_encode($resultado_catalogopa[descripcion]); ?>"></option>        
                                    <?php 
                            } 
                            ?> 
                         </datalist>
                        </div>
                    </div>
                    <div class="form-group">
                      <label class="form-control-label" for="backup_file">Escriba el numero de copias a imprimir</label>
                        <div class="col-10">
                          <input type="text" name="txtnumero_copias" id="txtnumero_copias" class="form-control" value="1" />
                        </div>
                    </div>
                  </form>
                </div>
                  <div class="box-body" id="result">
                    <svg id="barcode"></svg>
                  </div>
                </div><!-- /.box-body -->
                <div class="box-footer">
          <button type="button" class="btn btn-primary" onClick="javascript:codigo_barras_producto_generar();">Vista previa</button>
                  </div>
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
    <script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <!-- DataTables -->
    <script src="plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="plugins/datatables/dataTables.bootstrap.min.js"></script>
    <!-- SlimScroll -->
    <script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <!-- FastClick -->
    <script src="plugins/fastclick/fastclick.min.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/app.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="dist/js/demo.js"></script>
    <!--  Barcodes js -->
    <script src="js/JsBarcode.all.min.js"></script>
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

     $(document).ready(function(){
        $("#codigo").on('input',newBarcode);
     newBarcode();   
    });  
      var newBarcode = function() {
    //Convert to boolean
    $("#barcode").JsBarcode(
        $("#codigo").val(),{
          "format": "CODE128",
          "displayValue": "true",
          "valid":
            function(valid){
              if(valid){
                $("#barcode").show();
                $("#invalid").hide();
              }
              else{
                $("#barcode").hide();
                $("#invalid").show();
              }
            }
        });
    }
    </script>
</form> 
  </body>
</html>
