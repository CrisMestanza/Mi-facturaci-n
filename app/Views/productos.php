<main id="main" class="main">

  <div class="pagetitle">
    <h1>Productos</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
        <li class="breadcrumb-item active">Productos</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section dashboard">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Productos</h5>
            <a type="submit" id="btnEditar" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#myModal">
              Agregar producto
            </a>

            <!-- Modal de agregar -->
            <div class="modal" id="myModal">
              <div class="modal-dialog">
                <div class="modal-content">

                  <!-- Cabecera del modal -->
                  <div class="modal-header">
                    <h4 class="modal-title">Nuevo producto</h4>
                    <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
                  </div>

                  <!-- Contenido del modal -->
                  <div class="modal-body">
                    <form action="<?php echo base_url("productos/agregar")?>" method="post" enctype="multipart/form-data">
                      <h4>Producto</h4>
                      <label for="">Categoría</label>
                      <select class="form-select" aria-label="Default select example" name="categoria">
                        <?php foreach ($categorias as $categoria) { ?>

                          <option selected value="<?= $categoria['idcategoria'] ?>">
                            <?= $categoria['nomcategoria'] ?>
                          </option>
                        <?php } ?>

                      </select>
                      <label for="nombreProducto">Nombre</label><br>
                      <input type="text" name="nombreProducto" id="nombreProducto" style="width: 400px;">

                      <br>
                      <label for="descripcionProducto">Descripción</label><br>
                      <input type="text" name="descripcionProducto" id="descripcionProducto"  style="width: 400px;">
                      <br>

                      <label for="precioProducto">Precio unitario</label><br>
                      <input type="text" name="precioProducto" id="precioProducto"  style="width: 400px;">
                      <br>

                      <label for="stockProducto">Stock</label><br>
                      <input type="text" name="stockProducto" id="stockProducto"  style="width: 400px;">

                      <br>

                      <!-- Seleccionar la imagen -->
                      <label for="imagenProducto">Igamen</label><br>
                      <input type="file" value="Adjuntar imagen" name="imagenProducto" id="imagenProducto" 
                        style="width: 400px;">
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

            <!-- Fin del modal -->




            <!-- Table with stripped rows -->
            <table class="table datatable">
              <thead>
                <tr>


                  <th scope="col">#</th>
                  <th scope="col">Producto</th>
                  <th scope="col">Descripcion</th>
                  <th scope="col">Precio</th>
                  <th scope="col">Stock</th>
                  <th scope="col">Imagen</th>
                  <th scope="col">Categoria</th>

                  <th scope="col">Acciones</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($productos as $producto) { ?>
                  <tr>

                    <td>
                      <?= $contador ?>
                    </td>
                    <?php $contador += 1 ?>

                    <td>
                      <?= $producto['nomproducto'] ?>
                    </td>
                    <td>
                      <?= $producto['descripcion'] ?>
                    </td>
                    <td>
                      <?= $producto['preciounitario'] ?>
                    </td>
                    <td>
                      <?= $producto['stockactual'] ?>
                    </td>
                    <td> 
                    <?php
                      $imagenPath = 'assets/img/productos/' . $producto['imagenprod'];
                      
                      // Verificar si la imagen existe antes de intentar mostrarla
                      if (file_exists($imagenPath)) {
                          echo '<img src="' . base_url($imagenPath) . '" alt="Imagen del producto" style="width:80px;">';
                      } else {
                          echo 'No hay imagen disponible';
                      }
                      ?>
                      
                    </td>
                    <td>
                      <?= $producto['nomcategoria'] ?>
                    </td>



                    <td><a type="submit" 
                        id="btnEditar" class="btn "  data-bs-toggle="modal" data-bs-target="#myModal2<?= $producto['idproducto'] ?>"><i class="fa-solid fa-pen-to-square fa-2xl" style="color: #005eff;"></i></a>

                      <a type="submit" href="<?php echo base_url("productos/eliminar/" . $producto['idproducto']) ?>"
                        class="btn "><i class="fa-solid fa-trash fa-2xl" style="color: #f71b02;"></i></a>
                    </td>

            <!-- Modal de editar -->
            <div class="modal" id="myModal2<?= $producto['idproducto'] ?>">
              <div class="modal-dialog">
                <div class="modal-content">

                  <!-- Cabecera del modal -->
                  <div class="modal-header">
                    <h4 class="modal-title">Editar producto</h4>
                    <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
                  </div>

                  <!-- Contenido del modal -->
                  <div class="modal-body">
                    <form action="<?php echo base_url("productos/update/") ?>" method="post" enctype="multipart/form-data">
                      <h4>Producto</h4>

                      <select class="form-select" aria-label="Default select example" name="categoria2">
                        <?php foreach ($categorias as $categoria) { ?>

                          <option selected value="<?= $categoria['idcategoria'] ?>">
                            <?= $categoria['nomcategoria'] ?>
                          </option>
                        <?php } ?>

                      </select>

                      <input type="hidden" name="idproducto2" id="nombreProducto2" value="<?= $producto['idproducto'] ?>">

                      <label for="nombreProducto2">Nombre</label><br>
                      <input type="text" name="nombreProducto2" id="nombreProducto2" value="<?= $producto['nomproducto'] ?>" style="width: 465px;">


                      <br>
                      <label for="descripcionProducto2">Descripción</label><br>
                      <input type="text" name="descripcionProducto2" id="descripcionProducto2" value="<?= $producto['descripcion'] ?>"  style="width: 465px;">
                      <br>

                      <label for="precioProducto2">Precio unitario</label><br>
                      <input type="text" name="precioProducto2" id="precioProducto2" value="<?= $producto['preciounitario'] ?>" style="width: 465px;">
                      <br>

                      <label for="stockProducto2">Stock</label><br>
                      <input type="text" name="stockProducto2" id="stockProducto2"  value="<?= $producto['stockactual'] ?>"  style="width: 465px;">

                      <br>

                      <label for="imagenProducto2">Igamen</label><br>
                      <input type="file" value="Adjuntar imagen" name="imagenProducto2" id="imagenProducto2" 
                        style="width: 400px;">
                      
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
                <?php } ?>

              </tbody>
            </table>



           


          </div>
        </div>

      </div>
    </div>
  </section>


</main><!-- End #main -->