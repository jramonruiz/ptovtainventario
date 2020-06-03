<?php
$tipusr="";
$paginterior=0;
include("../php/autentificacion.server.php");
session_name("lgsapplipweb");
session_start();
session_set_cookie_params(0, "/", $HTTP_SERVER_VARS["HTTP_HOST"], 0);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php
include("../php/conexion.php");
$connect = mysql_connect($hostname, $username, $password)
or die('Could not connect: ' . mysql_error());
//Select The database
$con = mysql_select_db($database, $connect);
//mysql_query("SET NAMES 'utf8'");

$sql = "select descripcion from cproductos order by descripcion";
$res = mysql_query($sql);
$arreglo_php = array();
if(mysql_num_rows($res)==0)
   array_push($arreglo_php, "No hay datos");
else{
  while($palabras = mysql_fetch_array($res)){
    array_push($arreglo_php, $palabras["descripcion"]);
  }
}

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

$id_usuario=$_SESSION["iduser"];
?>        
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Sistema de Inventario y Punto de Venta</title>

<link rel="stylesheet" href="../css/login.css" />
<link rel="stylesheet" href="../css/ui-lightness/jquery-ui-1.10.3.custom.css" />
<link rel="stylesheet" href="../css/style.css" />
<link type="text/css" href="../css/demo_table.css" rel="stylesheet" />
<link type="text/css" href="../css/bootstrap.css" rel="stylesheet" />

<link rel="stylesheet" href="../css/bootstrap.css" media="all">
<link rel="stylesheet" href="../css/bootstrap-responsive.css" media="all">		

<script type="text/javascript" src="../js/jquery.min.js"></script>
<script type="text/javascript" src="../js/bootstrap.js"></script>		
<script type="text/javascript" src="../js/jquery-ui.js"></script>
<script type="text/javascript" src="../js/jquery-ui-1.10.3.custom.js"></script>
<script type="text/javascript" src="jslistaproductosvendidos.js"></script>
<script type="text/javascript" src="../js/jquery.js"></script>
<script type="text/javascript" src="../js/jquery.dataTables.js"></script>
<script type="text/javascript" src="../js/operaciones.js"></script>
<script type="text/javascript" src="../js/shortcuts.js"></script>


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
  
<!--<script src="../js/jquery-1.9.1.js" type="text/javascript"></script>
<script src="../js/jquery-ui-1.10.3.custom.js" type="text/javascript"></script>--> 

<script>
  $(function(){
    var autocompletar = new Array();
    <?php //Esto es un poco de php para obtener lo que necesitamos
     for($p = 0;$p < count($arreglo_php); $p++){ //usamos count para saber cuantos elementos hay ?>
       autocompletar.push('<?php echo $arreglo_php[$p]; ?>');
     <?php } ?>
     $("#txtdescripcion_producto").autocomplete({ //Usamos el ID de la caja de texto donde lo queremos
       source: autocompletar //Le decimos que nuestra fuente es el arreglo
     });
  });
  
</script>

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


<script> 
function uno(src,color_entrada) { 
    src.bgColor=color_entrada;src.style.cursor="pointer"; 
} 
function dos(src,color_default) { 
    src.bgColor=color_default;src.style.cursor="default"; 
} 
</script> 

</head>

<body style="background:#f1f1f1;">
<form id="frm_listado_devoluciones" name="frm_listado_devoluciones" action="" method="post"> 
  <input id="sel" type="hidden" value="-1">
  <input id="oper" name="oper" type="hidden" value=""> 
  <input type="hidden" id="txtnum_pag" name="txtnum_pag" value="" /> 
  <input id="txtfilepageserver" type="hidden" value=""/>   
<table width="100%" cellpadding="0" cellspacing="0" align="center" border="0">
	<tr>
		<td colspan="5" align="left" class="fondo_titulo_formularios">
                  &nbsp;&nbsp;&nbsp;
        </td>
	</tr>
	<tr>
		<td colspan="1" align="left" class="fondo_titulo_formularios">
                  &nbsp;&nbsp;&nbsp; Listado de devoluciones
        </td>
		<td colspan="4" align="right" class="fondo_titulo_formularios">
<!--                 <button type="button" name="operacion" id="operacion" value="Guardar" class="btn btn-primary" onclick="javascript:guardar_venta();">Guardar Venta</button>	
						<button type="button" name="operacion" id="operacion" value="Guardar" class="btn btn-primary" onclick="javascript:buscar_producto_vender();">Buscar Producto</button>
-->						<img src="../img/listado.png" style="cursor:pointer;" onclick="javascript:cargar_listado_ventas();"/><span class="letras_menu">Listado de ventas</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        </td>		
	</tr>
	<tr>
		<td colspan="5" align="left" class="fondo_titulo_formularios">
                  &nbsp;&nbsp;&nbsp;
        </td>
	</tr>
	<tr>
		<td colspan="5" align="left">
                  &nbsp;&nbsp;&nbsp;
        </td>
	</tr>
    <tr>
    	<td colspan="5">
<?php 
//$listado=  mysql_query("select tv.id_venta,tv.folio_venta,tv.fecha_venta,tv.total_venta,cc.nombre_cliente,tv.vales_devolucion from tventas tv inner join cclientes cc on tv.id_cliente=cc.id_cliente inner join cusuarios cu on tv.id_usuario=cu.id_usuario where cu.id_sucursal=$id_sucursal order by tv.fecha_venta");
$listado=  mysql_query("select tv.id_venta,tv.folio_venta,tv.fecha_venta,tv.total_venta,cc.nombre_cliente,tv.vales_devolucion from tventas tv inner join cclientes cc on tv.id_cliente=cc.id_cliente inner join cusuarios cu on tv.id_usuario=cu.id_usuario where cu.id_sucursal=1 order by tv.fecha_venta");
?>		
            <table cellpadding="0" cellspacing="0" border="0" class="display" id="tabla_lista_productos_vendidos">
                <thead>
                    <tr>
                        <th align="left">Vales de Devolucion</th><!--Estado-->
                        <th align="left">Folio Venta</th><!--Estado-->
                        <th align="left">Fecha Venta</th>
                        <th align="left">Cliente</th><!--Estado-->
						<th align="left">Vista previa</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th></th>
                        <th></th>
                       
                     
                    </tr>
                </tfoot>
                  <tbody>
                  
                  
                    <?php
                   while($reg=  mysql_fetch_array($listado))
                   {
                               echo '<tr>';
                               echo '<td>'.mb_convert_encoding($reg['vales_devolucion'], "UTF-8").'</td>';
                               echo '<td >'.mb_convert_encoding($reg['folio_venta'], "UTF-8").'</td>';
                               echo '<td>'.mb_convert_encoding($reg['fecha_venta'], "UTF-8").'</td>';
                               echo '<td >'.mb_convert_encoding($reg['nombre_cliente'], "UTF-8").'</td>';
							   echo '<td><a class="btn btn-primary" onClick="javascript:vista_previa_vale_devolucion('.mb_convert_encoding($reg['id_producto_venta'], "UTF-8").');">VP</a></td>';							   
							   echo '</tr>';	
                    }
                    ?>
                <tbody>
            </table>
    <span id="spanresultdel" class="LabelResultados"  style="position:absolute; width:143px; left: 349px; top: 479px; height: 22px;"></span>	
        </td>
    </tr> 
	<tr>
		<td colspan="4">&nbsp;</td>
	</tr> 
	<tr>
		<td colspan="4">&nbsp;</td>
	</tr> 
	<tr>
		<td colspan="5" class="fondo_titulo_formularios">&nbsp;</td>
	</tr>         
	<tr>
		<td colspan="4">&nbsp;</td>
	</tr>         
</table>    
</form><br /><br />   
</body>
</html>