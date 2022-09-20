
<?php headerAdmin($data);
      getModal('modalProduccion',$data);

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

                  <table class="table table-hover table-bordered" id="tableProduccion">
                    <thead>
                      <tr class="tableEncabezado" >
                        <th  id="tamañoFuente">Código</th>
                        <th  id="tamañoFuente">Nombre Ordeñador</th>
                        <th  id="tamañoFuente">Litros</th>
                        <th  id="tamañoFuente">Horario</th>
                        <th  id="tamañoFuente">Fecha ordeño.</th>

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