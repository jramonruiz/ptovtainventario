<?php
$tipusr="";
$paginterior=0;
include("../php/autentificacion.server.php");
session_name("lgsapplipweb");
session_start();
session_set_cookie_params(0, "/", $HTTP_SERVER_VARS["HTTP_HOST"], 0);

$id_usuario=$_SESSION["iduser"];
$id_tipo_usuario=$_SESSION["tipo_usuario"];

include("../php/conexion.php");
$connect = mysql_connect($hostname, $username, $password)
or die('Could not connect: ' . mysql_error());
//Select The database
$con = mysql_select_db($database, $connect);
?>  

 <?php 
 $chref1="#";
 $chref2="#";
 $chref3="#";
 $chref4="#";
 $chref5="#";
 $chref6="#";
 $chref7="#";
 $chref8="#";
 $chref9="#";
 $chref10="#";
 $chref11="#";
 $chref12="#";
 $chref13="#";
 $chref14="#";
 $chref15="#";
 $chref16="#";
 $chref17="#";
 $chref18="#";
 $chref19="#";
 $chref20="#";
 $chref21="#";
 $chref22="#";
 $chref23="#";
 $chref24="#";
 $chref25="#";
 $chref26="#";
 $chref27="#";
 $chref28="#";
 $chref29="#";
 $chref30="#";
 $chref31="#";
                
                $listado=  mysql_query("select tmu.id_menu_usuario,tms.menu,tmu.acceso,tmu.id_menu from tmenu_sistema tms inner join tmenu_usuario tmu on tms.id_menu=tmu.id_menu where tmu.id_usuario=$id_usuario order by tmu.id_menu");
                   while($reg=  mysql_fetch_array($listado))
                   {
                               $id_menu_usuario=mb_convert_encoding($reg['id_menu_usuario'], "UTF-8");
                               $menu=mb_convert_encoding($reg['menu'], "UTF-8");
                               $acceso=mb_convert_encoding($reg['acceso'], "UTF-8");
                               $id_menu=mb_convert_encoding($reg['id_menu'], "UTF-8");

                              if($id_menu==1 and $acceso==1)
                              {
                                  $chref1="ventas.php";//CATALOGOS CON SUBMENU
                              }

                              if($id_menu==2 and $acceso==1)
                              {
                                  $chref2="verificadorprecios.php";//PROCEDIMIENTOS SUBMENU
                              }

                              if($id_menu==3 and $acceso==1)
                              {
                                  $chref3="compras.php";//ENFERMEDADES SUBMENU
                              }

                              if($id_menu==4 and $acceso==1)
                              {
                                  $chref4="#";//CONSULTAS MENU PRINCIPAL
                              }

                              if($id_menu==5 and $acceso==1)
                              {
                                  $chref5="corte_caja_resumen.php";//PACIENTES MENU PRINCIPAL
                              }

                              if($id_menu==6 and $acceso==1)
                              {
                                  $chref6="reporte_articulos.php";//PROCEDIMIENTOS MENU PRINCIPAL
                              }

                              if($id_menu==7 and $acceso==1)
                              {
                                  $chref7="reporte_compras.php";//CITAS MENU PRINCIPAL
                              }

                              if($id_menu==8 and $acceso==1)
                              {
                                  $chref8="reporte_comprobantes.php";//COBROS MENU PRINCIPAL
                              }

                              if($id_menu==9 and $acceso==1)
                              {
                                  $chref9="reporte_valor_inventario.php";// REPORTES CON SUBMENU
                              }

                              if($id_menu==10 and $acceso==1)
                              {
                                  $chref10="reporte_desglose_notas.php";//CORTE DE CAJA SUBMENU
                              }

                              if($id_menu==11 and $acceso==1)
                              {
                                  $chref11="#";//ENFERMEDADES SUBMENU
                              }

                              if($id_menu==12 and $acceso==1)
                              {
                                  $chref12="../catalogos/impuestos.php";//PROCEDIMIENTOS SUBMENU
                              }

                              if($id_menu==13 and $acceso==1)
                              {
                                  $chref13="../catalogos/metodospago.php";//PACIENTES SUBMENU
                              }

                              if($id_menu==14 and $acceso==1)
                              {
                                  $chref14="../catalogos/clientes.php";// ESTADISTICAS CON SUBMENU
                              }

                              if($id_menu==15 and $acceso==1)
                              {
                                  $chref15="../catalogos/proveedores.php";//ENFERMEDADES SUBMENU
                              }

                              if($id_menu==16 and $acceso==1)
                              {
                                  $chref16="../catalogos/areasventa.php";//PROCEDIMIENTOS SUBMENU
                              }

                              if($id_menu==17 and $acceso==1)
                              {
                                  $chref17="../catalogos/unidadesmedida.php";//PACIENTES SUBMENU
                              }

                              if($id_menu==18 and $acceso==1)
                              {
                                  $chref18="../catalogos/ubicaciones.php";//USUARIOS MENU PRINCIPAL
                              }

                              if($id_menu==19 and $acceso==1)
                              {
                                  $chref19="../catalogos/sucursales.php";
                              }

                              if($id_menu==20 and $acceso==1)
                              {
                                  $chref20="../catalogos/cajas.php";
                              }

                              if($id_menu==21 and $acceso==1)
                              {
                                  $chref21="../catalogos/marcas.php";//COBROS MENU PRINCIPAL
                              }

                              if($id_menu==22 and $acceso==1)
                              {
                                  $chref22="../catalogos/departamentos.php";//COBROS MENU PRINCIPAL
                              }

                              if($id_menu==23 and $acceso==1)
                              {
                                  $chref23="../catalogos/categorias.php";//COBROS MENU PRINCIPAL
                              }

                              if($id_menu==24 and $acceso==1)
                              {
                                  $chref24="../mantenimiento/cuentasporpagar.php";
                              }

                              if($id_menu==25 and $acceso==1)
                              {
                                  $chref25="../mantenimiento/cuentasporcobrar.php";//COBROS MENU PRINCIPAL
                              }

                              if($id_menu==26 and $acceso==1)
                              {
                                  $chref26="../mantenimiento/inventariosfisico.php";//COBROS MENU PRINCIPAL
                              }

                              if($id_menu==27 and $acceso==1)
                              {
                                  $chref27="../mantenimiento/productos.php";//COBROS MENU PRINCIPAL
                              }

                              if($id_menu==28 and $acceso==1)
                              {
                                  $chref28="../seguridad/usuarios.php";//COBROS MENU PRINCIPAL
                              }

                              if($id_menu==29 and $acceso==1)
                              {
                                  $chref29="../seguridad/backup.php";//COBROS MENU PRINCIPAL
                              }

                              if($id_menu==30 and $acceso==1)
                              {
                                  $chref30="../seguridad/restore.php";//COBROS MENU PRINCIPAL
                              }

                              if($id_menu==31 and $acceso==1)
                              {
                                  $chref31="../barcodes.php";//COBROS MENU PRINCIPAL
                              }

                  }
                  ?>              

            <li class="header">MENU DE OPCIONES</li>
            <li>
              <a href="<?php echo $chref1; ?>">
                <i class="fa fa-th"></i> <span>Ventas</span>
              </a>
            </li>
            <li>
              <a href="<?php echo $chref2; ?>">
                <i class="fa fa-th"></i> <span>Verificador de Precios</span>
              </a>
            </li>
            <li>
              <a href="<?php echo $chref3; ?>">
                <i class="fa fa-th"></i> <span>Compras</span>
              </a>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-th"></i> <span>Reportes</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="<?php echo $chref8; ?>"><i class="fa fa-circle-o"></i>Corte de Caja</a></li>
        </ul>     
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-th"></i> <span>Catalogos</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="<?php echo $chref14; ?>"><i class="fa fa-circle-o"></i> <span>Clientes</span></a></li>
                <li><a href="<?php echo $chref15; ?>"><i class="fa fa-circle-o"></i> <span>Proveedores</span></a></li>
                <li><a href="<?php echo $chref17; ?>"><i class="fa fa-circle-o"></i> <span>Unidades de medida</span></a></li>
                <li><a href="<?php echo $chref18; ?>"><i class="fa fa-circle-o"></i> <span>Ubicaciones</span></a></li>
                <li><a href="<?php echo $chref21; ?>"><i class="fa fa-circle-o"></i> <span>Marcas</span></a></li>
                <li><a href="<?php echo $chref22; ?>"><i class="fa fa-circle-o"></i> <span>Departamentos</span></a></li>
                <li><a href="<?php echo $chref23; ?>"><i class="fa fa-circle-o"></i> <span>Categorias</span></a></li>
               </ul>     
            </li>
            <li>
              <a href="<?php echo $chref26; ?>">
                <i class="fa fa-th"></i> <span>Inventarios Fisicos</span>
              </a>
            </li>
            <li>
              <a href="<?php echo $chref27; ?>">
                <i class="fa fa-th"></i> <span>Productos</span>
              </a>
            </li>
            <li>
              <a href="<?php echo $chref28; ?>">
                <i class="fa fa-th"></i> <span>Usuarios</span>
              </a>
            </li>
            <li>
              <a href="<?php echo $chref29; ?>">
                <i class="fa fa-th"></i> <span>Respaldar Base de Datos</span>
              </a>
            </li>
            <li>
              <a href="<?php echo $chref30; ?>">
                <i class="fa fa-th"></i> <span>Restaurar Base de Datos</span>
              </a>
            </li>
