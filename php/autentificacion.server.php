<?php
session_name("lgsapplipweb");
session_start();
session_set_cookie_params(0, "/", $HTTP_SERVER_VARS["HTTP_HOST"], 0);
if ($_SESSION["autentificado"] != "SI") {
    switch($paginterior)
         {
         case 0:
               header("Location: index.php");
               break;
         case 1:
               header("Location: expirasesion.php");
               break;
         case 2:
               header("Location: ../expirasesion.php");
               break;
        }
} else {
    $fechaGuardada = $_SESSION["ultimoAcceso"];
    $ahora = date("Y-n-j H:i:s");
    $tiempo_transcurrido = (strtotime($ahora)-strtotime($fechaGuardada));

     if($tiempo_transcurrido >= 3600) { 
      session_destroy(); 
      switch($paginterior)
         {
         case 0:
               header("Location: index.php");
               break;
         case 1:
               header("Location: expirasesion.php");
               break;
         case 2:
               header("Location: ../expirasesion.php");
               break;
        }
    }else {
    $_SESSION["ultimoAcceso"] = $ahora;
   }
}

?>
