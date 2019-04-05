
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="background-color:white">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Data Angsuran</h1>
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
                <table class="table table-bordered" id="table_id">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Tanggal Pembayaran</th>
                      <th>Jumlah Angsuran</th>
                    </tr>
                  </thead>
                  <tbody id="table-body">
                    <?php 
                    $count=1;
                    $total=0;
                    //echo $pembiayaan['jumlah'];
                    //exit();
                    foreach ($angsuran as $data_angsuran): ?>
                      <?php $total+=$data_angsuran['jumlah_angsuran']  ?>
                      <tr>
                        <td><?php echo $count?></td>
                        <td><?php echo $data_angsuran['tanggal']?></td>
                        <td class="uang"><?php echo $data_angsuran['jumlah_angsuran']?></td>
                      </tr>
                    <?php 
                        $count++;
                        endforeach; ?> 
                      <tr>
                        <td colspan="2"><b>Total Angsuran</b></td>
                        <td class="uang"><?php echo $total ?></td>
                      </tr> 
                      <tr>
                        <td colspan="2"><b>Sisa Pembiayaan</b></td>
                        <td class="uang"><?php echo $pembiayaan['jumlah']-$total ?></td>
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

