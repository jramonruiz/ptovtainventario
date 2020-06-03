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

$sq2 = "select nombre_cliente from cclientes order by nombre_cliente";
$res2 = mysql_query($sq2);
$arreglo_php2 = array();
if(mysql_num_rows($res2)==0)
   array_push($arreglo_php2, "No hay datos");
else{
  while($palabras2 = mysql_fetch_array($res2)){
    array_push($arreglo_php2, $palabras["nombre_cliente"]);
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
	
<script type="text/javascript" src="../js/operaciones.js"></script>
<script type="text/javascript" src="../js/login.js"></script>

<script>
  $(function(){
    var autocompletar = new Array();
    <?php //Esto es un poco de php para obtener lo que necesitamos
     for($p = 0;$p < count($arreglo_php2); $p++){ //usamos count para saber cuantos elementos hay ?>
       autocompletar.push('<?php echo $arreglo_php2[$p]; ?>');
     <?php } ?>
     $("#txtnombre_cliente").autocomplete({ //Usamos el ID de la caja de texto donde lo queremos
       source: autocompletar //Le decimos que nuestra fuente es el arreglo
     });
  });
  
</script>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="hold-transition skin-yellow-light sidebar-mini" onkeydown="tecla(event);">
<form id="frm_verificador_precios" name="frm_verificador_precios" action="" method="post"> 
  <input id="sel" type="hidden" value="-1">
  <input id="oper" name="oper" type="hidden" value=""> 
  <input type="hidden" id="txtnum_pag" name="txtnum_pag" value="" /> 
  <input id="txtfilepageserver" type="hidden" value=""/>   
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
            VERIFICADOR DE PRECIOS
          </h1>
        </section>
        <!-- Main content -->
        <section class="content"> 

        <div class="row">
            <!-- right column -->
            <div class="col-md-12">
              <!-- general form elements disabled -->
              <div class="box box-warning">
                <div class="box-body">
                    <!-- text input -->
                    <div class="form-group">
                      <div class="col-xs-12">
                        <input list="productosauto" name="txtproductodesc" id="txtproductodesc" autocomplete="off" class="form-control" placeholder="Escriba el nombre del producto a verificar su precio y despues presione la tecla ENTER" onKeyPress="verificar_precio(event,this.value)">
                        <datalist id="productosauto">
                             <?php
                            $consulta_catalogopa=mysql_query("select * from cproductos");
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
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!--/.col (right) -->
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


   
    <!-- Modal para DETALLES DEL PRODUCTO-->
          <div class="modal fade" id="exampleModalLong_verificador" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h1 class="modal-title" id="exampleModalLongTitle">DATOS DEL PRODUCTO</h1>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                <h4>Producto:<br><input type="text" id="txtdescripcion_productomod" name="txtdescripcion_productomod" value="" style="width: 550px;"></h4>
                </div>
                <div class="modal-body">
                <h4>Existencia:<input type="text" id="txtexistencia_productomod" name="txtexistencia_productomod" value=""></h4>
                </div>
                <div class="modal-body">
                <h4>Precio de venta:<input type="text" id="txtprecio_venta_mod" name="txtprecio_venta_mod" value=""></h4>
                </div>
              </div>
            </div>
          </div>

    <!-- page script -->
    <script>

    function disableFunctionKeys(e) {
    var functionKeys = new Array(112, 113, 114, 115, 116, 117, 118, 119, 120, 121, 123);
    if (functionKeys.indexOf(e.keyCode) > -1 || functionKeys.indexOf(e.which) > -1) {
        e.preventDefault();
    }
};

$(document).ready(function() {
    $(document).on('keydown', disableFunctionKeys);
});

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
    <script type="text/javascript">

    $(document).ready(function(){
    $("#txtcodigobp").focus();
});

function buscar_producto_venta_formulario(e)
{
  tecla = (document.all) ? e.keyCode : e.which;
  if (tecla==13)
    { 
      $('#myModal').modal()
    } 
    else
      {
        alert("presione enter para buscar el producto");
      }
}

/*f1  112 f2  113
f3  114 f4  115 f5  116
f6  117 f7  118 f8  119
f9  120 f10 121 f11 122*/

function tecla(e)
{
    var evt = e ? e : event;
    var key = window.Event ? evt.which : evt.keyCode;
    //alert (key);
    if(key==118) //F7 CANTIDAD
      {
        mostrarmodal_modificar();
      }
    else if(key==121) // F10 ELIMINAR
    {
      mostrarmodal_eliminar();
    }
    else if(key==113) // F2 COBRAR
    {
      mostrarmodal_cobrar();
    }
    else if(key==123) // F12 RETIRAR
    {
      mostrarmodal_retirar();
    }
    else if(key==114) // F3 PRECIO
    {
      mostrarmodal_precio();
    }
    else if(key==119) // F8 DESCUENTO
    {
      mostrarmodal_descuento();
    }
    else if(key==115) // F4 OPERACION
    {
      mostrarmodal_operacion();
    }
}

    </script>


</form>	
  </body>
</html>
