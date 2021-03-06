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
            <form class="form-horizontal col-sm-8" method="post" action="<?php echo site_url('anggota/proses_edit_anggota')  ?>">
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
                    <div class="col-sm-6" style="padding-left: 0"> 
                      <input type="text" class="form-control" value="<?php echo $tempat_lahir ?>" id="tempat-tanggal-lahir" placeholder="Isi tempat kelahiran" name="tempat_lahir" required
                        oninvalid="this.setCustomValidity('Isi tempat dan tanggal lahir')"
          oninput="this.setCustomValidity('')">
                    </div>
                    <div class="col-sm-6" style="padding-right: 0"> 
                      <input type="date" class="form-control col-sm-6" id="tanggal" name="tanggal_lahir" required
                          oninvalid="this.setCustomValidity('Pilih tanggal')" value="<?php echo $tanggal_lahir ?>"
        oninput="this.setCustomValidity('')" >
                    </div>
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
                    <?php foreach($bidang as $data_bidang):?>
                      <option value="<?php echo $data_bidang['id_bidang'] ?>" <?php echo($anggota['nama_bidang'] == $data_bidang['nama_bidang'] ? 'selected':'') ?> ><?php echo $data_bidang['nama_bidang'] ?></option>
                    <?php endforeach; ?>      
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
