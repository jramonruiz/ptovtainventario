<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php
include("../php/conexion.php");
$connect = mysql_connect($hostname, $username, $password)
or die('Could not connect: ' . mysql_error());
//Select The database
$con = mysql_select_db($database, $connect);
?>        
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
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
$( "#datepicker1" ).datepicker();
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
     $("#buscar").autocomplete({ //Usamos el ID de la caja de texto donde lo queremos
       source: autocompletar //Le decimos que nuestra fuente es el arreglo
     });
  });
</script>
</head>

<body style="background:#f1f1f1;">
<form id="frm_corte_caja" name="frm_corte_caja" action="" method="post"> 
  <input id="sel" type="hidden" value="-1">
  <input id="oper" name="oper" type="hidden" value=""> 
  <input type="hidden" id="txtnum_pag" name="txtnum_pag" value="" /> 
  <input id="txtfilepageserver" type="hidden" value=""/>     
  <input type="hidden" id="txtnombre_formulario" name="txtnombre_formulario" value="frm_nuevo_usuario" />
<table width="100%" cellpadding="0" cellspacing="0" align="center">
	<tr>
    	<td colspan="3" align="left" class="fondo_titulo_formularios">&nbsp;&nbsp;&nbsp;</td>
    </tr>
	<tr>
    	<td colspan="3" align="left" class="fondo_titulo_formularios">&nbsp;&nbsp;&nbsp;Corte de Caja</td>
    </tr>
	<tr>
    	<td colspan="3" align="left" class="fondo_titulo_formularios">&nbsp;&nbsp;&nbsp;</td>
    </tr>
	<tr>
		<td colspan="3">&nbsp;</td>
	</tr>  
	<tr>
		<td colspan="3" align="left"><span class="letras_formulario">Fecha Inicial:</span><input type="text" id="datepicker1" name="datepicker1" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="letras_formulario">Fecha de Final:</span><input type="text" id="datepicker2" name="datepicker2" />
		</td>
	</tr>
		<tr>
		<td colspan="3">&nbsp;</td>
	</tr>
	<tr>
		<td colspan="3">&nbsp;</td>
	</tr>
	<tr>
		<td colspan="3" align="left">
        &nbsp;&nbsp;
        <input class="btn btnapply" name="submit" type="button" id="btnAceptar" style="top:0px; left: 250px; position: static; cursor:pointer;"  onclick="javascript:corte_caja();"value="Aceptar"/>
        <input type="button" id="btnaceptar" name="btnaceptar" value="Aceptar" onclick="javascript:corte_caja();"  style="display:none;"/>
        <!--<button type="button" class="button-black" onclick="javascript:alta_usuario();"><span onclick="javascript:alta_usuario();">Aceptar</span></button>-->&nbsp;&nbsp;&nbsp;
        <input class="btn btncancel" type="button" id="BtnCancelar" style=" top:0px; left: 85px; position: static; cursor:pointer;"  value="Cancelar" onClick="window.close();"/>
        <input type="button" id="btncancelar" name="btncancelar" value="Cancelar" onclick="window.close();" style="display:none;" />
        <!--<button type="button" class="button-black" onclick="window.close();"><span>Cancelar</span></button>-->&nbsp;&nbsp;&nbsp;</td>
        </td>
	</tr>  
	<tr>
		<td colspan="3">&nbsp;</td>
	</tr> 
</table>    
</form><br /><br />   
</body>
</html>