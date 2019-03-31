$(document.body).delegate(".hapus-iuran-wajib", "click", function() {
	console.log(this.id);

	$.ajax({
		url: "<?php echo site_url('proses/hapus_iuran_wajib/')?>" + this.id,
		success: function(result) {
			$("#table-body").html(result);
			$(".uang").html(formatUang($(".uang").html()));
		}
	});
});
