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
                <h5 class="card-title">Unidades</h5> 
                <!-- Table with stripped rows -->
                <table class="table datatable">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Código</th>
                            <th scope="col">Unidad</th>
                            <th scope="col">Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach($unidades as $unidad){?>
                            <tr>
                                <td><?=$contador?></td>
                                <?php $contador+=1?>
                                <td><?=$unidad['codigounidad']?></td>
                                <td><?=$unidad['abrunidad']?></td>
                              
                                <td>
                                  <a href="<?php echo base_url('unidades/activar/'.$unidad['idunidad']) ?>" class="btn btn-primary">Activar</a>

                                  <a href="<?php echo base_url('unidades/desactivar/'.$unidad['idunidad']) ?>" class="btn btn-danger">Desactivar</a>

                                </td>  


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

