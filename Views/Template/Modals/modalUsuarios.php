<!-- Modal PARA INGRESAR UN NUEVO USUARIO-->
<div class="modal fade" id="modalFormUsuario" tabindex="-1" role="dialog"  aria-hidden="true">
  <div class="modal-dialog modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header headerRegister">
        <h5 class="modal-title" id="titleModal">Nuevo Usuario</h5>
        <button type="button"  class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span> 
        </button>
      </div>
      <div class="modal-body">
        
            <div class="tile-body">
              <form id="formUsuario" name="formUsuario" class="form-horizontal">
                <input type="hidden" id="idUsuario" name="idUsuario" value="">
                 <p class="text-primary">Todos los campos con asteriscos (<span class="required">*</span>) son obligatorios</p>
               
                <div class="form-row">
                  
                  <div class="form-group col-md-6">
                   <label for="" ></label>
                    <label for="txtCedula">Cédula<span class="required">*</span></label>
                    <input  type="text" class="form-control valid validNumber" for="inputSuccess1" id="txtCedula" name="txtCedula" placeholder="Ingrese la cédula" onkeypress="return controlTag(event);">
                   
                  </div>

                <div class="form-group col-md-6">
                  <label for="txtPassword">Contraseña<span class="required">*</span></label>
                  <input type="password" class="form-control" id="txtPassword" name="txtPassword" placeholder=" contraseña mayor a 8 caracteres" >
                  
                
                </div>
                </div>

                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label for="txtNombre">Nombres<span class="required">*</span></label>
                    <input type="text" class="form-control valid validText" id="txtNombre" name="txtNombre" placeholder="Ingrese sus nombres">
                  </div>
                  <div class="form-group col-md-6">
                    <label for="txtApellido">Apellidos<span class="required">*</span></label>
                    <input type="text" class="form-control valid validText" id="txtApellido" name="txtApellido"placeholder="Ingrese sus apellidos" >
                  </div>
                </div>

                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label for="txtTelefono">Teléfono<span class="required">*</span></label>
                    <input type="text" class="form-control valid validNumber" id="txtTelefono" name="txtTelefono" placeholder="Ingrese el numero de telefono"onkeypress="return controlTag(event);">
                  </div>
                  <div class="form-group col-md-6">
                    <label for="txtEmail">Email<span class="required">*</span></label>
                    <input type="email" class="form-control valid validEmail" id="txtEmail" name="txtEmail" placeholder="Ingrese el correo">
                  </div>
                </div>
                
                <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="listRolid">Tipo usuario<span class="required">*</span></label>
                  <select class="form-control " data-live-search="true=" id="listRolid" name="listRolid">
                    
                 </select>
                </div>

                <div class="form-group col-md-6">
                  <label  for="listStatus">status<span class="required">*</span></label>
                  <select class="form-control selectpicker" id="listStatus" name="listStatus" >
                    <option value="1">Activo</option>
                    <option value="2">Inactivo</option>
                 </select>
                </div>
            </div>

            
              </div>
            <div class="tile" >
              <button  id="btnActionForm" class="btn btn-primary" type="submit" class="button" ><i class="fa fa-fw fa-lg fa-check-circle"></i><span id="btnText">Guardar</span></button>&nbsp;&nbsp;&nbsp;

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
<!-- Modal PARA MOSTRAR DATOS DE USUARIO-->
<div class="modal fade" id="modalViewUser" tabindex="-1" role="dialog"  aria-hidden="true">
  <div class="modal-dialog Modal-lg">
    <div class="modal-content">
      <div class="modal-header header-primary">
        <h5 class="modal-title" id="titleModal">Datos del Usuario</h5>
        <button type="button"  class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      
          
         <table class= "table table-bordered">
           <tbody>
                 
                 <tr>
                      <td>Cedula</td>
                      <td id="celCedula"></td>
                 </tr>
                 <tr>
                      <td>Nombres</td>
                      <td id="celNombre"></td>
                 </tr>
                 <tr>
                      <td>Apellidos</td>
                      <td id="celApellido"></td>
                 </tr>  
                 <tr>
                      <td>Telefono</td>
                      <td id="celTelefono"></td>
                 </tr>
                 <tr>
                      <td>Email</td>
                      <td id="celEmail"></td>
                 </tr>
                 <tr>
                      <td>Tipo de Usuario</td>
                      <td id="celTipoUsuario"></td>
                 </tr>
                 <tr>
                      <td>Estado</td>
                      <td id="celEstado"></td>
                 </tr>
                 <tr>
                      <td>Fecha de registro</td>
                      <td id="celFechaRegistro"></td>
                 </tr>
           </tbody>
         </table>
     </div>
     <div class="modal-footer">
        <button class="btn btn-secondary" type="button" data-dismiss="modal"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cerrar</button>
     </div>
    </div>
  </div>
</div>
</div>