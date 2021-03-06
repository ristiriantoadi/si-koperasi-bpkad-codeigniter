<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 2 | Starter</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="<?php echo base_url('assets/bower_components/bootstrap/dist/css/bootstrap.min.css') ?>">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url('assets/bower_components/font-awesome/css/font-awesome.min.css') ?>">
  
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo base_url('assets/bower_components/Ionicons/css/ionicons.min.css') ?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url('assets/dist/css/AdminLTE.min.css')?>">
  <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
        page. However, you can choose any other skin. Make sure you
        apply the skin class to the body tag so the changes take effect. -->
  <link rel="stylesheet" href="<?php echo base_url('assets/dist/css/skins/skin-blue.min.css') ?>">
  <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />


  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  
  <link rel="stylesheet"
        href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
  

  
  <style>

    .belum-lunas{
      color:red;
      font-weight: bold;
    }

    
    .lunas{
      color:green;
      font-weight: bold;
    }
    
    .form-control{
      border-radius:4px;
      box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
    }
    .row{
      margin-bottom:10px; 
      margin-top:10px;
      padding-left: 10px;
      padding-right:10px;
    }
  </style>
</head>
<!--
BODY TAG OPTIONS:
=================
Apply one or more of the following classes to get the
desired effect
|---------------------------------------------------------|
| SKINS         | skin-blue                               |
|               | skin-black                              |
|               | skin-purple                             |
|               | skin-yellow                             |
|               | skin-red                                |
|               | skin-green                              |
|---------------------------------------------------------|
|LAYOUT OPTIONS | fixed                                   |
|               | layout-boxed                            |
|               | layout-top-nav                          |
|               | sidebar-collapse                        |
|               | sidebar-mini                            |
|---------------------------------------------------------|
-->
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <!-- Main Header -->
  <header class="main-header">

    <!-- Logo -->
    <a href="index2.html" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>S</b>P</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Simpan</b> Pinjam</span>
    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- User Account Menu -->
          <li class="dropdown user user-menu">
            <!-- Menu Toggle Button -->
            <a href="<?php echo site_url("anggota/logout") ?>" >
              <!-- The user image in the navbar-->
              <!-- hidden-xs hides the username on small devices so only the image appears. -->
              <span class="hidden-xs">Logout</span>
            </a>
            <!--
            <ul class="dropdown-menu">
              Menu Footer
              <li class="user-footer">
                <div class="pull-right">
                  <a href="<?php echo site_url('anggota/logout') ?>" class="btn btn-default btn-flat">Logout</a>
                </div>
              </li>
            </ul>
          </li>
          
        </ul>
        -->
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

      <!-- Sidebar user panel (optional) -->
      <div class="user-panel" style="height:50px">
        <div class="pull-left info">
          <p style="font-size:23px;text-align:center">Admin</p>
        </div>
      </div>
      <!-- Sidebar Menu -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">SIMPAN PINJAM</li>
        <!-- Optionally, you can add icons to the links -->
        <li class="treeview">
          <a href="#">
            <i class="fa fa-share"></i> <span>Data Anggota</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu" style="display: none;">
            <li class="<?php echo ($halaman == 'data_anggota_aktif' ? 'active': '#') ?>"><a href="<?php echo site_url('anggota/aktif') ?>"><i class="fa fa-fw fa-users"></i><span>Data Anggota Aktif</span></a></li>
            <li class="<?php echo ($halaman == 'data_anggota_non_aktif' ? 'active': '#') ?>"><a href="<?php echo site_url('anggota/nonaktif') ?>"><i class="fa fa-fw fa-users"></i><span>Data Anggota Nonaktif</span></a></li> 
            <li class="<?php echo ($halaman == 'tambah_anggota' ? 'active': '#') ?>"><a href="<?php echo site_url('anggota/tambah_anggota') ?>"><i class="fa fa-fw fa-user-plus"></i><span>Tambah Anggota</span></a></li>          
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-share"></i> <span>Data Iuran</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu" style="display: none;">
            <li class="<?php echo ($halaman == 'iuran_pokok' ? 'active': '#') ?>"><a href="<?php echo site_url('anggota/iuran_pokok') ?>"><i class="fa fa-fw fa-dollar"></i><span>Iuran Pokok</span></a></li>
            <li class="<?php echo ($halaman == 'iuran_wajib' ? 'active': '#') ?>"><a href="<?php echo site_url('iuran_wajib/data_iuran_wajib') ?>"><i class="fa fa-fw fa-money"></i><span>Iuran Wajib</span></a></li> 
            <li class="<?php echo ($halaman == 'tambah_iuran_wajib' ? 'active': '#') ?>"><a href="<?php echo site_url('iuran_wajib/page_tambah_iuran_wajib') ?>"><i class="fa fa-fw fa-user-plus"></i><span>Tambah Iuran Wajib</span></a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-share"></i> <span>Data Pembiayaan</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu" style="display: none;">
            <li class="<?php echo ($halaman == 'pembiayaan' ? 'active': '#') ?>"><a href="<?php echo site_url('pembiayaan/data_pembiayaan') ?>"><i class="fa fa-fw fa-credit-card"></i><span>Pembiayaan</span></a></li> 
            <li class="<?php echo ($halaman == 'tambah_pembiayaan' ? 'active': '#') ?>"><a href="<?php echo site_url('pembiayaan/page_tambah_pembiayaan') ?>"><i class="fa fa-fw fa-user-plus"></i><span>Tambah Pembiayaan</span></a></li>
            <li class="<?php echo ($halaman == 'biaya_admin' ? 'active': '#') ?>"><a href="<?php echo site_url('pembiayaan/biaya_admin') ?>"><i class="fa fa-fw fa-money"></i><span>Biaya Administrasi</span></a></li> 
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-share"></i> <span>Data Angsuran</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu" style="display: none;">
            <li class="<?php echo ($halaman == 'ijarah' ? 'active': '#') ?>"><a href="<?php echo site_url('angsuran/ijarah') ?>"><i class="fa fa-fw fa-money"></i><span>Ijarah</span></a></li> 
            <li class="<?php echo ($halaman == 'tambah_angsuran' ? 'active': '#') ?>"><a href="<?php echo site_url('angsuran/page_tambah_angsuran') ?>"><i class="fa fa-fw fa-user-plus"></i><span>Pembayaran Angsuran</span></a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-share"></i> <span>Master Data</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu" style="display: none;">
            <li class="<?php echo ($halaman == 'data_master_iuran_wajib' ? 'active': '#') ?>"><a href="<?php echo site_url('master/data_master_iuran_wajib') ?>"><i class="fa fa-fw fa-users"></i><span>Iuran Wajib</span></a></li>
            <li class="<?php echo ($halaman == 'data_master_biaya_admin' ? 'active': '#') ?>"><a href="<?php echo site_url('master/data_master_biaya_admin') ?>"><i class="fa fa-fw fa-users"></i><span>Biaya Admin</span></a></li>   
            <li class="<?php echo ($halaman == 'data_bidang' ? 'active': '#') ?>"><a href="<?php echo site_url('master/data_bidang') ?>"><i class="fa fa-fw fa-users"></i><span>Bidang</span></a></li>          </ul>
        </li>
      </ul>
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>