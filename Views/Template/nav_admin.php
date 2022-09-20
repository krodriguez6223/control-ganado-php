      <!-- Sidebar menu-->
    <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
    <aside class="app-sidebar">

      <div class="app-sidebar__user " >
         <a  href="<?= base_url();?>/perfil">

            <?php  if (empty($_SESSION['userData']['foto'])){ ?>

               
                 <img class="app-sidebar__user-avatar"  src="<?= media(); ?>/images/users/default.png" alt="User Image">


            <?php }else{ ?>

                <img class="app-sidebar__user-avatar"  src="<?= media(); ?>/images/users/<?php echo($_SESSION['userData']['foto'])  ?>" alt="User Image">


                <?php } ?>
        
         </a>

        <div>
          <p class="app-sidebar__user-name"><?= $_SESSION['userData']['nombres'] ?></p>
          <p class="app-sidebar__user-designation"><?= $_SESSION['userData']['nombrerol'] ?></p>
        </div>
      </div>


<!-- MENU DE OPCIONES-->
<?php if (!empty($_SESSION['permisos'][1]['r'])){ ?>

      <ul class="app-menu">
        <li>
             <a class="app-menu__item" href="<?= base_url();?>/dashboard">
             <i class="nav-icon fas fa-tachometer-alt"></i>
          <span class="app-menu__label">Dashboard</span>
         </a>
        </li>
<?php } ?>
<!-- USUARIOS-->
<?php if (!empty($_SESSION['permisos'][2]['r'])){ ?>
      <li class="treeview">
         <a class="app-menu__item" href="#" data-toggle="treeview">
          <i class="nav-icon app-menu__icon fas fa-address-card"></i>
          <span class="app-menu__label">Usuarios</span>
          <i class="treeview-indicator fa fa-angle-right"></i>
         </a>

          <ul class="treeview-menu">
            <li>
                <a class="treeview-item" href="<?= base_url();?>/usuarios">
                <i class="nav-icon fas fa-arrow-right"></i> Usuarios</a>
            </li>
            <li>
                <a class="treeview-item" href="<?= base_url(); ?>/roles" >
                 <i class="nav-icon fas fa-arrow-right"></i> Roles</a>
            </li>
          </ul>
        </li>

        <?php } ?>

<!-- GANADO-->
<?php if (!empty($_SESSION['permisos'][3]['r'])){ ?>
           <li class="treeview">
         <a class="app-menu__item" href="#" data-toggle="treeview">
          <i class="nav-icon app-menu__icon fas fa-users"></i>
          <span class="app-menu__label">Ganado</span>
          <i class="treeview-indicator fa fa-angle-right"></i>
         </a>

          <ul class="treeview-menu">
            <li>
                <a class="treeview-item" href="<?= base_url();?>/ganado">
                <i class="nav-icon fas fa-arrow-right"></i> Registro ganado</a>
            </li>
            <li>
                <a class="treeview-item" href="<?= base_url(); ?>/tratamiento" >
                 <i class="nav-icon fas fa-arrow-right"></i> Tratamiento</a>
            </li>
            <li><a class="treeview-item" href="<?= base_url();?>/notificacionTrata">
              <i class="nav-icon fas fa-arrow-right"></i> Reces a tratar</a>
           </li>
            
          </ul>
        </li>
<?php } ?>
<!-- VENTAS-->
<?php if (!empty($_SESSION['permisos'][4]['r'])){ ?>
       <li class="treeview">
         <a class="app-menu__item" href="#" data-toggle="treeview">
          <i class="nav-icon app-menu__icon fas fa-cash-register"></i>
          <span class="app-menu__label">Producción y Ventas</span>
          <i class="treeview-indicator fa fa-angle-right"></i>
         </a>

          <ul class="treeview-menu">
            
            <li>
                <a class="treeview-item" href="<?= base_url(); ?>/produccion" >
                 <i class="nav-icon fas fa-arrow-right"></i> Producción</a>
            </li>
            <li>
                <a class="treeview-item" href="<?= base_url();?>/ventas">
                <i class="nav-icon fas fa-arrow-right"></i> Ventas</a>
            </li> 
          </ul>
        </li>
<?php } ?>
<!-- CLIENTES-->
<?php if (!empty($_SESSION['permisos'][2]['r'])){ ?>
      <li class="treeview">
         <a class="app-menu__item" href="#" data-toggle="treeview">
          <i class="nav-icon app-menu__icon fas fa-address-card"></i>
          <span class="app-menu__label">Clientes</span>
          <i class="treeview-indicator fa fa-angle-right"></i>
         </a>

          <ul class="treeview-menu">
            <li>
                <a class="treeview-item" href="<?= base_url();?>/clientes">
                <i class="nav-icon fas fa-arrow-right"></i> Clientes</a>
            </li>
          </ul>
        </li>

        <?php } ?>
<!-- PROVEEDORES-->

<?php if (!empty($_SESSION['permisos'][5]['r'])){ ?>
       <li class="treeview">
         <a class="app-menu__item" href="#" data-toggle="treeview">
            <i class="nav-icon app-menu__icon fas fa-truck"></i>
                   <span class="app-menu__label">Proveedores</span>
          <i class="treeview-indicator fa fa-angle-right"></i>
         </a>

          <ul class="treeview-menu">
            <li>
                <a class="treeview-item" href="<?= base_url();?>/proveedores">
                <i class="nav-icon fas fa-arrow-right"></i> Registros proveedores</a>
            </li>
            <li>
                <a class="treeview-item" href="<?= base_url(); ?>/reporte_proveedores" >
                 <i class="nav-icon fas fa-arrow-right"></i> Reporte</a>
            </li>  
          </ul>
        </li>
<?php } ?>
<!-- INVENTARIO-->

<?php if (!empty($_SESSION['permisos'][6]['r'])){ ?>
      <li class="treeview">
         <a class="app-menu__item" href="#" data-toggle="treeview">
          <i class="nav-icon app-menu__icon far fa-list-alt"></i>
          <span class="app-menu__label">Inventario</span>
          <i class="treeview-indicator fa fa-angle-right"></i>
         </a>

          <ul class="treeview-menu">
            <li>
                <a class="treeview-item" href="<?= base_url();?>/inventario">
                <i class="nav-icon fas fa-arrow-right"></i> Registro de inventario</a>
            </li>
            <li>
                <a class="treeview-item" href="<?= base_url(); ?>/reporte_inventario" >
                 <i class="nav-icon fas fa-arrow-right"></i> Reporte</a>
            </li>
          </ul>
        </li>
<?php } ?>
<!-- TRABAJADORES-->
<?php if (!empty($_SESSION['permisos'][7]['r'])){ ?>
       <li class="treeview">
         <a class="app-menu__item" href="#" data-toggle="treeview">
          <i class="nav-icon app-menu__icon fas fa-child"></i>
          <span class="app-menu__label">Empleados</span>
          <i class="treeview-indicator fa fa-angle-right"></i>
         </a>

          <ul class="treeview-menu">
            <li>
                <a class="treeview-item" href="<?= base_url();?>/empleados">
                <i class="nav-icon fas fa-arrow-right"></i> Registro de empleados</a>
            </li>
            <li>
                <a class="treeview-item" href="<?= base_url(); ?>/reporte_trabajadores" >
                 <i class="nav-icon fas fa-arrow-right"></i> Reporte</a>
            </li>           
          </ul>
        </li>
<?php } ?>
<!-- SESSION-->       
        <li>
            <a class="app-menu__item" href="<?= base_url();?>/logout">
            <i class=" nav-icon fas fa-sign-out-alt"></i>
         <span class="app-menu__label">Cerrar sesión</span>
         </a>
        </li>
      </ul>
    </aside>