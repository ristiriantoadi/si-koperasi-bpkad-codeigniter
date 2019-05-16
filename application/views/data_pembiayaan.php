
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="background-color:white">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Data Pembiayaan</h1>
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
                    <label>Pencarian:</label>
                    <input type="text" class="form-control" id="search-pembiayaan" placeholder="Cari berdasarkan nama atau id" name="no_telepon">
                  </div>
                </div>
              </div>
              <div class="row">
                <table class="table table-bordered" id="table_id">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Nama Lengkap</th>
                      <th>Jumlah Pembiayaan</th>
                      <th>Jangka Waktu</th>
                      <th>Ijarah</th>
                      <th>Pengembalian Pokok</th> 
                      <th>Tanggal Pembiayaan</th>
                      <th>Keterangan</th>
                      <th>Status</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody id="table-body">
                    <?php 
                      $count = 0;
                    foreach ($pembiayaan as $data_pembiayaan): 
                      $count++
                    ?>
                      <tr>
                        <td><?php echo $count?></td>
                        <td><?php echo $data_pembiayaan['nama']?></td>
                        <td class="uang"><?php echo $data_pembiayaan['jumlah']?></td>
                        <td><?php echo $data_pembiayaan['jangka_waktu']?> bulan</td>
                        <td class="uang"><?php echo $data_pembiayaan['ijarah']?></td>
                        <td class="uang"><?php echo $data_pembiayaan['pengembalian_pokok']?></td>         
                        <td><?php echo $data_pembiayaan['tanggal_pembiayaan']?></td>
                        <td><?php echo $data_pembiayaan['keterangan']?></td>
                        <td class="<?php echo ($data_pembiayaan['status_pembiayaan'] == "Belum Lunas" ? "belum-lunas":"lunas")  ?>"><?php echo $data_pembiayaan['status_pembiayaan'] ?></td>
                        <td>
                          <div class="btn-group btn-group-sm">
                            <a href="<?php echo site_url('angsuran/data_angsuran/'.$data_pembiayaan['id_pembiayaan']) ?>" class="btn btn-info">
                              <i class="fa fa-fw fa-info"></i>Lihat detail angsuran</a>
                            <button type="button" class="btn btn-danger hapus-pembiayaan" id="<?php  echo $data_pembiayaan['id_pembiayaan']?>">
                              <i class="fa fa-fw fa-trash-o"></i>Hapus</button>
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

