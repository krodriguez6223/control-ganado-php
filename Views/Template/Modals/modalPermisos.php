<div class="modal fade modalPermisos" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">

      

      <div class="modal-header">
        <h5 class=" modal-title h4">Permisos de roles de usuarios</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="close">
          <span aria-hidden="true">x</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="col-md-12">
          <div class="tile">
            <form action="" id="formPermisos" name="formPermisos">
              <input type="hidden" id="idrol" name="idrol" value="<?= $data['idrol']; ?>" require="">
            <div class="table-responsive">
              <table class="table">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Modulo</th>
                    <th>Ver</th>
                    <th>Crear</th>
                    <th>Actualizar</th>
                    <th>Eliminar</th>
                  </tr>
                </thead>
                <tbody>

                <?php 
                      $no=1;
                        $modulos = $data['modulos'];
                        for ($i=0; $i <count($modulos) ; $i++) { 

                          $permisos = $modulos[$i]['permisos'];
                          
                          $rCheck = $permisos['r'] == 1 ? "checked " : "";
                          $wCheck = $permisos['w'] == 1 ? "checked " : "";
                          $uCheck = $permisos['u'] == 1 ? "checked " : "";
                          $dCheck = $permisos['d'] == 1 ? "checked " : "";

                          $idmod = $modulos[$i]['idmodulo'];
        
                  ?>
                  <tr>
                    <td>
                      <?= $no; ?>
                    <input type="hidden" name="modulos[<?= $i; ?>][idmodulo]" value="<?= $idmod ?>" require>
                  
                  </td>
                    <td>
                      <?= $modulos[$i]['titulo']; ?>
                    </td>
                    <td>
                      <div class="toggle-flip">
                        <label>
                          <input type="checkbox" name="modulos[<?= $i; ?>][r]" <?= $rCheck ?> >
                          <span class="flip-indecator" data-toggle-on="ON" data-toggle-off="OFF">
                          </span>
                        </label>
                      </div>
                    </td>
                    <td>
                      <div class="toggle-flip">
                        <label>
                          <input type="checkbox" name="modulos[<?= $i; ?>][w]" <?= $wCheck ?> >
                          <span class="flip-indecator" data-toggle-on="ON" data-toggle-off="OFF">
                          </span>
                        </label>
                      </div>
                    </td>
                    <td>
                      <div class="toggle-flip">
                        <label>
                          <input type="checkbox" name="modulos[<?= $i; ?>][u]" <?= $uCheck ?> >
                          <span class="flip-indecator" data-toggle-on="ON" data-toggle-off="OFF">
                          </span>
                        </label>
                      </div>
                    </td>
                    <td>
                      <div class="toggle-flip">
                        <label>
                          <input type="checkbox" name="modulos[<?= $i; ?>][d]" <?= $dCheck ?> >
                          <span class="flip-indecator" data-toggle-on="ON" data-toggle-off="OFF">
                          </span>
                        </label>
                      </div>

                      <?php  $no ++;  ?>
                    </td>
                </tbody>
              </tr>
            <?php }




            ?>
              </table>
            </div>
            <div class="text-center">
              <button class="btn btn-success" type="submit"><i class="fas fa-check" aria-hidden="true"></i>Guardar</button>
               <button class="btn btn-danger" type="button" data-dismiss="modal"><i class="fas fa-sign-out-alt"></i>Salir</button>

             </div>
            </form>
          </div>
        </div>

      </div>
    </div>
  </div>
</div>