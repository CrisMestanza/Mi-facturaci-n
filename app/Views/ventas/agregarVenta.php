
<main id="main" class="main">

<div class="pagetitle">
  <h1>Ventas</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="index.html">Home</a></li>
      <li class="breadcrumb-item active">Ventas</li>
    </ol>
  </nav>
</div><!-- End Page Title -->

<section class="section dashboard">
  <div class="row">
    <div class="col-lg-12"> 
        <div class="card">
            <div class="card-body">
         <form action="<?php echo base_url("ventas/generar")?>" method="post" enctype="multipart/form-data" autocomplete="off">
            <h5 class="card-title">Nueva compra</h5> 
            <h4>Datos del cliente:</h4>
                    <div style="display:flex">
                    
                   
                        <div >
                            <label for="">Nº Documento (dni/ruc)</label><br>
                            <input class="form-control" type="text" name="doccliente" id="doccliente">
                             <input type="button" class="btn btn-dark" value="search" id="consultar"> <!-- Boton search -->
                        </div>
                        <br>
                        <div>

                            <label for="">Razon social / Nombres completos</label><br>
                            <input class="form-control" type="text" name="nomcliente" id="nomcliente" readonly style="width: 400px;">
                        </div>
                        <br>
                        <div>

                            <label for="">Dirección</label><br> 
                            <input class="form-control" type="text" name="direccion" id="direccion" readonly style="width: 400px;">
                        </div>

              
                    </div>

                    <br>
                    <h4>Datos de la venta</h4>
                    <div style="display:flex">
                        <div class="input-group" id="compra">
                            <label class="input-group-text">Tipo documento:</label>

                            <select name="tipoDocumento" id="tipoDocumento" class="form-control"  aria-label="With textarea">
                                <?php foreach ($tipoDocumento as $tipoDocumento) {?>
                                    <option value="<?= $tipoDocumento['nombredocumento'] ?>"> <?= $tipoDocumento['nombredocumento'] ?> </option>
                                <?php } ?>
                            </select>
                        </div>

                        <div class="input-group">
                            <label class="input-group-text">Serie</label>
                            <input type="text" class="form-control" aria-label="With textarea" id="serie" name="serie">
                        </div>

                        <div class="input-group">
                            <label class="input-group-text">N° Placa</label>
                            <input type="text" class="form-control" aria-label="With textarea" name="placa">
                        </div>

                        <div class="input-group">
                            <label class="input-group-text">Fecha</label>
                            <input type="date" class="form-control" aria-label="With textarea" name="fechDocumento">
                        </div>
                    </div>
                    
                    <br>
                    <h4 id="datosProductoTitle">Datos de los productos</h4>
                    <br>
                <!-- Table with stripped rows -->
                
                    <table class="table datatable" id="tabla">
                        <thead>
                            <tr>
                                <th>Descripcion</th>
                                <th scope="col">Unid. Medida	</th>
                                <th scope="col">Cantidad</th>
                                <!-- <th scope="col">Tipo Igv	</th> -->
                                <th scope="col">Precio Unitario	</th>
                                <th scope="col">Total	</th>
                                
                                <th scope="col">Acción</th>
                            </tr>
                        </thead>
                        <tbody id="cuerpo">
                      
                                <tr>

                                  <td>
                                        <div class="input-group">
                                            
                                            <input class="form-control busqueda"type="list" list="opcionesBusqueda" aria-label="With textarea" name="producto[nombre][]">

                                            <datalist id="opcionesBusqueda">
                                              
                                            </datalist>

                                          </div>
                                  </td>

                                  <td>
                                        <div class="input-group">  
                                            <select name="producto[unidad][]" id="unidad" class="form-control"  aria-label="With textarea">
                                                    <?php foreach ($unidades as $unidad) {?>
                                                    <option value="<?= $unidad['idunidad'] ?>"> <?= $unidad['abrunidad'] ?> </option>
                                                    <?php } ?>
                                            </select>
                                        </div>   
                                  </td>

                                  <td>
                                        <div class="input-group">
                                      
                                            <input class="form-control" id="cantidad" name="producto[cantidad][]" aria-label="With textarea">
                                        </div>
                                  </td>
                                  <!-- Para más adelante -->
                                  <!-- <td>
                                        <div class="input-group">
                                            <select name="producto[tipoIgv][]" id="" class="form-control"  aria-label="With textarea">
                                              
                                            </select>
                                            
                                        </div>  
                                  </td> -->  
                                  <td>
                                        
                                        <div class="input-group">
                                            <input class="form-control" id="precioUnitario" name="producto[precioUnitario][]" readonly aria-label="With textarea">
                                        </div> 
                                     
                                  </td>
                                  <td>
                                        <div class="input-group">
                                            
                                            <input class="form-control" id="total" name="producto[total][]" readonlyaria-label="With textarea">
                                        </div>  
                                  </td>
                                 
                                  <td>
                                    <button type="button" id="" class="btn btn-danger">Eliminar</button>
                                  </td>
                                </tr>
                                
                              
                          
                        </tbody>

                    </table>
                    
                    <div style="display: flex;">
                        <div>
                            <button type="button" id="agregarProducto" class="btn btn-primary">Agregar Producto</button>
                            <br><br>
                            <div style="display:flex;">
                                
                            <div class="modal-footer">
                                <button type="submit" id="guardar" class="btn btn-info" >Generar comprobante de pago</button>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-success" style="margin-left: 1rem;">Regresar a ventas</button>
                            </div>
                            <div style="margin-left: 50px;">
                                <span>Total Op. Exonerada: S/.</span>
                                <input type="number" class="ventaTotal" readonly>
                                <div style="margin-left: 73px;">
                                    <span>Pago Total: S/.</span>
                                    <input type="number" class="ventaTotal" readonly>
                                </div>
                            </div>
                        </div>
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

//Agregar producto
  $('#agregarProducto').click(function(){
      
      let nuevaFila = '<tr>';
     
      nuevaFila += '<td><div class="input-group"><input class="form-control busqueda" type="list" list="opcionesBusqueda" aria-label="With textarea" name="producto[nombre][]"><datalist id="opcionesBusqueda"></datalist></div></td>';             
      nuevaFila += '<td><div class="input-group"><select name="producto[unidad][]" id="unidad" class="form-control" aria-label="With textarea"><?php foreach ($unidades as $unidad): ?><option value="<?= $unidad['idunidad'] ?>"><?= $unidad['abrunidad'] ?></option><?php endforeach; ?></select></div></td>';
      nuevaFila += '<td><div class="input-group"><input class="form-control" id="cantidad" name="producto[cantidad][]" aria-label="With textarea"></div></td>';
    //   nuevaFila += '<td><div class="input-group"><select name="producto[tipoIgv][]" id="" class="form-control" aria-label="With textarea"></select></div></td>';
      nuevaFila += '<td><div class="input-group"><input class="form-control" id="precioUnitario" name="producto[precioUnitario][]" readonly aria-label="With textarea"></div></td>';
      nuevaFila += '<td><div class="input-group"><input class="form-control" id="total" name="producto[total][]" readonly aria-label="With textarea"></div></td>';
    
      nuevaFila += '<td><button type="button" id="btnEliminar" class="btn btn-danger eliminarProducto">Eliminar</button></td>';
      nuevaFila += '</tr>';
      
        button = '<button type="button"  class="btn btn-primary">Agregar Producto</button>'

        $('tbody').append(nuevaFila);

        busqueda();

     
    });

// Delegación de eventos para manejar clics en los botones "Eliminar" para que solo elimine la fila seleccionada 
   $('tbody').on('click','#btnEliminar',function(){
 
      $(this).closest('tr').remove();
      busqueda();
      
    });

//Hacer busqueda de precio unitario del producto escrito en el input descripción
    let busqueda = ()=>{
      $(".busqueda").on('input',function(e){

        let currentRow = $(this).closest('tr'); 

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
                        $('#precioUnitario').empty();
                        // $('#precioUnitario').val(precioUnitario);
                        currentRow.find('#precioUnitario').val(precioUnitario);
                });
            }
          })

        });
  }

  busqueda();


//Guardarr
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


  


// Buscar en la api de cliente

    $("#consultar").on("click", function(){
        $("#nomcliente").empty();
        var inputValue = $("#doccliente").val();
        
        if (inputValue.length === 8) {
            $.ajax({
                url: '<?=base_url('/ventas/api')?>',
                type: 'GET',
                dataType: 'json',
                data: { doc: inputValue },
                success: function(response){
                    $("#nomcliente").empty();
                    // var data = JSON.parse(response);
                    var nombre = response.nombres;
                    nombre += " "+response.apellidoPaterno;
                    nombre += " "+response.apellidoMaterno;
                    $("#nomcliente").val(nombre);
                    $("#direccion").val(" ");
                },

                error: function(){
               
                    console.log("Error");
                }
            });
        } else if (inputValue.length === 11) {
            
            $.ajax({
                url: '<?=base_url('/ventas/api')?>',
                type: 'GET',
                dataType: 'json',
                data: { doc: inputValue },
                success: function(response){
                    $("#nomcliente").empty();
                    // var data = JSON.parse(response);
                    var nombre = response.razonSocial;
                    var direccion = response.direccion;
                    console.log(nombre+direccion);
                    $("#nomcliente").val(nombre);
                    $("#direccion").val(direccion);
                },

                error: function(){
               
                    console.log("Error");
                }
            });
        } else {
            $("#nomcliente").val("Longitud inválida");
        }
    });

    //Calcular el total
    $("body").on("input", "#cantidad", function(e) {
        let currentRow = $(this).closest('tr');
        let cantidad = parseInt($(this).val()); // Convertir a entero
        let precioUnitario = parseFloat(currentRow.find("#precioUnitario").val()); // Convertir a flotante desde el campo de la misma fila
        let total = isNaN(cantidad) || isNaN(precioUnitario) ? 0 : precioUnitario * cantidad; // Calcular el total solo si ambos valores son números
        currentRow.find('#total').val(total);

        calcularTotal();
    });

    // Calcular total de la venta
    let calcularTotal =()=>{
        let total = 0;
        let currentRow = $(this).closest('#total');
        $('#tabla tbody #total').each(function(index, value){
            total+= parseFloat($(this).val())
            console.log(total);
            $(".ventaTotal").val(total);
        });
    }

    $('#tipoDocumento').change(function(){
        let seleccion = $(this).val();
        let serie = "";
        if(seleccion=="Boleta"){
            serie = "B001"
        }
        else if (seleccion=="Factura") {
            serie = "F001" 
        }
        
        $('#serie').val(serie);

    });
})




    
</script>
