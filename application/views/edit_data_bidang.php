<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="background-color:white">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Data Bidang</h1>
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
            <form class="form-horizontal col-sm-8" method="post" action="<?php echo site_url('master/edit_data_bidang')  ?>">
                <?php 
                    $count=0;
                    foreach($bidang as $data_bidang): 
                        $count++;
                    ?>
                    <div class="form-group">
                        <label class="control-label col-sm-3" for="nama_bidang">Bidang <?php echo $count?>:</label>
                        <div class="col-sm-9">
                        <input type="text" class="form-control" placeholder="Isi nama bidang" name="nama_bidang[]"
                            value="<?php echo $data_bidang['nama_bidang']  ?>">
                        </div>
                    </div>
                <?php endforeach;  ?>
                <div class="pull-right">
                  <button type="submit" class="btn btn-primary">
                <i class="fa fa-fw fa-save"></i>Simpan</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

    </section>
    <!-- /.content -->
</div>
  <!-- /.content-wrapper -->
