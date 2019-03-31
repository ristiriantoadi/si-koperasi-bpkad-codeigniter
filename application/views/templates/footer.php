<!-- Main Footer -->
<footer class="main-footer">
    <!-- To the right -->
    <div class="pull-right hidden-xs">
      Anything you want
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; 2016 <a href="#">Company</a>.</strong> All rights reserved.
  </footer>

  
<!-- REQUIRED JS SCRIPTS -->

<!-- jQuery 3 -->
<script src="<?php echo base_url('assets/bower_components/jquery/dist/jquery.min.js') ?>"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo base_url('assets/bower_components/bootstrap/dist/js/bootstrap.min.js')?>"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url('assets/dist/js/adminlte.min.js')?>"></script>
<!-- Optionally, you can add Slimscroll and FastClick plugins.
     Both of these plugins are recommended to enhance the
     user experience. -->
<script>
  $(document).ready(function(){
    console.log("ababa");
    $(document.body).delegate('.hapus', 'click', function(){
      console.log(this.id);
      $.ajax({url: "<?php echo site_url('proses/nonaktifkan_anggota/')?>"+this.id, success: function(result){
        $("#table-body").html(result);
      }});
    });

    $(document.body).delegate('.hapus-iuran-wajib', 'click', function(){
      console.log(this.id);
      if(confirm("Anda yakin ingin menghapus data iuran wajib?")){
        $.ajax({url: "<?php echo site_url('proses/hapus_iuran_wajib/')?>"+this.id, success: function(result){
          $("#table-body").html(result);
          $(".uang").html(formatUang($(".uang").html()));
        }});
      }
    });

    $("#search-aktif").keyup(function(){
      //$("input").css("background-color", "pink");
      //console.log(this.value);
      var keyword = convertToURL(this.value);
      console.log(keyword);
      $.ajax({url: "<?php echo site_url('proses/cari_anggota_aktif/')?>"+keyword, success: function(result){
        $("#table-body").html(result);
      }});
    }); 

    $("#search-iuran-wajib").keyup(function(){
      //$("input").css("background-color", "pink");
      //console.log(this.value);
      var keyword = convertToURL(this.value);
      console.log(keyword);
      $.ajax({url: "<?php echo site_url('proses/cari_iuran_wajib/')?>"+keyword, success: function(result){
        $("#table-body").html(result);
        $(".uang").html(formatUang($(".uang").html()));
      }});
    }); 

    $("#search-iuran-pokok").keyup(function(){
      //$("input").css("background-color", "pink");
      //console.log(this.value);
      var keyword = convertToURL(this.value);
      console.log(keyword);
      $.ajax({url: "<?php echo site_url('proses/cari_iuran_pokok/')?>"+keyword, success: function(result){
        $("#table-body").html(result);
        $(".uang").html(formatUang($(".uang").html()));
      }});
    }); 

    $("#search-ijarah").keyup(function(){
      //$("input").css("background-color", "pink");
      //console.log(this.value);
      var keyword = convertToURL(this.value);
      console.log(keyword);
      $.ajax({url: "<?php echo site_url('proses/cari_data_ijarah/')?>"+keyword, success: function(result){
        $("#table-body").html(result);
        //$(".uang").html(formatUang($(".uang").html()));
        $(".uang").each(function(index, value){
            $(this).html(formatUang($(this).html()));
        })
      }});
    }); 

    $("#id-anggota").keyup(function(){
      //console.log("abababa");(
      var keyword = convertToURL(this.value);
      //document.getElementById("nama").value=this.value;
      $.ajax({url: "<?php echo site_url('proses/cari_anggota_iuran/')?>"+keyword, success: function(result){
        $("#anggota").html(result);
        //$(".uang").html(formatUang($(".uang").html()));
      }});
    });

    $("#id-anggota-angsuran").keyup(function(){
      //console.log("abababa");(
      var keyword = convertToURL(this.value);
      //document.getElementById("nama").value=this.value;
      $.ajax({url: "<?php echo site_url('proses/cari_anggota_angsuran/')?>"+keyword, success: function(result){
        $("#anggota").html(result);
        //$(".uang").html(formatUang($(".uang").html()));
      }});
    });


    $("#jumlah").keyup(function(){
      $("#jumlah").val(formatUangNoCurrency($("#jumlah").val().split('.').join('')));
    });  

    $("#jumlah").change(function(){
      //var jangkaWaktu = parseInt($("#jangka-waktu").val());
      //var jumlah = parseInt($("#jumlah").val().split('.').join(''));
      //$("#ijarah").val(formatUang(jumlah/jangkaWaktu));
      //console.log(jangkaWaktu);
      $("#ijarah").val(formatUangNoCurrency(parseInt($("#bagi-hasil").val())*0.01*parseInt($("#jumlah").val().split('.').join(''))));
      
      if($("#jangka-waktu").val() != "" && $("#jumlah").val() != ""){
        var jangkaWaktu = parseInt($("#jangka-waktu").val());
        var jumlah = parseInt($("#jumlah").val().split('.').join(''));
        $("#pengembalian-pokok").val(formatUangNoCurrency(jumlah/jangkaWaktu));
      }

      if($("#ijarah").val() != "" && $("#pengembalian-pokok").val() !="" ){
        var ijarah = parseInt($("#ijarah").val().split('.').join(''));
        var pengembalian_pokok = parseInt($("#pengembalian-pokok").val().split('.').join(''));
        console.log("Ijarah "+ijarah);
        console.log("Pengembalian pokok "+pengembalian_pokok);
        var angsuran = ijarah+pengembalian_pokok;
        console.log("Nilai angsuran "+angsuran);
        $("#angsuran").val(formatUang(angsuran));

      }
      
    
    });

    $("#bagi-hasil").change(function(){
      //var jangkaWaktu = parseInt($("#jangka-waktu").val());
      //var jumlah = parseInt($("#jumlah").val().split('.').join(''));
      //$("#ijarah").val(formatUang(jumlah/jangkaWaktu));
      //console.log(jangkaWaktu);
      $("#ijarah").val(formatUangNoCurrency(parseInt($("#bagi-hasil").val())*0.01*parseInt($("#jumlah").val().split('.').join(''))));
      
      if($("#ijarah").val() != "" && $("#pengembalian-pokok").val() !="" ){
        var ijarah = parseInt($("#ijarah").val().split('.').join(''));
        var pengembalian_pokok = parseInt($("#pengembalian-pokok").val().split('.').join(''));
        console.log("Ijarah "+ijarah);
        console.log("Pengembalian pokok "+pengembalian_pokok);
        var angsuran = ijarah+pengembalian_pokok;
        console.log("Nilai angsuran "+angsuran);
        $("#angsuran").val(formatUang(angsuran));

      }

    });
    
    $("#jangka-waktu").change(function(){
      var jangkaWaktu = parseInt($("#jangka-waktu").val());
      var jumlah = parseInt($("#jumlah").val().split('.').join(''));
      $("#pengembalian-pokok").val(formatUangNoCurrency(jumlah/jangkaWaktu));
      //console.log(jangkaWaktu);
      //$("#angsuran").val(parseInt($("#pengembalian-pokok").val())+parseInt($("#ijarah").val())));
        
      if($("#ijarah").val() != "" && $("#pengembalian-pokok").val() !="" ){
        var ijarah = parseInt($("#ijarah").val().split('.').join(''));
        var pengembalian_pokok = parseInt($("#pengembalian-pokok").val().split('.').join(''));
        console.log("Ijarah "+ijarah);
        console.log("Pengembalian pokok "+pengembalian_pokok);
        var angsuran = ijarah+pengembalian_pokok;
        console.log("Nilai angsuran "+angsuran);
        $("#angsuran").val(formatUangNoCurrency(angsuran));

      }

    });
    



    $("#id-anggota").change(function(){
      //$("input").css("background-color", "pink");
      //console.log(this.value);
      console.log("something");
      //$("#nama").val="abababab";
      var keyword=this.value.split(" ")[0];
      console.log(keyword);
      $.ajax({url: "<?php echo site_url('proses/cari_nama_anggota/')?>"+keyword, success: function(result){
        //$("#anggota").html(result);
        document.getElementById("nama").value=result;
      }});
      //console.log(keyword);
      this.value=keyword;
      $('#anggota').empty();
      
      
    }); 
    
    $("#angsuran").keyup(function(){
      $("#angsuran").val(formatUangNoCurrency($("#angsuran").val().split('.').join('')));
    });  

    $('#angsuran').change(function(){
      $("#angsuran").val($("#angsuran").val().split('.').join('')); 
      $("#ijarah").val($("#ijarah").val().split('.').join('')); 
     
      var angsuran = parseInt($("#angsuran").val());
      var ijarah = parseInt($("#ijarah").val());
      
      var total_angsuran = angsuran+ijarah;
      $("#total-angsuran").val(formatUangNoCurrency(total_angsuran));
      
      $("#angsuran").val(formatUangNoCurrency(angsuran));
      $("#ijarah").val(formatUangNoCurrency(ijarah));

    })

    $("#id-anggota-angsuran").change(function(){
      //$("input").css("background-color", "pink");
      //console.log(this.value);
      console.log("something");
      //$("#nama").val="abababab";
      var keyword=this.value.split(" ")[0];
      console.log(keyword);
      $.ajax({url: "<?php echo site_url('proses/cari_nama_anggota/')?>"+keyword, success: function(result){
        //$("#anggota").html(result);
        document.getElementById("nama").value=result;
        //$("#")
      }});
      $.ajax({url: "<?php echo site_url('proses/cari_id_pembiayaan/')?>"+keyword, success: function(result){
        //$("#anggota").html(result);
        console.log("ID biaya: "+result);
        document.getElementById("id-biaya").value=result;
        //$("#")
      }});
      $.ajax({url: "<?php echo site_url('proses/cari_jumlah_pembiayaan/')?>"+keyword, success: function(result){
        //$("#anggota").html(result);
        document.getElementById("jumlah-pembiayaan").value = formatUangNoCurrency(result);
        //$("#")
      }});
      $.ajax({url: "<?php echo site_url('proses/cari_pembiayaan_pokok/')?>"+keyword, success: function(result){
        //$("#anggota").html(result);
        document.getElementById("pengembalian-pokok").value=formatUangNoCurrency(result);
        //$("#")
      }});
      $.ajax({url: "<?php echo site_url('proses/cari_ijarah/')?>"+keyword, success: function(result){
        //$("#anggota").html(result);
        document.getElementById("ijarah").value=formatUangNoCurrency(result);
        //$("#")
      }});
      
      //console.log(keyword);
      this.value=keyword;
      $('#anggota').empty();
      
      
    }); 

    if($(".uang").length){
      //$(".uang").each(
        //$(this).html(formatUang($(this).html()))
      //);
        $(".uang").each(function(index, value){
            $(this).html(formatUang($(this).html()));
        })
    
    }
      
      //$(".uang").html(formatUang($this.html()));


  });

  function formatUang(uang){
    if(uang == "")
      return "Rp. 0";
    var	number_string = uang.toString(),
	  //console.log(uang);
    sisa 	= number_string.length % 3,
	  rupiah 	= number_string.substr(0, sisa),
	  ribuan 	= number_string.substr(sisa).match(/\d{3}/g);
		console.log("Ini uang: "+uang);
    if (ribuan) {
	    separator = sisa ? '.' : '';
	    rupiah += separator + ribuan.join('.');
    }
    console.log("Rupiah"+rupiah);
    var currency = "Rp. ";
    return currency+rupiah;
  }

  function formatUangNoCurrency(uang){
    var	number_string = uang.toString(),
	  //console.log("Before formatting: "+number_string);
    sisa 	= number_string.length % 3,
	  rupiah 	= number_string.substr(0, sisa),
	  ribuan 	= number_string.substr(sisa).match(/\d{3}/g);
		console.log("Before formatting "+number_string);
    if (ribuan) {
	    separator = sisa ? '.' : '';
	    rupiah += separator + ribuan.join('.');
    }
    //console.log(rupiah);
    //var currency = "Rp. ";
    return rupiah;
  }

  function perhitunganIjarah(){

  }

  function convertToURL(text){
    return text
        .toLowerCase()
        .replace(/ /g,'-')
        .replace(/[^\w-]+/g,'')
        ;
  }
</script>

</body>

</html>