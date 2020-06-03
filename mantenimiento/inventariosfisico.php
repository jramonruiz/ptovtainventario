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

$fecha_captura = date(Y)."/".date(m)."/".date(d);

$sq2 = "select nombre_empresa from cproveedores order by nombre_empresa";
$res2 = mysql_query($sq2);
$arreglo_php2 = array();
if(mysql_num_rows($res2)==0)
   array_push($arreglo_php2, "No hay datos");
else{
  while($palabras2 = mysql_fetch_array($res2)){
    array_push($arreglo_php2, $palabras2["nombre_empresa"]);
  }
}

$sq3 = "select nombre_empresa from cproveedores order by nombre_empresa";
$res3 = mysql_query($sq3);
$arreglo_php3 = array();
if(mysql_num_rows($res3)==0)
   array_push($arreglo_php3, "No hay datos");
else{
  while($palabras3 = mysql_fetch_array($res3)){
    array_push($arreglo_php3, $palabras3["descripcion"]);
  }
}

$rs = mysql_query("select count(id_producto) as numero_productos_inventariado from tinventariof_productos where id_sucursal=$id_sucursal and id_inventario=0");
if ($row = mysql_fetch_row($rs)) {
$numero_productos_inventariado = trim($row[0]);
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
  
<script type="text/javascript" src="../js/operaciones.js"></script>
<script type="text/javascript" src="../js/login.js"></script>

<script>
  $(function(){
    var autocompletar = new Array();
    <?php //Esto es un poco de php para obtener lo que necesitamos
     for($p = 0;$p < count($arreglo_php2); $p++){ //usamos count para saber cuantos elementos hay ?>
       autocompletar.push('<?php echo $arreglo_php2[$p]; ?>');
     <?php } ?>
     $("#txtnombre_proveedor").autocomplete({ //Usamos el ID de la caja de texto donde lo queremos
       source: autocompletar //Le decimos que nuestra fuente es el arreglo
     });
  });
  
</script>

<script>
  $(function(){
    var autocompletar = new Array();
    <?php //Esto es un poco de php para obtener lo que necesitamos
     for($p = 0;$p < count($arreglo_php3); $p++){ //usamos count para saber cuantos elementos hay ?>
       autocompletar.push('<?php echo $arreglo_php3[$p]; ?>');
     <?php } ?>
     $("#txtdescripcion_producto").autocomplete({ //Usamos el ID de la caja de texto donde lo queremos
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
  <body class="hold-transition skin-yellow-light sidebar-mini">
<form id="frm_nuevo_actualizacion_inventario" name="frm_nuevo_actualizacion_inventario" action="" method="post"> 
  <input id="sel" type="hidden" value="-1">
  <input id="oper" name="oper" type="hidden" value=""> 
  <input type="hidden" id="txtnum_pag" name="txtnum_pag" value="" /> 
  <input type="hidden" id="txtid_producto_buscar" name="txtid_producto_buscar" value="" /> 
  <input id="txtfilepageserver" type="hidden" value=""/>  
  <input type="hidden" id="txtid_usuario" name="txtid_usuario" value="<?php echo $id_usuario; ?>" /> 
  <input type="hidden" id="txtnombre_usuario" name="txtnombre_usuario" value="<?php echo $nombre_usuario; ?>" /> 
  <input type="hidden" id="txtfecha_captura" name="txtfecha_captura" value="<?php echo $fecha_captura; ?>" />    
  <input type="hidden" id="txtid_producto" name="txtid_producto" value="" /> 
  <input type="hidden" id="txtcantidad_producto" name="txtcantidad_producto" value="" />  
  <input type="hidden" id="txtnumero_productos_inventaridado" name="txtnumero_productos_inventaridado" value="<?php echo $numero_productos_inventariado; ?>" />
  <input type="hidden" id="txtcantidad_productobuslis" name="txtcantidad_productobuslis" value="" /> 
   
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
            Actualizando Inventario&nbsp;&nbsp;&nbsp;<button type="button" class="btn btn-primary" onClick="javascript:mostrarmodal_operacion();">Buscar producto</button>
          </h1>
        </section>

        <!-- Main content -->
        <section class="content">
        
          <div class="row">
      
            <!-- right column -->
            <div class="col-md-12">
              <!-- general form elements disabled -->
              <div class="box box-warning">
                <div class="box-header with-border">
                  <h3 class="box-title">Datos del usuario</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <!-- text input -->
                    <div class="form-group">
            Nombre Usuario: <b><?php echo $nombre_usuario; ?></b>&nbsp;&nbsp;&nbsp;
            Fecha de captura: <b><?php echo $fecha_captura; ?></b>&nbsp;&nbsp;&nbsp;
            <button type="button" class="btn btn-primary" onClick="javascript:guardar_inventario_fisico();">Guardar Datos</button>
            <!--<br>
            R.F.C.: <b>RFC DEL CLIENTE</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Domicilio: <b>DOMICILIO DEL CLIENTE</b>-->
                    </div>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!--/.col (right) -->
      
          </div><!-- /.row -->

          <div class="row">
            <!-- right column -->
            <div class="col-md-12">
              <!-- general form elements disabled -->
              <div class="box box-warning">
                <div class="box-body">
                    <!-- text input -->
                    <div class="form-group">
                      <div class="col-xs-12">
                        <input list="productosauto" name="txtproductodesc" id="txtproductodesc" autocomplete="off" class="form-control" placeholder="Escriba el nombre del producto a consultar y despues presione la tecla ENTER" onKeyPress="consultar_producto_inventario_fisico(event)">
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
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!--/.col (right) -->
          </div><!-- /.row --> 
    
          <div class="row">
      
            <!-- right column -->
            <div class="col-md-12">
              <div class="box">
                <div class="box-header with-border">
                  <h3 class="box-title">Lista de productos inventariados</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>Eliminar</th>
                        <th>Codigo</th>
                        <th>Descripcion</th>
                        <th>Cantidad contada</th>            
                      </tr>
                    </thead>
                    <tbody>
<?php 
$listado=  mysql_query("select tip.id_inventario_producto,cp.codigo_barras,cp.descripcion,tip.cantidad_contada from tinventariof_productos tip inner join cproductos cp on tip.id_producto=cp.id_producto where tip.id_inventario=0 and tip.id_sucursal=$id_sucursal");
                   while($reg=  mysql_fetch_array($listado))
                   {
                      $id_inventario_producto=utf8_encode($reg['id_inventario_producto']);
                      $codigo_barras=utf8_encode($reg['codigo_barras']);
                      $descripcion=utf8_encode($reg['descripcion']); 
                      $cantidad_contada=utf8_encode($reg['cantidad_contada']);
         ?>
                      <tr>
                        <td class="mailbox-star"><a onClick="javascript:eliminar_producto_inventario_fisico(<?php echo $id_inventario_producto; ?>);" style="cursor:pointer;"><i class="fa fa-remove text-red"></i></a></td>
                        <td><?php echo $codigo_barras; ?></td>
                        <td><?php echo $descripcion; ?></td>
                        <td><?php echo $cantidad_contada; ?></td>
                      </tr>
<?php         
          
        }
?>            
                    </tbody>
                    <tfoot>
                      <tr>
                        <th>Eliminar</th>
                        <th>Codigo</th>
                        <th>Descripcion</th>
                        <th>Cantidad contada</th>                        
                      </tr>
                    </tfoot>
                  </table>
                </div><!-- /.box-body -->
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

    <!-- Modal para DETALLES DEL PRODUCTO-->
          <div class="modal fade" id="exampleModalLong_inventariofisico" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h1 class="modal-title" id="exampleModalLongTitle">DATOS DEL PRODUCTO</h1>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                Id:<input type="text" id="txtid_productoinventario" name="txtid_productoinventario" value="">
                </div>
                <div class="modal-body">
                <h4>Producto:<input type="text" id="txtdescripcion_productomod" name="txtdescripcion_productomod" value=""></h4>
                </div>
                <div class="modal-body">
                <h4>Cantidad contada:<input type="text" id="txtcantidad_contada" name="txtcantidad_contada" value="" placeholder="captura la cantidad contada del producto, ejemplo: 10" onKeyPress="javascript:agregar_producto_inventario_fisico(event);"></h4>
                </div>
              </div>
            </div>
          </div>

    <!-- Modal para OPERACION F3 EL id_tipo_operacion=1 es VENTA, id_tipo_operacion=2 es AJUSTE -->
          <div class="modal fade" id="exampleModalLongoperacion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLongTitle">OPERACION</h5>
                </div>
               <table id="example2" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>Descripcion</th>
                        <th>Precio de Venta</th>
                        <th>Cantidad contada</th>
                      </tr>
                    </thead>
                    <tbody>
<?php 
$listado=  mysql_query("select id_producto,descripcion,precio_compra,precio_venta,cantidad_existencia,stock_minimo,descto_salon,descto_mayorista from cproductos  where id_sucursal=$id_sucursal order by descripcion");

$fecha_hoy= date("Y-m-d");

                   while($reg=  mysql_fetch_array($listado))
                   {
                    $id_producto=mb_convert_encoding($reg['id_producto'], "UTF-8");
                    $descripcion=utf8_encode($reg['descripcion']);
                    $precio_compra=mb_convert_encoding($reg['precio_compra'], "UTF-8");
                    $precio_venta=mb_convert_encoding($reg['precio_venta'], "UTF-8");
                    $cantidad_existencia=mb_convert_encoding($reg['cantidad_existencia'], "UTF-8");
                    $stock_minimo=mb_convert_encoding($reg['stock_minimo'], "UTF-8");


          if($cantidad_existencia<$stock_minimo)
            {
          ?>
                      <tr>
                        <td><font color="red" style="font-weight:bolder;"><?php echo $descripcion; ?></font></td>
                        <td><font color="red" style="font-weight:bolder;"><?php echo $precio_venta; ?></font></td>
                        <th><input type="text" name="txtcantidadproductobuslis" id="txtcantidadproductobuslis" value="1" style="width: 50px;" onKeyPress='javascript:agregar_cantidad_producto_buscado_inventario(event,this.value,<?php echo $id_producto; ?>);'></th>
             </tr>
          <?php
            }
          else
            {
          ?>
                      <tr>
                        <td><?php echo $descripcion; ?></td>
                        <td><?php echo $precio_venta; ?></td>
                        <th><input type="text" name="txtcantidadproductobuslis" id="txtcantidadproductobuslis" value="1" style="width: 50px;" onKeyPress='javascript:agregar_cantidad_producto_buscado_inventario(event,this.value,<?php echo $id_producto; ?>);'></th>
            
<!--            <td><button type="button" class="btn btn-warning btn-fa-times"><i class="fa fa-times"></i></button></td>                                    
-->                      </tr>
          <?php
            } 
?>        
<?php
        }
?>            
                    </tbody>
                    <tfoot>
                      <tr>
                        <th>Descripcion</th>
                        <th>Precio de Venta</th>
                        <th>Cantidad contada</th>
                      </tr>
                    </tfoot>
                  </table>
              </div>
            </div>
          </div>

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
    <!-- page script -->

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

    
      $(function () {
        $("#example1").DataTable();
        $('#example2').DataTable({
          "paging": true,
          "lengthChange": false,
          "searching": true,
          "ordering": true,
          "info": true,
          "autoWidth": false
        });
      });


function mostrarmodal_operacion()
{
  $('#exampleModalLongoperacion').modal()
  $('#exampleModalLongoperacion').on('shown.bs.modal', function () {
          
          });
}


    </script>
</form> 
  </body>
</html>
