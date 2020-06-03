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
<form id="frm_alta_producto_inventario" name="frm_alta_producto_inventario" action="" method="post"> 
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
            Nuevo Producto
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
                <!--form role="form"-->
                  <div class="box-body">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Codigo barras</label>
                        <input id="txtcodigo_barras" name="txtcodigo_barras" class="form-control input-lg" type="text" placeholder=""><input type="button" id="btnocb" name="btnocb" value="Generar codigo de barras" onclick="javascript:obtener_codigo_barras();">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Descripcion</label>
                        <input id="txtdescripcion_producto" name="txtdescripcion_producto" class="form-control input-lg" type="text" placeholder="">
                    </div>
                    <div class="form-group">
                      <label>Categoria</label>
                      <select id="cmbcategoria" name="cmbcategoria" class="form-control">
                            <option value="0">[Seleccione]</option>
                                     <?php
                          $queryc = "select * from ccategorias";
                          $resultc = mysql_query($queryc) or die("SQL Error 1: " . mysql_error());
                          // get data and store in a json array
                          while ($rowc = mysql_fetch_array($resultc)) 
                          {
                          $id_categoria=utf8_encode($rowc[0]);
                          $desc_categoria=utf8_encode($rowc[1]);
                          ?>
                                    <option value="<?php echo $id_categoria; ?>"><?php echo $desc_categoria; ?></option>
                                    <?php
                          }
                        ?>                                    
                      </select>
                    </div>
                    <div class="form-group">
                      <label>Departamento</label>
                      <select id="cmbdepartamento" name="cmbdepartamento" class="form-control">
                            <option value="0">[Seleccione]</option>
                                     <?php
                          $queryd = "select * from cdepartamentos";
                          $resultd = mysql_query($queryd) or die("SQL Error 1: " . mysql_error());
                          // get data and store in a json array
                          while ($rowd = mysql_fetch_array($resultd)) 
                          {
                          $id_departamento=utf8_encode($rowd[0]);
                          $desc_departamento=utf8_encode($rowd[1]);
                          ?>
                                    <option value="<?php echo $id_departamento; ?>"><?php echo $desc_departamento; ?></option>
                                    <?php
                          }
                        ?>                                    
                      </select>
                    </div>
                    <div class="form-group">
                      <label>Ubicacion</label>
                      <select id="cmbubicacion" name="cmbubicacion" class="form-control">
                            <option value="0">[Seleccione]</option>
                                     <?php
                          $queryu = "select * from cubicaciones";
                          $resultu = mysql_query($queryu) or die("SQL Error 1: " . mysql_error());
                          // get data and store in a json array
                          while ($rowu = mysql_fetch_array($resultu)) 
                          {
                          $id_ubicacion=utf8_encode($rowu[0]);
                          $nombre_ubicacion=utf8_encode($rowu[1]);
                          ?>
                                    <option value="<?php echo $id_ubicacion; ?>"><?php echo $nombre_ubicacion; ?></option>
                                    <?php
                          }
                        ?>                                    
                      </select>
                    </div>
                    <div class="form-group">
                      <label>Unidad de medida</label>
                      <select id="cmbunidadmedida" name="cmbunidadmedida" class="form-control">
                            <option value="0">[Seleccione]</option>
                                     <?php
                          $queryum = "select * from cunidadesmedida";
                          $resultum = mysql_query($queryum) or die("SQL Error 1: " . mysql_error());
                          // get data and store in a json array
                          while ($rowum = mysql_fetch_array($resultum)) 
                          {
                          $id_unidad_medida=utf8_encode($rowum[0]);
                          $nombre_unidad_medida=utf8_encode($rowum[1]);
                          ?>
                                    <option value="<?php echo $id_unidad_medida; ?>"><?php echo $nombre_unidad_medida; ?></option>
                                    <?php
                          }
                        ?>                                    
                      </select>
                    </div>
                    <div class="form-group">
                      <label>Unidad de compra</label>
                      <select id="cmbunidadcompra" name="cmbunidadcompra" class="form-control">
                            <option value="0">[Seleccione]</option>
                                     <?php
                          $queryuc = "select * from cunidadesmedida";
                          $resultuc = mysql_query($queryuc) or die("SQL Error 1: " . mysql_error());
                          // get data and store in a json array
                          while ($rowuc = mysql_fetch_array($resultuc)) 
                          {
                          $id_unidad_medida=utf8_encode($rowuc[0]);
                          $nombre_unidad_medida=utf8_encode($rowuc[1]);
                          ?>
                                    <option value="<?php echo $id_unidad_medida; ?>"><?php echo $nombre_unidad_medida; ?></option>
                                    <?php
                          }
                        ?>                                    
                      </select>
                    </div>
                    <div class="form-group">
                      <label>Proveedor</label>
                      <select id="cmbproveedor" name="cmbproveedor" class="form-control">
			      <option value="0">[Seleccione]</option>
                     <?php
					$query = "select * from cproveedores";
					$result = mysql_query($query) or die("SQL Error 1: " . mysql_error());
					// get data and store in a json array
					while ($row = mysql_fetch_array($result)) 
					{
					$id_proveedor=utf8_encode($row[0]);
					$nombre_empresa=utf8_encode($row[2]);
					?>
                    <option value="<?php echo $id_proveedor; ?>"><?php echo $nombre_empresa; ?></option>
                    <?php
					}
				?>                                    
                      </select>
                    </div>
                    <div class="form-group">
                      <label>Marca</label>
                      <select id="cmbmarca" name="cmbmarca" class="form-control">
			      <option value="0">[Seleccione]</option>
                     <?php
					$query = "select * from cmarcas";
					$result = mysql_query($query) or die("SQL Error 1: " . mysql_error());
					// get data and store in a json array
					while ($row = mysql_fetch_array($result)) 
					{
					$id_marca=utf8_encode($row[0]);
					$descripcion_marca=utf8_encode($row[1]);
					?>
                    <option value="<?php echo $id_marca; ?>"><?php echo $descripcion_marca; ?></option>
                    <?php
					}
				?>                                    
                      </select>
                    </div>
                  </div><!-- /.box-body -->
				  <!--/form-->	


              </div><!-- /.box -->
            </div><!--/.col (left) -->
          </div>   <!-- /.row -->

          <div class="row">
            <!-- left column -->
            <div class="col-md-12">
              <!-- general form elements -->
              <div class="box box-primary">
              <div class="box-header with-border">
                  <h3 class="box-title">PRECIO E INVENTARIO</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <!--form role="form"-->
                  <div class="box-body">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Cantidad en existencia</label>
                        <input id="txtcantidad_existencia" name="txtcantidad_existencia" class="form-control input-lg" type="text" placeholder="" onkeypress="return soloNumeros(event)" onblur="limpia()" >
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Stock minimo</label>
                        <input id="txtstock_minimo" name="txtstock_minimo" class="form-control input-lg" type="text" placeholder="" onkeypress="return soloNumeros(event)" onblur="limpia()" >
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Stock maximo</label>
                        <input id="txtstock_maximo" name="txtstock_maximo" class="form-control input-lg" type="text" placeholder="" onkeypress="return soloNumeros(event)" onblur="limpia()" >
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Precio de compra</label>
                        <input id="txtprecio_compra" name="txtprecio_compra" class="form-control input-lg" type="text" placeholder="" onkeypress="return soloNumeros(event)" onblur="limpia()" >
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Porcentaje de ganancia</label>
                        <input id="txtporcentaje_ganancia" name="txtporcentaje_ganancia" class="form-control input-lg" type="number" placeholder="" onkeypress="return soloNumeros(event)" onchange="calcular_precio_venta_porcentaje()" value="1">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Precio de Venta</label>
                        <input id="txtprecio_venta" name="txtprecio_venta" class="form-control input-lg" type="text" placeholder="" onkeypress="return soloNumeros(event)" onblur="limpia()">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Lote</label>
                        <input id="txtlote" name="txtlote" class="form-control input-lg" type="text" placeholder="">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Numero de serie</label>
                        <input id="txtnumero_serie" name="txtnumero_serie" class="form-control input-lg" type="text" placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Fecha de caducidad</label>
                      <input type="text" id="datepicker1" name="datepicker1" />
                      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Observaciones</label>
                        <input id="txtobservaciones" name="txtobservaciones" class="form-control input-lg" type="text" placeholder="">
                    </div>
                    
                  </div><!-- /.box-body -->
          <!--/form-->  


              </div><!-- /.box -->
            </div><!--/.col (left) -->
          </div>   <!-- /.row -->


                  <div class="box-footer">
                     <button type="button" class="btn btn-primary" onClick="javascript:agregar_producto_inventario();">Guardar</button> 
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
    <script type="text/javascript">
     function obtener_codigo_barras() 
     {
      var hoy = new Date();
      var dd = hoy.getDate();
      var mm = hoy.getMonth()+1;
      var yyyy = hoy.getFullYear();
      var fecha_actual=dd+''+mm+''+yyyy;
      var horahoy=new Date();
      var cad=horahoy.getHours()+":"+horahoy.getMinutes()+":"+horahoy.getSeconds();
      var hora=horahoy.getHours();
      var minuto=horahoy.getMinutes();
      var segundo=horahoy.getSeconds();
      var nvocodigobarras=fecha_actual+''+hora+''+minuto+''+segundo;
      //alert(fecha_actual);
      //alert(cad);
      //alert(nvocodigobarras);
      document.getElementById("txtcodigo_barras").value=nvocodigobarras;
     }

    </script>
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
