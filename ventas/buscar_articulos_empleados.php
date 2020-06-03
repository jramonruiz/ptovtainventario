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

$id_usuario=$_SESSION["iduser"];
?>        
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Sistema de Inventario y Punto de Venta</title>

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
<script type="text/javascript" src="jsbuscararticulosempleados.js"></script>
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
function uno(src,color_entrada) { 
    src.bgColor=color_entrada;src.style.cursor="pointer"; 
} 
function dos(src,color_default) { 
    src.bgColor=color_default;src.style.cursor="default"; 
} 
</script> 

</head>

<body>
<form id="frm_buscar_articulos_empleados" name="frm_buscar_articulos_empleados" action="" method="post"> 
  <input id="sel" type="hidden" value="-1">
  <input id="oper" name="oper" type="hidden" value=""> 
  <input type="hidden" id="txtnum_pag" name="txtnum_pag" value="" /> 
  <input id="txtfilepageserver" type="hidden" value=""/>   
<input type="hidden" id="txtid_producto_buscar" name="txtid_producto_buscar" value="" /> 
<input type="hidden" id="txtcantidad_existencia_producto_buscar" name="txtcantidad_existencia_producto_buscar" value="" />
<input type="hidden" id="cambio_venta" name="cambio_venta" value="" />
<table width="98%" cellpadding="0" cellspacing="0" align="center" border="0" bgcolor="#bddbff">
	<tr>
		<td colspan="4">&nbsp;</td>
	</tr> 
	<tr>
		<td colspan="4">&nbsp;</td>
	</tr> 		
	<tr>
    	<td colspan="4" align="center" class="celda_titulo_formulario">&nbsp;&nbsp;&nbsp;<span class="letras_formularios_titulo">BUSQUEDA DE PRODUCTOS</span></td>
    </tr>
	<tr>
		<td colspan="4">&nbsp;</td>
	</tr>    
	<tr>
		<td align="left" colspan="5">
<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="../img/indicador_agotado.jpg" />&nbsp;&nbsp;&nbsp;<strong><span>PRODUCTO POR AGOTARSE</span></strong>			
		</td>
	</tr>
	<tr>
		<td colspan="4">&nbsp;</td>
	</tr> 	
    <tr>
    	<td colspan="5">
<?php 
$listado=  mysql_query("select id_producto,descripcion,cantidad_existencia,stock_minimo,anaquel,modulo from cproductos order by id_producto");
?>		
            <table cellpadding="0" cellspacing="0" border="0" class="display" id="tabla_lista_buscar_articulos_empleados">
                <thead>
                    <tr>
                        <th>Descripcion</th><!--Estado-->
                        <th>Existencia</th><!--Estado-->
                        <th>Stock Minimo</th>                                               
                        <th>Anaquel</th>                                               
                        <th>Modulo</th>                                               												
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
   					$cantidad_existencia=mb_convert_encoding($reg['cantidad_existencia'], "UTF-8");
					$stock_minimo=mb_convert_encoding($reg['stock_minimo'], "UTF-8");					
					
					if($cantidad_existencia<$stock_minimo)
						{
                               echo '<tr>';
                               echo '<td><font color="red" style="font-weight:bolder;">'.mb_convert_encoding($reg['descripcion'], "UTF-8").'</font></td>';
                               echo '<td><font color="red" style="font-weight:bolder;">'.mb_convert_encoding($reg['cantidad_existencia'], "UTF-8").'</font></td>';
                               echo '<td><font color="red" style="font-weight:bolder;">'.mb_convert_encoding($reg['stock_minimo'], "UTF-8").'</font></td>';
                               echo '<td><font color="red" style="font-weight:bolder;">'.mb_convert_encoding($reg['anaquel'], "UTF-8").'</font></td>';
                               echo '<td><font color="red" style="font-weight:bolder;">'.mb_convert_encoding($reg['modulo'], "UTF-8").'</font></td>';							   
							   //echo '<td><a class="btn btn-success" onClick="javascript:editar_habitacion_cotizar('.mb_convert_encoding($reg['id_hab_cot'], "UTF-8").');">M</a></td>';					   
							   echo '</tr>';
						}
					else
						{
                               echo '<tr>';
                               echo '<td>'.mb_convert_encoding($reg['descripcion'], "UTF-8").'</td>';
                               echo '<td >'.mb_convert_encoding($reg['cantidad_existencia'], "UTF-8").'</td>';
                               echo '<td>'.mb_convert_encoding($reg['stock_minimo'], "UTF-8").'</td>';
                               echo '<td >'.mb_convert_encoding($reg['anaquel'], "UTF-8").'</td>';
                               echo '<td>'.mb_convert_encoding($reg['modulo'], "UTF-8").'</td>';							   
							   //echo '<td><a class="btn btn-success" onClick="javascript:editar_habitacion_cotizar('.mb_convert_encoding($reg['id_hab_cot'], "UTF-8").');">M</a></td>';	
							   echo '</tr>';
						}	
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
</table>    
</form><br /><br />   
</body>
</html>