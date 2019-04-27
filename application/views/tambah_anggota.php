<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="background-color:white">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Tambah Anggota</h1>
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
            <form class="form-horizontal col-sm-8" method="post" action="<?php echo site_url('anggota/proses_tambah_anggota')  ?>">
              <div class="form-group">
                <label class="control-label col-sm-3" for="id_anggota">Id Anggota:</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" id="id-anggota" placeholder="Isi id anggota" name="id_anggota" value="<?php echo sprintf("%03d", $anggota['id_anggota']) ?>" required
                  oninvalid="this.setCustomValidity('Isi id anggota')"
    oninput="this.setCustomValidity('')">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-sm-3" for="nama">Nama Lengkap:</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" id="nama" placeholder="Isi nama lengkap" name="nama" required
                  oninvalid="this.setCustomValidity('Isi nama lengkap')"
    oninput="this.setCustomValidity('')">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-sm-3" for="tempat_tanggal_lahir">Tempat, tanggal lahir:</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" id="tempat-tanggal-lahir" placeholder="Isi tempat dan tanggal lahir" name="tempat_tanggal_lahir" required
                  oninvalid="this.setCustomValidity('Isi tempat dan tanggal lahir')"
    oninput="this.setCustomValidity('')">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-sm-3" for="no_telepon">No telepon:</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" id="no-telepon" placeholder="Isi no telepon" name="no_telepon" required
                  oninvalid="this.setCustomValidity('Isi no telepon')"
    oninput="this.setCustomValidity('')">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-sm-3" for="no_ktp">No KTP:</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" id="no-ktp" placeholder="Isi no ktp" name="no_ktp" required
                  oninvalid="this.setCustomValidity('Isi no ktp')"
    oninput="this.setCustomValidity('')">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-sm-3" for="bidang">Bidang:</label>
                <div class="col-sm-9">
                  <select class="form-control" name="bidang" id="bidang">
                    <?php 
                      foreach($bidang as $data_bidang):
                    ?>
                      <option value="<?php echo $data_bidang['id_bidang'] ?>"><?php echo $data_bidang['nama_bidang']?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-sm-3" for="alamat">Alamat:</label>
                <div class="col-sm-9">
                  <textarea class="form-control" rows="5" id="alamat" name="alamat"></textarea>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-sm-3" for="tanggal">Tanggal daftar:</label>
                <div class="col-sm-9">
                  <input type="date" class="form-control" id="tanggal" name="tanggal" value="<?php echo date('Y-m-d') ?>" required
                  oninvalid="this.setCustomValidity('Pilih tanggal')"
    oninput="this.setCustomValidity('')">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-sm-3" for="iuran">Iuran Pokok:</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" id="tanggal" name="iuran-pokok" value="500.000" readonly="readonly">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-sm-3" for="iuran">Iuran Wajib:</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control uang-input" id="tanggal" name="jumlah" value="<?php echo $jumlah_iuran_wajib ?>" readonly="readonly">
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
