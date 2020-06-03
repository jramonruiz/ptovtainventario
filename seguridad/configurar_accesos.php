<?php
error_reporting(0);
$tipusr="";
$paginterior=0;
include("../php/autentificacion.server.php");
session_name("lgsapplipweb");
session_start();
session_set_cookie_params(0, "/", $HTTP_SERVER_VARS["HTTP_HOST"], 0);

$id_usuario=$_SESSION["iduser"];
$id_tipo_usuario=$_SESSION["tipo_usuario"];

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
$id_usuario_modificar=utf8_encode($row[0]);
$login=mb_convert_encoding($row[1], "UTF-8");
$clave=mb_convert_encoding($row[2], "UTF-8");
$tipo_usuario=mb_convert_encoding($row[3], "UTF-8");
$activo=mb_convert_encoding($row[4], "UTF-8");
$nombre_usuario=mb_convert_encoding($row[5], "UTF-8");
$fecha_creacion=mb_convert_encoding($row[6], "UTF-8");
$fecha_vencimiento=mb_convert_encoding($row[7], "UTF-8");
$clave_desencriptada=mb_convert_encoding($row[8], "UTF-8");
}
}

/******* PARA EL TIPOUSUARIO *****************/
$query2u = "select * from ctipousuarios where id_tipo_usuario=$tipo_usuario";
$result2u = mysql_query($query2u) or die("SQL Error 1: " . mysql_error());
while ($row2u = mysql_fetch_array($result2u)) 
	{
		$id_tipo_usuario=mb_convert_encoding($row2u[0], "UTF-8");
		$desc_tipo_usuario=mb_convert_encoding($row2u[1], "UTF-8");
	}
/******************************************/
?>        
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Sistema Administracion de Pacientes y Citas</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="../ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../dist/css/AdminLTE.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="../dist/css/skins/_all-skins.css">
	
	
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
<form id="frmconfigurar_accesos" name="frmconfigurar_accesos" action="" method="post"> 
  <input id="sel" type="hidden" value="-1">
  <input id="oper" name="oper" type="hidden" value=""> 
  <input type="hidden" id="txtnum_pag" name="txtnum_pag" value="" /> 
  <input id="txtfilepageserver" type="hidden" value=""/>     
  <input type="hidden" id="txtid_usuario_modificar" name="txtid_usuario_modificar" value="<?php echo $id_usuario_modificar; ?>" />
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
            Configurar accesos a usuario
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
                    <?php 
            if($id_tipo_usuario==1)
              {
                  $listado=  mysql_query("select tmu.id_menu_usuario,tms.menu,tmu.acceso,tmu.id_menu from tmenu_sistema tms inner join tmenu_usuario tmu on tms.id_menu=tmu.id_menu where tmu.id_usuario=$id_usuario_modificar order by tmu.id_menu");
                   while($reg=  mysql_fetch_array($listado))
                   {
                               $id_menu_usuario=mb_convert_encoding($reg['id_menu_usuario'], "UTF-8");
                               $menu=mb_convert_encoding($reg['menu'], "UTF-8");
                               $acceso=mb_convert_encoding($reg['acceso'], "UTF-8");
                               $id_menu=mb_convert_encoding($reg['id_menu'], "UTF-8");

                               if($acceso==1)
                               {
                                  $cadena_acceso="PERMITIR";
                               }
                               else
                               {  
                                  $cadena_acceso="DENEGAR";
                               }

                               $nomcombo="cmbacceso".$id_menu;
                  ?>    
                              <?php echo $menu; ?>
                              <select id="<?php echo $nomcombo; ?>" name="<?php echo $nomcombo; ?>">
                                  <option selected="selected" value="<?php echo $acceso; ?>"><?php echo $cadena_acceso; ?></option>
                                  <option value="1">PERMITIR</option>
                                  <option value="0">DENEGAR</option>
                              </select><br><br>
                  <?php
                  }
               }
            else
              {
                  $listado=  mysql_query("select tmu.id_menu_usuario,tms.menu,tmu.acceso,tmu.id_menu from tmenu_sistema tms inner join tmenu_usuario tmu on tms.id_menu=tmu.id_menu where tmu.id_usuario=$id_usuario_modificar and tms.ver=1 order by tmu.id_menu");
                   while($reg=  mysql_fetch_array($listado))
                   {
                               $id_menu_usuario=mb_convert_encoding($reg['id_menu_usuario'], "UTF-8");
                               $menu=mb_convert_encoding($reg['menu'], "UTF-8");
                               $acceso=mb_convert_encoding($reg['acceso'], "UTF-8");
                               $id_menu=mb_convert_encoding($reg['id_menu'], "UTF-8");

                               if($acceso==1)
                               {
                                  $cadena_acceso="PERMITIR";
                               }
                               else
                               {  
                                  $cadena_acceso="DENEGAR";
                               }

                               $nomcombo="cmbacceso".$id_menu;
                  ?>    
                              <?php echo $menu; ?>
                              <select id="<?php echo $nomcombo; ?>" name="<?php echo $nomcombo; ?>">
                                  <option selected="selected" value="<?php echo $acceso; ?>"><?php echo $cadena_acceso; ?></option>
                                  <option value="1">PERMITIR</option>
                                  <option value="0">DENEGAR</option>
                              </select><br><br>
                  <?php
                  }
               }                
                  ?>            
                    
                  </div><!-- /.box-body -->
				  
                  <div class="box-footer">
					<button type="button" class="btn btn-primary" onClick="javascript:configurar_acceso_usuario();">Guardar</button>
                  </div>
				  
				  
				  </form>	


              </div><!-- /.box -->
            </div><!--/.col (left) -->
          </div>   <!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
      <footer class="main-footer">
        <div class="pull-right hidden-xs">
&nbsp;
        </div>
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
