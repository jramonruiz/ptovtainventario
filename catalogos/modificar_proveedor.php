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
$telefono1_contacto=utf8_encode($row[3]);
$correo_contacto=utf8_encode($row[4]);
$rfc_empresa=utf8_encode($row[5]);
$fecha_captura=utf8_encode($row[6]);
$nombre_comercial=utf8_encode($row[7]);
$calle=utf8_encode($row[8]);
$colonia=utf8_encode($row[9]);
$codigo_postal=utf8_encode($row[10]);
$pais=utf8_encode($row[11]);
$estado=utf8_encode($row[12]);
$municipio=utf8_encode($row[13]);
$telefono2_contacto=utf8_encode($row[14]);
$telefono3_contacto=utf8_encode($row[15]);
$fax_contacto=utf8_encode($row[16]);
$pagina_web=utf8_encode($row[17]);
$observaciones=utf8_encode($row[18]);
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
<form id="frm_modificar_proveedor" name="frm_modificar_proveedor" action="" method="post"> 
  <input id="sel" type="hidden" value="-1">
  <input id="oper" name="oper" type="hidden" value=""> 
  <input type="hidden" id="txtnum_pag" name="txtnum_pag" value="" /> 
  <input id="txtfilepageserver" type="hidden" value=""/>     
  <input type="hidden" id="txtid_proveedor_modificar" name="txtid_proveedor_modificar" value="<?php echo $id_proveedor; ?>" />
    <div class="wrapper">

      <header class="main-header">
		<?php require_once("header_catalogos.php");?>
      </header>
	  
      <!-- Left side column. contains the logo and sidebar -->
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
            Modificar Proveedor
          </h1>
        </section>

        <!-- Main content -->
        <section class="content">
         
          <div class="row">
            <!-- left column -->
            <div class="col-md-12">
              <!-- general form elements -->
              <div class="box box-primary">
              <div class="box-header with-border">
                  <h3 class="box-title">DATOS GENERALES</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <!-- form role="form" -->
                  <div class="box-body">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Nombre o razon social</label>
                        <input id="txtnombre_empresa" name="txtnombre_empresa" class="form-control input-lg" type="text" value="<?php echo $nombre_empresa; ?>">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">R.F.C.</label>
                        <input id="txtrfc_empresa" name="txtrfc_empresa" class="form-control input-lg" type="text" value="<?php echo $rfc_empresa; ?>">
                    </div>
                    
                  </div><!-- /.box-body -->
                <!-- /form -->
              </div><!-- /.box -->

            </div><!--/.col (left) -->
          </div>   <!-- /.row -->

          <div class="row">
            <!-- left column -->
            <div class="col-md-12">
              <!-- general form elements -->
              <div class="box box-primary">
              <div class="box-header with-border">
                  <h3 class="box-title">DOMICILIO Y CONTACTO</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <!-- form role="form" -->
                  <div class="box-body">
                  <div class="form-group">
                      <label for="exampleInputEmail1">Nombre Comercial</label>
                        <input id="txtnombre_comercial" name="txtnombre_comercial" class="form-control input-lg" type="text" value="<?php echo $nombre_comercial; ?>">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Calle</label>
                        <input id="txtcalle" name="txtcalle" class="form-control input-lg" type="text" value="<?php echo $calle; ?>">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Colonia</label>
                        <input id="txtcolonia" name="txtcolonia" class="form-control input-lg" type="text" value="<?php echo $colonia; ?>">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Codigo postal</label>
                        <input id="txtcodigo_postal" name="txtcodigo_postal" class="form-control input-lg" type="text" value="<?php echo $codigo_postal; ?>">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Pais</label>
                        <input id="txtpais" name="txtpais" class="form-control input-lg" type="text" value="<?php echo $pais; ?>">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Estado</label>
                      <input list="cestados" name="txtestado" id="txtestado" autocomplete="off" class="form-control" value="<?php echo $estado; ?>">
                  <datalist id="cestados">
         <?php
                $consulta_catalogo1=mysql_query("select * from estados");
        while($resultado_catalogo1=mysql_fetch_array($consulta_catalogo1))
        {
        ?> 
          <option value="<?php echo utf8_encode($resultado_catalogo1[estado]); ?>">       
                <?php 
        } 
        ?> 
     </datalist>
                    </div>  
                    <div class="form-group">
                      <label for="exampleInputEmail1">Delegacion o municipio</label>
                      <input list="cmunicipios" name="txtmunicipio" id="txtmunicipio" autocomplete="off" class="form-control" value="<?php echo $municipio; ?>">
                  <datalist id="cmunicipios">
         <?php
                $consulta_catalogo2=mysql_query("select * from cmunicipios");
        while($resultado_catalogo2=mysql_fetch_array($consulta_catalogo2))
        {
        ?> 
          <option value="<?php echo utf8_encode($resultado_catalogo2[municipio]); ?>">        
                <?php 
        } 
        ?> 
     </datalist>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Nombre del contacto</label>
                        <input id="txtnombre_agente" name="txtnombre_agente" class="form-control input-lg" type="text" value="<?php echo $nombre_contacto; ?>">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Telefono 1</label>
                        <input id="txttelefono_agente" name="txttelefono_agente" class="form-control input-lg" type="text" value="<?php echo $telefono1_contacto; ?>">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Telefono 2</label>
                        <input id="txttelefono_agente2" name="txttelefono_agente2" class="form-control input-lg" type="text" value="<?php echo $telefono2_contacto; ?>">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Telefono 3</label>
                        <input id="txttelefono_agente3" name="txttelefono_agente3" class="form-control input-lg" type="text" value="<?php echo $telefono3_contacto; ?>">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Fax</label>
                        <input id="txtfax" name="txtfax" class="form-control input-lg" type="text" value="<?php echo $fax_contacto; ?>">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Email</label>
                        <input id="txtcorreo_agente" name="txtcorreo_agente" class="form-control input-lg" type="text" value="<?php echo $correo_contacto; ?>">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Pagina web</label>
                        <input id="txtpagina_web" name="txtpagina_web" class="form-control input-lg" type="text" value="<?php echo $pagina_web; ?>">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Observaciones</label>
                        <input id="txtobservaciones" name="txtobservaciones" class="form-control input-lg" type="text" value="<?php echo $observaciones; ?>">
                    </div>
                  </div><!-- /.box-body -->
                <!-- /form -->
              </div><!-- /.box -->
            </div><!--/.col (left) -->
          </div>   <!-- /.row -->

                    <div class="box-footer">
                          <button type="button" class="btn btn-primary" onClick="javascript:modificar_datos_proveedor();">Guardar</button>
                    </div>


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
  </body>
</form>
</html>
