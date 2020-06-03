<?php
include("../php/conexion.php");
$connect = mysql_connect($hostname, $username, $password)
or die('Could not connect: ' . mysql_error());
//Select The database
$con = mysql_select_db($database, $connect);

$txtidproveedor=utf8_decode($_POST['txtidproveedor']);
$txtnumero_cuentabp=utf8_decode($_POST['txtnumero_cuentabp']);
$txtbancop=utf8_decode($_POST['txtbancop']);
$txtid_cuentabancariap=utf8_decode($_POST['txtid_cuentabancariap']);

$rscbp = mysql_query("SELECT id_cuenta_bancariap FROM tcuenta_bancariap where numero_cuenta=\"$txtnumero_cuentabp\" and banco=\"$txtbancop\" and id_proveedor=\"$txtidproveedor\"");
if ($rowcbp = mysql_fetch_row($rscbp)) {
$id_cuenta_bancariap = trim($rowcbp[0]);
}

$id_cuenta_bancariap=0;

if($id_cuenta_bancariap==0)
	{

	$sql= mysql_query("update tcuenta_bancariap set numero_cuenta=\"$txtnumero_cuentabp\",banco=\"$txtbancop\" where id_cuenta_bancariap=".$txtid_cuentabancariap."");

echo "Y";
//$cadena="update cmarcas set descripcion_marca=\"$txtdescripcion_marca\" where id_marca=".$txtid_marca."";
//echo $cadena;
	}
else
	{
		echo "E";
	}

?>




