<?php
include("conexion.php");
$connect = mysql_connect($hostname, $username, $password)
or die('Could not connect: ' . mysql_error());
//Select The database
$con = mysql_select_db($database, $connect);
//mysql_query("SET NAMES 'utf8'");

$txtdesc_departamento=utf8_decode($_POST['txtdesc_departamento']);

$id_departamento=0;

$rs = mysql_query("SELECT id_departamento FROM cdepartamentos where desc_departamento=\"$txtdesc_departamento\"");
if ($row = mysql_fetch_row($rs)) {
$id_departamento = trim($row[0]);
}

if($id_departamento==0)
	{
$sql= mysql_query("insert into cdepartamentos(desc_departamento,fecha_actualizacion) VALUES (\"$txtdesc_departamento\",CURDATE())");
	echo "E";
	}
else
	{
	echo "Y";
	}
?>