
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
         <form action="<?php echo base_url("compras/agregar")?>" method="post" enctype="multipart/form-data" autocomplete="off">
            <h5 class="card-title">Nueva compra</h5> 

                <h4>Datos de la Compra</h4>
                    <div style="display:flex">
                        <div class="input-group" id="compra">
                            <label class="input-group-text">Número de documento</label>
                            <input type="text" class="form-control" aria-label="With textarea" name="numcorrelativo">
                        </div>
                      
                        <div class="input-group">
                            <label class="input-group-text">Fecha</label>
                            <input type="date" class="form-control" aria-label="With textarea" name="fechDocumento">
                        </div>
                    </div>
                    <br>
                    <h3>Proveedor</h3>
                    <select class="form-select" aria-label="Default select example" name="proveedor">
                        <?php foreach ($Proveedores as $Proveedor) { ?>

                          <option selected value="<?= $Proveedor['idproveedor'] ?>">
                            <?= $Proveedor['razonsocial'] ?>
                          </option>
                        <?php } ?>
                    </select>
                    <br>
                    <h4 id="datosProductoTitle">Datos de los productos</h4>
                    <br>
                <!-- Table with stripped rows -->
                
                    <table class="table datatable">
                        <thead>
                            <tr>
                                <th>Categoria</th>
                                <th scope="col">Nombre</th>
                                <th scope="col">Descripción</th>
                                <th scope="col">Precio unitario</th>
                                <th scope="col">Stock</th>
                                
                                <th scope="col">Acción</th>
                            </tr>
                        </thead>
                        <tbody id="cuerpo">
                      
                                <tr>
                                  <td>
                                        <select class="form-select" aria-label="Default select example" name="producto[categoria][]">
                                            <?php foreach ($categorias as $categoria) { ?>

                                            <option selected value="<?= $categoria['idcategoria'] ?>">
                                              <?= $categoria['nomcategoria'] ?>
                                            </option>
                                            <?php } ?>
                                        </select>
                                  </td>
                                  <td>
                                        <div class="input-group">
                                            
                                            <input class="form-control busqueda"type="list" list="opcionesBusqueda" aria-label="With textarea" name="producto[nombre][]">

                                            <datalist id="opcionesBusqueda">
                                              
                                            </datalist>

                                          </div>
                                  </td>
                                  <td>
                                        <div class="input-group">
                                            
                                            <input class="form-control " name="producto[detalle][]" aria-label="With textarea">
                                        </div> 
                                  </td>
                                  <td>
                                        <div class="input-group">
                                      
                                            <input class="form-control" name="producto[precio][]" aria-label="With textarea">
                                        </div>
                                  </td>
                                  <td>
                                        <div class="input-group">
                                            
                                            <input class="form-control" name="producto[stock][]" aria-label="With textarea">
                                        </div>  
                                  </td>
                                 
                                  <td>
                                    <button type="button" id="" class="btn btn-danger">Eliminar</button>
                                  </td>
                                </tr>
                                
                              
                          
                        </tbody>

                    </table>
                    
                        <button type="button" id="agregarProducto" class="btn btn-primary">Agregar Producto</button>
                        <br><br>
                        <div style="display:flex;">
                            
                          <div class="modal-footer">
                            <button type="submit" id="guardar" class="btn btn-info" >Guardar productos</button>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-success" style="margin-left: 1rem;">Cerrar</button>
                        </div>
                </form>
                <!-- End Table with stripped rows -->


                
            </div>
        </div>
        
    </div>
  </div>
</section>
</main><!-- End #main -->


<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>

$(function(){
  $('#agregarProducto').click(function(){
      
      let nuevaFila = '<tr>';
      nuevaFila += '<td><select class="form-select" aria-label="Default select example" name="producto[categoria][]">';
        <?php foreach ($categorias as $categoria) { ?>
      nuevaFila += '<option value="<?= $categoria['idcategoria'] ?>"><?= $categoria['nomcategoria'] ?></option>';
        <?php } ?>
      nuevaFila += '</select></td>';
      nuevaFila += '<td><div class="input-group "><input class="form-control busqueda"type="list" list="opcionesBusqueda" aria-label="With textarea" name="producto[nombre][]"></div></td>';
                       
      nuevaFila += '<td><div class="input-group"><input class="form-control" name="producto[detalle][]" aria-label="With textarea"></div></td>';
      nuevaFila += '<td><div class="input-group"><input class="form-control" type="int" name="producto[precio][]" aria-label="With textarea"></div></td>';
      nuevaFila += '<td><div class="input-group"><input class="form-control" type="int" name="producto[stock][]" aria-label="With textarea"></div></td>';
    
      nuevaFila += '<td><button type="button" id="btnEliminar" class="btn btn-danger eliminarProducto">Eliminar</button></td>';
      nuevaFila += '</tr>';
        button = '<button type="button"  class="btn btn-primary">Agregar Producto</button>'

        $('tbody').append(nuevaFila);

        busqueda();

     
    });

   // Delegación de eventos para manejar clics en los botones "Eliminar"
   $('tbody').on('click','#btnEliminar',function(){
 
      $(this).closest('tr').remove();
      busqueda();
      
    });

      //Opciones productos de la busqueda
    let busqueda = ()=>{
      $(".busqueda").on('input',function(e){

        $.ajax({
            type: "POST",
            url: "<?php echo base_url('compras/busqueda'); ?>",
            dataType:'json',
            data: {busqueda: $(this).val()},
            success: function (response) {
              $('#opcionesBusqueda').empty();

              $.each(response, function(index, value) {
                    precioUnitario=value.preciounitario
                    opciones = '<option value="' + value.nomproducto + '"</option>';
                        $('#opcionesBusqueda').append(opciones);
                        
                });
              
            }
          })

        });
  }

  busqueda();

});

   $(function(){
    $("#guardar").click(function(){
      $.ajax({
            type: "POST",
            url: "<?php echo base_url('compras/agregar'); ?>",
            data: formData,
            success: function (response) {
             
               console.log(response);
            }
          })
    });
   })

  

    
</script>
