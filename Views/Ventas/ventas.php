
<?php headerAdmin($data);
      getModal('modalVenta',$data);

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
  <div class="col-md-12">
    <div class="tile">
      <div class="tile-body">
        <div class="col-md-12">             
                 <div class="row">
          <div class="col-md-12">
            <div class="tile">
              <div class="tile-body">
                <div class="table-responsive">

                  <table class="table table-hover table-bordered" id="tableTratamiento">
                    <thead>
                      <tr class="tableEncabezado" >

                        <th  id="tamañoFuente">Id</th>
                        <th  id="tamañoFuente">Código</th>
                        <th  id="tamañoFuente">Tipo de Baño</th>
                        <th  id="tamañoFuente">Fecha Baño</th>
                        <th  id="tamañoFuente">Tipo Desp.</th>
                        <th  id="tamañoFuente">Fecha Desp.</th>
                        <th  id="tamañoFuente">Tipo Vacun.</th>
                        <th  id="tamañoFuente">Fecha Vacun.</th>
                        <th id="acciones" >Acciones</th>

                      </tr>
                    </thead>
                    <tbody>
                    </div>  
                  </tr>
                </tbody>
              </table>      
</main>




<?php footerAdmin($data);?>