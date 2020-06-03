<?php
include("conexion.php");
$connect = mysql_connect($hostname, $username, $password)
or die('Could not connect: ' . mysql_error());
//Select The database
$con = mysql_select_db($database, $connect);

$txtlogin_usuario=utf8_decode($_POST['txtlogin_usuario']);
$txtpassword_usuario=utf8_decode($_POST['txtpassword_usuario']);
$txtconfirmar_password_usuario=utf8_decode($_POST['txtconfirmar_password_usuario']);
$datepicker1=utf8_decode($_POST['datepicker1']);
$datepicker2=utf8_decode($_POST['datepicker2']);
$cmbactivo_usuario=utf8_decode($_POST['cmbactivo_usuario']);
$txtnombre_usuario=utf8_decode($_POST['txtnombre_usuario']);
/*$cmbtipo_usuario=utf8_decode($_POST['cmbtipo_usuario']);
$cmbcaja=utf8_decode($_POST['cmbcaja']);
$cmbsucursal=utf8_decode($_POST['cmbsucursal']);
$txtcomision=utf8_decode($_POST['txtcomision']);*/


//$sql= mysql_query("insert into cusuarios(login,clave,activo,nombre_usuario,fecha_creacion,fecha_vencimiento,clave_desencriptada) VALUES ('".$txtlogin_usuario."',MD5('".$txtpassword_usuario."'),".$cmbactivo_usuario.",'".$txtnombre_usuario."','".$datepicker1."','".$datepicker2."','".$txtpassword_usuario."')");

$sql= mysql_query("insert into cusuarios(login,clave,activo,nombre_usuario,fecha_creacion,fecha_vencimiento,clave_desencriptada) VALUES (\"$txtlogin_usuario\",MD5('".$txtpassword_usuario."'),\"$cmbactivo_usuario\",\"$txtnombre_usuario\",\"$datepicker1\",\"$datepicker2\",\"$txtpassword_usuario\")");

$rs = mysql_query("SELECT MAX(id_usuario) AS id_ultimo_usuario FROM cusuarios");
if ($row = mysql_fetch_row($rs)) {
$id_ultimo_usuario = trim($row[0]);
}


// AGREGANDO  LA TABLA tmenu_usuario las opciones del menu SIN ACCESO

$listado=  mysql_query("select id_menu from tmenu_sistema");
                   while($reg=  mysql_fetch_array($listado))
                   {
                               $id_menu=mb_convert_encoding($reg['id_menu'], "UTF-8");

                               $sql2= mysql_query("insert into tmenu_usuario(id_menu,acceso,id_usuario) VALUES (\"$id_menu\",0,\"$id_ultimo_usuario\")");


                  }
                  
	
echo "Y";

?>




