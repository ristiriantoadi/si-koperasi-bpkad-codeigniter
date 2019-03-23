<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="background-color:white">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Edit Anggota</h1>
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
            <form class="form-horizontal col-sm-8" method="post" action="<?php echo site_url('proses/edit_anggota')  ?>">
              <div class="form-group">
                <label class="control-label col-sm-3" for="id_anggota">Id Anggota:</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" id="id-anggota" placeholder="Isi id anggota" name="id_anggota"
                    value="<?php echo $anggota['id_anggota'] ?>">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-sm-3" for="nama">Nama Lengkap:</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" id="nama" placeholder="Isi nama lengkap" name="nama"
                  value="<?php echo $anggota['nama'] ?>">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-sm-3" for="tempat_tanggal_lahir">Tempat, tanggal lahir:</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" id="tempat-tanggal-lahir" placeholder="Isi tempat dan tanggal lahir" name="tempat_tanggal_lahir" 
                  value="<?php echo $anggota['tempat_tanggal_lahir'] ?>"required>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-sm-3" for="no_telepon">No telepon:</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" id="no-telepon" placeholder="Isi no telepon" 
                  name="no_telepon" value="<?php echo $anggota['no_telepon'] ?>">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-sm-3" for="no_ktp">No KTP:</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" id="no-ktp" placeholder="Isi no ktp" name="no_ktp" 
                  value="<?php echo $anggota['no_ktp'] ?>"required>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-sm-3" for="bidang">Bidang:</label>
                <div class="col-sm-9">
                  <select class="form-control" name="bidang" id="bidang">
                    <option value="Sekretariat" <?php echo($anggota['bidang'] == 'Sekretariat' ? 'selected':'') ?> >Sekretariat</option>
                    <option value="Anggaran" <?php echo($anggota['bidang'] == 'Anggaran' ? 'selected':'') ?>>Anggaran</option>
                    <option value="Pembendaharaan" <?php echo($anggota['bidang'] == 'Pembendaharaan' ? 'selected':'') ?>>Pembendaharaan</option>
                    <option value="Akuntansi" <?php echo($anggota['bidang'] == 'Akuntansi' ? 'selected':'') ?>>Akuntansi</option>
                    <option value="BUD" <?php echo($anggota['bidang'] == 'BUD' ? 'selected':'') ?>>BUD</option>
                    <option value="UPT Pemanfaatan Aset" <?php echo($anggota['bidang'] == 'UPT Pemanfaatan Aset' ? 'selected':'') ?>>UPT Pemanfaatan Aset</option>
                    <option value="UPT Islamic Center" <?php echo($anggota['bidang'] == 'UPT Islamic Center' ? 'selected':'') ?>>UPT Islamic Center</option>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-sm-3" for="alamat">Alamat:</label>
                <div class="col-sm-9">
                  <textarea class="form-control" rows="5" id="alamat" name="alamat">
                    <?php echo $anggota['alamat'] ?>
                  </textarea>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-sm-3" for="tanggal">Tanggal daftar:</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" id="tanggal" name="tanggal" value="<?php echo $anggota['tanggal'] ?>" readonly="readonly">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-sm-3" for="iuran">Iuran wajib:</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" id="tanggal" name="iuran" value="Rp. 500.000" readonly="readonly">
                </div>
              </div>
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
