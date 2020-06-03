<?php
session_name("lgsapplipweb");
session_start();
session_unset();
session_destroy();
echo "../index.php"; 
?>
