<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php
include("../php/conexion.php");
$connect = mysql_connect($hostname, $username, $password)
or die('Could not connect: ' . mysql_error());
//Select The database
$con = mysql_select_db($database, $connect);

$sql = "select nombre_empresa from cproveedores order by nombre_empresa";
$res = mysql_query($sql);
$arreglo_php = array();
if(mysql_num_rows($res)==0)
   array_push($arreglo_php, "No hay datos");
else{
  while($palabras = mysql_fetch_array($res)){
    array_push($arreglo_php, $palabras["nombre_empresa"]);
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
<form id="frm_nuevo_proveedor" name="frm_nuevo_proveedor" action="" method="post"> 
  <input id="sel" type="hidden" value="-1">
  <input id="oper" name="oper" type="hidden" value=""> 
  <input type="hidden" id="txtnum_pag" name="txtnum_pag" value="" /> 
  <input id="txtfilepageserver" type="hidden" value=""/>     
  <input type="hidden" id="txtid_proveedor_eliminar" name="txtid_proveedor_eliminar" value="" />
<table width="100%" cellpadding="0" cellspacing="0" align="center">
	<tr>
    	<td colspan="3" align="left" class="fondo_titulo_formularios">&nbsp;&nbsp;&nbsp;</td>
    </tr>
	<tr>
    	<td colspan="3" align="left" class="fondo_titulo_formularios">&nbsp;&nbsp;&nbsp;Nuevo Proveedor</td>
    </tr>
	<tr>
    	<td colspan="3" align="left" class="fondo_titulo_formularios">&nbsp;&nbsp;&nbsp;</td>
    </tr>
	<tr>
		<td colspan="3">&nbsp;</td>
	</tr>  
	<tr>
	<td colspan="3" align="left" class="tablacontenido">
		<span class="letras_formulario">Nombre agente de venta:</span> <input type="text" id="txtnombre_agente" name="txtnombre_agente" value="" />
	</td>
	<tr>
		<td colspan="3">&nbsp;</td>
	</tr>    
	<tr>
	<td colspan="3" align="left" class="tablacontenido">
		<span class="letras_formulario">Nombre de la Empresa:</span> <input type="text" id="txtnombre_empresa" name="txtnombre_empresa" value="" />
	</td>
	<tr>
		<td colspan="3">&nbsp;</td>
	</tr>
	<tr>
	<td colspan="3" align="left" class="tablacontenido">
		<span class="letras_formulario">Telefono agente de venta:</span> <input type="text" id="txttelefono_agente" name="txttelefono_agente" value="" onkeypress="return soloNumeros(event)" onblur="limpia()"/>
	</td>
	<tr>
		<td colspan="3">&nbsp;</td>
	</tr>
	<tr>
	<td colspan="3" align="left" class="tablacontenido">
		<span class="letras_formulario">Correo:</span> <input type="text" id="txtcorreo_agente" name="txtcorreo_agente" value="" />
	</td>
	<tr>
		<td colspan="3">&nbsp;</td>
	</tr>    
	<tr>
		<td colspan="3" align="left">
        &nbsp;&nbsp;
        <input class="btn btnsave" name="submit" type="button" id="btnAceptar" style="top:0px; left: 250px; position: static; cursor:pointer;"  onclick="javascript:alta_proveedor();"value="Aceptar"/>
        <input type="button" id="btnaceptar" name="btnaceptar" value="Aceptar" onclick="javascript:alta_proveedor();"  style="display:none;"/>&nbsp;&nbsp;&nbsp;
        <input class="btn btncancel" type="button" id="BtnCancelar" style=" top:0px; left: 85px; position: static; cursor:pointer;"  value="Cancelar" onClick="window.close();"/>
        <input type="button" id="btncancelar" name="btncancelar" value="Cancelar" onclick="window.close();" style="display:none;" />&nbsp;&nbsp;&nbsp;</td>
        </td>
	</tr>  
	<tr>
		<td colspan="3">&nbsp;</td>
	</tr> 
</table>   
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
</script> 
</form><br /><br />   
</body>
</html>