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
?>        
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Sistema de Inventario y Punto de Venta</title>

<!--<link rel="stylesheet" href="../css/ui-lightness/jquery-ui-1.10.3.custom.css" />
<link rel="stylesheet" href="../css/style.css" />
<link rel="stylesheet" href="jquery-ui.css" />
<script type="text/javascript" src="../js/operaciones.js"></script>
<script type="text/javascript" src="../js/shortcuts.js"></script>
<script src="../js/jquery-1.9.0.js"></script>
<script src="../js/jquery-ui.js"></script>
-->

<link rel="stylesheet" href="../css/ui-lightness/jquery-ui-1.10.3.custom.css" />
<link rel="stylesheet" href="../css/style.css" />
<link rel="stylesheet" href="../css/demo_table.css" />
<link rel="stylesheet" href="../css/bootstrap.css" media="all" />
<link rel="stylesheet" href="../css/bootstrap-responsive.css" media="all" />


<script type="text/javascript" src="../js/jquery.min.js"></script>
<script type="text/javascript" src="../js/bootstrap.js"></script>
<script type="text/javascript" src="../js/jquery-ui.js"></script>
<script type="text/javascript" src="../js/jquery-ui-1.10.3.custom.js"></script>
<script type="text/javascript" src="jslistabuscarproductos.js"></script>
<script type="text/javascript" src="../js/jquery.js"></script>
<script type="text/javascript" src="../js/jquery.dataTables.js"></script>
<script type="text/javascript" src="../js/operaciones.js"></script>


<!---------------Aqui termina------------------------------> 

<script>
  $(function(){
    var autocompletar = new Array();
    <?php //Esto es un poco de php para obtener lo que necesitamos
     for($p = 0;$p < count($arreglo_php); $p++){ //usamos count para saber cuantos elementos hay ?>
       autocompletar.push('<?php echo $arreglo_php[$p]; ?>');
     <?php } ?>
     $("#txtstrBuscar").autocomplete({ //Usamos el ID de la caja de texto donde lo queremos
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
<form id="frm_lista_productos_buscar" name="frm_lista_productos_buscar" action="" method="post"> 
  <input id="sel" type="hidden" value="-1">
  <input id="oper" name="oper" type="hidden" value=""> 
  <input type="hidden" id="txtnum_pag" name="txtnum_pag" value="" /> 
  <input id="txtfilepageserver" type="hidden" value=""/>    
  <input type="hidden" id="txtid_producto" name="txtid_producto" value="" /> 
  <input type="hidden" id="txtcantidad_producto" name="txtcantidad_producto" value="" />   
<table width="100%" cellpadding="0" cellspacing="0" align="center">
	<tr>
    	<td colspan="4" align="left" class="fondo_titulo_formularios">&nbsp;&nbsp;&nbsp;</td>
    </tr>
	<tr>
    	<td colspan="4" align="left" class="fondo_titulo_formularios">&nbsp;&nbsp;&nbsp;Buscador de Productos</td>
    </tr>
	<tr>
    	<td colspan="4" align="left" class="fondo_titulo_formularios">&nbsp;&nbsp;&nbsp;</td>
    </tr>
	<tr>
		<td colspan="4">&nbsp;</td>
	</tr>    
	<tr>
		<td align="left" colspan="4">
			&nbsp;&nbsp;
					<img src="../img/indicador_agotado.jpg" />&nbsp;&nbsp;&nbsp;<strong><span>PRODUCTO POR AGOTARSE</span></strong>

           <input type="button" id="btnbuscar" name="btnbuscar" value="Buscar" onclick="javascript:mostrar_lista_productos_inventario(document.getElementById('txtnum_pag').value);" style="display:none;" />
                    
<!--		  <button type="button" class="button-black" onclick="javascript:mostrar_lista_usuarios(document.getElementById('txtnum_pag').value);"><span onclick="javascript:mostrar_lista_usuarios(document.getElementById('txtnum_pag').value);">Buscar</span></button>
-->		</td>
	</tr>
	<tr>
		<td colspan="4">&nbsp;</td>
	</tr>     
    <tr>
    	<td colspan="5" align="center">
<?php 
$listado=  mysql_query("select id_producto,codigo_barras,descripcion,cantidad_existencia,precio_compra,precio_venta,stock_minimo,caducidad,dias_caducar from cproductos order by descripcion");
?>				
            <table cellpadding="0" cellspacing="0" border="0" class="display" id="tabla_lista_productos_buscar">
                <thead>
                    <tr>
						<th align="left">Codigo</th><!--Estado-->
                        <th align="left">Descripcion</th><!--Estado-->
                        <th align="left">Precio de Venta</th>
                        <th align="left">Existencia</th>
						<th align="left">Cantidad a vender</th>						
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
                               echo '<td><font color="red" style="font-weight:bolder;">'.mb_convert_encoding($reg['codigo_barras'], "UTF-8").'</font></td>';
                               echo '<td><font color="red" style="font-weight:bolder;">'.mb_convert_encoding($reg['descripcion'], "UTF-8").'</font></td>';
                               echo '<td><font color="red" style="font-weight:bolder;">'.mb_convert_encoding($reg['precio_venta'], "UTF-8").'</font></td>';
                               echo '<td><font color="red" style="font-weight:bolder;">'.mb_convert_encoding($reg['cantidad_existencia'], "UTF-8").'</font></td>';			
							   echo '<td><input type="text" id="txtcantidad" name="txtcantidad" value="1" style="width:30px;" onkeypress="javascript:guardar_producto_venta_buscado(event,this.value,'.mb_convert_encoding($reg['id_producto'], "UTF-8").');"></td>';					   
							   //echo '<td><a class="btn btn-success" onClick="javascript:editar_habitacion_cotizar('.mb_convert_encoding($reg['id_hab_cot'], "UTF-8").');">M</a></td>';							   
							   echo '</tr>';
						}
					else
						{
                               echo '<tr>';
                               echo '<td>'.mb_convert_encoding($reg['codigo_barras'], "UTF-8").'</font></td>';
                               echo '<td>'.mb_convert_encoding($reg['descripcion'], "UTF-8").'</font></td>';
                               echo '<td>'.mb_convert_encoding($reg['precio_venta'], "UTF-8").'</font></td>';
                               echo '<td>'.mb_convert_encoding($reg['cantidad_existencia'], "UTF-8").'</font></td>';
							   echo '<td><input type="text" id="txtcantidad" name="txtcantidad" value="1" style="width:30px;" onkeypress="javascript:guardar_producto_venta_buscado(event,this.value,'.mb_convert_encoding($reg['id_producto'], "UTF-8").');"></td>';					   							
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