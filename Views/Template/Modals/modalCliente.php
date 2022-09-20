
  <meta charset="utf-8">
  <!-- Modal PARA INGRESAR UN NUEVO CLIENTE-->
  <div class="modal fade" id="modalFormCliente" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog  modal-dialog modal-lg">
      <div class="modal-content ancho">
        <div class="modal-header headerRegister">
          <h5 class="modal-title" id="titleModal">Nuevo cliente</h5>
          <button type="button"  class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body ">
          <div class="tile">
            <div class="tile-body">
             <form id="formCliente" name="formCliente" class="form-horizontal" enctype="multipart/form-data">
              <input type="hidden" id="idCliente" name="idCliente">
               <p class="text-primary">Todos los campos con asteriscos (<span class="required">*</span>) son obligatorios</p>
            
             <div class="form-row">
                  <div class="form-group col-md-6">
                   <label for="txtCedula" ></label>
                    <label for="txtCedula">Cédula<span class="required">*</span></label>
                    <input  type="text" class="form-control" for="inputSuccess1" id="txtCedula" name="txtCedula" placeholder="Ingrese la cédula">
             </div>

                <div class="form-group col-md-6">
                  <label for="txtDireccion">Direccion<span class="required">*</span></label>
                  <input type="text" class="form-control" id="txtDireccion" name="txtDireccion" placeholder=" ingrese la dirección" >
                  
                
                </div>
                </div>

                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label for="txtNombre">Nombres<span class="required">*</span></label>
                    <input type="text" class="form-control" id="txtNombre" name="txtNombre" placeholder="Ingrese sus nombres">
                  </div>
                  <div class="form-group col-md-6">
                    <label for="txtApellido">Apellidos<span class="required">*</span></label>
                    <input type="text" class="form-control" id="txtApellido" name="txtApellido"placeholder="Ingrese sus apellidos" >
                  </div>
                </div>

                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label for="txtTelefono">Teléfono<span class="required">*</span></label>
                    <input type="text" class="form-control" id="txtTelefono" name="txtTelefono" placeholder="Ingrese el numero de telefono">
                  </div>
                  <div class="form-group col-md-6">
                    <label for="txtEmail">Email<span class="required">*</span></label>
                    <input type="email" class="form-control" id="txtEmail" name="txtEmail" placeholder="Ingrese el correo">
                  </div>
                </div>
                
                <div class="form-row">
                  <div class="form-group col-md-6 ">
                  <label for="txtObservacion">Observacion: </label>
                  <textarea class="form-control" id="txtObservacion" name="txtObservacion" rows="3" placeholder="Escriba su observacion..." ></textarea>
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
  
  
          <button  id="btnActionForm"   class="btn btn-primary" type="submit" class="button"><i class="fa fa-fw fa-lg fa-check-circle"></i><span id="btnText">Guardar</span></button>&nbsp;&nbsp;&nbsp;

          <button class="btn btn-danger" type="button" data-dismiss="modal"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cerrar</button>

        </div>
      </form>
    </div>
  </div>
  </div>
  </div>
</div>




  <!-- Modal PARA MOSTRAR DATOS DE USUARIO-->
  <div class="modal fade" id="modalViewCliente" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog Modal-lg">
      <div class="modal-content ">
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
                <td class="negrita">Cédula</td>
                <td id="celCedula"></td>
              </tr>
              <tr>
                <td  class="negrita">Nombres</td>
                <td id="celNombre"></td>
              </tr>
              <tr>
                <td class="negrita">Apellidos</td>
                <td id="celApellido"></td>
              </tr> 
              <tr>
                <td class="negrita">Teléfono</td>
                <td id="celTelefono"></td>
              </tr>
              <tr>
                <td class="negrita">Email</td>
                <td id="celEmail"></td>
              </tr>
              <tr>
                <td class="negrita">Dirección</td>
                <td id="celDireccion"></td>
              </tr> 
               <tr>
                <td class="negrita">Estado</td>
                <td id="celStatus"></td>
              </tr>          
              <tr>
                <td class="negrita">Observacion</td>
                <td id="celObservacion"></td>
              </tr>
              <tr>
                <td class="negrita">Fecha registro</td>
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

