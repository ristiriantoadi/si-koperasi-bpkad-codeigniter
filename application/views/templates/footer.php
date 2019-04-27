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
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<!-- Optionally, you can add Slimscroll and FastClick plugins.
     Both of these plugins are recommended to enhance the
     user experience. -->
<script>
  $(document).ready(function(){
    console.log("ababa");
    $(document.body).delegate('.hapus', 'click', function(){
      console.log(this.id);
      if(confirm("Anda yakin ingin menonaktifkan anggota?")){
        $.ajax({url: "<?php echo site_url('anggota/nonaktifkan_anggota/')?>"+this.id, success: function(result){
          $("#table-body").html(result);
        }});
      }
    });
    
    $("#search-iuran-pokok-by-tanggal").daterangepicker({
      ranges: {
        'Hari ini': [moment(), moment()],
        'Kemarin': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
        '7 hari terakhir': [moment().subtract(6, 'days'), moment()],
        '30 hari terakhir': [moment().subtract(29, 'days'), moment()],
        'Bulan ini': [moment().startOf('month'), moment().endOf('month')],
        'Bulan lalu': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
      },
      "alwaysShowCalendars": true,
      locale: {
        format: 'DD MMM YYYY'
      },
      "startDate": "01 01 2019",
      "endDate": "1 1 2020"
    }, function(start, end, label) {
          //console.log('New date range selected: ' + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD') + ' (predefined range: ' + label + ')');
          var startDate= start.format('YYYY-MM-DD');
          var endDate = end.format('YYYY-MM-DD');
          //console.log(start.format('YYYY-MM-DD'));
          var site = "<?php echo site_url('anggota/cari_iuran_pokok_by_date') ?>";
          site+="/"+startDate+'/'+endDate;
          console.log(site);
          //location.replace(site);

          $.ajax({url: site, success: function(result){
            $("#table-body").html(result);
            $(".uang").each(function(index, value){
              $(this).html(formatUang($(this).html()));
            })
          }});
      });

      $("#search-iuran-wajib-by-tanggal").daterangepicker({
      ranges: {
        'Hari ini': [moment(), moment()],
        'Kemarin': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
        '7 hari terakhir': [moment().subtract(6, 'days'), moment()],
        '30 hari terakhir': [moment().subtract(29, 'days'), moment()],
        'Bulan ini': [moment().startOf('month'), moment().endOf('month')],
        'Bulan lalu': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
      },
      "alwaysShowCalendars": true,
      locale: {
        format: 'DD MMM YYYY'
      },
      "startDate": "01 01 2019",
      "endDate": "1 1 2020"
    }, function(start, end, label) {
          //console.log('New date range selected: ' + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD') + ' (predefined range: ' + label + ')');
          var startDate= start.format('YYYY-MM-DD');
          var endDate = end.format('YYYY-MM-DD');
          //console.log(start.format('YYYY-MM-DD'));
          var site = "<?php echo site_url('iuran_wajib/cari_iuran_wajib_by_date') ?>";
          site+="/"+startDate+'/'+endDate;
          console.log(site);
          //location.replace(site);

          $.ajax({url: site, success: function(result){
            $("#table-body").html(result);
            $(".uang").each(function(index, value){
              $(this).html(formatUang($(this).html()));
            })
          }});
      });  

      $("#search-biaya-admin-by-tanggal").daterangepicker({
      ranges: {
        'Hari ini': [moment(), moment()],
        'Kemarin': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
        '7 hari terakhir': [moment().subtract(6, 'days'), moment()],
        '30 hari terakhir': [moment().subtract(29, 'days'), moment()],
        'Bulan ini': [moment().startOf('month'), moment().endOf('month')],
        'Bulan lalu': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
      },
      "alwaysShowCalendars": true,
      locale: {
        format: 'DD MMM YYYY'
      },
      "startDate": "01 01 2019",
      "endDate": "1 1 2020"
    }, function(start, end, label) {
          //console.log('New date range selected: ' + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD') + ' (predefined range: ' + label + ')');
          var startDate= start.format('YYYY-MM-DD');
          var endDate = end.format('YYYY-MM-DD');
          //console.log(start.format('YYYY-MM-DD'));
          var site = "<?php echo site_url('pembiayaan/cari_biaya_admin_by_date') ?>";
          site+="/"+startDate+'/'+endDate;
          console.log(site);
          //location.replace(site);

          $.ajax({url: site, success: function(result){
            $("#table-body").html(result);
            $(".uang").each(function(index, value){
              $(this).html(formatUang($(this).html()));
            })
          }});
      });  

    $(document.body).delegate('.hapus-iuran-wajib', 'click', function(){
      console.log(this.id);
      if(confirm("Anda yakin ingin menghapus data iuran wajib?")){
        $.ajax({url: "<?php echo site_url('iuran_wajib/hapus_iuran_wajib/')?>"+this.id, success: function(result){
          $("#table-body").html(result);
          $(".uang").each(function(index, value){
            $(this).html(formatUang($(this).html()));
          })
        }});
      }
    });

    $(document.body).delegate('.hapus-pembiayaan', 'click', function(){
      console.log(this.id);
      if(confirm("Anda yakin ingin menghapus data pembiayaan?")){
        $.ajax({url: "<?php echo site_url('pembiayaan/hapus_pembiayaan/')?>"+this.id, success: function(result){
          $("#table-body").html(result);
          //$(".uang").html(formatUang($(".uang").html()));
          $(".uang").each(function(index, value){
          $(this).html(formatUang($(this).html()));
         })
        }});
      }
    });

    $("#search-aktif").keyup(function(){
      //$("input").css("background-color", "pink");
      //console.log(this.value);
      var keyword = convertToURL(this.value);
      console.log(keyword);
      $.ajax({url: "<?php echo site_url('anggota/cari_anggota_aktif/')?>"+keyword, success: function(result){
        $("#table-body").html(result);
      }});
    });

    $("#search-pembiayaan").keyup(function(){
      //$("input").css("background-color", "pink");
      //console.log(this.value);
      var keyword = convertToURL(this.value);
      console.log(keyword);
      $.ajax({url: "<?php echo site_url('pembiayaan/cari_pembiayaan/')?>"+keyword, success: function(result){
        $("#table-body").html(result);
        $(".uang").each(function(index, value){
          $(this).html(formatUang($(this).html()));
         })
      }});
    });

    
    $("#search-non-aktif").keyup(function(){
      //$("input").css("background-color", "pink");
      //console.log(this.value);
      var keyword = convertToURL(this.value);
      console.log(keyword);
      $.ajax({url: "<?php echo site_url('anggota/cari_anggota_nonaktif/')?>"+keyword, success: function(result){
        $("#table-body").html(result);
      }});
    }); 

    $("#search-iuran-wajib").keyup(function(){
      //$("input").css("background-color", "pink");
      //console.log(this.value);
      var keyword = convertToURL(this.value);
      console.log(keyword);
      $.ajax({url: "<?php echo site_url('iuran_wajib/cari_iuran_wajib/')?>"+keyword, success: function(result){
        $("#table-body").html(result);
        $(".uang").each(function(index, value){
            $(this).html(formatUang($(this).html()));
        })
        //$(".uang").html(formatUang($(".uang").html()));
      }});
    });

    $("#search-biaya-admin").keyup(function(){
      //$("input").css("background-color", "pink");
      //console.log(this.value);
      var keyword = convertToURL(this.value);
      console.log(keyword);
      $.ajax({url: "<?php echo site_url('proses/cari_biaya_admin/')?>"+keyword, success: function(result){
        $("#table-body").html(result);
        $(".uang").each(function(index, value){
            $(this).html(formatUang($(this).html()));
        })
        //$(".uang").html(formatUang($(".uang").html()));
      }});
    }); 

    $("#search-iuran-pokok").keyup(function(){
      //$("input").css("background-color", "pink");
      //console.log(this.value);
      var keyword = convertToURL(this.value);
      console.log(keyword);
      $.ajax({url: "<?php echo site_url('anggota/cari_iuran_pokok/')?>"+keyword, success: function(result){
        $("#table-body").html(result);
        $(".uang").each(function(index, value){
            $(this).html(formatUang($(this).html()));
        })
      }});
    }); 

    $("#search-ijarah").keyup(function(){
      //$("input").css("background-color", "pink");
      //console.log(this.value);
      var keyword = convertToURL(this.value);
      console.log(keyword);
      $.ajax({url: "<?php echo site_url('angsuran/cari_data_ijarah/')?>"+keyword, success: function(result){
        $("#table-body").html(result);
        //$(".uang").html(formatUang($(".uang").html()));
        $(".uang").each(function(index, value){
            $(this).html(formatUang($(this).html()));
        })
      }});
    }); 

    $("#id-anggota-iuran-wajib").keyup(function(){
      //console.log("abababa");(
      var keyword = convertToURL(this.value);
      console.log(keyword);
      //document.getElementById("nama").value=this.value;
      $.ajax({url: "<?php echo site_url('iuran_wajib/cari_anggota_iuran/')?>"+keyword, success: function(result){
        $("#anggota").html(result);
        //$(".uang").html(formatUang($(".uang").html()));
      }});
    });

    $("#id-anggota-pembiayaan").keyup(function(){
      //console.log("abababa");(
      var keyword = convertToURL(this.value);
      //document.getElementById("nama").value=this.value;
      $.ajax({url: "<?php echo site_url('pembiayaan/cari_anggota_boleh_mendapat_pembiayaan/')?>"+keyword, success: function(result){
        $("#anggota").html(result);
        //$(".uang").html(formatUang($(".uang").html()));
      }});
    });

    $("#id-anggota-angsuran").keyup(function(){
      //console.log("abababa");(
      var keyword = convertToURL(this.value);
      //document.getElementById("nama").value=this.value;
      $.ajax({url: "<?php echo site_url('angsuran/cari_anggota_angsuran/')?>"+keyword, success: function(result){
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
    

    
    $("#id-anggota-pembiayaan").change(function(){
      //$("input").css("background-color", "pink");
      //console.log(this.value);
      console.log("something");
      //$("#nama").val="abababab";
      var id=this.value.split(" ")[0];
      var nama=this.value.split(' ').slice(1).join(' ');
      //console.log("Keyword "+keyword);
      //console.log("Keyword 1"+keyword1);
      /*
      $.ajax({url: "<?php echo site_url('anggota/cari_nama_anggota/')?>"+keyword, success: function(result){
        //$("#anggota").html(result);
        document.getElementById("nama").value=result;
      }});
      */
      //console.log(keyword);
      $("#id-anggota-pembiayaan").val(id);
      $("#nama").val(nama);
      console.log(id);
      console.log(nama);

      $('#anggota').empty();
      
    });

    $("#id-anggota-iuran-wajib").change(function(){
      //$("input").css("background-color", "pink");
      //console.log(this.value);
      console.log("something");
      //$("#nama").val="abababab";
      var keyword=this.value.split(" ")[0];
      console.log(keyword);
      $.ajax({url: "<?php echo site_url('anggota/cari_nama_anggota/')?>"+keyword, success: function(result){
        //$("#anggota").html(result);
        document.getElementById("nama").value=result;
      }});
      //console.log(keyword);
      this.value=keyword;
      $('#anggota').empty();
      
    }); 
    
    $("#angsuran").keyup(function(){
      //$("#angsuran").val(formatUangNoCurrency($("#angsuran").val().split('.').join('')));
      $("#angsuran").val($("#angsuran").val().split('.').join('')); 
      $("#ijarah").val($("#ijarah").val().split('.').join('')); 
     
      var angsuran = parseInt($("#angsuran").val());
      var ijarah = parseInt($("#ijarah").val());
      
      var total_angsuran = angsuran+ijarah;
      $("#total-angsuran").val(formatUangNoCurrency(total_angsuran));
      
      $("#angsuran").val(formatUangNoCurrency(angsuran));
      $("#ijarah").val(formatUangNoCurrency(ijarah));

    });  

    /*
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
    */

    $("#id-anggota-angsuran").change(function(){
      //$("input").css("background-color", "pink");
      //console.log(this.value);
      console.log("something");
      //$("#nama").val="abababab";
      var keyword=this.value.split(" ")[0];
      console.log(keyword);
      $.ajax({url: "<?php echo site_url('anggota/cari_nama_anggota/')?>"+keyword, success: function(result){
        //$("#anggota").html(result);
        document.getElementById("nama").value=result;
        //$("#")
      }});
      $.ajax({url: "<?php echo site_url('pembiayaan/cari_id_pembiayaan/')?>"+keyword, success: function(result){
        //$("#anggota").html(result);
        console.log("ID biaya: "+result);
        document.getElementById("id-biaya").value=result;
        //$("#")
      }});
      $.ajax({url: "<?php echo site_url('pembiayaan/get_sisa_pembiayaan_by_id_anggota/')?>"+keyword, success: function(result){
        //$("#anggota").html(result);
        document.getElementById("sisa-pembiayaan").value = formatUangNoCurrency(result);
        //$("#")
      }});
      $.ajax({url: "<?php echo site_url('pembiayaan/cari_pembiayaan_pokok/')?>"+keyword, success: function(result){
        //$("#anggota").html(result);
        document.getElementById("pengembalian-pokok").value=formatUangNoCurrency(result);
        //$("#")
      }});
      $.ajax({url: "<?php echo site_url('angsuran/cari_ijarah/')?>"+keyword, success: function(result){
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

    if($(".uang-input").length){
      $(".uang-input").each(function(index, value){
          console.log($(this).val());
            $(this).val(formatUangNoCurrency($(this).val()));
        })
      console.log("abc");
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