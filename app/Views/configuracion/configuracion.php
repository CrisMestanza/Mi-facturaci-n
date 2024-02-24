<main id="main" class="main">

<div class="pagetitle">
  <h1>Categorias</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="index.html">Home</a></li>
      <li class="breadcrumb-item active">Configuración</li>
    </ol>
  </nav>
</div><!-- End Page Title -->

<section class="section dashboard">
  <div class="row">
    <div class="col-lg-12"> 
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Configuración</h5> 
                
                <!-- Table with stripped rows -->
                <table class="table datatable">
                    <thead>
                        <tr>
                            <th scope="col">Ruc</th>
                            <th scope="col">Razón Social</th>
                            <th scope="col">Logo</th>
                            <th scope="col">Dirección</th>
                            <th scope="col">Telefono</th>
                            <th scope="col">Modificar</th>
                            <th scope="col">Activar modo producción</th>
                            <th scope="col">Activar modo desarrollo</th>
                        </tr>

                    </thead>

                    <tbody>
                      
                      
                      <?php foreach ($empresas as $empresa ) { ?>
                    
                          <tr>
                            <td><?php echo $empresa['ruc'] ?></td>
                            <td><?php echo $empresa['razonsocial'] ?></td>
                            <td><?php 

                               $imagenPath = 'assets/img/empresa/' . $empresa['logo'];
                      
                               // Verificar si la imagen existe antes de intentar mostrarla
                               if (file_exists($imagenPath)) {
                                   echo '<img src=" '. base_url($imagenPath) .' " alt="Imagen del producto" style="width:80px;">';
                               } else {
                                   echo 'No hay imagen disponible';
                               }
                               ?>
                            
                             </td>
                            <td><?php echo $empresa['direccion'] ?></td>
                            <td><?php echo $empresa['telefono'] ?></td>
                       
                            <td>
                                <a type="submit" 
                                    id="btnEditar" class="btn "  data-bs-toggle="modal" data-bs-target="#myModal2"><i class="fa-solid fa-pen-to-square fa-2xl" style="color: #005eff;"></i></a>     
                           </td> 
                           <td>
                                  <button  class="btn btn-primary" id="pro">Producción</button>
                           </td>
                           <td>
                                <button class="btn btn-success" id="desa">Desarrollo</button>
                           </td>
                          </tr>
                    
                    </tbody>
                    
                </table>
                <!-- End Table with stripped rows -->
                
                <!-- Modal de editar -->
            <div class="modal" id="myModal2">
              <div class="modal-dialog">
                <div class="modal-content">

                  <!-- Cabecera del modal -->
                  <div class="modal-header">
                    <h4 class="modal-title">Editar Empresa</h4>
                    <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
                  </div>

                  <!-- Contenido del modal De editar-->
                  <div class="modal-body">

                      <!-- inicio de form -->

                    <form action="<?php echo base_url("/configuracion/editar/") ?>" method="post" enctype="multipart/form-data">

                      <h4>Empresa</h4>

                      <label for="nombreProducto2">Ruc</label><br>
                      <input type="text" name="rucCategoria" id="nombreProducto2" value="<?php echo $empresa['ruc'] ?>"  style="width: 465px;">

                      <label for="nombreProducto2">Razón social</label><br>
                      <input type="text" name="razonSocial" id="nombreProducto2"  style="width: 465px;" value="<?php echo $empresa['razonsocial'] ?>">

                      <label for="nombreProducto2">nombreComercia</label><br>
                      <input type="text" name="nombreComercia" id="nombreProducto2"  style="width: 465px;" value="<?php echo $empresa['nombrecomercial'] ?>">

                      <label for="nombreProducto2">Dirección</label><br>
                      <input type="text" name="Direccion" id="nombreProducto2"  style="width: 465px;" value="<?php echo $empresa['direccion'] ?>"> 

                      
                      <label for="nombreProducto2">Telefono</label><br>
                      <input type="text" name="telefono" id="nombreProducto2"  style="width: 465px;" value="<?php echo $empresa['telefono'] ?>">


                      <label for="nombreProducto2">Usuario secundario(User)</label><br>
                      <input type="text" name="user" id="nombreProducto2"  style="width: 465px;" value="<?php echo $empresa['usersec'] ?>">

                      
                      <label for="nombreProducto2">Usuario secundario(Password)</label><br>
                      <input type="text" name="password" id="nombreProducto2"  style="width: 465px;"  value="<?php echo $empresa['passwordsec'] ?>">

                      <label for="nombreProducto2">Departamento</label><br>

                      <select class="form-select" id="mySelect" aria-label="Default select example" name="categoria2">
                        <?php foreach ($departamentos as $departamento) { ?>
                          <option selected value="<?= $departamento['iddepartamentos'] ?>">
                            <?= $departamento['nombredepartamento'] ?>
                          </option>
                        <?php } ?>
                      </select>



                      <label for="nombreProducto2">Provincia</label><br>

                      <select class="form-select" id="secondSelect" aria-label="Default select example" name="categoria2">
                        
                      </select>


                      <label for="nombreProducto2">Distrito</label><br>

                      <select class="form-select" id="distrito" aria-label="Default select example" name="categoria2" >
                        
                      </select>



                      <label for="nombreProducto2">Ubigueo</label><br>
                      <input type="text" id="ubigeo" name="ubigueo" style="width: 465px;" readonly  value="<?php echo $empresa['ubigueo'] ?>">
                    

                      <br>
                      <label for="nombreProducto2">Imagen de la Empresa</label><br>
                      <input type="file" name="imagenEmpresa" id="nombreProducto2"  style="width: 465px;">


                    
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
                 <?php } ?>
                      <!-- fin del form -->

                </div>

                <!-- Pie del modal -->

              </div>
            </div>

            <!-- Fin del modal Editar-->

        
            </div>
        </div>
        
    </div>
  </div>
</section>

</main><!-- End #main -->


<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<script>

$(function(){

  $('#mySelect').change(function(){
            $('#secondSelect').empty();
                // Obtener el valor seleccionado
                var selectedValue = $(this).val();
                // Realizar la solicitud AJAX
                        $.ajax({
                        type: "GET",
                        dataType: "JSON",
                        url: "<?php echo base_url('/configuracion/getProvincia'); ?>",
                        data: {selected_value: selectedValue},
                        success: function (response) {

                          $.each(response, function(index, item) {
            
                            var idProvincia = item.idprovincia;
                            var nombreProvincia = item.nombreprovincia;
                            var idDepartamento = item.iddepartamento;
                            
                            $('#secondSelect').append('<option value="' + idProvincia + '">' + nombreProvincia + '</option>');
   
                         
                        });
                        }
                      })
              })


        $('#secondSelect').change(function(){
            $('#distrito').empty();
                var selectedValue = $(this).val();
   
                        $.ajax({
                        type: "GET",
                        dataType: "JSON",
                        url: "<?php echo base_url('/configuracion/getDistrito'); ?>",
                        // dataType:'json',
                        data: {selected_value: selectedValue},
                        success: function (response) {


                          $.each(response, function(index, item) {
                           
                            var idProvincia = item.iddistrito;
                            var nombreProvincia = item.nombredistrito;
                            var ubigueo = item.ubigeo;

                            
                            $('#distrito').append('<option value="' + idProvincia + '">' + nombreProvincia + '</option>');
                            
                        
                        });
                        }
                      })
              })
              

              $('#distrito').change(function(){
                $('#ubigeo').empty();
                var selectedValue = $(this).val();

                $.ajax({
                        type: "GET",
                        dataType: "JSON",
                        url: "<?php echo base_url('/configuracion/getUbigueo'); ?>",
                        // dataType:'json',
                        data: {selected_value: selectedValue},
                        success: function (response) {


                          $.each(response, function(index, item) {

                            var ubigueo = item.ubigeo;
                           
                            $('#ubigeo').val(ubigueo);
                        });
                        }
                      })
              })

              $('#pro').click(function(){
                mododev = 1;
                $.ajax({
                        type: "GET",

                        url: "<?php echo base_url('/configuracion/activar'); ?>",

                        data: {mododev1: mododev},
                        success: function (response) {
                         alert('Sistema en modo producción');
                          
                        },
                        error: function (jqXHR, textStatus, errorThrown) {
                          alert('Error');
                            }
                      })
              })

              $('#desa').click(function(){
                mododev = 0;
                $.ajax({
                        type: "GET",

                        url: "<?php echo base_url('/configuracion/desactivar'); ?>",

                        data: {mododev1: mododev},
                        success: function (response) {
                          alert('Sistema en modo desarrollo');

                        },
                        error: function (jqXHR, textStatus, errorThrown) {
                          alert('Error');
                            }
                      })
              })
  
});


            
      

    
</script>