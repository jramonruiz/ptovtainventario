<?php
error_reporting(0);
$paginterior=2;
include("../php/autentificacion.server.php");
?>
<form id="frm_reporte_compras" name="frm_reporte_compras" action="#" onSubmit="querys_ajax(this); return false;">
<div style="width:100%; height:540px; background:url(img/fondo_formulario.jpg) no-repeat; overflow:auto;">
<br /><br />
<table cellpadding="0" cellspacing="0" border="0" width="90%" align="center">
	<tr>
		<td align="left" class="tablatitulo">
			  <span class="LetrasLabelTitulo">&nbsp;&nbsp;&nbsp;REPORTE DE COMPRAS</span>
		</td>
	</tr>
	<tr>
		<td colspan="4" class="tablacontenido">&nbsp;</td>
	</tr>
	<tr>
		<td colspan="4" class="tablacontenido">
		<span class="LetrasLabelSubTitulo">&nbsp;&nbsp;&nbsp;Reporte con fecha de :</span>
		<input type="text" id="txtfecha_inicial" name="txtfecha_inicial" value="" disabled="disabled" /><img id="cal01" src="img/calendario.gif" style="width:20px; height:21px; cursor:pointer;" onClick="popUpCalendar(this,document.frm_reporte_compras.txtfecha_inicial,'yyyy-mm-dd');" />
<span class="LetrasLabelSubTitulo">&nbsp;&nbsp;&nbsp;a :</span>
		<input type="text" id="txtfecha_final" name="txtfecha_final" value="" disabled="disabled" /><img id="cal02" src="img/calendario.gif" style="width:20px; height:21px; cursor:pointer;" onClick="popUpCalendar(this,document.frm_reporte_compras.txtfecha_final,'yyyy-mm-dd');" />
		</td>
	</tr>
	<tr>
		<td colspan="4" class="tablacontenido">&nbsp;</td>
	</tr>
	<tr>
		<td colspan="4" align="center" class="tablacontenido">
		<input type="button" id="botonreporte" name="botonreporte" value="REPORTE" class="Botones" style="width:120px;" onclick="reporte_compras();" />
		</td>
	</tr>
	<tr>
		<td colspan="4" class="tablacontenido">&nbsp;</td>
	</tr>	
</table>
</div>
</form>