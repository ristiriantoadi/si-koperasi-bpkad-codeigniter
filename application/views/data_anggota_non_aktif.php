
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="background-color:white">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Data Anggota Nonaktif</h1>
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
                <div class="form-group ">
                  <div class="pull-right col-sm-3 ">
                    <input type="text" class="form-control" id="search" placeholder="Cari berdasarkan nama atau id" name="no_telepon">
                  </div>
                  
                </div>
                
              </div>
              <div class="row">
                <table class="table table-bordered" id="table_id">
                  <thead>
                    <tr>
                      <th>Id Anggota</th>
                      <th>Nama Lengkap</th>
                      <th>No telepon</th>
                      <th>Bidang</th>
                      <th>Alamat</th>
                      <th>Tanggal Nonaktif</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody id="table-body">
                    <?php foreach ($anggota as $data_anggota): ?>
                      <tr>
                        <td><?php echo $data_anggota['id_anggota']?></td>
                        <td><?php echo $data_anggota['nama']?></td>
                        <td><?php echo $data_anggota['no_telepon']?></td>
                        <td><?php echo $data_anggota['bidang']?></td>
                        <td><?php echo $data_anggota['alamat']?></td>
                        <td><?php echo $data_anggota['tanggal_nonaktif']?></td>
                        <td>
                          <div class="btn-group btn-group-sm">
                            <a href="<?php echo site_url('anggota/data/'.$data_anggota['id_anggota']) ?>" class="btn btn-info">
                              <i class="fa fa-fw fa-info"></i>Lihat selengkapnya</a>
                            
                          </div>
                        </td>
                      </tr>
                    <?php endforeach; ?> 
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
   
    </section>
    <!-- /.content -->
</div>
  <!-- /.content-wrapper -->

