<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="background-color:white">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Tambah Angsuran</h1>
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
                        <form class="form-horizontal col-sm-8" method="post" action="<?php echo site_url('angsuran/tambah_angsuran')  ?>">
                            <div class="form-group">
                                <label class="control-label col-sm-3" for="id_anggota">Id Anggota:</label>
                                <div class="col-sm-9">
                                    <input list="anggota" name="id_anggota" placeholder="Isi id anggota" id="id-anggota-angsuran" value=""  class="form-control">
                                    <datalist id="anggota">
                                    </datalist>
                                </div>
                            </div>
                            <input type="hidden" id="id-biaya" name="id_pembiayaan">
                            <div class="form-group">
                                <label class="control-label col-sm-3" for="nama">Nama Lengkap:</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="nama" readonly="readonly" name="nama">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-3" for="tanggal">Tanggal Transaksi:</label>
                                <div class="col-sm-9">
                                <input type="date" class="form-control" id="tanggal" name="tanggal" value="<?php echo date('Y-m-d') ?>" >
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-3" for="sisa_pembiayaan">Sisa Pembiayaan:</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="sisa-pembiayaan" name="sisa_pembiayaan" readonly="readonly">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-3" for="jumlah">Pengembalian pokok:</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="pengembalian-pokok" name="pengembalian_pokok" readonly="readonly">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-3" for="jumlah">Ijarah:</label>
                                <div class="col-sm-9"> 
                                    <input type="text" class="form-control" id="ijarah" name="ijarah" readonly="readonly">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-3" for="jumlah">Pembayaran Angsuran:</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="angsuran" name="angsuran">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-3" for="jumlah">Total Angsuran:</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="total-angsuran" name="total_angsuran" readonly="readonly">
                                </div>
                            </div>
                            <div class="pull-right">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-fw fa-user-plus"></i>Bayar</button>
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
