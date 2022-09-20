
<?php headerAdmin($data); 
      getModal('modalUsuarios',$data);


if(isset($_GET["deRango"]) && isset($_GET["hastaRango"])){

  $deRango = $_GET["deRango"];
  $hastaRango = $_GET["hastaRango"];

}else{
  
  $deRango = date("Y-m-d", strtotime(" -1 year", strtotime(date("Y-m-d"))));
  $hastaRango = date("Y-m-d");


}?>

<input type="hidden" id="deRango" value="<?php echo $deRango ?>">
<input type="hidden" id="hastaRango" value="<?php echo $hastaRango ?>">
 
  <main class="app-content">
  <meta charset="UTF-8">
      <div class="app-title">
        <div>
          <h1><i class="fas fa-user-tag"></i> <?= $data['page_title'] ?> 

         
</h1>
<p>Control general del sistema</p>
</div>
<ul class="app-breadcrumb breadcrumb">
  <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
  <li class="breadcrumb-item"><a href="<?= base_url();  ?>/usuarios"><?= $data['page_title'] ?></a></li>
</ul>
</div>


<div class="row">
  <div class="col-md-12">
    <div class="tile">
      <div class="tile-body">

<div class="card">
  <div class="card-header"> 
     <?php  if ($_SESSION['permisosMod']['w']){   ?>
        <button class="btn btn-primary " type="button" onclick="openModal();">Nuevo <i class="fas fa-plus-circle"></i></button>

            <?php } ?>

          <!-- Boton para filtrar por rangos de fecha -->
             <div class="card-tools">
              <div class="d-flex">
                <div class="d-flex mr-2">     
                  <div class="input-group" class="card-header">
                   
                  <button type="button" class="btn btn-primary"  id="daterange-btn" >
                       <i class="far fa-calendar-alt mr-2"></i><?php echo  $deRango?> - <?php echo  $hastaRango?><i class="fas fa-caret-down ml-2"></i>
                   </button>

                     </div>
                  </div>
                </div>
              </div>
            </div>
          </div>


        <div class="table-responsive">
          <table class="table table-hover table-bordered" id="tableUsuarios">
            <thead>
              <tr>
                <th >Cédula</th>
                <th >Nombres</th>
                <th >Apellidos</th>
                <th >Emáil</th>
                <th >Rol</th>
                <th >Estado</th>
                <th >Teléfono</th>
                <th id="acciones" >Acciones</th>
              </tr>
            </thead>
            <tbody>      
              <tr>
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