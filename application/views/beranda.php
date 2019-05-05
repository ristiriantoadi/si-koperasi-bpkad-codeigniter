
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="background-color:white">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Beranda</h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
        <li class="active">Here</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

      <!--------------------------
        | Your Page Content Here |
        -------------------------->
      <div class="container">
        <div class="col-sm-11">
          <div class="panel panel-default">
            <div class="panel-body">
              <div class="row">
                <div class="col-lg-6">
                  <h1 class="page-header">Anggota</h1>
                  <div class="col-lg-6 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-light-blue">
                      <div class="inner">
                        <h3><?php echo $jumlah_anggota_aktif ?></h3>
                        <p><b>Jumlah Anggota Aktif</b></p>
                      </div>
                      <div class="icon">
                        <i></i>
                      </div>
                      <a href="<?php echo site_url('anggota/aktif') ?>" class="small-box-footer">Info Lengkap <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                  </div>
                  <div class="col-lg-6 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-gray">
                      <div class="inner">
                        <h3><?php echo $jumlah_anggota_nonaktif ?></h3>
                        <p><b>Jumlah Anggota Nonaktif</b></p>
                      </div>
                      <div class="icon">
                        <i></i>
                      </div>
                      <a href="<?php echo site_url('anggota/nonaktif') ?>" class="small-box-footer">Info Lengkap <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                  </div>
                </div>
                <div class="col-lg-6">
                  <h1 class="page-header">Iuran</h1>
                  <div class="col-lg-6 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-yellow">
                      <div class="inner">
                        <h4 class="uang"><?php echo $jumlah_iuran_pokok ?></h4>
                        <p><b>Total Iuran Pokok</b></p>
                      </div>
                      <div class="icon">
                        <i></i>
                      </div>
                      <a href="<?php echo site_url('anggota/iuran_pokok') ?>" class="small-box-footer">Info Lengkap <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                  </div>
                  <div class="col-lg-6 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-aqua">
                      <div class="inner">
                        <h4 class="uang"><?php echo $jumlah_iuran_wajib ?></h4>
                        <p><b>Total Iuran Wajib</b></p>
                      </div>
                      <div class="icon">
                        <i></i>
                      </div>
                      <a href="<?php echo site_url('iuran_wajib/data_iuran_wajib') ?>" class="small-box-footer">Info Lengkap <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-lg-6">
                  <h1 class="page-header">Pembiayaan</h1>
                  <div class="col-lg-12 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-navy">
                      <div class="inner">
                        <h3 class="uang"><?php echo $jumlah_pembiayaan ?></h3>
                        <p><b>Total Pembiayaan</b></p>
                      </div>
                      <div class="icon">
                        <i></i>
                      </div>
                      <a href="<?php echo site_url('pembiayaan/data_pembiayaan') ?>" class="small-box-footer">Info Lengkap <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                  </div>
                </div>
                <div class="col-lg-6">
                  <h1 class="page-header">Ijarah dan Biaya Administrasi</h1>
                  <div class="col-lg-6 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-olive">
                      <div class="inner">
                        <h4 class="uang"><?php echo $jumlah_ijarah ?></h4>
                        <p><b>Total Ijarah</b></p>
                      </div>
                      <div class="icon">
                        <i></i>
                      </div>
                      <a href="<?php echo site_url('angsuran/ijarah') ?>" class="small-box-footer">Info Lengkap <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                  </div>
                  <div class="col-lg-6 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-green">
                      <div class="inner">
                        <h4 class="uang"><?php echo $jumlah_biaya_administrasi ?></h4>
                        <p><b>Total Biaya Administrasi</b></p>
                      </div>
                      <div class="icon">
                        <i></i>
                      </div>
                      <a href="<?php echo site_url('pembiayaan/biaya_admin') ?>" class="small-box-footer">Info Lengkap <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                  </div>
                </div>
              </div>              
            </div>
          </div>
        </div>
      </div>
   
    </section>
    <!-- /.content -->
</div>
  <!-- /.content-wrapper -->

