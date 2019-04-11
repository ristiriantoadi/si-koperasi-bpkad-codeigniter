<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="background-color:white">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Tambah Pembiayaan</h1>
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
                        <form class="form-horizontal col-sm-8" method="post" action="<?php echo site_url('proses/tambah_pembiayaan')  ?>">
                            <div class="form-group">
                                <label class="control-label col-sm-3" for="id_anggota">Id Anggota:</label>
                                <div class="col-sm-9">
                                    <input list="anggota" name="id_anggota" placeholder="Isi id anggota" id="id-anggota-pembiayaan" value=""  class="form-control">
                                    <datalist id="anggota">
                                    </datalist>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-3" for="nama">Nama Lengkap:</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="nama" readonly="readonly" name="nama">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-3" for="tanggal">Tanggal Pembiayaan:</label>
                                <div class="col-sm-9">
                                <input type="date" class="form-control" id="tanggal" name="tanggal" value="<?php echo date('Y-m-d') ?>" >
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-3" for="jumlah">Jumlah:</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="jumlah" name="jumlah">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-3" for="jumlah">Jangka Waktu(bulan):</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="jangka-waktu" name="jangka_waktu">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-3" for="jumlah">Pengembalian pokok:</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="pengembalian-pokok" name="pengembalian_pokok">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-3" for="jumlah">Bagi Hasil(%):</label>
                                <div class="col-sm-9">
                                    <input type="number" class="form-control" id="bagi-hasil" name="bagi_hasil" value="1">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-3" for="jumlah">Ijarah:</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="ijarah" name="ijarah" readonly="readonly">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-3" for="jumlah">Biaya Administrasi:</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control uang-input" id="biaya-administrasi" name="biaya_administrasi" value="<?php echo $biaya_admin ?>" readonly="readonly">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-3" for="alamat">Keterangan:</label>
                                <div class="col-sm-9">
                                    <textarea class="form-control" rows="5" id="keterangan" name="keterangan"></textarea>
                                </div>
              </div>
                            <div class="pull-right">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-fw fa-user-plus"></i>Tambah</button>
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
