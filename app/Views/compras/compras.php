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
                <a type="submit" id="btnEditar" class="btn btn-success" href="<?= base_url('compras/setViewAgregar') ?>">
                Agregar compra
                </a> 
                
               

                <!-- Table with stripped rows -->
                <table class="table datatable">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Documento</th>
                            <th scope="col">Proveedor</th>
                            <th scope="col">Total</th>
                            <th scope="col">Fecha</th>
                            <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach($compras as $compra){?>
                            <tr>
                                <td><?=$contador?></td>
                                <?php $contador+=1?>
                                <td><?=  $compra['numcorrelativo'] ?></td>
                                <td><?=  $compra['razonsocial'] ?></td>
                                <td><?= $compra['total_compra'] ?></td>

                                <?php
                           
                                      // $fechaCompra = date('Y-m-d\TH:i', strtotime($compra['fechacompra']));
                                      $fechaCompra = date('d-m-Y', strtotime($compra['fechacompra']));

                                ?>

                                <td><?=  $fechaCompra ?></td>
                                <td>
                           
                                <a type="submit" 
                                   id="btnEditar" class="btn "  data-bs-toggle="modal" data-bs-target="#myModal2<?= $compra['idcompra'] ?>"><i class="fa-solid fa-pen-to-square fa-2xl" style="color: #005eff;"></i></a>
                                  <a href="<?= base_url('compras/eliminar/'.$compra['idcompra'])?>"><i class="fa-solid fa-trash fa-2xl" style="color: #f71b02;"></i></a>
                                </td> 
                                
                                

            <!-- Modal de editar -->
            <div class="modal" id="myModal2<?= $compra['idcompra'] ?>">
              <div class="modal-dialog">
                <div class="modal-content">

                  <!-- Cabecera del modal -->
                  <div class="modal-header">
                    <h4 class="modal-title">Editar compra</h4>
                    <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
                  </div>

                  <!-- Contenido del modal -->
                  <div class="modal-body">
                    <form action="<?php echo base_url("/compras/editar") ?>" method="post">
                      <h4>Documento</h4>

                       <div style="display:flex">
                        <div class="input-group" id="compra">
                            <label class="input-group-text"># Documento</label>
                            <input type="text" value="<?=  $compra['numcorrelativo'] ?>" class="form-control" aria-label="With textarea" name="numcorrelativo">
                        </div>

                        <?php
                           
                            $fechaCompra = date('Y-m-d', strtotime($compra['fechacompra']));

                        ?>
                      
                        <div class="input-group">
                            <label class="input-group-text">Fecha</label>
                            <input type="date" value="<?= $fechaCompra ?>" class="form-control" aria-label="With textarea" name="fechDocumento">
                        </div>
                      </div>
                      <br>
                      <h4>Datos del producto</h4>
                      <h5>Proveedor</h5>
                      <select class="form-select" aria-label="Default select example" name="proveedor">
                                <?php foreach ($Proveedores as $Proveedor) { ?>
                                  <option selected value="<?= $Proveedor['idproveedor'] ?>">
                                    <?= $Proveedor['razonsocial'] ?>
                                  </option>
                              <?php } ?>
                       </select>
                       
                       <h5>Categoria</h5>

                       <select class="form-select" aria-label="Default select example" name="categoria">

                            <?php foreach ($compras as $compra2) { ?>

                                            <option selected value="<?= $compra2['idcategoria'] ?>">
                                              <?= $compra2['nomcategoria'] ?>
                                            </option>
                                            <?php } ?>
                        </select>
                        <h5>Nombre del producto</h5>
                        <div class="input-group">     
                            <input class="form-control busqueda" value="<?=  $compra['nomproducto'] ?>" type="list" list="opcionesBusqueda" aria-label="With textarea" name="nombre">
                            
                         </div>
                         <h5>Descripción del producto</h5>
                         <div class="input-group">
                                            
                              <input class="form-control" value="<?=  $compra['descripcion'] ?>" name="detalle" aria-label="With textarea">
                          </div> 
                          <h5>Precio unitario</h5>
                          <div class="input-group">
                                      
                               <input class="form-control" value="<?=  $compra['preciounitario'] ?>" name="precio" aria-label="With textarea">
                          </div>
                          <h5>Stock</h5>
                          <div class="input-group">
                                            
                                <input class="form-control"  value="<?=  $compra['stockactual'] ?>" name="stock" aria-label="With textarea">
                          </div>  
                          <!-- Hidden que lleva el id compra -->
                          <div class="input-group">
                                            
                                            <input class="form-control" type="hidden"  value="<?=  $compra['idcompra'] ?>" name="idcompra" aria-label="With textarea">
                                      </div> 
                          <div style="display:flex; margin-left:140px;">

                            <!-- Hidden que lleva el id producto-->
                          <div class="input-group">
                                            
                                            <input class="form-control" type="hidden"  value="<?=  $compra['idproducto'] ?>" name="idproducto" aria-label="With textarea">
                                      </div> 
                          <div style="display:flex; margin-left:140px;">


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





