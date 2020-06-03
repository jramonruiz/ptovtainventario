<?php
include("php/conexion.php");
$connect = mysql_connect($hostname, $username, $password)
or die('Could not connect: ' . mysql_error());
//Select The database
$con = mysql_select_db($database, $connect);

$res_sql="fallo";
//$query = "SELECT id_usuario,login FROM cusuarios where login=\"".$_GET['txtusuario']."\" and clave=MD5(\"".$_GET['txtclave']."\") and activo=1;";
if($_GET['txtusuario']!="" && $_GET['txtclave']!="")
        {   
		  $query = "SELECT id_usuario,login,activo,nombre_usuario,fecha_vencimiento,tipo_usuario,id_sucursal FROM cusuarios where login=\"".$_GET['txtusuario']."\" and clave=MD5(\"".$_GET['txtclave']."\");";
		  $result = mysql_query($query) or die("SQL Error 1: " . mysql_error());
		  // get data and store in a json array
				session_name("lgsapplipweb");
				session_start();
				session_set_cookie_params(0, "/", $_SERVER["HTTP_HOST"], 0);
				$_SESSION["autentificado"]= "SI";
				$_SESSION["user"]= $_GET['txtusuario'];
		  while ($row = mysql_fetch_array($result)) 
			  {
				  $_SESSION["iduser"]=utf8_encode($row[0]);
				  $_SESSION["nameuser"]=utf8_encode($row[1]);
				  $id_usuario=utf8_encode($row[0]);
				  $activo=utf8_encode($row[2]);
				  $_SESSION["nombre_usuario"]=utf8_encode($row[3]);
				  $data2=$row[4];
				  $_SESSION["tipo_usuario"]=utf8_encode($row[5]);
				  $_SESSION["sucursal"]=utf8_encode($row[6]);
			  }
			  $_SESSION["ultimoAcceso"]= date("Y-n-j H:i:s");
			  
			  
			  $data1=date("Y-m-d");
			  
			 // 86400 seg = 60 [seg/1_minuto] * 60 [1_minuto / 1_hora]* 24 [1_hora]
			 $segundos  = strtotime($data2)-strtotime($data1);
			 $dias      = intval($segundos/86400);
			 $segundos -= $dias*86400;
			 $horas     = intval($segundos/3600);
			 $segundos -= $horas*3600;
			 $minutos   = intval($segundos/60);
			 $segundos -= $minutos*60;
			 $dias_vencimiento =$dias;
			 $_SESSION['dias_vencimiento_cuenta']=$dias_vencimiento;			  
			  
			  if($id_usuario>0 && $activo<2 && $dias_vencimiento>0)
				  {
					  $res_sql="si";
					  //$res_sql=$dias_vencimiento;
				  }
			  else if($id_usuario>0 && $activo>1)
			  	  {
					  $res_sql="de";  
				  }
			  else if($id_usuario>0 && $activo<2 && $dias_vencimiento<1)
			  	  {
					  $res_sql="ve";
					  //$res_sql=$dias_vencimiento;
				  }
			  else
				  {
					  $res_sql="no";
				  }
        }
else
   $res_sql="no";
echo $res_sql;
?>
