
<?php headerAdmin($data);
      getModal('modalGanado',$data);
?>

<meta charset="UTF-8">
    <main class="app-content">
      <div class="app-title">
        <div> 
          <h1><i class="fas fa-user-tag"></i> <?= $data['page_title'] ?> 
<?php  if ($_SESSION['permisosMod']['w']){   ?>
<button class="btn btn-primary" type="button" onclick="openModal();"><i class="fas fa-plus-circle"></i> </button>


<button class="btn btn-info" type="button" onclick="fntConfGanado();"><i class="fas fa-cogs"></i> </button>



 
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
                <table class="table table-hover table-bordered tables" id="tableGanado" >
                  <thead>
                    <tr class="tableEncabezado">
                     
                      <th >N°</th>
                      <th >Nombre</th>
                      <th >Codigo</th>
                      <th >Peso</th>
                      <th >Raza</th>
                      <th >Categoria</th>
                      <th >Estado</th>   
                      <th >Foto</th>
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