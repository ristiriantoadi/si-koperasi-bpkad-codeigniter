
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="background-color:white">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Data Iuran Pokok</h1>
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
                <div class="pull-right col-sm-3">
                  <label>Pencarian berdasarkan tanggal:</label>
                  <input type="text" class="form-control" id="search-iuran-pokok-by-tanggal" placeholder="Cari berdasarkan tanggal">
                </div>
              </div>
              <div class="row">
                <div class="form-group ">
                  <div class="pull-right col-sm-3 ">
                    <label>Pencarian berdasarkan nama:</label>
                    <input type="text" class="form-control" id="search-iuran-pokok" placeholder="Cari berdasarkan nama" name="no_telepon">
                  </div>
                </div>
              </div>
              <div class="row">
                <table class="table table-bordered" id="table_id">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Nama Lengkap</th>
                      <th>Tanggal transaksi</th>
                      <th>Jumlah</th>
                      
                    </tr>
                  </thead>
                  <tbody id="table-body">
                    <?php 
                      $count=0;  
                      foreach ($iuran_pokok as $data_iuran): ?>
                        <tr>
                          <td><?php echo $count+1 ?></td>
                          <td><?php echo $data_iuran['nama']?></td>
                          <td><?php echo $data_iuran['tanggal']?></td>
                          <td class="uang"><?php echo $data_iuran['iuran_pokok']?></td>
                          
                        </tr>
                    <?php 
                      $count++;
                      endforeach; ?>
                    <tr>
                      <td colspan="3"><b>Total Jumlah</b></td>
                      <td class="uang"><?php echo $total_iuran_pokok ?></td>
                    </tr> 
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

