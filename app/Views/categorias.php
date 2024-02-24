<main id="main" class="main">

<div class="pagetitle">
  <h1>Categorias</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="index.html">Home</a></li>
      <li class="breadcrumb-item active">Categorias</li>
    </ol>
  </nav>
</div><!-- End Page Title -->

<section class="section dashboard">
  <div class="row">
    <div class="col-lg-12"> 
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Categorias</h5> 
                <button type=""  class="btn btn-success" id="btn-editar"  data-bs-toggle="modal" data-bs-target="#myModaAgregar">Agregar categoría</button>
                <!-- Table with stripped rows -->
                <table class="table datatable">
                    <thead>
                        <tr>
                            <th scope="col">CODIGO</th>
                            <th scope="col">Categoria</th>
                            <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach($categorias as $categoria){?>
                            <tr>
                                <td><?=$categoria['idcategoria']?></td>
                                <td><?=$categoria['nomcategoria']?></td>
                                <td>
                                  <a type="submit" 
                                    id="btnEditar" class="btn "  data-bs-toggle="modal" data-bs-target="#myModal2<?= $categoria['idcategoria'] ?>">
                                    <i class="fa-solid fa-pen-to-square fa-2xl" style="color: #005eff;"></i>
                                  </a>

                                  <a 
                                    id="btn-eliminar" name="eliminar" class="btn " href="<?php echo base_url('categoria/eliminar/'.$categoria['idcategoria']) ?>">
                                    <i class="fa-solid fa-trash fa-2xl" style="color: #f71b02;"></i>
                                  </a>
                                </td>  
                            </tr>

            <!-- Modal de editar -->
            <div class="modal" id="myModal2<?= $categoria['idcategoria'] ?>">
              <div class="modal-dialog">
                <div class="modal-content">

                  <!-- Cabecera del modal -->
                  <div class="modal-header">
                    <h4 class="modal-title">Editar categoria</h4>
                    <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
                  </div>

                  <!-- Contenido del modal De editar-->
                  <div class="modal-body">

                      <!-- inicio de form -->

                    <form action="<?php echo base_url("categoria/edit/") ?>" method="post" enctype="multipart/form-data">

                      <h4>Categoria</h4>

                      <label for="nombreProducto2">Nombre</label><br>
                      <input type="text" name="nameCategoria" id="nombreProducto2" value="<?= $categoria['nomcategoria'] ?>" style="width: 465px;">

                      <input type="hidden" name="idCategoria" id="idCategoria" value="<?= $categoria['idcategoria'] ?>" style="width: 465px;">


                    
                          <div style="display:flex; margin-left:140px;">

                            <div class="modal-footer">
                              <button type=""  class="btn btn-secondary" id="btn-editar" data-bs-dismiss="modal">Editar</button>
                            </div>
                            
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            </div>
                          </div>
                     

                  </div>
                  </form>  

                      <!-- fin del form -->

                </div>

                <!-- Pie del modal -->

              </div>
            </div>

            <!-- Fin del modal Editar-->


                        <?php }?>
                      
                    </tbody>
                </table>
                <!-- End Table with stripped rows -->
                

            <!-- Modal de Agregar -->
            <div class="modal" id="myModaAgregar">
              <div class="modal-dialog">
                <div class="modal-content">

                  <!-- Cabecera del modal -->
                  <div class="modal-header">
                    <h4 class="modal-title">Editar categoria</h4>
                    <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
                  </div>

                  <!-- Contenido del modal De editar-->
                  <div class="modal-body">

                      <!-- inicio de form -->

                    <form action="<?php echo base_url("categoria/agregar/") ?>" method="post" enctype="multipart/form-data">

                      <h4>Categoria</h4>

                      <label for="nombreProducto2">Nombre</label><br>
                      <input type="text" name="nameCategoriaAgregar" style="width: 465px;">

                    
                          <div style="display:flex; margin-left:140px;">

                            <div class="modal-footer">
                              <button type="submit"  class="btn btn-secondary" id="btn-editar" data-bs-dismiss="modal">Agregar</button>
                            </div>
                            
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            </div>
                          </div>
                     

                  </div>
                  </form>  

                      <!-- fin del form -->

                </div>

                <!-- Pie del modal -->

              </div>
            </div>

            <!-- Fin del modal -->


            </div>
        </div>
        
    </div>
  </div>
</section>

</main><!-- End #main -->

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>


<script>
  $(function(){
      $("#btn-editar").on('click',function(e){

        $.ajax({
          type: "POST",
          url: "<?php echo base_url('categoria/edit/'); ?>",
          data: formData,
          
        })

    });


  })
</script>