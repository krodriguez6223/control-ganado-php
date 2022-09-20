

<!-- Modal PARA INGRESAR UN NUEVO USUARIO-->
<div class="modal fade" id="modalFormProveedor" tabindex="-1" role="dialog"  aria-hidden="true">
  <div class="modal-dialog modal-dialog modal-lg">
    <div class="modal-content ancho"> 
      <div class="modal-header headerRegister">

        <h5 class="modal-title" id="titleModal">Nuevo proveedor</h5>

        <button type="button"  class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body ">

        <div class="tile-body">

          <form id="formProveedor" name="formProveedor" class="form-horizontal" enctype="multipart/form-data">

            <input type="hidden" id="idGanado" name="idGanado" value="">
            <p class="text-primary">Todos los campos con asteriscos (<span class="required">*</span>) son obligatorios</p>

            <!-- fila 1 -->
            <div class="form-row">
              <div class="form-group col-md-4">
                <label for="" ></label>
                <label for="txtCedula">Cédula/Ruc<span class="required">*</span></label>
                <input  type="text" class="form-control valid validCodigo" for="inputSuccess1" id="txtCedula" name="txtCedula" >
              </div>

              <div class="form-group col-md-4">
                <label for="txtNombre">Nombres <span class="required">*</span></label>
                <input type="text" class="form-control" id="txtNombre" name="txtNombre" >
              </div>

              <div class="form-group col-md-4">
                <label for="txtContacto">Contacto<span class="required">*</span></label>
                <input type="text" class="form-control" id="txtContacto" name="txtContacto">
              </div>
            </div>

            <!-- fila 2 -->
            <div class="form-row">

              <div class="form-group col-md-4">
                <label for="txtDireccion">Dirección<span class="required">*</span></label>
                <input type="text" class="form-control" id="txtDireccion" name="txtDireccion">
              </div>

              <div class="form-group col-md-4">
                <label for="txtEmail">Correo electrónico<span class="required">*</span></label>
                <input type="email" class="form-control" id="txtEmail" name="txtEmail">
              </div>


              <div class="form-group col-md-4">
                <label for="listCategoria">Categoria <span class="required">*</span></label>
                <select class="form-control selectpicker" id="listCategoria" name="listCategoria" >
                 
                  <option selected disabled value="">Selleccione...</option>
                  <option value="Herramientas">Herramientas</option>
                  <option value="Insumos médicos">Insumos médicos</option>
                </select>
              </div>   
            </div>


            

            <div class="form-row">
              <div class="form-group col-md-8 ">
                <label for="txtObservacion">Observacion: </label>
                <textarea class="form-control" id="txtObservacion" name="txtObservacion" rows="3" placeholder="Escriba su observacion..."></textarea>
              </div>
              <div class="form-group col-md-4">
                  <label  for="listEstado">Estado</label>
                  <select class="form-control selectpicker" id="listEstado" name="listEstado" >
                    <option selected disabled value="">Selleccione...</option>
                    <option value="1">Activo</option>
                    <option value="2">Inactivo</option>
                 </select>
                </div>
              

            </div>

          <div class="tile">
            <button  id="btnActionForm"   class="btn btn-primary" type="submit" class="button"><i class="fa fa-fw fa-lg fa-check-circle"></i><span id="btnText">Guardar</span></button>&nbsp;&nbsp;&nbsp;

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
<div class="modal fade" id="modalViewProveedor" tabindex="-1" role="dialog"  aria-hidden="true">
  <div class="modal-dialog Modal-lg">
    <div class="modal-content">
      <div class="modal-header header-primary">
        <h5 class="modal-title" id="titleModal">Datos del proveedor</h5>
        <button type="button"  class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">


        <table class= "table table-bordered">
          <tbody>

            <tr>
              <td class="negrita">Código</td>
              <td id="celCedula"></td>
            </tr>
            <tr>
              <td  class="negrita">Nombre</td>
              <td id="celNombre"></td>
            </tr>
            <tr>
              <td class="negrita">Peso</td>
              <td id="celContacto"></td>
            </tr> 
            <tr>
              <td class="negrita">Especie</td>
              <td id="celDireccion"></td>
            </tr>
            <tr>
              <td class="negrita">Raza</td>
              <td id="celEmail"></td>
            </tr>
            <tr>
              <td class="negrita">Categoría</td>
              <td id="celCategoria"></td>
            </tr>
            <tr>
              <td class="negrita">Pelaje</td>
              <td id="celObservacion"></td>
            </tr>
            <tr>
              <td class="negrita">Origen</td>
              <td id="celEstado"></td>
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