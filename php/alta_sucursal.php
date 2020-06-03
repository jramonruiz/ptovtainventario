<?php
include("conexion.php");
$connect = mysql_connect($hostname, $username, $password)
or die('Could not connect: ' . mysql_error());
//Select The database
$con = mysql_select_db($database, $connect);

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


$id_sucursal=0;

$rs = mysql_query("SELECT id_sucursal FROM csucursales where descripcion_sucursal=\"$txtdescripcion_sucursal\"");
if ($row = mysql_fetch_row($rs)) {
$id_sucursal = trim($row[0]);
}

if($id_sucursal==0)
	{
		$sql= mysql_query("insert into csucursales(descripcion_sucursal,calle,numero_exterior,numero_interior,codigo_postal,colonia,localidad,municipio,estado,pais,telefono,email,fecha_actualizacion) values(\"$txtdescripcion_sucursal\",\"$txtcalle\",\"$txtnumero_exterior\",\"$txtnumero_interior\",\"$txtcodigo_postal\",\"$txtcolonia\",\"$txtciudad\",\"$txtmunicipio\",\"$txtestado\",\"$txtpais\",\"$txttelefono\",\"$txtcorreo\",CURDATE())");
		echo "Y";
	}
else
	{
		echo "E";	
	}

?>




