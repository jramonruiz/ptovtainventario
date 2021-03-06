<?php
error_reporting(0);
$tipusr="";
$paginterior=0;
include("../php/autentificacion.server.php");
session_name("lgsapplipweb");
session_start();
session_set_cookie_params(0, "/", $HTTP_SERVER_VARS["HTTP_HOST"], 0);

$id_usuario=$_SESSION["iduser"];
$nombre_usuario=$_SESSION["nombre_usuario"];
$id_sucursal=$_SESSION["sucursal"];

include("../php/conexion.php");
$connect = mysql_connect($hostname, $username, $password)
or die('Could not connect: ' . mysql_error());
//Select The database
$con = mysql_select_db($database, $connect);

$query = "select cu.id_usuario,cu.nombre_usuario,cs.descripcion_sucursal,cc.descripcion_caja from cusuarios cu inner join csucursales cs on cu.id_sucursal=cs.id_sucursal inner join ccajas cc on cu.id_caja=cc.id_caja where cu.id_usuario=$id_usuario";
$result = mysql_query($query) or die("SQL Error 1: " . mysql_error());
// get data and store in a json array
while ($row = mysql_fetch_array($result)) 
{
$id_usuario=utf8_encode($row[0]);
$nombre_usuario=utf8_encode($row[1]);
$descripcion_sucursal=utf8_encode($row[2]);
$descripcion_caja=utf8_encode($row[3]);
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
	
	
<link rel="stylesheet" href="../css/ui-lightness/jquery-ui-1.10.3.custom.css" />
<!--scripts de HOJAS DE ESTILO CSS para el calendario------------->
<link rel="stylesheet" href="jquery-ui.css" />
<!---------------Aqui termina------------------------------>

<script type="text/javascript" src="../js/reportes.js"></script>

<script type="text/javascript" src="../js/login.js"></script>


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

</head>

  <body class="hold-transition skin-yellow-light sidebar-mini">
<form id="frm_reporte_desglose_notas" name="frm_reporte_desglose_notas" action="" method="post"> 
  <input id="sel" type="hidden" value="-1">
  <input id="oper" name="oper" type="hidden" value=""> 
  <input type="hidden" id="txtnum_pag" name="txtnum_pag" value="" /> 
  <input id="txtfilepageserver" type="hidden" value=""/>     
  <input type="hidden" id="txtid_usuario" name="txtid_usuario" value="<?php echo $id_usuario; ?>" />
  <input type="hidden" id="txtnombre_usuario" name="txtnombre_usuario" value="<?php echo $nombre_usuario; ?>" />
  <input type="hidden" id="txtdescripcion_caja" name="txtdescripcion_caja" value="<?php echo $descripcion_caja; ?>" />
  <input type="hidden" id="txtdescripcion_sucursal" name="txtdescripcion_sucursal" value="<?php echo $descripcion_sucursal; ?>" />
  <input type="hidden" id="txtid_sucursal" name="txtid_sucursal" value="<?php echo $id_sucursal; ?>" />
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
            Reporte de Desglose de notas
          </h1>
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
                      <label for="exampleInputEmail1">Fecha de inicial</label>
		<input type="text" id="datepicker1" name="datepicker1" />
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label for="exampleInputEmail1">Fecha de final</label>
		<input type="text" id="datepicker2" name="datepicker2" /> 
		</div>
					
                  </div><!-- /.box-body -->
				  
                  <div class="box-footer">
					<button type="button" class="btn btn-primary" onClick="javascript:reporte_desglose_notas();">Ver Reporte</button>
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
