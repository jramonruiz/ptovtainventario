<?php
include("conexion.php");
$connect = mysql_connect($hostname, $username, $password)
or die('Could not connect: ' . mysql_error());
//Select The database
$con = mysql_select_db($database, $connect);

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

$id_proveedor=0;

$rss = mysql_query("SELECT id_proveedor FROM cproveedores where nombre_empresa=\"$txtnombre_empresa\" and nombre_comercial=\"$txtnombre_comercial\"");
if ($rows = mysql_fetch_row($rss)) {
$id_proveedor = trim($rows[0]);
}

if($id_proveedor==0)
{
		$sql= mysql_query("insert into cproveedores(nombre_contacto,nombre_empresa,telefono1_contacto,correo_contacto,rfc_empresa,fecha_captura,nombre_comercial,calle,colonia,codigo_postal,pais,estado,municipio,telefono2_contacto,telefono3_contacto,fax_contacto,pagina_web,observaciones) values(\"$txtnombre_agente\",\"$txtnombre_empresa\",\"$txttelefono_agente\",\"$txtcorreo_agente\",\"$txtrfc_empresa\",CURDATE(),\"$txtnombre_comercial\",\"$txtcalle\",\"$txtcolonia\",\"$txtcodigo_postal\",\"$txtpais\",\"$txtestado\",\"$txtmunicipio\",\"$txttelefono_agente2\",\"$txttelefono_agente3\",\"$txtfax\",\"$txtpagina_web\",\"$txtobservaciones\")");

		//$cadena="insert into cproveedores(nombre_agente,nombre_empresa,telefono_agente,correo_agente) values('".$txtnombre_agente."','".$txtnombre_empresa."','".$txttelefono_agente."','".$txtcorreo_agente."')";
			
		echo "Y";
}
else
{
		echo "N";
}

?>




