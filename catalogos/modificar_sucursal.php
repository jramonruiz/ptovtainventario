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

$idsucursal=$_GET["idsucursal"];
if($idsucursal>0)
{
$query = "select * from csucursales where id_sucursal=$idsucursal";
$result = mysql_query($query) or die("SQL Error 1: " . mysql_error());
// get data and store in a json array
while ($row = mysql_fetch_array($result)) 
{
$id_sucursal=utf8_encode($row[0]);
$descripcion_sucursal=utf8_encode($row[1]);
$calle=utf8_encode($row[2]);
$numero_exterior=utf8_encode($row[3]);
$numero_interior=utf8_encode($row[4]);
$codigo_postal=utf8_encode($row[5]);
$colonia=utf8_encode($row[6]);
$localidad=utf8_encode($row[7]);
$municipio=utf8_encode($row[8]);
$estado=utf8_encode($row[9]);
$pais=utf8_encode($row[10]);
$telefono=utf8_encode($row[11]);
$email=utf8_encode($row[12]);
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
	
<script>
  $(function(){
    var autocompletar = new Array();
    <?php //Esto es un poco de php para obtener lo que necesitamos
     for($p = 0;$p < count($arreglo_php2); $p++){ //usamos count para saber cuantos elementos hay ?>
       autocompletar.push('<?php echo $arreglo_php2[$p]; ?>');
     <?php } ?>
     $("#txtestado").autocomplete({ //Usamos el ID de la caja de texto donde lo queremos
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
     $("#txtmunicipio").autocomplete({ //Usamos el ID de la caja de texto donde lo queremos
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
<form id="frm_modificar_sucursal" name="frm_modificar_sucursal" action="" method="post"> 
  <input id="sel" type="hidden" value="-1">
  <input id="oper" name="oper" type="hidden" value=""> 
  <input type="hidden" id="txtnum_pag" name="txtnum_pag" value="" /> 
  <input id="txtfilepageserver" type="hidden" value=""/>     
  <input type="hidden" id="txtid_sucursal_modificar" name="txtid_sucursal_modificar" value="<?php echo $id_sucursal; ?>" />
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
            Modificar Sucursal
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
                <!-- form start -->
                <form role="form">
                  <div class="box-body">

                    <div class="form-group">
                      <label for="exampleInputEmail1">Nombre de la sucursal</label>
                        <input id="txtdescripcion_sucursal" name="txtdescripcion_sucursal" class="form-control input-lg" type="text" value="<?php echo $descripcion_sucursal; ?>">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Calle</label>
                        <input id="txtcalle" name="txtcalle" class="form-control input-lg" type="text"  value="<?php echo $calle; ?>">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Numero Exterior</label>
                        <input id="txtnumero_exterior" name="txtnumero_exterior" class="form-control input-lg" type="text"  value="<?php echo $numero_exterior; ?>">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Numero Interior</label>
                        <input id="txtnumero_interior" name="txtnumero_interior" class="form-control input-lg" type="text" value="<?php echo $numero_interior; ?>">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Colonia</label>
                        <input id="txtcolonia" name="txtcolonia" class="form-control input-lg" type="text"  value="<?php echo $colonia; ?>">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Codigo Postal</label>
                        <input id="txtcodigo_postal" name="txtcodigo_postal" class="form-control input-lg" type="text"  value="<?php echo $codigo_postal; ?>">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Pais</label>
                        <input id="txtpais" name="txtpais" class="form-control input-lg" type="text"  value="<?php echo $pais; ?>">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Estado</label>
                      <input list="cestados" name="txtestado" id="txtestado" autocomplete="off" class="form-control"  value="<?php echo $estado; ?>">
                  <datalist id="cestados">
         <?php
                $consulta_catalogo1=mysql_query("select * from cestados");
        while($resultado_catalogo1=mysql_fetch_array($consulta_catalogo1))
        {
        ?> 
          <option value="<?php echo utf8_encode($resultado_catalogo1[nombre_estado]); ?>">        
                <?php 
        } 
        ?> 
     </datalist>
                    </div>  
                    <div class="form-group">
                      <label for="exampleInputEmail1">Delegacion o municipio</label>
                      <input list="cmunicipios" name="txtmunicipio" id="txtmunicipio" autocomplete="off" class="form-control"  value="<?php echo $municipio; ?>">
                  <datalist id="cmunicipios">
         <?php
                $consulta_catalogo2=mysql_query("select * from cmunicipios");
        while($resultado_catalogo2=mysql_fetch_array($consulta_catalogo2))
        {
        ?> 
          <option value="<?php echo utf8_encode($resultado_catalogo2[nombre_municipio]); ?>">       
                <?php 
        } 
        ?> 
     </datalist>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Ciudad o localidad</label>
                        <input id="txtciudad" name="txtciudad" class="form-control input-lg" type="text"  value="<?php echo $localidad; ?>">
                    </div>                    
                    <div class="form-group">
                      <label for="exampleInputEmail1">Telefono</label>
                        <input id="txttelefono" name="txttelefono" class="form-control input-lg" type="text"  value="<?php echo $telefono; ?>">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Email</label>
                        <input id="txtcorreo" name="txtcorreo" class="form-control input-lg" type="text"  value="<?php echo $email; ?>">
                    </div>



                  </div><!-- /.box-body -->

                  <div class="box-footer">
                    <button type="button" class="btn btn-primary" onClick="javascript:modificar_datos_sucursal();">Guardar</button>
<!--              <button type="button" class="btn btn-primary btn-block btn-flat" onClick="javascript:alta();">Acceso</button>-->
					
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
