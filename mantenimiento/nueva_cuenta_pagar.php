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

$sql = "select nombre_usuario from cusuarios order by nombre_usuario";
$res = mysql_query($sql);
$arreglo_php = array();
if(mysql_num_rows($res)==0)
   array_push($arreglo_php, "No hay datos");
else{
  while($palabras = mysql_fetch_array($res)){
    array_push($arreglo_php, $palabras["nombre_usuario"]);
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
<form id="frm_nueva_cuenta_pagar" name="frm_nueva_cuenta_pagar" action="" method="post"> 
  <input id="sel" type="hidden" value="-1">
  <input id="oper" name="oper" type="hidden" value=""> 
  <input type="hidden" id="txtnum_pag" name="txtnum_pag" value="" /> 
  <input id="txtfilepageserver" type="hidden" value=""/>    
  <input type="hidden" id="txtid_producto_inventario_eliminar" name="txtid_producto_inventario_eliminar" value="" /> 
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
            Nueva cuenta por pagar
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
                      Proveedor: <input list="proveedores" name="txtnombre_proveedor" id="txtnombre_proveedor" autocomplete="off" class="form-control" placeholder="escriba el nombre del proveedor">
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
                        <input id="txtdocumento_pagar" name="txtdocumento_pagar" class="form-control input-lg" type="text" placeholder="Escriba la referencia del documento a pagar">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Total a pagar</label>
                        <input id="txttotal_pagar" name="txttotal_pagar" class="form-control input-lg" type="text" placeholder="escribe el monto de dinero, ejemplo: 10000" onkeypress="return soloNumeros(event)" onblur="limpia()" >
                    </div>
                     <div class="form-group">
                      <label for="exampleInputEmail1">Descuento por pronto pago</label>
                        <input id="txtdescuento_pronto_pago" name="txtdescuento_pronto_pago" class="form-control input-lg" type="text" placeholder="escribe el monto de dinero, ejemplo: 10000" onkeypress="return soloNumeros(event)" onblur="limpia()" >
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Fecha del proximo pago</label>
                      <input type="text" id="datepicker1" name="datepicker1" />
                      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    </div>
                    

					
                  </div><!-- /.box-body -->
				  
                  <div class="box-footer">
					<button type="button" class="btn btn-primary" onClick="javascript:alta_cuenta_pagar();">Guardar</button>
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
