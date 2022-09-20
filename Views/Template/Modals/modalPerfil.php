<!-- Modal PARA INGRESAR UN NUEVO USUARIO-->
<div class="modal fade" id="modalFormPerfil" tabindex="-1" role="dialog"  aria-hidden="true">
  <div class="modal-dialog modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header headerUpdate">
        <h5 class="modal-title" id="titleModal">Actualizar Usuario</h5>
        <button type="button"  class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button> 
      </div>
      <div class="modal-body">
        
        
            <div class="tile-body">
              <form id="formPerfil" name="formPerfil" class="form-horizontal">
          
                <p class="text-primary">Todos los campos con asteriscos (<span class="required">*</span>) son obligatorios</p>
                
                <div class="form-row">
                  <div class="form-group col-md-6">
                   <label for="" ></label>
                    <label for="txtCedula">Cédula <span class="required">*</span></label>
                    <input  type="text" class="form-control valid validNumber" id="txtCedula" name="txtCedula" placeholder="Ingrese la cédula" value="<?= $_SESSION['userData']['cedula'];?>" onkeypress="return controlTag(event);">
                  </div>
                </div>
                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label for="txtNombre">Nombres <span class="required">*</span></label>
                    <input type="text" class="form-control valid validText" id="txtNombre" name="txtNombre" placeholder="Ingrese sus nombres" value="<?= $_SESSION['userData']['nombres']; ?>"required="">
                  </div>
                  <div class="form-group col-md-6">
                    <label for="txtApellido">Apellidos <span class="required">*</span></label>
                    <input type="text" class="form-control valid validText" id="txtApellido" name="txtApellido"placeholder="Ingrese sus apellidos" value="<?= $_SESSION['userData']['apellidos']; ?>" required="">
                  </div>
                </div>

                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label for="txtTelefono">Teléfono <span class="required">*</span></label>
                    <input type="text" class="form-control valid validNumber" id="txtTelefono" name="txtTelefono" placeholder="Ingrese el numero de telefono" value="<?= $_SESSION['userData']['telefono']; ?>" required="" onkeypress="return controlTag(event);">
                  </div>
                  <div class="form-group col-md-6">
                    <label for="txtEmail">Email</label>
                    <input type="email" class="form-control  valid validEmail" id="txtEmail" name="txtEmail" placeholder="Ingrese el correo" value="<?= $_SESSION['userData']['email_user']?>" required="" readonly disabled>
                  </div>
                
                <div class="form-group col-md-6">
                  <label for="txtPassword">Contraseña</label>
                  <input type="password" class="form-control" id="txtPassword" name="txtPassword" placeholder=" contraseña mayor a 8 caracteres" >

            </div>
             <div class="form-group col-md-6">
                  <label for="txtPassword">Confirmar contraseña</label>
                  <input type="password" class="form-control" id="txtConfirmPassword" name="txtConfirmPassword" placeholder=" contraseña mayor a 8 caracteres" >
                  
            </div>

             </div>
             
            <div class="tile" >
              <button  id="btnActionForm"   class="btn btn-info" type="submit" class="button"><i class="fa fa-fw fa-lg fa-check-circle"></i><span id="btnText">Actualizar</span></button>&nbsp;&nbsp;&nbsp;

              <button class="btn btn-danger" type="button" data-dismiss="modal"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cerrar</button>
            </div> 
           </div> 
          </form>
        </div>
      </div>
     </div>
    </div>
  </div>
</div>