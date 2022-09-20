
<?php headerAdmin($data);
      getModal('modalEmpleado',$data);
?>

  <main class="app-content">
  <meta charset="UTF-8">

      <div class="app-title"> 
        <div>
          <h1><i class="fas fa-user-tag"></i> <?= $data['page_title'] ?> 
<?php  if ($_SESSION['permisosMod']['w']){   ?>        
<button class="btn btn-primary" type="button" onclick="openModal();"><i class="fas fa-plus-circle"></i> Nuevo</button>
<?php } ?>
        </h1>
          <p>Control general del sistema</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="<?= base_url();  ?>/dashboard">Inicio</a></li>
        </ul>
      </div>
 
      <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <div class="tile-body">
              <div class="table-responsive">
                <table class="table table-hover table-bordered" id="tableEmpleado">
                  <thead>
                    <tr class="tableEncabezado">
                   
                      <th >Cédula</th>
                      <th >Nombres</th>
                      <th >Apellidos</th>
                      <th >Correo</th>
                      <th >Contacto</th>
                      <th >Edad (años)</th>
                      <th >Cargo</th>
                      <th >Estado</th>
                      <th id="acciones" >Acciones</th>
                                            
                  </tr>
                 </thead>
                  <tbody>
                  </div>  
                  </tr>
                  </tbody>
                </table>

              </div>
            </div>
          </div>
        </div>
      </div>
    </main>
    <?php footerAdmin($data);?>