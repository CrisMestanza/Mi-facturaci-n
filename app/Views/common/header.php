<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Facturación</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="<?=base_url()?>assets/img/favicon.png" rel="icon">
  <link href="<?=base_url()?>assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
  
  <!-- Vendor CSS Files -->
  <link href="<?=base_url()?>assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="<?=base_url()?>assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="<?=base_url()?>assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="<?=base_url()?>assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="<?=base_url()?>assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="<?=base_url()?>assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="<?=base_url()?>assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="<?=base_url()?>assets/css/style.css" rel="stylesheet">

</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <a href="<?=base_url()?>cpanel" class="logo d-flex align-items-center">
        <img src="<?=base_url()?>assets/img/logo.png" alt="">
        <span class="d-none d-lg-block">Sistema de facturación</span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->

    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">

        <li class="nav-item dropdown pe-3">

          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            <img src="https://i.pinimg.com/736x/28/44/88/284488453f7490e41e7467f4d4aefed2.jpg" alt="Profile" class="rounded-circle">
            <span class="d-none d-md-block dropdown-toggle ps-2"> <?php echo $nombreUsaurio ?> </span>
          </a><!-- End Profile Iamge Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">
              <span><?php echo $tipoUsuario ?></span>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>
            <li>
              <a class="dropdown-item d-flex align-items-center" href="<?=base_url()?>logout">
                <i class="bi bi-box-arrow-right"></i>
                <span>Cerrar sesion</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>
          </ul><!-- End Profile Dropdown Items -->
        </li><!-- End Profile Nav -->

      </ul>
    </nav><!-- End Icons Navigation -->

  </header><!-- End Header -->

  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link " href="<?=base_url()?>unidades">
          <i class="bi bi-grid"></i>
          <span>Unidades</span>
        </a>
      </li><!-- End Dashboard Nav -->
      <li class="nav-item">
        <a class="nav-link " href="<?=base_url()?>categorias">
          <i class="bi bi-grid"></i>
          <span>Categorias</span>
        </a>
      </li><!-- End Dashboard Nav -->
      <li class="nav-item">
        <a class="nav-link " href="<?=base_url()?>productos">
          <i class="bi bi-grid"></i>
          <span>Productos</span>
        </a>
      </li><!-- End Dashboard Nav -->
      <li class="nav-item">
        <a class="nav-link " href="<?=base_url()?>ventas">
          <i class="bi bi-grid"></i>
          <span>Simular venta</span>
        </a>
      </li><!-- End Dashboard Nav -->

      <li class="nav-item">
        <a class="nav-link " href="<?=base_url()?>compras">
          <i class="bi bi-grid"></i>
          <span>Compras</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link " href="<?=base_url()?>configuracion">
          <i class="bi bi-grid"></i>
          <span>Configuración</span>
        </a>
      </li>

    </ul>

  </aside><!-- End Sidebar-->