

<!-- Modal PARA INGRESAR UN NUEVO USUARIO-->
<div class="modal fade" id="modalFormEmpleado" tabindex="-1" role="dialog"  aria-hidden="true">
  <div class="modal-dialog modal-dialog modal-lg">
    <div class="modal-content ancho">
      <div class="modal-header headerRegister">

        <h5 class="modal-title" id="titleModal">Nueva res</h5>

        <button type="button"  class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body "> 

        <div class="tile-body">

          <form id="formEmpleado" name="formEmpleado" class="form-horizontal" enctype="multipart/form-data">

            <input type="hidden" id="idGanado" name="idGanado" value="">
            <p class="text-primary">Todos los campos con asteriscos (<span class="required">*</span>) son obligatorios</p>

            <!-- fila 1 -->
            <div class="form-row">
              <div class="form-group col-md-3">
                <label for="" ></label>
                <label for="txtCedula">Cédula <span class="required">*</span></label>
                <input  type="text" class="form-control valid validNumber" for="inputSuccess1" id="txtCedula" name="txtCedula" onkeypress="return controlTag(event);">
              </div>

              <div class="form-group col-md-3">
                <label for="txtNombres">Nombres <span class="required">*</span></label>
                <input type="text" class="form-control valid validText" id="txtNombres" name="txtNombres" >
              </div>

              <div class="form-group col-md-3">
                <label for="txtApellidos">Apellidos<span class="required">*</span></label>
                <input type="text" class="form-control valid validText" id="txtApellidos" name="txtApellidos">
              </div>

               <div class="form-group col-md-3">
                <label for="txtCorreo">Correo electrónico<span class="required">*</span></label>
                <input type="email" class="form-control valid validEmail" id="txtCorreo" name="txtCorreo">
              </div>
              
            </div>

            <!-- fila 2 -->
            <div class="form-row">

              <div class="form-group col-md-3">
                <label for="txtContacto">Contacto<span class="required">*</span></label>
                <input type="text" class="form-control valid validNumber" id="txtContacto" name="txtContacto" onkeypress="return controlTag(event);">
              </div>
              <div class="form-group col-md-3">
                <label for="txtEdad">Edad (años)<span class="required">*</span></label>
                <input type="text" class="form-control validNumber" id="txtEdad" name="txtEdad" onkeypress="return controlTag(event);">
              </div>
              <div class="form-group col-md-3">
                <label for="txtCargo">Cargo<span class="required">*</span></label>
                <input type="text" class="form-control valid validText" id="txtCargo" name="txtCargo">
              </div>

              <div class="form-group col-md-3">
                <label  for="listStatus">Estado<span class="required">*</span></label>
                <select class="form-control selectpicker" id="listStatus" name="listStatus" class="custom-select">
                  <option selected disabled value="">Selleccione...</option>
                  <option value="1">Activa</option>
                  <option value="2">Inactiva</option>
            
                </select>
              </div>
  
            </div>


            <div class="form-row">
              <div class="form-group col-md-6 ">
                <label for="txtObservacion">Observacion: </label>
                <textarea class="form-control" id="txtObservacion" name="txtObservacion" rows="4" placeholder="Escriba su observacion..."></textarea>
              </div>
              <div class="form-group col-md-2 foto">

                <input type="file" name="fotoEmpleado" class="d-none" id="fotoEmpleado">
                <label for="fotoEmpleado" class="d-none d-md-block col-md-4 col-lg-3 ">
                  <img src="<?= media()?>/images/uploads/imagenResDefault.png" style="width:230px; height:100px;" class="prevFotoRes">
                </label>
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
</div>
<!-- Modal PARA MOSTRAR DATOS DE USUARIO-->
<div class="modal fade" id="modalViewEmpleado" tabindex="-1" role="dialog"  aria-hidden="true">
  <div class="modal-dialog Modal-lg">
    <div class="modal-content">
      <div class="modal-header header-primary">
        <h5 class="modal-title" id="titleModal">Datos del Empleado</h5>
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
              <td id="celNombres"></td>
            </tr>
            <tr>
              <td class="negrita">Apellidos</td>
              <td id="celApellidos"></td>
            </tr> 
            <tr>
              <td class="negrita">Correo</td>
              <td id="celCorreo"></td>
            </tr>
            <tr>
              <td class="negrita">Contacto</td>
              <td id="celContacto"></td>
            </tr>
            <tr>
              <td class="negrita">Edad</td>
              <td id="celEdad"></td>
            </tr>
            <tr>
              <td class="negrita">Cargo</td>
              <td id="celCargo"></td>
            </tr>
            <tr>
              <td class="negrita">Observación</td>
              <td id="celObservacion"></td>
            </tr>
            <tr>
              <td class="negrita">Estado</td>
              <td id="celEstado"></td>
            </tr>
            <tr>
              <td class="negrita">Foto</td>
              <td id="celFotoEmpleado"></td>
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