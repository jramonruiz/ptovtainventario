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

$idcuentapagar=$_GET["idcuentapagar"];

if($idcuentapagar>0)
{
$query = "select id_cuenta_pagar,id_proveedor,nombre_proveedor,documento,total_pagar,faltante_pagar,pagada,descuento_pronto_pago,pagado_dinero,fecha_pago from tcuentas_pagar where id_cuenta_pagar=$idcuentapagar";
$result = mysql_query($query) or die("SQL Error 1: " . mysql_error());
// get data and store in a json array
// tcuentas_pagar = id_cuenta_pagar,id_proveedor,nombre_proveedor,documento,total_pagar,faltante_pagar,pagada
while ($row = mysql_fetch_array($result)) 
{
$id_cuenta_pagar=utf8_encode($row[0]);
$id_proveedor=utf8_encode($row[1]);
$nombre_proveedor=utf8_encode($row[2]);
$documento=utf8_encode($row[3]);
$total_pagar=utf8_encode($row[4]);
$faltante_pagar=utf8_encode($row[5]);
$pagada=utf8_encode($row[6]);
$descuento_pronto_pago=utf8_encode($row[7]);
$pagado_dinero=utf8_encode($row[8]);
$fecha_pago=utf8_encode($row[9]);
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
  
  
<link rel="stylesheet" href="../css/ui-lightness/jquery-ui-1.10.3.custom.css" />
<!--scripts de HOJAS DE ESTILO CSS para el calendario------------->
<link rel="stylesheet" href="jquery-ui.css" />
<!---------------Aqui termina------------------------------>



<!--scripts de JAVASCRIPT para el calendario-->




</head>

  <body class="hold-transition skin-yellow-light sidebar-mini">
<form id="frm_modificar_cuenta_pagar" name="frm_modificar_cuenta_pagar" action="" method="post"> 
  <input id="sel" type="hidden" value="-1">
  <input id="oper" name="oper" type="hidden" value=""> 
  <input type="hidden" id="txtnum_pag" name="txtnum_pag" value="" /> 
  <input id="txtfilepageserver" type="hidden" value=""/>    
  <input type="hidden" id="txtid_cuenta_pagar_modificar" name="txtid_cuenta_pagar_modificar" value="<?php echo $id_cuenta_pagar; ?>" /> 
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
            Modificar cuenta por pagar
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
                      Proveedor: <input list="proveedores" name="txtnombre_proveedor" id="txtnombre_proveedor" autocomplete="off" class="form-control" value="<?php echo $nombre_proveedor; ?>">
                        <datalist id="proveedores">
                             <?php
                            $consulta_catalogoproveedores=mysql_query("select * from cproveedores");
                            while($resultado_catalogoproveedores=mysql_fetch_array($consulta_catalogoproveedores))
                            {
                            ?> 
                              <option value="<?php echo utf8_encode($resultado_catalogoproveedores[nombre_empresa]); ?>"></option>        
                                    <?php 
                            } 
                            ?> 
                         </datalist>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Documento o factura</label>
                        <input id="txtdocumento_pagar" name="txtdocumento_pagar" class="form-control input-lg" type="text" value="<?php echo $documento; ?>">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Total a pagar</label>
                        <input id="txttotal_pagar" name="txttotal_pagar" class="form-control input-lg" type="text" value="<?php echo $total_pagar; ?>" onkeypress="return soloNumeros(event)" onblur="limpia()" >
                    </div>
                     <div class="form-group">
                      <label for="exampleInputEmail1">Descuento por pronto pago</label>
                        <input id="txtdescuento_pronto_pago" name="txtdescuento_pronto_pago" class="form-control input-lg" type="text" value="<?php echo $descuento_pronto_pago; ?>" onkeypress="return soloNumeros(event)" onblur="limpia()" >
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Fecha del proximo pago</label>
                      <input type="text" id="datepicker1" name="datepicker1" value="<?php echo $fecha_pago; ?>" />
                      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    </div>
                    

          
                  </div><!-- /.box-body -->
          
                  <div class="box-footer">
          <button type="button" class="btn btn-primary" onClick="javascript:modificar_datos_cuenta_pagar();">Guardar</button>
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
    <!--<script src="../js/jquery-1.9.0.js"></script>-->
    <script src="../js/jquery-ui.js"></script>
    
    <!-- Bootstrap 3.3.5 -->
    <script src="../bootstrap/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="../plugins/fastclick/fastclick.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../dist/js/app.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="../dist/js/demo.js"></script>
    <script type="text/javascript" src="../js/operaciones.js"></script>
    <script type="text/javascript" src="../js/login.js"></script>
    <script>

function limpia() {
    var val = document.getElementById("miInput").value;
    var tam = val.length;
    for(i = 0; i < tam; i++) {
        if(!isNaN(val[i]))
            document.getElementById("miInput").value = '';
    }
}

function soloNumeros(e) {
    key = e.keyCode || e.which;
    tecla = String.fromCharCode(key).toLowerCase();
    numeros = " 0123456789";
    especiales = [8, 37, 39, 46];

    tecla_especial = false
    for(var i in especiales) {
        if(key == especiales[i]) {
            tecla_especial = true;
            break;
        }
    }

    if(numeros.indexOf(tecla) == -1 && !tecla_especial)
        return false;
}

    
$(function() {
$( "#datepicker1" ).datepicker();
});
</script>
<script>
$(function() {
$( "#datepicker2" ).datepicker();
});
</script>
<!--Aqui termina--> 
</form> 
  </body>
</html>
