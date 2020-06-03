<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php
include("../php/conexion.php");
$connect = mysql_connect($hostname, $username, $password)
or die('Could not connect: ' . mysql_error());
//Select The database
$con = mysql_select_db($database, $connect);

$idproductoinventarioactualizar=$_GET["idproductoinventarioactualizar"];
if($idproductoinventarioactualizar>0)
{
$query = "select id_producto,descripcion,cantidad_existencia,cantidad_comprada,stock_minimo,stock_maximo from cproductos where id_producto=$idproductoinventarioactualizar";
$result = mysql_query($query) or die("SQL Error 1: " . mysql_error());
// get data and store in a json array
while ($row = mysql_fetch_array($result)) 
{
$id_producto=utf8_encode($row[0]);
$descripcion=$row[1];
$cantidad_existencia=utf8_encode($row[2]);
$cantidad_comprada=utf8_encode($row[3]);
$stock_minimo=utf8_encode($row[4]);
$stock_maximo=utf8_encode($row[5]);
}
}
?>        
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Sistema de Control de Habitaciones</title>
<link rel="stylesheet" href="../css/ui-lightness/jquery-ui-1.10.3.custom.css" />
<link rel="stylesheet" href="../css/style.css" />
<!--scripts de HOJAS DE ESTILO CSS para el calendario------------->
<link rel="stylesheet" href="jquery-ui.css" />
<!---------------Aqui termina------------------------------>


<script type="text/javascript" src="../js/operaciones.js"></script>

<!--scripts de JAVASCRIPT para el calendario------------->
<script src="../js/jquery-1.9.0.js"></script>
<script src="../js/jquery-ui.js"></script>
<script>
$(function() {
$( "#txtcaducidad" ).datepicker();
});
</script>
<script>
$(function() {
$( "#datepicker2" ).datepicker();
});
</script>
<!---------------Aqui termina------------------------------> 
  
<script src="../js/jquery-1.9.1.js" type="text/javascript"></script>
<script src="../js/jquery-ui-1.10.3.custom.js" type="text/javascript"></script> 

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
</head>

<body style="background:#f1f1f1;">
<form id="frm_modificar_existencia_producto" name="frm_modificar_existencia_producto" action="" method="post"> 
  <input id="sel" type="hidden" value="-1">
  <input id="oper" name="oper" type="hidden" value=""> 
  <input type="hidden" id="txtnum_pag" name="txtnum_pag" value="" /> 
  <input id="txtfilepageserver" type="hidden" value=""/>     
  <input type="hidden" id="txtid_producto_inventario_actualizar" name="txtid_producto_inventario_actualizar" value="<?php echo $id_producto; ?>" />
    <input type="hidden" id="cantidad_existencia" name="cantidad_existencia" value="<?php echo $cantidad_existencia; ?>" />
<table width="100%" cellpadding="0" cellspacing="0" align="center">
	<tr>
    	<td colspan="4" align="left" class="fondo_titulo_formularios">&nbsp;&nbsp;&nbsp;</td>
    </tr>
	<tr>
    	<td colspan="4" align="left" class="fondo_titulo_formularios">&nbsp;&nbsp;&nbsp;Actualizar inventario de productos</td>
    </tr>
	<tr>
    	<td colspan="4" align="left" class="fondo_titulo_formularios">&nbsp;&nbsp;&nbsp;</td>
    </tr>
	<tr>
		<td colspan="4">&nbsp;</td>
	</tr>  
	<tr>
		<td colspan="4">
                  <span class="letras_formulario">Descripcion:</span><input type="text" id="txtdescripcion_producto" name="txtdescripcion_producto" value="<?php echo $descripcion; ?>" style="width:500px;" />&nbsp;&nbsp;&nbsp; 
        </td>
	</tr>   
	<tr>
		<td colspan="4">&nbsp;</td>
	</tr> 
	<tr>
		<td colspan="4">
                  <span class="letras_formulario">Cantidad en Existencia:</span><input type="text" id="txtcantidad_existencia" name="txtcantidad_existencia" value="<?php echo $cantidad_existencia; ?>" disabled="disabled"/>&nbsp;&nbsp;&nbsp;
        </td>
    </tr>   
	<tr>
		<td colspan="4">&nbsp;</td>
	</tr> 
	<tr>
    	<td colspan="4">
        <span class="letras_formulario">Cantidad comprada:</span><input type="text" id="txtcantidad_comprada" name="txtcantidad_comprada" value="<?php echo $cantidad_comprada; ?>" />&nbsp;&nbsp;&nbsp;
		</td>
	</tr>   
	<tr>
		<td colspan="4">&nbsp;</td>
	</tr> 
	<tr>
		<td colspan="4" align="left">
        &nbsp;&nbsp;
        <input class="btn btnsave" name="submit" type="button" id="btnAceptar" style="top:0px; left: 250px; position: static; cursor:pointer;"  onclick="javascript:actualizar_datos_producto_inventario();"value="Modificar"/>
        <input type="button" id="btnmodificar" name="btnmodificar" value="Modificar" onclick="javascript:modificar_datos_producto_inventario();" style="display:none;" />
        <!--<button type="button" class="button-black" onclick="javascript:modificar_datos_proveedor();"><span onclick="javascript:modificar_datos_proveedor();">Modificar</span></button>-->&nbsp;&nbsp;&nbsp;
        <input class="btn btncancel" type="button" id="BtnCancelar" style=" top:0px; left: 85px; position: static; cursor:pointer;"  value="Cancelar" onClick="window.close();"/>
        <input type="button" id="btncancelar" name="btncancelar" value="Cancelar" onclick="window.close();" style="display:none;" />
        <!--<button type="button" class="button-black" onclick="window.close();"><span>Cancelar</span></button>-->&nbsp;&nbsp;&nbsp;</td>
        </td>
	</tr>  
	<tr>
		<td colspan="4">&nbsp;</td>
	</tr> 
</table>    
</form><br /><br />   
</body>
</html>