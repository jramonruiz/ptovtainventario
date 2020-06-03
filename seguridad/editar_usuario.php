<?php
include("../php/conexion.php");
$connect = mysql_connect($hostname, $username, $password)
or die('Could not connect: ' . mysql_error());
//Select The database
$con = mysql_select_db($database, $connect);

$txtnombre_usuario=utf8_decode($_POST['txtnombre_usuario']);
$txtlogin_usuario=utf8_decode($_POST['txtlogin_usuario']);
$txtpassword_usuario=utf8_decode($_POST['txtpassword_usuario']);
$txtconfirmar_password_usuario=utf8_decode($_POST['txtconfirmar_password_usuario']);
$cmbactivo_usuario=utf8_decode($_POST['cmbactivo_usuario']);
$creacion=utf8_decode($_POST['datepicker1']);
$vencimiento=utf8_decode($_POST['datepicker2']);
$txtid_usuario_modificar=utf8_decode($_POST['txtid_usuario_modificar']);
$txtclave_desencriptada=utf8_decode($_POST['txtclave_desencriptada']);
/*$cmbtipo_usuario=utf8_decode($_POST['cmbtipo_usuario']);
$cmbcaja=utf8_decode($_POST['cmbcaja']);
$cmbsucursal=utf8_decode($_POST['cmbsucursal']);
$txtcomision=utf8_decode($_POST['txtcomision']);*/

//$sql= mysql_query("update cusuarios set login='".$txtlogin_usuario."',clave=MD5('".$txtpassword_usuario."'),activo=".$cmbactivo_usuario.",fecha_creacion='".$creacion."',fecha_vencimiento='".$vencimiento."',clave_desencriptada='".$txtpassword_usuario."' where id_usuario=".$txtid_usuario_modificar."");

$sql= mysql_query("update cusuarios set nombre_usuario=\"$txtnombre_usuario\",login=\"$txtlogin_usuario\",clave=MD5('".$txtpassword_usuario."'),activo=\"$cmbactivo_usuario\",fecha_creacion=\"$creacion\",fecha_vencimiento=\"$vencimiento\",clave_desencriptada=\"$txtpassword_usuario\" where id_usuario=".$txtid_usuario_modificar."");

//$cadena="update cusuarios set login='".$txtlogin_usuario."',clave=MD5('".$txtpassword_usuario."'),activo=".$cmbactivo_usuario.",fecha_creacion='".$creacion."',fecha_vencimiento='".$vencimiento."',clave_desencriptada='".$txtpassword_usuario."' where id_usuario=".$txtid_usuario_modificar."";
	
echo "Y";

?>




