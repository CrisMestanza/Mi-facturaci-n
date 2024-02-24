<?php 
    $session = session();

    $datosempresa = $session->get('empresa');

?>

<main id="main" class="main">

<div class="pagetitle">
  <h1>Simular Ventas</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="index.html">Home</a></li>
      <li class="breadcrumb-item active">Simular Ventas</li>
    </ol>
  </nav>
</div><!-- End Page Title -->

<section class="section dashboard">
  <div class="row">
    <div class="col-lg-12"> 
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Simular Ventas</h5>
                <a type="submit" id="btnEditar" class="btn btn-success" href="<?= base_url('/ventas/nuevaventa') ?>">
                Nueva venta
                </a> 
                <table class="table datatable">
                    <thead>
                        <tr>
                            <th scope="col">Venta</th>
                            <th scope="col">Cliente</th>
                            <th scope="col">Total</th>
                            <th scope="col">Fecha</th>
                            <th scope="col">Doc</th>
                            <th scope="col">A4</th>
                            <th scope="col">Ticket</th>
                            <th scope="col">Editar</th>
                            <th scope="col">Sunat</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                    
                            <?PHP 
                                foreach ($ventas as $venta) {
                            ?>
                            <tr>

                                <td><?= $contador+=1 ?></td>
                                <td><?= $venta['razonsocial'] ?></td>               
                                <td><?= $venta['total_venta'] ?></td>               
                                <td><?= $venta['fechaemision'] ?></td>               
                                <td><?= $venta['numcorrelativo'] ?></td>
                                
                                
                                <td><?=   "A4" ?></td>               
                                <td><?= "ticket " ?></td>               
                                <td>
                                    <a type="submit" 
                                        id="btnEditar" class="btn "  data-bs-toggle="modal" data-bs-target="#myModal2<?= $venta['idventadetalle'] ?>">
                                        <i class="fa-solid fa-pen-to-square fa-2xl" style="color: #005eff;"></i>
                                    </a>
                                        
                                    <a 
                                        id="btn-eliminar" name="eliminar" class="btn " href="<?php echo base_url('categoria/eliminar/'.$venta['idventadetalle']) ?>">
                                        <i class="fa-solid fa-trash fa-2xl" style="color: #f71b02;"></i>
                                    </a>
                                </td>
      
                                <td>Sunat</td>           
                             </tr>

                            <?PHP 
                            }
                            ?>
                    </tbody>

                </table>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal">
                Abrir Modal
                </button>

                <div class="modal" id="myModal">
                <div class="modal-dialog">
                    <div class="modal-content">
                    
                    <!-- Cabecera del modal -->
                    <div class="modal-header">
                        <h4 class="modal-title">Simular venta</h4>
                        <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
                    </div>
                    
                    <!-- Contenido del modal -->
                    <div class="modal-body">
                      
                            <h4>Datos del cliente:</h4>
                            <label for="">Nº Documento (dni/ruc)</label><br>
                            <input type="text" name="doccliente" id="doccliente">
                            <input type="button" value="search" id="consultar">
                            <br>
                            <label for="">Razon social / Nombres completos</label><br>
                            <input type="text" name="nomcliente" id="nomcliente" readonly style="width: 400px;">
                      
                    </div>
                    
                    <!-- Pie del modal -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    </div>
                    
                    </div>
                </div>
                </div>
                
            </div>
        </div>
        
    </div>
  </div>
</section>

</main><!-- End #main -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script type="text/javascript">
    
    $(document).ready(function(){
    $("#consultar").on("click", function(){

        var inputValue = $("#doccliente").val();
        
        if (inputValue.length === 8) {
            $.ajax({
                url: '<?=base_url('/ventas/api')?>',
                type: 'GET',
                dataType: 'json',
                data: { doc: inputValue },
                success: function(response){
                    // var data = JSON.parse(response);
                    var nombre = response.nombres;
                    nombre += " "+response.apellidoPaterno;
                    nombre += " "+response.apellidoMaterno;
                    $("#nomcliente").val(nombre);
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
                    // var data = JSON.parse(response);
                    var nombre = response.nombres;
                    nombre += " "+response.apellidoPaterno;
                    nombre += " "+response.apellidoMaterno;
                    $("#nomcliente").val(nombre);
                },

                error: function(){
               
                    console.log("Error");
                }
            });
        } else {
            $("#nomcliente").val("Longitud inválida");
        }
    });
});

</script>
