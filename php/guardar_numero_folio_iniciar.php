<?php
$tipusr="";
$paginterior=0;
include("../php/autentificacion.server.php");
session_name("lgsapplipweb");
session_start();
session_set_cookie_params(0, "/", $HTTP_SERVER_VARS["HTTP_HOST"], 0);

$id_usuario=$_SESSION["iduser"];

include("../php/conexion.php");
$connect = mysql_connect($hostname, $username, $password)
or die('Could not connect: ' . mysql_error());
//Select The database
$con = mysql_select_db($database, $connect);

$txtnumero_folioiniciar=$_POST['txtnumero_folioiniciar'];

$sql= mysql_query("update ccajas set numero_folio_iniciar=$txtnumero_folioiniciar,inicio_ejercicio=1 where id_caja=1");

//echo "Y";
$cadena="update ccajas set numero_folio_iniciar=$txtnumero_folioiniciar where id_caja=1";
echo $cadena;

?>




