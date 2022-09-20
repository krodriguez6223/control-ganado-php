<?php
      headerAdmin($data);

      getModal('modalPerfil',$data);


  ?>
  
     <main class="app-content">
   
      <div class="row user">
        <div class="col-md-12">
            <form id="formFoto" name="formFoto" method="post" enctype="multipart/form-data">
            <div class="profile">
             

              <div class="info">
              
              <label for="fotoPerfil" class="d-none d-md-block col-md-4 col-lg-3">

                  <input 
                      type="file" 
                      name="fotoPerfil" 
                      class="d-none" 
                      id="fotoPerfil"
                      accept="image/*"  
                      onchange="validateImageJS(event,'changePicture')">
      
                  <?php  if (empty($_SESSION['userData']['foto'])){ ?>

                 <img src="<?= media(); ?>/images/users/default.png" class="img-fluid mt-md-3 mt-xl-2 changePicture elevation-2" style="width:110px">

              </label>
                <?php }else{ ?>

                <img src="<?= media(); ?>/images/users/<?php echo($_SESSION['userData']['foto']) ?>" class="img-fluid mt-md-3 mt-xl-2 changePicture elevation-2" style="width:110px">

                  </label>
             
                <?php } ?>

                <h4><?= $_SESSION['userData']['nombres']?></h4>
                <p><?= $_SESSION['userData']['nombrerol']?></p>

                 <button class="btn btn-info btn-sm rounded-circle"><i class="fas fa-pencil-alt"></i></button>
              </form>
            </div>
            <div class="cover-image"></div>
          </div>
        </div>

       
        <div class="col-md-3">
          <div class="tile p-0">
            <ul class="nav flex-column nav-tabs user-tabs">
              <li class="nav-item"><a class="nav-link active" href="#DatosPersonales" data-toggle="tab">



              Datos personales</a></li>
              <li class="nav-item"><a class="nav-link" href="#DatosFiscales" data-toggle="tab">Datos fiscales</a></li>
            </ul>
          </div>
        </div>
        <div class="col-md-9">
          <div class="tab-content">
            <div class="tab-pane active" id="DatosPersonales">
              <div class="timeline-post"> 
                
                  <?php if ($_SESSION['permisos'][2]['w']){ ?>
                <h5>Datos personales <button class="btn btn-sm btn-info" type="submit" onclick="openModalPerfil();"><i class="fas fa-pencil-alt"></i></button></h5>
              <?php } ?>
                 
             
                <table class="table table-bordered">
                	<tbody>
                		<tr> 
                			<td style="width: 150px;">Cedula:</td>
                			<td  id="celIdentificacion" ><?= $_SESSION['userData']['cedula'];  ?></td>
                		</tr>
                		<tr> 
                			<td>Nombres:</td>
                			<td  id="celNombre" ><?= $_SESSION['userData']['nombres'];  ?></td>
                		</tr>
                		<tr> 
                			<td>Apellidos:</td>
                			<td  id="celApellido" ><?= $_SESSION['userData']['apellidos'];  ?></td>
                		</tr>
                		<tr> 
                			<td>Teléfono:</td>
                			<td  id="celApellido" ><?= $_SESSION['userData']['telefono'];  ?></td>
                		</tr>
                		<tr> 
                			<td>Email:</td>
                			<td  id="celEmail" ><?= $_SESSION['userData']['email_user'];  ?></td>
                		</tr>
                		<tr> 
                			<td>Tipo usuario:</td>
                			<td  id="celTipoUsuario" ><?= $_SESSION['userData']['nombrerol'];  ?></td>
                		</tr>

                	</tbody>
                </table>
            
          </div>
               </div>
            <div class="tab-pane fade" id="DatosFiscales">
              <div class="tile user-settings">
                
                <h4 class="line-head">Datos Fiscales</h4>
                <form>
                  <div class="row mb-4">
                    <div class="col-md-6">
                      <label>Identificación tributaria</label>
                      <input id="txtCedulaTributaria" name="txtCedulaTributaria" class="form-control" type="text">
                    </div>
                    <div class="col-md-6">
                      <label>Nombre fiscal</label>
                      <input id="txtNombreFiscal" name="txtNombreFiscal" class="form-control" type="text">
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12 mb-4">
                      <label>Dirección fiscal</label>
                      <input id="direccionFiscal" name="direccionFiscal" class="form-control" type="text">
                    </div>
                    <div class="col-md-12">

                      <button class="btn btn-primary" type="button"><i class="fa fa-fw fa-lg fa-check-circle"></i> Guardar</button>
                   </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>    
    <?php footerAdmin($data);?>