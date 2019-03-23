
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="background-color:white">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Data Anggota</h1>
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
                        <div class="col-sm-6">
                            <p><span class="col-sm-5">No Anggota<span class="pull-right">:</span></span><?php echo $anggota['id_anggota'] ?></p>
                            <p><span class="col-sm-5">Nama<span class="pull-right">:</span></span><?php echo $anggota['nama'] ?></p>
                            <p><span class="col-sm-5">Alamat<span class="pull-right">:</span></span><?php echo $anggota['alamat'] ?></p>
                            <p><span class="col-sm-5">Tempat, tanggal lahir<span class="pull-right">:</span></span><?php echo $anggota['tempat_tanggal_lahir'] ?></p>
                        </div> 
                        <div class="col-sm-5 pull-right">
                            <p><span class="col-sm-4">No Telp<span class="pull-right">:</span></span><?php echo $anggota['no_telepon'] ?></p>
                            <p><span class="col-sm-4">No KTP<span class="pull-right">:</span></span><?php echo $anggota['no_ktp'] ?></p>
                            
                            <p><span class="col-sm-4">Bidang<span class="pull-right">:</span></span><?php echo $anggota['bidang'] ?></p>
                            <p><span class="col-sm-4">Tanggal daftar<span class="pull-right">:</span></span><?php echo $anggota['tanggal'] ?></p>
                            <p style="margin-top:20px;margin-left:15px"><a href="<?php echo site_url('anggota/edit_anggota/'.$anggota['id_anggota'])?>" class="btn btn-default btn-sm">Edit Data</a></p>
                            
                        </div> 
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-6">
                            <p><span class="col-sm-4">Iuran Pokok<span class="pull-right">:</span></span>Rp. 500.000</p>
                            <p><span class="col-sm-4">Iuran Wajib<span class="pull-right">:</span></span><span class="uang"><?php echo $total_iuran_wajib ?></span></p>
                        </div> 
                        <div class="col-sm-5 pull-right">
                            <p><a href="<?php echo site_url('anggota/iuran_pokok/'.$anggota['id_anggota']) ?>">Detail Iuran Pokok</a></p>
                            <p><a href="<?php echo site_url('anggota/iuran_wajib/'.$anggota['id_anggota'])?>">Detail Iuran Wajib</a></p>
                            
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-6">
                            <p><span class="col-sm-4">Sisa Pembiayaan<span class="pull-right">:</span></span><span class="uang"><?php echo $sisa_pembiayaan?></span></p>
                        </div>
                        <div class="col-sm-5 pull-right">
                            <p><a href="<?php echo site_url('anggota/pembiayaan/'.$anggota['id_anggota']) ?>">Detail Pembiayaan</a></p>
                        </div>     
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-6">
                            <p><span class="col-sm-4">Total Angsuran<span class="pull-right">:</span></span><span class="uang"><?php echo $total_angsuran  ?></span></p>
                        </div>
                        <div class="col-sm-5 pull-right">
                            <p><a href="<?php echo site_url('anggota/data_angsuran/'.$pembiayaan['id_pembiayaan'])?>">Detail Angsuran</a></p>
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

