

<!-- Modal PARA INGRESAR UN NUEVO USUARIO-->
<div class="modal fade" id="modalFormInventario" tabindex="-1" role="dialog"  aria-hidden="true">
  <div class="modal-dialog modal-dialog modal-lg">
    <div class="modal-content ancho">
      <div class="modal-header headerRegister">

        <h5 class="modal-title" id="titleModal">Nuevo producto</h5>

        <button type="button"  class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span> 
        </button>
      </div>
      <div class="modal-body ">

        <div class="tile-body">

          <form id="formInventario" name="formInventario" class="form-horizontal" enctype="multipart/form-data">

            <input type="hidden" id="idGanado" name="idGanado" value="">
            <p class="text-primary">Todos los campos con asteriscos (<span class="required">*</span>) son obligatorios</p>

            <!-- fila 1 -->
            <div class="form-row">
              <div class="form-group col-md-3">
                <label for="" ></label>
                <label for="txtCodigo">Código <span class="required">*</span></label>
                <input  type="text" class="form-control valid validCodigo" for="inputSuccess1" id="txtCodigo" name="txtCodigo" >
              </div>

              <div class="form-group col-md-6">
                <label for="txtNombre">Nombre <span class="required">*</span></label>
                <input type="text" class="form-control" id="txtNombre" name="txtNombre" >
              </div>
         
              <div class="form-group col-md-3">
                <label for="txtStock">Stock <span class="required">*</span></label>
                <input type="text" class="form-control" id="txtStock" name="txtStock">
              </div>
            </div>

              <div class="form-row">

               <div class="form-group col-md-6">
                <label  for="listStatus">Estado<span class="required">*</span></label>
                <select class="form-control selectpicker" id="listStatus" name="listStatus" class="custom-select">
                  <option selected disabled value="">Selleccione...</option>
                  <option value="1">Activo</option>
                  <option value="2">Inactivo</option>
                </select>
                </div>

                <div class="form-group col-md-6">

                <label  for="listCategoria">Categoria<span class="required">*</span></label>
                <select class="form-control selectpicker" id="listCategoria" name="listCategoria" class="custom-select">
                  <option selected disabled value="">Selleccione...</option>
                  <option value="tipo 1">tipo 1</option>
                  <option value="tipo 2">tipo 2</option>
                </select>
              
               </div> 
              
            </div>  

            <div class="form-row">
              <div class="form-group col-md-6 ">
                <label for="txtDescripcion">Descripción: </label>
                <textarea class="form-control" id="txtDescripcion" name="txtDescripcion" rows="4" placeholder="Escriba el detalle del producto..."></textarea>
              </div>
              <div class="form-group col-md-2 foto">

                <input type="file" name="fotoProducto" class="d-none" id="fotoProducto">
                <label for="fotoProducto" class="d-none d-md-block col-md-4 col-lg-3 ">
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
<div class="modal fade" id="modalViewInventario" tabindex="-1" role="dialog"  aria-hidden="true">
  <div class="modal-dialog Modal-lg">
    <div class="modal-content">
      <div class="modal-header header-primary">
        <h5 class="modal-title" id="titleModal">Datos del producto</h5>
        <button type="button"  class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">


        <table class= "table table-bordered">
          <tbody>

            <tr>
              <td class="negrita">Código</td>
              <td id="celCodigo"></td>
            </tr>
            <tr>
              <td  class="negrita">Nombre</td>
              <td id="celNombre"></td>
            </tr>
            <tr>
              <td class="negrita">Stock</td>
              <td id="celStock"></td>
            </tr> 
            <tr>
              <td class="negrita">Categoría</td>
              <td id="celCategoria"></td>
            </tr>
            <tr>
              <td class="negrita">Estado</td>
              <td id="celEstado"></td>
            </tr>
            <tr>
              <td class="negrita">Descripción</td>
              <td id="celDescripcion"></td>
            </tr>
            <tr>
              <td class="negrita">Foto</td>
              <td id="celFoto"></td>
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