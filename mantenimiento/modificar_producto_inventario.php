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

$idproductoinventario=$_GET["idproductoinventario"];
if($idproductoinventario>0)
{
$query = "select * from cproductos where id_producto=$idproductoinventario";
$result = mysql_query($query) or die("SQL Error 1: " . mysql_error());
// get data and store in a json array
while ($row = mysql_fetch_array($result)) 
{
$id_producto=utf8_encode($row[0]);
$id_proveedor=utf8_encode($row[1]);
$codigo_barras=utf8_encode($row[2]);
$descripcion=utf8_encode($row[3]);
$id_marca=utf8_encode($row[4]);
$cantidad_existencia=utf8_encode($row[5]);
$caducidad=utf8_encode($row[6]);
$precio_compra=utf8_encode($row[7]);
$precio_venta=utf8_encode($row[8]);
$stock_minimo=utf8_encode($row[9]);
$sotck_maximo=utf8_encode($row[10]);
$dias_caducar=utf8_encode($row[11]);
$anaquel=utf8_encode($row[12]);
$modulo=utf8_encode($row[13]);
$foto=utf8_encode($row[14]);
$unidad_medida=utf8_encode($row[15]);
$pasillo=utf8_encode($row[16]);
$fecha_actualizacion=utf8_encode($row[17]);
$estatus=utf8_encode($row[18]);
$id_tipo=utf8_encode($row[19]);
$id_categoria=utf8_encode($row[20]);
$id_departamento=utf8_encode($row[21]);
$id_ubicacion=utf8_encode($row[22]);
$id_unidad_compra=utf8_encode($row[23]);
$id_impuesto=utf8_encode($row[24]);
$costo_neto=utf8_encode($row[25]);
$lote=utf8_encode($row[26]);
$numero_serie=utf8_encode($row[27]);
$observaciones=utf8_encode($row[28]);
$impuesto_dinero=utf8_encode($row[29]);
$id_sucursal=utf8_encode($row[30]);
$descto_salon=utf8_encode($row[32]);
$descto_mayorista=utf8_encode($row[33]);
$porcentaje_ganancia=utf8_encode($row[35]);

}

/************* PARA EL SUCURSAL **************/
$querysb = "select * from csucursales where id_sucursal=$id_sucursal";
$resultsb = mysql_query($querysb) or die("SQL Error 1: " . mysql_error());
while ($rowsb = mysql_fetch_array($resultsb)) 
  {
    $id_sucursalb=utf8_encode($rowsb[0]);
    $descripcion_sucursalb=utf8_encode($rowsb[1]);
  }
/******************************************/

/************* PARA EL IMPUESTO **************/
$queryib = "select * from cimpuestos where id_impuesto=$id_impuesto";
$resultib = mysql_query($queryib) or die("SQL Error 1: " . mysql_error());
while ($rowib = mysql_fetch_array($resultib)) 
  {
    $id_impuestob=utf8_encode($rowib[0]);
    $nombre_impuestob=utf8_encode($rowib[1]);
  }
/******************************************/

/************* PARA LA UBICACION **************/
$queryub = "select * from cubicaciones where id_ubicacion=$id_ubicacion";
$resultub = mysql_query($queryub) or die("SQL Error 1: " . mysql_error());
while ($rowub = mysql_fetch_array($resultub)) 
  {
    $id_ubicacionb=utf8_encode($rowub[0]);
    $nombre_ubicacionb=utf8_encode($rowub[1]);
  }
/******************************************/

/************* PARA EL DEPARTAMENTO **************/
$querydb = "select * from cdepartamentos where id_departamento=$id_departamento";
$resultdb = mysql_query($querydb) or die("SQL Error 1: " . mysql_error());
while ($rowdb = mysql_fetch_array($resultdb)) 
  {
    $id_departamentob=utf8_encode($rowdb[0]);
    $desc_departamentob=utf8_encode($rowdb[1]);
  }
/******************************************/

/************* PARA LA UNIDAD DE COMPRA **************/
$queryucb = "select * from cunidadesmedida where id_unidad_medida=$id_unidad_compra";
$resultucb = mysql_query($queryucb) or die("SQL Error 1: " . mysql_error());
while ($rowucb = mysql_fetch_array($resultucb)) 
  {
    $id_unidad_compradab=utf8_encode($rowucb[0]);
    $nombre_unidad_compradab=utf8_encode($rowucb[1]);
  }
/******************************************/

/************* PARA LA UNIDAD DE MEDIDA **************/
$queryumb = "select * from cunidadesmedida where id_unidad_medida=$unidad_medida";
$resultumb = mysql_query($queryumb) or die("SQL Error 1: " . mysql_error());
while ($rowumb = mysql_fetch_array($resultumb)) 
  {
    $id_unidad_medidab=utf8_encode($rowumb[0]);
    $nombre_unidad_medidab=utf8_encode($rowumb[1]);
  }
/******************************************/

/******* PARA EL PROVEEDOR *****************/
$querypro = "select * from cproveedores where id_proveedor=$id_proveedor";
$resultpro = mysql_query($querypro) or die("SQL Error 1: " . mysql_error());
while ($rowpro = mysql_fetch_array($resultpro)) 
  {
    $id_proveedorb=utf8_encode($rowpro[0]);
    $nombre_empresab=utf8_encode($rowpro[2]);
  }
/******************************************/
/************* PARA LA MARCA **************/
$querymar = "select * from cmarcas where id_marca=$id_marca";
$resulmar = mysql_query($querymar) or die("SQL Error 1: " . mysql_error());
while ($rowmar = mysql_fetch_array($resulmar)) 
  {
    $id_marcab=utf8_encode($rowmar[0]);
    $descripcion_marcab=utf8_encode($rowmar[1]);
  }
/******************************************/

/************* PARA LA MARCA **************/
$querycat = "select * from ccategorias where id_categoria=$id_categoria";
$resulcat = mysql_query($querycat) or die("SQL Error 1: " . mysql_error());
while ($rowcat = mysql_fetch_array($resulcat)) 
  {
    $id_categoriab=utf8_encode($rowcat[0]);
    $descripcion_categoriab=utf8_encode($rowcat[1]);
  }
/******************************************/

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
<form id="frm_modificar_producto_inventario" name="frm_modificar_producto_inventario" action="" method="post"> 
  <input id="sel" type="hidden" value="-1">
  <input id="oper" name="oper" type="hidden" value=""> 
  <input type="hidden" id="txtnum_pag" name="txtnum_pag" value="" /> 
  <input id="txtfilepageserver" type="hidden" value=""/>    
  <input type="hidden" id="txtid_producto_inventario_modificar" name="txtid_producto_inventario_modificar" value="<?php echo $id_producto; ?>" />
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
            Modificar Producto
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
                        <input id="txtcodigo_barras" name="txtcodigo_barras" class="form-control input-lg" type="text" value="<?php echo $codigo_barras; ?>"><input type="button" id="btnocb" name="btnocb" value="Generar codigo de barras" onclick="javascript:obtener_codigo_barras();">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Descripcion</label>
                        <input id="txtdescripcion_producto" name="txtdescripcion_producto" class="form-control input-lg" type="text"  value="<?php echo $descripcion; ?>">
                    </div>
                    <div class="form-group">
                      <label>Categoria</label>
                      <select id="cmbcategoria" name="cmbcategoria" class="form-control">
                            <option selected="selected" value="<?php echo $id_categoriab; ?>"><?php echo $descripcion_categoriab; ?></option>
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
                            <option selected="selected" value="<?php echo $id_departamentob; ?>"><?php echo $desc_departamentob; ?></option>
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
                            <option selected="selected" value="<?php echo $id_ubicacionb; ?>"><?php echo $nombre_ubicacionb; ?></option>
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
                            <option selected="selected" value="<?php echo $id_unidad_medidab; ?>"><?php echo $nombre_unidad_medidab; ?></option>
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
                            <option selected="selected" value="<?php echo $id_unidad_compradab; ?>"><?php echo $nombre_unidad_compradab; ?></option>
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
			      <option selected="selected" value="<?php echo $id_proveedorb; ?>"><?php echo $nombre_empresab; ?></option>
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
			      <option selected="selected" value="<?php echo $id_marcab; ?>"><?php echo $descripcion_marcab; ?></option>
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
                        <input id="txtcantidad_existencia" name="txtcantidad_existencia" class="form-control input-lg" type="text" value="<?php echo $cantidad_existencia; ?>" onkeypress="return soloNumeros(event)" onblur="limpia()" >
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Stock minimo</label>
                        <input id="txtstock_minimo" name="txtstock_minimo" class="form-control input-lg" type="text" value="<?php echo $stock_minimo; ?>" onkeypress="return soloNumeros(event)" onblur="limpia()" >
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Stock maximo</label>
                        <input id="txtstock_maximo" name="txtstock_maximo" class="form-control input-lg" type="text" value="<?php echo $sotck_maximo; ?>" onkeypress="return soloNumeros(event)" onblur="limpia()" >
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Precio de compra</label>
                        <input id="txtprecio_compra" name="txtprecio_compra" class="form-control input-lg" type="text" value="<?php echo $precio_compra; ?>" onkeypress="return soloNumeros(event)" onblur="limpia()" >
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Porcentaje de ganancia</label>
                        <input id="txtporcentaje_ganancia" name="txtporcentaje_ganancia" class="form-control input-lg" type="number" placeholder="" onkeypress="return soloNumeros(event)" onchange="calcular_precio_venta_porcentaje_mod()" value="<?php echo $porcentaje_ganancia; ?>">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Precio de Venta</label>
                        <input id="txtprecio_venta" name="txtprecio_venta" class="form-control input-lg" type="text" value="<?php echo $precio_venta; ?>" onkeypress="return soloNumeros(event)" onblur="limpia()" >
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Lote</label>
                        <input id="txtlote" name="txtlote" class="form-control input-lg" type="text" value="<?php echo $lote; ?>">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Numero de serie</label>
                        <input id="txtnumero_serie" name="txtnumero_serie" class="form-control input-lg" type="text" value="<?php echo $numero_serie; ?>">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Fecha de caducidad</label>
                      <input type="text" id="datepicker1" name="datepicker1" value="<?php echo $caducidad; ?>" />
                      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Observaciones</label>
                        <input id="txtobservaciones" name="txtobservaciones" class="form-control input-lg" type="text" value="<?php echo $observaciones; ?>">
                    </div>
                  </div><!-- /.box-body -->
          <!--/form-->  


              </div><!-- /.box -->
            </div><!--/.col (left) -->
          </div>   <!-- /.row -->


                  <div class="box-footer">
                     <button type="button" class="btn btn-primary" onClick="javascript:modificar_datos_producto_inventario();">Guardar</button> 
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
