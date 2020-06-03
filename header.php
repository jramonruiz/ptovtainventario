<?php
$tipusr="";
$paginterior=0;
include("php/autentificacion.server.php");
session_name("lgsapplipweb");
session_start();
session_set_cookie_params(0, "/", $HTTP_SERVER_VARS["HTTP_HOST"], 0);

$id_usuario=$_SESSION["iduser"];
?>

        <!-- Logo -->
        <a href="panel_principal.php" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b>INI</b>CIO</span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b>INICIO</b></span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  USUARIO: 
                  <span class="hidden-xs"> <?php echo $_SESSION["nombre_usuario"]; ?></span>
                </a>
                <ul class="dropdown-menu">
                  <!-- Menu Body -->
                  <li class="user-body">
                    <div class="col-xs-12 text-center">
						<?php
							$tipo_usuario=$_SESSION["tipo_usuario"];							
							if($tipo_usuario==1)
								{
									$cadena_tipo_usuario="ADMINISTRADOR DEL SISTEMA";
								}
						?>
                      <a href="#"><?php echo $cadena_tipo_usuario; ?></a>
                    </div>
                  </li>
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    <div class="pull-right">
                      <a class="btn btn-default btn-flat" onClick="cerrarsession();">Salir</a>
                    </div>
                  </li>
                </ul>
              </li>
            </ul>
          </div>
        </nav>
