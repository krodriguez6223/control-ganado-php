
<?php headerAdmin($data);
      getModal('modalTratamiento',$data);

?>

<meta charset="UTF-8">
<main class="app-content">
  <div class="app-title">
    <div>
      <h1><i class="fas fa-user-tag"></i> <?= $data['page_title'] ?>    
  </div>
  <ul class="app-breadcrumb breadcrumb">
    <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
    <li class="breadcrumb-item"><a href="<?= base_url();  ?>/dashboard">Inicio</a></li>
  </ul> 
</div>

<!--=====================================
      Tratamientos a realizar HOY
======================================-->
<?php 

if (!empty($data['TratarActualBañoHOY']) || !empty($data['TratarActualDespaHOY']) || !empty($data['TratarActualVacunaHOY']) )

 { ?> 

<div class="tile">

 <h5>Tratamientos a realizar HOY</h5><br>
 <div class="row">

    <div class="col-md-4">
          <div class="tile">
            <h5 >Baño (<?php echo $data['cantReTratarActualBaño']['total']?>)</h5> 
             <table class="table table-sm">
              <thead>
                <tr>
                  <th>Codigo</th>
                  <th>Fecha</th>
                  <th>Categoria</th> 
                </tr>
              </thead>
              <tbody>
                <?php foreach ($data['TratarActualBañoHOY'] as $key => $value) :?>
                <tr>
                  <td><a href="#"><?php echo $value['codigo'] ?></a></td>
                  <td><?php echo $value['fechaBanio'] ?></td> 
                  <td><?php echo $value['categoria'] ?></td>                
                </tr>
                 <?php endforeach; ?>       
              </tbody>
            </table>
          </div>
        </div>

    <div class="col-md-4">
          <div class="tile">
            <h5 >Desparacitacion (<?php echo $data['cantReTratarActualDespa']['total']?>)</h5>
             <table class="table table-sm">
              <thead>
                <tr>
                  <th>Codigo</th>
                  <th>Fecha</th>
                  <th>Categoria</th> 
                </tr>
              </thead>
              <tbody>
                <?php foreach ($data['TratarActualDespaHOY'] as $key => $value) :?>
                <tr>
                  <td><a href="#"><?php echo $value['codigo'] ?></a></td>
                  <td><?php echo $value['fechaDesparasitacion'] ?></td> 
                  <td><?php echo $value['categoria'] ?></td>                 
                </tr>
                 <?php endforeach; ?>       
              </tbody>
            </table>
          </div>
        </div>

    <div class="col-md-4">
          <div class="tile">
            <h5 >Vacunación (<?php echo $data['cantReTratarActualVacuna']['total']?>)</h5>
             <table class="table table-sm">
              <thead>
                <tr>
                  <th>Codigo</th>
                  <th>Fecha</th>
                  <th>Categoria</th> 
                </tr>
              </thead>
              <tbody>
                <?php foreach ($data['TratarActualVacunaHOY'] as $key => $value) :?>
                <tr>
                  <td><a href="#"><?php echo $value['codigo'] ?></a></td>
                  <td><?php echo $value['fechaVacunacion'] ?></td> 
                  <td><?php echo $value['categoria'] ?></td>                 
                </tr>
                 <?php endforeach; ?>       
              </tbody>
            </table>
          </div>
        </div>
 </div> 
</div>

<?php } ?>

<!--=====================================
      Tratamientos dentro de 5 dias
======================================-->

<?php if (!empty($data['TrataBañoProxCinco']) || !empty($data['TrataDespaProxCinco']) || !empty($data['TrataVacuProxCinco']) ) {?>


<div class="tile">
  <h5>Tratamientos a realizar dentro de 5 dias</h5><br>
 <div class="row">

    <div class="col-md-4">
          <div class="tile">
            <h5 >Baño (<?php echo $data['cantTratarProxCincoBaño']['total']?>)</h5>
            <table class="table table-sm">
              <thead>
                <tr>
                  <th>Codigo</th>
                  <th>Fecha</th>
                  <th>Categoria</th> 
                </tr>
              </thead>
              <tbody>
                <?php foreach ($data['TrataBañoProxCinco'] as $key => $value) :?>
                <tr>
                  <td><a href="#"><?php echo $value['codigo'] ?></a></td>
                  <td><?php echo $value['fechaBanio'] ?></td> 
                  <td><?php echo $value['categoria'] ?></td>                
                </tr>
                 <?php endforeach; ?>       
              </tbody>
            </table>
          </div>
        </div>

    <div class="col-md-4">
          <div class="tile">
            <h5 >Desparacitacion (<?php echo $data['cantTratarProxCincoDespa']['total']?>)</h5>
             <table class="table table-sm">
              <thead>
                <tr>
                  <th>Codigo</th>
                  <th>Fecha</th>
                  <th>Categoria</th> 
                </tr>
              </thead>
              <tbody>
                <?php foreach ($data['TrataDespaProxCinco'] as $key => $value) :?>
                <tr>
                  <td><a href="#"><?php echo $value['codigo'] ?></a></td>
                  <td><?php echo $value['fechaDesparasitacion'] ?></td> 
                  <td><?php echo $value['categoria'] ?></td>                 
                </tr>
                 <?php endforeach; ?>       
              </tbody>
            </table>
          </div>
        </div>

    <div class="col-md-4">
          <div class="tile">
            <h5 >Vacunación (<?php echo $data['cantTratarProxCincoVacuna']['total']?>)</h5>
             <table class="table table-sm">
              <thead>
                <tr>
                  <th>Codigo</th>
                  <th>Fecha</th>
                  <th>Categoria</th> 
                </tr>
              </thead>
              <tbody>
                <?php foreach ($data['TrataVacuProxCinco'] as $key => $value) :?>
                <tr>
                  <td><a href="#"><?php echo $value['codigo'] ?></a></td>
                  <td><?php echo $value['fechaVacunacion'] ?></td> 
                  <td><?php echo $value['categoria'] ?></td>                 
                </tr>
                 <?php endforeach; ?>       
              </tbody>
            </table>
          </div>
        </div>
 </div> 
 </div> 
</div>

 <?php } ?> 

 <!--=====================================
     Próximos tratamientos a realizar
======================================-->

<div class="tile">
   <h5>Próximos tratamientos a realizar</h5><br>
 <div class="row">

    <div class="col-md-4">
          <div class="tile">
            <h5 >Baño (<?php echo $data['cantTrataBañoTodos']['total']?>)</h5>
            <table class="table table-sm">
              <thead>
                <tr>
                  <th>Codigo</th>
                  <th>Fecha Proximo</th>
                  <th>Categoria</th> 
                </tr>
              </thead>
              <tbody>
                <?php foreach ($data['TrataBañoTodos'] as $key => $value) :?>
                <tr>
                  <td><a href="<?= base_url(); ?>/tratamiento" id="p1" onclick="copyToClipboard('#p1')"><?php echo $value['codigo'] ?></a></td>
                  <td><?php echo $value['fechaProxBanio'] ?></td> 
                  <td><?php echo $value['categoria'] ?></td>                
                </tr>
                 <?php endforeach; ?>       
              </tbody>
            </table>
          </div>
        </div>

    <div class="col-md-4">
          <div class="tile">
            <h5 >Desparacitacion (<?php echo $data['cantTrataDespaTodos']['total']?>)</h5>
             <table class="table table-sm">
              <thead>
                <tr>
                  <th>Codigo</th>
                  <th>Fecha Proximo </th>
                  <th>Categoria</th> 
                </tr>
              </thead>
              <tbody>
                <?php foreach ($data['TrataDespaTodos'] as $key => $value) :?>
                <tr>
                  <td><a href="#"><?php echo $value['codigo'] ?></a></td>
                  <td><?php echo $value['fechaProxDesparasitacion'] ?></td> 
                  <td><?php echo $value['categoria'] ?></td>                 
                </tr>
                 <?php endforeach; ?>       
              </tbody>
            </table>
          </div>
        </div>

    <div class="col-md-4">
          <div class="tile">
            <h5 >Vacunación (<?php echo $data['cantTrataVacuTodos']['total']?>)</h5>
             <table class="table table-sm">
              <thead>
                <tr>
                  <th>Codigo</th>
                  <th>Fecha Proximo</th>
                  <th>Categoria</th> 
                </tr>
              </thead>
              <tbody>
                <?php foreach ($data['TrataVacuTodos'] as $key => $value) :?>
                <tr>
                  <td><a href="#"><?php echo $value['codigo'] ?></a></td>
                  <td><?php echo $value['fechaProxVacunacion'] ?></td> 
                  <td><?php echo $value['categoria'] ?></td>                 
                </tr>
                 <?php endforeach; ?>       
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>


<!--=====================================
     Tratamientos atrasados a realizar
======================================-->
 <?php if (!empty($data['TrataBañoAtrasa']) || !empty($data['TrataDespaAtrasa']) || !empty($data['TrataVacuAtrasa']) ) {?>   


<div class="tile">
 <h5>Tratamientos atrasados a realizar</h5><br>
 <div class="row">

    <div class="col-md-4">
          <div class="tile">
            <h5 >Baño (<?php echo $data['cantTrataBañoAtrasa']['total']?>)</h5>
            <table class="table table-sm">
              <thead>
                <tr>
                  <th>Codigo</th>
                  <th>Fecha Proximo</th>
                  <th>Categoria</th> 
                </tr>
              </thead>
              <tbody>
                <?php foreach ($data['TrataBañoAtrasa'] as $key => $value) :?>
                <tr>
                  <td><a href="#"><?php echo $value['codigo'] ?></a></td>
                  <td><?php echo $value['fechaProxBanio'] ?></td> 
                  <td><?php echo $value['categoria'] ?></td>                
                </tr>
                 <?php endforeach; ?>       
              </tbody>
            </table>
          </div>
        </div>

    <div class="col-md-4">
          <div class="tile">
            <h5 >Desparacitacion (<?php echo $data['cantTrataDespaAtrasa']['total']?>)</h5>
             <table class="table table-sm">
              <thead>
                <tr>
                  <th>Codigo</th>
                  <th>Fecha Proximo </th>
                  <th>Categoria</th> 
                </tr>
              </thead>
              <tbody>
                <?php foreach ($data['TrataDespaAtrasa'] as $key => $value) :?>
                <tr>
                  <td><a href="#"><?php echo $value['codigo'] ?></a></td>
                  <td><?php echo $value['fechaProxDesparasitacion'] ?></td> 
                  <td><?php echo $value['categoria'] ?></td>                 
                </tr>
                 <?php endforeach; ?>       
              </tbody>
            </table>
          </div>
        </div>

    <div class="col-md-4">
          <div class="tile">
            <h5 >Vacunación (<?php echo $data['cantTrataVacuAtrasa']['total']?>)</h5>
             <table class="table table-sm">
              <thead>
                <tr>
                  <th>Codigo</th>
                  <th>Fecha Proximo</th>
                  <th>Categoria</th> 
                </tr>
              </thead>
              <tbody>
                <?php foreach ($data['TrataVacuAtrasa'] as $key => $value) :?>
                <tr>
                  <td><a href="#"><?php echo $value['codigo'] ?></a></td>
                  <td><?php echo $value['fechaProxVacunacion'] ?></td> 
                  <td><?php echo $value['categoria'] ?></td>                 
                </tr>
                 <?php endforeach; ?>       
              </tbody>
            </table>
          </div>
        </div>
    </div>
      <?php } ?>

</main>

<?php footerAdmin($data);?>