<?php  
$conexion = mysql_connect("localhost", "root", "");
mysql_select_db("sic", $conexion);

$sql = "SELECT * FROM tusuarios WHERE Login = 'PAOLA'";
$q = mysql_query($sql);
$r = mysql_fetch_object($q);


$fecha_inscripto = $r->FechaInicio;
$dia=date("j"); 
$mes=date("n");
$anno=date("Y"); //descomponer fecha

$dia_insc=substr($fecha_inscripto, 8, 2);
$mes_insc=substr($fecha_inscripto, 5, 2);
$anno_insc=substr($fecha_inscripto, 0, 4);

echo $dia_insc."---";
echo $mes_insc."---";
echo $anno_insc."---";

$fecha_vcto = $r->FechaTermino;
$dia_v=date("j");
$mes_v=date("n");
$anno_v=date("Y"); //descomponer fecha
$dia_venc=substr($fecha_vcto, 8, 2);
$mes_venc=substr($fecha_vcto, 5, 2);
$anno_venc=substr($fecha_vcto, 0, 4);

echo $dia_venc;
echo $mes_venc;
echo $anno_venc;

?>