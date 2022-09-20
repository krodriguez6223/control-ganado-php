

<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="tienda Virtual">
    <meta name="theme-color" content="#009689">
    
    <link rel="shortcut icon" href="<?= media();?>/images/favicon.ico">
    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="<?= media(); ?>/css/main.css">
    <link rel="stylesheet" type="text/css" href="<?= media(); ?>/css/style.css">
    <!-- Font-icon css-->

    <title><?= $data['tag_page'] ?></title>
  </head>
   <body>
    
      <section class="material-half-bg">
        <div class="cover"></div>
      </section>
    <section class="login-content">
      <div class="logo">

        
      </div>
      <div class="login-box">
        <div id="divLoading">
          <div> 
            <img src="<?= media(); ?>/images/loading.svg" alt="Loading">
          </div>

        </div>

        <form class="login-form" name="formLogin" id="formLogin" action="">
        <div class="col-12 user-imgs" >
			<img src="<?= media();?>/images/logoEmpresa.png"  width="100" height="100"/>
		</div>

          <h3 class="login-head">Iniciar sesión</h3>
          <div class="form-group">
            <label class="control-label">Usuario</label>
            <input id="txtEmailUser" name="txtEmailUser" class="form-control" type="email" placeholder=" Correo electronico" autofocus>
          </div>
          <div class="form-group">
            <label class="control-label">Contraseña</label>
            <input id="txtPassword" name="txtPassword" class="form-control" type="password" placeholder="Contraseña">
          </div>
          <div class="form-group">
            <div class="utility">
             <p class="semibold-text mb-2 "><a href="#" data-toggle="flip">¿Olvidaste tu contraseña ?</a></p>
            </div>
          </div>
          <div id="alertLogin" class="text-center"></div>
          <div class="form-group btn-container">
            <button type="submit" class="btn btn-primary btn-block"><i class="fa fa-sign-in fa-lg fa-fw"></i>Iniciar sesión</button>
          </div>

         </form>
        <form id="formResetPass" name="formResetPass" class="forget-form" action="">
        	<div class="col-8 user-img" >
			</div>
          <h3 class="login-head">Restablecer contraseña</h3>
          <div class="form-group">
            <label class="control-label">Correo</label>
            <input id="txtEmailReset" name="txtEmailReset" class="form-control" type="text" placeholder="Email">
          </div>
          <div class="form-group btn-container">
            <button type="submit" class="btn btn-primary btn-block"><i class="fa fa-unlock fa-lg fa-fw"></i>Restablecer</button>
          </div>
          <div class="form-group mt-3">
            <p class="semibold-text mb-0"><a href="#" data-toggle="flip"><i class="fa fa-angle-left fa-fw"></i> Regresar al inicio de sesión</a></p>
          </div>
        </form>
      </div>
    </section>

    <script>
        const base_url = "<?= base_url(); ?>";
    </script>

    <!-- Essential javascripts for application to work-->
    <script src="<?= media(); ?>/js/plugins/jquery-3.3.1.min.js"></script>
    <script src="<?= media(); ?>/js/plugins/popper.min.js"></script>
    <script src="<?= media(); ?>/js/plugins/bootstrap.min.js"></script>
    <script src="<?= media(); ?>/js/plugins/fontawesome.js"></script>
    <script src="<?= media(); ?>/js/plugins/main.js"></script>
    <!-- The javascript plugin to display page loading on top-->
    <script src="<?= media(); ?>/js/plugins/pace.min.js"></script>
    <script type="text/javascript" src="<?= media(); ?>/js/plugins/sweetalert.min.js"></script>
    <script src="<?= media(); ?>/js/<?= $data['page_functions_js']; ?>"></script>
    
    </body>
</html>

  