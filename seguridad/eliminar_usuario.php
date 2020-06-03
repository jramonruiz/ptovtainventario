<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php
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
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Sistema de Control de Habitaciones</title>

<script type="text/javascript" src="../js/operaciones.js"></script>

<link rel="stylesheet" href="../css/ui-lightness/jquery-ui-1.10.3.custom.css" />
<link rel="stylesheet" href="../css/style.css" />
<!--scripts de HOJAS DE ESTILO CSS para el calendario------------->
<link rel="stylesheet" href="jquery-ui.css" />
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

<body>
<form id="frm_eliminar_usuario" name="frm_eliminar_usuario" action="" method="post"> 
  <input id="sel" type="hidden" value="-1">
  <input id="oper" name="oper" type="hidden" value=""> 
  <input type="hidden" id="txtnum_pag" name="txtnum_pag" value="" /> 
  <input id="txtfilepageserver" type="hidden" value=""/>     
  <input type="hidden" id="txtid_usuario_eliminar" name="txtid_usuario_eliminar" value="" />
<table width="100%" cellpadding="0" cellspacing="0" align="center">
	<tr>
    	<td colspan="3" align="left"><span class="letras_formularios_titulo">Eliminar Usuario</span></td>
    </tr>
	<tr>
		<td colspan="3">&nbsp;</td>
	</tr>  
	<tr>
	<td colspan="3" align="left" class="tablacontenido">
		<span class="letras_formulario">Nombre del usuario a buscar:</span><input type="text" id="buscar" name="buscar" style="width:300px;" />&nbsp;&nbsp;<input type="button" id="btnbuscar" name="btnbuscar" value="Buscar" onclick="javascript:buscar_usuario_eliminar();" />
        
<!--        <button type="button" class="button-black" onclick="javascript:buscar_usuario_eliminar();"><span onclick="javascript:buscar_usuario_eliminar();">Buscar</span></button>
-->	</td>
	<tr>
		<td colspan="3">&nbsp;</td>
	</tr>    
	<tr>
	<td colspan="3" align="left" class="tablacontenido">
		<span class="letras_formulario">Login:</span> <input type="text" id="txtlogin_usuario" name="txtlogin_usuario" value="" disabled="disabled"/>
	</td>
	<tr>
		<td colspan="3">&nbsp;</td>
	</tr>
	<tr>
		<td colspan="3" align="left" class="tablacontenido"><span class="letras_formulario">Password:</span> <input type="password" id="txtpassword_usuario" name="txtpassword_usuario" value="" disabled="disabled" />
		</td>
	</tr>
	<tr>
		<td colspan="3">&nbsp;</td>
	</tr>
	<tr>
		<td colspan="3" align="left" class="tablacontenido"><span class="letras_formulario">Confirmar Password:</span> <input type="password" id="txtconfirmar_password_usuario" name="txtconfirmar_password_usuario" value="" disabled="disabled" /></td>
	</tr>
	<tr>
		<td colspan="3">&nbsp;</td>
	</tr>
	<tr>
		<td colspan="2" align="left" class="tablacontenido"><span class="letras_formulario">Fecha de creacion:</span><input type="text" id="txtcreacion" name="txtcreacion" disabled="disabled" />
		</td>
	</tr>
		<tr>
		<td colspan="3">&nbsp;</td>
	</tr>
	<tr>
		<td colspan="3" align="left" class="tablacontenido"><span class="letras_formulario">Fecha de vencimiento:</span><input type="text" id="txtvencimiento" name="txtvencimiento" disabled="disabled" />
		</td>
	</tr>
	<tr>
		<td colspan="3">&nbsp;</td>
	<tr>
		<td colspan="3" align="left" class="tablacontenido">
			<span class="letras_formulario">Activo:</span>
			<input type="text" id="txtactivo" name="txtactivo" value="" disabled="disabled" />
		</td>
	</tr>        
	<tr>
		<td colspan="3">&nbsp;</td>
	</tr>
	<tr>
		<td colspan="3" align="left">
        &nbsp;&nbsp;<input type="button" id="btneliminar" name="btneliminar" value="Eliminar" onclick="javascript:eliminar_usuario();" />
        <!--<button type="button" class="button-black" onclick="javascript:eliminar_usuario();"><span onclick="javascript:eliminar_usuario();">Eliminar</span></button>-->&nbsp;&nbsp;&nbsp;<input type="button" id="btncancelar" name="btncancelar" value="Cancelar" onclick="window.close();" />
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