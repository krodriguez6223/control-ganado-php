<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="description" content="Sistema Ganado - Hacienda 'Hacienda Campos del Norte'">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#fff">
    <link rel="shortcut icon"href="<?= media();?>/images/favicon.ico">
    <title><?= $data['page_tage'] ?> </title>
    
    <!-- Main CSS  ESTILOS-->
    <link rel="stylesheet" type="text/css" href="<?= media(); ?>/css/adminlte.min.css">
     <!-- Estilos de Template css -->
    <link rel="stylesheet" type="text/css" href="<?= media(); ?>/css/main.css">
    <!-- Estilos de personalizacion  css -->
    <link rel="stylesheet" type="text/css" href="<?= media(); ?>/css/style.css">
    <!-- Estilos de bootstrap  css -->
    <link rel="stylesheet" type="text/css" href="<?= media(); ?>/css/bootstrap-select.min.css">
    <!-- Start datatable css -->
    <link rel="stylesheet" type="text/css" href="<?= media(); ?>/css/responsive.jqueryui.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" type="text/css" href="<?= media(); ?>/css/daterangepicker.css">

    

  

  </head>
  <body class="app sidebar-mini">
    <div id="divLoading">
          <div> 
            <img src="<?= media(); ?>/images/loading.svg" alt="Loading">
          </div>
        </div>
    <!-- Navbar-->
    <header class="app-header"><a class="app-header__logo" href="dashboard">Sistema Ganado</a>

     
      <!-- Sidebar toggle button-->
      <a class="app-sidebar__toggle" href="#" data-toggle="sidebar" aria-label="Hide Sidebar"><i class="fas fa-bars"></i></a>
  
      <!-- Navbar Right Menu-->
      <ul class="app-nav">
       
  
          <?php  

           $arrDataNot = notCantTraHead();

           $cantBaño =    $arrDataNot['baño']['total'];
           $cantDesp =    $arrDataNot['desparacitacion']['total'];
           $cantVacuna =  $arrDataNot['vacunacion']['total'];
          
           $total= $cantBaño + $cantDesp + $cantVacuna;

        ?>

 <!--Notification Menu-->
        <li class="dropdown">
          <a class="app-nav__item" href="#" data-toggle="dropdown" aria-label="Show notifications">
            <i class="fas fa-bell fa-lg"></i>
           
            <?php 

                if ($total)
             {?>

          <span class="badge badge-danger badge-counter">
            <?php 
                    echo $total; ?>
            </span>

          <?php } ?>

          </a>
          <ul class="app-notification dropdown-menu dropdown-menu-right">
            <li class="app-notification__title">Tienes (<?php echo $total; ?>) tratamientos para HOY</li>
            <div class="app-notification__content">
             
              <li><a class="app-notification__item" href="<?= base_url(); ?>/notificacionTrata">
                <span class="app-notification__icon">
                  <span class="fa-stack fa-lg">
                    <i class="fa fa-circle fa-stack-2x text-primary"></i>
                    <i class="fas fa-shower fa-stack-1x fa-inverse"></i>
                  </span>
                </span> 

                <div>
                    <p class="app-notification__message">Baño</p>
                    <p class="app-notification__meta">Tienes <?php echo $arrDataNot['baño']['total'];?> res a tratar</p>
                  </div>
                </a>
              </li><li>
                <a class="app-notification__item" href="<?= base_url(); ?>/notificacionTrata">
                  <span class="app-notification__icon">
                    <span class="fa-stack fa-lg">
                      <i class="fa fa-circle fa-stack-2x text-danger"></i>
                      <i class="fas fa-viruses fa-stack-1x fa-inverse"></i>
                    </span>
                  </span>

                 <div>
                    <p class="app-notification__message">Desparasitación</p>
                    <p class="app-notification__meta">Tienes <?php echo $arrDataNot['desparacitacion']['total'];?> res a tratar</p>
                  </div>
                </a>
              </li>
              <li><a class="app-notification__item" href="<?= base_url(); ?>/notificacionTrata">
                <span class="app-notification__icon">
                  <span class="fa-stack fa-lg">
                    <i class="fa fa-circle fa-stack-2x text-success"></i>
                    <i class="fas fa-syringe fa-stack-1x fa-inverse"></i>
                  </span>
                </span>

                  <div>
                    <p class="app-notification__message">Vacunación</p>
                    <p class="app-notification__meta">Tienes <?php echo $arrDataNot['vacunacion']['total'];?> res a tratar</p>
                  </div>
                </a>
              </li>
            
            <li class="app-notification__footer">
              <a href="<?= base_url(); ?>/notificacionTrata">Ir a lista.</a></li>
          </ul>
        </li>
      



        <!-- User Menu-->

        <li class="dropdown"><a class="app-nav__item" href="#" data-toggle="dropdown" aria-label="Open Profile Menu"><i class="fa fa-user fa-lg"></i></a>
          <ul class="dropdown-menu settings-menu dropdown-menu-right">

            <li><a class="dropdown-item" href="<?= base_url(); ?>/perfil"><i class="fa fa-user fa-lg"></i> Perfil</a></li>
            <li><a class="dropdown-item" href="<?= base_url(); ?>/logout"><i class="nav-icon fas fa-sign-out-alt"></i>Cerrar sesión</a></li>
          </ul>
        </li>
      </ul>
    </header>

    <?php require_once("nav_admin.php");?>