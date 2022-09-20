
<?php headerAdmin($data);
      getModal('modalTratamiento',$data);

?>

<meta charset="UTF-8">
<main class="app-content">
  <div class="app-title">
    <div>
      <h1><i class="fas fa-user-tag"></i> <?= $data['page_title'] ?> 
      <button class="btn btn-primary" type="button" onclick="openModal();"><i class="fas fa-plus-circle"></i> Nuevo</button>

  </div>
  <ul class="app-breadcrumb breadcrumb">
    <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
    <li class="breadcrumb-item"><a href="<?= base_url();  ?>/dashboard">Inicio</a></li>
  </ul> 
</div>

<div class="row">
       <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Tratamiento de baño</h3>

              <div class="card-tools">
               <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                <i class="fas fa-minus"></i>
                 </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                   <i class="fas fa-times"></i>
                    </button>
                     </div>
                       </div>
                        <div class="card-body">
                         <div class="tile-body">

                             <div class="table-responsive">
                                <table class="table table-hover table-bordered" id="tableTratamiento">
                                  <thead>
                                      
                                      <th >Id</th>
                                      <th >Código</th>
                                      <th >Tip.Baño</th>
                                      <th >Fec.Baño</th>
                                      <th >Tip.Desp.</th>
                                      <th >Fech.Desp.</th>
                                      <th >Tipo.Vacun.</th>
                                      <th >Fech.Vacun.</th>
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
               <div class="card-footer">
              </div>
            </div>
           </div>
          </div>

</main>




<?php footerAdmin($data);?>