<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="<?= base_url('assets/img/apple-icon.png') ?>">
  <link rel="icon" type="image/png" href="<?= base_url('assets/img/favicon.png') ?>">
  <title>Iam Indonesia | GJI Dashboard
  </title>
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <!-- Nucleo Icons -->
  <link href="https://demos.creative-tim.com/argon-dashboard-pro/assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="https://demos.creative-tim.com/argon-dashboard-pro/assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>

  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">


  <!-- CSS Files -->
  <link id="pagestyle" href="<?= base_url('assets/css/argon-dashboard.css?v=2.1.0') ?>" rel="stylesheet" />
</head>

<body class="g-sidenav-show   bg-gray-100">
  <div class="min-height-300 bg-warning position-absolute w-100"></div>
  <aside class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4 " id="sidenav-main">
    <div class="sidenav-header">
      <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
      <a class="navbar-brand m-0" href=" #" target="_blank">
        <img src="../assets/img/logo-ct-dark.png" width="26px" height="26px" class="navbar-brand-img h-100" alt="main_logo">
        <span class="ms-1 font-weight-bold">Iam Indonesia</span>
      </a>
    </div>
    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" href=""<?= base_url('dashboard') ?>">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-tv-2 text-dark text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Dashboard</span>
          </a>
        </li>
        <li class="nav-item">
        <a class="nav-link  justify-content-between align-items-center" data-bs-toggle="collapse" href="#kategoriMenu" role="button" aria-expanded="false" aria-controls="kategoriMenu">
    <div class="d-flex align-items-center">
      <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
        <i class="ni ni-folder-17 text-dark text-sm opacity-10"></i>
      </div>
      <span class="nav-link-text ms-1">Master Kategori</span>
    </div>
   
  </a>
  <div class="collapse" id="kategoriMenu">
    <ul class="nav ms-4">
      <li class="nav-item">
        <a class="nav-link" href="<?= base_url('data_akun') ?>">
          <span class="sidenav-normal">Kategori</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?= base_url('data_kategori') ?>">
          <span class="sidenav-normal">Sub Kategori</span>
        </a>
      </li>
    </ul>
  </div>
</li>


        

  <li class="nav-item">
          <a class="nav-link  justify-content-between align-items-center" data-bs-toggle="collapse" href="#TrasaksiMenu" role="button" aria-expanded="false" aria-controls="kategoriMenu">
      <div class="d-flex align-items-center">
        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
        <i class="ni ni-credit-card text-dark text-sm opacity-10"></i>
        </div>
        <span class="nav-link-text ms-1">Transaksi</span>
      </div>
    
    </a>
    <div class="collapse" id="TrasaksiMenu">
      <ul class="nav ms-4">
        <li class="nav-item">
          <a class="nav-link" href="<?= base_url('jurnal_umum') ?>">
            <span class="sidenav-normal">Transaksi</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?= base_url('jurnal_umum/tambah') ?>">
            <span class="sidenav-normal">Tambah Transaksi</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?= base_url('kas') ?>">
            <span class="sidenav-normal">Penyesuaian Kas</span>
          </a>
        </li>
      </ul>
    </div>
  </li>

  <li class="nav-item mt-3">
          <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Master Laporan</h6>
        </li>
  <li class="nav-item">
          <a class="nav-link  justify-content-between align-items-center" data-bs-toggle="collapse" href="#LaporanMenu" role="button" aria-expanded="false" aria-controls="kategoriMenu">
      <div class="d-flex align-items-center">
        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
        <i class="ni ni-book-bookmark text-dark text-sm opacity-10"></i>
        </div>
        <span class="nav-link-text ms-1">Laporan</span>
      </div>
    
    </a>
    <div class="collapse" id="LaporanMenu">
      <ul class="nav ms-4">
        <li class="nav-item">
          <a class="nav-link" href="<?= base_url('laporan/laba') ?>">
            <span class="sidenav-normal">Laporan Laba/Rugi</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?= base_url('laporan/laba') ?>">
            <span class="sidenav-normal">Laporan Kas</span>
          </a>
        </li>
      </ul>
    </div>
  </li>
       
       
        <li class="nav-item mt-3">
          <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Pengguna</h6>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="#">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-single-02 text-dark text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Users</span>
          </a>
        </li>
        
      </ul>
    </div>
    <div class="sidenav-footer mx-3 ">
      <div class="card card-plain shadow-none" id="sidenavCard">
        <!-- <img class="w-50 mx-auto" src="#" alt="sidebar_illustration"> -->
        <div class="card-body text-center p-3 w-100 pt-0">
          <div class="docs-info">
            <h6 class="mb-0">Hello, Admin</h6>
            <p class="text-xs font-weight-bold mb-0">Welcome to DJI Dashboard</p>
          </div>
        </div>
      </div>
      <!-- <a href="https://www.creative-tim.com/learning-lab/bootstrap/license/argon-dashboard" target="_blank" class="btn btn-dark btn-sm w-100 mb-3">Documentation</a> -->
      <a class="btn btn-warning btn-sm mb-0 w-100" href="#" type="button">Sign Out</a>
    </div>
  </aside>

  
  