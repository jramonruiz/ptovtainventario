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

$idusuariomodificar=$_GET['idusuariomodificar'];
if($idusuariomodificar>0)
{
$query = "select * from cusuarios where id_usuario=$idusuariomodificar";
$result = mysql_query($query) or die("SQL Error 1: " . mysql_error());
// get data and store in a json array
while ($row = mysql_fetch_array($result)) 
{
$id_usuario=utf8_encode($row[0]);
$login=utf8_encode($row[1]);
$clave=utf8_encode($row[2]);
$tipo_usuario=utf8_encode($row[3]);
$activo=utf8_encode($row[4]);
$nombre_usuario=utf8_encode($row[5]);
$fecha_creacion=utf8_encode($row[6]);
$fecha_vencimiento=utf8_encode($row[7]);
$clave_desencriptada=utf8_encode($row[8]);
$intentos=$row[9];
$id_sucursal=utf8_encode($row[10]);
$id_caja=$row[18];
$comision=$row[19];
}
}

/******* PARA EL TIPOUSUARIO *****************/
$query2u = "select * from ctipousuarios where id_tipo_usuario=$tipo_usuario";
$result2u = mysql_query($query2u) or die("SQL Error 1: " . mysql_error());
while ($row2u = mysql_fetch_array($result2u)) 
	{
		$id_tipo_usuario=utf8_encode($row2u[0]);
		$descripcion_tipo_usuario=utf8_encode($row2u[1]);
	}
/******************************************/


/******* PARA EL CAJA *****************/
$query2c = "select * from ccajas where id_caja=$id_caja";
$result2c = mysql_query($query2c) or die("SQL Error 1: " . mysql_error());
while ($row2c = mysql_fetch_array($result2c)) 
	{
		$id_caja=utf8_encode($row2c[0]);
		$descripcion_caja=utf8_encode($row2c[1]);
	}
/******************************************/

/******* PARA EL SUCURSAL *****************/
$query2suc = "select * from csucursales where id_sucursal=$id_sucursal";
$result2suc = mysql_query($query2suc) or die("SQL Error 1: " . mysql_error());
while ($row2suc = mysql_fetch_array($result2suc)) 
  {
    $id_sucursal=utf8_encode($row2suc[0]);
    $descripcion_sucursal=utf8_encode($row2suc[1]);
  }
/******************************************/

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

<script type="text/javascript" src="../js/operaciones.js"></script>

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
<form id="frm_modificar_usuario" name="frm_modificar_usuario" action="" method="post"> 
  <input id="sel" type="hidden" value="-1">
  <input id="oper" name="oper" type="hidden" value=""> 
  <input type="hidden" id="txtnum_pag" name="txtnum_pag" value="" /> 
  <input id="txtfilepageserver" type="hidden" value=""/>     
  <input type="hidden" id="txtid_usuario_modificar" name="txtid_usuario_modificar" value="<?php echo $idusuariomodificar; ?>" />
  <input type="hidden" id="txtclave_desencriptada" name="txtclave_desencriptada" value="<?php echo $clave_desencriptada; ?>" />
    <div class="wrapper">

      <header class="main-header">
		<?php require_once("header_seguridad.php");?>
      </header>
	  
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
			<?php require_once("menu_opciones_seguridad.php");?>
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Modificar Usuario
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
                      <label for="exampleInputEmail1">Nombre</label>
                        <input id="txtnombre_usuario" name="txtnombre_usuario" class="form-control input-lg" type="text" placeholder="" value="<?php echo $nombre_usuario; ?>">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Login</label>
                        <input id="txtlogin_usuario" name="txtlogin_usuario" class="form-control input-lg" type="text" placeholder="" value="<?php echo $login; ?>">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Password</label>
                        <input id="txtpassword_usuario" name="txtpassword_usuario" class="form-control input-lg" type="password" placeholder="" value="<?php echo $clave_desencriptada; ?>">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Confirmar Password</label>
                        <input id="txtconfirmar_password_usuario" name="txtconfirmar_password_usuario" class="form-control input-lg" type="password" placeholder="" value="<?php echo $clave_desencriptada; ?>">
                    </div>
                    <div class="form-group">
                      <label>Activo</label>
                      <select id="cmbactivo_usuario" name="cmbactivo_usuario" class="form-control">
            	<?php
					if($activo==1)
						{
							$cadena_activo="SI";	
						}
					else
						{
							$cadena_activo="NO";	
						}
				?>
				<option selected="selected" value="<?php echo $activo; ?>"><?php echo $cadena_activo; ?></option>
				<option value="1">SI</option>
				<option value="2">NO</option>
                      </select>
                    </div>


                    <div class="form-group">
                      <label for="exampleInputEmail1">Fecha de creacion</label>
		<input type="text" id="datepicker1" name="datepicker1" value="<?php echo $fecha_creacion; ?>" />
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label for="exampleInputEmail1">Fecha de vencimiento</label>
		<input type="text" id="datepicker2" name="datepicker2" value="<?php echo $fecha_vencimiento; ?>" /> 
		</div>
					
                  </div><!-- /.box-body -->
				  
                  <div class="box-footer">
					<button type="button" class="btn btn-primary" onClick="javascript:modificar_usuario();">Guardar</button>
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
