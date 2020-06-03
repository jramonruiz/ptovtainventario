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

$idventa=$_GET["idventa"];
$idcliente=$_GET["idcliente"];

if($idventa>0)
{
$query = "select id_venta,fecha_venta,total_pagar,folio_venta,id_cliente,nombre_cliente,pagado_totalmente from tventas where id_venta=$idventa";
$result = mysql_query($query) or die("SQL Error 1: " . mysql_error());
// get data and store in a json array
// tcuentas_pagar = id_cuenta_pagar,id_proveedor,nombre_proveedor,documento,total_pagar,faltante_pagar,pagada
while ($row = mysql_fetch_array($result)) 
{
$id_venta=utf8_encode($row[0]);
$fecha_venta=utf8_encode($row[1]);
$total_pagar=utf8_encode($row[2]);
$folio_venta=utf8_encode($row[3]);
$id_cliente=utf8_encode($row[4]);
$nombre_cliente=utf8_encode($row[5]);
$pagado_totalmente=utf8_encode($row[6]);
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
<form id="frm_nuevo_abono_cobrar" name="frm_nuevo_abono_cobrar" action="" method="post"> 
  <input id="sel" type="hidden" value="-1">
  <input id="oper" name="oper" type="hidden" value=""> 
  <input type="hidden" id="txtnum_pag" name="txtnum_pag" value="" /> 
  <input id="txtfilepageserver" type="hidden" value=""/>    
  <input type="hidden" id="txtid_venta" name="txtid_venta" value="<?php echo $id_venta; ?>" /> 

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
            Nuevo abono Cobrar
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
                      <h4><strong>Cliente:</strong> <?php echo $nombre_cliente; ?>, <strong>Ticket:</strong> <?php echo $folio_venta; ?></h4><br>
                      <h4><strong>Total a pagar: $ </strong><?php echo $total_pagar; ?></h4><br>
                      </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Tipo de pago:</label><input list="tipospago" name="txttipo_pago" id="txttipo_pago" autocomplete="off" class="form-control" placeholder="escriba el tipo de pago, ejemplo: EFECTIVO, TARJETA DE CREDITO">
                        <datalist id="tipospago">
                             <?php
                            $consulta_catalogotipopago=mysql_query("select * from tmetodos_pago");
                            while($resultado_catalogotipopago=mysql_fetch_array($consulta_catalogotipopago))
                            {
                            ?> 
                              <option value="<?php echo utf8_encode($resultado_catalogotipopago[desc_metodo_pago]); ?>"></option>        
                                    <?php 
                            } 
                            ?> 
                         </datalist>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Importe</label>
                        <input id="txtimporte_abono" name="txtimporte_abono" class="form-control input-lg" type="text" placeholder="escribe el importe, ejemplo: 10000" onkeypress="return soloNumeros(event)" onblur="limpia()" >
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Comentario</label>
                        <input id="txtcomentario" name="txtcomentario" class="form-control input-lg" type="text" placeholder="algun comentario sobre el abono">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">LISTA DE ABONOS</label>
                      <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                          <th>Fecha del Abono</th>
                          <th>Tipo de pago</th>
                          <th>Comentario</th>
                          <th>Importe del Abono</th>
                          <th>Faltante a pagar</th>
                        </tr>
                         </thead>
                    <tbody>
                        <?php 
$listado=  mysql_query("select tap.id_abono_ccobrar,tap.fecha,tap.id_tipo_pago,tap.importe,tap.comentario,tap.pagado,tmp.desc_metodo_pago from tabonos_ccobrar tap inner join tmetodos_pago tmp on tap.id_tipo_pago=tmp.id_metodo_pago where tap.id_venta=$id_venta order by tap.fecha");
                   while($reg=  mysql_fetch_array($listado))
                   {
                               $id_abono_ccobrar=utf8_encode($reg['id_abono_ccobrar']);
                               $fecha=utf8_encode($reg['fecha']);
                               $desc_metodo_pago=utf8_encode($reg['desc_metodo_pago']);
                               $importe=utf8_encode($reg['importe']);
                               $comentario=utf8_encode($reg['comentario']);
                               $pagado=utf8_encode($reg['pagado']);

                               $rssumabon = mysql_query("select SUM(importe) as importetotabon from tabonos_ccobrar where id_venta=$id_venta");
                            if ($rowsumabon = mysql_fetch_row($rssumabon)) {
                            $importetotabon = trim($rowsumabon[0]);
                            }

                            $faltante_pagar=$total_pagar-$importetotabon;


                               
?>        
                      <tr>
                        <td><?php echo $fecha; ?></td>
                        <td><?php echo $desc_metodo_pago; ?></td>
                        <td><?php echo $comentario; ?></td>
                        <td><?php echo $importe; ?></td>
                        <td><?php echo $faltante_pagar; ?></td>
                      </tr>
<?php
        }
?>        
                  </tbody>
                    <tfoot>
                      <tr>
                          <th>Fecha del Abono</th>
                          <th>Tipo de pago</th>
                          <th>Comentario</th>
                          <th>Importe del Abono</th>
                          <th>Faltante a pagar</th>
                        </tr>
                       </tfoot>
                      </table>
                    </div>
                  </div><!-- /.box-body -->

                  <?php
                    if($pagado_totalmente==0)
				              {
                  ?>
                  <div class="box-footer">
					<button type="button" class="btn btn-primary" onClick="javascript:alta_abono_cobrar();">Guardar</button>
                  </div>
                  <?php
                      }
                  ?>
				  
				  
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
