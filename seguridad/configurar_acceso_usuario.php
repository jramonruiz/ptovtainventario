<?php
include("../php/conexion.php");
$connect = mysql_connect($hostname, $username, $password)
or die('Could not connect: ' . mysql_error());
//Select The database
$con = mysql_select_db($database, $connect);

$txtid_usuario_modificar=utf8_decode($_POST['txtid_usuario_modificar']);
$cmbacceso1=utf8_decode($_POST['cmbacceso1']);
$cmbacceso2=utf8_decode($_POST['cmbacceso2']);
$cmbacceso3=utf8_decode($_POST['cmbacceso3']);
$cmbacceso4=utf8_decode($_POST['cmbacceso4']);
$cmbacceso5=utf8_decode($_POST['cmbacceso5']);
$cmbacceso6=utf8_decode($_POST['cmbacceso6']);
$cmbacceso7=utf8_decode($_POST['cmbacceso7']);
$cmbacceso8=utf8_decode($_POST['cmbacceso8']);
$cmbacceso9=utf8_decode($_POST['cmbacceso9']);
$cmbacceso10=utf8_decode($_POST['cmbacceso10']);
$cmbacceso11=utf8_decode($_POST['cmbacceso11']);
$cmbacceso12=utf8_decode($_POST['cmbacceso12']);
$cmbacceso13=utf8_decode($_POST['cmbacceso13']);
$cmbacceso14=utf8_decode($_POST['cmbacceso14']);
$cmbacceso15=utf8_decode($_POST['cmbacceso15']);
$cmbacceso16=utf8_decode($_POST['cmbacceso16']);
$cmbacceso17=utf8_decode($_POST['cmbacceso17']);
$cmbacceso18=utf8_decode($_POST['cmbacceso18']);
$cmbacceso19=utf8_decode($_POST['cmbacceso19']);
$cmbacceso20=utf8_decode($_POST['cmbacceso20']);
$cmbacceso21=utf8_decode($_POST['cmbacceso21']);
$cmbacceso22=utf8_decode($_POST['cmbacceso22']);
$cmbacceso23=utf8_decode($_POST['cmbacceso23']);
$cmbacceso24=utf8_decode($_POST['cmbacceso24']);
$cmbacceso25=utf8_decode($_POST['cmbacceso25']);
$cmbacceso26=utf8_decode($_POST['cmbacceso26']);
$cmbacceso27=utf8_decode($_POST['cmbacceso27']);
$cmbacceso28=utf8_decode($_POST['cmbacceso28']);
$cmbacceso29=utf8_decode($_POST['cmbacceso29']);
$cmbacceso30=utf8_decode($_POST['cmbacceso30']);
$cmbacceso31=utf8_decode($_POST['cmbacceso31']);

$sql1= mysql_query("update tmenu_usuario set acceso=\"$cmbacceso1\" where id_usuario=".$txtid_usuario_modificar." and id_menu=1");

$sql2= mysql_query("update tmenu_usuario set acceso=\"$cmbacceso2\" where id_usuario=".$txtid_usuario_modificar." and id_menu=2");

$sql3= mysql_query("update tmenu_usuario set acceso=\"$cmbacceso3\" where id_usuario=".$txtid_usuario_modificar." and id_menu=3");

$sql4= mysql_query("update tmenu_usuario set acceso=\"$cmbacceso4\" where id_usuario=".$txtid_usuario_modificar." and id_menu=4");

$sql5= mysql_query("update tmenu_usuario set acceso=\"$cmbacceso5\" where id_usuario=".$txtid_usuario_modificar." and id_menu=5");

$sql6= mysql_query("update tmenu_usuario set acceso=\"$cmbacceso6\" where id_usuario=".$txtid_usuario_modificar." and id_menu=6");

$sql7= mysql_query("update tmenu_usuario set acceso=\"$cmbacceso7\" where id_usuario=".$txtid_usuario_modificar." and id_menu=7");

$sql8= mysql_query("update tmenu_usuario set acceso=\"$cmbacceso8\" where id_usuario=".$txtid_usuario_modificar." and id_menu=8");

$sql9= mysql_query("update tmenu_usuario set acceso=\"$cmbacceso9\" where id_usuario=".$txtid_usuario_modificar." and id_menu=9");

$sql10= mysql_query("update tmenu_usuario set acceso=\"$cmbacceso10\" where id_usuario=".$txtid_usuario_modificar." and id_menu=10");

$sql11= mysql_query("update tmenu_usuario set acceso=\"$cmbacceso11\" where id_usuario=".$txtid_usuario_modificar." and id_menu=11");

$sql12= mysql_query("update tmenu_usuario set acceso=\"$cmbacceso12\" where id_usuario=".$txtid_usuario_modificar." and id_menu=12");

$sql13= mysql_query("update tmenu_usuario set acceso=\"$cmbacceso13\" where id_usuario=".$txtid_usuario_modificar." and id_menu=13");

$sql14= mysql_query("update tmenu_usuario set acceso=\"$cmbacceso14\" where id_usuario=".$txtid_usuario_modificar." and id_menu=14");

$sql15= mysql_query("update tmenu_usuario set acceso=\"$cmbacceso15\" where id_usuario=".$txtid_usuario_modificar." and id_menu=15");

$sql16= mysql_query("update tmenu_usuario set acceso=\"$cmbacceso16\" where id_usuario=".$txtid_usuario_modificar." and id_menu=16");

$sql17= mysql_query("update tmenu_usuario set acceso=\"$cmbacceso17\" where id_usuario=".$txtid_usuario_modificar." and id_menu=17");

$sql18= mysql_query("update tmenu_usuario set acceso=\"$cmbacceso18\" where id_usuario=".$txtid_usuario_modificar." and id_menu=18");

$sql19= mysql_query("update tmenu_usuario set acceso=\"$cmbacceso19\" where id_usuario=".$txtid_usuario_modificar." and id_menu=19");

$sql20= mysql_query("update tmenu_usuario set acceso=\"$cmbacceso20\" where id_usuario=".$txtid_usuario_modificar." and id_menu=20");

$sql21= mysql_query("update tmenu_usuario set acceso=\"$cmbacceso21\" where id_usuario=".$txtid_usuario_modificar." and id_menu=21");

$sql22= mysql_query("update tmenu_usuario set acceso=\"$cmbacceso22\" where id_usuario=".$txtid_usuario_modificar." and id_menu=22");

$sql23= mysql_query("update tmenu_usuario set acceso=\"$cmbacceso23\" where id_usuario=".$txtid_usuario_modificar." and id_menu=23");

$sql24= mysql_query("update tmenu_usuario set acceso=\"$cmbacceso24\" where id_usuario=".$txtid_usuario_modificar." and id_menu=24");

$sql25= mysql_query("update tmenu_usuario set acceso=\"$cmbacceso25\" where id_usuario=".$txtid_usuario_modificar." and id_menu=25");

$sql26= mysql_query("update tmenu_usuario set acceso=\"$cmbacceso26\" where id_usuario=".$txtid_usuario_modificar." and id_menu=26");

$sql27= mysql_query("update tmenu_usuario set acceso=\"$cmbacceso27\" where id_usuario=".$txtid_usuario_modificar." and id_menu=27");

$sql28= mysql_query("update tmenu_usuario set acceso=\"$cmbacceso28\" where id_usuario=".$txtid_usuario_modificar." and id_menu=28");

$sql29= mysql_query("update tmenu_usuario set acceso=\"$cmbacceso29\" where id_usuario=".$txtid_usuario_modificar." and id_menu=29");

$sql30= mysql_query("update tmenu_usuario set acceso=\"$cmbacceso30\" where id_usuario=".$txtid_usuario_modificar." and id_menu=30");

$sql31= mysql_query("update tmenu_usuario set acceso=\"$cmbacceso31\" where id_usuario=".$txtid_usuario_modificar." and id_menu=31");


echo "1";

?>




