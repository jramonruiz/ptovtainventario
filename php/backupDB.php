<?php 
// variables
error_reporting(1);

$dbhost = 'localhost';
$dbname = 'appsclu1_puntoventa';
$dbuser = 'appsclu1_bdUser';
$dbpass = '2018SqlUser2018';
 
$backup_file = '../backups/'.$dbname . date("Y-m-d-H-i-s") . '.sql';
 
// comandos a ejecutar
if($_REQUEST){
	$command = "mysqldump --opt -h $dbhost -u $dbuser -p$dbpass $dbname > $backup_file";
 
// ejecución y salida de éxito o errores
	system($command,$output);
	echo $output;
}else{
	echo "0";
}
?>