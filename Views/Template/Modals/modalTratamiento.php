
<meta charset="utf-8">
    <!-- Modal PARA INGRESAR UN NUEVO USUARIO-->
    <div class="modal fade" id="modalFormTratamiento" tabindex="-1" role="dialog"  aria-hidden="true">
      <div class="modal-dialog  modal-lg">
        <div class="modal-content ancho">
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
                 <div class="form-row tec">
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
              <h4>Tratamiento de ganado</h4>
              <div class="bs-component">
                <ul class="nav nav-tabs">
                  <li class="nav-item" ><a class="nav-link active" data-toggle="tab" href="#baño" >Baño</a></li>
                  <li class="nav-item"><a class="nav-link "  data-toggle="tab" href="#desparacitacion">Desparacitación</a></li>
                  <li class="nav-item"><a class="nav-link " data-toggle="tab" href="#vacunacion">Vacunación</a></li>
                

                  <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 39px, 0px);"><a class="dropdown-item" href="#">Action</a><a class="dropdown-item" href="#">Another action</a><a class="dropdown-item" href="#">Something else here</a>
                    <div class="dropdown-divider"></div><a class="dropdown-item" href="#">Separated link</a>
                  </div>
                </li>
              </ul>
              <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade active show" id="baño" >
                  <div class="tile">


               <label class="switch">
                    <input type="checkbox" id="check_tratamientoBaño" name="check_tratamientoBaño" onclick="checkBaño()" checkBaño()>
                    <span class="slider round"></span>
              </label>
                   
                
                      <div class="form-row">
                        <div class="form-group col-md-3">
                          <label for="tipoBanio">Tipo baño <span class="required">*</span></label>
                          <select class="form-control" id="tipoBanio" name="tipoBanio" disabled="">

                            <option selected disabled value="">Selleccione...</option>
                            <option value="Aspersion">Aspersión (21 dias) </option>
                            <option value="Inmersion">Inmersión (45 dias) </option>

                          </select>
                        </div>

                        <div class="form-group col-md-3">
                          <label for="tipoMedica">Medicamento <span class="required">*</span></label>
                          <select class="form-control" id="tipoMedica" name="tipoMedica" disabled="">

                            <option selected disabled value="">Selleccione...</option>
                            <option value="ivermectinas">ivermectinas</option>
                            <option value="Inmersion">amidinas</option>

                          </select>
                        </div>

                        <div class="form-group col-md-3">
                        <label for="fechaBanio">Fecha baño <span class="required">*</span></label>
                        <input type="text" class="form-control" id="fechaBanio" name="fechaBanio"  autocomplete="off" disabled="">
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
                <div class="tab-pane fade" id="desparacitacion" >
                 <div class="tile">
                  
                 <label class="switch">
                    <input type="checkbox" id="check_trataDespa" name="check_trataDespa" onclick="checkDespara()" checkBaño()>
                    <span class="slider round"></span>
              </label>    
                     
                  <div class="form-row">

                      <div class="form-group col-md-3">
                        
                          <label for="tipoDesparasitacion">Tiempo de desparacitacion <span class="required">*</span></label>
                          <select class="form-control" id="tipoDesparasitacion" name="tipoDesparasitacion"  disabled="">

                            <option selected disabled value="">Selleccione...</option>
                           <option value="Porfdsg">Por 72 días </option>
                            <option value="Pordfgd">Por 80 días </option>

                          </select>
                        </div>

                        <div class="form-group col-md-3">
                          <label for="tipoDesparasitante">Desparasitante <span class="required">*</span></label>
                          <select class="form-control" id="tipoDesparasitante" name="tipoDesparasitante"  disabled="">

                            <option selected disabled value="">Selleccione...</option>
                            <option value="desparasitante1">desparasitante1</option>
                            <option value="desparasitante2">desparasitante2</option>

                          </select>
                        </div>

                        <div class="form-group col-md-3">
                        <label for="fechaDesparasitacion">Fecha desparasitación <span class="required">*</span></label>  
                        <input type="text" class="form-control" id="fechaDesparasitacion" name="fechaDesparasitacion"  autocomplete="off"  disabled="">
                         </div> 

                        <div class="form-group col-md-3">
                        <label for="fechaProxDesparasitacion">Fecha Prox. desparacitación <span class="required">*</span></label>
                        <input type="text" class="form-control" id="fechaProxDesparasitacion" name="fechaProxDesparasitacion"  autocomplete="off"  disabled="">
                         </div>     
                      </div>
                      <div class="form-row">
                      <div class="form-group col-md-6 ">
                  <label for="observDesparasitacion">Observacion: </label>
                  <textarea class="form-control" id="observDesparasitacion" name="observDesparasitacion" rows="3" placeholder="Escriba su observacion..."  disabled=""></textarea>
                </div>
             </div>
           </div>
        </div>
              <div class="tab-pane fade" id="vacunacion">
               <div class="tile">

                <label class="switch">
                    <input type="checkbox" id="check_trataVacun" name="check_trataVacun" onclick="check_trataVacuna()" checkBaño()>
                    <span class="slider round"></span>
              </label>
                
                   <div class="form-row">

                        <div class="form-group col-md-3">
                          <label for="nombreVacuna">Vacuna <span class="required">*</span></label>
                          <select class="form-control" id="nombreVacuna" name="nombreVacuna" disabled="">

                            <option selected disabled value="">Selleccione...</option>
                            <option value="nomnbrevacuna1">nomnbrevacuna1</option>
                            <option value="nomnbrevacuna2">nomnbrevacuna2</option>

                          </select>
                        </div>

                         <div class="form-group col-md-3">
                          <label for="tipoVacuna">Tipo vacunacion <span class="required">*</span></label>
                          <select class="form-control" id="tipoVacuna" name="tipoVacuna" disabled="">
                           
                            <option selected disabled value="">Selleccione...</option>
                            <option value="Triple">Triple</option>
                            <option value="Lactosa">Lactosa</option>
                          </select>
                        </div>

                        <div class="form-group col-md-3">
                        <label for="fechaVacunacion">Fecha vacunación <span class="required">*</span></label>
                        <input type="text" class="form-control" id="fechaVacunacion" name="fechaVacunacion"  autocomplete="off" disabled="">
                         </div> 

                        <div class="form-group col-md-3">
                        <label for="fechaProxVacuna">Fecha Prox. vacuna <span class="required">*</span></label>
                        <input type="text" class="form-control" id="fechaProxVacuna" name="fechaProxVacuna"  autocomplete="off" disabled="">
                         </div>     
                      </div>
                      <div class="form-row">
                      <div class="form-group col-md-6 ">
                  <label for="observVacunacion">Observacion: </label>
                  <textarea class="form-control" id="observVacunacion" name="observVacunacion" rows="3" placeholder="Escriba su observacion..." disabled=""></textarea>
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
            <h5 class="modal-title" id="titleModal">Datos del tratamiento</h5>
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

      