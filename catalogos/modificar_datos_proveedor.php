<?php
include("../php/conexion.php");
$connect = mysql_connect($hostname, $username, $password)
or die('Could not connect: ' . mysql_error());
//Select The database
$con = mysql_select_db($database, $connect);

$txtid_proveedor_modificar=utf8_decode($_POST['txtid_proveedor_modificar']);
$txtnombre_empresa=utf8_decode($_POST['txtnombre_empresa']);
$txtrfc_empresa=utf8_decode($_POST['txtrfc_empresa']);
$txtnombre_comercial=utf8_decode($_POST['txtnombre_comercial']);
$txtcalle=utf8_decode($_POST['txtcalle']);
$txtcolonia=utf8_decode($_POST['txtcolonia']);
$txtcodigo_postal=utf8_decode($_POST['txtcodigo_postal']);
$txtpais=utf8_decode($_POST['txtpais']);
$txtestado=utf8_decode($_POST['txtestado']);
$txtmunicipio=utf8_decode($_POST['txtmunicipio']);
$txtnombre_agente=utf8_decode($_POST['txtnombre_agente']);
$txttelefono_agente=utf8_decode($_POST['txttelefono_agente']);
$txttelefono_agente2=utf8_decode($_POST['txttelefono_agente2']);
$txttelefono_agente3=utf8_decode($_POST['txttelefono_agente3']);
$txtfax=utf8_decode($_POST['txtfax']);
$txtcorreo_agente=utf8_decode($_POST['txtcorreo_agente']);
$txtpagina_web=utf8_decode($_POST['txtpagina_web']);
$txtobservaciones=utf8_decode($_POST['txtobservaciones']);

//id_proveedor,nombre_contacto,nombre_empresa,telefono1_contacto,correo_contacto,rfc_empresa,fecha_captura,nombre_comercial,calle,colonia,codigo_postal,pais,estado,municipio,telefono2_contacto,telefono3_contacto,fax_contacto,pagina_web,observaciones

$sql= mysql_query("update cproveedores set nombre_contacto=\"$txtnombre_agente\",nombre_empresa=\"$txtnombre_empresa\",telefono1_contacto=\"$txttelefono_agente\",correo_contacto=\"$txtcorreo_agente\",rfc_empresa=\"$txtrfc_empresa\",fecha_captura=CURDATE(),nombre_comercial=\"$txtnombre_comercial\",calle=\"$txtcalle\",colonia=\"$txtcolonia\",codigo_postal=\"$txtcodigo_postal\",pais=\"$txtpais\",estado=\"$txtestado\",municipio=\"$txtmunicipio\",telefono2_contacto=\"$txttelefono_agente2\",telefono3_contacto=\"$txttelefono_agente3\",fax_contacto=\"$txtfax\",pagina_web=\"$txtpagina_web\",observaciones=\"$txtobservaciones\" where id_proveedor=".$txtid_proveedor_modificar."");


//$cadena="update cmarcas set descripcion_marca='".$txtdescripcion_marca."' where id_marca=".$txtid_marca."";
	
echo "Y";
//echo $cadena;

?>




