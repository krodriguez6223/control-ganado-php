

<!-- Modal PARA INGRESAR UNA NUEVA RES-->
<div class="modal fade" id="modalFormGanado" tabindex="-1" role="dialog"  aria-hidden="true">
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

          <form id="formGanado" name="formGanado" class="form-horizontal" enctype="multipart/form-data">

            <input type="hidden" id="idGanado" name="idGanado" value="">
            <input type="hidden" id="foto_Actual" name="foto_Actual" value="">
            <input type="hidden" id="foto_remove" name="foto_remove" value="0">

            
            <p class="text-primary">Todos los campos con asteriscos (<span class="required">*</span>) son obligatorios</p>

            <!-- fila 1 -->
            <div class="form-row">
              <div class="form-group col-md-3">
                <label for="" ></label>
                <label for="txtCodigo">Código <span class="required">*</span></label>
                <input  type="text" class="form-control valid validNumber" for="inputSuccess1" id="txtCodigo" name="txtCodigo" onkeypress="return controlTag(event);">
              </div>

              <div class="form-group col-md-3">
                <label for="txtNombre">Nombres <span class="required">*</span></label>
                <input type="text" class="form-control valid validText" id="txtNombre" name="txtNombre" >
              </div>

              <div class="form-group col-md-3">
                <label for="pesoRes">Peso (kg) <span class="required">*</span></label>
                <input type="text" class="form-control valid validNumber" id="pesoRes" name="pesoRes">
              </div>
              <div class="form-group col-md-3">
                <label for="listRaza">Raza <span class="required">*</span></label>
                <select class="form-control selectpicker" id="listRaza" name="listRaza" >
                 
                  <option selected disabled value="">Selleccione...</option>      
            <?php foreach ($data['confRaza'] as $key => $value) : ?>
                  <option value="<?php echo $value['raza'] ?>"><?php echo $value['raza'] ?></option>
                  
              <?php endforeach; ?>
                </select>
              </div>
            </div>

            <!-- fila 2 -->
            <div class="form-row">
              <div class="form-group col-md-3">
                <label for="listCategoria">Categoria <span class="required">*</span></label>
                <select class="form-control selectpicker" data-live-search="true=" id="listCategoria" name="listCategoria" class="custom-select">

                  <option selected disabled value="">Selleccione...</option>
                 <?php foreach ($data['confCate'] as $key => $value):?>
                  <option value="<?php echo $value['categoria'] ?>"><?php echo $value['categoria'] ?></option>
                  <?php endforeach; ?>

                </select>
              </div>

              <div class="form-group col-md-3">
                <label for="listOrigen">Origen <span class="required">*</span></label>
                <select class="form-control selectpicker" id="listOrigen" name="listOrigen" class="custom-select">
                  <option selected disabled value="">Selleccione...</option>
                 <?php foreach ($data['confOrigen'] as $key => $value):?>
                  <option value="<?php echo $value['origen'] ?>"><?php echo $value['origen'] ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
               <div class="form-group col-md-3">
                <label  for="listStatus">Estado Res <span class="required">*</span></label>
                <select class="form-control selectpicker" id="listStatus" name="listStatus" class="custom-select">
                  <option selected disabled value="">Selleccione...</option>
                  <option value="1">Activa</option>
                  <option value="2">Muerta</option>
                  <option value="3">Vendida</option>
                  <option value="4">Descarte</option>
                </select>
              </div> 
               <div class="form-group col-md-3">
                <label  for="listMortalidad">Causa mortalidad <span class="required">*</span></label>
                <select class="form-control " id="listMortalidad" name="listMortalidad" disabled >
                  <option selected disabled value="">Selleccione...</option>
                  <option  value="Natural">Natural</option>
                  <option value="Enfermeda">Enfermedad</option>
                  <option value="Desconocido">Desconocido</option>
                </select>
              </div> 
            </div>
            <!-- fila 3 -->
            <div class="form-row">
              <div class="form-group col-md-3">
                <label  for="listLote">Lote <span class="required">*</span></label>
                <select class="form-control selectpicker" id="listLote" name="listLote" class="custom-select">
                  <option selected disabled value="">Selleccione...</option>
                  <?php foreach ($data['confLote'] as $key => $value): ?>
                  <option value="<?php echo $value['lote'] ?>"><?php echo $value['lote'] ?></option>
                  <?php endforeach; ?>
                </select>
              </div>

             <div class="form-group col-md-3">
                <label for="txtEmail">Fecha Nacimiento <span class="required">*</span></label>
                <input type="text" class="form-control" id="fechaNacimiento" name="fechaNacimiento"  autocomplete="off">
              </div>   
            </div>

            <div class="form-row">
              <div class="form-group col-md-6 ">
                <label for="txtObservacion">Observacion: </label>
                <textarea class="form-control" id="txtObservacion" name="txtObservacion" rows="4" placeholder="Escriba su observacion..."></textarea>
              </div>
              <div class="col-md-6 recuadro">
                    <div class="photo">
                       
                        <div class="prevPhoto">
                          <span class="delPhoto notBlock">X</span>
                          <label for="foto"></label>
                          <div>
                            <img id="img" src="<?= media(); ?>/images/uploads/vacaPortada.jpg">
                          </div>
                        </div>
                        <div class="upimg">
                          <input type="file" name="foto" id="foto">
                        </div>
                        <div id="form_alert"></div>
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
<div class="modal fade" id="modalViewGanado" tabindex="-1" role="dialog"  aria-hidden="true">
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
              <td  class="negrita">Nombre</td>
              <td id="celNombre"></td>
            </tr>
            <tr>
              <td class="negrita">Peso</td>
              <td id="celPesoRes"></td>
            </tr> 
            <tr>
              <td class="negrita">Raza</td>
              <td id="celRaza"></td>
            </tr>
            <tr>
              <td class="negrita">Categoría</td>
              <td id="celCategoria"></td>
            </tr>
            <tr>
              <td class="negrita">Origen</td>
              <td id="celOrigen"></td>
            </tr>
            <tr>
            <tr>
              <td class="negrita">Lote</td>
              <td id="celLote"></td>
            </tr>
            <tr>
              <td class="negrita">Estado</td>
              <td id="celEstado"></td>
            </tr>
            <tr>
              <td class="negrita">Causa mortalidad</td>
              <td id="celMortalidad"></td>
            </tr>
            <tr>
              <td class="negrita">Fecha nacimiento</td>
              <td id="celFechaNacimiento"></td>
            </tr> 
            <tr>
              <td class="negrita">Fecha de registro</td>
              <td id="celFechaRegistro"></td>
            </tr>
            <tr>
              <tr>
              <td class="negrita">Observación</td>
              <td id="celObservacion"></td>
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

<!-- MODAL PARA CONFIGURACION DE SELECT DEL INGRESO DE GANADO-->
<div class="modal fade" id="modalViewConfig" tabindex="-1" role="dialog"  aria-hidden="true">
  <div class="modal-dialog modal-dialog modal-lg">
    <div class="modal-content ">
      <div class="modal-header headerRegister">

        <h5 class="modal-title" id="titleModal">Configuración</h5>

        <button type="button"  class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body ">

        <div class="tile-body"> 

          <form id="formConf" name="formConf" class="form-horizontal" enctype="multipart/form-data">

            <input type="hidden" id="idConfig" name="idConfig" value="">
           

            <!-- fila 1 -->
            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="" ></label>
                <label for="txtLote">Lote <span class="required">*</span></label>
                <input  type="text" class="form-control valid validNumber" for="inputSuccess1" id="txtLote" name="txtLote" onkeypress="return ">
              </div>
              <div class="form-group col-md-6">
                <label for="" ></label>
                <label for="txtRaza">Raza <span class="required">*</span></label>
                <input  type="text" class="form-control valid validText" for="inputSuccess1" id="txtRaza" name="txtRaza" onkeypress="return ">
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="" ></label>
                <label for="txtCategoria">Categoría <span class="required">*</span></label>
                <input  type="text" class="form-control valid validText" for="inputSuccess1" id="txtCategoria" name="txtCategoria" onkeypress="return ">
              </div>
              <div class="form-group col-md-6">
                <label for="" ></label>
                <label for="txtOrigen">Origen <span class="required">*</span></label>
                <input  type="text" class="form-control valid validText" for="inputSuccess1" id="txtOrigen" name="txtOrigen" onkeypress="return ">
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