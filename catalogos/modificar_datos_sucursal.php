<?php
include("../php/conexion.php");
$connect = mysql_connect($hostname, $username, $password)
or die('Could not connect: ' . mysql_error());
//Select The database
$con = mysql_select_db($database, $connect);

$txtid_sucursal_modificar=utf8_decode($_POST['txtid_sucursal_modificar']);
$txtdescripcion_sucursal=utf8_decode($_POST['txtdescripcion_sucursal']);
$txtcalle=utf8_decode($_POST['txtcalle']);
$txtnumero_exterior=utf8_decode($_POST['txtnumero_exterior']);
$txtnumero_interior=utf8_decode($_POST['txtnumero_interior']);
$txtcolonia=utf8_decode($_POST['txtcolonia']);
$txtcodigo_postal=utf8_decode($_POST['txtcodigo_postal']);
$txtpais=utf8_decode($_POST['txtpais']);
$txtestado=utf8_decode($_POST['txtestado']);
$txtmunicipio=utf8_decode($_POST['txtmunicipio']);
$txtciudad=utf8_decode($_POST['txtciudad']);
$txttelefono=utf8_decode($_POST['txttelefono']);
$txtcorreo=utf8_decode($_POST['txtcorreo']);

$sql= mysql_query("update csucursales set descripcion_sucursal=\"$txtdescripcion_sucursal\",calle=\"$txtcalle\",numero_exterior=\"$txtnumero_exterior\",numero_interior=\"$txtnumero_interior\",codigo_postal=\"$txtcodigo_postal\",colonia=\"$txtcolonia\",localidad=\"$txtciudad\",municipio=\"$txtmunicipio\",estado=\"$txtestado\",pais=\"$txtpais\",telefono=\"$txttelefono\",email=\"$txtcorreo\",fecha_actualizacion=CURDATE() where id_sucursal=".$txtid_sucursal_modificar."");


$cadena="update cclientes set nombre_cliente=\"$txtnombre_cliente\",direccion=\"$txtdireccion\",rfc=\"$txtrfc\",telefono=\"$txttelefono\",email=\"$txtcorreo\" where id_cliente=".$txtid_cliente_modificar."";
	
echo "Y";
//echo $cadena;

?>




