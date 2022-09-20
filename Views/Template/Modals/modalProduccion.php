
  <meta charset="utf-8">
  <!-- Modal PARA INGRESAR UN NUEVO USUARIO-->
  <div class="modal fade" id="modalFormProduccion" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog  modal-lg">
      <div class="modal-content ancho">
        <div class="modal-header headerRegister">
          <h5 class="modal-title" id="titleModal">Nuevo ordeño</h5>
          <button type="button"  class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body ">
          <div class="tile">
            <div class="tile-body">
             <form id="formProduccion" name="formProduccion" class="form-horizontal" enctype="multipart/form-data">
              <input type="hidden" id="idProduccion" name="idProduccion">
              <input  type="hidden"  id="idganado" name="idganado">

              <!-- fila 1 -->
              <div class="form-row">
                <div class="form-group col-md-3">
                  <label for="" ></label>
                  <label for="txtCodigo">Código </span></label>
                  <input  type="text" class="form-control" id="txtCodigo" name="txtCodigo" placeholder="Código de res" >
                </div>   

                <div class="form-group col-md-2">
                  <label for="" ></label>
                  <label for="txtCodigo">Nombre </span></label>
                  <input  type="text" class="form-control" id="txtNombre" name="txtNombre" disabled="">

                </div>

                <div class="form-group col-md-3">
                  <label for="" ></label>
                  <label for="txtCodigo">Categoría </span></label>
                  <input  type="text" class="form-control"  id="txtCategoria" name="txtCategoria" disabled>
                </div>

                <div class="form-group col-md-2">
                  <label for="" ></label>
                  <label for="txtCodigo">Peso </span></label>
                  <input  type="text" class="form-control"  id="txtPeso" name="txtPeso" disabled>
                </div>

                <div class="form-group col-md-2">
                  <label for="" ></label>
                  <label for="txtCodigo">Raza </span></label>
                  <input  type="text" class="form-control"  id="txtRaza" name="txtRaza" disabled>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-12">        
            <div class="tile"> 
              <div class="form-row">

                <div class="form-group col-md-3">
                  <label for="nomOrdeñador">Nombre ordeñador <span class="required">*</span></label>
                  <select class="form-control" id="nomOrdeñador" name="nomOrdeñador">
                    <option selected disabled value="">Selleccione...</option>
                  
                   <?php foreach ($data['empleados'] as $key => $value):?>
                    <option value="<?php echo $value['nombres'] ?>"><?php echo $value['nombres'] ?></option>
                  <?php endforeach; ?>
                 
                  </select>
                </div>

                <div class="form-group col-md-3">
                  <label for="cantLitros">Litros ordeñados <span class="required">*</span></label>
                   <input  type="text" class="form-control" id="cantLitros" name="cantLitros">
                </div> 
  
               <div class="form-group col-md-3">
                  <label for="horario">Horario <span class="required">*</span></label>
                  <select class="form-control" id="horario" name="horario">
                    <option selected disabled value="">Selleccione...</option>
                    <option value="Mañana">Mañana</option> 
                     <option value="Tarde">Tarde</option>             
                  </select>
                </div>

                <div class="form-group col-md-3">
                  <label for="fechaOrdeño">Fecha ordeño <span class="required">*</span></label>
                  <input type="text" class="form-control" id="fechaOrdeño" name="fechaOrdeño"  autocomplete="off" >
                </div> 
 
              </div>
              <div class="form-row">
                <div class="form-group col-md-6 ">
                  <label for="txtObservacion">Observacion: </label>
                  <textarea class="form-control" id="txtObservacion" name="txtObservacion" rows="3" placeholder="Escriba su observacion..." ></textarea>
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
  <div class="modal fade" id="modalViewProduccion" tabindex="-1" role="dialog"  aria-hidden="true">
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
                <td class="negrita">Código</td>
                <td id="celCodigo"></td>
              </tr>
              <tr>
                <td  class="negrita">Nombre ordeñador</td>
                <td id="celNomOrdeñador"></td>
              </tr>
              <tr>
                <td class="negrita">Cantidad litros</td>
                <td id="celCantLitros"></td>
              </tr> 
              <tr>
                <td class="negrita">Horario</td>
                <td id="celHorario"></td>
              </tr>
              <tr>
                <td class="negrita">Fecha ordeño</td>
                <td id="celFechaOrdeño"></td>
              </tr>         
              <tr>
                <td class="negrita">Observacion</td>
                <td id="celObserv"></td>
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

