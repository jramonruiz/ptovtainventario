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

$idcliente=$_GET["idcliente"];
if($idcliente>0)
{
$cadena="select * from cclientes where id_cliente=$idcliente";
$query = "select * from cclientes where id_cliente=$idcliente";
$result = mysql_query($query) or die("SQL Error 1: " . mysql_error());
// get data and store in a json array
while ($row = mysql_fetch_array($result)) 
{
//id_cliente,nombre_cliente,direccion,rfc,telefono,email,numero_exterior,numero_interior,colonia,localidad,municipio,estado,pais,codigo_postal,nombre_comercial,fecha_captura,celular,referencias_observaciones,nombre_contacto,calle_contacto,colonia_contacto,localidad_contacto,estado_contacto,codigo_postal_contacto,telefono_contacto,fax_contacto,celular_contacto,email_contacto
$id_clientetc=utf8_encode($row[0]);
$nombre_cliente=utf8_encode($row[1]);
$direccion=utf8_encode($row[2]);
$rfc=utf8_encode($row[3]);
$telefono=utf8_encode($row[4]);
$email=utf8_encode($row[5]);
$numero_exterior=utf8_encode($row[6]);
$numero_interior=utf8_encode($row[7]);
$colonia=utf8_encode($row[8]);
$localidad=utf8_encode($row[9]);
$municipio=utf8_encode($row[10]);
$estado=utf8_encode($row[11]);
$pais=utf8_encode($row[12]);
$codigo_postal=utf8_encode($row[13]);
$nombre_comercial=utf8_encode($row[14]);
$fecha_captura=utf8_encode($row[15]);
$celular=utf8_encode($row[16]);
$referencias_observaciones=utf8_encode($row[17]);
$nombre_contacto=utf8_encode($row[18]);
$calle_contacto=utf8_encode($row[19]);
$colonia_contacto=utf8_encode($row[20]);
$localidad_contacto=utf8_encode($row[21]);
$estado_contacto=utf8_encode($row[22]);
$codigo_postal_contacto=utf8_encode($row[23]);
$telefono_contacto=utf8_encode($row[24]);
$fax_contacto=utf8_encode($row[25]);
$celular_contacto=utf8_encode($row[26]);
$email_contacto=utf8_encode($row[27]);
$descuento=utf8_encode($row[28]);
$id_tipo_cliente=utf8_encode($row[29]);
$codigo_tarjeta=utf8_encode($row[30]);
}



//id_credencial,id_cliente,fecha_vencimiento,descuento_porcentaje,precio_predeterminado,precio_minimo,limite_credito,saldo,credito_disponible,forma_pago,numero_cuenta
$querycc = "select * from tcliente_credencial where id_cliente=$id_clientetc";
$resultcc = mysql_query($querycc) or die("SQL Error 1: " . mysql_error());
// get data and store in a json array
while ($rowcc = mysql_fetch_array($resultcc)) 
{
//id_credencial,id_cliente,fecha_vencimiento,descuento_porcentaje,precio_predeterminado,precio_minimo,limite_credito,saldo,credito_disponible,forma_pago,numero_cuenta,numero_credencial
$id_credencial=utf8_encode($rowcc[0]);
$id_clientetarcred=utf8_encode($rowcc[1]);
$fecha_vencimiento=utf8_encode($rowcc[2]);
$descuento_porcentaje=utf8_encode($rowcc[3]);
$precio_predeterminado=utf8_encode($rowcc[4]);
$precio_minimo=utf8_encode($rowcc[5]);
$limite_credito=utf8_encode($rowcc[6]);
$saldo=utf8_encode($rowcc[7]);
$credito_disponible=utf8_encode($rowcc[8]);
$forma_pago=utf8_encode($rowcc[9]);
$numero_cuenta=utf8_encode($rowcc[10]);
$numero_credencial=utf8_encode($rowcc[11]);
}

$querytcc = "select * from ctipocliente where id_tipo_cliente=$id_tipo_cliente";
$resuttcc = mysql_query($querytcc) or die("SQL Error 1: " . mysql_error());
// get data and store in a json array
while ($rowtcc = mysql_fetch_array($resuttcc)) 
{
//id_credencial,id_cliente,fecha_vencimiento,descuento_porcentaje,precio_predeterminado,precio_minimo,limite_credito,saldo,credito_disponible,forma_pago,numero_cuenta,numero_credencial
$id_tipo_clienteb=utf8_encode($rowtcc[0]);
$tipo_clienteb=utf8_encode($rowtcc[1]);
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
  
<link rel="stylesheet" href="../css/ui-lightness/jquery-ui-1.10.3.custom.css" />
<!--scripts de HOJAS DE ESTILO CSS para el calendario------------->
<link rel="stylesheet" href="jquery-ui.css" />
<!---------------Aqui termina------------------------------>


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
  
<script src="../js/jquery-1.9.1.js" type="text/javascript"></script>
<script src="../js/jquery-ui-1.10.3.custom.js" type="text/javascript"></script> 


  </head>
  <body class="hold-transition skin-yellow-light sidebar-mini">
<form id="frm_modificar_cliente" name="frm_modificar_cliente" action="" method="post"> 
  <input id="sel" type="hidden" value="-1">
  <input id="oper" name="oper" type="hidden" value=""> 
  <input type="hidden" id="txtnum_pag" name="txtnum_pag" value="" /> 
  <input id="txtfilepageserver" type="hidden" value=""/>     
  <input type="hidden" id="txtid_cliente_modificar" name="txtid_cliente_modificar" value="<?php echo $id_clientetc; ?>" />
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
            Modificar Cliente
          </h1>
<!--          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Forms</a></li>
            <li class="active">General Elements</li>
          </ol>
-->        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <!-- left column -->
            <div class="col-md-12">
              <!-- general form elements -->
              <div class="box box-primary">
              <div class="box-header with-border">
                  <h3 class="box-title">DATOS GENERALES Y DOMICILIO</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <!-- form role="form" -->
                  <div class="box-body">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Nombre del cliente</label>
                        <input id="txtnombre_cliente" name="txtnombre_cliente" class="form-control input-lg" type="text" value="<?php echo $nombre_cliente; ?>">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">R.F.C.</label>
                        <input id="txtrfc" name="txtrfc" class="form-control input-lg" type="text" value="<?php echo $rfc; ?>">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Calle</label>
                        <input id="txtdireccion" name="txtdireccion" class="form-control input-lg" type="text" value="<?php echo $direccion; ?>">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Numero Exterior</label>
                        <input id="txtnumero_exterior" name="txtnumero_exterior" class="form-control input-lg" type="text" value="<?php echo $numero_exterior; ?>">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Numero Interior</label>
                        <input id="txtnumero_interior" name="txtnumero_interior" class="form-control input-lg" type="text" value="<?php echo $numero_interior; ?>">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Colonia</label>
                        <input id="txtcolonia" name="txtcolonia" class="form-control input-lg" type="text" value="<?php echo $colonia; ?>">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Codigo Postal</label>
                        <input id="txtcodigo_postal" name="txtcodigo_postal" class="form-control input-lg" type="text" value="<?php echo $codigo_postal; ?>">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Telefono</label>
                        <input id="txttelefono" name="txttelefono" class="form-control input-lg" type="text" value="<?php echo $telefono; ?>">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Celular</label>
                        <input id="txtcelular" name="txtcelular" class="form-control input-lg" type="text" value="<?php echo $celular; ?>">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Correo</label>
                        <input id="txtcorreo" name="txtcorreo" class="form-control input-lg" type="text" value="<?php echo $email; ?>">
                    </div>
                     <div class="form-group">
                      <label for="exampleInputEmail1">Referencias y Observaciones</label>
                        <input id="txtreferencias_observaciones" name="txtreferencias_observaciones" class="form-control input-lg" type="text" value="<?php echo $referencias_observaciones; ?>">
                    </div>          
                  </div><!-- /.box-body -->
                <!-- /form -->
              </div><!-- /.box -->

            </div><!--/.col (left) -->
          </div>   <!-- /.row -->

         <div class="box-footer">
                    <button type="button" class="btn btn-primary" onClick="javascript:modificar_datos_cliente();">Guardar</button>
<!--              <button type="button" class="btn btn-primary btn-block btn-flat" onClick="javascript:alta();">Acceso</button>-->
          
                  </div>

        </section><!-- /.content -->

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
