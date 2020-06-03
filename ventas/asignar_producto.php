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

$id_usuario=$_SESSION["iduser"];
$id_habitacion=$_GET["id_hab"];
$query = "select * from vhabitacion_tipo where id_habitacion=$id_habitacion";
$result = mysql_query($query) or die("SQL Error 1: " . mysql_error());
// get data and store in a json array
while ($row = mysql_fetch_array($result)) 
{
$id_habitacion=utf8_encode($row[0]);
$numero_habitacion=utf8_encode($row[1]);
$tipo_habitacion=utf8_encode($row[2]);
$precio=utf8_encode($row[3]);
$descripcion_sucursal=utf8_encode($row[5]);
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

<body>
<form id="frm_asignar_habitacion" name="frm_asignar_habitacion" action="" method="post"> 
  <input id="sel" type="hidden" value="-1">
  <input id="oper" name="oper" type="hidden" value=""> 
  <input type="hidden" id="txtid_usuario" name="txtid_usuario" value="<?php echo $id_usuario; ?>" /> 
  <input type="hidden" id="txtid_habitacion" name="txtid_habitacion" value="<?php echo $id_habitacion; ?>" /> 
  <input id="txtfilepageserver" type="hidden" value=""/>     
<table width="100%" cellpadding="0" cellspacing="0" align="center">
	<tr>
    	<td colspan="3" align="left"><span class="letras_formularios_titulo">Asignar Habitacion</span></td>
    </tr>
	<tr>
		<td colspan="3">&nbsp;</td>
	</tr>  
	<tr>
	<td colspan="3" align="left" class="tablacontenido">
		<span class="letras_formulario">Numero de Habitacion:</span> <input type="text" id="txtnumero_habitacion" name="txtnumero_habitacion" value="<?php echo $numero_habitacion; ?>" disabled="disabled" />
	</td>
	<tr>
		<td colspan="3">&nbsp;</td>
	</tr>    
	<tr>
	<td colspan="3" align="left" class="tablacontenido">
		<span class="letras_formulario">Tipo:</span> <input type="text" id="txttipo_habitacion" name="txttipo_habitacion" value="<?php echo $tipo_habitacion; ?>" disabled="disabled" />
	</td>
	<tr>
		<td colspan="3">&nbsp;</td>
	</tr>
	<tr>
		<td colspan="3" align="left" class="tablacontenido"><span class="letras_formulario">Precio:</span> <input type="text" id="txtprecio_habitacion" name="txtprecio_habitacion" value="<?php echo $precio; ?>" disabled="disabled" />
		</td>
	</tr>
	<tr>
		<td colspan="3">&nbsp;</td>
	</tr>
	<tr>
		<td colspan="3" align="left" class="tablacontenido"><span class="letras_formulario">Sucursal:</span> <input type="text" id="txtsucursal" name="txtsucursal" value="<?php echo $descripcion_sucursal; ?>" disabled="disabled" /></td>
	</tr>
	<tr>
		<td colspan="3">&nbsp;</td>
	</tr>
	<tr>
		<td colspan="2" align="left" class="tablacontenido"><span class="letras_formulario">Fecha de Entrada:</span><input type="text" id="datepicker1" name="datepicker1" />
		</td>
	</tr>
		<tr>
		<td colspan="3">&nbsp;</td>
	</tr>
	<tr>
		<td colspan="3" align="left" class="tablacontenido"><span class="letras_formulario">Fecha de Salida:</span><input type="text" id="datepicker2" name="datepicker2" />
		</td>
	</tr>
	<tr>
		<td colspan="3">&nbsp;</td>
	<tr>
		<td colspan="3" align="left">
        &nbsp;&nbsp;<button type="button" class="button-black" onclick="javascript:asignar_habitacion_hospedaje();"><span onclick="javascript:asignar_habitacion_hospedaje();">Asignar</span></button>&nbsp;&nbsp;&nbsp;<button type="button" class="button-black" onclick="window.close();"><span>Cancelar</span></button>&nbsp;&nbsp;&nbsp;</td>
        </td>
	</tr>  
	<tr>
		<td colspan="3">&nbsp;</td>
	</tr> 
</table>    
</form><br /><br />   
</body>
</html>