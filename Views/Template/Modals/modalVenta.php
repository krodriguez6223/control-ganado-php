
<meta charset="utf-8">
    <!-- Modal PARA INGRESAR UN NUEVO USUARIO-->
    <div class="modal fade" id="modalFormTratamiento" tabindex="-1" role="dialog"  aria-hidden="true">
      <div class="modal-dialog  modal-lg">
        <div class="modal-content">
          <div class="modal-header headerRegister">

            <h5 class="modal-title" id="titleModal">Nuevo tratamiento</h5>
    
    

            <button type="button"  class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body ">

            <div class="tile">

              <div class="tile-body">

               <form id="formTratamiento" name="formTratamiento" class="form-horizontal" enctype="multipart/form-data">
                  <input type="hidden" id="idTratamiento" name="idTratamiento">
                  <input  type="hidden"  id="idganado" name="idganado">
                  <input  type="hidden"  id="status" name="status">

                 <!-- fila 1 -->
                 <div class="form-row">
                  <div class="form-group col-md-3">
                    <label for="" ></label>
                    <label for="txtCedula">Cédula </span></label>
                    <input  type="text" class="form-control" id="txtCedula" name="txtCedula" placeholder="Código de res" >
                  </div>
             
                  <div class="form-group col-md-3">
                    <label for="txtNombre" ></label>
                    <label for="txtNombre">Nombre </span></label>
                    <input  type="text" class="form-control" id="txtNombre" name="txtNombre" disabled="">
                    
                  </div>

                  <div class="form-group col-md-3">
                    <label for="" ></label>
                    <label for="txtApellidos">Apellidos </span></label>
                    <input  type="text" class="form-control"  id="txtApellidos" name="txtApellidos" disabled>
                  </div>

                  <div class="form-group col-md-3">
                    <label for="txtContacto" ></label>
                    <label for="txtContacto">Contacto </span></label>
                    <input  type="text" class="form-control"  id="txtContacto" name="txtContacto" disabled>
                  </div>
                </div>
              </div>
            </div>


            <div class="col-lg-12">
              <h4>Ventas</h4>
                  <div class="tile">                
                      <div class="form-row">               

                        <div class="form-group col-md-3">
                        <label for="txtLote">Lote <span class="required">*</span></label>
                        <input type="text" class="form-control" id="txtLote" name="txtLote"  >
                         </div> 

                        <div class="form-group col-md-3">
                        <label for="fechaProxBanio">Fecha Prox. baño <span class="required">*</span></label>
                        <input type="text" class="form-control" id="fechaProxBanio" name="fechaProxBanio"  autocomplete="off" disabled="">
                         </div>     
                      </div>
                      <div class="form-row">
                      <div class="form-group col-md-6 ">
                  <label for="txtObservacion">Observacion: </label>
                  <textarea class="form-control" id="txtObservacion" name="txtObservacion" rows="3" placeholder="Escriba su observacion..." disabled=""></textarea>
                </div>
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
    </div>


  
    <!-- Modal PARA MOSTRAR DATOS DE USUARIO-->
    <div class="modal fade" id="modalViewTratamiento" tabindex="-1" role="dialog"  aria-hidden="true">
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
                  <td  class="negrita">Tipo de baño</td>
                  <td id="celTipoBanio"></td>
                </tr>
                <tr>
                  <td class="negrita">Tipo de medicina</td>
                  <td id="celTipoMedicina"></td>
                </tr> 
                <tr>
                  <td class="negrita">Fecha de baño</td>
                  <td id="celFechaBanio"></td>
                </tr>
                <tr>
                  <td class="negrita">Fecha Prox. baño</td>
                  <td id="celFechaProxBanio"></td>
                </tr>
                <tr>
                  <td class="negrita">Observación Baño</td>
                  <td id="celObservBanio"></td>
                </tr>
                <!-- Tratamiento Desparasitacion-->
               <tr>
                  <td  class="negrita">Tipo de desparasitación</td>
                  <td id="celTipoDesparasitacion"></td>
                </tr>
                <tr>
                  <td class="negrita">Desparasitante</td>
                  <td id="celTipoDesparasitante"></td>
                </tr> 
                <tr>
                  <td class="negrita">Fecha de desparasitación</td>
                  <td id="celFechaDesparasitación"></td>
                </tr>
                <tr>
                  <td class="negrita">Fecha Prox. desparasitación</td>
                  <td id="celFechaProxDesparasitacion"></td>
                </tr>
                <tr>
                  <td class="negrita">Observación desparasitación</td>
                  <td id="celObservDesparasitacion"></td>
                </tr>
                <!-- Tratamiento Vacunacion-->
                <tr>
                  <td  class="negrita">Tipo de vacunación</td>
                  <td id="celTipoVacunacion"></td>
                </tr>
                <tr>
                  <td class="negrita">Nombre vacuna</td>
                  <td id="celNomVacuna"></td>
                </tr> 
                <tr>
                  <td class="negrita">Fecha vacunación</td>
                  <td id="celFechaVacunacion"></td>
                </tr>
                <tr>
                  <td class="negrita">Fecha Prox. vacunación</td>
                  <td id="celFechaProxVacunacion"></td>
                </tr>
                <tr>
                  <td class="negrita">Observación vacunación</td>
                  <td id="celObservVacunacion"></td>
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

      