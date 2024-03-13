<main id="main" class="main">

<div class="pagetitle">
  <h1>Unidades</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="index.html">Home</a></li>
      <li class="breadcrumb-item active">Unidades</li>
    </ol>
  </nav>
</div><!-- End Page Title -->

<section class="section dashboard">
  <div class="row">
    <div class="col-lg-12"> 
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Compras</h5> 
                <a type="submit" id="btnEditar" class="btn btn-success" href="<?= base_url('compras/setViewAgregar') ?>" 
                data-bs-toggle="modal" data-bs-target="#myModal2">
                Agregar compra
                </a> 
<!-- Modal de editar agregar -->
            <div class="modal" id="myModal2">
              <div class="modal-dialog">
                <div class="modal-content">

                  <!-- Cabecera del modal -->
                  <div class="modal-header">
                    <h4 class="modal-title">Editar compra</h4>
                    <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
                  </div>

                  <!-- Contenido del modal -->
                  <div class="modal-body">
                    <form action="<?php echo base_url("/series/agregar") ?>" method="post">
                      <h4>Tipo Documento</h4>
                      <!-- Tipo de documento -->
                      <select class="form-select" aria-label="Default select example" name="tipoDoc">
                        <?php foreach ($tipoDocumentos   as  $tipoDocumento) {?>
                          <option value="<?= $tipoDocumento['idtipodocumento']?>">
                            <?= $tipoDocumento['nombredocumento']?>
                          </option>
                          <?php } ?>
                      </select>
                          <br>
                      <div class="input-group mb-3">
                        <span class="input-group-text">Número de serie</span>
                        <input type="text" name="numSerie" class="form-control" aria-label="Amount (to the nearest dollar)">
                      </div>
                          
                      <div style="display:flex; margin-left:150px;">
                        <div class="modal-footer">
                          <button type="submit" class="btn btn-secondary" data-bs-dismiss="modal">Agregar</button>
                        </div>

                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        </div>
                      </div>
                     

                  </div>
                  </form>
                </div>

                <!-- Pie del modal -->

              </div>
            </div>

<!-- Fin del modal agregar -->
                
               

                <!-- Table with stripped rows -->
                <table class="table datatable">
                    <thead>
                        <tr>

                            <th scope="col">N.</th>
                            <th scope="col">Tipo Documento	</th>
                            <th scope="col">Numero</th>
                            <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach($series as $serie){?>
                            <tr>
                                <td><?= $contador ?></td>
                                <?php $contador=$contador +1 ?>
                                <td><?= $serie['nombredocumento']?></td>
                                <td><?= $serie['numserie']?></td>
                                <td>
                                    <a type="submit" 
                                        id="btnEditar" class="btn "  data-bs-toggle="modal" data-bs-target="#myModal2<?= $serie['idnumserie'] ?>">
                                        <i class="fa-solid fa-pen-to-square fa-2xl" style="color: #005eff;">
                                      </i>
                                    </a>
                                    <a href="<?= base_url('/series/eliminar/'.$serie['idnumserie'])?>">
                                        <i class="fa-solid fa-trash fa-2xl" style="color: #f71b02;"></i>
                                    </a>
                                </td> 
                                
                                

            <!-- Modal de editar -->
            <div class="modal" id="myModal2<?= $serie['idnumserie'] ?>">
              <div class="modal-dialog">
                <div class="modal-content">

                  <!-- Cabecera del modal -->
                  <div class="modal-header">
                    <h4 class="modal-title">Editar compra</h4>
                    <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
                  </div>

                  <!-- Contenido del modal -->
                  <div class="modal-body">
                    <form action="<?php echo base_url("/series/editar") ?>" method="post">
                    <label for="">Tipo de la carrera</label>
                    <select class="form-select" aria-label="Default select example" name="tipoDoc">
                        <?php foreach ($tipoDocumentos   as  $tipoDocumento) {?>
                          <option value="<?= $tipoDocumento['idtipodocumento']?>">
                            <?= $tipoDocumento['nombredocumento']?>
                          </option>
                          <?php } ?>
                      </select>
                      <input type="hidden" name="idNumSerie" class="form-control" aria-label="Amount (to the nearest dollar)" value="<?= $serie['idnumserie']?>">
                        <br>
                          <div class="input-group mb-3">
                              <span class="input-group-text">Número de serie</span>
                              <input type="text" name="numSerie" class="form-control" aria-label="Amount (to the nearest dollar)" value="<?= $serie['numserie']?>">
                            </div>
                        
                          <div style="display:flex; margin-left:150px;">
                            <div class="modal-footer">
                              <button type="submit"  class="btn btn-secondary" data-bs-dismiss="modal">Editar</button>
                            </div>
                            
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            </div>
                          </div>
                     

                  </div>
                  </form>
                </div>

                <!-- Pie del modal -->

              </div>
            </div>

            <!-- Fin del modal -->



                            </tr>
                        <?php }?>
                      
                    </tbody>
                </table>
                <!-- End Table with stripped rows -->
                
            </div>
        </div>
        
    </div>
  </div>
</section>

</main><!-- End #main -->





